<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Korapay extends MX_Controller {

    public $tb_users;
    public $tb_transaction_logs;
    public $tb_payments;
    public $payment_type;
    public $payment_id;
    public $currency_code;
    public $secret_key;
    public $encryption_key;
    public $api_base;
    public $take_fee_from_user;

    // Toggle this to false in production
    protected $debug_mode = true;

    public function __construct($payment = "") {
        parent::__construct();

        // model + helpers
        $this->load->model('add_funds_model', 'model');
        $this->load->helper('string'); // for random_string if needed elsewhere

        // tables & defaults
        $this->tb_users            = USERS;
        $this->tb_transaction_logs = TRANSACTION_LOGS;
        $this->tb_payments         = PAYMENTS_METHOD;
        $this->payment_type        = 'korapay';

        if (empty($payment)) {
            $payment = $this->model->get(
                'id, type, name, params',
                $this->tb_payments,
                ['type' => $this->payment_type]
            );
        }

        if (empty($payment)) exit("Error: Payment method 'korapay' not configured.");

        $this->payment_id = $payment->id;

        $params                   = json_decode($payment->params, true);
        $option                   = get_value($params, 'option');
        $this->take_fee_from_user = get_value($params, 'take_fee_from_user');

        $this->secret_key     = get_value($option, 'secret_key');
        $this->encryption_key = get_value($option, 'encryption_key');

        $this->api_base = "https://api.korapay.com/merchant/api/v1";

        // Korapay card payments only support NGN
        $this->currency_code = "NGN";
    }

    public function index() {
        redirect(cn("add_funds"));
    }

    /**
     * Create payment (entry point from add_funds/process)
     * Accepts $data_payment or falls back to POST.
     *
     * Returns JSON via ms() with:
     *  - success redirect_url (for immediate success or 3DS)
     *  - or instruction to validate (pin/otp) with charge_id
     */
    public function create_payment($data_payment = "")
    {
        // Always return JSON only — NEVER use _validation() here
        $jsonError = function($msg, $debug = null) {
            $payload = ['status' => 'error', 'message' => $msg];
            if ($debug !== null) $payload['debug'] = $debug;
            ms($payload); // exits
        };

        // Determine module and force AJAX
        _is_ajax($data_payment['module'] ?? post('module') ?? 'add_funds');

        // Collect request values
        $card_number  = $data_payment['card_number']  ?? post("card_number");
        $expiry_month = $data_payment['expiry_month'] ?? post("expiry_month");
        $expiry_year  = $data_payment['expiry_year']  ?? post("expiry_year");
        // Normalize to 2 digits
        $expiry_year = trim((string)$expiry_year);
        if (strlen($expiry_year) === 4) {
            $expiry_year = substr($expiry_year, -2);  // 2030 → 30
        }

        // Update validation to enforce 2 digits
        if (!preg_match('/^\d{2}$/', $expiry_year)) {
            $jsonError("Invalid expiry year: Must be 2 digits (e.g., 30).");
        }
        $cvv          = $data_payment['cvv']          ?? post("cvv");
        $amount       = (double) ($data_payment['amount'] ?? post("amount"));

        // Normalize
        $card_number = preg_replace('/\D+/', '', (string)$card_number);

        // ✅ Frontend already validates, but we still return JSON cleanly
        if (!$card_number || !$expiry_month || !$expiry_year || !$cvv || !$amount) {
            $jsonError("All fields are required.");
        }

        if (!is_numeric($amount) || $amount <= 0) $jsonError("Invalid amount.");
        if (!$this->secret_key || !$this->encryption_key) $jsonError("Korapay configuration missing.");
        if (strlen($card_number) < 12 || strlen($card_number) > 19) $jsonError("Invalid card number.");
        if (!preg_match('/^\d{1,2}$/', $expiry_month)) $jsonError("Invalid expiry month.");
        if (!preg_match('/^\d{2,4}$/', $expiry_year))  $jsonError("Invalid expiry year.");
        if (!preg_match('/^\d{3,4}$/', $cvv))          $jsonError("Invalid CVV.");

        // ✅ Generate reference safely
        try {
            $reference = 'makara_' . bin2hex(random_bytes(7));
        } catch (\Throwable $e) {
            $reference = 'makara_' . uniqid() . random_string('alnum', 4);
        }

        // ✅ Build payload for Korapay
        $user_info = session('user_current_info');
        $payload = [
            "reference"    => $reference,
            "amount"       => $amount,
            "currency"     => $this->currency_code,
            "redirect_url" => cn("add_funds/korapay/complete"),
            "card" => [
                "number"       => $card_number,
                "cvv"          => $cvv,
                "expiry_month" => $expiry_month,
                "expiry_year"  => $expiry_year
            ],
            "customer" => [
                "name"  => trim(($user_info['first_name'] ?? '') . ' ' . ($user_info['last_name'] ?? '')),
                "email" => $user_info['email'] ?? ''
            ]
        ];

        // Encrypt
        $encrypted = $this->encrypt_korapay_data($payload);
        if (!$encrypted) $jsonError("Failed to encrypt payment.");

        // ✅ Call Korapay
        $response = $this->korapay_request("charges/card", ["charge_data" => $encrypted]);
        log_message('debug', 'Korapay Charge Response: ' . json_encode($response));
        // Debug holder
        $debug = $this->debug_mode ? [
            "payload" => $payload,
            "response" => $response
        ] : null;

        if (!isset($response['status']) || $response['status'] !== true) {
            $jsonError($response['message'] ?? "Korapay error.", $debug);
        }

        // ✅ Save PENDING transaction
        $this->db->insert($this->tb_transaction_logs, [
            "ids"            => ids(),
            "uid"            => session("uid"),
            "type"           => $this->payment_type,
            "transaction_id" => $reference,
            "amount"         => $amount,
            "status"         => 0,
            "created"        => NOW,
        ]);

        // ✅ Handle 3DS redirect
        if (
            isset($response['data']['authorization']['mode']) &&
            strtolower($response['data']['authorization']['mode']) === "redirect"
        ) {
            ms([
                'status'       => 'success',
                'redirect_url' => $response['data']['authorization']['redirect_url'],
                'debug'        => $debug
            ]);
        }

        // ✅ SUCCESS — no auth needed
        if (($response['data']['status'] ?? '') === 'success') {
            ms([
                'status'       => 'success',
                'redirect_url' => cn("add_funds/korapay/complete?reference={$reference}"),
                'debug'        => $debug
            ]);
        }

        // ✅ PIN REQUIRED
        if (
            strtolower($response['data']['status'] ?? '') === 'processing' &&
            in_array('pin', $response['data']['required_fields'] ?? [])
        ) {
            ms([
                'status'                => 'requires_pin',
                'message'               => "Card PIN required",
                'transaction_reference' => $response['data']['transaction_reference'],
                'reference'             => $reference, // Send original reference back
                'debug'                 => $debug
            ]);
        }

        // TEST MODE: Bypass PIN/OTP validation
        if ($this->debug_mode && in_array('pin', $response['data']['required_fields'] ?? [])) {
            // Auto-complete in test mode
            $this->db->update($this->tb_transaction_logs, [
                'status' => 1,
                'txn_fee' => 0
            ], ['transaction_id' => $reference]);

            $this->model->add_funds_bonus_email((object)[
                'amount' => $amount,
                'txn_fee' => 0
            ], $this->payment_id);

            ms([
                'status' => 'success',
                'redirect_url' => cn("add_funds/success")
            ]);
        }

        // ✅ OTP REQUIRED
        if (
            strtolower($response['data']['status'] ?? '') === 'send_otp' ||
            in_array('otp', $response['data']['required_fields'] ?? [])
        ) {
            ms([
                'status'                => 'requires_otp',
                'message'               => "OTP required",
                'transaction_reference' => $response['data']['transaction_reference'],
                'reference'             => $reference, // Send original reference back
                'debug'                 => $debug
            ]);
        }

        // ✅ Unknown response
        $jsonError("Unknown Korapay response.", $debug);
    }


    /**
     * Validate a charge (PIN/OTP)
     * Expects POST: charge_id, type (pin|otp), value
     */
    public function validate_charge()
    {
        $transaction_reference = post('transaction_reference');
        $type = post('type'); // 'pin' or 'otp'
        $value = post('value');

        if (!$transaction_reference || !$type || !$value) {
            ms(['status' => 'error', 'message' => 'transaction_reference, type and value are required.']);
        }

        $endpoint = "charges/{$transaction_reference}/validate";
        $payload = [
            'type'  => $type,
            'value' => $value
        ];

        $response = $this->korapay_request($endpoint, $payload);

        if (!isset($response['status']) || $response['status'] !== true) {
            ms(['status' => 'error', 'message' => $response['message'] ?? 'Validation failed', 'debug' => $response]);
        }

        if (isset($response['data']['authorization']['mode']) && strtolower($response['data']['authorization']['mode']) === 'redirect') {
            ms(['status' => 'success', 'redirect_url' => $response['data']['authorization']['redirect_url']]);
        }

        if (isset($response['data']['status']) && $response['data']['status'] === 'success') {
            $reference = $response['data']['reference'] ?? $transaction_reference;
            ms(['status' => 'success', 'redirect_url' => cn("add_funds/korapay/complete?reference=" . $reference)]);
        }

        ms(['status' => 'error', 'message' => $response['message'] ?? 'Unknown validation response', 'debug' => $response]);
    }

    /**
     * Complete endpoint — verify transaction and update DB
     * Called by redirect_url or after validation
     */
    public function complete()
    {
        $reference = $this->input->get('reference');
        if (!$reference) redirect(cn("add_funds/unsuccess"));

        // find pending transaction
        $transaction = $this->model->get('*', $this->tb_transaction_logs, [
            'transaction_id' => $reference,
            'status'         => 0,
            'type'           => $this->payment_type
        ]);

        if (!$transaction) redirect(cn("add_funds/unsuccess"));

        // Verify with Korapay
        $verify = $this->korapay_request("charges/{$reference}", [], "GET");

        if (
            isset($verify['status']) &&
            $verify['status'] == true &&
            isset($verify['data']['status']) &&
            $verify['data']['status'] == "success"
        ) {
            // Update transaction
            $txn_fee = ($this->take_fee_from_user && isset($verify['data']['fee']))
                ? $verify['data']['fee']
                : 0;

            $this->db->update($this->tb_transaction_logs, [
                'transaction_id' => $verify['data']['reference'],
                'txn_fee'        => $txn_fee,
                'status'         => 1,
            ], ['id' => $transaction->id]);

            // For bonus emails etc.
            $transaction->txn_fee = $txn_fee;
            $this->model->add_funds_bonus_email($transaction, $this->payment_id);

            set_session("transaction_id", $transaction->id);
            redirect(cn("add_funds/success"));
        }

        // Failed or abandoned
        $this->db->update($this->tb_transaction_logs, ['status' => -1], ['id' => $transaction->id]);
        redirect(cn("add_funds/unsuccess"));
    }

    /**
     * Encrypts payment data exactly as Korapay expects:
     * AES-256-GCM, 16-byte IV, 16-byte tag, hex(iv):hex(cipher):hex(tag)
     */
    private function encrypt_korapay_data($data)
    {
        if (!function_exists('openssl_encrypt')) return false;

        // Korapay gives a 32-character key in your DB (raw ASCII). Convert to 8-bit bytes.
        $rawKey = $this->encryption_key;
        $key = mb_convert_encoding($rawKey, '8bit', 'UTF-8');

        if (strlen($key) !== 32) {
            log_message('error', "Korapay encrypt_korapay_data: KEY NOT 32 BYTES (got " . strlen($key) . ")");
            return false;
        }

        $iv = openssl_random_pseudo_bytes(16);
        $jsonData = json_encode($data);
        $tag = '';

        $ciphertext = openssl_encrypt(
            $jsonData,
            'aes-256-gcm',
            $key,
            OPENSSL_RAW_DATA,
            $iv,
            $tag,
            "",
            16
        );

        if ($ciphertext === false) {
            log_message('error', 'Korapay encrypt_korapay_data: openssl_encrypt FAILED.');
            return false;
        }

        return bin2hex($iv) . ":" . bin2hex($ciphertext) . ":" . bin2hex($tag);
    }

    /**
     * Make Korapay API request and return decoded JSON.
     * Returns ['status' => false, 'message' => 'curl_error', 'curl_error' => $err] on cURL failure.
     */
    private function korapay_request($endpoint, $body = [], $method = 'POST') {
        $ch = curl_init();

        $headers = [
            "Authorization: Bearer " . $this->secret_key,
            "Content-Type: application/json"
        ];

        $opts = [
            CURLOPT_URL => $this->api_base . "/" . ltrim($endpoint, "/"),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_TIMEOUT => 60,
        ];

        if (strtoupper($method) === 'POST') {
            $opts[CURLOPT_POST] = true;
            $opts[CURLOPT_POSTFIELDS] = json_encode($body);
        } elseif (strtoupper($method) === 'GET') {
            // GET -> nothing to set (endpoint should include identifiers)
        }

        curl_setopt_array($ch, $opts);

        $result = curl_exec($ch);
        if ($result === false) {
            $err = curl_error($ch);
            curl_close($ch);
            log_message('error', 'Korapay request curl_error: ' . $err);
            return ['status' => false, 'message' => 'curl_error', 'curl_error' => $err];
        }

        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        $json = json_decode($result, true);
        if ($json === null && json_last_error() !== JSON_ERROR_NONE) {
            // invalid JSON: return raw result as message
            log_message('error', "Korapay request invalid json response: HTTP {$httpCode} - {$result}");
            return ['status' => false, 'message' => 'Invalid JSON response from Korapay', 'raw' => $result];
        }

        return $json;
    }

}

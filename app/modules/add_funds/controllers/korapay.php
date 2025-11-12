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
    public $debug_mode = true;

    public function __construct($payment = "") {
    parent::__construct();

    $this->load->model('add_funds_model', 'model');
    $this->load->helper('string');

    $this->tb_users            = USERS;
    $this->tb_transaction_logs = TRANSACTION_LOGS;
    $this->tb_payments         = PAYMENTS_METHOD;
    $this->payment_type        = 'korapay';

    if (empty($payment)) {
        $payment = $this->model->get('id, type, name, params', $this->tb_payments, ['type' => $this->payment_type]);
    }
    if (empty($payment)) exit("Error: Payment method 'korapay' not configured.");

    $this->payment_id = $payment->id;
    $params = json_decode($payment->params, true);
    $option = get_value($params, 'option');
    $this->take_fee_from_user = get_value($params, 'take_fee_from_user');

    $this->secret_key     = get_value($option, 'secret_key');
    $this->encryption_key = get_value($option, 'encryption_key');

    // AUTO DETECT MODE
    $is_sandbox = get_value($option, 'environment') === 'sandbox';
    $this->debug_mode = $is_sandbox;

    $this->api_base = $is_sandbox
        ? "https://api.sandbox.korapay.com/merchant/api/v1"
        : "https://api.korapay.com/merchant/api/v1";

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
        $session_txn_id = session("transaction_id"); // Internal DB transaction ID
        $get_reference = $this->input->get('reference'); // Our internal reference (e.g., makara_...)
        $get_korapay_reference = $this->input->get('transaction_reference'); // Korapay's reference

        if (!$session_txn_id && !$get_reference && !$get_korapay_reference) {
            redirect(cn("add_funds/unsuccess"));
        }

        $transaction = null;

        // 1. Prioritize finding by internal DB ID from session
        if ($session_txn_id) {
            $transaction = $this->model->get('*', $this->tb_transaction_logs, ['id' => $session_txn_id, 'status' => 0]);
        }

        // 2. Fallback to finding by reference from URL
        if (!$transaction) {
            $lookup_reference = $get_korapay_reference ?: $get_reference;
            if ($lookup_reference) {
                $transaction = $this->model->get('*', $this->tb_transaction_logs, [
                    'transaction_id' => $lookup_reference,
                    'status'         => 0, // Must be pending
                ]);
            }
        }

        if (!$transaction) redirect(cn("add_funds/unsuccess"));
        log_message('debug', 'Korapay_Complete: Found pending transaction. Internal ID: ' . $transaction->id . ', External Ref: ' . $lookup_reference);
        
        $lookup_reference = $transaction->transaction_id;

        // Verify with Korapay
        $verify = $this->korapay_request("charges/{$lookup_reference}", [], "GET");

        if (
            isset($verify['status']) &&
            $verify['status'] == true &&
            isset($verify['data']['status']) &&
            $verify['data']['status'] == "success"
        ) { 
            log_message('debug', 'Korapay_Complete: Korapay verification successful for Ref: ' . $lookup_reference . '. Response: ' . json_encode($verify));
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
            log_message('debug', 'Korapay_Complete: DB updated to status 1 for Internal ID: ' . $transaction->id);

            set_session("transaction_id", $transaction->id);
            redirect(cn("add_funds/success"));
        }
        log_message('debug', 'Korapay_Complete: Korapay verification FAILED or not successful for Ref: ' . $lookup_reference . '. Response: ' . json_encode($verify));

        // Failed or abandoned
        $this->db->update($this->tb_transaction_logs, ['status' => -1], ['id' => $transaction->id]);
        redirect(cn("add_funds/unsuccess"));
    }

    /**
     * Create a bank transfer payment request.
     *
     * Returns JSON with virtual account details for the user to pay.
     */
    public function charge_with_bank_transfer()
    {
        _is_ajax(post('module') ?? 'add_funds');

        $amount = (double)post("amount");
        $fee = 50; // Your fixed fee
        $total_amount = $amount + $fee;

        if (!$amount || $amount <= 0) {
            ms(['status' => 'error', 'message' => 'Invalid amount.']);
        }
        if (!$this->secret_key) {
            ms(['status' => 'error', 'message' => 'Korapay configuration missing.']);
        }

        try {
            $reference = 'makara_bank_' . bin2hex(random_bytes(7));
        } catch (\Throwable $e) {
            $reference = 'makara_bank_' . uniqid() . random_string('alnum', 4);
        }

        $user_info = session('user_current_info');
        $payload = [
            "reference" => $reference,
            "amount"    => $total_amount,
            "currency"  => $this->currency_code,
            "narration" => "Add funds to account",
            "customer"  => [
                "name"  => trim(($user_info['first_name'] ?? '') . ' ' . ($user_info['last_name'] ?? '')),
                "email" => $user_info['email'] ?? ''
            ]
        ];

        $response = $this->korapay_request("charges/bank-transfer", $payload);
        log_message('debug', 'Korapay Bank Transfer Response: ' . json_encode($response));


        $debug = $this->debug_mode ? [
            "payload" => $payload,
            "response" => $response
        ] : null;

        if (!isset($response['status']) || $response['status'] !== true || !isset($response['data']['bank_account'])) {
            ms([
                'status'  => 'error',
                'message' => $response['message'] ?? "Failed to generate bank account.",
                'debug'   => $debug
            ]);
        }

        // Save PENDING transaction
        $this->db->insert($this->tb_transaction_logs, [
            "ids"            => ids(),
            "uid"            => session("uid"),
            "type"           => $this->payment_type . '_bank', // Differentiate from card
            "transaction_id" => $reference,
            "amount"         => $amount,
            "txn_fee"        => $fee,
            "status"         => 0, // Pending
            "created"        => NOW,
        ]);

        $account_details = $response['data']['bank_account'];
        ms([
            'status'          => 'success',
            'message'         => 'Bank account details generated successfully.',
            'account_details' => [
                'bank_name'      => $account_details['bank_name'],
                'account_number' => $account_details['account_number'],
                'account_name'   => $account_details['account_name'],
                'amount'         => $total_amount,
                'reference'      => $reference, // The reference is now inside bank_account
                'expires_at'     => $account_details['expiry_date_in_utc'] ?? null
            ],
            'debug' => $debug
        ]);
    }

    /**
     * Simulate a successful bank transfer for testing.
     * This should only be callable in debug/sandbox mode.
     */
    public function simulate_bank_transfer_success()
    {
        _is_ajax(post('module') ?? 'add_funds');

        // Security: Ensure this can only run in debug mode.
        if (!$this->debug_mode) {
            ms(['status' => 'error', 'message' => 'This action is only available in test mode.']);
        }

        $reference = post('reference');
        if (!$reference) {
            ms(['status' => 'error', 'message' => 'Transaction reference is missing.']);
        }

        // Find the pending transaction
        $transaction = $this->model->get('*', $this->tb_transaction_logs, [
            'transaction_id' => $reference,
            'status'         => 0, // Pending
        ]);

        if (!$transaction) {
            ms(['status' => 'error', 'message' => 'Pending transaction not found.']);
        }

        // Mark transaction as successful
        $this->db->update($this->tb_transaction_logs, ['status' => 1], ['id' => $transaction->id]);

        // Add funds to user's balance
        $this->model->add_funds_bonus_email($transaction, $this->payment_id);

        set_session("transaction_id", $transaction->id);
        ms(['status' => 'success', 'message' => 'Test credit applied successfully.', 'redirect_url' => cn('add_funds/success')]);
    }

    /**
     * Handle incoming webhooks from Korapay.
     */
    // public function webhook()
    // {
    //     // 1. Get signature from header
    //     $signature = $_SERVER['HTTP_X_KORAPAY_SIGNATURE'] ?? '';
    //     if (!$signature) {
    //         http_response_code(401);
    //         exit('No signature');
    //     }

    //     // 2. Get raw request body
    //     $payload = file_get_contents('php://input');

    //     // 3. Verify signature
    //     $hash = hash_hmac('sha256', $payload, $this->secret_key);
    //     if (!hash_equals($hash, $signature)) {
    //         http_response_code(401);
    //         exit('Invalid signature');
    //     }

    //     // 4. Decode payload
    //     $data = json_decode($payload, true);
    //     if (json_last_error() !== JSON_ERROR_NONE) {
    //         http_response_code(400);
    //         exit('Invalid JSON payload');
    //     }

    //     // 5. Check event type
    //     if (isset($data['event']) && $data['event'] === 'charge.success') {
    //         $charge_data = $data['data'];
    //         $reference = $charge_data['reference'] ?? null;

    //         if (!$reference) {
    //             http_response_code(400);
    //             exit('No reference in payload');
    //         }

    //         // 6. Find pending transaction
    //         $transaction = $this->model->get('*', $this->tb_transaction_logs, [
    //             'transaction_id' => $reference,
    //             'status'         => 0 // Look for pending
    //         ]);

    //         if ($transaction) {
    //             // 7. Verify amount matches
    //             $paid_amount = (double)$charge_data['amount'];
    //             if ($paid_amount >= (double)$transaction->amount) {
    //                 // 8. Update transaction
    //                 $txn_fee = ($this->take_fee_from_user && isset($charge_data['fee']))
    //                     ? $charge_data['fee']
    //                     : 0;

    //                 $this->db->update($this->tb_transaction_logs, [
    //                     'status'  => 1, // Success
    //                     'txn_fee' => $txn_fee,
    //                 ], ['id' => $transaction->id]);

    //                 // 9. Add funds to user balance
    //                 $transaction->txn_fee = $txn_fee;
    //                 $this->model->add_funds_bonus_email($transaction, $this->payment_id);

    //                 log_message('debug', "Korapay webhook: Successfully processed reference {$reference}.");
    //             } else {
    //                 log_message('error', "Korapay webhook: Amount mismatch for reference {$reference}. Expected {$transaction->amount}, got {$paid_amount}.");
    //             }
    //         } else {
    //             log_message('warning', "Korapay webhook: Received success for an unknown or already processed transaction reference {$reference}.");
    //         }
    //     }

    //     // 10. Acknowledge receipt
    //     http_response_code(200);
    //     echo 'Webhook received.';
    // }

    public function webhook()
{
    // 1️⃣ Get the raw payload
    $payload = file_get_contents('php://input');
    $data = json_decode($payload, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        log_message('error', 'Korapay Webhook: Invalid JSON payload received.');
        http_response_code(400);
        exit('Invalid JSON payload');
    }

    // ⚠️ IMPORTANT: The current webhook implementation explicitly skips signature verification.
    // For production environments, it is CRITICAL to implement signature verification
    // using $_SERVER['HTTP_X_KORAPAY_SIGNATURE'] and $this->secret_key.
    // 2️⃣ Log the payload to confirm Korapay is calling your endpoint (and for debugging)
    log_message('debug', 'Korapay Webhook Payload: ' . $payload);

    // 3️⃣ Handle successful payments
    if (isset($data['event']) && $data['event'] === 'charge.success') {
        $charge_data = $data['data'];
        $reference = $charge_data['reference'] ?? null;

        if ($reference) {
            $transaction = $this->model->get('*', $this->tb_transaction_logs, [
                'transaction_id' => $reference,
                'status'         => 0
            ]);

            if ($transaction) {
                log_message('debug', 'Korapay Webhook: Found pending transaction for reference ' . $reference . '. Current status: ' . $transaction->status);
                $paid_amount = (double)$charge_data['amount'];
                if ($paid_amount >= (double)$transaction->amount) {
                    // $txn_fee = ($this->take_fee_from_user && isset($charge_data['fee']))
                    //     ? $charge_data['fee']
                    //     : 0;
                    $note = ($this->take_fee_from_user && isset($charge_data['fee']))
                        ? $charge_data['fee']
                        : 0;
                    $txn_fee = 50;

                    $this->db->update($this->tb_transaction_logs, [
                        'status'  => 1,
                        'txn_fee' => $txn_fee,
                        'note' => $note,
                    ], ['id' => $transaction->id]);

                    $transaction->txn_fee = $txn_fee;
                    $this->model->add_funds_bonus_email($transaction, $this->payment_id);

                    log_message('debug', "Korapay webhook (no-signature): Processed {$reference}");
                } else {
                    log_message('error', "Korapay webhook (no-signature): Amount mismatch for {$reference}");
                }
            } else {
                log_message('warning', "Korapay webhook (no-signature): Unknown reference {$reference}");
            }
        }
    }

    // 4️⃣ Always respond with 200 OK so Korapay stops retrying
    http_response_code(200);
    echo 'Webhook received (no signature check).';
}

    /**
     * AJAX endpoint to check the status of a transaction by its reference.
     * Used for client-side polling for bank transfers.
     */
    public function check_transaction_status()
    {
        _is_ajax(); // Ensure it's an AJAX request

        $reference = post('reference');
        if (!$reference) {
            ms(['status' => 'error', 'message' => 'Reference is missing.']);
        }

        $transaction = $this->model->get('*', $this->tb_transaction_logs, [
            'transaction_id' => $reference,
            'uid'            => session('uid'),
        ]);

        if ($transaction) {
            ms([
                'status' => 'success', 
                'transaction_status' => $transaction->status,
                'transaction_id' => $transaction->transaction_id // Return the actual transaction_id
            ]);
        } else {
            ms(['status' => 'error', 'message' => 'Transaction not found.']);
        }
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
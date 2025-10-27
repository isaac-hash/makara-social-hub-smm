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

    public function __construct($payment = "") {
        parent::__construct();
        $this->load->model('add_funds_model', 'model');

        $this->tb_users            = USERS;
        $this->tb_transaction_logs = TRANSACTION_LOGS;
        $this->tb_payments         = PAYMENTS_METHOD;
        $this->payment_type        = 'korapay';

        // If $payment object is not passed in, then fetch it from the DB.
        if (empty($payment)) {
            $payment = $this->model->get('id, type, name, params', $this->tb_payments, ['type' => $this->payment_type]);
        }

        if (empty($payment)) exit("Error: Payment method 'korapay' not found or configured.");

        $this->payment_id         = $payment->id;
        $params                   = json_decode($payment->params, true);
        $option                   = get_value($params, 'option');
        $this->take_fee_from_user = get_value($params, 'take_fee_from_user');

        $this->secret_key         = get_value($option, 'secret_key');
        $this->encryption_key     = get_value($option, 'encryption_key');
        $this->api_base           = "https://api.korapay.com/merchant/api/v1";

        $this->currency_code = get_option("currency_code", "NGN");
        if (!in_array($this->currency_code, ['NGN', 'USD', 'GHS'])) {
            $this->currency_code = 'NGN';
        }
    }

    public function index() {
        redirect(cn("add_funds"));
    }

    public function create_payment($data_payment = "") {
        // --- DEBUGGING BLOCK: START ---
        // To enable, set $enable_debug to true.
        $enable_debug = true; 
        if ($enable_debug) {
            $debug_data = [
                'status' => 'debug',
                'message' => 'KoraPay Debug Data. Disable in korapay.php for production.',
                'korapay_credentials' => [
                    'secret_key_loaded' => !empty($this->secret_key) ? 'Yes' : 'No',
                    'encryption_key_loaded' => !empty($this->encryption_key) ? 'Yes' : 'No',
                ],
                'form_data_received' => $data_payment,
            ];
            ms($debug_data); // Send debug data as JSON and exit
        }
        // --- DEBUGGING BLOCK: END ---
        _is_ajax($data_payment['module']);
        $amount = (double)$data_payment['amount'];

        // Get card details directly from POST
        $card_number    = post("card_number");
        $expiry_month   = post("expiry_month");
        $expiry_year    = post("expiry_year");
        $cvv            = post("cvv");
        
        if (!$card_number || !$expiry_month || !$expiry_year || !$cvv) {
            _validation('error', 'Please fill in all card details.');
        }

        if (!$amount) {
            _validation('error', lang('There_was_an_error_processing_your_request_Please_try_again_later'));
        }

        if (!$this->secret_key || !$this->encryption_key) {
            _validation('error', lang('this_payment_is_not_active_please_choose_another_payment_or_contact_us_for_more_detail'));
        }

        $user_info = session('user_current_info');
        $reference = 'makara_' . random_string('alnum', 12);

        $requestData = [
            'reference'    => $reference,
            'amount'       => $amount,
            'currency'     => $this->currency_code,
            'redirect_url' => cn("add_funds/korapay/complete"),
            'card'         => [
                'number'       => $card_number,
                'cvv'          => $cvv,
                'expiry_month' => $expiry_month,
                'expiry_year'  => $expiry_year,
            ],
            'customer'     => [
                'name'  => $user_info['first_name'] . ' ' . $user_info['last_name'],
                'email' => $user_info['email']
            ]
        ];

        $encrypted_data = $this->encrypt_korapay_data($requestData);
        if (!$encrypted_data) {
            _validation('error', 'Failed to encrypt payment data.');
        }

        $response = $this->korapay_request('charges/card', ['charge_data' => $encrypted_data]);

        if (isset($response['status']) && $response['status'] == true) {
            $data_tnx_log = [
                "ids"             => ids(),
                "uid"             => session("uid"),
                "type"            => $this->payment_type,
                "transaction_id"  => $reference,
                "amount"          => $amount,
                "status"          => 0,
                "created"         => NOW,
            ];
            $this->db->insert($this->tb_transaction_logs, $data_tnx_log);

            if (isset($response['data']['authorization']['mode']) && $response['data']['authorization']['mode'] == 'redirect') {
                ms(['status' => 'success', 'redirect_url' => $response['data']['authorization']['redirect_url']]);
            } else if (isset($response['data']['status']) && $response['data']['status'] == 'success') {
                ms(['status' => 'success', 'redirect_url' => cn("add_funds/korapay/complete?reference=" . $reference)]);
            } else {
                _validation('error', $response['message'] ?? 'An unknown error occurred.');
            }
        } else {
            _validation('error', $response['message'] ?? 'Failed to initiate payment.');
        }
    }

    public function complete() {
        $reference = $this->input->get('reference');
        if (!$reference) {
            redirect(cn("add_funds/unsuccess"));
        }

        $transaction = $this->model->get('*', $this->tb_transaction_logs, ['transaction_id' => $reference, 'status' => 0, 'type' => $this->payment_type]);
        if (!$transaction) {
            redirect(cn("add_funds/unsuccess"));
        }

        $verify = $this->korapay_request("charges/{$reference}", [], 'GET');

        if (isset($verify['status']) && $verify['status'] == true && isset($verify['data']['status']) && $verify['data']['status'] === 'success') {
            $data_tnx_log = [
                'transaction_id' => $verify['data']['reference'],
                'txn_fee'        => ($this->take_fee_from_user && isset($verify['data']['fee'])) ? $verify['data']['fee'] : 0,
                'status'         => 1,
            ];
            $this->db->update($this->tb_transaction_logs, $data_tnx_log, ['id' => $transaction->id]);

            if ($this->take_fee_from_user) {
                $transaction->txn_fee = $data_tnx_log['txn_fee'];
            } else {
                $transaction->txn_fee = 0;
            }
            $this->model->add_funds_bonus_email($transaction, $this->payment_id);

            set_session("transaction_id", $transaction->id);
            redirect(cn("add_funds/success"));
        } else {
            $this->db->update($this->tb_transaction_logs, ['status' => -1], ['id' => $transaction->id]);
            redirect(cn("add_funds/unsuccess"));
        }
    }

    private function encrypt_korapay_data($data) {
        if (!function_exists('openssl_encrypt')) return false;
        $encryptionKey = base64_decode($this->encryption_key);
        $iv = random_bytes(12);
        $jsonData = json_encode($data);
        $ciphertext = openssl_encrypt($jsonData, 'aes-256-gcm', $encryptionKey, OPENSSL_RAW_DATA, $iv, $tag);
        return base64_encode($iv . $ciphertext . $tag);
    }

    private function korapay_request($endpoint, $body, $method = 'POST') {
        $ch = curl_init();
        $headers = ['Authorization: Bearer ' . $this->secret_key, 'Content-Type: application/json'];
        $opts = [
            CURLOPT_URL            => $this->api_base . '/' . $endpoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER     => $headers,
        ];
        if ($method == 'POST') {
            $opts[CURLOPT_POST]       = true;
            $opts[CURLOPT_POSTFIELDS] = json_encode($body);
        }
        curl_setopt_array($ch, $opts);
        $response = curl_exec($ch);
        curl_close($ch);
        return json_decode($response, true);
    }
}

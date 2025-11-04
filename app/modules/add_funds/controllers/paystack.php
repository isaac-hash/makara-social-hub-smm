<?php
defined('BASEPATH') or exit('No direct script access allowed');

class paystack extends MX_Controller
{
    public $tb_users;
    public $tb_transaction_logs;
    public $tb_payments;
    public $tb_payments_bonuses;
    public $paystack;
    public $payment_type;
    public $payment_id;
    public $currency_code;
    public $mode;
    public $payment_lib;
    public $public_key;
    public $secret_key;
    public $take_fee_from_user;

    public function __construct($payment = "")
    {
        parent::__construct();
        $this->load->model('add_funds_model', 'model');

        $this->tb_users = USERS;
        $this->payment_type = 'paystack';
        $this->tb_transaction_logs = TRANSACTION_LOGS;
        $this->tb_payments = PAYMENTS_METHOD;
        $this->tb_payments_bonuses = PAYMENTS_BONUSES;
        $this->currency_code = get_option("currency_code", "USD");
        if ($this->currency_code == "") {
            $this->currency_code = 'USD';
        }

        if (!$payment) {
            $payment = $this->model->get('id, type, name, params', $this->tb_payments, ['type' => $this->payment_type]);
        }
        $this->payment_id = $payment->id;
        $params                   = $payment->params;
        $option                   = get_value($params, 'option');
        $this->mode               = get_value($option, 'environment');
        $this->take_fee_from_user = get_value($params, 'take_fee_from_user');
        //options
        $this->public_key         = get_value($option, 'public_key');
        $this->secret_key         = get_value($option, 'secret_key');
    }

    public function index()
    {
        redirect(cn("add_funds"));
    }

    /**
     * Create a pending transaction before sending the user to Paystack
     */
    public function ajax_create_transaction()
    {
        $amount = post("amount");
        $email  = post("email");
        $agree  = post("agree");

        if ($amount == "") {
            ms(['status' => 'error', 'message' => lang("Amount_is_required")]);
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            ms(['status' => 'error', 'message' => lang("invalid_email_format")]);
        }

        if (!$agree) {
            ms(['status' => 'error', 'message' => lang("please_agree_to_our_terms_of_services")]);
        }

        $payment_method = $this->model->get('id, params', $this->tb_payments, ['id' => $this->payment_id]);
        $min_amount = get_value($payment_method->params, 'min');

        if ($amount < $min_amount) {
            ms(['status' => 'error', 'message' => lang("minimum_amount_is") . " " . $min_amount]);
        }

        $txn_id = 'ps_' . uniqid() . '_' . time(); // More unique

        $data = [
            "ids"            => ids(),
            "uid"            => session('uid'),
            "type"           => $this->payment_type,
            "transaction_id" => $txn_id,
            "amount"         => $amount,
            "status"         => 0,
            "created"        => NOW,
        ];

        $this->db->insert($this->tb_transaction_logs, $data);
        $transaction_log_id = $this->db->insert_id();

        ms([
            'status' => 'success',
            'transaction_id' => $txn_id,
            'transaction_log_id' => $transaction_log_id
        ]);
    }

    public function complete($reference = "")
    {
        if ($reference == "") {
            redirect(cn("add_funds/unsuccess"));
        }

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.paystack.co/transaction/verify/" . $reference,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer " . $this->secret_key,
                "Cache-Control: no-cache",
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            redirect(cn("add_funds/unsuccess"));
        } else {
            $result = json_decode($response);
            if ($result->data->status == 'success') {
                $transaction = $this->model->get('*', $this->tb_transaction_logs, ['transaction_id' => $reference, 'status' => 0, 'type' => $this->payment_type]);
                if (!$transaction) {
                    redirect(cn("add_funds/unsuccess"));
                }

                $data_tnx_log = array(
                    // The transaction_id is already set, we just update the status
                    "status"         => 1,
                );
                $this->db->update($this->tb_transaction_logs, $data_tnx_log, ['id' => $transaction->id]);

                // Add funds to user balance
                $this->model->add_funds_bonus_email($transaction, $this->payment_id);

                set_session("transaction_id", $transaction->id);
                redirect(cn("add_funds/success"));
            } else {
                redirect(cn("add_funds/unsuccess"));
            }
        }
    }
}
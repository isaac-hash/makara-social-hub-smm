<?php
defined('BASEPATH') or exit('No direct script access allowed');

class add_funds extends My_UserController
{
    public $tb_users;
    public $tb_transaction_logs;
    public $tb_payments;
    public $tb_payments_bonuses;
    public $module;
    public $module_icon;

    public function __construct()
    {
        parent::__construct();
        $this->load->model(get_class($this) . '_model', 'model');
        $this->module                       = get_class($this);
        $this->tb_users                     = USERS;
        $this->tb_transaction_logs          = TRANSACTION_LOGS;
        $this->tb_payments                  = PAYMENTS_METHOD;
        $this->tb_payments_bonuses          = PAYMENTS_BONUSES;
    }

    public function index()
    {
        /*----------  Get Payment Gate Way for user  ----------*/
        $items_payments = $this->model->fetch('type, name, id, params', $this->tb_payments, ['status' => 1], 'sort', 'ASC', '', '', true);
        $item_users = $this->model->get('settings', $this->tb_users, ['id' => session('uid')], '', '', true);
        $limit_payments = get_value($item_users['settings'], 'limit_payments');
        
        if (!empty($items_payments) && is_array($items_payments)) {
            if (empty($limit_payments)) {
                $active_payments = $items_payments;
            } else {
                $limit_payments = json_decode(json_encode($limit_payments), true);
                $active_payments = array_filter($items_payments, function($item) use ($limit_payments) {
                    $type = $item['type'] ?? '';
                    return !isset($limit_payments[$type]) || $limit_payments[$type] == 1;
                });
            }
        }

        // Manually load Korapay payment to check its debug mode status
        $korapay_payment = $this->model->get('id, type, name, params', $this->tb_payments, ['type' => 'korapay']);
        $korapay_debug_mode = false;
        if ($korapay_payment) {
            $params = json_decode($korapay_payment->params, true);
            $option = get_value($params, 'option');
            if (get_value($option, 'environment') === 'sandbox') {
                $korapay_debug_mode = true;
            }
        }
      
        $data = array(
            "module"          => get_class($this),
            "active_payments" => $active_payments,
            "currency_code"   => get_option("currency_code", 'USD'),
            "currency_symbol" => get_option("currency_symbol", '$'),
            // Pass the debug mode status to the view
            "korapay_debug_mode" => $korapay_debug_mode,
        );
        $this->template->set_layout('user');
        $this->template->build('index', $data);
    }

    public function process_old()
    {
        _is_ajax($this->module);
        $payment_id     = (int)post("payment_id");
        
        $amount         = (double)post("amount");
        $agree = post("agree");
        if ($amount == "") {
            ms(array(
                "status" => "error",
                "message" => lang("amount_is_required"),
            ));
        }

        if ($amount < 0) {
            ms(array(
                "status" => "error",
                "message" => lang("amount_must_be_greater_than_zero"),
            ));
        }

        /*----------  Check payment method  ----------*/
        $payment = $this->model->get('id, type, name, params', $this->tb_payments, ['id' => $payment_id]);
        if (!$payment) {
            _validation('error', lang('There_was_an_error_processing_your_request_Please_try_again_later'));
        }

        $min_payment = get_value($payment->params, 'min');
        $max_payment = get_value($payment->params, 'max');

        if ($amount < $min_payment) {
            _validation('error', lang("minimum_amount_is") . " " . $min_payment);
        }

        if ($max_payment > 0 && $amount > $max_payment) {
            _validation('error', 'Maximal amount is' . " " . $max_payment);
        }

        if (!$agree) {
            _validation('error', lang("you_must_confirm_to_the_conditions_before_paying"));
        }

        // Collect all POST data for the payment gateway
        $data_payment = array(
            "module"       => get_class($this),
            "amount"       => $amount,
            // Add card details for gateways that need them
            "card_number"  => post("card_number"),
            "expiry_month" => post("expiry_month"),
            "expiry_year"  => post("expiry_year"),
            "cvv"          => post("cvv"),
            // For Stripe
            "stripeToken"  => post("stripeToken"),
        );
        $payment_method = $payment->type;
        require_once APPPATH . 'modules/add_funds/controllers/' . $payment_method . '.php';
        $payment_module = new $payment_method($payment);
        $payment_module->create_payment($data_payment);

    }
    public function process()
    {
        // STEP 0 — Basic debug wrapper
        try {

            // ===== STEP 1: Check AJAX module =====
            // echo json_encode(["debug_step" => "STEP 1", "module_received" => $this->module]);
            // _is_ajax($this->module);

            // ===== STEP 2: POST values =====
            $payment_id = (int)post("payment_id");
            $amount     = (double)post("amount");
            $agree      = post("agree");

            // echo json_encode([
            //     "debug_step" => "STEP 2",
            //     "payment_id" => $payment_id,
            //     "amount" => $amount,
            //     "agree" => $agree,
            //     "raw_post" => $_POST
            // ]);

            if ($amount == "") {
                // echo json_encode(["error" => "amount_is_required"]);
                ms(["error" => "amount_is_required"]);
            }
            if ($amount < 0) {
                // echo json_encode(["error" => "amount_must_be_greater_than_zero"]);
                ms(["error" => "amount_must_be_greater_than_zero"]);
            }

            // ===== STEP 3: Load payment method from DB =====
            $payment = $this->model->get(
                'id, type, name, params',
                $this->tb_payments,
                ['id' => $payment_id]
            );

            // echo json_encode([
            //     "debug_step" => "STEP 3",
            //     "payment_from_db" => $payment
            // ]);

            if (!$payment) {
                // echo json_encode(["error" => "Payment ID not found"]);
                ms(["error" => "Payment ID not found"]);
            }

            // ===== STEP 4: Validate min/max =====
            $min_payment = get_value($payment->params, 'min');
            $max_payment = get_value($payment->params, 'max');

            // echo json_encode([
            //     "debug_step" => "STEP 4",
            //     "min_payment" => $min_payment,
            //     "max_payment" => $max_payment
            // ]);

            if ($amount < $min_payment) {
                // echo json_encode(["error" => "Less than min: $min_payment"]);
                ms(["error" => "Less than min: $min_payment"]);
            }
            if ($max_payment > 0 && $amount > $max_payment) {
                // echo json_encode(["error" => "More than max: $max_payment"]);
                ms(["error" => "More than max: $max_payment"]);
            }
            if (!$agree) {
                // echo json_encode(["error" => "Must agree to terms"]);
                ms(["error" => "Must agree to terms"]);
            }

            // ===== STEP 5: Build gateway data =====
            $data_payment = [
                "module"       => get_class($this),
                "amount"       => $amount,
                "card_number"  => post("card_number"),
                "expiry_month" => post("expiry_month"),
                "expiry_year"  => post("expiry_year"),
                "cvv"          => post("cvv"),
                "stripeToken"  => post("stripeToken"),
            ];

            // echo json_encode([
            //     "debug_step" => "STEP 5",
            //     "data_payment_array" => $data_payment
            // ]);

            // ===== STEP 6: Load gateway file =====
            $payment_method = $payment->type;
            $file_path = APPPATH . 'modules/add_funds/controllers/' . $payment_method . '.php';

            // echo json_encode([
            //     "debug_step" => "STEP 6",
            //     "gateway_file_path" => $file_path,
            //     "file_exists" => file_exists($file_path)
            // ]);

            if (!file_exists($file_path)) {
                // echo json_encode(["error" => "Gateway file does NOT exist at: ".$file_path]);
                ms(["error" => "Gateway file does NOT exist at: ".$file_path]);
            }

            require_once $file_path;

            // ===== STEP 7: Instantiate gateway controller =====
            // echo json_encode([
            //     "debug_step" => "STEP 7",
            //     "class_name_to_instantiate" => $payment_method,
            //     "class_exists" => class_exists($payment_method)
            // ]);

            if (!class_exists($payment_method)) {
                // echo json_encode(["error" => "Class '$payment_method' does NOT exist inside file"]);
                ms(["error" => "Class '$payment_method' does NOT exist inside file"]);
            }

            $payment_module = new $payment_method($payment);

            // echo json_encode([
            //     "debug_step" => "STEP 8",
            //     "gateway_object_created" => get_class($payment_module)
            // ]);

            // ===== STEP 9: Call gateway =====
            $payment_module->create_payment($data_payment);

            // echo json_encode([
            //     "debug_step" => "STEP 9",
            //     "status" => "create_payment CALLED successfully"
            // ]);

        } catch (Throwable $e) {

            // CATCH ANY 500 ERROR & RETURN JSON INSTEAD
            // echo json_encode([
            //     "status" => "fatal_error",
            //     "message" => $e->getMessage(),
            //     "file" => $e->getFile(),
            //     "line" => $e->getLine(),
            //     "trace" => $e->getTraceAsString()
            // ]);
            ms(["status" => "fatal_error", "message" => $e->getMessage()]);

        }
    }

    public function upload_receipt()
    {
        _is_ajax($this->module);

        $amount = (double)post("amount");

        if ($amount <= 0) {
            ms(["status" => "error", "message" => "Please enter a valid amount."]);
        }

        if (empty($_FILES['receipt']['name'])) {
            // echo json_encode(["file" => ])
            ms(["status" => "error", "message" => "Please select a receipt file to upload."]);
        }

        $upload_path = FCPATH . "assets/uploads/receipts/";
        if (!is_dir($upload_path)) {
            mkdir($upload_path, 0755, true);
        }

        $config['upload_path']   = $upload_path;
        $config['allowed_types'] = 'gif|jpg|jpeg|png|pdf';
        $config['max_size']      = 2048; // 2MB
        $config['encrypt_name']  = TRUE;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('receipt')) {
            ms(["status" => "error", "message" => strip_tags($this->upload->display_errors())]);
        }

        $upload_data = $this->upload->data();
        $receipt_path = 'assets/uploads/receipts/' . $upload_data['file_name'];

        $data = [
            'ids'          => ids(),
            'user_id'      => session('uid'),
            'amount'       => $amount,
            'receipt_path' => $receipt_path,
            'status'       => 'pending',
            'created_at'   => NOW,
        ];

        $this->db->insert('manual_payment_receipts', $data);

        ms([
            "status"  => "success",
            "message" => "Receipt uploaded successfully. We will review it and credit your account shortly.",
        ]);
    }


    public function success()
    {
        $transaction = null;
        $transaction_id_from_get = $this->input->get('transaction_id');
        $transaction_id_from_session = session("transaction_id");

        // Prioritize transaction_id from GET parameter (used by Korapay bank transfer polling)
        if ($transaction_id_from_get) {
            $transaction = $this->model->get("*", $this->tb_transaction_logs, ['transaction_id' => $transaction_id_from_get, 'uid' => session('uid')], '', '', true);
        }

        // Fallback to internal DB ID from session (used by most gateways)
        if (!$transaction && $transaction_id_from_session) {
            $transaction = $this->model->get("*", $this->tb_transaction_logs, ['id' => $transaction_id_from_session, 'uid' => session('uid')], '', '', true);
        }

        // If no transaction is found by either method, redirect to unsuccess.
        if (empty($transaction)) {
            redirect(cn("add_funds/unsuccess"));
        }

        // Check if transaction exists and is successful (status == 1)
        if (!empty($transaction) && $transaction->status == 1) {
            $data = array(
                "module" => get_class($this),
                "transaction" => $transaction,
            );
            $this->template->set_layout('user');
            $this->template->build('payment_successfully', $data);
        } else {
            redirect(cn("add_funds"));
        }
    }

    public function unsuccess()
    {
        $data = array(
            "module" => get_class($this),
        );
        $this->template->set_layout('user');
        $this->template->build('payment_unsuccessfully', $data);
    }
}

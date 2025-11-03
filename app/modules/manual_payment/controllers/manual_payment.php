<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class manual_payment extends MX_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('manual_payment_model', 'manual_payment');
    }

    public function index()
    {
        // User-facing page to show their payment receipts
        $data = [
            'receipts' => $this->manual_payment->get_receipts_by_user(session('uid'))
        ];
        $this->template->build('index', $data);
    }

    public function admin()
    {
        // Admin-facing page to show all payment receipts
        $data = [
            'receipts' => $this->manual_payment->get_all_receipts()
        ];
        $this->template->build('admin', $data);
    }
}

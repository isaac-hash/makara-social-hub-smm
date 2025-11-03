<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Receipts extends My_AdminController {

    public function __construct()
    {
        parent::__construct();
        $this->load->model(get_class($this).'_model', 'main_model');
        if (!is_current_logged_staff()) redirect(admin_url('logout'));

        $this->controller_name   = strtolower(get_class($this));
        $this->controller_title  = ucfirst(str_replace('_', ' ', get_class($this)));
        $this->path_views        = "receipts";
        $this->params            = [];

        $this->columns = [
            "user"           => ['name' => 'User', 'class' => ''],
            "amount"         => ['name' => 'Amount', 'class' => 'text-center'],
            "receipt"        => ['name' => 'Receipt', 'class' => 'text-center'],
            "status"         => ['name' => 'Status', 'class' => 'text-center'],
            "created"        => ['name' => 'Created', 'class' => 'text-center'],
            "actions"        => ['name' => 'Actions', 'class' => 'text-center'],
        ];
    }

    public function index()
    {
        $page        = (int)get("p");
        $page        = ($page > 0) ? ($page - 1) : 0;
        $limit_per_page = 15;

        $this->params = [
            'pagination' => [
                'limit' => $limit_per_page,
                'start' => $page * $limit_per_page,
            ],
        ];

        $data = [
            "controller_name"   => $this->controller_name,
            "params"            => $this->params,
            "columns"           => $this->columns,
            "items"             => $this->main_model->list_items($this->params, ['task' => 'list-items']),
            "pagination"        => create_pagination(['base_url' => admin_url($this->controller_name), 'per_page' => $limit_per_page, 'total_rows' => $this->main_model->count_items($this->params, ['task' => 'count-items-for-pagination'])]),
        ];
        $this->template->build($this->path_views . '/index', $data);
    }

    public function view($ids = "")
    {
        if (!is_ajax_call()) {
            redirect(admin_url($this->controller_name));
        }
        $item = $this->main_model->get_item(['ids' => $ids], ['task' => 'get-item']);
        if (!$item) {
            ms(['status' => 'error', 'message' => 'Receipt not found.']);
        }
        $data = [
            'item' => $item,
        ];
        $this->load->view($this->path_views . '/view', $data);
    }

    public function ajax_update_status($status = "", $ids = "")
{
    // Block direct access
    if (!is_ajax_call()) {
        redirect(admin_url($this->controller_name));
    }

    $ids = trim($ids);

    // === Validate Status ===
    if (!in_array($status, ['approved', 'rejected'])) {
        ms(['status' => 'error', 'message' => 'Invalid status']);
        exit;
    }

    // === Validate ID (32-char hash) ===
    if (empty($ids) || !preg_match('/^[a-f0-9]{32}(,[a-f0-9]{32})*$/', $ids)) {
        ms(['status' => 'error', 'message' => 'Invalid receipt ID']);
        exit;
    }

    // === Update via Model ===
    $result = $this->main_model->update_status($ids, $status);

    // === Send JSON Response (ms() handles exit) ===
    ms([
        'status'  => $result ? 'success' : 'error',
        'message' => $result ? 'Receipt status updated successfully'
                            : 'Failed: Receipt not found, already processed, or database error'
    ]);

    // NO redirect() here — ms() already exits
    // NO exit needed — ms() does it
}
}

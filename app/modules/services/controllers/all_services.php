<?php
defined('BASEPATH') or exit('No direct script access allowed');

class all_services extends My_UserController
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(get_class($this) . '_model', 'main_model');

        $this->controller_name = strtolower(get_class($this));
        $this->controller_title = ucfirst(str_replace('_', ' ', get_class($this)));
        $this->path_views = "";
        $this->params = [];
        $this->columns = [
            "id" => ['name' => 'ID', 'class' => 'text-center'],
            "name" => ['name' => lang('Name'), 'class' => 'text-center'],
            "price" => ['name' => lang("rate_per_1000") . "(" . get_option("currency_symbol", "") . ")", 'class' => 'text-center'],
            "min" => ['name' => lang("min"), 'class' => 'text-center'],
            "max" => ['name' => lang("max"), 'class' => 'text-center'],
            "desc" => ['name' => lang("Description"), 'class' => 'text-center'],
        ];
    }

    public function index()
    {
        if (!session('uid') && get_option("enable_service_list_no_login") != 1) {
            redirect(cn());
        }

        $this->params = [
            'cate_id' => 0,
        ];
        $items = $this->main_model->list_items($this->params, ['task' => 'list-items', 'no_group' => true]);
        $data = array(
            "controller_name" => $this->controller_name,
            "params" => $this->params,
            "columns" => $this->columns,
            "items" => $items,
        );
        if (session('uid')) {
            $this->template->set_layout('user');
            $this->template->build("all_services", $data);
        } else {
            $this->template->set_layout('general_page');
            $this->template->build("all_services", $data);
        }
    }
}

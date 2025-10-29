<?php
defined('BASEPATH') or exit('No direct script access allowed');

class profile extends My_UserController
{
    public $tb_users;
    public $controller_name;
    public $module_icon;

    public function __construct()
    {
        parent::__construct();
        $this->load->model(get_class($this) . '_model', 'model');
        $this->controller_name = get_class($this);
        $this->tb_users        = USERS;
    }

    public function index()
    {
        $data = [
            "module" => get_class($this),
            "item"   => $this->model->get('*', $this->tb_users, ['id' => session('uid')], '', '', true),
        ];
        // $this->template->set_layout('user');
        $this->template->set_layout('user');
        $this->template->build('index', $data);
    }

   
}

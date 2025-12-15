<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class tutorials extends MX_Controller {
    public $tb_users;
    public $tb_categories;
    public $tb_services;
    public $columns;
    public $module_name;
    public $module_icon;

    public function __construct(){
        parent::__construct();
        $this->load->model(get_class($this).'_model', 'model');
        //Config Module
        $this->tb_categories = CATEGORIES;
        $this->tb_services   = SERVICES;
    }

    public function index(){
        $data = array(
            "module"        => get_class($this),
            "items"         => $this->model->list_items(null, ['task' => 'list-items']),
        );

        $this->template->set_layout('user');
        $this->template->build('index', $data);
    }
}

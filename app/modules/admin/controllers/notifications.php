<?php
defined('BASEPATH') or exit('No direct script access allowed');

class notifications extends My_AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('notifications/notifications_model', 'main_model');
        if (!is_current_logged_staff()) redirect(admin_url('logout'));
        
        $this->controller_name   = strtolower(get_class($this));
        $this->controller_title  = ucfirst(str_replace('_', ' ', get_class($this)));
        $this->path_views        = "notifications";
        $this->params            = [];
    }

    public function index()
    {
        $data = [
            "controller_name"   => $this->controller_name,
        ];
        $this->template->build($this->path_views . '/index', $data);
    }

    public function send()
    {
        if (!is_ajax_call()) {
            redirect(admin_url($this->controller_name));
        }

        $this->form_validation->set_rules('uids', 'User', 'trim|required|xss_clean');
        $this->form_validation->set_rules('subject', 'Subject', 'trim|required|xss_clean');
        $this->form_validation->set_rules('message', 'Message', 'trim|required|xss_clean'); // Allow HTML if needed, but xss_clean helps basic sanitization

        if (!$this->form_validation->run()) {
            ms(['status' => 'error', 'message' => validation_errors()]);
        }

        $result = $this->main_model->send_manual_notification(post());
        ms($result);
    }
}

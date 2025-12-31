<?php
defined('BASEPATH') or exit('No direct script access allowed');

class sms extends My_AdminController
{
    public function __construct()
    {
        parent::__construct();
        if (!is_current_logged_staff()) {
            redirect(admin_url('logout'));
        }

        $this->load->library('Brevo_sms');
        $this->controller_name = strtolower(get_class($this));
        $this->controller_title = 'SMS';
        $this->path_views = "sms";
    }

    /**
     * Send SMS form page
     */
    public function index()
    {
        $data = [
            "controller_name" => $this->controller_name,
            "api_configured" => !empty(get_option('brevo_api_key', ''))
        ];
        $this->template->build($this->path_views . '/index', $data);
    }

    /**
     * AJAX endpoint to send SMS
     */
    public function send()
    {
        if (!is_ajax_call()) {
            redirect(admin_url($this->controller_name));
        }

        $this->form_validation->set_rules('recipient', 'Phone Number', 'trim|required|xss_clean');
        $this->form_validation->set_rules('content', 'Message', 'trim|required|xss_clean|max_length[160]');
        $this->form_validation->set_rules('sender', 'Sender', 'trim|required|xss_clean|max_length[11]');

        if (!$this->form_validation->run()) {
            ms(['status' => 'error', 'message' => validation_errors()]);
        }

        $recipient = $this->input->post('recipient');
        $content = $this->input->post('content');
        $sender = $this->input->post('sender');
        
        // Build webhook URL
        $webUrl = base_url('sms_webhook');

        $result = $this->brevo_sms->send($recipient, $content, $sender, $webUrl);
        ms($result);
    }

    /**
     * SMS activity history page
     */
    public function history()
    {
        $days = $this->input->get('days') ?? 30;
        
        $aggregated = $this->brevo_sms->get_aggregated_report($days);
        $events = $this->brevo_sms->get_events(50, 0);

        $data = [
            "controller_name" => $this->controller_name,
            "aggregated" => $aggregated['status'] === 'success' ? $aggregated['data'] : [],
            "events" => $events['status'] === 'success' ? $events['data'] : [],
            "days" => $days,
            "api_configured" => !empty(get_option('brevo_api_key', ''))
        ];
        
        $this->template->build($this->path_views . '/history', $data);
    }

    /**
     * Webhook endpoint for Brevo delivery events
     */
    public function webhook()
    {
        $input = file_get_contents('php://input');
        log_message('info', 'Brevo SMS Webhook received: ' . $input);
        http_response_code(200);
        echo json_encode(['status' => 'ok']);
        exit;
    }
}

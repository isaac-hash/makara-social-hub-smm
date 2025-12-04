<?php
defined('BASEPATH') or exit('No direct script access allowed');

class promo extends My_AdminController
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(get_class($this) . '_model', 'main_model');
        if (!is_current_logged_staff()) {
            redirect(admin_url('logout'));
        }

        $this->controller_name = strtolower(get_class($this));
        $this->controller_title = ucfirst(str_replace('_', ' ', get_class($this)));
        $this->path_views = "promo";
        $this->params = [];

        $this->columns = array(
            "description" => ['name' => 'description', 'class' => 'text-center'],
            "title" => ['name' => 'Title', 'class' => 'text-center'],
            "image" => ['name' => 'Image', 'class' => 'border-radius'],
            "expiry" => ['name' => 'Expiry', 'class' => 'text-center'],
            "status" => ['name' => 'status', 'class' => 'text-center'],
        );
    }
        public function index()
        {
            $items = $this->main_model->list_items(null, ['task' => 'list-items-view-news']);
            
            $data = [
                "controller_name" => $this->controller_name,
                "columns" => $this->columns,
                "items" => $items,
            ];
            $this->template->build($this->path_views . "/view", $data);
        }

    public function store()
    {
        if (!is_ajax_call()) {
            redirect(admin_url($this->controller_name));
        }

        // Form validation
        $this->form_validation->set_rules('title', 'Title', 'trim|required|xss_clean');
        $this->form_validation->set_rules('description', 'Description', 'trim|xss_clean');
        $this->form_validation->set_rules('alt', 'Alt Text', 'trim|xss_clean');
        $this->form_validation->set_rules('status', 'Status', 'trim|required|in_list[0,1]|xss_clean');

        if (!$this->form_validation->run()) {
            _validation('error', validation_errors());
        }

        // Check if file is uploaded
        if (empty($_FILES['promo']['name'])) {
            ms(["status" => "error", "message" => "Please select a promo image to upload."]);
        }

        // Permission check - Temporarily commented out for debugging
        // Uncomment this after setting up permissions in the admin panel for 'promo' controller
        // staff_check_role_permission($this->controller_name, 'add');

        $upload_promo_image_path = FCPATH . "assets/uploads/promo/";
        if (!is_dir($upload_promo_image_path)) {
            mkdir($upload_promo_image_path, 0755, true);
        }

        $config['upload_path']   = $upload_promo_image_path;
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['max_size']      = 10239; // 10MB
        $config['encrypt_name']  = TRUE;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('promo')) {
            ms(["status" => "error", "message" => strip_tags($this->upload->display_errors())]);
        }

        $upload_data = $this->upload->data();
        $image_path = 'assets/uploads/promo/' . $upload_data['file_name'];

        $data = [
            "title"        => $this->input->post('title'),
            "description"  => $this->input->post('description'),
            "image"        => $image_path,
            "alt"          => $this->input->post('alt'),
            "status"       => (int)$this->input->post("status"),
        ];

        // Log data for debugging
        log_message('debug', 'Promo save attempt - Data: ' . json_encode($data));
        log_message('debug', 'Promo table name: ' . PROMO);

        $response = $this->main_model->save_item($data, ['task' => 'add-item']);
        
        // Log response
        log_message('debug', 'Promo save response: ' . json_encode($response));

        ms($response);
    }

    
}

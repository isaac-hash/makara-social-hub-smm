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
            $items = $this->main_model->list_items(null, ['task' => 'list-items-admin']);
            
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

        $id = $this->input->post('id');

        // Form validation
        $this->form_validation->set_rules('title', 'Title', 'trim|required|xss_clean');
        $this->form_validation->set_rules('description', 'Description', 'trim|xss_clean');
        $this->form_validation->set_rules('alt', 'Alt Text', 'trim|xss_clean');
        $this->form_validation->set_rules('status', 'Status', 'trim|required|in_list[0,1]|xss_clean');

        if (!$this->form_validation->run()) {
            _validation('error', validation_errors());
        }

        // Check if file is uploaded
        $image_path = "";
        if (!empty($_FILES['promo']['name'])) {
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
        } else {
             if (empty($id)) {
                ms(["status" => "error", "message" => "Please select a promo image to upload."]);
             }
        }

        $data = [
            "title"        => $this->input->post('title'),
            "description"  => $this->input->post('description'),
            "alt"          => $this->input->post('alt'),
            "status"       => (int)$this->input->post("status"),
        ];

        if (!empty($image_path)) {
            $data['image'] = $image_path;
        }

        if ($id) {
            $data['id'] = $id;
            $response = $this->main_model->save_item($data, ['task' => 'edit-item']);
        } else {
            $response = $this->main_model->save_item($data, ['task' => 'add-item']);
        }

        ms($response);
    }


    public function update($id = "")
    {
        $item = $this->main_model->get_item(['id' => (int)$id], ['task' => 'get-item']);
        if (!$item) {
            redirect(admin_url($this->controller_name));
        }

        $data = [
            "controller_name" => $this->controller_name,
            "item" => $item,
        ];
        $this->template->build($this->path_views . "/update", $data);
    }

    public function delete($id = "")
    {
        if (!is_ajax_call()) {
            redirect(admin_url($this->controller_name));
        }

        if (!$id) {
            ms(['status' => 'error', 'message' => 'Invalid ID']);
        }
        $response = $this->main_model->delete_item(['id' => (int)$id], ['task' => 'delete-item']);
        ms($response);
    }
}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class news extends My_AdminController
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
        $this->path_views = "news";
        $this->params = [];

        $this->columns = array(
            "description" => ['name' => 'description', 'class' => 'text-center'],
            "title" => ['name' => 'Title', 'class' => 'text-center'],
            "image" => ['name' => 'Image', 'class' => 'border-radius'],
            "expiry" => ['name' => 'Expiry', 'class' => 'text-center'],
            "status" => ['name' => 'status', 'class' => 'text-center'],
        );
    }

    public function store()
    {
        if (!is_ajax_call()) {
            redirect(admin_url($this->controller_name));
        }

        if (empty($_FILES['promo']['name'])) {
            // echo json_encode(["file" => ])
            ms(["status" => "error", "message" => "Please select a promo image to upload."]);
        }
        $description = $_POST["description"];
        $title = $_POST["title"];

        $upload_promo_image_path = FCPATH . "assets/uploads/promo/";
        if (!is_dir($upload_promo_image_path)) {
            mkdir($upload_promo_image_path, 0755, true);
        }

        $config['upload_path']   = $upload_promo_image_path;
        $config['allowed_types'] = 'gif|jpg|jpeg|png|pdf';
        $config['max_size']      = 10239; // 10MB
        $config['encrypt_name']  = TRUE;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('receipt')) {
            ms(["status" => "error", "message" => strip_tags($this->upload->display_errors())]);
        }

        $upload_data = $this->upload->data();
        $image_path = 'assets/uploads/promo/' . $upload_data['file_name'];

        $data = [
            "description" => $description,
            "title" => $title,
            'image' => $image_path,
            'status'       => 0,
            'created_at'   => NOW,
        ];

        $this->db->insert('promo', $data);

        ms([
            "status"  => "success",
            "message" => "Promo Updated Correctly",
        ]);

        ms($response);
    }

    
}

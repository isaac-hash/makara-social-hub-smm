<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class tutorials_model extends MY_Model {
    public $tb_main;

    public function __construct(){
        parent::__construct();
        $this->tb_main     = TUTORIALS;
    }

    public function list_items($params = null, $option = null){
        $result = null;
        if($option['task'] == 'list-items'){
            $this->db->select('title, description, video_file_path, link, created');
            $this->db->from($this->tb_main);
            $this->db->where('status', 1); // Only active items
            $this->db->order_by('created', 'DESC');
            $query = $this->db->get();
            $result = $query->result_array();
        }
        return $result;
    }
}

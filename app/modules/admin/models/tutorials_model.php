<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class tutorials_model extends MY_Model 
{

    protected $tb_main;
    protected $filter_accepted;
    protected $field_search_accepted;

    public function __construct()
    {
        parent::__construct();
        $this->tb_main     = TUTORIALS; 

        $this->filter_accepted = array_keys(app_config('template')['status']);
        unset($this->filter_accepted['3']);
        $this->field_search_accepted = app_config('config')['search']['news']; // Reuse search config or define generic if needed
    }

    public function list_items($params = null, $option = null)
    {
        $result = null;
       
        if ($option['task'] == 'list-items') {
            $this->db->select('id, title, description, status, video_file_path, link, created');
            $this->db->from($this->tb_main);

            // filter
            if ($params['filter']['status'] != 3 && in_array($params['filter']['status'], $this->filter_accepted)) {
                $this->db->where('status', $params['filter']['status']);
            }
            //Search
            if ($params['search']['field'] === 'all') {
                $i = 1;
                foreach ($this->field_search_accepted as $column) {
                    if ($column != 'all') {
                        if($i == 1){
                            $this->db->like($column, $params['search']['query']); 
                        }elseif ($i > 1) {
                            $this->db->or_like($column, $params['search']['query']); 
                        }
                        $i++;
                    }
                }
            } elseif (in_array($params['search']['field'], $this->field_search_accepted) && $params['search']['query'] != "") {
                $this->db->like($params['search']['field'], $params['search']['query']); 
            }

            $this->db->order_by('changed', 'DESC');
            if ($params['pagination']['limit'] != "" && $params['pagination']['start'] >= 0) {
                $this->db->limit($params['pagination']['limit'], $params['pagination']['start']);
            }
            $query = $this->db->get();
            $result = $query->result_array();
        }

        if ($option['task'] == 'list-items-admin') {
            $this->db->select('id, title, description, status, video_file_path, link, created');
            $this->db->from($this->tb_main);
            $this->db->order_by('created', 'DESC');
            $query = $this->db->get();
            $result = $query->result_array();
        }
        return $result;
    }

    public function get_item($params = null, $option = null)
    {
        $result = null;
        if($option['task'] == 'get-item'){
            $result = $this->get("id, title, description, status, video_file_path, link, created", $this->tb_main, ['id' => $params['id']], '', '', true);
        }
        return $result;
    }

    public function delete_item($params = null, $option = null)
    {
        $result = [];
        if($option['task'] == 'delete-item'){
            $item = $this->get("id, video_file_path", $this->tb_main, ['id' => $params['id']]);
            if ($item) {
                // Delete file from server
                if (!empty($item['video_file_path']) && file_exists(FCPATH . $item['video_file_path'])) {
                    unlink(FCPATH . $item['video_file_path']);
                }

                $this->db->delete($this->tb_main, ["id" => $params['id']]);
                $result = [
                    'status' => 'success',
                    'message' => 'Deleted successfully',
                ];
            }else{
                $result = [
                    'status' => 'error',
                    'message' => 'There was an error processing your request. Please try again later',
                ];
            }
        }
        return $result;
    }

    public function save_item($params = null, $option = null)
    {
        switch ($option['task']) {
            case 'add-item':
                $data = array(
                    "title"            => $params['title'],
                    "description"      => $params['description'],
                    "video_file_path"  => isset($params['video_file_path']) ? $params['video_file_path'] : '', // Handle optional
                    "link"             => $params['link'],
                    "status"           => (int)$params["status"],
                    "created"          => NOW,
                    "changed"          => NOW,
                );
                
                $this->db->insert($this->tb_main, $data);
                
                if ($this->db->affected_rows() > 0) {
                    return ["status"  => "success", "message" => 'Tutorial added successfully'];
                } else {
                    $error = $this->db->error();
                    log_message('error', 'Tutorial insert failed: ' . json_encode($error));
                    return ["status"  => "error", "message" => 'Failed to add tutorial. Database error: ' . $error['message']];
                }
                break;

            case 'edit-item':
                $data = array(
                    "title"            => $params['title'],
                    "description"      => $params['description'],
                    "link"             => $params['link'],
                    "status"           => (int)$params["status"],
                    "changed"          => NOW,
                );

                if (!empty($params['video_file_path'])) {
                    $data['video_file_path'] = $params['video_file_path'];
                    // Ideally we should delete the old video file here if it's different
                }

                $this->db->update($this->tb_main, $data, ['id' => $params['id']]);
                
                return ["status"  => "success", "message" => 'Tutorial updated successfully'];
                break;
        }
    }
}

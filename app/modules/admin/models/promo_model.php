<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class promo_model extends MY_Model 
{

    protected $tb_main;
    protected $filter_accepted;
    protected $field_search_accepted;

    public function __construct()
    {
        parent::__construct();
        $this->tb_main     = PROMO;

        $this->filter_accepted = array_keys(app_config('template')['status']);
        unset($this->filter_accepted['3']);
        $this->field_search_accepted = app_config('config')['search']['news'];
    }

    public function list_items($params = null, $option = null)
    {
        $result = null;
       
        if ($option['task'] == 'list-items') {
            $this->db->select('id, title, description, status, image, created');
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

        if ($option['task'] == 'list-items-view-news') {
            $this->db->select('id, title, description, status, image, created');
            $this->db->from($this->tb_main);
            $this->db->where("(created < '". NOW ."')");
            $this->db->where('status', 1);
            $this->db->order_by('created', 'DESC');
            $query = $this->db->get();
            $result = $query->result_array();
        }

        if ($option['task'] == 'list-items-admin') {
            $this->db->select('id, title, description, status, image, created, alt');
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
            $result = $this->get("id, title, description, status, image, created", $this->tb_main, ['id' => $params['id']], '', '', true);
        }
        return $result;
    }

    public function count_items($params = null, $option = null)
    {
        $result = null;
        if ($option['task'] == 'count-items-group-by-status') {
            $this->db->select('count(id) as count, status');
            $this->db->from($this->tb_main);
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
            }elseif (in_array($params['search']['field'], $this->field_search_accepted) && $params['search']['query'] != "") {
                $this->db->like($params['search']['field'], $params['search']['query']); 
            }

            $this->db->order_by('status', 'DESC');
            $this->db->group_by('status');
            $query = $this->db->get();
            $result = $query->result_array();
        }

        // Count items for pagination
        if ($option['task'] == 'count-items-for-pagination') {
            $this->db->select('id');
            $this->db->from($this->tb_main);
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
            }elseif (in_array($params['search']['field'], $this->field_search_accepted) && $params['search']['query'] != "") {
                $this->db->like($params['search']['field'], $params['search']['query']); 
            }
            $query = $this->db->get();
            $result = $query->num_rows();
        }
        return $result;
    }

    public function delete_item($params = null, $option = null)
    {
        $result = [];
        if($option['task'] == 'delete-item'){
            $item = $this->get("id, ids", $this->tb_main, ['id' => $params['id']]);
            if ($item) {
                $this->db->delete($this->tb_main, ["id" => $params['id']]);
                $result = [
                    'status' => 'success',
                    'message' => 'Deleted successfully',
                    "ids"     => $item->ids,
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
                    "image"            => $params['image'],
                    "alt"              => $params['alt'],
                    "status"           => (int)$params["status"],
                    "created"          => NOW,
                    "changed"          => NOW,
                );
                
                $this->db->insert($this->tb_main, $data);
                
                // Check if insert was successful
                if ($this->db->affected_rows() > 0) {
                    return ["status"  => "success", "message" => 'Promo added successfully'];
                } else {
                    // Log the database error
                    $error = $this->db->error();
                    log_message('error', 'Promo insert failed: ' . json_encode($error));
                    return ["status"  => "error", "message" => 'Failed to add promo. Database error: ' . $error['message']];
                }
                break;

            case 'edit-item':
                $data = array(
                    "title"            => $params['title'],
                    "description"      => $params['description'],
                    "alt"              => $params['alt'],
                    "status"           => (int)$params["status"],
                    "changed"          => NOW,
                );

                if (!empty($params['image'])) {
                    $data['image'] = $params['image'];
                }

                $this->db->update($this->tb_main, $data, ['id' => $params['id']]);
                
                return ["status"  => "success", "message" => 'Promo updated successfully'];
                break;
        }
    }
}

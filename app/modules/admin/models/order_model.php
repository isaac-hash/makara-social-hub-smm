<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class order_model extends MY_Model 
{
    
    public function __construct()
    {
        parent::__construct();
        $this->tb_main     = ORDER;
        $this->controller_name     = 'order';
        //Status
        $this->filter_accepted = app_config('config')['status']['order'];
        unset($this->filter_accepted['all']);

        //Copy to clipboard
        $this->bulk_actions_copy_clipboard_accepted = app_config('config')['bulk_action']['order'];
        $this->bulk_actions_copy_clipboard_accepted = array_diff($this->bulk_actions_copy_clipboard_accepted, ['pending', 'inprogress', 'completed', 'resend', 'cancel']);

        $this->field_search_accepted = app_config('config')['search']['order'];
    }

    public function list_items($params = null, $option = null)
    {
        $result = null;
        if ($option['task'] == 'list-items') {
            $item_main_id = 0;
            if (get('subscription')) {
                $item_main_id = (int)get('subscription');
            } elseif (get('drip-feed')){
                $item_main_id = (int)get('drip-feed');
            }

            $this->db->select('o.id, o.ids, o.type, o.service_type, o.service_id, o.api_provider_id, o.api_service_id, o.api_order_id, o.status, o.charge, o.formal_charge, o.profit, o.link, o.quantity, o.comments, o.remains, o.start_counter, o.created, o.note, o.mode');
            $this->db->select('o.order_source_type');
            $this->db->select('u.email');
            $this->db->select('s.name as service_name');
            $this->db->select('api.name as api_name');
            $this->db->from($this->tb_main . ' o');
            $this->db->join($this->tb_users." u", "o.uid = u.id", 'left');
            $this->db->join($this->tb_services." s", "s.id = o.service_id", 'left');
            $this->db->join($this->tb_api_providers." api", "api.id = o.api_provider_id", 'left');

            // filter
            if ($params['filter']['status'] != 'all' && in_array($params['filter']['status'], $this->filter_accepted)) {
                $this->db->where('o.status', $params['filter']['status']);
            }

            $this->db->where("o.service_type !=", "subscriptions");
            $this->db->where("o.is_drip_feed !=", 1);

            // Get all orders relate to main order id
            if ($item_main_id > 0) {
                $this->db->where("o.main_order_id", $item_main_id);
            }

            //Search
            if ($params['search']['field'] === 'all') {
                $i = 1;
                foreach ($this->field_search_accepted as $column) {
                    if ($column != 'all') {
                        $column = ($column == 'email') ? 'u.'.$column : 'o.'.$column;
                        if($i == 1){
                            $this->db->like($column, $params['search']['query']); 
                        }elseif ($i > 1) {
                            $this->db->or_like($column, $params['search']['query']); 
                        }
                        $i++;
                    }
                }
            }elseif (in_array($params['search']['field'], $this->field_search_accepted) && $params['search']['query'] != "") {
                if (in_array($params['search']['field'], ['id', 'api_order_id'])) {
                    $this->db->where_in('`o`.' . $params['search']['field'], convert_str_number_list_to_array($params['search']['query']));
                } else {
                    $column = ($params['search']['field'] == 'email') ? 'u.'.$params['search']['field'] : 'o.'.$params['search']['field'];
                    $this->db->like($column, $params['search']['query']); 
                }
            }

            $this->db->order_by('id', 'desc');
            if ($params['pagination']['limit'] != "" && $params['pagination']['start'] >= 0) {
                $this->db->limit($params['pagination']['limit'], $params['pagination']['start']);
            }
            $query = $this->db->get();
            $result = $query->result_array();
        }
        if ($option['task'] == 'list-items-in-bulk-action') {
            $this->db->select('id, ids, cate_id, service_id, service_type, api_provider_id, api_service_id, charge, uid, quantity, status, formal_charge, profit');
            $this->db->from($this->tb_main);
            $this->db->where_in('id', $params['ids_arr']);
            $query = $this->db->get();
            $result = $query->result_array();
        }

        if ($option['task'] == 'best-seller-in-statistics') {

            $query = "SELECT count(service_id) as total_orders, service_id FROM {$this->tb_main} GROUP BY service_id ORDER BY total_orders DESC LIMIT ". $params['limit'];
            $items_best_seller =  $this->db->query($query)->result_array();
            if (!$items_best_seller) {
                return $result;
            }
            $items_arr_service_id = array_column($items_best_seller, 'total_orders', 'service_id');
            $this->db->select('s.id, s.ids, s.name, s.cate_id, s.price, s.original_price, s.min, s.max, s.type, s.add_type, s.api_service_id, s.api_provider_id, s.status, s.desc, , s.refill, s.refill_type, s.dripfeed');
            $this->db->select('api.name as api_name');
            $this->db->from($this->tb_services." s");
            $this->db->join($this->tb_api_providers." api", "s.api_provider_id = api.id", 'left');
            $this->db->where_in("s.id", array_keys($items_arr_service_id));
            $this->db->where("s.status", 1);
            $query = $this->db->get();
            $result = $query->result_array();
            if ($result) {
                foreach ($result as $key => $item) {
                    if (isset($items_arr_service_id[$item['id']])) {
                        $result[$key]['total_orders'] = $items_arr_service_id[$item['id']];
                    }
                } 
                usort($result, function ($item1, $item2) {
                    return $item2['total_orders'] <=> $item1['total_orders'];
                });    
            }
        }

        // copy to clipboard
        if ($option['task'] == 'list-items-copy-to-clip-board') {
            $this->db->select('o.' . $params['get-type']);
            $this->db->from($this->tb_main . ' o');
            $this->db->where_in('o.id', $params['arr_ids']);
            $query = $this->db->get();
            $result = $query->result_array();
        }

        return $result;
    }

    public function get_item($params = null, $option = null)
    {
        $result = null;
        if($option['task'] == 'get-item'){
            $result = $this->get("id, ids, cate_id, service_id, service_type, api_provider_id, api_service_id, api_order_id, charge, uid, quantity, status, formal_charge, profit, start_counter, remains, link, mode, order_source_type", $this->tb_main, ['id' => $params['id']], '', '', true);
        }
        return $result;
    }

    public function count_items($params = null, $option = null)
    {
        $result = null;

        if ($option['task'] == 'count-items-by-status') {
            $this->db->select("id");
            $this->db->from($this->tb_main);
            $this->db->where("status", $params['status']);
            $this->db->where("service_type !=", "subscriptions");
            $this->db->where("is_drip_feed !=", 1);
            $query = $this->db->get();
            return $query->num_rows();
        }

        // Count items for pagination
        if ($option['task'] == 'count-items-for-pagination') {
            $item_main_id = 0;
            // get uid Array
            if ($params['search']['field'] == 'email') {
                $items_uid = $this->fetch_search_items('id', $this->tb_users, '', ['field' => $params['search']['field'], 'query' => $params['search']['query']]);
                if (!$items_uid) return null;
            }
            if (get('subscription')) {
                $item_main_id = (int)get('subscription');
            } elseif (get('drip-feed')){
                $item_main_id = (int)get('drip-feed');
            }
            $this->db->select('o.id');
            $this->db->from($this->tb_main . ' o');
            // filter
            if ($params['filter']['status'] != 'all' && in_array($params['filter']['status'], $this->filter_accepted)) {
                $this->db->where('o.status', $params['filter']['status']);
            }
            $this->db->where("o.service_type !=", "subscriptions");
            $this->db->where("o.is_drip_feed !=", 1);
            // Get all orders relate to main order id
            if ($item_main_id > 0) {
                $this->db->where("o.main_order_id", $item_main_id);
            }
            //Search
            if ($params['search']['field'] === 'all') {
                $i = 1;
                foreach ($this->field_search_accepted as $column) {
                    if ($column != 'all') {
                        $column = ($column == 'email') ? 'u.'.$column : 'o.'.$column;
                        if($i == 1){
                            $this->db->like($column, $params['search']['query']); 
                        }elseif ($i > 1) {
                            $this->db->or_like($column, $params['search']['query']); 
                        }
                        $i++;
                    }
                }
            }elseif (in_array($params['search']['field'], $this->field_search_accepted) && $params['search']['query'] != "") {
                if (in_array($params['search']['field'], ['id', 'api_order_id'])) {
                    $this->db->where_in('`o`.' . $params['search']['field'], convert_str_number_list_to_array($params['search']['query']));
                } else {
                    // Search Email
                    if ($params['search']['field'] == 'email') {
                        $this->db->where_in("o.uid", array_column($items_uid, 'id'));
                    } else {
                        $this->db->like('o.'.$params['search']['field'], $params['search']['query']); 
                    }
                } 
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
            case 'edit-item':
                
                $status = post('status');

                if ($status == ORDER_STATUS_CANCELED) {
                    staff_check_role_permission($this->controller_name, 'cancel');
                }

                $result_update = $this->update_item(post('id'), $status, [
                    "link"          => post('link'),
                    "start_counter" => post('start_counter'),
                    "remains"       => post('remains'),
                ]);

                return $result_update 
                        ? ["status"  => "success", "message" => 'Update successfully'] 
                        : ["status"  => "error", "message" => 'Update Failed'];
                break;

            case 'resend-item':
                $this->db->trans_start();
                $item = $params['item'];
                $related_service = $this->get('id, cate_id, api_provider_id, api_service_id, original_price', $this->tb_services, ['id' => $item['service_id']]);
                $data = [
                    'status'       => ORDER_STATUS_AWAITING,
                    'note'         => 'Resent',
                    'changed'      => NOW,
                    'api_order_id' => -1,
                ];

                if (!empty($related_service)) {
                    $data['cate_id']              = $related_service->cate_id;
                    $data['service_id']           = $related_service->id;
                    $data['api_provider_id']      = $related_service->api_provider_id;
                    $data['api_service_id']       = $related_service->api_service_id;
                    $data['formal_charge']        = ($item['quantity'] * $related_service->original_price) / 1000;
                    $data['profit']               = $item['charge'] - $data['formal_charge'];
                }
                $this->db->update($this->tb_main, $data, ['id' => $item['id']]);
                insert_staffs_activity(['event' => 'Resend order', 'detail' => $item['id']]);
                // Complete the transaction
                $this->db->trans_complete();
                return $this->db->trans_status() 
                        ? ["status"  => "success", "message" => 'Resend successfully'] 
                        : ["status"  => "error", "message" => 'Resend Failed'];

                break;

            case 'update-item-from-provider':
                $item = $params['item'];
                $this->load->model('provider_model', 'provider_model');
                $item_api = $this->provider_model->get_item(['id' => $item['api_provider_id']], ['task' => 'get-item']);
                if (! $item_api) {
                    $response = ['error' => "API Provider does not exists"];
                    return $response;
                }
                $provider = new Smm_api();
                $response = $provider->status($item_api, $item['api_order_id']);
                if ($response && isset($response['status'])) {
                    $this->load->model('cron/cron_model', 'cron_model');
                    $this->cron_model->save_item(['item' => $item, 'response' => $response], ['task' => 'item-status']);

                } else {
                    return ["status"  => "error", "message" => 'Update Failed' . json_encode($response) ];
                }
                break;

            case 'bulk-action':
                
                if (in_array($params['type'], ['delete', 'deactive', 'active']) && empty($params['ids'])) {
                    return ["status"  => "error", "message" => 'Please choose at least one item'];
                }
                $arr_ids = convert_str_number_list_to_array($params['ids']);
                
                switch ($params['type']) {
                    case 'delete':
                        $this->db->where_in('id', $arr_ids);
                        $this->db->delete($this->tb_main);
                        insert_staffs_activity(['event' => 'Delete orders', 'detail' => $params['ids'] ]);
                        return ["status"  => "success", "message" => 'Update successfully'];
                        break;
                    case 'resend':
                        $items = $this->list_items(['ids_arr' => $arr_ids], ['task' => 'list-items-in-bulk-action']);
                        if ($items) {
                            foreach ($items as $key => $item) {
                                $this->save_item(['item' => $item], ['task' => 'resend-item']);
                            }
                        }
                        return ["status"  => "success", "message" => 'Update successfully'];
                        break;
                    case 'cancel':
                        staff_check_role_permission($this->controller_name, 'cancel');
                        $items = $this->list_items(['ids_arr' => $arr_ids], ['task' => 'list-items-in-bulk-action']);

                        if ($items) {
                            foreach ($items as $key => $item) {
                                $result = $this->update_item($item['id'], ORDER_STATUS_CANCELED);
                            }
                        }
                        return  ["status"  => "success", "message" => 'Update successfully'];

                        break;
                    default:
                        //copy to clipboard
                        if (in_array($params['type'], $this->bulk_actions_copy_clipboard_accepted)) {
                            $params_tmp = [
                                'arr_ids' => $arr_ids, 
                                'get-type' => str_replace('copy_', '', $params['type'])
                            ];
                            $order_ids = $this->list_items($params_tmp, ['task' => 'list-items-copy-to-clip-board']);
                            if ($order_ids) {
                                $order_ids = array_column($order_ids, $params_tmp['get-type']);
                                $order_ids = implode(',', $order_ids);
                                return ["status"  => "success", "value" => $order_ids];
                            } else {
                                return ["status"  => "error", "value" => 'There was issue with your request'];
                            }
                        }
                        // Action: In progress, Completed, Pending
                        if (in_array($params['type'], ['pending', 'completed', 'inprogress'])) {
                            staff_check_role_permission($this->controller_name, 'change_status');
                            $this->db->where_in('id', $arr_ids);
                            $this->db->update($this->tb_main, ['status' => $params['type'], 'changed' => NOW, 'finished' => NOW]);
                            insert_staffs_activity(['event' => 'Change Status order', 'detail' => $params['type']. ' - ' . $params['ids'] ]);
                            return ["status"  => "success", "message" => 'Update successfully'];
                        }
                        break;
                }
                break;
        }
    }

    // Update Item Status
    private function update_item($item_id, $status, $additional_data = [])
    {
        $this->db->trans_start();
        
        $item = $this->get('id, ids, cate_id, service_id, service_type, api_provider_id, api_service_id, charge, uid, quantity, status, formal_charge, profit', $this->tb_main, ['id' => $item_id], '', '', true);
        if (!$item) {
            return false;
        }

        $data = array_merge([
            "status"    => $status,
            "changed"   => NOW,
            "finished"  => NOW,
        ], $additional_data);
        

        if (in_array($status, ['refunded', 'partial', 'canceled'])) {
            $remains = $additional_data['remains'] ?? $item['quantity'];
            $new_order_attr = calculate_order_by_status($item, ['status' => $status, 'remains' => $remains]);

            if (!in_array($item['status'], array(ORDER_STATUS_CANCELED, ORDER_STATUS_REFUNDED))) {
                $response = $this->crud_user(['uid' => $item['uid'], 'fields' => 'balance', 'new_amount' => $new_order_attr['refund_money']], ['task' => 'update-balance']);
            }

            $data['charge']        = $new_order_attr['real_charge'];
            $data['formal_charge'] = $new_order_attr['formal_charge'];
            $data['profit']        = $new_order_attr['profit'];
        }

        $this->db->update($this->tb_main, $data, ["id" => $item['id']]);
        insert_staffs_activity(['event' => 'Edit order', 'detail' => $item['id'] . ' - ' . $status]);

        $this->db->trans_complete();
        return $this->db->trans_status();
    }
}

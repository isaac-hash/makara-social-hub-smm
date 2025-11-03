<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manual_payment_model extends MY_Model {

    public $table = 'manual_payment_receipts';

    public function __construct()
    {
        parent::__construct();
    }

    public function get_all_receipts()
    {
        $this->db->order_by('created_at', 'desc');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function get_receipts_by_user($user_id)
    {
        $this->db->where('user_id', $user_id);
        $this->db->order_by('created_at', 'desc');
        $query = $this->db->get($this->table);
        return $query->result();
    }
}

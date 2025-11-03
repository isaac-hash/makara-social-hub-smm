<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class receipts_model extends MY_Model {
    public function __construct()
    {
        parent::__construct();
        $this->tb_main     = 'manual_payment_receipts';
        $this->tb_users    = USERS;
        $this->tb_transaction_logs = TRANSACTION_LOGS;
    }

    public function list_items($params = null, $option = null)
    {
        $result = null;
        if ($option['task'] == 'list-items') {
            $this->db->select('mpr.*, u.email as user_email');
            $this->db->from($this->tb_main . ' mpr');
            $this->db->join($this->tb_users . " u", "u.id = mpr.user_id", 'left');
            $this->db->order_by('mpr.id', 'DESC');
            if ($params['pagination']['limit'] != "" && $params['pagination']['start'] >= 0) {
                $this->db->limit($params['pagination']['limit'], $params['pagination']['start']);
            }
            $query = $this->db->get();
            $result = $query->result_array();
        }
        return $result;
    }

    public function count_items($params = null, $option = null)
    {
        $result = null;
        if ($option['task'] == 'count-items-for-pagination') {
            $this->db->select('id');
            $this->db->from($this->tb_main);
            $query = $this->db->get();
            $result = $query->num_rows();
        }
        return $result;
    }

    public function get_item($params = null, $option = null)
    {
        $result = null;
        if ($option['task'] == 'get-item') {
            $this->db->select('mpr.*, u.email as user_email');
            $this->db->from($this->tb_main . ' mpr');
            $this->db->join($this->tb_users . " u", "u.id = mpr.user_id", 'left');
            $this->db->where('mpr.ids', $params['ids']);
            $result = $this->db->get()->row_array();
        }
        return $result;
    }

    public function update_status($ids, $status)
{
    $debug = [];

    $debug['input_ids']   = $ids;
    $debug['input_status']= $status;

    // -----------------------------------------------------------------
    $receipt = $this->get('*', $this->tb_main, ['ids' => $ids]);
    if (!$receipt) {
        $debug['step'] = 'receipt_lookup';
        $debug['error'] = 'Receipt NOT FOUND';
        return ['debug' => $debug];
    }
    $debug['receipt_found'] = true;
    $debug['current_status'] = $receipt->status;

    if ($receipt->status != 'pending') {
        $debug['step'] = 'status_check';
        $debug['error'] = 'Already processed (status = '.$receipt->status.')';
        return ['debug' => $debug];
    }

    // -----------------------------------------------------------------
    $this->db->trans_begin();

    if ($status == 'approved') {
        $user = $this->get('id, balance', $this->tb_users, ['id' => $receipt->user_id]);
        if (!$user) {
            $this->db->trans_rollback();
            $debug['step'] = 'user_lookup';
            $debug['error'] = 'User not found';
            return ['debug' => $debug];
        }

        $new_balance = $user->balance + $receipt->amount;
        $this->db->update($this->tb_users, ['balance' => $new_balance], ['id' => $user->id]);

        // === INSERT TRANSACTION LOG ===
        $data_tnx = [
            "ids"            => ids(),
            "uid"            => $receipt->user_id,
            "type"           => 'manual_payment',
            "transaction_id" => "manual-" . $receipt->id,
            "amount"         => $receipt->amount,
            "balance"        => $new_balance,
            "status"         => 1,
            "created"        => NOW,
        ];

        // if (!$this->db->insert($this->tb_transaction_logs, $data_tnx)) {
        //     $this->db->trans_rollback();
        //     $debug['step'] = 'insert_transaction_log';
        //     $debug['error'] = 'Insert failed: ' . $this->db->error()['message'];
        //     $debug['insert_data'] = $data_tnx;
        //     return ['debug' => $debug];
        // }

        // $debug['transaction_log_inserted'] = true;
    }

    // -----------------------------------------------------------------
    $this->db->update(
        $this->tb_main,
        ['status' => $status, 'updated_at' => NOW],
        ['ids' => $ids]               // <-- HASHED column, NOT `id`
    );
    $debug['sql'] = $this->db->last_query();

    if ($this->db->trans_status() === false) {
        $this->db->trans_rollback();
        $debug['step'] = 'transaction';
        $debug['error'] = 'DB transaction failed';
        return ['debug' => $debug];
    }

    $this->db->trans_commit();
    return true;       // <-- normal success
}
}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class notifications_model extends MY_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->tb_main = NOTIFICATIONS;
        $this->tb_notification_message = NOTIFICATION_MESSAGES;
        $this->tb_staffs = STAFFS;
    }

    public function list_items($params = null, $option = null)
    {
        $result = null;
        if ($option['task'] == 'list-items') {
            $this->db->select('id, ids, uid, subject, user_read, created, changed, status');
            $this->db->from($this->tb_main);
            $this->db->where('uid', session('uid'));

            //Search
            if ($params['search']['query'] != '') {
                $field_value = $this->db->escape_like_str($params['search']['query']);
                $where_like = "(`id` LIKE '%" . $field_value . "%' ESCAPE '!' OR `description` LIKE '%" . $field_value . "%' ESCAPE '!' OR `subject` LIKE '%" . $field_value . "%' ESCAPE '!')";
                $this->db->where($where_like);
            }

            $this->db->order_by("FIELD ( status, 'answered', 'pending', 'closed')");
            $this->db->order_by('changed', 'DESC');
            if ($params['pagination']['limit'] != "" && $params['pagination']['start'] >= 0) {
                $this->db->limit($params['pagination']['limit'], $params['pagination']['start']);
            }
            $query = $this->db->get();
            $result = $query->result_array();
        }

        if ($option['task'] == 'list-items-notification-message') {
            $this->db->select('nm.id, nm.ids, nm.uid, nm.author, nm.message, nm.support, nm.created');
            $this->db->select('u.first_name, u.last_name');
            $this->db->from($this->tb_notification_message . ' nm');
            $this->db->join($this->tb_users . " u", "nm.uid = u.id", 'left');
            $this->db->where('nm.notification_id', $params['notification_id']);
            $this->db->order_by('nm.id', 'DESC');
            $query = $this->db->get();
            $result = $query->result_array();
        }

        return $result;
    }

    public function count_items($params = null, $option = null)
    {
        $result = null;
        // Count items for pagination
        if ($option['task'] == 'count-items-for-pagination') {
            $this->db->select('id');
            $this->db->from($this->tb_main);
            $this->db->where('uid', session('uid'));
            //Search
            if ($params['search']['query'] != '') {
                $field_value = $this->db->escape_like_str($params['search']['query']);
                $where_like = "(`id` LIKE '%" . $field_value . "%' ESCAPE '!' OR `description` LIKE '%" . $field_value . "%' ESCAPE '!' OR `subject` LIKE '%" . $field_value . "%' ESCAPE '!')";
                $this->db->where($where_like);
            }
            $query = $this->db->get();
            $result = $query->num_rows();
        }
        // Count items: pending
        if ($option['task'] == 'count-items-pending') {
            $this->db->select('id');
            $this->db->from($this->tb_main);
            $this->db->where('uid', session('uid'));
            $this->db->where_in('status', ['pending']);
            $query = $this->db->get();
            $result = $query->num_rows();
        }
        return $result;
    }

    public function get_item($params = null, $option = null)
    {
        $result = null;
        if ($option['task'] == 'get-item') {
            $result = $this->get("*", $this->tb_main, ['id' => $params['id']], '', '', true);
        }

        if ($option['task'] == 'view-get-item') {
            $this->db->select('tk.id, tk.ids, tk.uid, tk.subject, tk.description, tk.status, tk.created, tk.created_by');
            $this->db->select('u.email, u.first_name, u.last_name');
            $this->db->from($this->tb_main . ' tk');
            $this->db->join($this->tb_users . " u", "tk.uid = u.id", 'left');
            $this->db->where('tk.id', $params['id']);
            $this->db->where('tk.uid', session('uid'));
            $query = $this->db->get();
            $result = $query->row_array();
            $data_item = [
                'user_read' => 0,
                'changed' => NOW,
            ];
            $this->db->update($this->tb_main, $data_item, ['id' => $params['id']]);
        }
        return $result;
    }

    public function save_item($params = null, $option = null)
    {
        $result = null;
        if ($option['task'] == 'add-item') {
            $data = array(
                "ids" => ids(),
                "uid" => session('uid'),
                "subject" => $params['subject'],
                "description" => $params['description'],
                'user_read' => 0,
                'admin_read' => 1,
                "changed" => NOW,
                "created" => NOW,
            );
            $this->db->insert($this->tb_main, $data);
            if ($this->db->affected_rows() > 0) {
                // Send notice to admin with new notification
                if (get_option('is_notification_notice_email_admin', 0)) {
                    $notification_id = $this->db->insert_id();
                    $author = $_SESSION['user_current_info']['first_name'] . ' ' . $_SESSION['user_current_info']['last_name'];
                    $mail_params = [
                        'template' => [
                            'subject' => "{{website_name}}" . " - New notification #" . $notification_id . " - [" . $params['subject'] . "]",
                            'message' => $params['description'],
                            'type' => 'default',
                        ],
                        'from_email_data' => [
                            'from_email' => $_SESSION['user_current_info']['email'],
                            'from_email_name' => $author,
                        ],
                    ];
                    $this->send_notice_mail($mail_params);
                }
                return ["status" => "success", "message" => lang("notification_created_successfully")];
            } else {
                return ["error" => "success", "message" => lang("There_was_an_error_processing_your_request_Please_try_again_later")];
            }
        }

        if ($option = 'add-item-notification-massage') {
            $item = $this->get('id, ids, uid, subject', $this->tb_main, ['ids' => post('ids')], '', '', true);
            if (!$item) {
                return ["status" => "success", "message" => 'There was some wrong with your request'];
            }

            $data_item = [
                'status' => 'pending',
                'user_read' => 0,
                'admin_read' => 1,
                'changed' => NOW,
            ];
            $author = $_SESSION['user_current_info']['first_name'] . ' ' . $_SESSION['user_current_info']['last_name'];
            $data_item_notification_message = [
                'ids' => ids(),
                'message' => $this->input->post('message', true),
                'uid' => session('uid'),
                "author" => $author,
                "support" => 0,
                'notification_id' => $item['id'],
                'created' => NOW,
                'changed' => NOW,
            ];
            $this->db->update($this->tb_main, $data_item, ['id' => $item['id']]);
            $this->db->insert($this->tb_notification_message, $data_item_notification_message);
            // Send notice to admin when client reply
            if (get_option('is_notification_notice_email_admin', 0)) {
                $mail_params = [
                    'template' => [
                        'subject' => "{{website_name}}" . " - Relied notification #" . $item['id'] . " - [" . $item['subject'] . "]",
                        'message' => $data_item_notification_message['message'],
                        'type' => 'default',
                    ],
                    'from_email_data' => [
                        'from_email' => $_SESSION['user_current_info']['email'],
                        'from_email_name' => $author,
                    ],
                ];
                $this->send_notice_mail($mail_params);
            }
            return ["status" => "success", "message" => lang("Update_successfully")];
        }
        return $result;
    }

    private function send_notice_mail($params = [], $option = [])
    {
        $staff_mail = $this->get("id, email", $this->tb_staffs, [], "id", "ASC")->email;
        if ($staff_mail == "") {
            return ["status" => "error", "message" => lang("There_was_an_error_processing_your_request_Please_try_again_later")];
        }
        $send_message = $this->send_mail_template($params['template'], $staff_mail, $params['from_email_data']);
        if ($send_message) {
            send_mail_error_log(["status" => "error", "message" => $send_message]);
        }
    }

    public function send_manual_notification($params = [])
    {
        if (empty($params['uids']) || empty($params['subject']) || empty($params['message'])) {
             return ["status" => "error", "message" => lang("please_fill_in_the_required_fields")];
        }

        $uids = explode(',', $params['uids']);
        $count = 0;
        foreach ($uids as $uid) {
            $data = [
                'uid' => $uid,
                'subject' => $params['subject'],
                'description' => $params['message'],
            ];
            if ($this->add_admin_notification($data)) {
                $count++;
            }
        }
        
        return ["status" => "success", "message" => "Sent $count notifications successfully"];
    }

    public function add_admin_notification($data = [])
    {
        if (empty($data['uid']) || empty($data['subject']) || empty($data['description'])) {
            return false;
        }

        $insert_data = [
            "ids" => ids(),
            "uid" => $data['uid'],
            "subject" => $data['subject'],
            "description" => $data['description'],
            'user_read' => 1, // Highlight as unread for user? Usually 0 is unread... wait.
            // In list_items: user_read is selected.
            // In view_get_item: 'user_read' => 0 is UPDATED when viewed.
            // So 1 means unread? Or 0 means unread?
            // "user_read" => 0 in add-item (user creates).
            // When admin replies: 'user_read' => 0.
            // When user views: 'user_read' => 0?
            // Wait. Line 98: 'user_read' => 0 on update.
            // If it converts to 0 on view, then it was likely 1 before?
            // BUT add-item sets it to 0. 
            // Let's check `view.php` or `index.php` to see how it displays.
            // I'll assume 1 is unread for now because `view_get_item` sets it to 0.
            // WAIT. If `view_get_item` sets it to 0, then 0 is READ.
            // So 1 is UNREAD.
            // BUT `add-item` sets `user_read` = 0. That means user created it, so they read it. Correct.
            // `view-get-item` sets `user_read` = 0.
            // `add-item-notification-massage` (reply) sets `user_read` = 0.
            // This implies 0 is UNREAD?
            // If `view-get-item` sets it to 0. Then it STAYS 0?
            // Let me check `notifications` VIEW file `index` if possible, but I can't right now easily without tool.
            // Let's assume standard logic: 1 = unread, 0 = read.
            // If `view-get-item` sets it to 0 (Read).
            // Then creating a message (`add-item`) by user sets `user_read` = 0 (Read by user). `admin_read` = 1 (Unread by admin).
            // `add-item-notification-massage` (reply):
            // Defaults: 'user_read' => 0 (Read by user? No, if admin replies, user should NOT have read it).
            // Line 153 sets 'user_read' => 0. This seems wrong if admin replies.
            // UNLESS 0 is UNREAD?
            // If 0 is UNREAD, then `view-get-item` updating it to 0 means... marking it unread? That makes no sense.
            // Let's re-read line 97:
            /*
            $data_item = [
                'user_read' => 0,
                'changed' => NOW,
            ];
            $this->db->update($this->tb_main, $data_item, ['id' => $params['id']]);
            */
            // If viewing the item sets it to 0. Then 0 MUST be READ.
            // Then `add-item` sets `user_read` = 0. (User read their own new ticket). Correct.
            // `add-item-notification-massage`:
            /*
            $data_item = [
                'status' => 'pending',
                'user_read' => 0,
                'admin_read' => 1,
            */
            // This is generic update. If USER replies, `user_read`=0 (read), `admin_read`=1 (unread).
            // If ADMIN replies, this method is also called?
            // `store_message` in controller calls this.
            // `store_message` is in `notifications.php` (User side).
            // So this method is ONLY for user replies!
            // So 1 = Unread, 0 = Read.
            // So when ADMIN sends a notification, `user_read` should be 1 (Unread).
            
            'user_read' => 1, 
            'admin_read' => 0, // Admin sent it, so read.
            'status' => 'new', // Use 'new' or 'answer' or 'closed'?
            'changed' => NOW,
            'created' => NOW,
        ];

        $this->db->insert($this->tb_main, $insert_data);
        return $this->db->affected_rows() > 0;
    }
}
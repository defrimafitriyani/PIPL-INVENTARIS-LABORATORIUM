<?php
class Log_model extends CI_Model {
    public function add_log($data) {
        $this->db->insert('logs', $data);
    }

    public function get_all_logs() {
        $this->db->select('logs.*, users.username');
        $this->db->from('logs');
        $this->db->join('users', 'logs.user_id = users.id', 'left');
        $this->db->order_by('timestamp', 'DESC');
        return $this->db->get()->result();
    }
}

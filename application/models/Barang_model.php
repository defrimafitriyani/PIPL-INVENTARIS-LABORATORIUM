<?php
class Barang_model extends CI_Model {
    public function get_all_barang() {
        return $this->db->get('barang')->result();
    }

    public function insert_barang($data) {
        return $this->db->insert('barang', $data);
    }

    public function get_barang_by_id($id) {
        return $this->db->get_where('barang', ['id' => $id])->row();
    }

    public function update_barang($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('barang', $data);
    }

    public function delete_barang($id) {
        return $this->db->delete('barang', ['id' => $id]);
    }

    public function search_barang($keyword) {
        $this->db->like('nama_barang', $keyword);
        $this->db->or_like('kode_barang', $keyword);
        $this->db->or_like('lokasi', $keyword);
        return $this->db->get('barang')->result();
    }
    
    public function get_low_stock_items() {
        $this->db->where('jumlah < stok_minimum');
        return $this->db->get('barang')->result();
    }

    public function get_total_barang() {
        return $this->db->count_all('barang'); // Menghitung total barang
    }
    
    public function get_barang_by_condition($condition) {
        $this->db->where('kondisi', $condition);
        return $this->db->count_all_results('barang'); // Menghitung jumlah barang berdasarkan kondisi
    }
    
    public function get_top_locations() {
        $this->db->select('lokasi, COUNT(*) as total');
        $this->db->group_by('lokasi');
        $this->db->order_by('total', 'DESC');
        $this->db->limit(5);
        return $this->db->get('barang')->result(); // Mengambil lokasi dengan barang terbanyak
    }
    
}

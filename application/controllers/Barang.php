<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang extends CI_Controller {
    public function __construct() {
        parent::__construct();
        check_login();
        check_admin();
        $this->load->model('Barang_model');
    }    

    public function index() {
        $this->load->model('Barang_model');
        $data['barang'] = $this->Barang_model->get_all_barang(); // Semua barang
        $data['low_stock'] = $this->Barang_model->get_low_stock_items(); // Barang dengan stok rendah
        $this->load->view('barang/index', $data);
    }
    

    public function tambah() {
        $this->load->view('barang/tambah');
    }

    public function tambah_action() {
        $data = [
            'nama_barang' => $this->input->post('nama_barang'),
            'kode_barang' => $this->input->post('kode_barang'),
            'jumlah' => $this->input->post('jumlah'),
            'kondisi' => $this->input->post('kondisi'),
            'lokasi' => $this->input->post('lokasi'),
            'stok_minimum' => $this->input->post('stok_minimum'),
            'tanggal_input' => date('Y-m-d')
        ];
        $this->Barang_model->insert_barang($data);
    
        // Tambahkan log
        $this->load->model('Log_model');
        $log_data = [
            'user_id' => $this->session->userdata('user_id'),
            'action' => 'Tambah Barang',
            'item_id' => $this->db->insert_id(),
            'item_name' => $this->input->post('nama_barang')
        ];
        $this->Log_model->add_log($log_data);
    
        redirect('barang');
    }        

    public function edit($id) {
        $data['barang'] = $this->Barang_model->get_barang_by_id($id);
        $this->load->view('barang/edit', $data);
    }

    public function edit_action($id) {
        $data = [
            'nama_barang' => $this->input->post('nama_barang'),
            'kode_barang' => $this->input->post('kode_barang'),
            'jumlah' => $this->input->post('jumlah'),
            'kondisi' => $this->input->post('kondisi'),
            'lokasi' => $this->input->post('lokasi'),
            'stok_minimum' => $this->input->post('stok_minimum')
        ];
        $this->Barang_model->update_barang($id, $data);
    
        // Tambahkan log
        $this->load->model('Log_model');
        $log_data = [
            'user_id' => $this->session->userdata('user_id'),
            'action' => 'Edit Barang',
            'item_id' => $id,
            'item_name' => $this->input->post('nama_barang')
        ];
        $this->Log_model->add_log($log_data);
    
        redirect('barang');
    }    

    public function hapus($id) {
        $barang = $this->Barang_model->get_barang_by_id($id); // Ambil data barang sebelum dihapus
        $this->Barang_model->delete_barang($id);
    
        // Tambahkan log
        $this->load->model('Log_model');
        $log_data = [
            'user_id' => $this->session->userdata('user_id'),
            'action' => 'Hapus Barang',
            'item_id' => $id,
            'item_name' => $barang->nama_barang
        ];
        $this->Log_model->add_log($log_data);
    
        redirect('barang');
    }    

    public function search() {
        $keyword = $this->input->post('keyword'); // Ambil input pencarian dari form
        $data['barang'] = $this->Barang_model->search_barang($keyword);
        $data['keyword'] = $keyword; // Simpan keyword untuk ditampilkan di view
        $this->load->view('barang/index', $data);
    }    
    
    public function export_pdf() {
        $this->load->library('pdf');
        $data['barang'] = $this->Barang_model->get_all_barang(); // Ambil semua data barang
        $html = $this->load->view('barang/pdf', $data, TRUE); // Render HTML untuk PDF
        $this->pdf->createPDF($html, 'laporan_barang', TRUE);
    }

    public function dashboard() {
        $this->load->model('Barang_model');
    
        $data['total_barang'] = $this->Barang_model->get_total_barang();
        $data['barang_baik'] = $this->Barang_model->get_barang_by_condition('Baik');
        $data['barang_rusak'] = $this->Barang_model->get_barang_by_condition('Rusak');
        $data['top_locations'] = $this->Barang_model->get_top_locations();
    
        $this->load->view('barang/dashboard', $data);
    }
    
}

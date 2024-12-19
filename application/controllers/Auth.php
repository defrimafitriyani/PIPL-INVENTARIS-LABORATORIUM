<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('User_model'); // Pastikan model dimuat
        $this->load->library('session'); // Pastikan session dimuat
    }

    public function login() {
        $this->load->view('login');
    }

    public function login_action() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        // Ambil data user dari database melalui model
        $user = $this->User_model->get_user_by_username($username);

        // Verifikasi password (sesuaikan hashing)
        if ($user && md5($password) === $user->password) {
            $this->session->set_userdata('user_id', $user->id);
            $this->session->set_userdata('role', $user->role);
            redirect('barang'); // Ganti dengan halaman setelah login
        } else {
            $this->session->set_flashdata('error', 'Username atau password salah');
            redirect('auth/login');
        }
    }   

    public function logout() {
        $this->session->sess_destroy();
        redirect('auth/login');
    }

    public function index() {
        log_message('debug', 'Auth controller loaded.');
        $this->load->view('login');
    }
    
    public function signup() {
        $this->load->view('signup');
    }
    
    public function signup_action() {
        $this->load->library('form_validation');
    
        // Validasi input
        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[users.username]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        $this->form_validation->set_rules('password_confirm', 'Konfirmasi Password', 'required|matches[password]');
    
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('signup');
        } else {
            // Hash password sebelum disimpan
            $data = [
                'username' => $this->input->post('username'),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT), // Hashing password
                'role' => 'user', // Default role
            ];
    
            $this->load->model('User_model');
            if ($this->User_model->register_user($data)) {
                $this->session->set_flashdata('success', 'Akun berhasil dibuat. Silakan login.');
                redirect('auth/login');
            } else {
                $this->session->set_flashdata('error', 'Gagal membuat akun. Coba lagi.');
                redirect('auth/signup');
            }
        }
    }    
    
}

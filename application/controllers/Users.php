<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        if (!$this->session->userdata('user_id')) {
            redirect('auth/login');
        }
        // Hanya admin yang bisa mengakses
        if ($this->session->userdata('role') != 'admin') {
            show_error('Anda tidak memiliki akses ke halaman ini.', 403, 'Akses Ditolak');
        }
    }

    public function index() {
        $data['users'] = $this->User_model->get_all_users();
        $this->load->view('users/index', $data);
    }

    public function create() {
        $this->load->view('users/create');
    }

    public function create_action() {
        $data = [
            'username' => $this->input->post('username'),
            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'role' => $this->input->post('role'),
        ];
        $this->User_model->create_user($data);
        redirect('users');
    }

    public function edit($id) {
        $data['user'] = $this->User_model->get_user_by_id($id);
        $this->load->view('users/edit', $data);
    }

    public function edit_action($id) {
        $data = [
            'username' => $this->input->post('username'),
            'role' => $this->input->post('role'),
        ];
        if ($this->input->post('password')) {
            $data['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
        }
        $this->User_model->update_user($id, $data);
        redirect('users');
    }

    public function delete($id) {
        $this->User_model->delete_user($id);
        redirect('users');
    }
}

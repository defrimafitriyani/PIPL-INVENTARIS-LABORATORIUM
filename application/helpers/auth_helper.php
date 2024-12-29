<?php
function check_login() {
    $ci =& get_instance();
    if (!$ci->session->userdata('user_id')) {
        redirect('auth/login');
    }
}

function check_admin() {
    $ci =& get_instance();
    if ($ci->session->userdata('role') != 'admin') {
        redirect('barang');
    }
}

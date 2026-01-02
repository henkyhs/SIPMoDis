<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function is_LoggedIn()
{
	$CI =& get_instance();

    if (!$CI->session->userdata('idUser')) {
        redirect('auth');
        exit;
    }
}

function cekRole($allowed_roles = []) {
    $CI =& get_instance(); // Dapatkan instance CI

    $user_role = $CI->session->userdata('role');

    if (!$user_role || !in_array($user_role, $allowed_roles)) {
        show_error('Akses ditolak. Anda tidak memiliki izin untuk mengakses halaman ini.', 403);
        exit;
    }
	// Role 1 = "Admin", Role 2 = "Peminjam", Role 3 = "Pemberi izin"
}

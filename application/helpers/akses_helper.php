<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function is_LoggedIn()
{
	$CI =& get_instance();

    if (!$CI->session->userdata('idUser')) {
        redirect('auth');
        exit;
    }
}

function require_role($roles = [])
{
    $ci = get_instance();
    is_loggedIn();

    $role = $ci->session->userdata('role');
    if (!is_array($roles)) $roles = [$roles];

    if (!in_array($role, $roles)) {
        // Render 403 SB Admin 2
        $ci->output->set_status_header(403);
        echo $ci->load->view('errors/customs/403', [
            'message' => 'Role Anda tidak diizinkan mengakses fitur ini.'
        ], true);
        exit;
    }
	// Role 1 = "Admin", Role 2 = "Peminjam
}

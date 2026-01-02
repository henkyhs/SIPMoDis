<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    protected $current_user;
    protected $rolE;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper(['url']);

        // cek login
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }

        $this->current_user = $this->session->userdata('user');
        $this->role_id      = $this->session->userdata('role'); // 1=admin,2=peminjam
    }

    protected function require_role($allowed_roles = [])
    {
        if (!in_array($this->role, $allowed_roles)) {
            show_error('Anda tidak memiliki akses ke halaman ini', 403, 'Forbidden');
        }
    }
}

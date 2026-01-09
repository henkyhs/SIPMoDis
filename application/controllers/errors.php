<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Errors extends CI_Controller
{
    public function notfound()
    {
        $this->output->set_status_header(404);
        $this->load->view('errors/customs/404');
    }

    public function forbidden()
    {
        $this->output->set_status_header(403);
        $this->load->view('errors/customs/403', [
            'message' => 'Role Anda tidak diizinkan mengakses fitur ini.'
        ]);
    }

    public function servererror()
    {
        $this->output->set_status_header(500);
        $this->load->view('errors/customs/500', [
            'heading' => 'Server Error',
            'message' => 'Terjadi kesalahan internal.'
        ]);
    }
}

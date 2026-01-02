<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('M_User');
    }

    public function index() {
        if ($this->input->post()) {
            $nip = $this->input->post('nip');
            $password = $this->input->post('password');
            $user = $this->M_User->getNip($nip);

            if ($user && password_verify($password, $user->password)) {
                // Simpan ke session
                 $this->session->set_userdata([
                    'idUser' => $user->idUser,
                    'namaPegawai' => $user->namaPegawai,
                    'nip' => $user->nip,
                    'idSeksi' => $user->idSeksi,
                    'role' => $user->role
                ]);
                redirect('dashboard');
            } else {
                $this->session->set_flashdata('error', 'NIP atau password salah');
            }
        }
		$this->load->view('template/headerAuth');
        $this->load->view('auth/formLogin');
		$this->load->view('template/footerAuth');
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('auth');
    }

    public function lupaPassword() {
        if ($this->input->post()) {
            $nip = $this->input->post('nip');
            $user = $this->M_User->getNip($nip);

            if ($user) {
                $newPassword = $this->input->post('newPassword');
                $confirmPassword = $this->input->post('confirmPassword');

                if ($newPassword === $confirmPassword) {
                    $this->M_User->updatePassword($user->id, $new_password);
                    $this->session->set_flashdata('success', 'Password berhasil diubah.');
                    redirect('auth');
                } else {
                    $this->session->set_flashdata('error', 'Konfirmasi password tidak cocok.');
                }
            } else {
                $this->session->set_flashdata('error', 'Nomor pegawai tidak ditemukan.');
            }
        }

        $this->load->view('auth');
    }
}



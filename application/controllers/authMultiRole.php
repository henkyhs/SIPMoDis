<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
 public function __construct() {
        parent::__construct();
        $this->load->model('M_User');
		$this->load->model('M_Pegawai');
    }
	
	public function index()
	{
		$this->form_validation->set_rules('nip', 'NIP', 'required|numeric');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('template/headerAuth');
			$this->load->view('auth/formLogin');
			$this->load->view('template/footerAuth');
        } else {
            $nip = $this->input->post('nip');
            $password = $this->input->post('password');

            $nipPegawai = $this->M_Pegawai->getNip($nip);

            if (!$nipPegawai) {
                $data['error'] = 'NIP tidak ditemukan.';
                $this->load->view('template/headerAuth');
				$this->load->view('auth/formLogin',$data);
				$this->load->view('template/footerAuth');
                return;
            }

            // Cek semua akun (user) yang terdaftar untuk pegawai ini
            $userList = $this->M_User->getbyPegawai($nipPegawai->idPegawai);

            if (!$userList) {
                $data['error'] = 'Pegawai ini belum memiliki akun login.';
                $this->load->view('template/headerAuth');
				$this->load->view('auth/formLogin',$data);
				$this->load->view('template/footerAuth');
                return;
            }

            // Jika hanya satu akun → langsung login
            if (count($userList) === 1) {
                $user = $userList[0];

                if (password_verify($password, $user->password)) {
                    $this->_set_session($user, $nipPegawai);
                    redirect('dashboard');
                } else {
                    $data['error'] = 'Password salah.';
                    $this->load->view('template/headerAuth');
					$this->load->view('auth/formLogin',$data);
					$this->load->view('template/footerAuth');
                    return;
                }
            }

            // Jika lebih dari satu akun → arahkan ke pilih_role
            $this->session->set_userdata('pegawai_temp', [
                'idPegawai' => $nipPegawai->idPegawai,
                'nip' => $nipPegawai->nip,
                'namaPegawai' => $nipPegawai->namaPegawai,
                'password' => $password // sementara disimpan untuk verifikasi per akun
            ]);

            redirect('#');
        }
	}

	
	public function lupaPassword()
	{
		$this->form_validation->set_rules('nip', 'NIP', 'required');

		if ($this->form_validation->run() === FALSE) {
			$this->load->view('template/headerAuth');
			$this->load->view('auth/lupaPass');
			$this->load->view('template/footerAuth');
		} else {
			$nip = $this->input->post('nip');
			$users = $this->M_Pegawai->getNip($nip);

			if (empty($users)) {
				$data['error'] = 'NIP tidak ditemukan.';
				$this->load->view('template/headerAuth', $data);
				$this->load->view('auth/lupaPass', $data);
				$this->load->view('template/footerAuth', $data);
			} else {
				// Jika lebih dari 1 akun (multi role), tampilkan pilihan
				if (count($users) > 1) {
					$data['userList'] = $users;
					$this->load->view('template/headerAuth', $data);
					$this->load->view('auth/pilihAkunReset', $data);
					$this->load->view('template/footerAuth', $data);
				} else {
					$user = $users[0];
					redirect('auth/resetPassword/' . $user->id_user);
				}
			}
		}
	}

	public function resetPassword($id)
	{
		$user = $this->M_User->getWhere_user()($id);
		if (!$user) {
			show_404();
		}

		$this->form_validation->set_rules('password', 'Password Baru', 'required|min_length[6]');
		$this->form_validation->set_rules('password2', 'Konfirmasi Password', 'required|matches[password]');

		if ($this->form_validation->run() === FALSE) {
			$data['user'] = $user;
			$this->load->view('auth/resetPassword', $data);
		} else {
			$this->M_User->updatePassword($id_user, $this->input->post('password'));
			$this->session->set_flashdata('success', 'Password berhasil direset. Silakan login.');
			redirect('auth/login');
		}
	}

	public function logOut()
	{
		$this->session->sess_destroy();
        redirect('auth');
	}
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct() {
        parent::__construct();

        // Load model dan cek login
        $this->load->model('M_User');
		$this->load->model('M_Seksi');
		// Cek Log In
		is_LoggedIn();
		// Hanya admin (role 1) yang diizinkan
        // cekRole([1]);
    }

    // Tampilkan semua mobil
    public function index() {
        $filters = [
        'nip'   => $this->input->get('nip', TRUE),
        'namaPegawai' => $this->input->get('namaPegawai', TRUE),
        'namaSeksi'   => $this->input->get('namaSeksi', TRUE), // 1/2
        'role'=> $this->input->get('role', TRUE), // 1 tersedia/2 dipinjam/dll
    ];
        $data['filters'] = $filters;
        $data['dataUser']  = $this->M_User->getFiltered($filters);
        $data['title'] =  'Data User';
        $data['total']   = $this->M_User->countFiltered($filters);
        $data['activeMenu'] = 'user';
        // $data['dataUser'] = $this->M_User->getAllData_user();
		// $data['detailUser'] = $this->M_User->getWhere_user($id);
        $data['contentView'] = 'user/index';
        $this->load->view('template/main', $data);
    }

	

    // Tampilkan form tambah
    public function addForm() {
        $data['activeMenu'] = 'user';
        $data['title'] = 'Tambah Data User';
		$data['dataIdUser'] = $this->M_User->createId_user();
		$data['listSeksi'] = $this->M_Seksi->getAllData_seksi();
		$data['contentView'] = 'user/addForm';
        $this->load->view('template/main', $data);
    }

    // Proses simpan data baru
    public function save() {
        $data = [
			'idUser' => $this->input->post('idUser'),
			'namaPegawai' => $this->input->post('namaPegawai'),
			'nip' => $this->input->post('nip'),
			'username'    => $this->input->post('username'),
            'password'    => password_hash('Kantorkita123', PASSWORD_DEFAULT),
			'idSeksi' => $this->input->post('idSeksi'),
            'role'        => $this->input->post('role')
        ];

        $this->M_User->insertData_User($data);
        redirect('user');
    }

    public function formGantiPassword($id)
    {
        $data['user'] = $this->M_User->getWhere_User($id);
        $data['activeMenu'] = 'user';
        $data['title'] = 'Ganti Password';
        $data['contentView'] = 'user/resetPassword';
        $this->load->view('template/main', $data);
    }

    public function gantiPassword($id) {
        $passwordLama = $this->input->post('passwordLama');
        $passwordBaru = $this->input->post('passwordBaru');
        $konfirmasi   = $this->input->post('konfirmasiPassword');
        // Ambil data user
        $user = $this->M_User->getWhere_User($id);

        // Cek password lama
        if (!password_verify($passwordLama, $user->password)) {
            $this->session->set_flashdata('error', 'Password lama salah');
            redirect('user/formGantiPassword/'.$id);
        }

        // Cek konfirmasi
        if ($passwordBaru !== $konfirmasi) {
            $this->session->set_flashdata('error', 'Konfirmasi password tidak sama');
            redirect('user/formGantiPassword/'.$id);
        }
        $data = [
            'password' => password_hash($passwordBaru, PASSWORD_DEFAULT)
        ];
        $this->M_User->update_user($id,$data);
        redirect('dashboard');
    }

    // Proses hapus data
    public function delete($id) {
        $this->M_User->deleteuser($id);
        redirect('user');
    }
}

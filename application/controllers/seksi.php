<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Seksi extends CI_Controller {

    public function __construct() {
        parent::__construct();

        // Load model dan cek login
        $this->load->model('M_Seksi');
		// Cek Log In
		is_LoggedIn();
		// Hanya admin (role 1) yang diizinkan
        // cekRole([1]);
    }

    // Tampilkan semua mobil
    public function index() {
        $data['activeMenu'] = 'seksi';
        $data['title'] = 'Data Seksi';
        $filters = [
        'namaSeksi'        => $this->input->get('namaSeksi', TRUE)
    ];
        $data['filters'] = $filters;
        $data['dataSeksi']  = $this->M_Seksi->getFiltered($filters);
        $data['total']   = $this->M_Seksi->countFiltered($filters);
        $data['contentView'] = 'seksi/index';
        $this->load->view('template/main', $data);
    }

    // Tampilkan form tambah
    public function addForm() {
        $data['activeMenu'] = 'seksi';
        $data['title'] = 'Tambah Data Seksi';
		$data['dataIdSeksi'] = $this->M_Seksi->createId_seksi();
        $data['contentView'] = 'seksi/addForm';
        $this->load->view('template/main', $data);
    }

    // Proses simpan data baru
    public function save() {
        $data = [
			'idSeksi' => $this->input->post('idSeksi'),
            'namaSeksi' => $this->input->post('namaSeksi'),
            'ket' => $this->input->post('ket')
        ];

        $this->M_Seksi->insertData_seksi($data);
        redirect('seksi');
    }

    // Tampilkan form edit
    public function editForm($id) {
        $data['activeMenu'] = 'seksi';
        $data['title'] = 'Update Data Seksi';
        $data['seksi'] = $this->M_Seksi->getWhere_seksi($id);
        $data['contentView'] = 'seksi/updateForm';
        $this->load->view('template/main', $data);
    }

    // Proses update data
    public function update($id) {
        $data = [
            'namaSeksi' => $this->input->post('namaSeksi'),
            'ket' => $this->input->post('ket')
        ];

        $this->M_Seksi->update_seksi($id, $data);
        redirect('seksi');
    }

    // Proses hapus data
    public function delete($id) {
        $this->M_Seksi->delete_seksi($id);
        redirect('seksi');
    }
}

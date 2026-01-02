<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perlengkapan extends CI_Controller {

    public function __construct() {
        parent::__construct();

        // Load model dan cek login
        $this->load->model('M_Perlengkapan');
		// Cek Log In
		 is_LoggedIn();
		// Hanya admin (role 1) yang diizinkan
        // cekRole([1]);
    }

    // Tampilkan semua perlengkapan
    public function index() {
        $data['activeMenu'] = 'perlengkapan';
        $data['title'] = 'Data Perlengakapan';
        $filters = [
        'namaPerlengkapan'        => $this->input->get('namaPerlengkapan', TRUE),
    ];
        $data['filters'] = $filters;
        $data['dataPerlengkapan']  = $this->M_Perlengkapan->getFiltered($filters);
        $data['total']   = $this->M_Perlengkapan->countFiltered($filters);
        $data['contentView'] = 'perlengkapan/index';
        $this->load->view('template/main', $data);
    }

    // Tampilkan form tambah
    public function addForm() {
        $data['activeMenu'] = 'perlengkapan';
        $data['title'] = 'Tambah Data Perlengkapan';
		$data['dataIdPerlengkapan'] = $this->M_Perlengkapan->createId_Perlengkapan();
		$data['contentView'] = 'perlengkapan/addForm';
        $this->load->view('template/main', $data);
    }

    // Proses simpan data baru
    public function save() {
        $this->form_validation->set_rules($this->M_Perlengkapan->rules());
        if ($this->form_validation->run() === FALSE) {
            redirect('perlengkapan/addForm');
        } else {
        $data = [
			'idPerlengkapan' => $this->input->post('idPerlengkapan'),
            'namaPerlengkapan' => $this->input->post('namaPerlengkapan'),
        ];

        $this->M_Perlengkapan->insertData_perlengkapan($data);
        redirect('perlengkapan');
    }
    }

    // Tampilkan form edit
    public function editForm($id) {
        $data['activeMenu'] = 'perlengkapan';
        $data['title'] = 'Update Data Perlengkapan';
        $data['perlengkapan'] = $this->M_Perlengkapan->getWhere_perlengkapan($id);
        $data['contentView'] = 'perlengkapan/updateForm';
        $this->load->view('template/main', $data);
    }

    // Proses update data
    public function update($id) {
        $data = [
            'namaPerlengkapan' => $this->input->post('namaPerlengkapan'),
        ];

        $this->M_Perlengkapan->update_perlengkapan($id, $data);
        redirect('perlengkapan');
    }

    // Proses hapus data
    public function delete($id) {
        $this->M_Perlengkapan->delete_perlengkapan($id);
        redirect('perlengkapan');
    }
}
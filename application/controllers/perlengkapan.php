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
        //  Paginations
        $perPage = 5; //Untuk limit berapa data yang ditampilkan
        $offset  = (int) $this->input->get('per_page'); // CI default query_string_segment = per_page

        $totalRows = $this->M_Perlengkapan->countFiltered($filters);

        $config['base_url']            = site_url('perlengkapan/index');
        $config['total_rows']          = $totalRows;
        $config['per_page']            = $perPage;

        // pakai query string agar filter tetap kebawa
        $config['page_query_string']   = TRUE;
        $config['reuse_query_string']  = TRUE; // 

        // (opsional) styling bootstrap 4 / SB Admin 2
        $config['full_tag_open']   = '<nav><ul class="pagination justify-content-end">';
        $config['full_tag_close']  = '</ul></nav>';
        $config['cur_tag_open']    = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']   = '</span></li>';
        $config['num_tag_open']    = '<li class="page-item">';
        $config['num_tag_close']   = '</li>';
        $config['first_tag_open']  = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open']   = '<li class="page-item">';
        $config['last_tag_close']  = '</li>';
        $config['next_tag_open']   = '<li class="page-item">';
        $config['next_tag_close']  = '</li>';
        $config['prev_tag_open']   = '<li class="page-item">';
        $config['prev_tag_close']  = '</li>';
        $config['attributes']      = ['class' => 'page-link'];

        $this->pagination->initialize($config);
        $data['filters'] = $filters;
        $data['dataPerlengkapan']  = $this->M_Perlengkapan->getFiltered($filters,$perPage,$offset);
        $data['total']     = $totalRows;
        $data['pagination']= $this->pagination->create_links();
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
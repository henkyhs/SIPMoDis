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
     private function _rules()
    {
        $this->form_validation->set_rules(
            'namaSeksi',
            'namaSeksi',
            'required|trim',
            [
                'required' => 'Kolom tidak boleh kosong',
            ]
        );
        
    }   
    // Tampilkan semua mobil
    public function index() {
        $data['activeMenu'] = 'seksi';
        $data['title'] = 'Data Seksi';
        $filters = [
        'namaSeksi'        => $this->input->get('namaSeksi', TRUE)
    ];
    //  Paginations
        $perPage = 5;
        $offset  = (int) $this->input->get('per_page'); // CI default query_string_segment = per_page

        $totalRows = $this->M_Seksi->countFiltered($filters);

        $config['base_url']            = site_url('seksi/index');
        $config['total_rows']          = $totalRows;
        $config['per_page']            = $perPage;

        // pakai query string agar filter tetap kebawa
        $config['page_query_string']   = TRUE;
        $config['reuse_query_string']  = TRUE; 

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
        $data['dataSeksi']  = $this->M_Seksi->getFiltered($filters,$perPage, $offset);
        $data['total']     = $totalRows;
        $data['pagination']= $this->pagination->create_links();
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
        $this->_rules();

        if ($this->form_validation->run() === FALSE) {
            return $this->addForm();
        } else {
        $data = [
			'idSeksi' => $this->input->post('idSeksi'),
            'namaSeksi' => $this->input->post('namaSeksi'),
            'ket' => $this->input->post('ket')
        ];

        $this->M_Seksi->insertData_seksi($data);
        redirect('seksi');
        }
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
        $this->_rules();

        if ($this->form_validation->run() === FALSE) {
            return $this->editForm($id);
        } else {
        $data = [
            'namaSeksi' => $this->input->post('namaSeksi'),
            'ket' => $this->input->post('ket')
        ];

        $this->M_Seksi->update_seksi($id, $data);
        redirect('seksi');
        }
    }

    // Proses hapus data
    public function delete($id) {
        $this->M_Seksi->delete_seksi($id);
        redirect('seksi');
    }
}

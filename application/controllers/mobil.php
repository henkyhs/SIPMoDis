<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mobil extends CI_Controller {

    public function __construct() {
        parent::__construct();

        // Load model dan cek login
        $this->load->model('M_Mobil');
		// Cek Log In
		 is_LoggedIn();
		// Hanya admin (role 1) yang diizinkan
        // cekRole([1]);
    }
    // Rules
    private function _rules()
    {
       
        $this->form_validation->set_rules(
            'namaMobil',
            'namaMobil',
            'required|trim',
            [
                'required' => 'Kolom tidak boleh kosong',
            ]
        );
        $this->form_validation->set_rules(
            'merkMobil',
            'merkMobil',
            'required|trim',
            [
                'required' => 'Kolom tidak boleh kosong',
            ]
        );
        $this->form_validation->set_rules(
            'plat1',
            'plat1',
            'required|trim',
            [
                'required' => 'Kolom tidak boleh kosong',
            ]
        );
        $this->form_validation->set_rules(
            'plat2',
            'plat2',
            'required|trim|numeric',
            [
                'required' => 'Kolom tidak boleh kosong',
                'numeric' => 'Plat harus diisi angka'
            ]
        );
        $this->form_validation->set_rules(
            'plat3',
            'plat3',
            'required|trim',
            [
                'required' => 'Kolom tidak boleh kosong',
            ]
        );
        $this->form_validation->set_rules(
            'noBPKB',
            'noBPKB',
            'required|trim',
            [
                'required' => 'Kolom tidak boleh kosong',
            ]
        );
        $this->form_validation->set_rules(
            'atasNama',
            'atasNama',
            'required|trim',
            [
                'required' => 'Kolom tidak boleh kosong',
            ]
        );

        
    }   

    // Tampilkan semua mobil
    public function index() {
        $data['activeMenu'] = 'mobil';
        $data['title'] = 'Data Mobil';
        // Untuk FIlter
        $filters = [
        'platNomor'   => $this->input->get('platNomor', TRUE),
        'namaMobil'        => $this->input->get('namaMobil', TRUE),
        'transmisi'   => $this->input->get('transmisi', TRUE), // 1/2
        'kondisiMobil'=> $this->input->get('kondisiMobil', TRUE), // 1 tersedia/2 dipinjam/dll
         ];
        //  Paginations
        $perPage = 5; //Untuk limit berapa data yang ditampilkan
        $offset  = (int) $this->input->get('per_page'); // CI default query_string_segment = per_page

        $totalRows = $this->M_Mobil->countFiltered($filters);

        $config['base_url']            = site_url('mobil/index');
        $config['total_rows']          = $totalRows;
        $config['per_page']            = $perPage;

        // pakai query string agar filter tetap kebawa
        $config['page_query_string']   = TRUE;
        $config['reuse_query_string']  = TRUE; // penting: platNomor=... ikut ke link pagination

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
        $data['mobils']  = $this->M_Mobil->getFiltered($filters,$perPage, $offset);
        $data['total']     = $totalRows;
        $data['pagination']= $this->pagination->create_links();
        $data['contentView'] = 'mobil/index';
        $this->load->view('template/main', $data);
    }

    // Tampilkan form tambah
    public function addForm() {
        $data['activeMenu'] = 'mobil';
        $data['title'] = 'Tambah Data Mobil';
		$data['dataIdMobil'] = $this->M_Mobil->createId_Mobil();
        $data['contentView'] = 'mobil/addForm';
        $this->load->view('template/main', $data);
    }

    // Proses simpan data baru
    public function save() {
        $this->_rules();
        if ($this->form_validation->run() === FALSE) {
            return $this->addForm();
        } else {
        $plat1 = strtoupper($this->input->post('plat1'));
        $plat2 = $this->input->post('plat2');
        $plat3 = strtoupper($this->input->post('plat3'));

        $platNomor = trim("$plat1 $plat2 $plat3");
        $data = [
			'idMobil' => $this->input->post('idMobil'),
            'namaMobil' => $this->input->post('namaMobil'),
            'platNomor' => $platNomor,
            'kondisiMobil' => 1,
            'transmisi' => $this->input->post('transmisi'),
            'merkMobil' => $this->input->post('merkMobil'),
            'noBPKB' => $this->input->post('noBPKB'),
            'atasNama' => $this->input->post('atasNama'),
            'ket' => $this->input->post('ket')
        ];

        $this->M_Mobil->insertData_mobil($data);
        redirect('mobil');
        }
    }

    private function _splitPlat($platNomor)
    {
        // Rapikan dulu: huruf besar semua, spasi dirapikan
        $platNomor = strtoupper(trim($platNomor));
        $platNomor = preg_replace('/\s+/', ' ', $platNomor); // ganti spasi berulang jadi satu spasi

        $parts = explode(' ', $platNomor);

        $plat1 = $parts[0] ?? ''; // huruf depan (B / BG)
        $plat2 = $parts[1] ?? ''; // angka (123 / 1234)

        // sisanya digabung sebagai huruf belakang
        if (count($parts) > 2) {
            $plat3 = implode('', array_slice($parts, 2)); // kalau ada lebih dari 1 segmen di belakang
        } else {
            $plat3 = '';
        }

        return [$plat1, $plat2, $plat3];
    }

    // Tampilkan form edit
    public function editForm($id) {
        $data['activeMenu'] = 'mobil';
        $data['title'] = 'Update Data Mobil';
        $data['mobil'] = $this->M_Mobil->getWhere_mobil($id);
         // Pecah plat yang sudah tersimpan
        list($plat1, $plat2, $plat3) = $this->_splitPlat($data['mobil']->platNomor);
        $data['plat1'] = $plat1;
        $data['plat2'] = $plat2;
        $data['plat3'] = $plat3;
        $data['contentView'] = 'mobil/updateForm';
        $this->load->view('template/main', $data);
    }

    // Proses update data
    public function update($id) {
        $this->_rules();
        if ($this->form_validation->run() === FALSE) {
            return $this->editForm($id);
        } else {
        $plat1 = strtoupper($this->input->post('plat1'));
        $plat2 = $this->input->post('plat2');
        $plat3 = strtoupper($this->input->post('plat3'));
        $platNomor = trim("$plat1 $plat2 $plat3");

        $data = [
            'namaMobil' => $this->input->post('namaMobil'),
            'platNomor' => $platNomor,
            'kondisiMobil' => $this->input->post('kondisiMobil'),
            'transmisi' => $this->input->post('transmisi'),
            'merkMobil' => $this->input->post('merkMobil'),
            'noBPKB' => $this->input->post('noBPKB'),
            'atasNama' => $this->input->post('atasNama'),
            'ket' => $this->input->post('ket')
        ];

        $this->M_Mobil->update_mobil($id, $data);
        redirect('mobil');
        }
    }

    public function detailMobil($id)
    {
        $data['activeMenu'] = 'mobil';
        $data['mobil'] = $this->M_Mobil->getwhere_mobil($id);
        $data['contentView'] = 'mobil/detail';
        $this->load->view('template/main', $data);
    }

    // Proses hapus data
    public function delete($id) {
        $this->M_Mobil->delete_mobil($id);
        redirect('mobil');
    }
}

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

    // Tampilkan semua mobil
    public function index() {
        $data['activeMenu'] = 'mobil';
        $data['title'] = 'Data Mobil';
        // $data['dataMobil'] = $this->M_Mobil->getAllData_mobil();
        $filters = [
        'platNomor'   => $this->input->get('platNomor', TRUE),
        'namaMobil'        => $this->input->get('namaMobil', TRUE),
        'transmisi'   => $this->input->get('transmisi', TRUE), // 1/2
        'kondisiMobil'=> $this->input->get('kondisiMobil', TRUE), // 1 tersedia/2 dipinjam/dll
    ];
        $data['filters'] = $filters;
        $data['mobils']  = $this->M_Mobil->getFiltered($filters);
        $data['total']   = $this->M_Mobil->countFiltered($filters);
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
        // $this->form_validation->set_rules($this->M_Mobil->rules());
        // if ($this->form_validation->run() === FALSE) {
        //     redirect('mobil/addForm');
        // } else {
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
    // }
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

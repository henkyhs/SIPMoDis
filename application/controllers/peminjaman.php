<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Peminjaman extends CI_Controller {

    public function __construct() {
        parent::__construct();

        // Load model dan cek login
        $this->load->model('M_Peminjaman');
		$this->load->model('M_Mobil');
        $this->load->model('M_Perlengkapan');
		// Cek Log In
		 is_LoggedIn();
		// Hanya admin (role 1) yang diizinkan
        // cekRole([1]);
		
    }
    // All Role
    public function detailPeminjaman($id)
    {
        $role = $this->session->userdata('role');
        $data['pinjam'] = $this->M_Peminjaman->getWhere_pengajuan($id);
        $data['title'] = 'Detail Peminjaman';
        $data['pinjamPerlengkapan'] = $this->M_Perlengkapan->getByPeminjaman($id);
        $data['logs']  = $this->M_Peminjaman->getwhere_log($id);
        if ($role==1):{
            $data['activeMenu']  = 'peminjaman/' ;
        }
    else:{
            $data['activeMenu'] = 'peminjaman/indexPeminjaman';
        }
    endif;
        $data['contentView'] = 'pinjamAdmin/detailPeminjaman';
        $this->load->view('template/main', $data);

    }
    // Admin
    // Menampilkan semua riwayat peminjaman
	public function index() { 
        $data['activeMenu'] = 'peminjaman';
        $data['title'] = 'Riwayat Peminjaman';
        // $data['dataPeminjamanAll'] = $this->M_Peminjaman->getAllData_peminjaman();
         $filters = [
        'namaPegawai'   => $this->input->get('namaPegawai', TRUE),
        'namaSeksi'        => $this->input->get('namaSeksi', TRUE),
        'tglPeminjaman'   => $this->input->get('tglPeminjaman', TRUE), // 1/2
        'statusPinjam'=> $this->input->get('statusPinjam', TRUE),
        'keperluan'=> $this->input->get('keperluan', TRUE), // 1 tersedia/2 dipinjam/dll
    ];
         //  Paginations
        $perPage = 20; //Untuk limit berapa data yang ditampilkan
        $offset  = (int) $this->input->get('per_page'); // CI default query_string_segment = per_page

        $totalRows = $this->M_Peminjaman->countFilteredAll($filters);

        $config['base_url']            = site_url('peminjaman/index');
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
        $data['dataPeminjamanAll'] =  $this->M_Peminjaman->getFilteredAll($filters,$perPage,$offset);
        $data['total']     = $totalRows;
        $data['pagination']= $this->pagination->create_links();
        $data['contentView'] = 'pinjamAdmin/index';
        $this->load->view('template/main', $data);
    }

    // Menampilkan List Pengajuan Peminjaman
    public function indexButuhPersetujuan()
    {
        $data['activeMenu'] = 'pengajuan';
        $data['title'] = 'Data Pengajuan Peminjaman';
        $status = 1;
        $filters = [
        'namaPegawai'   => $this->input->get('namaPegawai', TRUE),
        'namaSeksi'        => $this->input->get('namaSeksi', TRUE),
        'tglPeminjaman'   => $this->input->get('tglPeminjaman', TRUE), // 1/2
        'statusPinjam'=> $this->input->get('statusPinjam', TRUE),
        'keperluan'=> $this->input->get('keperluan', TRUE), // 1 tersedia/2 dipinjam/dll
    ];
        //  Paginations
        $perPage = 20; //Untuk limit berapa data yang ditampilkan
        $offset  = (int) $this->input->get('per_page'); // CI default query_string_segment = per_page

        $totalRows = $this->M_Peminjaman->countFilteredByStatus($filters,$status);

        $config['base_url']            = site_url('peminjaman/indexButuhPersetujuan');
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
        $data['dataPengajuan'] =  $this->M_Peminjaman->getFilteredByStatus($filters,$status,$perPage,$offset);
        $data['total']     = $totalRows;
        $data['pagination']= $this->pagination->create_links();
        $data['contentView'] = 'pinjamAdmin/indexPengajuan';
        $this->load->view('template/main', $data);
    }
    // Menampilkan List Pengambilan Kunci
    public function indexPengambilanKunci()
    {
        $data['activeMenu'] = 'pengambilan';
        $data['title'] = 'Data Pengambilan Kunci';
        $status = 2;
        $filters = [
            'namaPegawai'   => $this->input->get('namaPegawai', TRUE),
            'namaSeksi'        => $this->input->get('namaSeksi', TRUE),
            'tglPeminjaman'   => $this->input->get('tglPeminjaman', TRUE), // 1/2
            'statusPinjam'=> $this->input->get('statusPinjam', TRUE),
            'keperluan'=> $this->input->get('keperluan', TRUE), // 1 tersedia/2 dipinjam/dll
        ];
        //  Paginations
        $perPage = 20; //Untuk limit berapa data yang ditampilkan
        $offset  = (int) $this->input->get('per_page'); // CI default query_string_segment = per_page

        $totalRows = $this->M_Peminjaman->countFilteredByStatus($filters,$status);

        $config['base_url']            = site_url('peminjaman/indexPengambilanKunci');
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
        $data['dataPengambilan'] =  $this->M_Peminjaman->getFilteredByStatus($filters,$status,$perPage,$offset);
        $data['total']     = $totalRows;
        $data['pagination']= $this->pagination->create_links();
        $data['contentView'] = 'pinjamAdmin/indexPengambilanKunci';
        $this->load->view('template/main', $data);
    }
    // Menampilkan List Pengembalian Kunci
    public function indexPengembalianKunci()
    {
        $data['activeMenu'] = 'pengembalian';
        $data['title'] = 'Data Pengembalian Kunci';
        $status = 4;
         $filters = [
            'namaPegawai'   => $this->input->get('namaPegawai', TRUE),
            'namaSeksi'        => $this->input->get('namaSeksi', TRUE),
            'tglPeminjaman'   => $this->input->get('tglPeminjaman', TRUE), // 1/2
            'statusPinjam'=> $this->input->get('statusPinjam', TRUE),
            'keperluan'=> $this->input->get('keperluan', TRUE), // 1 tersedia/2 dipinjam/dll
        ];
        //  Paginations
        $perPage = 20; //Untuk limit berapa data yang ditampilkan
        $offset  = (int) $this->input->get('per_page'); // CI default query_string_segment = per_page

        $totalRows = $this->M_Peminjaman->countFilteredByStatus($filters,$status);

        $config['base_url']            = site_url('peminjaman/indexPengembalianKunci');
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
        $data['dataPengembalian'] =  $this->M_Peminjaman->getFilteredByStatus($filters,$status,$perPage,$offset);
        $data['total']     = $totalRows;
        $data['pagination']= $this->pagination->create_links();
        $data['contentView'] = 'pinjamAdmin/indexPengembalian';
        $this->load->view('template/main', $data);
    }

     // Form Pengecekkan Pengajuan Peminjaman
    public function formPengecekkanPengajuan($id)
    {
        $data['activeMenu'] = 'pengajuan';
        $data['title'] = 'Pengecekkan Pengajuan';
        $data['pinjam'] = $this->M_Peminjaman->getWhere_pengajuan($id);
        $preferensi = $data['pinjam']->preferensiTransmisi;
        $data['plat'] = $this->M_Peminjaman->pilihMobil($preferensi);
        $data['contentView'] = 'pinjamAdmin/formPengecekkanPengajuan';
        $this->load->view('template/main', $data);
    }
    // Untuk Generate Token
    private function _generateToken($length = 8)
    {
        $chars = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789'; 
        // tanpa I, O, 0, 1 → menghindari salah baca

        $token = '';
        $max = strlen($chars) - 1;

        for ($i = 0; $i < $length; $i++) {
            $token .= $chars[random_int(0, $max)];
        }

        return $token;
    }
    // Untuk menyetujui peminjaman
    public function savePersetujuanPengajuan($id)
    {
        $token = $this->_generateToken(8);
        $idMobil = $this->input->post('idMobil');
        // Untuk update status persetujuan di tbl_peminjaman
		$data = [
			'idMobil' => $idMobil,
            'statusPinjam' => 2,
            'token' => $token,
            'idVerifikator' => $this->session->userdata('idUser'),
		];
        // Untuk update di tbl_log
        $idLog = $this->M_Peminjaman->createId_Log();
        $dataLog = [
            'idLog' => $idLog,
            'idPeminjaman'=> $id,
            'aksi' => 2,
            'idUser' => $this->session->userdata('idUser'),
            'createdAt' => date('Y-m-d H:i:s')
        ];
        // Untuk update status mobil di tbl_mobil
        $dataMobil = ['kondisiMobil'=>2];

		$this->M_Peminjaman->update_mobilPinjam($idMobil,$dataMobil);
        $this->M_Peminjaman->insertData_log($dataLog);
		$this->M_Peminjaman->update_Peminjaman($id, $data);
		$this->session->set_flashdata('success', 'Data berhasil diperbarui');
		redirect('peminjaman/indexButuhPersetujuan');
    }

    // Form Jika Pengajuan Ditolak
     public function formPenolakanPengajuan($id)
    {
        $data['activeMenu'] = 'pengajuan';
        $data['title'] = 'Penolakan Pengajuan';
        $data['pinjam'] = $this->M_Peminjaman->getWhere_pengajuan($id);
        $data['contentView'] = 'pinjamAdmin/formPenolakanPengajuan';
        $this->load->view('template/main', $data);
    }
    // Untuk proses penolakan
    public function penolakanPengajuan($id)
    {
         $data = [
            'catatanInspeksi' => $this->input->post('catatanInspeksi'),
			'idVerifikator' => $this->session->userdata('idUser'),
			'statusPinjam' => 5
        ];
        $idLog = $this->M_Peminjaman->createId_Log();
        $dataLog = [
            'idLog' => $idLog,
            'idPeminjaman'=> $id,
            'aksi' => 5,
            'idUser' => $this->session->userdata('idUser'),
            'createdAt' => date('Y-m-d H:i:s')
        ];
        $this->M_Peminjaman->insertData_log($dataLog);
        $this->M_Peminjaman->update_Peminjaman($id, $data);
        redirect('peminjaman/indexButuhPersetujuan');
    }

    // Form pengambilan kunci dan verifikasi token
     public function formPengambilanKunci($id)
    {
        $data['activeMenu'] = 'pengambilan';
        $data['title'] = 'Pengambilan Kunci';
        $data['pinjam'] = $this->M_Peminjaman->getWhere_pengajuan($id);
        $data['perlengkapan'] = $this->M_Perlengkapan->getAllData_perlengkapan();
        $data['contentView'] = 'pinjamAdmin/formPengambilanKunci';
        $this->load->view('template/main', $data);
    }

    // Untuk verifikasi token
    private function _verifikasiToken($tokenInput, $tokenDb, $statusDb)
    {
        $tokenInput = strtoupper(trim((string)$tokenInput));
        $tokenDb    = strtoupper(trim((string)$tokenDb));

        // harus status disetujui dulu (ubah sesuai mapping kamu)
        $STATUS_DISETUJUI = 2;

        if ($statusDb !== $STATUS_DISETUJUI) return FALSE;
        if ($tokenDb === '') return FALSE;

        // gunakan hash_equals biar aman dari timing attack (bagus walau internal)
        return hash_equals($tokenDb, $tokenInput);
    }

    private function _verifyToken($tokenInput, $tokenDb, $statusDb)
    {
        $tokenInput = strtoupper(trim((string)$tokenInput));
        $tokenDb    = strtoupper(trim((string)$tokenDb));

        // harus status disetujui dulu (ubah sesuai mapping kamu)
        // $STATUS_DISETUJUI = 2;

        // if ($statusDb !== $STATUS_DISETUJUI) return FALSE;
        if ($tokenDb === '') return FALSE;

        // gunakan hash_equals biar aman dari timing attack (bagus walau internal)
        return hash_equals($tokenDb, $tokenInput);
    }

    // Untuk proses pengambilan kunci 
    public function pengambilanKunci($id)
    {
        // Input token
         $tokenInput = strtoupper(trim($this->input->post('token', TRUE)));
        // Kalau token tidak diisi
        if ($tokenInput === '') {
            $this->session->set_flashdata('error', 'Token wajib diisi.');
            return redirect('peminjaman/formPengambilanKunci/'.$id);
        }
        // Kalau pengajuan invalid
        $row = $this->M_Peminjaman->getWhere_pengajuan($id);
        if (!$row) {
            $this->session->set_flashdata('error', 'Data  Pengajuan Invalid');
            return redirect('peminjaman/formPengambilanKunci/'.$id);
        }
             // verifikasi token di controller (private)
        if (!$this->_verifyToken($tokenInput, $row->token, $row->statusPinjam)) {
            $this->session->set_flashdata('error', 'Token tidak cocok');
            return redirect('peminjaman/formPengambilanKunci/'.$id);
        }
        // Update tabel peminjaman
         $data = [
			'idPemberi' => $this->session->userdata('idUser'),
			'statusPinjam' => 3
        ];

         // Untuk Peminjaman Perlengkapan Supporting

        if ($this->input->post()) {
            $perlengkapanSupport = $this->input->post('perlengkapanSupport'); // array checkbox
            $perlengkapanSupport = is_array($perlengkapanSupport) ? $perlengkapanSupport: [];

            $this->M_Perlengkapan->setPerlengkapanDikembalikan($id, $perlengkapanSupport);

            //  $this->session->set_flashdata('success', 'Checklist pengembalian kamu berhasil disimpan. Menunggu inspeksi petugas.');
            // redirect('peminjaman/indexPeminjam');
        }
        $idLog = $this->M_Peminjaman->createId_Log();
        $dataLog = [
            'idLog' => $idLog,
            'idPeminjaman'=> $id,
            'aksi' => 3,
            'idUser' => $this->session->userdata('idUser'),
            'createdAt' => date('Y-m-d H:i:s')
        ];
        $this->M_Perlengkapan->insertData_peminjamanperlengkapan($id, $perlengkapanSupport);
        $this->M_Peminjaman->insertData_log($dataLog);
        $this->M_Peminjaman->update_Peminjaman($id, $data);
        redirect('peminjaman/indexPengambilanKunci');
    }

     // Form untuk mengembalikan kunci
    public function formPenerimaanKunci($id)
    {
        $data['activeMenu'] = 'dashboard';
        $data['title'] = 'Penerimaan Kunci';
        $data['pinjam'] = $this->M_Peminjaman->getWhere_pengajuan($id);
        $idPeminjaman = $data['pinjam']->idPeminjaman;
        $data['perlengkapan'] = $this->M_Perlengkapan->getbyPeminjaman($idPeminjaman);;
        $data['contentView'] = 'pinjamAdmin/formPenerimaanKunci';
        $this->load->view('template/main', $data);
    }

    // private function _verifyPengembalianPerlengkapan($isDikembalikan,$isAda)
    // {
    //   return ((int)$isDikembalikan === (int)$isAda) ? 1 : 0;
    // }

    // Proses pengembalian kunci
    public function penerimaanKunci($id)
    {
        $mobil = $this->M_Peminjaman->getWhere_pengajuan($id);
        $idMobil = $mobil->idMobil;
        $detail = $this->M_Perlengkapan->getbyPeminjaman($id);
        $isDikembalikan = $detail->isDikembalikan;
        $data = [
            'bensinInspeksi' => $this->input->post('bensinInspeksi'),
            'catatanInspeksi' => $this->input->post('catatanInspeksi'),
            'statusPinjam' => $this->input->post('statusPinjam'),
            'idPenerima' => $this->session->userdata('idUser'),
            'tglPengembalian' => date('Y-m-d')
        ];
        //Update perlengkapan (jika ada checklist)
        $perlengkapan = $this->input->post('perlengkapanSupport');
        if (is_array($perlengkapan)) {
            $this->M_Perlengkapan->setPerlengkapanInspeksi($id, $perlengkapan);
        }
        //  $status = 1; // default lengkap
        // foreach ($detail as $d) {
        //     if (!$this->_verifyPengembalianPerlengkapan($d['isDikembalikan'=, $d['isAda'])) {
        //         $status = 2; // tidak lengkap
        //         break;
        //     }
        // }
        $idLog = $this->M_Peminjaman->createId_Log();
        $dataLog = [
            'idLog' => $idLog,
            'idPeminjaman'=> $id,
            'aksi' => $this->input->post('statusPinjam'),
            'idUser' => $this->session->userdata('idUser'),
            'createdAt' => date('Y-m-d H:i:s')
        ];
        $this->M_Peminjaman->insertData_log($dataLog);
		$this->M_Peminjaman->update_Peminjaman($id, $data);
        $dataMobil = ['kondisiMobil'=>1];
        $this->M_Peminjaman->update_mobilPinjam($idMobil,$dataMobil);
        redirect('peminjaman/');
    }

     public function penyelesaianPengajuan($id)
    {
        $mobil = $this->M_Peminjaman->getWhere_pengajuan($id);
        $idMobil = $mobil->idMobil;
         $data = [
			'statusPinjam' => 8
        ];
        $idLog = $this->M_Peminjaman->createId_Log();
        $dataLog = [
            'idLog' => $idLog,
            'idPeminjaman'=> $id,
            'aksi' => 8,
            'idUser' => $this->session->userdata('idUser'),
            'createdAt' => date('Y-m-d H:i:s')
        ];
        $this->M_Peminjaman->insertData_log($dataLog);
        $this->M_Peminjaman->update_Peminjaman($id, $data);
        redirect('peminjaman/indexPeminjam');
    }
    // Untuk Pelaporan 
    public function exportExcel()
    {
        $mode = $this->input->post('range');

        // Tentukan range tanggal
        if ($mode === '7hari') {
            $start = date('Y-m-d', strtotime('-6 days'));
            $end   = date('Y-m-d');
        } 
        elseif ($mode === 'bulan') {
            $start = date('Y-m-01');
            $end   = date('Y-m-t');
        } 
        else {
            // custom
            $start = $this->input->post('tglMulai');
            $end   = $this->input->post('tglSelesai');
        }

        if (!$start || !$end) {
            $this->session->set_flashdata('error', 'Rentang tanggal tidak valid');
            redirect('peminjaman');
        }

        $data = $this->M_Peminjaman->getByTgl($start, $end);
        // var_dump($data);
        // die;

        // $this->load->helper('excel');
        export_peminjaman_excel($data, $start, $end);
    }

    // Peminjam
    // Menampilkan riwayat peminjaman dari peminjam
    public function indexPeminjam()
    {
        $id = $this->session->userdata('idUser');
        $data['title'] = 'Riwayat Peminjaman';
        $data['activeMenu'] = 'seksi';
         $filters = [
        'namaPegawai'   => $this->input->get('namaPegawai', TRUE),
        'namaSeksi'        => $this->input->get('namaSeksi', TRUE),
        'tglPeminjaman'   => $this->input->get('tglPeminjaman', TRUE), // 1/2
        'statusPinjam'=> $this->input->get('statusPinjam', TRUE),
        'keperluan'=> $this->input->get('keperluan', TRUE), // 1 tersedia/2 dipinjam/dll
    ];
        //  Paginations
        $perPage = 20; //Untuk limit berapa data yang ditampilkan
        $offset  = (int) $this->input->get('per_page'); // CI default query_string_segment = per_page

        $totalRows = $this->M_Peminjaman->countFilteredByUser($filters,$id);

        $config['base_url']            = site_url('peminjaman/indexPeminjam');
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
        $data['dataPinjam'] =  $this->M_Peminjaman->getFilteredByUser($filters,$id,$perPage,$offset);
        $data['total']     = $totalRows;
        $data['pagination']= $this->pagination->create_links();
        $data['contentView'] = 'pinjamUser/index';
        $this->load->view('template/main', $data);
    }
    // Form untuk mengajukan peminjaman
    public function formSavePengajuan()
    {
        $data['activeMenu'] = 'seksi';
        $data['title'] = 'Pengajuan Peminjaman';
        $idUser = $this->session->userdata('idUser');
        $idSeksi = $this->session->userdata('idSeksi');
        // // Cek dulu
        if ($this->M_Peminjaman->cekStatusPinjam($idUser)) {
            $this->session->set_flashdata('errorGantung', 'Pengajuan ditolak: Anda masih memiliki peminjaman yang belum selesai.');
            return redirect('peminjaman/indexPeminjam');
        }

        if ($this->M_Peminjaman->hasCatatanPengembalianBySeksi($idSeksi)) {
            $data['warningCatatan'] = true;
        } else {
            $data['warningCatatan'] = false;
        }

		$data['dataIdPinjam'] = $this->M_Peminjaman->createId_Pinjam();
         $data['contentView'] = 'pinjamUser/formAddPengajuan';
        $this->load->view('template/main', $data);
    }
    
    // Menyimpan Pengajuan sebagai draft atau mengajukan Pengajuan Peminjaman
    public function savePengajuan()
    {
        // Untuk Lampiran
    $config['upload_path'] = './uploads/lampiran/';
    $config['allowed_types'] = 'pdf';
    $config['max_size'] = 2048; // dalam KB, 2048 KB = 2 MB
    $config['encrypt_name'] = TRUE;

    $this->upload->initialize($config);

    $lampiran = null;

    if ($_FILES['lampiran']['name']) {
        if ($this->upload->do_upload('lampiran')) {
            $upload_data = $this->upload->data();
            $lampiran = $upload_data['file_name'];
        } else {
            $this->session->set_flashdata('error', $this->upload->display_errors());
            redirect('peminjaman/ajukan');
        }
    }	
    // Save data 
    // ===== Rule lampiran wajib jika visit =====
    $keperluan = $this->input->post('keperluan');
    $isVisit = ($keperluan === 1);
    $hasFile = (!empty($_FILES['lampiran']['name']));

    if ($isVisit && !$hasFile) {
        $this->session->set_flashdata('error', 'Lampiran wajib untuk keperluan Visit.');
        return redirect('peminjaman/formSavePengajuan');
    }
          $data = [
			'idPeminjaman' => $this->input->post('idPeminjaman'),
            'idPeminjam' => $this->session->userdata('idUser'),
            'tglPeminjaman' => $this->input->post('tglPeminjaman'),
            'statusPinjam' => $this->input->post('statusPinjam'),
            'keperluan' => $keperluan,
            'tujuan' => $this->input->post('tujuan'),
            'preferensiTransmisi'  => $this->input->post('preferensiTransmisi'),
            'lampiran' => $lampiran,
            'idSeksi' => $this->session->userdata('idSeksi'),
            'createdAt' => date('Y-m-d H:i:s'),
            'updatedAt' => date('Y-m-d H:i:s')
        ];
        $idLog = $this->M_Peminjaman->createId_Log();
        $dataLog = [
            'idLog' => $idLog,
            'idPeminjaman'=> $this->input->post('idPeminjaman'),
            'aksi' => $this->input->post('statusPinjam'),
            'idUser' => $this->session->userdata('idUser'),
            'createdAt' => date('Y-m-d H:i:s')
        ];
        $this->M_Peminjaman->insertData_log($dataLog);
        $this->M_Peminjaman->insertData_peminjaman($data);
        redirect('peminjaman/indexPeminjam');
    }

    // Form Update Pengajuan
    public function formUpdatePengajuan($id)
    {
        $data['activeMenu'] = 'seksi';
        $data['title'] = 'Update Draft Pengajuan';
        $data['pinjam'] = $this->M_Peminjaman->getWhere_pengajuan($id);
         $data['contentView'] = 'pinjamUser/formUpdatePengajuan';
        $this->load->view('template/main', $data);
    }

    // Untuk menyimpan hasil update form pengajuan
    public function updatePengajuan($id)
    {
        $data['mobilTersedia'] = $this->M_Mobil->getMobilTersedia();
		$lampiranLama = $this->input->post('lampiran_lama');
		$lampiran = $this->M_Peminjaman->handleLampiranUpload($lampiranLama);

		$data = [
			'tglPeminjaman' => $this->input->post('tglPeminjaman'),
            'statusPinjam' => $this->input->post('statusPinjam'),
            'keperluan' => $this->input->post('keperluan'),
            'tujuan' => $this->input->post('tujuan'),
            'preferensiTransmisi'  => $this->input->post('preferensiTransmisi'),
            'lampiran' => $lampiran
		];
        $idLog = $this->M_Peminjaman->createId_Log();
        $dataLog = [
            'idLog' => $idLog,
            'idPeminjaman'=> $id,
            'aksi' => $this->input->post('statusPinjam'),
            'idUser' => $this->session->userdata('idUser'),
            'createdAt' => date('Y-m-d H:i:s')
        ];
        $this->M_Peminjaman->insertData_log($dataLog);
		$this->M_Peminjaman->update_Peminjaman($id, $data);
		$this->session->set_flashdata('success', 'Data berhasil diperbarui');
		redirect('peminjaman/indexPeminjam');
    }

    // Proses hapus data
    public function deleteDraft($id) {
        $this->M_Peminjaman->delete_draft($id);
        $idLog = $this->M_Peminjaman->createId_Log();
        $dataLog = [
            'idLog' => $idLog,
            'idPeminjaman'=> $id,
            'aksi' => 9,
            'idUser' => $this->session->userdata('idUser'),
            'createdAt' => date('Y-m-d H:i:s')
        ];
        $this->M_Peminjaman->insertData_log($dataLog);
        redirect('peminjaman/indexPeminjam');
    }

    // Form untuk mengembalikan kunci
    public function formPengembalianKunci($id)
    {
        $data['activeMenu'] = 'dashboard';
        $data['title'] = 'Pengembalian Kunci';
        $data['pinjam'] = $this->M_Peminjaman->getWhere_pengajuan($id);
        $idPeminjaman = $data['pinjam']->idPeminjaman;
        $data['perlengkapan'] = $this->M_Perlengkapan->getbyPeminjaman($idPeminjaman);
        $data['contentView'] = 'pinjamUser/formPengembalianKunci';
        $this->load->view('template/main', $data);
    }
    // Proses pengembalian kunci
    public function pengembalianKunci($id)
    {
        $data = [
            'bensinPemakaian' => $this->input->post('bensinPemakaian'),
            'catatanPeminjam' => $this->input->post('catatanPinjaman'),
            'statusPinjam' => 4
        ];
        //Update perlengkapan (jika ada checklist)
        $perlengkapan = $this->input->post('perlengkapanSupport');

        if ($this->input->post()) {
            $perlengkapan = $this->input->post('perlengkapanSupport'); // array checkbox
            $perlengkapan = is_array($perlengkapan) ? $perlengkapan: [];

            $this->M_Perlengkapan->setPerlengkapanDikembalikan($id, $perlengkapan);

            //  $this->session->set_flashdata('success', 'Checklist pengembalian kamu berhasil disimpan. Menunggu inspeksi petugas.');
            // redirect('peminjaman/indexPeminjam');
        }

        $idLog = $this->M_Peminjaman->createId_Log();
        $dataLog = [
            'idLog' => $idLog,
            'idPeminjaman'=> $id,
            'aksi' => 4,
            'idUser' => $this->session->userdata('idUser'),
            'createdAt' => date('Y-m-d H:i:s')
        ];
        $this->M_Peminjaman->insertData_log($dataLog);
		$this->M_Peminjaman->update_Peminjaman($id, $data);
        redirect('peminjaman/indexPeminjam');
    }

    // Untuk proses pembatalan
    public function pembatalanPengajuan($id)
    {
        $mobil = $this->M_Peminjaman->getWhere_pengajuan($id);
        $idMobil = $mobil->idMobil;
         $data = [
			'idPeminjam' => $this->session->userdata('idUser'),
			'statusPinjam' => 6
        ];
        $idLog = $this->M_Peminjaman->createId_Log();
        $dataLog = [
            'idLog' => $idLog,
            'idPeminjaman'=> $id,
            'aksi' => 6,
            'idUser' => $this->session->userdata('idUser'),
            'createdAt' => date('Y-m-d H:i:s')
        ];
        $this->M_Peminjaman->insertData_log($dataLog);
        $this->M_Peminjaman->update_Peminjaman($id, $data);
         if(!$pinjam->idMobil == ""){
            $dataMobil = ['kondisiMobil'=>1];
            $this->M_Peminjaman->update_mobilPinjam($idMobil,$dataMobil);
        }
        redirect('peminjaman/indexPeminjam');
    }
   
}

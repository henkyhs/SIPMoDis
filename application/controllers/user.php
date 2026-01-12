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
    // Cek NIP apakah sudah terdaftar atau belum
    public function nipUnique($nip, $idUser)
    {
        $this->db->where('nip', $nip);
        $this->db->where('idUser !=', $idUser);
        $exists = $this->db->get('tbl_userpegawai')->num_rows();

        if ($exists > 0) {
            $this->form_validation->set_message('nip_unique', 'NIP telah terdaftar');
            return false;
        }
        return true;
    }

    // Rules
    private function _rules($idUser = null)
    {
        $nip_rules = 'required|trim|numeric|exact_length[9]';

        // CREATE: wajib unique
        // UPDATE: unique tapi kecualikan id yang sedang diedit
        if ($idUser) {
            $nip_rules .= '|callback_nipUnique['.$idUser.']';
        } else {
            $nip_rules .= '|is_unique[tbl_userpegawai.nip]';
        }

        $this->form_validation->set_rules(
            'nip',
            'NIP',
            $nip_rules,
            [
                'required' => 'Kolom tidak boleh kosong',
                'numeric' => 'NIP harus berupa angka',
                'exact_length' => 'NIP harus 9 digit',
                'is_unique' => 'NIP telah terdaftar',
                'nipUnique' => 'NIP telah terdaftar'
            ]
        );

        $this->form_validation->set_rules(
            'namaPegawai',
            'Nama Pegawai',
            'required|trim',
            ['required' => 'Kolom tidak boleh kosong']
        );

        $this->form_validation->set_rules(
            'idSeksi',
            'Seksi',
            'required',
            ['required' => 'Kolom tidak boleh kosong']
        );

        $this->form_validation->set_rules(
            'role',
            'Role',
            'required',
            ['required' => 'Kolom tidak boleh kosong']
        );

        $this->form_validation->set_rules(
            'noHp',
            'No HP',
            'required|trim|numeric',
            [
                'required' => 'Kolom tidak boleh kosong',
                'numeric' => 'No HP harus berupa angka'
            ]
        );
    }   

    
    // Tampilkan semua mobil
    public function index() {
        require_role('1');
        $filters = [
        'nip'   => $this->input->get('nip', TRUE),
        'namaPegawai' => $this->input->get('namaPegawai', TRUE),
        'namaSeksi'   => $this->input->get('namaSeksi', TRUE), // 1/2
        'role'=> $this->input->get('role', TRUE), // 1 tersedia/2 dipinjam/dll
    ];
        //  Paginations
        $perPage = 20; //Untuk limit berapa data yang ditampilkan
        $offset  = (int) $this->input->get('per_page'); // CI default query_string_segment = per_page

        $totalRows = $this->M_User->countFiltered($filters);

        $config['base_url']            = site_url('user/index');
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
        $data['dataUser']  = $this->M_User->getFiltered($filters,$perPage,$offset);
        $data['title'] =  'Data User';
        $data['total']     = $totalRows;
        $data['pagination']= $this->pagination->create_links();
        $data['activeMenu'] = 'user';
        // $data['dataUser'] = $this->M_User->getAllData_user();
		// $data['detailUser'] = $this->M_User->getWhere_user($id);
        $data['contentView'] = 'user/index';
        $this->load->view('template/main', $data);
    }

	

    // Tampilkan form tambah
    public function addForm() {
         require_role('1');
        $data['activeMenu'] = 'user';
        $data['title'] = 'Tambah Data User';
		$data['dataIdUser'] = $this->M_User->createId_user();
		$data['listSeksi'] = $this->M_Seksi->getAllData_seksi();
		$data['contentView'] = 'user/addForm';
        $this->load->view('template/main', $data);
    }

    // Proses simpan data baru
    public function save() {
        $this->_rules();

        if ($this->form_validation->run() === FALSE) {
            return $this->addForm();
        } else {
             $data = [
			'idUser' => $this->input->post('idUser'),
			'namaPegawai' => $this->input->post('namaPegawai'),
			'nip' => $this->input->post('nip'),
            'password'    => password_hash('Kantorkita123', PASSWORD_DEFAULT),
            'noHp' => $this->input->post('noHp'),
			'idSeksi' => $this->input->post('idSeksi'),
            'role'        => $this->input->post('role'),
            'isActive' => 1,
            'createdAt' =>  date('Y-m-d H:i:s'),
            'updatedAt' => date('Y-m-d H:i:s')
        ];
        $this->M_User->insertData_User($data);
         $this->session->set_flashdata('successAdd', 'Data berhasil ditambahkan');
        redirect('user');        
        }
       
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

    public function gantiStatus($id)
    {
        if ($id === $this->session->userdata('idUser')) {
            $this->session->set_flashdata('error', 'Tidak bisa mengubah status akun sendiri');
            redirect('user');
        }
        $data = [
            'isActive' => $this->input->post('isActive'),
            'updatedAt' => date('Y-m-d H:i:s')
        ];
        $this->M_User->update_user($id,$data);
        redirect('user/editForm/'.$id);
    }

    // Tampilkan form profil saya
    public function profilSaya() {
        $id = $this->session->userdata('idUser');
        $data['activeMenu'] = 'dashboard';
        $data['title'] = 'Profil Saya';
        $data['user'] = $this->M_User->getWhere_user($id);
        $data['contentView'] = 'user/profilSaya';
        $this->load->view('template/main', $data);
    }
    // Tampilkan form edit
    public function editForm($id) {
         require_role('1');
        $data['activeMenu'] = 'user';
        $data['title'] = 'Update Data User';
        $data['user'] = $this->M_User->getWhere_user($id);
        $data['listSeksi'] = $this->M_Seksi->getAllData_seksi();
        $data['contentView'] = 'user/updateForm';
        $this->load->view('template/main', $data);
    }

    // Proses update data
    public function update($id) {
        $this->_rules($id);

        if ($this->form_validation->run() === FALSE) {
            return $this->editForm($id);
        } else {
        $data = [
            'namaPegawai' => $this->input->post('namaPegawai'),
			'nip' => $this->input->post('nip'),
            'noHp' => $this->input->post('noHp'),
			'idSeksi' => $this->input->post('idSeksi'),
            'role'        => $this->input->post('role'),
            'updatedAt' =>  date('Y-m-d H:i:s')
        ];

        $this->M_User->update_user($id, $data);
        $this->session->set_flashdata('successUpdate', 'Data berhasil diubah');
        redirect('user');
        }
    }

    // Proses hapus data
    public function delete($id) {
        $this->M_User->deleteuser($id);
        redirect('user');
    }
}

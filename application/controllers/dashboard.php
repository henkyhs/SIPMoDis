<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct() {
        parent::__construct();
        // Cek Log In
		 is_LoggedIn();
		 $this->load->model('M_User');
		 $this->load->model('M_Mobil');
		 $this->load->model('M_Peminjaman');

	}
	public function index()
	{
		$data['title'] = 'Dashboard';
		$role = $this->session->userdata('role');
		$data['activeMenu'] = 'dashboard';
		if ($role==1){
			$data['mobil']= $this->M_Mobil->hitungMobilTersedia();
			$data['pending']= $this ->M_Peminjaman->hitungStatusPeminjaman(1);
			$data['pengembalian']= $this ->M_Peminjaman->hitungStatusPeminjaman(4);
			$data['limaPengajuan'] = $this->M_Peminjaman->getLimaPengajuan();
			$data['limaRiwayat'] = $this->M_Peminjaman->getLimaRiwayat();
			$data['contentView'] = 'dashboard/indexAdmin';
        	$this->load->view('template/main', $data);
		}
		elseif ($role==2){
			$id = $this->session->userdata('idUser');
			$idSeksi = $this->session->userdata('idSeksi');
			$matic = 1;
			$manual = 2;
			$data['riwayatUser'] = $this->M_Peminjaman->getLimaRiwayatUser($id);
			$data['statusTerakhir'] = $this->M_Peminjaman->getLastAktifByUser($id);
			$data['hitungMatic'] = $this->M_Mobil->hitungMobilTersediaPeminjam($matic);
			$data['hitungManual'] = $this->M_Mobil->hitungMobilTersediaPeminjam($manual);
			 if ($this->M_Peminjaman->hasCatatanPengembalianBySeksi($idSeksi)) {
					$data['warningCatatan'] = true;
			} else {
					$data['warningCatatan'] = false;
				}
			$data['contentView'] = 'dashboard/indexPeminjam';
        	$this->load->view('template/main', $data);

		};
		$data['mobil']= $this->M_Mobil->hitungMobil();
		
	}
}

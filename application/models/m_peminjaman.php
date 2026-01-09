<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Peminjaman extends CI_Model {

	public function insertData_peminjaman($data){
		return $this->db->insert('tbl_peminjaman',$data);
	}
	public function cekStatusPinjam($idUser)
	{
		$aktif = [1,2,3,4];
        $this->db->where('idPeminjam', $idUser);
        $this->db->where_in('statusPinjam', $aktif);
        return $this->db->count_all_results('tbl_peminjaman') > 0;
	}
	public function hitungPeminjaman()
	{
		return $this->db->count_all('Tbl_peminjaman');
	}

	public function getAllData_peminjaman()
	{
		$this->db->select('tbl_peminjaman.*,tbl_userpegawai.namaPegawai,tbl_seksi.namaSeksi,tbl_mobil.*, COALESCE(tbl_mobil.platNomor, "Belum diproses") as platNomor', false);
		$this->db->from('tbl_peminjaman');
		$this->db->join('tbl_userpegawai', 'tbl_userpegawai.idUser = tbl_peminjaman.idPeminjam');
		$this->db->join('tbl_mobil', 'tbl_mobil.idMobil = tbl_peminjaman.idMobil','left');
		$this->db->join('tbl_seksi','tbl_seksi.idSeksi = tbl_peminjaman.idSeksi','left');
		$this->db->where('tbl_peminjaman.statusPinjam !=',0);
		return $this->db->get()->result();
	}
	// Filtered Untuk Riwayat Admin Full
	private function _baseQuery()
	{
		$this->db->select('p.*,u.namaPegawai,s.namaSeksi,m.*, COALESCE(m.platNomor, "Belum diproses") as platNomor', false);
		$this->db->from('tbl_peminjaman p');
		$this->db->join('tbl_userpegawai u', 'u.idUser = p.idPeminjam', 'left');
		$this->db->join('tbl_mobil m', 'm.idMobil = p.idMobil', 'left');
		$this->db->join('tbl_seksi s', 's.idSeksi = p.idSeksi', 'left');
		$this->db->order_by('p.createdAt', 'DESC');
	}

	private function _applyFilters(array $filters)
	{
		// LIKE untuk text
		if (!empty($filters['tglPeminjaman'])) {
			$this->db->like('tglPeminjaman', $filters['tglPeminjaman']);
		}
		if (!empty($filters['namaPegawai'])) {
			$this->db->like('namaPegawai', $filters['namaPegawai']);
		}

		if (!empty($filters['namaSeksi'])) {
			$this->db->like('namaSeksi', $filters['namaSeksi']);
		}
		// Filter exact untuk angka/select
		if ($filters['statusPinjam'] !== '' && $filters['statusPinjam'] !== null) {
			$this->db->where('statusPinjam', (int)$filters['statusPinjam']);
		}
		if ($filters['keperluan'] !== '' && $filters['keperluan'] !== null) {
			$this->db->where('keperluan', (int)$filters['keperluan']);
		}
	}

	public function getFilteredAll(array $filters,$limit,$offset)
	{
		$this->_baseQuery();
		$this->db->where('P.statusPinjam !=',0);
		$this->_applyFilters($filters);

		// $this->db->order_by('tbl_userpagawai.createdAt', 'ASC');
		$this->db->limit($limit, $offset);

		return $this->db->get()->result();
	}

	public function getFilteredByUser(array $filters, $id,$limit,$offset)
	{
		// $this->db->where('tbl_peminjaman.statusPinjam !=',0);
		$this->_baseQuery();
		$this->db->where('P.idPeminjam', $id);
		$this->_applyFilters($filters);
		$this->db->limit($limit, $offset);

		// $this->db->order_by('tbl_userpagawai.createdAt', 'ASC');

		return $this->db->get()->result();
	}

	public function getFilteredByStatus(array $filters, $status,$limit,$offset)
	{
		$this->_baseQuery();
		$this->db->where('P.statusPinjam !=',0);
		$this->db->where('P.statusPinjam', $status);
		$this->_applyFilters($filters);

		// $this->db->order_by('tbl_userpagawai.createdAt', 'ASC');
		$this->db->limit($limit, $offset);

		return $this->db->get()->result();
	}
	public function countFilteredAll(array $filters): int
	{
		$this->_baseQuery();
		$this->_applyFilters($filters);
		return (int)$this->db->count_all_results();
	}

	public function countFilteredByStatus(array $filters, int $status): int
	{
		$this->_baseQuery();

		$this->db->where('p.statusPinjam !=', 0);
		$this->db->where('p.statusPinjam', $status);
		$this->_applyFilters($filters);

		// override select supaya tidak ikut select panjang
		$this->db->select('COUNT(*) AS cnt', false);
		return (int) $this->db->get()->row()->cnt;
	}

	public function countFilteredByUser(array $filters, $id): int
	{
		$this->_baseQuery();

		$this->db->where('p.statusPinjam !=', 0);
		$this->db->where('p.idPeminjam', $id);
		$this->_applyFilters($filters);

		// override select supaya tidak ikut select panjang
		$this->db->select('COUNT(*) AS cnt', false);
		return (int) $this->db->get()->row()->cnt;
	}

	public function getRiwayatByUser($id)
	{
		$this->db->select('p.*, 
						m.platNomor, up.namaPegawai');
		$this->db->from('tbl_peminjaman p');
		$this->db->join('tbl_mobil m', 'm.idMobil = p.idMobil', 'left');
		$this->db->join('tbl_userpegawai up', 'up.idUser = p.idPeminjam', 'left');
		$this->db->where('p.idPeminjam', $id);
		$this->db->order_by('p.tglPeminjaman', 'DESC');
		return $this->db->get()->result(); // untuk banyak data
	}

	public function getRiwayatStatus($status)
	{
		$this->db->select('tbl_peminjaman.*, 
						tbl_mobil.platNomor,tbl_userpegawai.namaPegawai, tbl_seksi.namaSeksi');
		$this->db->from('tbl_peminjaman');
		$this->db->join('tbl_mobil', 'tbl_mobil.idMobil = tbl_peminjaman.idMobil', 'left');
		$this->db->join('tbl_seksi', 'tbl_seksi.idSeksi = tbl_peminjaman.idSeksi', 'left');
		$this->db->join('tbl_userpegawai', 'tbl_userpegawai.idUser = tbl_peminjaman.idPeminjam', 'left');
		$this->db->where('tbl_peminjaman.statusPinjam', $status);
		$this->db->order_by('tbl_peminjaman.tglPeminjaman', 'DESC');
		return $this->db->get()->result(); // untuk banyak data
	}

	public function getLimaRiwayatUser($id)
	{	
		$this->db->select('p.*, u.namaPegawai, m.platNomor');
		$this->db->from('tbl_peminjaman p');
		$this->db->join('tbl_userpegawai u', 'u.idUser = p.idPeminjam', 'left'); // left join untuk berjaga
		$this->db->join('tbl_mobil m', 'm.idMobil = p.idMobil', 'left');
		$this->db->order_by('p.createdAt', 'DESC'); // terbaru dulu
		$this->db->where('p.idPeminjam', $id);
		$this->db->limit(5);
		 return $this->db->get()->result();  
	}

	public function getLastAktifByUser($id)
	{
		$this->db->select('p.*, u.namaPegawai, m.platNomor');
		$this->db->from('tbl_peminjaman p');
		$this->db->join('tbl_userpegawai u', 'u.idUser = p.idPeminjam', 'left');
		$this->db->join('tbl_mobil m', 'm.idMobil = p.idMobil', 'left');
		$this->db->where('p.idPeminjam', $id);

		// status yang dianggap SUDAH BERES (bukan aktif)
		$this->db->where_not_in('p.statusPinjam', [4,5,6]);

		$this->db->order_by('p.createdAt', 'DESC'); // atau 'p.id_peminjaman' DESC
		$this->db->limit(1);

		return $this->db->get()->row(); // 1 row atau NULL
	}
	
	public function getLimaPengajuan()
	{
		$this->db->select('p.*, u.namaPegawai');
		$this->db->from('tbl_peminjaman p');
		$this->db->where('p.statusPinjam', 1);
		$this->db->join('tbl_userpegawai u', 'u.idUser = p.idPeminjam', 'left');
		$this->db->order_by('p.tglPeminjaman', 'DESC'); // terbaru dulu
		$this->db->limit(5);
		return $this->db->get()->result();
	}

	public function getLimaRiwayat()
	{
		$this->db->select('p.*, u.namaPegawai');
		$this->db->from('tbl_peminjaman p');
		$this->db->join('tbl_userpegawai u', 'u.idUser = p.idPeminjam', 'left');
		$this->db->order_by('p.tglPeminjaman', 'DESC'); // terbaru dulu
		
		$this->db->limit(5);
		return $this->db->get()->result();
	}
	
	public function getWhere_pengajuan($id)
	{	
		$this->db->select('
			p.*, 
			u.namaPegawai, 
			s.namaSeksi, 
			m.*
		');
		$this->db->from('tbl_peminjaman p');
		$this->db->join('tbl_userpegawai u', 'u.idUser = p.idPeminjam', 'left');
		$this->db->join('tbl_mobil m','m.idMobil = p.idMobil', 'left');
		$this->db->join('tbl_seksi s', 's.idSeksi = u.idSeksi', 'left');
		$this->db->where('p.idPeminjaman', $id);

		return $this->db->get()->row(); 
	}

	public function getWhere_peminjaman($id)
	{	
		$this->db->select('p.*, u.namaPegawai, m.*');
		$this->db->from('tbl_peminjaman p');
		$this->db->join('tbl_userpegawai u', 'tbl_userpegawai.idUser = tbl_peminjaman.idUser', 'left'); // left join untuk berjaga
		$this->db->join('tbl_mobil m', 'tbl_mobil.idMobil = tbl_peminjaman.idMobil', 'left');
		return $this->db->get_where('tbl_peminjaman',['idUser' => $id])->row(); 
	}

	public function update_peminjaman($id,$data)
	{
		$this->db->where('idPeminjaman',$id);
		return $this->db->update('tbl_peminjaman',$data);
	}

	public function update_mobiLpinjam($id,$data)
	{
		$this->db->where('idMobil',$id);
		return $this->db->update('tbl_mobil',$data);
	}

	public function handleLampiranUpload($lampiranLama)
	{
		if (!empty($_FILES['lampiran']['name'])) {
			$config['upload_path'] = './uploads/lampiran/';
			$config['allowed_types'] = 'pdf';
			$config['max_size'] = 2048;
			$config['file_name'] = uniqid('lampiran_');

			$CI =& get_instance(); // agar bisa akses CI instance dari dalam model
			$CI->load->library('upload', $config);

			if ($CI->upload->do_upload('lampiran')) {
				// Hapus lampiran lama jika ada
				if ($lampiranLama && file_exists('./uploads/lampiran/' . $lampiranLama)) {
					unlink('./uploads/lampiran/' . $lampiranLama);
				}

				$uploadData = $CI->upload->data();
				return $uploadData['file_name'];
			} else {
				// Optional: throw atau kembalikan error
				return $lampiranLama; // fallback ke lampiran lama
			}
		}

		return $lampiranLama;
	}
	
	public function delete_draft($id) {
        return $this->db->delete('tbl_peminjaman', ['idPeminjaman' => $id]);
    }

	public function hasCatatanPengembalianBySeksi($idSeksi)
	{
		return $this->db
			->from('tbl_peminjaman p')
			->where('p.idSeksi',$idSeksi)
			->where('p.statusPinjam', 7)
			->limit(1)
			->count_all_results() > 0;
	}

	public function pilihMobil($preferensi)
	{
		$this->db->where('kondisiMobil',1);
		if ((int)$preferensi !== 3) {
			$this->db->where('transmisi', (int)$preferensi);
		}
		return $this->db->get('tbl_mobil')->result();
	}

	public function hitungStatusPeminjaman($statusPeminjaman)
	{
		$this->db->where('statusPinjam', $statusPeminjaman);
    	return $this->db->count_all_results('tbl_peminjaman');
	}

	public function createId_pinjam()   {
		  $this->db->select('RIGHT(tbl_peminjaman.idPeminjaman,4) as kode', FALSE);
		  $this->db->order_by('idPeminjaman','DESC');
		  $this->db->limit(1);
		  $query = $this->db->get('tbl_peminjaman');      //cek dulu apakah ada sudah ada kode di tabel.
		  if($query->num_rows() <> 0){
		   //jika kode ternyata sudah ada.
		   $data = $query->row();
		   $kode = intval($data->kode) + 1;
		  }
		  else {
		   //jika kode belum ada
		   $kode = 1;
		  }
		  $kodemax = str_pad($kode, 10, "0", STR_PAD_LEFT); // angka 4 menunjukkan jumlah digit angka 0
		  $kodejadi = "PM-".$kodemax;    // hasilnya S-0001 dst.
		  return $kodejadi;
	}

	// Untuk Log Peminjaman

	public function insertData_log($data){
		return $this->db->insert('tbl_logpeminjaman',$data);
	}

	public function createId_Log()   {
		  $this->db->select('RIGHT(tbl_logpeminjaman.idLog,4) as kode', FALSE);
		  $this->db->order_by('idLog','DESC');
		  $this->db->limit(1);
		  $query = $this->db->get('tbl_logpeminjaman');      //cek dulu apakah ada sudah ada kode di tabel.
		  if($query->num_rows() <> 0){
		   //jika kode ternyata sudah ada.
		   $data = $query->row();
		   $kode = intval($data->kode) + 1;
		  }
		  else {
		   //jika kode belum ada
		   $kode = 1;
		  }
		  $kodemax = str_pad($kode, 10, "0", STR_PAD_LEFT); // angka 4 menunjukkan jumlah digit angka 0
		  $kodejadi = "Log-".$kodemax;    // hasilnya S-0001 dst.
		  return $kodejadi;
	}

	public function getWhere_log($id)
	{
		$this->db->select('l.*, 
						up.namaPegawai');
		$this->db->from('tbl_logpeminjaman l');
		$this->db->join('tbl_userpegawai up', 'up.idUser = l.idUser', 'left');
		$this->db->where('l.idPeminjaman', $id);
		return $this->db->get()->result(); // untuk banyak data
	}

	public function getByTgl($tglMulai,$tglSelesai)
	{
		return $this->db
        ->select(
			'p.*, 
			peminjam.namaPegawai AS namaPeminjam,  
			m.namaMobil, 
			m.platNomor,
			verifikator.namaPegawai AS namaVerifikator,
            penerima.namaPegawai AS namaPenerima,
			pemberi.namaPegawai AS namaPemberi
			')
        ->from('tbl_peminjaman p')
        ->join('tbl_userpegawai peminjam', 'peminjam.idUser = p.idPeminjam','left')
		->join('tbl_userpegawai verifikator', 'verifikator.idUser = p.idVerifikator','left')
		->join('tbl_userpegawai penerima', 'penerima.idUser = p.idPenerima','left')
		->join('tbl_userpegawai pemberi', 'pemberi.idUser = p.idPemberi','left')
		->join('tbl_mobil m','m.idMobil = p.idMobil','left')
		->where('p.statusPinjam !=', 0)
        ->where('DATE(p.createdAt) >=', $tglMulai)
        ->where('DATE(p.createdAt) <=', $tglSelesai)
        ->order_by('p.tglPeminjaman', 'DESC')
        ->get()->result();
	}

	
}
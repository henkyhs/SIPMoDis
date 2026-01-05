<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_User extends CI_Model {

	public function getNip($nip)
	{
		return $this->db->get_where('tbl_userpegawai',['nip'=>$nip])->row();
	}


	public function insertData_User($data){
		return $this->db->insert('tbl_userpegawai',$data);
	}

	public function getAllData_User()
	{
		$this->db->select('tbl_userpegawai.*,tbl_seksi.namaSeksi');
		$this->db->join('tbl_seksi','tbl_userpegawai.idSeksi = tbl_seksi.idSeksi');
		$this->db->from('tbl_userpegawai');
		return $this->db->get()->result();
	}

	private function _applyFilters(array $filters)
	{
		$this->db->from('tbl_userpegawai');
		$this->db->join('tbl_seksi','tbl_userpegawai.idSeksi = tbl_seksi.idSeksi');

		// LIKE untuk text
		if (!empty($filters['nip'])) {
			$this->db->like('nip', $filters['nip']);
		}
		if (!empty($filters['namaPegawai'])) {
			$this->db->like('namaPegawai', $filters['namaPegawai']);
		}

		if (!empty($filters['namaSeksi'])) {
			$this->db->like('namaSeksi', $filters['namaSeksi']);
		}
		// Filter exact untuk angka/select
		if ($filters['role'] !== '' && $filters['role'] !== null) {
			$this->db->where('role', (int)$filters['role']);
		}
	}

	public function getFiltered(array $filters,$limit,$offset)
	{
		$this->_applyFilters($filters);

		// $this->db->order_by('tbl_userpagawai.createdAt', 'ASC');
		$this->db->limit($limit, $offset);

		return $this->db->get()->result();
	}

	public function countFiltered(array $filters): int
	{
		$this->_applyFilters($filters);
		return (int)$this->db->count_all_results();
	}

	public function getWhere_user($id)
	{
		return $this->db->get_where('tbl_userpegawai',['idUser' => $id])->row();
	}
	public function getbyPegawai($id)
	{
		return $this->db->get_where('tbl_userpegawai',['idPegawai'=>$id])->result();
	}

	public function update_user($id,$data)
	{
		$this->db->where('idUser',$id);
		return $this->db->update('tbl_userpegawai',$data);
	}

	public function createId_user()   {
		  $this->db->select('RIGHT(tbl_userpegawai.idUser,4) as kode', FALSE);
		  $this->db->order_by('idUser','DESC');
		  $this->db->limit(1);
		  $query = $this->db->get('tbl_userpegawai');      //cek dulu apakah ada sudah ada kode di tabel.
		  if($query->num_rows() <> 0){
		   //jika kode ternyata sudah ada.
		   $data = $query->row();
		   $kode = intval($data->kode) + 1;
		  }
		  else {
		   //jika kode belum ada
		   $kode = 1;
		  }
		  $kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT); // angka 4 menunjukkan jumlah digit angka 0
		  $kodejadi = "U-".$kodemax;    // hasilnya S-0001 dst.
		  return $kodejadi;
	}

	public function deleteUser($id) {
        return $this->db->delete('tbl_userPegawai', ['idUser' => $id]);
    }

}

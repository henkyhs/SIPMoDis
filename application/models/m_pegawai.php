<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Pegawai extends CI_Model {

	public function getNip($nip)
	{
		return $this->db->get_where('tbl_pegawai',['nip'=>$nip])->result();
	}

	public function insertData_pegawai($data){
		return $this->db->insert('tbl_pegawai',$data);
	}

	public function getAllData_pegawai()
	{
		return $this->db->get('tbl_pegawai')->result();
	}

	public function getWhere_pegawai($id)
	{
		return $this->db->get_where('tbl_pegawai',['idPegawai' => $id])->row();
	}

	public function update_pegawai($id,$data)
	{
		$this->db->where('idPegawai',$id);
		return $this->db->update('tbl_pegawai',$data);
	}
	
	public function delete_pegawai($id) {
        return $this->db->delete('tbl_pegawai', ['idPegawai' => $id]);
    }

	public function createId_pegawai()   {
		  $this->db->select('RIGHT(tbl_pegawai.idPegawai,4) as kode', FALSE);
		  $this->db->order_by('idPegawai','DESC');
		  $this->db->limit(1);
		  $query = $this->db->get('tbl_user');      //cek dulu apakah ada sudah ada kode di tabel.
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
		  $kodejadi = "S".$kodemax;    // hasilnya S-0001 dst.
		  return $kodejadi;
	}
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Seksi extends CI_Model {

	public function insertData_seksi($data){
		return $this->db->insert('tbl_seksi',$data);
	}

	public function getAllData_seksi()
	{
		return $this->db->get('tbl_seksi')->result();
	}

	public function getWhere_seksi($id)
	{
		return $this->db->get_where('tbl_seksi',['idSeksi' => $id])->row();
	}

	public function update_seksi($id,$data)
	{
		$this->db->where('idSeksi',$id);
		return $this->db->update('tbl_seksi',$data);
	}
	
	 public function delete_seksi($id) {
        return $this->db->delete('tbl_seksi', ['idSeksi' => $id]);
    }

	private function _applyFilters(array $filters)
	{
		$this->db->from('tbl_seksi');

		// LIKE untuk text
		if (!empty($filters['namaSeksi'])) {
			$this->db->like('namaSeksi', $filters['namaSeksi']);
		}
	}

	public function getFiltered(array $filters,$limit,$offset)
	{
		$this->_applyFilters($filters);

		$this->db->order_by('idSeksi', 'ASC');
		$this->db->limit($limit, $offset);

		return $this->db->get()->result();
	}

	public function countFiltered(array $filters): int
	{
		$this->_applyFilters($filters);
		return (int)$this->db->count_all_results();
	}

	public function createId_seksi()   {
		  $this->db->select('RIGHT(tbl_seksi.idSeksi,4) as kode', FALSE);
		  $this->db->order_by('idSeksi','DESC');
		  $this->db->limit(1);
		  $query = $this->db->get('tbl_seksi');      //cek dulu apakah ada sudah ada kode di tabel.
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
		  $kodejadi = "S-".$kodemax;    // hasilnya S-0001 dst.
		  return $kodejadi;
	}
}

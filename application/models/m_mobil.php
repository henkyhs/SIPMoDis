<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Mobil extends CI_Model {

	public function rules()
	{
		return [
			[
				'field'=>'namaMobil',
				'label'=>'namaMobil',
				'rules'=>'required'
			],

			[
				'field'=>'platNomor',
				'label'=>'platNomor',
				'rules'=>'required|is_unique[tbl_mobil.platNomor]'
			]
			];
	}

	public function insertData_mobil($data){
		return $this->db->insert('tbl_mobil',$data);
	}

	public function getAllData_mobil()
	{
		return $this->db->get('tbl_mobil')->result();
	}

	public function getWhere_mobil($id)
	{
		return $this->db->get_where('tbl_mobil',['idMobil' => $id])->row();
	}

	public function update_mobil($id,$data)
	{
		$this->db->where('idMobil',$id);
		return $this->db->update('tbl_mobil',$data);
	}

	public function updateKondisiMobil($id,$kondisi)
	{
		$this->db->where('idMobil', $id);
        return $this->db->update('tbl_mobil', ['kondisiMobil' => $kondisi]);
	}
	public function hitungMobil()
	{
		return $this->db->count_all('Tbl_mobil');
	}

	public function hitungMobilTersedia()
	{
		$this->db->where('kondisiMobil', 1);
    	return $this->db->count_all_results('tbl_mobil');
	}
	 public function delete_mobil($id) {
        return $this->db->delete('tbl_mobil', ['idMobil' => $id]);
    }

	private function _applyFilters(array $filters)
	{
		$this->db->from('tbl_mobil');

		// LIKE untuk text
		if (!empty($filters['platNomor'])) {
			$this->db->like('platNomor', $filters['platNomor']);
		}
		if (!empty($filters['namaMobil'])) {
			$this->db->like('namaMobil', $filters['namaMobil']);
		}

		// Filter exact untuk angka/select
		if ($filters['transmisi'] !== '' && $filters['transmisi'] !== null) {
			$this->db->where('transmisi', (int)$filters['transmisi']);
		}
		if ($filters['kondisiMobil'] !== '' && $filters['kondisiMobil'] !== null) {
			$this->db->where('kondisiMobil', (int)$filters['kondisiMobil']);
		}
	}

	public function getFiltered(array $filters, $limit,$offset)
	{
		$this->_applyFilters($filters);

		$this->db->order_by('idMobil', 'ASC');
		$this->db->limit($limit, $offset);

		return $this->db->get()->result();
	}

	public function countFiltered(array $filters): int
	{
		$this->_applyFilters($filters);
		return (int)$this->db->count_all_results();
	}

	public function getMobilTersedia()
	{
		$this->db->where('kondisiMobil', '1');
		return $this->db->get('tbl_mobil')->result();
	}
	
	public function createId_Mobil()   {
		  $this->db->select('RIGHT(tbl_mobil.idMobil,4) as kode', FALSE);
		  $this->db->order_by('idMobil','DESC');
		  $this->db->limit(1);
		  $query = $this->db->get('tbl_mobil');      //cek dulu apakah ada sudah ada kode di tabel.
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
		  $kodejadi = "M-".$kodemax;    // hasilnya S-0001 dst.
		  return $kodejadi;
	}
}

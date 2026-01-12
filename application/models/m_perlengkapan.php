<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Perlengkapan extends CI_Model {

	public function rules()
	{
		return [
			[
				'field'=>'namaPerlengkapan',
				'label'=>'namaPerlengkapan',
				'rules'=>'required'
			],
			];
	}

	public function insertData_perlengkapan($data){
		return $this->db->insert('tbl_perlengkapan',$data);
	}

	public function getAllData_perlengkapan()
	{
		return $this->db->get('tbl_perlengkapan')->result();
	}

	private function _applyFilters(array $filters)
	{
		$this->db->from('tbl_perlengkapan');

		// LIKE untuk text
		if (!empty($filters['namaPerlengkapan'])) {
			$this->db->like('namaPerlengkapan', $filters['namaPerlengkapan']);
		}
	}

	public function getFiltered(array $filters,$limit,$offset)
	{
		$this->_applyFilters($filters);

		$this->db->order_by('idPerlengkapan', 'ASC');
		$this->db->limit($limit, $offset);

		return $this->db->get()->result();
	}

	public function countFiltered(array $filters): int
	{
		$this->_applyFilters($filters);
		return (int)$this->db->count_all_results();
	}

	public function getWhere_perlengkapan($id)
	{
		return $this->db->get_where('tbl_perlengkapan',['idPerlengkapan' => $id])->row();
	}

	public function update_perlengkapan($id,$data)
	{
		$this->db->where('idPerlengkapan',$id);
		return $this->db->update('tbl_perlengkapan',$data);
	}

	 public function delete_perlengkapan($id) {
        return $this->db->delete('tbl_perlengkapan', ['idPerlengkapan' => $id]);
    }
	
	public function createId_Perlengkapan()   {
		  $this->db->select('RIGHT(tbl_perlengkapan.idPerlengkapan,4) as kode', FALSE);
		  $this->db->order_by('idPerlengkapan','DESC');
		  $this->db->limit(1);
		  $query = $this->db->get('tbl_perlengkapan');      //cek dulu apakah ada sudah ada kode di tabel.
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
		  $kodejadi = "P".$kodemax;    // hasilnya S-0001 dst.
		  return $kodejadi;
	}

	public function createId_PeminjamanPerlengkapan()   {
		  $this->db->select('RIGHT(tbl_perlengkapanpeminjaman.idPerlengkapanPeminjaman,4) as kode', FALSE);
		  $this->db->order_by('idPerlengkapanPeminjaman','DESC');
		  $this->db->limit(1);
		  $query = $this->db->get('tbl_perlengkapanpeminjaman');      //cek dulu apakah ada sudah ada kode di tabel.
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
		  $kodejadi = "PP-".$kodemax;    // hasilnya S-0001 dst.
		  return $kodejadi;
	}
	// Save perlengkapan yang dimasukkan ke dalam peminjaman
	public function insertData_peminjamanperlengkapan($idPeminjaman, array $perlengkapan_ids)
	{
		 // kalau kosong, anggap sukses (tidak ada perlengkapan dipilih)
        if (empty($perlengkapan_ids)) return TRUE;

        // optional: bersihkan dulu biar tidak double (kalau approve bisa diedit ulang)
        // $this->db->where('idPeminjaman', (int)$idPeminjaman)
        //          ->delete('tbl_peminjamanperlengkapan');

        $rows = [];
        foreach ($perlengkapan_ids as $pid) {
            $rows[] = [
                'idPeminjaman'   => $idPeminjaman,
                'idPerlengkapan' => $pid,
                // default DB: is_dikembalikan = 1
            ];
        }

        return $this->db->insert_batch('tbl_perlengkapanpeminjaman', $rows);
	}

	public function getbyPeminjaman($id)
	{
		$this->db->select('pp.*,p.*');
		$this->db->from('tbl_perlengkapanpeminjaman pp');
		$this->db->join('tbl_perlengkapan p', 'p.idPerlengkapan = pp.idPerlengkapan', 'left');
		$this->db->where('pp.idPeminjaman', $id);
		$this->db->order_by('p.namaPerlengkapan', 'DESC');
		return $this->db->get()->result(); // untuk banyak data
	}

	// public function updatePengembalianPerlengkapan($idPeminjaman, $val)
	// {
	// 	$this->db->where('idPeminjaman', $idPeminjaman);
    //     return $this->db->update('tbl_perlengkapanpeminjaman', ['isDikembalikan' => $val]);
	// }

	public function setPerlengkapanDikembalikan($idPeminjaman, array $idPerlengkapan)
	{
		 // reset semua jadi 0
        $this->db->set('isDikembalikan', 0);
        $this->db->where('idPeminjaman', $idPeminjaman);
        $this->db->update('tbl_perlengkapanpeminjaman');

        // set yang dicentang jadi 1
        if (!empty($idPerlengkapan)) {
            $this->db->set('isDikembalikan', 1);
            $this->db->where('idPeminjaman', $idPeminjaman);
            $this->db->where_in('idPerlengkapan', $idPerlengkapan);
            $this->db->update('tbl_perlengkapanpeminjaman');
        }
	}

	 public function setPerlengkapanInspeksi($idPeminjaman, array $idPerlengkapanAda)
    {
        // reset isAda = 0 semua dulu
        $this->db->set('isAda', 0);
        $this->db->where('idPeminjaman', $idPeminjaman);
        $this->db->update('tbl_perlengkapanpeminjaman');

        // set yang ada menjadi 1
        if (!empty($idPerlengkapanAda)) {
            $this->db->set('isAda', 1);
            $this->db->where('idPeminjaman', $idPeminjaman);
            $this->db->where_in('idPerlengkapan', $idPerlengkapanAda);
            $this->db->update('tbl_perlengkapanpeminjaman');
        }

        // sekarang cocokkan: status ok vs  hilang
        $items = $this->getbyPeminjaman($idPeminjaman);

        foreach ($items as $it) {
            $status = 1;

            // aturan contoh:
            if($it->isAda != $it->isDikembalikan){
				$status = 0;
			}
		
            $this->db->where('idPerlengkapanPeminjaman', $it->idPerlengkapanPeminjaman);
            $this->db->update('tbl_perlengkapanpeminjaman', [
                'status' => $status,
            ]);
        }
    }

	// public function setPerlengkapaninspeksi($idPeminjaman, array $idPerlengkapan)
	// {
	// 	if (empty($idPerlengkapan)) return;

	// 	$this->db->where('idPeminjaman', $idPeminjaman);
	// 	$this->db->where_in('idPerlengkapan', $idPerlengkapan);
	// 	$this->db->update('tbl_perlengkapanPeminjaman', [
	// 		'isAda' => 1
	// 	]);

	// 	$this->db->set('status', 'IF(isAda = isDikembalikan, 1, 0)', false)
    //          ->where('idPeminjaman', $idPeminjaman)
    //          ->update('tbl_perlengkapanPeminjaman',['status' =>1 ]);
	// }

	// public function setStatusPerlengkapan($idPeminjaman, array $idPerlengkapan, $status)
	// {
	// 	if (empty($idPerlengkapan)) return;

	// 	$this->db->where('idPeminjaman', $idPeminjaman);
	// 	$this->db->where_in('idPerlengkapan', $idPerlengkapan);
	// 	$this->db->update('tbl_perlengkapanPeminjaman', [
	// 		'status' => $status
	// 	]);
	// }
}

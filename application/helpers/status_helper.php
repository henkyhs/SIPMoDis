<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

function status_pengajuan($status_id) {
    $status = [
		0 => 'Draft',
        1 => 'Diajukan',
        2 => 'Proses Dikembalikan',
		3 => 'Dalam Peminjaman',
        4 => 'Batal',
		5 => 'Ditolak',
        6 => 'Kunci Diterima danSelesai'
    ];

    return isset($status[$status_id]) ? $status[$status_id] : 'Tidak Diketahui';
}

function status_mobil($status_id) {
    $status = [
        1 => 'Tersedia',
        2 => 'Dipinjam',
        3 => 'Rusak'
    ];

    return isset($status[$status_id]) ? $status[$status_id] : 'Tidak Diketahui';
}

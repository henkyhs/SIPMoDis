<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

function status_pengajuan($status_id) {
    $status = [
		0 => 'Draft',
        1 => 'Diajukan',
        2 => 'Disetujui',
        3 => 'Dalam Peminjaman',
        4 => 'Proses Pengembalian',
        5 => 'Ditolak',
        6 => 'Batal',
        7 => 'Dikembalikan dengan Catatan',
        8 => 'Selesai',
        9 => 'Draft Dihapus'
    ];

    return isset($status[$status_id]) ? $status[$status_id] : 'Tidak Diketahui';
}

function status_badge($status_id)
{
    $map = [
        0 => ['label' => 'Draft', 'class' => 'secondary'],
        1 => ['label' => 'Diajukan', 'class' => 'info'],
        2 => ['label' => 'Disetujui', 'class' => 'primary'],
        3 => ['label' => 'Dalam Peminjaman', 'class' => 'navy'],
        4 => ['label' => 'Proses Pengembalian', 'class' => 'orange'],
        5 => ['label' => 'Ditolak', 'class' => 'danger'],
        6 => ['label' => 'Batal', 'class' => 'dark'],
        7 => ['label' => 'Dikembalikan dengan Catatan', 'class' => 'warning'],
        8 => ['label' => 'Selesai', 'class' => 'success'],
    ];

    $data = $map[$status_id] ?? ['label' => 'Unknown', 'class' => 'secondary'];

    return '<span class="badge badge-'.$data['class'].'">'.$data['label'].'</span>';
}

function status_mobil($status_id) {
    $status = [
        1 => ['label' => 'Tersedia', 'class' => 'success'],
        2 => ['label' => 'Sedang Dipinjam', 'class' => 'warning'],
        3 => ['label' => 'Rusak', 'class' => 'danger'],
    ];

    $data = $status[$status_id] ?? ['label' => 'Unknown', 'class' => 'secondary'];

    return '<span class="badge badge-'.$data['class'].'">'.$data['label'].'</span>';
}
function role_user($status_id) {
    $status = [
        1 => 'Admin',
        2 => 'Peminjam'
    ];

    return isset($status[$status_id]) ? $status[$status_id] : 'Tidak Diketahui';
}

function jenis_mobil($status_id){
    $status = [
        1 => 'Matic',
        2 => 'Manual'
    ];
    return isset($status[$status_id]) ? $status[$status_id] : 'Tidak Diketahui';
}

function status_keperluan($status_id){
    $status = [
        1 => 'Visit',
        2 => 'Lainnya'
    ];
    return isset($status[$status_id]) ? $status[$status_id] : 'Tidak Diketahui';
}

function preferensi_mobil($status_id){
    $status =[
        1 => 'Matic',
        2 => 'Manual',
        3 => 'Matic dan Manual'
    ];
    return isset($status[$status_id]) ? $status[$status_id] : 'Tidak Diketahui';
}

function status_perlengkapan($status_id){
    $status = [
        1 => 'Cocok',
        2 => 'Tidak Cocok'
    ];
    return isset($status[$status_id]) ? $status[$status_id] : 'Tidak Diketahui';
}
function status_dikembalikan($status_id){
    $status = [
        0 => 'Tidak Dikembalikan',
        1 => 'Dikembalikan'
    ];
    return isset($status[$status_id]) ? $status[$status_id] : 'Tidak Diketahui';
}
function status_inspeksi($status_id){
    $status = [
        0 => 'Tidak Ada',
        1 => 'Ada'
    ];
    return isset($status[$status_id]) ? $status[$status_id] : 'Tidak Diketahui';
}

function bensin_peminjam($status_id){
    $status = [
         '1'   => 'E (Habis)',
         '2' => '1/4',
         '3' => '1/2',
         '4' => '3/4',
         '5'   => 'F (Penuh)',
    ];
    return isset($status[$status_id]) ? $status[$status_id] : 'Tidak Diketahui';
}

function bensin_inspeksi($status_id){
    $status = [
         '1'   => 'E (Habis)',
         '2' => '1/4',
         '3' => '1/2',
         '4' => '3/4',
         '5'   => 'F (Penuh)',
    ];
    return isset($status[$status_id]) ? $status[$status_id] : 'Tidak Diketahui';
}


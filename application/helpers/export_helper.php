<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function export_peminjaman_excel($data, $start, $end)
{
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=Laporan_Peminjaman_$start-$end.xls");
    header("Pragma: no-cache");
    header("Expires: 0");

    echo "Laporan Peminjaman {$start} s/d {$end}";
    echo"";
    echo "<table border='1'>";
    echo "<tr>
            <th>No</th>
            <th>ID Peminjaman</th>
            <th>Tanggal Pengajuan</th>
            <th>Nama Peminjam</th>
            <th>Tanggal Peminjaman</th>
            <th>Keperluan</th>
            <th>Tujuan</th>
            <th>Verifikator Peminjaman</th>
            <th>Plat Mobil</th>
            <th>Tipe Mobil</th>
            <th>Pemberi Kunci</th>
            <th>Tanggal Pengembalian</th>
            <th>Penerima Kunci</th>
            <th>Bensin yang Digunakan</th>
            <th>Bensin Setelah Dicek</th>
            <th>Catatan Peminjam</th>
            <th>Catatan Inspeksi</th>
            <th>Status</th>
          </tr>";

    $no = 1;
    foreach ($data as $row) {
        echo "<tr>
                <td>{$no}</td>
                <td>{$row->idPeminjaman}</td>
                <td>{$row->createdAt}</td>
                <td>{$row->namaPeminjam}</td>
                <td>{$row->tglPeminjaman}</td>
                <td>".status_keperluan($row->keperluan)."</td>
                <td>{$row->tujuan}</td>
                <td>{$row->namaVerifikator}</td>
                <td>{$row->platNomor}</td>
                <td>{$row->namaMobil}</td>
                <td>{$row->namaPemberi}</td>
                <td>{$row->tglPengembalian}</td>
                <td>{$row->namaPenerima}</td>
                <td>".bensin_peminjam($row->bensinPemakaian)."</td>
                <td>".bensin_inspeksi($row->bensinInspeksi)."</td>
                <td>{$row->catatanPeminjam}</td>
                <td>{$row->catatanInspeksi}</td>
                <td>".status_pengajuan($row->statusPinjam)."</td>
              </tr>";
        $no++;
    }

    echo "</table>";
    exit;
}

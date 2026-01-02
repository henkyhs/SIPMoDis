<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function export_peminjaman_excel($data, $start, $end)
{
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=Laporan_Peminjaman_$start-$end.xls");
    header("Pragma: no-cache");
    header("Expires: 0");

    echo "<table border='1'>";
    echo "<tr>
            <th>No</th>
            <th>ID Peminjaman</th>
            <th>Nama Peminjam</th>
            <th>Tanggal</th>
            <th>Status</th>
          </tr>";

    $no = 1;
    foreach ($data as $row) {
        echo "<tr>
                <td>{$no}</td>
                <td>{$row->idPeminjaman}</td>
                <td>{$row->namaPegawai}</td>
                <td>{$row->tglPeminjaman}</td>
                <td>".status_pengajuan($row->statusPinjam)."</td>
              </tr>";
        $no++;
    }

    echo "</table>";
    exit;
}

<div class="container mt-4">
    <h2 class="mb-3">Data Seksi</h2>

    <a href="<?= site_url('seksi/addForm'); ?>" class="btn btn-primary mb-3">
        + Tambah Data Pegawai
    </a>

    <!-- Tabel dengan id agar dikenali oleh DataTables -->
      <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Seksi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($dataSeksi)): ?>
                <tr><td colspan="5" class="text-center">Belum ada data.</td></tr>
            <?php else: ?>
                <?php $no=1; foreach($dataSeksi as $s): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $s->namaSeksi ?></td>
                    <td>
                        <a href="<?= site_url('seksi/editForm/'.$s->idSeksi) ?>" class="btn btn-sm btn-warning">Edit</a>
                        <a href="<?= site_url('seksi/delete/'.$s->idSeksi) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

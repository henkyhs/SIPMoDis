<div class="container mt-4">
    <h2 class="mb-3">Data Seksi</h2>

    <a href="<?= site_url('seksi/addForm'); ?>" class="btn btn-primary mb-3">
        + Tambah Data Seksi
    </a>
    <form method='GET' action ='<?= site_url('seksi'); ?>'>
         <!-- Tabel dengan id agar dikenali oleh DataTables -->
      <table class="table table-hover">
        <thead>
            <tr>
                <th>
                    Cari:
                </th>
                 <th>
                      <input type="text" name="namaSeksi" class="form-control form-control-sm"
                      value="<?= htmlspecialchars($filters['namaSeksi'] ?? ''); ?>"
                      placeholder="">
                </th>
                <th style="width:160px;">
            <button type="submit" class="btn btn-sm btn-primary btn-block">Filter</button>
            <a href="<?= site_url('seksi'); ?>" class="btn btn-sm btn-secondary btn-block">Reset</a>
          </th>
            </tr>
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
                        <a href="<?= site_url('seksi/editForm/'.$s->idSeksi) ?>" class="btn btn-sm btn-warning btn-block">Edit</a>
                        <a href="<?= site_url('seksi/delete/'.$s->idSeksi) ?>" class="btn btn-sm btn-danger btn-block" onclick="return confirm('Yakin hapus?')">Hapus</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
    </form>
</div>

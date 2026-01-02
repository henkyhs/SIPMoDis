<div class="container mt-4">
    <h2 class="mb-3">Data Perlengkapan</h2>

    <a href="<?= site_url('perlengkapan/addForm'); ?>" class="btn btn-primary mb-3">
        + Tambah Data Perlengakapan
    </a>

    <form method='GET' action ='<?= site_url('perlengkapan'); ?>'>
         <!-- Tabel dengan id agar dikenali oleh DataTables -->
      <table class="table table-hover">
        <thead>
            <tr>
                <th>
                    Cari:
                </th>
                 <th>
                      <input type="text" name="namaPerlengkapan" class="form-control form-control-sm"
                      value="<?= htmlspecialchars($filters['namaPerlengkapan'] ?? ''); ?>"
                      placeholder="">
                </th>
                <th style="width:160px;">
            <button type="submit" class="btn btn-sm btn-primary btn-block">Filter</button>
            <a href="<?= site_url('perlengkapan'); ?>" class="btn btn-sm btn-secondary btn-block">Reset</a>
          </th>
            </tr>
            <tr>
                <th>No</th>
                <th>Nama Perlengkapan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($dataPerlengkapan)): ?>
                <tr><td colspan="5" class="text-center">Belum ada data.</td></tr>
            <?php else: ?>
                <?php $no=1; foreach($dataPerlengkapan as $p): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $p->namaPerlengkapan ?></td>
                    <td>
                        <a href="<?= site_url('perlengkapan/editForm/'.$p->idPerlengkapan) ?>" class="btn btn-sm btn-warning btn-block">Edit</a>
                        <a href="<?= site_url('perlengkapan/delete/'.$p->idPerlengkapan) ?>" class="btn btn-sm btn-danger btn-block" onclick="return confirm('Yakin hapus?')">Hapus</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
    </form>
</div>

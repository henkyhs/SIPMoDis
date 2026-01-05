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
                        <button type="button" class="btn btn-sm btn-danger btn-block" data-toggle="modal" data-target="#hapusSeksiModal">
                Hapus
            </button>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
    </form>

    <div class="d-flex justify-content-between align-items-center">
  <div class="text-muted small">
    Total: <?= (int)$total; ?> data
  </div>
  <div>
    <?= $pagination; ?>
  </div>
</div>

</div>

<!-- Hapus-->
  <div class="modal fade" id="hapusSeksiModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Yakin akan hapus data?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Data yang dihapus akan hilang selamanya</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
          <a class="btn btn-danger" href="<?= site_url('seksi/delete/'.$s->idSeksi) ?>">Hapus Data</a>
        </div>
      </div>
    </div>
  </div>

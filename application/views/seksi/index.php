<div class="container mt-4">
    <h2 class="mb-3">Data Seksi</h2>
     <?php if ($this->session->flashdata('successAdd')): ?>
        <div class="alert alert-success text-center">
            <?= $this->session->flashdata('successAdd'); ?>
        </div>
    <?php  elseif($this->session->flashdata('successUpdate')):?>
        <div class="alert alert-success text-center">
            <?= $this->session->flashdata('successUpdate'); ?>
        </div>
    <?php  elseif($this->session->flashdata('dangerDelete')):?>
        <div class="alert alert-danger text-center">
            <?= $this->session->flashdata('dangerDelete'); ?>
        </div>
    <?php endif; ?>
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
            <a href="<?= site_url('seksi'); ?>" class="btn btn-sm btn-outline-secondary btn-block">Reset</a>
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
                    <!-- Status -->
                    <td><p class="text-m font-weight-bold mb-0"><?= $s->namaSeksi?></p>
                        <p class="text-xs text-secondary mb-0">Terakhir Update: <?= date('d M Y', strtotime($s->updatedAt)); ?></p>
                    </td>
                    <td>
                        <a href="<?= site_url('seksi/editForm/'.$s->idSeksi) ?>" class="btn btn-sm btn-warning btn-block">Edit</a>
                        <a href="<?= site_url('seksi/delete/'.$s->idSeksi); ?>" class="btn btn-sm btn-danger btn-block"
                           onclick="return confirm('Yakin hapus data ini?');">
                           Hapus
                        </a>
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

<div class="container mt-4">
    <h2>Form Pengambilan Kunci</h2>
    <div class="card shadow mb-4">
        <!-- Card Header - Accordion -->
        <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse"
        role="button" aria-expanded="true" aria-controls="collapseCardExample">
        <h6 class="m-0 font-weight-bold text-primary">Data Pengajuan Peminjaman <?= $pinjam->idPeminjaman?></h6>
        </a>
        <!-- Card Content - Collapse -->
        <div class="collapse show" id="collapseCardExample">
             <div class="card-body">
                  <dl class="row mb-0">
          
                    <dt class="col-5 text-secondary">Nama Peminjam</dt>
                    <dd class="col-7"><?= htmlspecialchars($pinjam->namaPegawai ?? '-'); ?></dd>

                    <dt class="col-5 text-secondary">Keperluan</dt>
                    <dd class="col-7">
                         <?= htmlspecialchars(status_pengajuan($pinjam->statusPinjam) ?? '-'); ?>
                    </dd>

                    <dt class="col-5 text-secondary">Tujuan</dt>
                    <dd class="col-7"><?= nl2br(htmlspecialchars($pinjam->tujuan ?? '-')); ?></dd>

                    <dt class="col-5 text-secondary">Lampiran</dt>
                    <dd class="col-7"><a href="<?= base_url('uploads/lampiran/'.rawurlencode($pinjam->lampiran)); ?>" target="_blank">Lihat</a></dd>

                    <dt class="col-5 text-secondary">Plat Nomor Mobil</dt>
                    <dd class="col-7"><?= htmlspecialchars($pinjam->platNomor ?? '-'); ?></dd>

                </dl>
              </div>
        </div>
    </div>
    <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-danger text-center">
            <?= $this->session->flashdata('error'); ?>
        </div>
    <?php endif; ?>
    <form action="<?= site_url('peminjaman/pengambilanKunci/'.$pinjam->idPeminjaman); ?>" method="post" enctype="multipart/form-data">
		<!-- Input Perlengkapan -->
     <div class="form-group">
            <label>Perlengkapan Tambahan</label>
            <small class="text-muted d-block mb-1">Pilih perlengkapan yang anda butuhkan</small>
             <?php if (!empty($perlengkapan)) : ?>
  <?php foreach ($perlengkapan as $p) : ?>
    <div class="custom-control custom-checkbox mb-2">
      <input
        type="checkbox"
        class="custom-control-input"
        id="per<?= $p->idPerlengkapan; ?>"
        name="perlengkapanSupport[]"
        value="<?= $p->idPerlengkapan; ?>"
      >
      <label class="custom-control-label" for="per<?= $p->idPerlengkapan; ?>">
        <?= htmlspecialchars($p->namaPerlengkapan); ?>
      </label>
    </div>
  <?php endforeach; ?>
<?php endif; ?>
        </div>
        <div class="mb-3">
            <label for="token">Verifikasi Token</label>
            <input type="text" name="token" id="token" class="form-control" >
        </div>

    <button type="submit" class="btn btn-success btn-block" name="statusPinjam">Ambil Kunci</button>
    <a href="<?= site_url('peminjaman/indexPengambilanKunci/'.$pinjam->idPeminjaman) ?>" class="btn btn-outline-danger btn-block">Batal</a>
    </form>
</div>

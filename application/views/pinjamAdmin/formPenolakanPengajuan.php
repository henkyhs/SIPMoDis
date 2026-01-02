<div class="container mt-4">
    <h2>Form Pengajuan Peminjaman</h2>
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
                </dl>
              </div>
        </div>
    </div>
    <form action="<?= site_url('peminjaman/savePengajuan/'); ?>" method="post" enctype="multipart/form-data">
		<!-- Alasan Penolakan -->
         <div class="form-group">
    		<label for="exampleFormControlTextarea1">Catatan</label>
    		<textarea class="form-control" name="catatanInspeksi" id="tujuan" rows="3"></textarea>
  		</div>

        <a href="<?= site_url('peminjaman/formPengecekkanPengajuan/'.$pinjam->idPeminjaman) ?>" class="btn btn-secondary">Kembali</a>
		<a href="<?= site_url('peminjaman/PenolakanPengajuan/'.$pinjam->idPeminjaman) ?>" class="btn btn-danger" onclick="return confirm('Yakin batal?')">Tolak Pengajuan</a>
    </form>
</div>

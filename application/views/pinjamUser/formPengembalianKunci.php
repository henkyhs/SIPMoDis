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
                    
                    <dt class="col-5 text-secondary">Perlengkapan yang Dibawa</dt>
                    <dd class="col-7">
                         <?php if (!empty($perlengkapan)) : ?>
                    <?php foreach ($perlengkapan as $p) : ?>
                            <?= htmlspecialchars($p->namaPerlengkapan); ?>,
                    <?php endforeach; ?>
                    <?php endif; ?>
                    </dd>
                </dl>
              </div>
        </div>
    </div>
    <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-danger text-center">
            <?= $this->session->flashdata('error'); ?>
        </div>
    <?php endif; ?>
    <form action="<?= site_url('peminjaman/pengembalianKunci/'.$pinjam->idPeminjaman); ?>" method="post">
		<!-- Input Perlengkapan -->
     <div class="form-group">
            <label>Perlengkapan yang Dikembalikan</label>
            <small class="text-muted d-block mb-1">Ceklist Perlengkapan yang Dikembalikan</small>
             <?php if (!empty($perlengkapan)) : ?>
                <?php foreach ($perlengkapan as $p) : ?>
                    <div class="custom-control custom-checkbox mb-2">
                    <input
                        type="checkbox"
                        class="custom-control-input"
                        id="per<?= $p->idPerlengkapan; ?>"
                        name="perlengkapanSupport[]"
                        value="<?= $p->idPerlengkapan; ?>"
                        <?= ((int)$p->isDikembalikan === 1) ? 'checked' : '' ?>>
                    >
                    <label class="custom-control-label" for="per<?= $p->idPerlengkapan; ?>">
                        <?= htmlspecialchars($p->namaPerlengkapan); ?>
                    </label>
                    </div>
                <?php endforeach; ?>
                <?php endif; ?>
     </div>

      <div class="form-group">
            <label>Kondisi Bensin</label>
            <small class="text-muted d-block mb-1">Bagaimana Kondisi Bensin Terakhir</small>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio"
                       name="bensinPemakaian" id="bensinPemakaian_1" value="1"
                       <?= set_radio('bensinPemakaian','1'); ?>>
                <label class="form-check-label" for="bensinPemakaian_1">E (Habis)</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio"
                       name="bensinPemakaian" id="bensinPemakaian_2" value="2"
                       <?= set_radio('bensinPemakaian','2'); ?>>
                <label class="form-check-label" for="bensinPemakaian_2">1/4</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio"
                       name="bensinPemakaian" id="bensinPemakaian_3" value="3"
                       <?= set_radio('bensinPemakaian','3'); ?>>
                <label class="form-check-label" for="bensinPemakaian_3">1/2</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio"
                       name="bensinPemakaian" id="bensinPemakaian_4" value="4"
                       <?= set_radio('bensinPemakaian','4'); ?>>
                <label class="form-check-label" for="bensinPemakaian_4">3/4</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio"
                       name="bensinPemakaian" id="bensinPemakaian_5" value="5"
                       <?= set_radio('bensinPemakaian','5'); ?>>
                <label class="form-check-label" for="bensinPemakaian_5">F (Penuh)</label>
            </div>
            <div class="text-danger small"><?= form_error('bensinPemakaian'); ?></div>
        </div>

     <div class="form-group">
    		<label for="exampleFormControlTextarea1">Catatan Seteleh Peminjaman (Opsional)</label>
    		<textarea class="form-control" name="catatanPeminjam" id="catatanPeminjam" rows="3"></textarea>
  		</div>

		<a href="<?= site_url('peminjaman/indexPengambilanKunci/'.$pinjam->idPeminjaman) ?>" class="btn btn-secondary btn-block">Kembali</a>
        <button type="submit" class="btn btn-primary btn-block" name="statusPinjam">Kembalikan Kunci</button>
    </form>
</div>

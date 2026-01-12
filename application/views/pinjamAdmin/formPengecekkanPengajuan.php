<div class="container mt-4">
    <h2>Form Pengecekkan Pengajuan</h2>
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
                    
                    <dt class="col-5 text-secondary">Preferensi Transmisi Mobil</dt>
                    <dd class="col-7">
                         <?= htmlspecialchars(preferensi_mobil($pinjam->preferensiTransmisi) ?? '-'); ?>
                    </dd>

                    <dt class="col-5 text-secondary">Lampiran</dt>
                    <dd class="col-7"><a href="<?= base_url('uploads/lampiran/'.rawurlencode($pinjam->lampiran)); ?>" target="_blank">Lihat</a></dd>
                </dl>
              </div>
        </div>
    </div>
    <form action="<?= site_url('peminjaman/savePersetujuanPengajuan/'.$pinjam->idPeminjaman); ?>" method="post" enctype="multipart/form-data">
		<!-- Pilih Mobil -->
        <div class="mb-3">
			<label for="plat">Mobil Digunakan</label>
			<select name="idMobil" class="form-control" required>
				<option value="">-- Pilih Mobil --</option>
				<?php  if(!empty($plat)){
					 foreach ($plat as $p): ?>
					<option value="<?= $p->idMobil ?>"><?= $p->platNomor ?>-<?=$p->namaMobil?></option>
				<?php endforeach;
				} 
				else{?>
					<option value="">Mobil Tidak tersedia</option>
				<?php }
				?>
				
			</select>
		</div>
    	<button type="submit" class="btn btn-success btn-block" name="statusPinjam" value="2">Setujui</button>
        <a href="<?= site_url('peminjaman/formPenolakanPengajuan/'.$pinjam->idPeminjaman) ?>" class="btn btn-outline-danger btn-block">Tolak Pengajuan</a>
    </form>
</div>

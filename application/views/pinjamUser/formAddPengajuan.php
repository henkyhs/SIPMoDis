<div class="container mt-4">
    <h2>Form Penggajuan Peminjaman</h2>

    <?php if (!empty($warningCatatan)) : ?>
        <div class="alert alert-warning">
            <strong>Perhatian!</strong><br>
            Anda masih memiliki catatan saat pengembalian, segera hubungi admin.
        </div>
    <?php endif; ?>
    <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-danger text-center">
            <?= $this->session->flashdata('error'); ?>
        </div>
    <?php endif; ?>

    <form action="<?= site_url('peminjaman/savePengajuan'); ?>" method="post" enctype="multipart/form-data">
        <!-- ID Kategori (otomatis dan readonly) -->
        <div class="mb-3">
            <label for="idPinjam">ID Peminjaman</label>
            <input type="text" name="idPeminjaman" id="idPeminjaman" class="form-control" 
                   value="<?= $dataIdPinjam ?>" readonly>
        </div>

		<!-- Tanggal Peminjam -->
        <div class="form-group">
			<label for="tanggal_pinjam">Tanggal Peminjaman</label>
			<input type="date" name="tglPeminjaman" id="tglPeminjaman" min="<?= date('Y-m-d'); ?>" class="form-control">
            <div class="text-danger"><?= form_error('tglPeminjaman'); ?></div>
		</div>
        
        <div class="form-group">
            <label>Preferensi Jenis Mobil</label>
            <small class="text-muted d-block mb-1">Pilih jenis transmisi yang diutamakan.</small>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio"
                       name="preferensiTransmisi" id="jenis_manual" value="1"
                       <?= set_radio('preferensiTransmisi','1'); ?>>
                <label class="form-check-label" for="jenis_manual">Matic</label>
            </div>
            
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio"
                       name="preferensiTransmisi" id="jenis_matic" value="2"
                       <?= set_radio('preferensiTransmisi','2'); ?>>
                <label class="form-check-label" for="jenis_matic">Manual</label>
            </div>

            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio"
                       name="preferensiTransmisi" id="jenis_keduanya" value="3"
                       <?= set_radio('preferensiTransmisi','3'); ?>>
                <label class="form-check-label" for="jenis_keduanya">Keduanya</label>
            </div>
            <div class="text-danger small"><?= form_error('preferensiTransmisi'); ?></div>
        </div>

        <div class="form-group">
            <label>Keperluan Peminjaman</label>
            <small class="text-muted d-block mb-1">Pilih alasan anda meminjam mobil</small>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio"
                       name="keperluan" id="keperluan_visit" value="1"
                       <?= set_radio('keperluan','1'); ?>>
                <label class="form-check-label" for="keperluan_visit">Visit</label>
            </div>

            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio"
                       name="keperluan" id="keperluan_lainnya" value="2"
                       <?= set_radio('keperluan','2'); ?>>
                <label class="form-check-label" for="keperluan_lainnya">Lainnya</label>
            </div>
            <div class="text-danger small"><?= form_error('keperluan'); ?></div>
        </div>
        
        <div class="form-group">
    		<label for="exampleFormControlTextarea1">Alamat Tujuan</label>
    		<textarea class="form-control" name="tujuan" id="tujuan" rows="3"></textarea>
            <div class="text-danger"><?= form_error('tujuan'); ?></div>
  		</div>

		<div class="form-group">
			<label for="lampiran">Upload Lampiran (PDF) *max 2MB (Jika anda memilih visit)</label>
			<input type="file" name="lampiran" id="lampiranCustom" class="form-control" accept=".pdf">
		</div>
        <button type="submit" class="btn btn-success btn-block" name="statusPinjam" value="1">Ajukan</button>
		<button type="submit" class="btn btn-outline-primary btn-block" name="statusPinjam" value="0">Simpan sebagai Draft</button>
        <a href="<?= site_url('peminjaman/indexPeminjam/') ?>" class="btn btn-outline-danger btn-block">Batal</a>
    </form>
</div>

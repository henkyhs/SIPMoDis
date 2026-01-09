<div class="container mt-4">
    <h2>Form Edit Draft</h2>

    <form action="<?= site_url('peminjaman/updatePengajuan/'.$pinjam->idPeminjaman); ?>" method="post" enctype="multipart/form-data">
        <!-- ID Kategori (otomatis dan readonly) -->
        <div class="mb-3">
            <label for="idPinjam">ID Peminjaman</label>
            <input type="text" name="idPeminjaman" id="idPeminjaman" class="form-control" 
                   value="<?= $pinjam->idPeminjaman; ?>" readonly>
        </div>

		<!-- Tanggal Peminjam -->
        <div class="form-group">
			<label for="tanggal_pinjam">Tanggal Peminjaman</label>
			<input type="date" name="tglPeminjaman" id="tglPeminjaman" class="form-control" value="<?= $pinjam->tglPeminjaman; ?>" required>
		</div>
        
        <!-- <div class="mb-3">
			<label for="preferensiMobil">Preferensi Mobil</label>
			<select name="preferensiMobil" class="form-control" required>
				<option value="">-- Pilih Mobil --</option>
                <option value="1">Matic</option>
                <option value="2">Manual</option>
                <option value="3">Matic dan Manual</option>
			</select>
		</div> -->
         <?php $pref = set_value('preferensiTransmisi', $pinjam->preferensiTransmisi); ?>
        <div class="form-group">
            <label>Preferensi Jenis Mobil</label>
            <small class="text-muted d-block mb-1">Pilih jenis transmisi yang diutamakan.</small>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio"
                       name="preferensiTransmisi" id="jenis_manual" value="1"
                       <?= ($pref == '1') ? 'checked' : ''; ?>>
                <label class="form-check-label" for="jenis_manual">Manual</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio"
                       name="preferensiTransmisi" id="jenis_matic" value="2"
                      <?= ($pref == '2') ? 'checked' : ''; ?>>
                <label class="form-check-label" for="jenis_matic">Matic</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio"
                       name="preferensiTransmisi" id="jenis_keduanya" value="3"
                       <?= ($pref == '3') ? 'checked' : ''; ?>>
                <label class="form-check-label" for="jenis_keduanya">Keduanya</label>
            </div>
            <div class="text-danger small"><?= form_error('preferensiTransmisi'); ?></div>
        </div>

        <!-- Keperluan -->
        <div class="form-group">
            <label>Keperluan Peminjaman</label>
            <small class="text-muted d-block mb-1">Pilih alasan anda meminjam mobil</small>

            <?php $kep = set_value('keperluan', $pinjam->keperluan); ?>

            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio"
                       name="keperluan" id="keperluan_visit" value="1"
                       <?= ($kep == '1') ? 'checked' : ''; ?>>
                <label class="form-check-label" for="keperluan_visit">Visit</label>
            </div>

            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio"
                       name="keperluan" id="keperluan_lainnya" value="2"
                       <?= ($kep == '2') ? 'checked' : ''; ?>>
                <label class="form-check-label" for="keperluan_lainnya">Lainnya</label>
            </div>

            <div class="text-danger small"><?= form_error('keperluan'); ?></div>
        </div>

        <!-- Tujuan -->
        <div class="form-group">
            <label for="tujuan">Alamat Tujuan</label>
            <textarea class="form-control" name="tujuan" id="tujuan" rows="3"><?= set_value('tujuan', $pinjam->tujuan); ?></textarea>
            <div class="text-danger small"><?= form_error('tujuan'); ?></div>
        </div>

        <!-- Lampiran (update: tidak wajib upload ulang) -->
        <div class="form-group">
            <label for="lampiran">Upload Lampiran (PDF) *max 2MB</label>
            <input type="file" name="lampiran" id="lampiran" class="form-control" accept=".pdf">

            <!-- simpan file lama -->
            <input type="hidden" name="lampiran_lama" value="<?= html_escape($pinjam->lampiran); ?>">

            <?php if (!empty($pinjam->lampiran)): ?>
                <small class="text-muted d-block mt-1">
                    Lampiran saat ini:
                    <a href="<?= base_url('uploads/lampiran/'.rawurlencode($pinjam->lampiran)); ?>" target="_blank">Lihat</a>
                </small>
            <?php else: ?>
                <small class="text-muted d-block mt-1">Belum ada lampiran.</small>
            <?php endif; ?>

            <div class="text-danger small"><?= form_error('lampiran'); ?></div>
        </div>
        <button type="submit" class="btn btn-success btn-block" name="statusPinjam" value="1">Ajukan</button>
		<button type="submit" class="btn btn-outline-primary btn-block" name="statusPinjam" value="0">Simpan sebagai Draft</button>
    </form>
</div>

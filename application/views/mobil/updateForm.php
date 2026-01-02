<div class="container mt-4">
    <h2>Edit Mobil</h2>

    <form action="<?= site_url('mobil/update/'.$mobil->idMobil); ?>" method="post">
        <!-- ID Kategori (otomatis dan readonly) -->
        <div class="mb-3">
            <label for="idMobil">ID Kategori</label>
            <input type="text" name="idMobil" id="idMobil" class="form-control" 
                   value="<?= $mobil->idMobil ?>" readonly>
        </div>

        <!-- Nama Kategori -->
        <div class="mb-3">
            <label for="nama_mobil">Tipe Mobil</label>
            <input type="text" name="namaMobil" id="namaMobil" 
                   class="form-control" value="<?= $mobil->namaMobil ?>" required>
        </div>

         <div class="mb-3">
            <label for="noBPKB">Merk Mobil</label>
            <input type="text" name="merkMobil" id="merkMobil" 
                   class="form-control" value="<?= $mobil->merkMobil ?>" required>
        </div>

		<!-- Nomor Polisi -->
        <div class="mb-3">
            <label for="platNomor">Plat Nomor  <small class="form-text text-muted">
                Contoh: <strong>B 123 BC</strong>
             </small></label>
            <?= form_error('platNomor'); ?>
             <div class="row no-gutters align-items-center">
        <!-- Huruf depan -->
        <div class="col-3 col-md-2 pr-1">
            <input
                type="text"
                name="plat1"
                maxlength="2"
                class="form-control text-uppercase text-center <?php echo form_error('plat1') ? 'is-invalid' : ''; ?>"
                placeholder=""
                value="<?= set_value('plat1', $plat1); ?>"
                required
            >
        </div>
        <!-- Spasi visual -->
        <div class="col-auto px-1">
            <span class="h5 mb-0 d-none d-md-inline">–</span>
        </div>
        <!-- Angka -->
        <div class="col-4 col-md-3 px-1">
            <input
                type="text"
                name="plat2"
                maxlength="4"
                class="form-control text-center <?php echo form_error('plat2') ? 'is-invalid' : ''; ?>"
                placeholder=""
                value="<?= set_value('plat2', $plat2); ?>"
                required
            >
        </div>
        <!-- Spasi visual -->
        <div class="col-auto px-1">
            <span class="h5 mb-0 d-none d-md-inline">–</span>
        </div>
        <!-- Huruf belakang -->
        <div class="col-4 col-md-3 pl-1">
            <input
                type="text"
                name="plat3"
                maxlength="3"
                class="form-control text-uppercase text-center <?php echo form_error('plat3') ? 'is-invalid' : ''; ?>"
                placeholder=""
                value="<?= set_value('plat3', $plat3); ?>"
                required
            >
        </div>
    </div>
        </div>

		<!-- Kondisi Mobil -->
		<div class="mb-3">
            <label>Kondisi Mobil</label>
            <select name="kondisiMobil" class="form-control" required>
                <option value="1" <?= $mobil->kondisiMobil == 1 ? 'selected' : '' ?>>Tersedia</option>
                <option value="2" <?= $mobil->kondisiMobil == 2 ? 'selected' : '' ?>>Dipinjam</option>
                <option value="3" <?= $mobil->kondisiMobil == 3 ? 'selected' : '' ?>>Rusak</option>
            </select>
        </div>
        <!-- Transmisi Mobil -->
        <div class="mb-3">
            <label>Transmisi</label>
            <select name="transmisi" class="form-control" required>
                <option value="1" <?= $mobil->transmisi == 1 ? 'selected' : '' ?>>Matic</option>
                <option value="2" <?= $mobil->transmisi == 2 ? 'selected' : '' ?>>Manual</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="noBPKB">No BPKB</label>
            <input type="text" name="noBPKB" id="noBPKB" 
                   class="form-control" value="<?= $mobil->noBPKB ?>" required>
        </div>
        <div class="mb-3">
            <label for="atasNama">Atas Nama</label>
            <input type="text" name="atasNama" id="atasNama" 
                   class="form-control" value="<?= $mobil->noBPKB ?>" required>
        </div>
		<!-- Keterangan -->
		<div class="form-group">
    		<label for="exampleFormControlTextarea1">Keterangan</label>
    		<textarea class="form-control"  value="<?= $mobil->ket ?>"name="ket" id="keterangan" rows="3"></textarea>
  		</div>
	
        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
</div>

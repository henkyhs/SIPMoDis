<div class="container mt-4">
    <h2>Form Tambah Seksi</h2>

    <form action="<?= site_url('seksi/save'); ?>" method="post">
        <!-- ID Kategori (otomatis dan readonly) -->
        <div class="mb-3">
            <label for="idMobil">ID Seksi</label>
            <input type="text" name="idSeksi" id="idSeksi" class="form-control" 
                   value="<?= $dataIdSeksi ?>" readonly>
        </div>

        <!-- Nama Kategori -->
        <div class="mb-3">
            <label for="nama_seksi">Nama Seksi</label>
            <input type="text" name="namaSeksi" id="namaSeksi" 
                   class="form-control" required>
        </div>

		<div class="form-group">
    		<label for="exampleFormControlTextarea1">Keterangan</label>
    		<textarea class="form-control" name="ket" id="keterangan" rows="3"></textarea>
  		</div>
	
        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
</div>

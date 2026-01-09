<div class="container mt-4">
    <h2>Form Update Seksi</h2>

    <form action="<?= site_url('seksi/update/'.$seksi->idSeksi); ?>" method="post">
        <!-- ID Kategori (otomatis dan readonly) -->
        <div class="mb-3">
            <label for="idSeksi">ID Seksi</label>
            <input type="text" name="idSeksi" id="idSeksi" class="form-control" 
                   value="<?= $seksi->idSeksi ?>" readonly>
        </div>

        <!-- Nama Kategori -->
        <div class="mb-3">
            <label for="nama_mobil">Nama Seksi</label>
            <input type="text" name="namaSeksi" id="namaSeksi" 
                   class="form-control" value="<?= $seksi->namaSeksi ?>">
             <div class="text-danger"><?= form_error('namaSeksi'); ?></div>
        </div>
		<!-- Keterangan -->
		<div class="form-group">
    		<label for="exampleFormControlTextarea1">Keterangan</label>
    		<textarea class="form-control"  value="<?= $seksi->ket ?>"name="ket" id="keterangan" rows="3"></textarea>
  		</div>
	
        <button type="submit" class="btn btn-success btn-block">Simpan</button>
         <a href="<?= site_url('seksi') ?>" class="btn btn-outline-danger btn-block">Kembalil</a>
    </form>
</div>

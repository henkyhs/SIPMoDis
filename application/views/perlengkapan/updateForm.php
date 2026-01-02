<div class="container mt-4">
    <h2>Form Update Perlengkapan</h2>

    <form action="<?= site_url('perlengkapan/update/'.$perlengkapan->idPerlengkapan); ?>" method="post">
        <!-- ID Kategori (otomatis dan readonly) -->
        <div class="mb-3">
            <label for="idPerlengkapan">ID Perlengkapan</label>
            <input type="text" name="idPerlengkapan" id="idPerlengkapan" class="form-control" 
                   value="<?= $perlengkapan->idPerlengkapan ?>" readonly>
        </div>

        <!-- Nama Kategori -->
        <div class="mb-3">
            <label for="nama_perlengkapan">Nama Perlengkapan</label>
            <input type="text" name="namaPerlengkapan" id="namaPerlengkapan" 
                   class="form-control" value="<?= $perlengkapan->namaPerlengkapan ?>" required>
        </div>
	
        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
</div>

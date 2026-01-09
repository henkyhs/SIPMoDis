<div class="container mt-4">
    <h2>Form Tambah Perlengkapan</h2>

    <form action="<?= site_url('perlengkapan/save'); ?>" method="post">
        <!-- ID Kategori (otomatis dan readonly) -->
        <div class="mb-3">
            <label for="idPerlengkapan">ID Perlengkapan</label>
            <input type="text" name="idPerlengkapan" id="idPerlengkapan" class="form-control" 
                   value="<?= $dataIdPerlengkapan ?>" readonly>
        </div>

        <!-- Nama Kategori -->
        <div class="mb-3">
            <label for="nama_perlengkapan">Nama Perlengkapan</label>
            <input type="text" name="namaPerlengkapan" id="namaPerlengkapan" 
                   class="form-control">
            <div class="text-danger"><?= form_error('namaPerlengkapan'); ?></div>
        </div>	
        <button type="submit" class="btn btn-success btn-block">Simpan</button>
         <a href="<?= site_url('perlengkapan') ?>" class="btn btn-outline-danger btn-block">Kembalil</a>
    </form>
</div>

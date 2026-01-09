<div class="container mt-4">
    <h2>Form Tambah User</h2>

    <form action="<?= site_url('user/save'); ?>" method="post">
        <!-- ID Kategori (otomatis dan readonly) -->
        <div class="mb-3">
            <label for="idUser">ID User</label>
            <input type="text" name="idUser" id="idUser" class="form-control" 
                   value="<?= $dataIdUser ?>" readonly>
        </div>

        <!-- Nama Pegawai -->
        <div class="mb-3">
            <label for="nama_pegawai">Nama Pegawai</label>
            <input type="text" name="namaPegawai" id="namaSeksi" 
                   class="form-control" value="<?= set_value('namaPegawai'); ?>">
            <div class="text-danger"><?= form_error('namaPegawai'); ?></div>
        </div>
		<!-- NIP -->
        <div class="mb-3">
            <label for="nip">NIP</label>
            <input type="text" name="nip" id="nip" 
                   class="form-control" value="<?= set_value('nip'); ?>">
            <div class="text-danger"><?= form_error('nip'); ?></div>
        </div>

        <!-- No HP -->
        <div class="mb-3">
            <label for="nip">No Handphone/WA Aktif</label>
            <input type="text" name="noHp" id="noHp" 
                   class="form-control" value="<?= set_value('noHp'); ?>">
            <div class="text-danger"><?= form_error('noHp'); ?></div>
        </div>
		<!-- Seksi -->
		<div class="mb-3">
			<label for="idSeksi">Seksi</label>
			<select name="idSeksi" class="form-control" required>
				<option value="">-- Pilih Seksi --</option>
				<?php foreach ($listSeksi as $seksi): ?>
					<option value="<?= $seksi->idSeksi ?>"><?= $seksi->namaSeksi ?></option>
				<?php endforeach; ?>
			</select>
		</div>
		
		<!-- Role -->
		<div class="mb-3">
			<label for="role">Role</label>
			<select name="role" class="form-control" required>
				<option value="">-- Pilih Role --</option>
				<option value="1">Admin</option>
				<option value="2">Peminjam</option>
			</select>
		</div>
	
        <button type="submit" class="btn btn-success btn-block">Simpan</button>
         <a href="<?= site_url('user') ?>" class="btn btn-outline-danger btn-block">Kembalil</a>
    </form>
</div>

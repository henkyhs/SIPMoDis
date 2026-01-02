<div class="container mt-4">
    <h2>Edit Profil Anda</h2>

    <form action="<?= site_url('user/update/'.$user->iduser); ?>" method="post">
        <!-- ID Kategori (otomatis dan readonly) -->
        <div class="mb-3">
            <label for="idUser">ID User</label>
            <input type="text" name="idSeksi" id="idSeksi" class="form-control" 
                   value="<?= $seksi->idSeksi ?>" readonly>
        </div>

      <!-- Nama Pegawai -->
        <div class="mb-3">
            <label for="nama_pegawai">Nama Pegawai</label>
            <input type="text" name="namaPegawai" id="namaSeksi" 
                   class="form-control" required>
        </div>
		<!-- Username -->
        <div class="mb-3">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" 
                   class="form-control" readonly>
        </div>
		<!-- NIP -->
        <div class="mb-3">
            <label for="nip">NIP</label>
            <input type="text" name="nip" id="nip" 
                   class="form-control" required>
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
	
        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
</div>

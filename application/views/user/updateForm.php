<div class="container mt-4">
    <h2>Edit User</h2>
   <!-- Status akun -->
<div class="card mb-3">
  <div class="card-body d-flex align-items-start justify-content-between">
    <div>
      <div class="d-flex align-items-center mb-1">
        <h6 class="mb-0 mr-2">Status Akun</h6>

        <?php if ((int)$user->isActive === 1): ?>
          <span class="badge badge-success">Aktif</span>
        <?php else: ?>
          <span class="badge badge-secondary">Nonaktif</span>
        <?php endif; ?>
      </div>

      <small class="text-muted">
        <?php if ($user->isActive === 1): ?>
          Akun dapat login dan menggunakan sistem.
        <?php else: ?>
          Akun tidak dapat login sampai diaktifkan kembali.
        <?php endif; ?>
      </small>
    </div>

    <div class="text-right">
      <form action="<?= site_url('user/gantiStatus/'.$user->idUser); ?>" method="post" class="mb-0">
        <?php if ((int)$user->isActive === 1): ?>
          <button type="submit"
                  class="btn btn-sm btn-outline-danger"
                  onclick="return confirm('Yakin nonaktifkan akun?')"
                  name="isActive" value="0">
            Nonaktifkan Akun
          </button>
        <?php else: ?>
          <button type="submit"
                  class="btn btn-sm btn-outline-success"
                  onclick="return confirm('Yakin aktifkan akun?')"
                  name="isActive" value="1">
            Aktifkan Akun
          </button>
        <?php endif; ?>
      </form>

      <small class="text-muted d-block mt-2">
        Aksi ini tidak mengubah data profil.
      </small>
    </div>
  </div>

  <?php if ((int)$user->isActive === 0): ?>
    <div class="card-footer">
      <div class="alert alert-warning mb-0" role="alert">
        <strong>Catatan:</strong> User ini sedang nonaktif, sehingga tidak bisa login.
      </div>
    </div>
  <?php endif; ?>
</div>

    <form action="<?= site_url('user/update/'.$user->idUser); ?>" method="post">
        <!-- ID Kategori (otomatis dan readonly) -->
        <div class="mb-3">
            <label for="idUser">ID Kategori</label>
            <input type="text" name="idUser" id="idUser" class="form-control" 
                   value="<?= $user->idUser ?>" readonly>
        </div>

        <!-- Nama Kategori -->
        <div class="mb-3">
            <label for="nama_user">Nama Pegawai</label>
            <input type="text" name="namaPegawai" id="namaPegawai" 
                   class="form-control" value="<?= $user->namaPegawai ?>">
            <div class="text-danger"><?= form_error('namaPegawai'); ?></div>
        </div>
        <!-- NIP -->
         <div class="mb-3">
            <label for="NIP">NIP</label>
            <input type="text" name="nip" id="nip" 
                   class="form-control" value="<?= $user->nip ?>">
            <div class="text-danger"><?= form_error('nip'); ?></div>
        </div>
        <!-- NIP -->
         <div class="mb-3">
            <label for="NIP">No Handphone/WA Aktif</label>
            <input type="text" name="noHp" id="noHp" 
                   class="form-control" value="<?= $user->noHp ?>">
            <div class="text-danger"><?= form_error('noHp'); ?></div>
        </div>

		<!-- Seksi -->
		<div class="mb-3">
            <label>Seksi</label>
            <select name="idSeksi" class="form-control">
                <option value="<?= $user->idSeksi ?>"><?= $user->namaSeksi ?> (Seksi Anda Sekarang)</option>
                <?php foreach ($listSeksi as $seksi): ?>
					<option value="<?= $seksi->idSeksi ?>"><?= $seksi->namaSeksi ?></option>
				<?php endforeach; ?>
            </select>
            <div class="text-danger"><?= form_error('idSeksi'); ?></div>
        </div>
        <!-- Role -->
		<div class="mb-3">
			<label for="role">Role</label>
			<select name="role" class="form-control" >
                <option value="1" <?= $user->role == 1 ? 'selected' : '' ?>>Admin</option>
                <option value="2" <?= $user->role == 2 ? 'selected' : '' ?>>Peminjam</option>
			</select>
            <div class="text-danger"><?= form_error('role'); ?></div>
		</div>

        

        <button type="submit" class="btn btn-success btn-block">Update</button>
        <a href="<?= site_url('user') ?>" class="btn btn-outline-danger btn-block">Kembalil</a>
    </form>
</div>

<div class="container mt-4">
    <h2>Reset Password Anda</h2>
    <?php if ($this->session->flashdata('error')): ?>
                        <div class="alert alert-danger">
                            <?= $this->session->flashdata('error') ?>
                        </div>
                    <?php endif; ?>
    <div class="card shadow mb-4">
        <!-- Card Header - Accordion -->
        <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse"
        role="button" aria-expanded="true" aria-controls="collapseCardExample">
        <h6 class="m-0 font-weight-bold text-primary">Reset Password</h6>
        </a>
        <!-- Card Content - Collapse -->
        <div class="collapse show" id="collapseCardExample">
             <div class="card-body">
                  <dl class="row mb-0">
                    <dt class="col-5 text-secondary">Nama Peminjam</dt>
                    <dd class="col-7"><?= htmlspecialchars($user->namaPegawai ?? '-'); ?></dd>
                </dl>
              </div>
        </div>
    </div>
    <form action="<?= site_url('user/gantiPassword/'.$user->idUser); ?>" method="post">
        <!-- ID Kategori (otomatis dan readonly) -->
      <!-- Nama Pegawai -->
        <div class="mb-3">
            <label for="oldPassword">Password Lama</label>
            <div class="input-group">
                <input type="password" name="passwordLama" id="passwordLama" 
                    class="form-control" required>
            </div>
            
        </div>
		<!-- Username -->
         <div class="mb-3">
            <label for="newPassword">Password Baru</label>
            <div class="input-group">
                <input type="password" name="passwordBaru" id="passwordBaru" 
                    class="form-control" required>
            </div>
        </div>
		<!-- NIP -->
        <div class="mb-3">
            <label for="passwordConfirmation">Konfirmasi Password</label>
            <div class="input-group">
                <input type="password" name="konfirmasiPassword" id="konfirmasiPassword" 
                    class="form-control" required>
            </div>
        </div>
	
        <button type="submit" class="btn btn-success btn-block">Simpan</button>
         <a href="<?= site_url('dashboard') ?>" class="btn btn-outline-danger btn-block">Kembalil</a>
    </form>
</div>

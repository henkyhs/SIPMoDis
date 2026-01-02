<div class="container login-container">
  <div class="login-box">
    <h4 class="text-center">SIPMoDis</h4>
		<h5 class="text-center">KPP Pratama Pondok Gede</h5>

    <!-- <?php if (validation_errors()): ?>
      <div class="alert alert-danger py-2">
        <?= validation_errors(); ?>
      </div>
    <?php endif; ?> -->
     <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-danger text-center">
            <?= $this->session->flashdata('error'); ?>
        </div>
    <?php endif; ?>

    <form method="post" action="<?= site_url('auth') ?>">
      <div class="mb-3">
        <label for="nip" class="form-label">Nomor Pegawai (NIP) Pendek</label>
        <input type="text" class="form-control" id="nip" name="nip" value="<?= set_value('nip') ?>" required>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Kata Sandi</label>
        <input type="password" class="form-control" id="password" name="password" required>
      </div>
      <button type="submit" class="btn btn-primary">Masuk</button>
    </form>
		<!-- <p class="small mb-5 pb-lg-2"><a class="text-dark-50" href="<?= base_url('auth/lupaPassword')?>">Lupa Kata Sandi</a></p> -->
  </div>
</div>


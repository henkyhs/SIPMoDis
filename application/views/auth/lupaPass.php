<div class="container login-container">
  <div class="login-box">
    <h4 class="text-center">Lupa Kata Sandi</h4>

    <?php if (validation_errors()): ?>
      <div class="alert alert-danger py-2">
        <?= validation_errors(); ?>
      </div>
    <?php endif; ?>

    <?php if (!empty($error)): ?>
      <div class="alert alert-danger py-2">
        <?= $error ?>
      </div>
    <?php endif; ?>

    <form method="post" action="<?= site_url('auth/lupaPassword') ?>">
      <div class="mb-3">
        <label for="nip" class="form-label">Masukkan NIP Anda</label>
        <input type="text" class="form-control" id="nip" name="nip" required>
      </div>

			<div class="mb-3">
        <label for="newPassword" class="form-label">Masukkan Password Baru</label>
        <input type="text" class="form-control" id="newPassword" name="newPassword" required>
      </div>

			<div class="mb-3">
        <label for="nip" class="form-label">Konfirmasi Password Baru</label>
        <input type="text" class="form-control" id="confirmPassword" name="confirmPassword" required>
      </div>
      <button type="submit" class="btn btn-primary">Reset Password</button>
    </form>
		<a href="<?= site_url('auth/login') ?>">Kembali ke Login</a>
  </div>
</div>


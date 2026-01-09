<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>500 - Terjadi Kesalahan</title>

  <link href="<?= base_url('assets/vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet" type="text/css">
  <link href="<?= base_url('assets/css/sb-admin-2.min.css') ?>" rel="stylesheet">
</head>

<body id="page-top">
  <div class="container">
    <div class="text-center mt-5">
      <div class="error mx-auto" data-text="500">500</div>
      <p class="lead text-gray-800 mb-3">Terjadi Kesalahan</p>
      <p class="text-gray-500 mb-4">Sistem mengalami kendala. Silakan coba beberapa saat lagi.</p>

      <?php if (defined('ENVIRONMENT') && ENVIRONMENT !== 'production' && isset($message)): ?>
        <div class="card shadow mb-4 text-left">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-danger"><?= isset($heading) ? $heading : 'Error Detail' ?></h6>
          </div>
          <div class="card-body">
            <pre style="white-space:pre-wrap;"><?= $message ?></pre>
          </div>
        </div>
      <?php endif; ?>

      <a href="<?= site_url('dashboard') ?>" class="btn btn-light btn-icon-split">
        <span class="text">Kembali ke Dashboard</span>
      </a>
    </div>
  </div>

  <script src="<?= base_url('assets/vendor/jquery/jquery.min.js') ?>"></script>
  <script src="<?= base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
  <script src="<?= base_url('assets/vendor/jquery-easing/jquery.easing.min.js') ?>"></script>
  <script src="<?= base_url('assets/js/sb-admin-2.min.js') ?>"></script>
</body>

</html>

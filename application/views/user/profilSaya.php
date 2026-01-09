<div class="container-fluid mt-4">
  <div class="card shadow mb-4">
    <div class="card-body">
      <div class="d-flex align-items-center">

        <!-- Avatar Initial -->
        <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center"
            style="width:64px;height:64px;font-size:22px;font-weight:700;">
          <?= strtoupper(substr($user->namaPegawai,0,1)) . strtoupper(substr(strstr($user->namaPegawai,' ') ?: ' ',1,1)) ?>
        </div>

        <div class="ml-3">
          <div class="h5 mb-0 font-weight-bold"><?= htmlspecialchars($user->namaPegawai) ?></div>
          <div class="text-muted small">NIP: <?= htmlspecialchars($user->nip) ?></div>
          <div class="mt-2">
            <span class="badge badge-light border"><?= htmlspecialchars($user->namaSeksi) ?></span>
            <span class="badge badge-info"><?= role_user($user->role) ?></span>
            <?= ((int)$user->isActive === 1)
                ? "<span class='badge badge-success'>Aktif</span>"
                : "<span class='badge badge-secondary'>Nonaktif</span>"; ?>
          </div>
        </div>

      </div>

      <hr>

      <!-- Detail grid -->
      <div class="row">
        <div class="col-md-6 mb-2">
          <div class="text-muted small">No HP</div>
          <div class="font-weight-bold"><?= htmlspecialchars($user->noHp ?? '-') ?></div>
        </div>
      </div>
      <div class="mb-3">
        <div class="mb-2">
          <a href="<?= site_url('user/formGantiPassword/'.$this->session->userdata('idUser')) ?>" class="btn btn-primary btn-block">
           Ganti Password
        </a>
        <a href="<?= site_url('dashboard') ?>" class="btn btn-outline-danger btn-block ">
           Kembali
        </a>
        </div>
      </div>

    </div>
  </div>
</div>
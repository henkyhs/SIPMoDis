<div class="container mt-4">
    <div>
      <h1 class="h3 mb-0 text-gray-800">Detail Mobil</h1>
      <small class="text-muted">ID: <?= htmlspecialchars($mobil->idMobil) ?></small>
    </div>
    <div class="col-lg-8">

      <!-- Data Mobil -->
      <div class="card shadow mb-3">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
          <h6 class="m-0 font-weight-bold text-primary">Data Mobil</h6>
        </div>
        <div class="card-body">
            <div class="row">
              <div class="col-md-4 mb-2">
                <div class="text-muted small">Merk / Tipe</div>
                <div class="font-weight-bold"><?= htmlspecialchars($mobil->merkMobil) ?>/ <?= htmlspecialchars($mobil->namaMobil) ?></div>
              </div>
              <div class="col-md-4 mb-2">
                <div class="text-muted small">Transmisi</div>
                <div class="font-weight-bold"><?= htmlspecialchars($mobil->transmisi) ?></div>
              </div>
              <div class="col-md-4 mb-2">
                <div class="text-muted small">Plat Nomor</div>
                <div class="font-weight-bold"><?= htmlspecialchars($mobil->platNomor) ?></div>
              </div>
              <div class="col-md-4 mb-2">
                <div class="text-muted small">Kondisi Mobil</div>
                <div class="font-weight-bold"> <?= status_mobil($mobil->kondisiMobil); ?></div>
              </div>
              <div class="col-md-4 mb-2">
                <div class="text-muted small">No BPKB</div>
                <div class="font-weight-bold"><?= htmlspecialchars($mobil->noBPKB) ?></div>
              </div>
              <div class="col-md-4 mb-2">
                <div class="text-muted small">Atas Nama</div>
                <div class="font-weight-bold"><?= htmlspecialchars($mobil->atasNama) ?></div>
              </div>
              <div class="col-md-4 mb-2">
            <a href="<?= site_url('mobil'); ?>" class="btn btn-sm btn-secondary">Kembali</a>
        <a href="<?= site_url('mobil/editForm/'.$mobil->idMobil) ?>" class="btn btn-sm btn-warning ">Edit</a>
              </div>
            </div>
      </div>

      <!-- CTA -->

    </div>
    
</div>

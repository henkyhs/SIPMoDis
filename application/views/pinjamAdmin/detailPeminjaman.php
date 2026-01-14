<div class="container-fluid mt-4">

  <!-- Header -->
  <div class="d-sm-flex align-items-start justify-content-between mb-2">
    <div>
      <h1 class="h3 mb-1 text-gray-800">Detail Peminjaman</h1>
      <small class="text-muted">ID: <?= htmlspecialchars($pinjam->idPeminjaman) ?></small>
    </div>
    <div class="mt-2 mt-sm-0">
      <?= status_badge($pinjam->statusPinjam); ?>
    </div>
  </div>

  <div class="row">

    <!-- LEFT: MAIN CONTENT (Jira Issue Body) -->
    <div class="col-lg-8 order-2 order-lg-1">

      <!-- Data Mobil -->
      <div class="card shadow mb-3">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
          <h6 class="m-0 font-weight-bold text-primary">Data Mobil</h6>
          <?php if (!empty($pinjam->platNomor)): ?>
            <span class="badge badge-light border"><?= htmlspecialchars($pinjam->platNomor) ?></span>
          <?php endif; ?>
        </div>
        <div class="card-body">
          <?php if (!empty($pinjam->idMobil)): ?>
            <div class="row">
              <div class="col-md-6 mb-2">
                <div class="text-muted small">Merk / Tipe</div>
                <div class="font-weight-bold">
                  <?= htmlspecialchars($pinjam->merkMobil ?? '-') ?> / <?= htmlspecialchars($pinjam->namaMobil ?? '-') ?>
                </div>
              </div>
              <div class="col-md-6 mb-2">
                <div class="text-muted small">Transmisi</div>
                <div class="font-weight-bold"><?= htmlspecialchars(jenis_mobil($pinjam->transmisi) ?? '-') ?></div>
              </div>
            </div>
          <?php else: ?>
            <div class="text-muted">Mobil belum ditentukan.</div>
          <?php endif; ?>
        </div>
      </div>

      <!-- Perlengkapan -->
      <div class="card shadow mb-3">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Perlengkapan</h6>
        </div>
        <div class="card-body p-0">
          <?php if (!empty($pinjamPerlengkapan)): ?>
            <div class="table-responsive">
              <table class="table table-sm table-hover mb-0">
                <thead class="thead-light">
                  <tr>
                    <th>Nama Perlengkapan</th>
                    <th class="text-center">Dikembalikan (Peminjam)</th>
                    <th class="text-center">Ada (Inspeksi Admin)</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($pinjamPerlengkapan as $p): ?>
                    <tr>
                      <td><?= htmlspecialchars($p->namaPerlengkapan) ?></td>
                      <td class="text-center">
                        <?= ((int)$p->isDikembalikan === 1)
                          ? "<span class='badge badge-success'>Ya</span>"
                          : "<span class='badge badge-danger'>Tidak</span>" ?>
                      </td>
                      <td class="text-center">
                        <?= ((int)$p->isAda === 1)
                          ? "<span class='badge badge-success'>Ya</span>"
                          : "<span class='badge badge-warning'>Tidak Ada </span>" ?>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          <?php else: ?>
            <div class="p-3 text-muted">Tidak ada perlengkapan.</div>
          <?php endif; ?>
        </div>
      </div>

      <!-- Catatan -->
      <div class="card shadow mb-3">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Catatan</h6>
        </div>
        <div class="card-body">
          <div class="mb-2">
            <div class="text-muted small">Bensin yang Digunakan</div>
            <div><?= bensin_peminjam($pinjam->bensinPemakaian); ?></div>
          </div>
          <hr>
          <div class="mb-2">
            <div class="text-muted small">Catatan Peminjam</div>
            <div><?= nl2br(htmlspecialchars($pinjam->catatanPeminjam ?? '-')) ?></div>
          </div>
          <hr>
          <div class="mb-2">
            <div class="text-muted small">Bensin Setelah Diperiksa</div>
            <div><?= bensin_inspeksi($pinjam->bensinInspeksi); ?></div>
          </div>
          <hr>
          <div>
            <div class="text-muted small">Catatan Inspeksi Admin</div>
            <div><?= nl2br(htmlspecialchars($pinjam->catatanInspeksi ?? '-')) ?></div>
          </div>
        </div>
      </div>

      <!-- Timeline Log -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Riwayat Proses</h6>
        </div>
        <div class="card-body p-0">
          <?php if (!empty($logs)): ?>
            <ul class="list-group list-group-flush">
              <?php foreach ($logs as $l): ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                  <div>
                    <div class="font-weight-bold"><?= status_badge($l->aksi) ?></div>
                    <div class="text-muted small">Oleh: <?= htmlspecialchars($l->namaPegawai ?? '-') ?></div>
                  </div>
                  <span class="text-muted small"><?= htmlspecialchars($l->createdAt) ?></span>
                </li>
              <?php endforeach; ?>
            </ul>
          <?php else: ?>
            <div class="p-3 text-muted">Belum ada riwayat.</div>
          <?php endif; ?>
        </div>
      </div>

    </div>

    <!-- RIGHT: SIDEBAR (Jira Details Panel) -->
    <div class="col-lg-4 order-1 order-lg-2">

      <!-- Ringkasan -->
      <div class="card shadow mb-3">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Ringkasan</h6>
        </div>
        <div class="card-body">
          <div class="d-flex justify-content-between">
            <span class="text-muted">Tanggal Pinjam</span>
            <strong><?= htmlspecialchars($pinjam->tglPeminjaman ?? '-') ?></strong>
          </div>
          <hr class="my-2">
          <div class="d-flex justify-content-between">
            <span class="text-muted">Keperluan</span>
            <strong><?= status_keperluan($pinjam->keperluan); ?></strong>
          </div>
          <hr class="my-2">
          <div class="d-flex justify-content-between">
            <span class="text-muted">Preferensi Transimis</span>
            <strong><?= preferensi_mobil($pinjam->preferensiTransmisi); ?></strong>
          </div>
          <hr class="my-2">
          <div class="d-flex justify-content-between">
            <span class="text-muted">Tujuan</span>
            <strong class="text-right"><?= htmlspecialchars($pinjam->tujuan ?? '-') ?></strong>
          </div>
          <hr class="my-2">

          <?php if ($this->session->userdata('role')==2):{ ?>
            <div class="d-flex justify-content-between">
              <?php if (!empty($pinjam->token)): ?>
                <span class="text-muted">Token</span>
                <strong class="text-right"><?= htmlspecialchars($pinjam->token ?? '-') ?></strong>
              <?php else: ?>
                <div class="text-muted">Token belum tersedia.</div>
              <?php endif; ?>
            </div>
          <?php } endif?>

        </div>
      </div>

      <!-- Data Peminjam -->
      <div class="card shadow mb-3">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Data Peminjam</h6>
        </div>
        <div class="card-body">
          <div class="mb-2">
            <div class="text-muted small">Nama</div>
            <div class="font-weight-bold"><?= htmlspecialchars($pinjam->namaPegawai ?? '-') ?></div>
          </div>
          <div class="mb-2">
            <div class="text-muted small">Seksi</div>
            <div class="font-weight-bold"><?= htmlspecialchars($pinjam->namaSeksi ?? '-') ?></div>
          </div>
        </div>
      </div>

      <!-- Lampiran -->
      <div class="card shadow mb-3">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Lampiran</h6>
        </div>
        <div class="card-body">
          <?php if (!empty($pinjam->lampiran)): ?>
            <a class="btn btn-sm btn-outline-primary"
               href="<?= base_url('uploads/lampiran/'.rawurlencode($pinjam->lampiran)); ?>"
               target="_blank">
              <i class="fas fa-file-pdf mr-1"></i> Lihat Lampiran
            </a>
          <?php else: ?>
            <div class="text-muted">Tidak ada lampiran.</div>
          <?php endif; ?>
        </div>
      </div>

      

    </div>

  </div>

   <!-- Jira-like Action Bar (CTA rata kiri, Back secondary) -->
  <div class="mb-3">
    <div class="mb-2">
      <?php if ((int)$this->session->userdata('role') === 1): ?>
        <?php if($pinjam->statusPinjam === 7): ?>
          <a href="<?= site_url('peminjaman/penyelesaianPengajuan/'.$pinjam->idPeminjaman); ?>" class="btn btn-sm btn-success btn-block">
            Selesai
          </a>
        <?php endif?>
      <?php endif; ?>

      <!-- Tambahkan CTA status lain kamu di sini (tetap pakai IF kamu sendiri) -->
    </div>

    <div>
      <?php if ((int)$this->session->userdata('role') === 1): ?>
        <a href="<?= site_url('peminjaman/index'); ?>" class="btn btn-sm btn-warning btn-block">
           Kembali
        </a>
      <?php else: ?>
        <a href="<?= site_url('peminjaman/indexPeminjam'); ?>" class="btn btn-sm btn-warning btn-block">
         Kembali
        </a>
      <?php endif; ?>
    </div>
  </div>
</div>

<div class="container mt-4">
  <?php if ($this->session->flashdata('errorGantung')): ?>
        <div class="alert alert-danger text-center">
            <?= $this->session->flashdata('errorGantung'); ?>
        </div>
    <?php endif; ?>
    <h2 class="mb-3">Riwayat Peminjaman</h2>

    <a href="<?= site_url('peminjaman/formSavePengajuan'); ?>" class="btn btn-primary mb-3">
        + Ajukan Peminjaman
    </a>

    <!-- Tabel dengan id agar dikenali oleh DataTables -->
<table class="table table-hover">
  <thead>
    <tr>
      <th style="width:110px;">Kode / Tgl</th>
      <th>Ringkasan</th>
      <th style="width:120px;">Mobil</th>
      <th style="width:100px;">Status</th>
      <th style="width:160px;">Aksi</th>
    </tr>
  </thead>

  <tbody>
    <?php if (empty($dataPinjam)): ?>
                <tr><td colspan="5" class="text-center">Belum ada data.</td></tr>
            <?php else: ?>
                <?php $no=1; foreach($dataPinjam as $r): ?>
    <tr>
      <!-- Kode / Tanggal -->
      <td>
        <div class="font-weight-bold">
          <?= $r->idPeminjaman ?>
        </div>
        <small class="text-muted">
          <?= date('d M Y', strtotime($r->updatedAt)); ?>
        </small>
      </td>

      <!-- Ringkasan -->
      <td>
        <div class="font-weight-bold">
         <?= $r->tujuan ?>
        </div>
        <div class="text-muted text-truncate" style="max-width:520px;">
          <?= date('d M Y', strtotime($r->tglPeminjaman)); ?>
        </div>
      </td>

      <!-- Mobil -->
      <td>
         <?php if ($r->platNomor): ?>
          <div class="font-weight-bold"><?= $r->platNomor; ?></div>
        <?php else: ?>
          <span class="text-muted">Belum Diproses</span>
        <?php endif; ?>
      </td>

      <!-- Status -->
        <td><p class="text-m font-weight-bold mb-0"><?= status_badge($r->statusPinjam)?></p>
            <p class="text-xs text-secondary mb-0">Terakhir Update: <?= date('d M Y', strtotime($r->updatedAt)); ?></p>
        </td>

      <!-- Aksi -->
      <td>
        <?php if(($r->statusPinjam) == 0 ): ?>
						<a href="<?= site_url('peminjaman/formUpdatePengajuan/'.$r->idPeminjaman) ?>" class="btn btn-sm btn-warning btn-block">Edit</a>
						<a href="<?= site_url('peminjaman/deleteDraft/'.$r->idPeminjaman); ?>" class="btn btn-sm btn-danger btn-block"
               onclick="return confirm('Yakin hapus data ini?');">
               Hapus Draft
            </a>
						<?php elseif(($r->statusPinjam)==1 OR ($r->statusPinjam)==2 ): ?>
            <a href="<?= site_url('peminjaman/detailPeminjaman/'.$r->idPeminjaman) ?>" class="btn btn-sm btn-warning btn-block">Detail</a>
						<a href="<?= site_url('peminjaman/pembatalanPengajuan/'.$r->idPeminjaman); ?>" class="btn btn-sm btn-danger btn-block"
               onclick="return confirm('Yakin batalkan pengajuan ini?');">
               Batalkan Pengajuan
            </a>
            <?php elseif(($r->statusPinjam)==3 ): ?>
            <a href="<?= site_url('peminjaman/detailPeminjaman/'.$r->idPeminjaman) ?>" class="btn btn-sm btn-warning btn-block">Detail</a>
						<a href="<?= site_url('peminjaman/formPengembalianKunci/'.$r->idPeminjaman) ?>" class="btn btn-sm btn-primary btn-block" >Kembalikan Kunci</a>
						<?php else: ?>
						<a href="<?= site_url('peminjaman/detailPeminjaman/'.$r->idPeminjaman) ?>" class="btn btn-sm btn-warning btn-block">Detail</a>
						<?php endif ?>
      </td>
    </tr>
     <?php endforeach;
    endif; ?>
  </tbody>
</table>

<div class="d-flex justify-content-between align-items-center">
  <div class="text-muted small">
    Total: <?= (int)$total; ?> data
  </div>
  <div>
    <?= $pagination; ?>
  </div>
</div>

</div>

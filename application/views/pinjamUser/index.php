<div class="container mt-4">
  <?php if ($this->session->flashdata('errorGantung')): ?>
        <div class="alert alert-danger text-center">
            <?= $this->session->flashdata('errorGantung'); ?>
        </div>
    <?php endif; ?>
    <h2 class="mb-3">Riwayat Peminjaman</h2>

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
      <td>
        <?= status_badge($r->statusPinjam)?>
      </td>

      <!-- Aksi -->
      <td>
        <?php if(($r->statusPinjam) == 0 ): ?>
						<a href="<?= site_url('peminjaman/formUpdatePengajuan/'.$r->idPeminjaman) ?>" class="btn btn-sm btn-warning btn-block">Edit</a>
						<button type="button" class="btn btn-sm btn-danger btn-block" data-toggle="modal" data-target="#hapusDraftModal">
                Hapus
            </button>
						<?php elseif(($r->statusPinjam)==1 OR ($r->statusPinjam)==2 ): ?>
            <a href="<?= site_url('peminjaman/detailPeminjaman/'.$r->idPeminjaman) ?>" class="btn btn-sm btn-warning btn-block">Detail</a>
						<button type="button" class="btn btn-sm btn-danger btn-block" data-toggle="modal" data-target="#batalModal">
                Batalkan Pengajuan
            </button>
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

<!-- Hapus Draft-->
  <div class="modal fade" id="hapusDraftModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Yakin akan hapus data?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Data yang dihapus akan hilang selamanya</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
          <a class="btn btn-danger" href="<?= site_url('peminjaman/deleteDraft/'.$r->idPeminjaman) ?>">Hapus Data</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Batal Pengajuan -->
  <div class="modal fade" id="batalModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Yakin akan membatalkan pengajuan?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Pengajuan akan dibatalkan dan harus diajukan ulang</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Kembali</button>
          <a class="btn btn-danger" href="<?= site_url('peminjaman/pembatalanPengajuan/'.$r->idPeminjaman) ?>">Batalkan Pengajuan</a>
        </div>
      </div>
    </div>
  </div>

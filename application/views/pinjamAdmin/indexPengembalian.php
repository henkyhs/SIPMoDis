<div class="container mt-4">
    <h2 class="mb-3">Riwayat Peminjaman</h2>

      <form method='GET' action ='<?= site_url('peminjaman/indexPengembalianKunci'); ?>'>
          <table class="table table-hover">
  <thead>
     <tr>
                <th>
                    Cari:
                </th>
                 <th>
                      <input type="date" name="tglPeminjaman" class="form-control form-control-sm"
                      value="<?= htmlspecialchars($filters['tglPeminjaman'] ?? ''); ?>"
                      placeholder="">
                </th>
                 <th>
                      <input type="text" name="namaPegawai" class="form-control form-control-sm"
                      value="<?= htmlspecialchars($filters['namaPegawai'] ?? ''); ?>"
                      placeholder="Cari Nama Peminjam...">
                </th>
                 <th>
                      <input type="text" name="namaSeksi" class="form-control form-control-sm"
                      value="<?= htmlspecialchars($filters['namaSeksi'] ?? ''); ?>"
                      placeholder="Cari Seksi...">
                </th>
                <!-- <th>
                <select name="keperluan" class="form-control form-control-sm">
              <option value="">Semua</option>
              <option value="1" <?= (($filters['keperluan'] ?? '')==='1')?'selected':''; ?>>Visit</option>
              <option value="2" <?= (($filters['keperluan'] ?? '')==='2')?'selected':''; ?>>Lainnya</option>
            </select>
                </th> -->
            <th style="width:160px;">
            <button type="submit" class="btn btn-sm btn-primary btn-block">Filter</button>
            <a href="<?= site_url('peminjaman/indexPengembalianKunci'); ?>" class="btn btn-sm btn-secondary btn-block">Reset</a>
          </th>
        </tr>
    <tr>
    <tr>
      <th style="width:110px;">Kode / Tgl</th>
      <th>Ringkasan</th>
      <th style="width:120px;">Mobil</th>
      <th style="width:100px;">Status</th>
      <th style="width:160px;">Aksi</th>
    </tr>
  </thead>

  <tbody>
    <?php if (empty($dataPengembalian)): ?>
                <tr><td colspan="5" class="text-center">Belum ada data.</td></tr>
            <?php else: ?>
                <?php $no=1; foreach($dataPengembalian as $r): ?>
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
         <?= $r->namaPegawai ?>
          <small class="text-muted">•  <?= $r->namaSeksi ?></small>
        </div>
        <div class="text-muted text-truncate" style="max-width:520px;">
          <?= $r->tujuan ?>
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
         <a href="<?= site_url('peminjaman/formPenerimaanKunci/'.$r->idPeminjaman) ?>" class="btn btn-sm btn-warning">Pengecekkan</a>
         <!-- <a href="#" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</a> -->
      </td>
    </tr>
     <?php endforeach;
    endif; ?>
  </tbody>
</table>
      </form>
      
  <div class="d-flex justify-content-between align-items-center">
  <div class="text-muted small">
    Total: <?= (int)$total; ?> data
  </div>
  <div>
    <?= $pagination; ?>
  </div>
</div>


</div>

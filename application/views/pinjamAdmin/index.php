<div class="container mt-4">
    <h2 class="mb-3">Riwayat Peminjaman</h2>

    <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-danger text-center">
            <?= $this->session->flashdata('error'); ?>
        </div>
    <?php  elseif($this->session->flashdata('dangerTolak')):?>
        <div class="alert alert-success text-center">
            <?= $this->session->flashdata('dangerTolak'); ?>
        </div>
    <?php  elseif($this->session->flashdata('successSetuju')):?>
        <div class="alert alert-danger text-center">
            <?= $this->session->flashdata('successSetuju'); ?>
        </div>
    <?php  elseif($this->session->flashdata('successAmbil')):?>
        <div class="alert alert-danger text-center">
            <?= $this->session->flashdata('successAmbil'); ?>
        </div>
    <?php  elseif($this->session->flashdata('successTerima')):?>
        <div class="alert alert-danger text-center">
            <?= $this->session->flashdata('successTerima'); ?>
        </div>
    <?php  elseif($this->session->flashdata('successSelesaikan')):?>
        <div class="alert alert-danger text-center">
            <?= $this->session->flashdata('successSelesaikan'); ?>
        </div>
    <?php endif; ?>
      <button type="button" class="btn btn-sm btn-success mb-3" data-toggle="modal" data-target="#modalExport">
                Cetak Laporan
            </button>
    <!-- Tabel dengan id agar dikenali oleh DataTables -->
     <form method='GET' action ='<?= site_url('peminjaman'); ?>'>
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
                <th>
                <select name="statusPinjam" class="form-control form-control-sm">
              <option value="">Semua</option>
              <option value="1" <?= (($filters['statusPinjam'] ?? '')==='1')?'selected':''; ?>>Diajukan</option>
              <option value="2" <?= (($filters['statusPinjam'] ?? '')==='2')?'selected':''; ?>>Disetujui</option>
              <option value="3" <?= (($filters['statusPinjam'] ?? '')==='3')?'selected':''; ?>>Dalam Peminjaman</option>
              <option value="4" <?= (($filters['statusPinjam'] ?? '')==='4')?'selected':''; ?>>Proses Pengembalian</option>
              <option value="5" <?= (($filters['statusPinjam'] ?? '')==='5')?'selected':''; ?>>Ditolak</option>
              <option value="6" <?= (($filters['statusPinjam'] ?? '')==='6')?'selected':''; ?>>Batal</option>
              <option value="7" <?= (($filters['statusPinjam'] ?? '')==='7')?'selected':''; ?>>Dikembalikan dengan Catatan</option>
              <option value="8" <?= (($filters['statusPinjam'] ?? '')==='8')?'selected':''; ?>>Selesai</option>
            </select>
                </th>
                <!-- <th>
                <select name="keperluan" class="form-control form-control-sm">
              <option value="">Semua</option>
              <option value="1" <?= (($filters['keperluan'] ?? '')==='1')?'selected':''; ?>>Visit</option>
              <option value="2" <?= (($filters['keperluan'] ?? '')==='2')?'selected':''; ?>>Lainnya</option>
            </select>
                </th> -->
            <th style="width:160px;">
            <button type="submit" class="btn btn-sm btn-primary ">Filter</button>
            <a href="<?= site_url('peminjaman'); ?>" class="btn btn-sm btn-secondary ">Reset</a>

          </th>
            </tr>
    <tr>
      <th style="width:110px;">Kode / Tgl</th>
      <th>Ringkasan</th>
      <th style="width:120px;">Mobil</th>
      <th style="width:100px;">Status</th>
      <th style="width:160px;">Aksi</th>
    </tr>
  </thead>

  <tbody>
    <?php if (empty($dataPeminjamanAll)): ?>
                <tr><td colspan="5" class="text-center">Belum ada data.</td></tr>
            <?php else: ?>
                <?php $no=1; foreach($dataPeminjamanAll as $r): ?>
    <tr>
      <!-- Kode / Tanggal -->
      <td>
        <div class="font-weight-bold">
          <?= $r->idPeminjaman ?>
        </div>
        <small class="text-muted">
          <?= date('d M Y', strtotime($r->tglPeminjaman)); ?>
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
          <small class="text-muted"><?= $r->namaMobil; ?></small>
        <?php else: ?>
          <span class="text-muted">Belum Diproses</span>
        <?php endif; ?>
      </td>

      <!-- Status -->
        <td><p class="text-m font-weight-bold mb-0"><?= status_badge($r->statusPinjam)?></p>
            <p class="text-xs text-secondary mb-0">Terakhir Update: <?= date('d M Y', strtotime($r->updatedAt)); ?></p>
        </td>

      <!-- Aksi -->
      <td><?php
        if(($r->statusPinjam) == 7 ): ?>
						<a href="<?= site_url('peminjaman/penyelesaianPengajuan/'.$r->idPeminjaman) ?>" class="btn btn-sm btn-success btn-block">Selesaikan</a>
					<a href="<?= site_url('peminjaman/detailPeminjaman/'.$r->idPeminjaman) ?>" class="btn btn-sm btn-warning btn-block">Detail</a>
						<?php else: ?>
						<a href="<?= site_url('peminjaman/detailPeminjaman/'.$r->idPeminjaman) ?>" class="btn btn-sm btn-warning btn-block">Detail</a>
						<?php endif ?>
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
<!-- Pelaporan -->
 <div class="modal fade" id="modalExport" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Cetak Laporan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="<?= site_url('peminjaman/exportExcel'); ?>" method="post">
      <div class="modal-body">
        <div class="small text-muted mb-2">
            Pilih periode laporan yang ingin dicetak / diexport.
          </div>
        <div class="form-group">
            <!-- <label>Periode Cepat</label>
            <select name="mode" class="form-control">
              <option value="">-- Pilih --</option>
              <option value="7hari">7 Hari Terakhir</option>
              <option value="bulan">Bulan Ini</option>
              <option value="custom">Custom</option>
            </select> -->

          <div class="row range-option">

            <!-- 7 Hari -->
            <div class="col-md-4 mb-3">
              <input type="radio" name="range" id="r7" value="7hari" checked>
              <label for="r7" class="range-card w-100">
                <div class="card shadow-sm h-100">
                  <div class="card-body py-3 d-flex align-items-center">
                    <div class="mr-3 text-success" style="font-size:22px; line-height:1;">
                      <i class="fas fa-calendar-week"></i>
                    </div>
                    <div>
                      <div class="range-title">7 Hari</div>
                      <div class="range-sub">Otomatis 7 hari terakhir</div>
                    </div>
                  </div>
                </div>
              </label>
            </div>

            <!-- Bulan Ini -->
            <div class="col-md-4 mb-3">
              <input type="radio" name="range" id="rMonth" value="bulan">
              <label for="rMonth" class="range-card w-100">
                <div class="card shadow-sm h-100">
                  <div class="card-body py-3 d-flex align-items-center">
                    <div class="mr-3 text-primary" style="font-size:22px; line-height:1;">
                      <i class="fas fa-calendar-alt"></i>
                    </div>
                    <div>
                      <div class="range-title">Bulan Ini</div>
                      <div class="range-sub">Awal bulan sampai hari ini</div>
                    </div>
                  </div>
                </div>
              </label>
            </div>

            <!-- Pilih Rentang Tanggal -->
            <div class="col-md-4 mb-3">
              <input type="radio" name="range" id="rCustom" value="rentang">
              <label for="rCustom" class="range-card w-100">
                <div class="card shadow-sm h-100">
                  <div class="card-body py-3 d-flex align-items-center">
                    <div class="mr-3 text-warning" style="font-size:22px; line-height:1;">
                      <i class="fas fa-sliders-h"></i>
                    </div>
                    <div>
                      <div class="range-title">Pilih Rentang Tanggal</div>
                      <div class="range-sub">Tentukan tanggal mulai &amp; selesai</div>
                    </div>
                  </div>
                </div>
              </label>
            </div>

          </div>

          <!-- Custom date range -->
          <div id="customRangeWrap" class="card shadow-sm">
            <div class="card-body">
              <div class="form-row">
                <div class="form-group col-md-6 mb-2">
                  <label class="mb-1">Tanggal Mulai</label>
                  <input type="date" class="form-control" id="tglMulai" name="tglMulai">
                </div>
                <div class="form-group col-md-6 mb-2">
                  <label class="mb-1">Tanggal Selesai</label>
                  <input type="date" class="form-control" id="tglSelesai" name="tglSelesai">
                </div>
              </div>
              <small class="text-muted">
                Isi tanggal mulai &amp; selesai untuk export laporan sesuai periode yang kamu tentukan.
              </small>
            </div>
          </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-success">Export</button>
        </form>
      </div>
    </div>
  </div>
</div>


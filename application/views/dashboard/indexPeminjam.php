            <!-- Begin Page Content -->
<div class="container-fluid">
            <?php if (!empty($warningCatatan)) : ?>
        <div class="alert alert-warning">
            <strong>Perhatian!</strong><br>
            Anda masih memiliki catatan saat pengembalian, segera hubungi admin.
        </div>
    <?php endif; ?>
          <!-- Matrix Card -->
        <div class="row">
            <div class="col-lg-6 mb-4">
                 <!-- Basic Card Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Status Terakhir</h6>
                    </div>
                    <?php if ($statusTerakhir): ?>
                    <div class="card-body">
                        <p class="mb-1">
                            <span class="small text-muted">Kode Peminjaman</span><br>
                            <strong><?=$statusTerakhir->idPeminjaman; ?></strong>
                        </p>

                        <p class="mb-1">
                            <span class="small text-muted">Status</span><br>
                            <strong> <?= status_badge($statusTerakhir->statusPinjam)?></strong>
                        </p>

                        <p class="mb-1">
                            <span class="small text-muted">Tanggal Peminjaman</span><br>
                            <?= date('d M Y', strtotime($statusTerakhir->tglPeminjaman)); ?>
                        </p>

                    </div> 
                    <?php else : ?>
                    <div class="card-body">
                        <div class="h5 mb-0 font-weight-bold text-gray-800">Anda tidak memiliki peminjaman aktif</div>
                    </div>
                    <?php endif?>
            </div>
            

          </div>

        </div>
<!-- Begin Tabel 1
 -->
 <div class="row">


            <!-- Kunci Dikembalikan -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-secondary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Jumlah Mobil Manual Tersedia Saat Ini</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $hitungManual ?> Mobil</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-car fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <!-- Jumlah Mobil Tersedia -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Jumlah Mobil Matic Tersedia Saat Ini</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $hitungMatic ?> Mobil</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-car fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>


          </div>
          <div class="row">
                        <!-- Begin Tabel Kanan -->
                        <div class="col-lg-12 mb-4">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <div class="d-flex flex-column justify-content-center">
                                      <h6 class="m-0 font-weight-bold text-primary">Peminjaman Terakhir</h6>
                                      <a href="<?= base_url('peminjaman/');?> ">
                                         <p class="text-xs text-secondary mb-0">Selengkapnya...</p>
                                      </a>
                                    </div>
                                </div>
                                <div class="card-body">
                                     <table class="table table-hover">
        <thead>
            <tr>
                <th>No</th>
                <th>ID Peminjaman</th>
                <th>Tanggal Peminjaman</th>
                <th>Nama Peminjam</th>
                <th>Plat Mobil</th>
                <th>Status Pengajuan</th>
                <!-- <th>Aksi</th> -->
            </tr>
        </thead>
        <tbody>
            <?php if (empty($riwayatUser)): ?>
                <tr><td colspan="5" class="text-center">Belum ada data.</td></tr>
            <?php else: ?>
                <?php $no=1; foreach($riwayatUser as $p): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $p->idPeminjaman ?></td>
                    <td><?= date('d M Y', strtotime($p->tglPeminjaman)); ?></td>
                    <td><?= $p->namaPegawai ?></td>
                    <td><?= htmlspecialchars($platNomor ?? '-') ?></td>
                    <td> <?= status_badge($p->statusPinjam)?>
                    </td>
                    <td>
                        <a href="<?= site_url('peminjaman/detailPeminjaman/'.$p->idPeminjaman) ?>" class="btn btn-sm btn-warning">Detail</a>
                        <!-- <a href="<?= site_url('mobil/delete/'.$m->idMobil) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</a> -->
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
                                </div>
                            </div>

                        </div>
                        <!-- End Tabel Kanan -->
           </div>
<!-- End Tabel 1 -->
</div>
        <!-- /.container-fluid -->


            <!-- Begin Page Content -->
<div class="container-fluid">

          <!-- Matrix Card -->
          <div class="row">

            <!-- Pending -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah Pengajuan Belum Dicek</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $pending ?> Pengajuan</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Kunci Dikembalikan -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Jumlah Kunci yang Akan Dikembalikan</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $pengembalian ?> Pengajuan</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-key fa-2x text-gray-300"></i>
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
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Jumlah Mobil Tersedia Saat Ini</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $mobil ?> Mobil</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-car fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>


          </div>
<!-- Begin Tabel 1
 -->
          <div class="row">

                        <!-- Begin Tabel Kiri -->
                        <div class="col-lg-6 mb-4">
                           <div class="card shadow mb-4">
                                <div class="card-header py-3">    
                                  <div class="col-lg-6 col-7">

                                  <div class="d-flex px-2 py-1">
                                    <div>
                                    </div>
                                    <div class="d-flex flex-column justify-content-center">
                                      <h6 class="m-0 font-weight-bold text-primary">Pengajuan Terakhir</h6>
                                      <a href="<?= base_url('peminjaman/indexPersetujuan');?> ">
                                         <p class="text-xs text-secondary mb-0">Selengkapnya...</p>
                                      </a>
                                    </div>
                                  </div>
                                  </div>
                                </div>

                                <div class="card-body">
                                <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Pegawai</th>
                                                <th>Tanggal Pengajuan</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (empty($limaPengajuan)): ?>
                                                <tr><td colspan="5" class="text-center">Belum ada data.</td></tr>
                                            <?php else: ?>
                                                <?php $no=1; foreach($limaPengajuan as $p): ?>
                                                <tr>
                                                    <td><?= $no++ ?></td>
                                                    <td><?= $p->namaPegawai ?></td>
                                                    <td><?= $p->tglPeminjaman ?></td>
                                                    <td>
                                                      <a href="<?= site_url('peminjaman/detailPeminjaman/'.$p->idPeminjaman) ?>" class="btn btn-sm btn-warning">Detail</a>
                                                    </td>
                                                </tr>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                        <!-- End Tabel Kiri -->
                        <!-- Begin Tabel Kanan -->
                        <div class="col-lg-6 mb-4">
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
                                                <th>Nama Pegawai</th>
                                                <th>Tanggal Pengajuan</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (empty($limaRiwayat)): ?>
                                                <tr><td colspan="5" class="text-center">Belum ada data.</td></tr>
                                            <?php else: ?>
                                                <?php $no=1; foreach($limaRiwayat as $r): ?>
                                                <tr>
                                                    <td><?= $no++ ?></td>
                                                    <td><?= $r->namaPegawai ?></td>
                                                    <td><?= date('d M Y', strtotime($r->createdAt)); ?></td>
                                                    <td> <?= status_badge($r->statusPinjam)?></td>
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


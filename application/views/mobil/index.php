<div class="container mt-4">
    <h2 class="mb-3">Data Mobil Dinas</h2>

    <a href="<?= site_url('mobil/addForm'); ?>" class="btn btn-primary mb-3">
        + Tambah Data Mobil
    </a>
    <form method='GET' action ='<?= site_url('mobil'); ?>'> 
        <!-- Tabel dengan id agar dikenali oleh DataTables -->
      <table class="table table-hover">
        <thead>
            <tr>
                <th >
                    Cari:
                </th>
                 <th>
                      <input type="text" name="namaMobil" class="form-control form-control-sm"
                      value="<?= htmlspecialchars($filters['namaMobil'] ?? ''); ?>"
                      placeholder="Cari nama mobil...">
                </th>
                 <th>
                      <input type="text" name="platNomor" class="form-control form-control-sm"
                      value="<?= htmlspecialchars($filters['platNomor'] ?? ''); ?>"
                      placeholder="Cari plat...">
                </th>
                <th>
                <select name="kondisiMobil" class="form-control form-control-sm">
              <option value="">Semua</option>
              <option value="1" <?= (($filters['kondisiMobil'] ?? '')==='1')?'selected':''; ?>>Tersedia</option>
              <option value="2" <?= (($filters['kondisiMobil'] ?? '')==='2')?'selected':''; ?>>Dipinjam</option>
              <option value="2" <?= (($filters['kondisiMobil'] ?? '')==='3')?'selected':''; ?>>Rusak</option>
            </select>
                </th>
                <th>
                <select name="transmisi" class="form-control form-control-sm">
              <option value="">Semua</option>
              <option value="1" <?= (($filters['transmisi'] ?? '')==='1')?'selected':''; ?>>Matic</option>
              <option value="2" <?= (($filters['transmisi'] ?? '')==='2')?'selected':''; ?>>Manual</option>
            </select>
                </th>
            <th style="width:160px;">
            <button type="submit" class="btn btn-sm btn-primary btn-block">Filter</button>
            <a href="<?= site_url('mobil'); ?>" class="btn btn-sm btn-secondary btn-block">Reset</a>
          </th>
            </tr>
            <tr>
                <th>No</th>
                <th >Nama Mobil</th>
                <th>
                    Plat Nomor
                </th>
                <th>Kondisi Mobil</th>
                <th>Transmisi Mobil</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($mobils)): ?>
                <tr><td colspan="5" class="text-center">Belum ada data.</td></tr>
            <?php else: ?>
                <?php $no=1; foreach($mobils as $m): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $m->namaMobil ?></td>
                    <td><?= $m->platNomor ?></td>
                    <td>
                        <?= status_mobil($m->kondisiMobil); ?>
                    </td>
                    <td><?= jenis_mobil($m->transmisi)?></td>
                    <td>
                        <a href="<?= site_url('mobil/detailMobil/'.$m->idMobil) ?>" class="btn btn-sm btn-warning btn-block">Detail</a>
                        <a href="<?= site_url('mobil/delete/'.$m->idMobil) ?>" class="btn btn-sm btn-danger btn-block" onclick="return confirm('Yakin hapus?')">Hapus</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
    </form>
</div>

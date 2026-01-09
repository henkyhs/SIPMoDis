<div class="container mt-4">
    <h2 class="mb-3">Data User</h2>
    <?php if ($this->session->flashdata('successAdd')): ?>
        <div class="alert alert-success text-center">
            <?= $this->session->flashdata('successAdd'); ?>
        </div>
    <?php  elseif($this->session->flashdata('successUpdate')):?>
        <div class="alert alert-success text-center">
            <?= $this->session->flashdata('successUpdate'); ?>
        </div>
    <?php  elseif($this->session->flashdata('error')):?>
        <div class="alert alert-danger text-center">
            <?= $this->session->flashdata('error'); ?>
        </div>
    <?php endif; ?>

    <a href="<?= site_url('user/addForm'); ?>" class="btn btn-primary mb-3">
        + Tambah Data User
    </a>
    <form method='GET' action ='<?= site_url('user'); ?>'>
         <table class="table table-hover">
        <thead>
            <tr>
                <th>
                    Cari:
                </th>
                 <th>
                      <input type="text" name="nip" class="form-control form-control-sm"
                      value="<?= htmlspecialchars($filters['nip'] ?? ''); ?>"
                      placeholder="">
                </th>
                 <th>
                      <input type="text" name="namaPegawai" class="form-control form-control-sm"
                      value="<?= htmlspecialchars($filters['namaPegawai'] ?? ''); ?>"
                      placeholder="...">
                </th>
                 <th>
                      <input type="text" name="namaSeksi" class="form-control form-control-sm"
                      value="<?= htmlspecialchars($filters['namaSeksi'] ?? ''); ?>"
                      placeholder="...">
                </th>
                <th>
                <select name="role" class="form-control form-control-sm">
              <option value="">Semua</option>
              <option value="1" <?= (($filters['role'] ?? '')==='1')?'selected':''; ?>>Admin</option>
              <option value="2" <?= (($filters['role'] ?? '')==='2')?'selected':''; ?>>Peminjam</option>
            </select>
                </th>
            <th style="width:160px;">
                <button type="submit" class="btn btn-sm btn-primary btn-block">Filter</button>
            <a href="<?= site_url('user'); ?>" class="btn btn-sm btn-secondary btn-block">Reset</a>
          </th>
            </tr>
            <tr>
                <th>No</th>
				<th>NIP</th>
                <th>Nama Pegawai</th>
				<th>Seksi</th>
                <th>Role</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($dataUser)): ?>
                <tr><td colspan="5" class="text-center">Belum ada data.</td></tr>
            <?php else: ?>
                <?php $no=1; foreach($dataUser as $u): ?>
                <tr>
                    <td><?= $no++ ?></td>
					<td><?= $u->nip ?></td>
                    <td><p class="text-m font-weight-bold mb-0"><?= $u->namaPegawai ?></p>
                        <p class="text-xs text-secondary mb-0"><?= $u->noHp ?></p></td>
					<td><?= $u->namaSeksi ?></td>
                    <td><?= role_user($u->role)?></td>
                    <td>
                        <?php if ((int)$u->isActive === 1): ?>
                        <span class="badge badge-success">Aktif</span>
                        <?php else: ?>
                        <span class="badge badge-secondary">Nonaktif</span>
                        <?php endif; ?>
                    </td>
                    <td>
						<a href="<?= site_url('user/editForm/'.$u->idUser) ?>" class="btn btn-sm btn-warning btn-block">Detail</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
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

    <!-- Tabel dengan id agar dikenali oleh DataTables -->
</div>

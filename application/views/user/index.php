<div class="container mt-4">
    <h2 class="mb-3">Data User</h2>

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
                <th>Role User</th>
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
                    <td><p class="text-xs font-weight-bold mb-0"><?= $u->namaPegawai ?></p>
                        <p class="text-xs text-secondary mb-0"><?= $u->username ?></p></td>
					<td><?= $u->namaSeksi ?></td>
                    <td><?= role_user($u->role)?></td>
                    <td>
						<a href="<?= site_url('user/detail/'.$u->idUser) ?>" class="btn btn-sm btn-warning btn-block">Detail</a>
                        <a href="<?= site_url('user/delete/'.$u->idUser) ?>" class="btn btn-sm btn-danger btn-block" onclick="return confirm('Yakin hapus?')">Hapus</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
    </form>
    <!-- Tabel dengan id agar dikenali oleh DataTables -->
</div>

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-kantor sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href=<?= base_url('dashboard')?>>
        <div class="sidebar-brand-text mx-3">SIPMoDis</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard All User-->
      <li class="nav-item <?= ($activeMenu == 'dashboard') ? 'active' : ''; ?>">
        <a class="nav-link" href="<?= base_url('Dashboard/');?>">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Untuk Admin -->
			 <?php if ($this->session->userdata('role') == 1): ?>
      <div class="sidebar-heading">
        Data Master
      </div>
			
      <li class="nav-item <?= ($activeMenu == 'user') ? 'active' : ''; ?>">
        <a class="nav-link" href="<?= base_url('User/');?>">
          <i class="fas fa-fw fa-user"></i>
          <span>User</span></a>
      </li>

      
      <li class="nav-item <?= ($activeMenu == 'mobil') ? 'active' : ''; ?>">
        <a class="nav-link" href="<?= base_url('Mobil/');?> ">
          <i class="fas fa-fw fa-car"></i>
          <span>Mobil</span></a>
      </li>
			
			<li class="nav-item <?= ($activeMenu == 'seksi') ? 'active' : ''; ?>">
        <a class="nav-link" href="<?= base_url('Seksi/');?> ">
          <i class="fas fa-fw fa-building"></i>
          <span>Seksi</span></a>
      </li>
      
      <li class="nav-item <?= ($activeMenu == 'perlengkapan') ? 'active' : ''; ?>">
        <a class="nav-link" href="<?= base_url('Perlengkapan/');?> ">
          <i class="fas fa-fw fa-plug"></i>
          <span>Perlengkapan</span></a>
      </li>
       <!-- Divider -->
      <hr class="sidebar-divider">

      <div class="sidebar-heading">
        Peminjaman
      </div>

			<li class="nav-item <?= ($activeMenu == 'peminjaman') ? 'active' : ''; ?>">
        <a class="nav-link" href="<?= base_url('peminjaman/');?> ">
          <i class="fas fa-fw fa-table"></i>
          <span>Riwayat Peminjaman</span></a>
      </li>
      <li class="nav-item <?= ($activeMenu == 'pengajuan') ? 'active' : ''; ?>">
        <a class="nav-link" href="<?= base_url('peminjaman/indexButuhPersetujuan');?> ">
          <i class="fas fa-fw fa-table"></i>
          <span>Pengajuan Peminjaman</span></a>
      </li>

       <li class="nav-item <?= ($activeMenu == 'pengambilan') ? 'active' : ''; ?>">
        <a class="nav-link" href="<?= base_url('peminjaman/indexPengambilanKunci');?> ">
          <i class="fas fa-fw fa-table"></i>
          <span>Pengambilan Kunci</span></a>
      </li>

      <li class="nav-item <?= ($activeMenu == 'pengembalian') ? 'active' : ''; ?>">
        <a class="nav-link" href="<?= base_url('peminjaman/indexPengembalianKunci');?> ">
          <i class="fas fa-fw fa-table"></i>
          <span>Pengembalian Kunci</span></a>
      </li>

      
			<?php endif; ?>
      <!-- Untuk Peminjam -->
      <!-- <hr class="sidebar-divider"> -->
			<?php if ($this->session->userdata('role')==2):?>     
			<div class="sidebar-heading">
        Pengajuan Peminjaman
      </div>
			<!-- Nav Item - Charts -->
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('peminjaman/indexPeminjam');?> ">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Riwayat Peminjaman</span></a>
      </li>

      <!-- Nav Item - Tables -->
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('peminjaman/formSavePengajuan');?> ">
          <i class="fas fa-fw fa-pen"></i>
          <span>Ajukan Peminjaman</span></a>
      </li>
				<?php endif;  ?>
			<hr class="sidebar-divider">     
			
      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

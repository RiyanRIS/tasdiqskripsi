<?php
$cfg = new \SConfig();
?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="javascript:void(0)" class="brand-link">
    <img src="<?= (@$cfg->_logoSekolah ?? "") ?>" alt="Logo Sekolah" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light"><?= (@$cfg->_namaApp ?? "") ?></span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="<?= site_url('assets/') ?>dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="javascript:void(0)" class="d-block"><?= session()->get('user_nama') ?></a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2" id="nav">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <a href="<?= site_url('dashboard') ?>" data-nav="dashboard" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?= site_url('pendaftar') ?>" data-nav="pendaftar" class="nav-link">
            <i class="nav-icon fas fa-users"></i>
            <p>
              Data Diri
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?= site_url('berkas') ?>" data-nav="berkas" class="nav-link">
            <i class="nav-icon fas fa-calendar-alt"></i>
            <p>
              Data Berkas
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?= site_url('logout') ?>" class="nav-link" onclick="return confirm('Apakah kamu yakin ingin keluar?')">
            <i class="nav-icon fas fa-sign-out-alt"></i>
            <p>
              Logout
            </p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
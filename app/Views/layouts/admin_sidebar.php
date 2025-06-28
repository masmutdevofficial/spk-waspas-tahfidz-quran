  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="index3.html" class="brand-link d-flex justify-content-center align-items-center">
            <span class="brand-text font-weight-light font-weight-bold">
                <?= session()->get('role') == 1 ? 'ADMIN' : 'GURU' ?>
            </span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">

          <!-- Sidebar Menu -->
          <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="<?= base_url('dashboard') ?>" class="nav-link <?= isActive('dashboard') ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <!-- Untuk semua role (1=Admin, 2=Guru Penguji) -->
                <li class="nav-item">
                    <a href="<?= base_url('data-kriteria') ?>" class="nav-link <?= isActive('data-kriteria') ?>">
                        <i class="nav-icon fas fa-list-alt"></i>
                        <p>Data Kriteria</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('data-siswa') ?>" class="nav-link <?= isActive('data-siswa') ?>">
                        <i class="nav-icon fas fa-user-graduate"></i>
                        <p>Data Siswa</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('hasil-penilaian-siswa') ?>" class="nav-link <?= isActive('hasil-penilaian-siswa') ?>">
                        <i class="nav-icon fas fa-chart-line"></i>
                        <p>Hasil Penilaian</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('data-periode') ?>" class="nav-link <?= isActive('data-periode') ?>">
                        <i class="nav-icon fas fa-calendar"></i>
                        <p>Data Periode</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('grafik-kriteria') ?>" class="nav-link <?= isActive('grafik-kriteria') ?>">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>Grafik Kriteria</p>
                    </a>
                </li>

                <!-- Hanya untuk Admin -->
                <?php if (session()->get('role') == 1): ?>
                    <li class="nav-item">
                        <a href="<?= base_url('data-user') ?>" class="nav-link <?= isActive('data-user') ?>">
                            <i class="nav-icon fas fa-users-cog"></i>
                            <p>Data User</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('penilaian') ?>" class="nav-link <?= isActive('penilaian') ?>">
                            <i class="nav-icon fas fa-clipboard-check"></i>
                            <p>Penilaian</p>
                        </a>
                    </li>
                <?php endif; ?>

            </ul>

          </nav>
          <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
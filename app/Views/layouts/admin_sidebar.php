  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="index3.html" class="brand-link d-flex justify-content-center align-items-center">
          <span class="brand-text font-weight-light font-weight-bold">ADMIN</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">

          <!-- Sidebar Menu -->
          <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                  data-accordion="false">
                  <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <!-- Menu Utama -->
                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="<?= base_url('') ?>" class="nav-link <?= isActive('') ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

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
                <li class="nav-item">
                    <a href="<?= base_url('hasil-penilaian') ?>" class="nav-link <?= isActive('hasil-penilaian') ?>">
                        <i class="nav-icon fas fa-chart-line"></i>
                        <p>Hasil Penilaian</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('grafik-kriteria') ?>" class="nav-link <?= isActive('grafik-kriteria') ?>">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>Grafik Kriteria</p>
                    </a>
                </li>

              </ul>
          </nav>
          <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
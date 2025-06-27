<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Beranda - Munaqashah</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('assets/plugins/fontawesome-free/css/all.min.css') ?>">
    <!-- AdminLTE -->
    <link rel="stylesheet" href="<?= base_url('assets/css/adminlte.min.css') ?>">

    <style>
        html, body {
            height: 100%!important;
            margin: 0;
        }

        body {
            display: flex;
            flex-direction: column;
        }

        .header {
            background-color: #007bff;
            padding: 15px 30px;
            text-align: right;
        }

        .main-wrapper {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .main-content {
            text-align: center;
        }

        h4 {
            font-size: 20px;
            margin-bottom: 30px;
            line-height: 1.6;
        }

        .btn-group a {
            min-width: 100px;
        }
    </style>
</head>
<body>
    <?= $this->include('layouts/alerts') ?>
    <!-- HEADER -->
    <div class="header">
        <div class="dropdown">
            <?php if (session()->get('logged_in')): ?>
                <a href="<?= base_url('dashboard') ?>" class="btn btn-light">
                    <i class="fas fa-user"></i>
                    <?= session()->get('role') == 1 ? 'Admin' : 'Guru' ?>
                </a>
            <?php else: ?>
                <a href="<?= base_url('login') ?>" class="btn btn-light">
                    <i class="fas fa-user"></i> Login
                </a>
            <?php endif; ?>
        </div>
    </div>

    <!-- MAIN -->
    <div class="main-wrapper">
        <div class="main-content">
            <h4>
                Penilaian Munaqashah Tahfidz Qur’an<br>
                Sekolah Islam Terpadu Qurrota A’yun<br>
                Abepura
            </h4>
            <div class="btn-group">
                <a href="<?= base_url('login') ?>" class="btn btn-primary mr-2">
                    <i class="fas fa-sign-in-alt mr-1"></i> Login
                </a>
                <a href="<?= base_url('hasil-penilaian') ?>" class="btn btn-secondary">
                    <i class="fas fa-eye mr-1"></i> Lihat Hasil
                </a>
            </div>
        </div>
    </div>

    <!-- JS -->
    <script src="<?= base_url('assets/plugins/jquery/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/adminlte.min.js') ?>"></script>
</body>
</html>

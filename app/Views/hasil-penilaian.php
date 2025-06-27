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
    <div class="cetakData" style="margin-top:80px;margin-left:20px;margin-right:20px;">
        <div class="text-center mb-4">
            <h4>
                Daftar Nilai Hasil Munaqashah Tahfidz Al-Qur’an di SIT Qurrota A’yun<br>
                Abepura
            </h4>
        </div>

        <table class="table table-bordered text-center">
            <thead class="thead-light">
                <tr>
                    <th>No.</th>
                    <th>Nama</th>
                    <th>Kelancaran Membaca</th>
                    <th>Waktu</th>
                    <th>Tajwid</th>
                    <th>Makhrojul Huruf</th>
                    <th>Nilai Akhir</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; foreach ($siswaData as $siswa): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= esc($siswa['nama']) ?></td>
                        <td><?= $siswa['nilai'][1]['nilai'] ?? '-' ?></td>
                        <td><?= $siswa['nilai'][2]['nilai'] ?? '-' ?></td>
                        <td><?= $siswa['nilai'][3]['nilai'] ?? '-' ?></td>
                        <td><?= $siswa['nilai'][4]['nilai'] ?? '-' ?></td>
                        <td><?= number_format($siswa['qi'], 2) ?></td>
                        <td><?= $siswa['status'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="d-flex flex-col justify-content-center align-items-center">
        <button class="btn btn-primary mb-3" onclick="cetakPDF()">
            <i class="fa fa-print mr-1"></i> Cetak PDF
        </button>
    </div>

    <!-- JS -->
    <script src="<?= base_url('assets/plugins/jquery/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/adminlte.min.js') ?>"></script>
        <script>
    function cetakPDF() {
        const printContents = document.querySelector('.cetakData').innerHTML;
        const originalContents = document.body.innerHTML;

        document.body.innerHTML = `
            <html>
                <head>
                    <title>Cetak Data</title>
                    <style>
                        body { font-family: Arial, sans-serif; padding: 20px; }
                        table { border-collapse: collapse; width: 100%; }
                        table, th, td { border: 1px solid black; }
                        th, td { padding: 8px; text-align: center; }
                        h4 { text-align: center; margin-bottom: 20px; }
                    </style>
                </head>
                <body>${printContents}</body>
            </html>
        `;

        window.print();
        document.body.innerHTML = originalContents;
        location.reload();
    }
    </script>
</body>
</html>

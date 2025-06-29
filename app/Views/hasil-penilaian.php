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

    <div class="d-flex flex-row justify-content-center align-items-center">
        <button class="btn btn-primary mb-3 mr-3" onclick="cetakPDF()">
            <i class="fa fa-print mr-1"></i> Cetak PDF
        </button>
        <!-- Tombol -->
        <button class="btn btn-primary mb-3 mr-3" data-toggle="modal" data-target="#modalPerhitungan">
            <i class="fa fa-eye mr-1"></i> Perhitungan
        </button>

    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalPerhitungan" tabindex="-1" role="dialog" aria-labelledby="modalPerhitunganLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
            <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="modalPerhitunganLabel"><i class="fa fa-calculator mr-2"></i>Perhitungan Waspas</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Card Kosong -->
                <div class="card shadow-sm">
                <div class="card-body">
                    <table class="table table-bordered text-center">
                        <thead class="thead-light">
                            <tr>
                                <th colspan="4" class="text-center">Tabel 3.1 Pembobotan Kriteria</th>
                            </tr>
                            <tr>
                                <th>Kriteria</th>
                                <th>Jenis</th>
                                <th>Bobot (%)</th>
                                <th>Bobot Desimal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Kelancaran Membaca</td>
                                <td><em>Benefit</em></td>
                                <td>40%</td>
                                <td>0.40</td>
                            </tr>
                            <tr>
                                <td>Waktu</td>
                                <td><em>Benefit</em></td>
                                <td>30%</td>
                                <td>0.30</td>
                            </tr>
                            <tr>
                                <td><em>Tajwid</em></td>
                                <td><em>Cost</em></td>
                                <td>15%</td>
                                <td>0.15</td>
                            </tr>
                            <tr>
                                <td><em>Makhrojul Huruf</em></td>
                                <td><em>Cost</em></td>
                                <td>15%</td>
                                <td>0.15</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="row mt-4">
                        <div class="col-12 mb-4">
                            <h5 class="text-center font-weight-bold">Tabel 3.2 Asumsi Kriteria Kelancaran Membaca</h5>
                            <table class="table table-bordered table-striped text-center">
                            <thead class="thead-dark">
                                <tr>
                                <th>Kelancaran Membaca</th>
                                <th>Kesalahan Maksimal</th>
                                <th>Bobot Alternatif</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr><td>Sangat Lancar</td><td>≤ 2 Kesalahan</td><td>1.00</td></tr>
                                <tr><td>Lancar</td><td>3 - 5 Kesalahan</td><td>0.80</td></tr>
                                <tr><td>Cukup Lancar</td><td>6 - 10 Kesalahan</td><td>0.60</td></tr>
                                <tr><td>Kurang Lancar</td><td>11 - 15 Kesalahan</td><td>0.40</td></tr>
                                <tr><td>Sangat Tidak Lancar</td><td>> 15 Kesalahan</td><td>0.20</td></tr>
                            </tbody>
                            </table>
                        </div>

                        <div class="col-12 mb-4">
                            <h5 class="text-center font-weight-bold">Tabel 3.3 Asumsi Kriteria Waktu</h5>
                            <table class="table table-bordered table-striped text-center">
                            <thead class="thead-dark">
                                <tr>
                                <th>Waktu</th>
                                <th>Kesalahan Maksimal</th>
                                <th>Bobot Alternatif</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr><td>Sangat Cepat</td><td>≤ 35 Menit</td><td>1.00</td></tr>
                                <tr><td>Cepat</td><td>36 - 40 Menit</td><td>0.80</td></tr>
                                <tr><td>Sedang</td><td>41 - 45 Menit</td><td>0.60</td></tr>
                                <tr><td>Lambat</td><td>46 - 50 Menit</td><td>0.40</td></tr>
                                <tr><td>Sangat Lambat</td><td>> 50 Menit</td><td>0.20</td></tr>
                            </tbody>
                            </table>
                        </div>

                        <div class="col-12 mb-4">
                            <h5 class="text-center font-weight-bold">Tabel 3.4 Asumsi Kriteria Tajwid</h5>
                            <table class="table table-bordered table-striped text-center">
                            <thead class="thead-dark">
                                <tr>
                                <th>Tajwid</th>
                                <th>Kesalahan Maksimal</th>
                                <th>Bobot Alternatif</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr><td>Sangat Baik</td><td>≤ 2 Kesalahan</td><td>1.00</td></tr>
                                <tr><td>Baik</td><td>3 - 5 Kesalahan</td><td>0.80</td></tr>
                                <tr><td>Cukup Baik</td><td>6 - 10 Kesalahan</td><td>0.60</td></tr>
                                <tr><td>Kurang Baik</td><td>11 - 15 Kesalahan</td><td>0.40</td></tr>
                                <tr><td>Sangat Tidak Baik</td><td>> 15 Kesalahan</td><td>0.20</td></tr>
                            </tbody>
                            </table>
                        </div>

                        <div class="col-12 mb-4">
                            <h5 class="text-center font-weight-bold">Tabel 3.5 Asumsi Kriteria Makhrojul Huruf</h5>
                            <table class="table table-bordered table-striped text-center">
                            <thead class="thead-dark">
                                <tr>
                                <th>Makhrojul Huruf</th>
                                <th>Kesalahan Maksimal</th>
                                <th>Bobot Alternatif</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr><td>Sangat Lancar</td><td>≤ 2 Kesalahan</td><td>1.00</td></tr>
                                <tr><td>Lancar</td><td>3 - 5 Kesalahan</td><td>0.80</td></tr>
                                <tr><td>Cukup Lancar</td><td>6 - 10 Kesalahan</td><td>0.60</td></tr>
                                <tr><td>Kurang Lancar</td><td>11 - 15 Kesalahan</td><td>0.40</td></tr>
                                <tr><td>Sangat Tidak Lancar</td><td>> 15 Kesalahan</td><td>0.20</td></tr>
                            </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Proses Perhitungan Metode WASPAS</h5>
                    </div>
                    <div class="card-body">
                        <p>Berikut adalah rumus yang digunakan dalam metode WASPAS beserta tahapan perhitungannya.</p>

                        <h6>a. Normalisasi Matriks Keputusan</h6>
                        <p>Untuk kriteria <strong>Benefit</strong>, nilai dinormalisasi menggunakan rumus:</p>
                        <pre><code>𝑥̅<sub>ij</sub> = X<sub>ij</sub> / Max<sub>i</sub>(X<sub>ij</sub>)  ............. (3.1)</code></pre>

                        <p>Untuk kriteria <strong>Cost</strong>, nilai dinormalisasi menggunakan rumus:</p>
                        <pre><code>𝑥̅<sub>ij</sub> = Min<sub>i</sub>(X<sub>ij</sub>) / X<sub>ij</sub>  ............. (3.2)</code></pre>

                        <p><strong>Keterangan:</strong><br>
                        X<sub>ij</sub> = Nilai alternatif ke-<i>i</i> pada kriteria ke-<i>j</i><br>
                        𝑥̅<sub>ij</sub> = Nilai normalisasi alternatif ke-<i>i</i> pada kriteria ke-<i>j</i><br>
                        Max<sub>i</sub>(X<sub>ij</sub>) = Nilai maksimum pada kriteria ke-<i>j</i> (untuk benefit)<br>
                        Min<sub>i</sub>(X<sub>ij</sub>) = Nilai minimum pada kriteria ke-<i>j</i> (untuk cost)</p>

                        <h6>b. Perhitungan Metode WSM (Weighted Sum Model)</h6>
                        <p>Setelah normalisasi, skor WSM dihitung dengan:</p>
                        <pre><code>WSM<sub>i</sub> = Σ (𝑥̅<sub>ij</sub> × 𝑤<sub>j</sub>)  untuk j = 1 sampai n  ............. (3.3)</code></pre>
                        <p><strong>Keterangan:</strong><br>
                        𝑤<sub>j</sub> = Bobot dari kriteria ke-<i>j</i><br>
                        n = Jumlah total kriteria</p>

                        <h6>c. Perhitungan Metode WPM (Weighted Product Model)</h6>
                        <p>Skor WPM dihitung dengan:</p>
                        <pre><code>WPM<sub>i</sub> = Π (𝑥̅<sub>ij</sub>)<sup>𝑤<sub>j</sub></sup>  untuk j = 1 sampai n ............. (3.4)</code></pre>

                        <h6>d. Perhitungan Nilai Akhir WASPAS</h6>
                        <p>Nilai akhir 𝑄<sub>i</sub> diperoleh dengan mengombinasikan hasil dari metode WSM dan WPM:</p>
                        <pre><code>Q<sub>i</sub> = (λ × WSM<sub>i</sub>) + ((1 − λ) × WPM<sub>i</sub>)  ............. (3.5)</code></pre>

                        <p><strong>Keterangan:</strong><br>
                        λ = Koefisien parameter kombinasi antara WSM dan WPM (biasanya 0.5)<br>
                        (1 − λ) = Pelengkap koefisien kombinasi</p>
                    </div>
                    </div>

                </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
            </div>
        </div>
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

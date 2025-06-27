<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="cetakData">
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
<?= $this->endSection() ?>

<?= $this->section('bodyJs') ?>
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
<?= $this->endSection() ?>
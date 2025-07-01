<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="cetakData">

    <!-- Halaman 1 -->
    <div class="page-section">
        <div class="text-center mb-4">
            <h4>Halaman 1: Daftar Nilai Semua Siswa (Urut Nilai Tertinggi)<br>SIT Qurrota A’yun - Abepura</h4>
        </div>

        <?= view('admin/partials/tabel_siswa', ['data' => $dataSemua]) ?>
    </div>

    <!-- Halaman 2 -->
    <div class="page-section">
        <div class="text-center mb-4">
            <h4>Halaman 2: Daftar Siswa Lulus<br>SIT Qurrota A’yun - Abepura</h4>
        </div>

        <?= view('admin/partials/tabel_siswa', ['data' => $dataLulus]) ?>
    </div>

    <!-- Halaman 3 -->
    <div class="page-section">
        <div class="text-center mb-4">
            <h4>Halaman 3: Daftar Siswa Tidak Lulus<br>SIT Qurrota A’yun - Abepura</h4>
        </div>

        <?= view('admin/partials/tabel_siswa', ['data' => $dataTidakLulus]) ?>
    </div>

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

                    .page-section:not(:last-of-type) {
                        page-break-after: always;
                    }
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

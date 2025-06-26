<?= $this->extend('layouts/main') ?>

<?= $this->section('customCss') ?>
  <!-- DataTables -->
  <link rel="stylesheet" href="<?= base_url('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') ?>">
  <!-- Tabler Icons -->
  <link rel="stylesheet" href="<?= base_url('assets/plugins/tabler-icons/tabler.min.css') ?>">
<?= $this->endSection() ?>

<?= $this->section('content-header') ?>
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Data Kriteria</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                <li class="breadcrumb-item active">Data Kriteria</li>
            </ol>
        </div>
    </div>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <div class="card card-outline card-primary">
        <div class="card-header">
            <div class="d-flex flex-row justify-content-between align-items-center">
                <h3 class="card-title">Basic Tables</h3>
                <div class="d-flex flex-row justify-content-center align-items-center">
                    <a href="#" class="btn btn-secondary mr-2">
                        <i class="fa fa-print mr-2"></i>Cetak Laporan
                    </a>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#modalGrafik">
                        <i class="fa fa-chart-line mr-2"></i>Grafik Hasil
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table id="basicTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Siswa</th>
                        <th>WSM</th>
                        <th>WPM</th>
                        <th>Qi</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach ($waspas as $w): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= esc($w['nama_siswa']) ?></td>
                        <td><?= esc($w['nilai_wsm']) ?></td>
                        <td><?= esc($w['nilai_wpm']) ?></td>
                        <td><?= esc($w['nilai_qi']) ?></td>
                        <td>
                            <span class="badge badge-<?= $w['status_kelulusan'] === 'Lulus' ? 'success' : 'danger' ?>">
                                <?= esc($w['status_kelulusan']) ?>
                            </span>
                        </td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- Modal Grafik -->
    <div class="modal fade" id="modalGrafik" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Diagram Batang: 4 Kriteria (Benefit dan Cost)</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span>&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <canvas id="chartWaspas" width="100%" height="50"></canvas>
        </div>
        </div>
    </div>
    </div>

<?= $this->endSection() ?>

<?= $this->section('customJs') ?>
  <!-- DataTables & Plugins -->
  <script src="<?= base_url('assets/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
  <script src="<?= base_url('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
  <script src="<?= base_url('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') ?>"></script>
  <script src="<?= base_url('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') ?>"></script>
  <script src="<?= base_url('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') ?>"></script>
  <script src="<?= base_url('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') ?>"></script>
  <script src="<?= base_url('assets/plugins/jszip/jszip.min.js') ?>"></script>
  <script src="<?= base_url('assets/plugins/pdfmake/pdfmake.min.js') ?>"></script>
  <script src="<?= base_url('assets/plugins/pdfmake/vfs_fonts.js') ?>"></script>
  <script src="<?= base_url('assets/plugins/datatables-buttons/js/buttons.html5.min.js') ?>"></script>
  <script src="<?= base_url('assets/plugins/datatables-buttons/js/buttons.print.min.js') ?>"></script>
  <script src="<?= base_url('assets/plugins/datatables-buttons/js/buttons.colVis.min.js') ?>"></script>
  <script src="<?= base_url('assets/plugins/chart.js/Chart.min.js') ?>"></script>
<?= $this->endSection() ?>

<?= $this->section('bodyJs') ?>
  <script>
    $(function () {
      $("#basicTable").DataTable({
          "responsive": true,
          "lengthChange": true,
          "autoWidth": false,
          "lengthMenu": [ [5, 10, 25, 50, 100], [5, 10, 25, 50, 100] ]
      });
    });
  </script>
  <script>
    document.addEventListener("DOMContentLoaded", function () {
        var ctx = document.getElementById('chartWaspas').getContext('2d');

        // Data siswa & nilai normalisasi tiap kriteria
        const labels = ["Shamil", "Miftah", "Maulidya", "Indra Jaya", "Fauzan Alwan"];
        
        const data = {
            labels: labels,
            datasets: [
                {
                    label: 'Kelancaran Membaca (Benefit)',
                    data: [0.8, 0.9, 0.6, 1.0, 0.7],
                    backgroundColor: '#60a5fa'
                },
                {
                    label: 'Waktu (Benefit)',
                    data: [1.0, 0.95, 0.75, 0.85, 0.90],
                    backgroundColor: '#34d399'
                },
                {
                    label: 'Tajwid (Cost)',
                    data: [0.6, 0.5, 0.4, 0.7, 0.8],
                    backgroundColor: '#f97316'
                },
                {
                    label: 'Makhrojul Huruf (Cost)',
                    data: [0.7, 0.6, 0.8, 0.5, 0.6],
                    backgroundColor: '#f43f5e'
                }
            ]
        };

        new Chart(ctx, {
            type: 'bar',
            data: data,
            options: {
                indexAxis: 'y',
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    },
                    title: {
                        display: true,
                        text: 'Diagram Batang: 4 Kriteria (Benefit dan Cost)'
                    }
                },
                scales: {
                    x: {
                        min: 0,
                        max: 1,
                        title: {
                            display: true,
                            text: 'Nilai'
                        }
                    }
                }
            }
        });
    });
    </script>
<?= $this->endSection() ?>
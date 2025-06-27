<?= $this->extend('layouts/main') ?>

<?= $this->section('customCss') ?>
  <!-- Tabler Icons -->
  <link rel="stylesheet" href="<?= base_url('assets/plugins/tabler-icons/tabler.min.css') ?>">
<?= $this->endSection() ?>

<?= $this->section('content-header') ?>
  <div class="card col-12">
      <div class="card-header bg-primary text-white">
          <h3 class="card-title">Distribusi Kriteria Penilaian</h3>
      </div>
      <div class="card-body">
          <canvas id="pieChartKriteria"></canvas>
      </div>
  </div>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row" id="grafik-container">

</div>

<?= $this->endSection() ?>

<?= $this->section('customJs') ?>
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
  fetch('<?= base_url('grafik-kriteria-pie') ?>')
      .then(res => res.json())
      .then(res => {
          const ctx = document.getElementById('pieChartKriteria');
          new Chart(ctx, {
              type: 'pie',
              data: {
                  labels: res.labels,
                  datasets: [{
                      data: res.data,
                      backgroundColor: ['#3b82f6', '#10b981', '#f59e0b', '#ef4444']
                  }]
              },
              options: {
                  responsive: true,
                  plugins: {
                      legend: { position: 'bottom' },
                      title: {
                          display: true,
                          text: 'Distribusi Penilaian per Kriteria'
                      }
                  }
              }
          });
      });
  </script>
<?= $this->endSection() ?>
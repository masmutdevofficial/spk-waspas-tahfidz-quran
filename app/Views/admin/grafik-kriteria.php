<?= $this->extend('layouts/main') ?>

<?= $this->section('customCss') ?>
  <!-- Tabler Icons -->
  <link rel="stylesheet" href="<?= base_url('assets/plugins/tabler-icons/tabler.min.css') ?>">
<?= $this->endSection() ?>

<?= $this->section('content-header') ?>
  <div class="card col-12">
      <div class="card-header text-black">
          <h3 class="card-title">Distribusi Kriteria Penilaian</h3>
      </div>
  </div>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row" id="chartContainer">
    <!-- Nanti diisi dinamis oleh JS -->
</div>
<?= $this->endSection() ?>

<?= $this->section('customJs') ?>
  <script src="<?= base_url('assets/plugins/chart.js/Chart.min.js') ?>"></script>
  <script src="<?= base_url('assets/plugins/chart.js/chartjs-plugin-datalabels.min.js') ?>"></script>
<?= $this->endSection() ?>

<?= $this->section('bodyJs') ?>
<script>
document.addEventListener("DOMContentLoaded", () => {

    fetch("<?= base_url('grafik-kriteria-pie') ?>")
        .then(r => r.json())
        .then(data => {
            const container = document.getElementById('chartContainer');
            container.innerHTML = '';

            data.forEach((item, i) => {
                const chartId = `pieChart${i}`;

                /* ---------- 1. Buat kolom & canvas ---------- */
                const col = document.createElement('div');
                col.className = 'col-md-6 mb-4';
                col.innerHTML = `
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title text-center mb-3">
                                ${item.title} <small class="text-muted">(Bobot ${item.bobot})</small>
                            </h5>
                            <canvas id="${chartId}" height="180"></canvas>
                            <hr>
                            <ul class="mb-0 small" id="summary-${chartId}"></ul>
                        </div>
                    </div>
                `;
                container.appendChild(col);

                /* ---------- 2. Render Chart ---------- */
                const ctx = document.getElementById(chartId).getContext('2d');
                new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: item.labels,
                        datasets: [{
                            data: item.data,
                            backgroundColor: [
                                '#60a5fa', '#34d399', '#fbbf24', '#f87171',
                                '#a78bfa', '#f472b6', '#c084fc', '#fdba74'
                            ],
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            datalabels: {
                                color: '#fff',
                                font: { weight: 'bold', size: 12 },
                                formatter: (v, ctx) => v + '%'
                            },
                            legend: { position: 'bottom' }
                        }
                    }
                });

                /* ---------- 3. Buat ringkasan persentase ---------- */
                const summary = document.getElementById(`summary-${chartId}`);
                item.labels.forEach((label, idx) => {
                    const li = document.createElement('li');
                    li.textContent = `${item.data[idx]}% siswa mendapat nilai konversi ${label}`;
                    summary.appendChild(li);
                });
            });
        });

});
</script>
<?= $this->endSection() ?>
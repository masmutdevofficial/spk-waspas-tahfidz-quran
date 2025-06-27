<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<!-- Stat boxes -->
<div class="row">
    <div class="col-lg-4 col-12">
        <div class="small-box bg-info">
            <div class="inner">
                <h3><?= $terdaftar ?? 0 ?></h3>
                <p>Peserta Terdaftar</p>
            </div>
            <div class="icon">
                <i class="fas fa-users"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-12">
        <div class="small-box bg-success">
            <div class="inner">
                <h3><?= $lulus ?? 0 ?></h3>
                <p>Peserta Lulus</p>
            </div>
            <div class="icon">
                <i class="fas fa-user-check"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-12">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3><?= $tidakLulus ?? 0 ?></h3>
                <p>Peserta Tidak Lulus</p>
            </div>
            <div class="icon">
                <i class="fas fa-user-times"></i>
            </div>
        </div>
    </div>

    <div class="card card-outline card-primary col-12 d-flex flex-col justify-content-center align-items-center p-4">
        <p class="mb-0 pb-0 text-bold text-lg">SISTEM PENDUKUNG KEPUTUSAN BERBASIS METODE WASPAS</p>
        <p class="mb-0 pb-0 text-bold text-lg">UNTUK SELEKSI KELULUSAN MUNAQASAH DI PROGRAM TAHFIDZ</p>
        <p class="mb-0 pb-0 text-bold text-lg">QUR'AN SIT QURROTA A’YUN ABEPURA</p>
    </div>
</div>
<!-- /.row -->

<?= $this->endSection() ?>

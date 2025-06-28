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
            <h1>Data Periode</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                <li class="breadcrumb-item active">Data Periode</li>
            </ol>
        </div>
    </div>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <div class="card card-outline card-primary">
        <div class="card-header">
            <div class="d-flex flex-row justify-content-between align-items-center">
                <h3 class="card-title">Data Periode</h3>
                <?php if (session()->get('role') == 1): ?>
                    <div class="d-flex flex-row justify-content-center align-items-center">
                        <button class="btn btn-primary mr-2" data-toggle="modal" data-target="#modalTambah">
                            <i class="fa fa-plus mr-2"></i>Tambah Data
                        </button>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="card-body">
            <!-- Tabel Data -->
            <table id="basicTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tahun</th>
                        <th>Semester</th>
                        <?php if (session()->get('role') == 1): ?>
                        <th>Aksi</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach ($periode as $p): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= esc($p['tahun']) ?></td>
                        <td><?= esc(ucfirst($p['semester'])) ?></td>
                        <?php if (session()->get('role') == 1): ?>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <button class="btn btn-sm btn-warning mr-2" data-toggle="modal" data-target="#modalEdit<?= $p['id'] ?>">
                                    <i class="fa fa-edit mr-1"></i>Edit
                                </button>
                                <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modalHapus<?= $p['id'] ?>">
                                    <i class="fa fa-trash mr-1"></i>Hapus
                                </button>
                            </div>
                        </td>
                        <?php endif; ?>
                    </tr>

                    <?php if (session()->get('role') == 1): ?>
                    <!-- Modal Edit -->
                    <div class="modal fade" id="modalEdit<?= $p['id'] ?>" tabindex="-1">
                        <div class="modal-dialog">
                            <form action="<?= base_url('periode/update/' . $p['id']) ?>" method="POST">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Periode</h5>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label>Tahun</label>
                                            <input type="number" name="tahun" value="<?= esc($p['tahun']) ?>" class="form-control" required>
                                        </div>
                                        <div class="mb-3">
                                            <label>Semester</label>
                                            <select name="semester" class="form-control">
                                                <option value="Ganjil" <?= $p['semester'] == 'Ganjil' ? 'selected' : '' ?>>Ganjil</option>
                                                <option value="Genap" <?= $p['semester'] == 'Genap' ? 'selected' : '' ?>>Genap</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-warning">Update</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Modal Hapus -->
                    <div class="modal fade" id="modalHapus<?= $p['id'] ?>" tabindex="-1">
                        <div class="modal-dialog">
                            <form action="<?= base_url('periode/delete/' . $p['id']) ?>" method="POST">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Konfirmasi Hapus</h5>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        Yakin ingin menghapus periode <strong><?= esc($p['tahun']) ?> - <?= esc($p['semester']) ?></strong>?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <?php endif; ?>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php if (session()->get('role') == 1): ?>
    <!-- Modal Tambah -->
    <div class="modal fade" id="modalTambah" tabindex="-1">
        <div class="modal-dialog">
            <form action="<?= base_url('periode/tambah') ?>" method="POST">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Periode</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Tahun</label>
                            <input type="number" name="tahun" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Semester</label>
                            <select name="semester" class="form-control" required>
                                <option value="Ganjil" selected>Ganjil</option>
                                <option value="Genap">Genap</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php endif; ?>
    
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
<?= $this->endSection() ?>
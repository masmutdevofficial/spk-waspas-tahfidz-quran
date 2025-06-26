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
                    <button class="btn btn-primary mr-2" data-toggle="modal" data-target="#modalTambahBasic">
                        <i class="fa fa-plus mr-2"></i>Tambah Data
                    </button>
                    <div class="btn-group">
                        <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-print mr-2"></i>Export Data
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="export_excel.php"><i class="fa fa-file-excel mr-2 text-success"></i>Export Excel</a>
                            <a class="dropdown-item" href="export_pdf.php"><i class="fa fa-file-pdf mr-2 text-danger"></i>Export PDF</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table id="basicTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>HP</th>
                        <th>Level</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>nama</td>
                        <td>email</td>
                        <td>hp</td>
                        <td>level</td>
                        <td>status</td>
                        <td>
                            <div class="d-flex justify-content-center align-items-center gap-2">
                                <!-- Tombol Modal -->
                                <button class="btn btn-sm btn-warning mr-2" data-toggle="modal"
                                    data-target="#modalEdit">
                                    <i class="fa fa-edit mr-1"></i>Edit
                                </button>
                                <button class="btn btn-sm btn-danger" data-toggle="modal"
                                    data-target="#modalHapus">
                                    <i class="fa fa-trash mr-1"></i>Hapus
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Modal Edit -->
                    <div class="modal fade" id="modalEdit" tabindex="-1">
                        <div class="modal-dialog">
                            <form action="edit-user.php" method="POST">
                                <input type="hidden" name="id" value="">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit User</h5>
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label>Nama</label>
                                            <input type="text" name="nama"
                                                value=""
                                                class="form-control" required>
                                        </div>
                                        <div class="mb-3">
                                            <label>Email</label>
                                            <input type="email" name="email"
                                                value=""
                                                class="form-control" required>
                                        </div>
                                        <div class="mb-3">
                                            <label>No HP</label>
                                            <input type="text" name="hp"
                                                value=""
                                                class="form-control" required>
                                        </div>
                                        <div class="mb-3">
                                            <label>Alamat</label>
                                            <textarea name="alamat"
                                                class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-warning">Update</button>
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Batal</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Modal Hapus -->
                    <div class="modal fade" id="modalHapus" tabindex="-1">
                        <div class="modal-dialog">
                            <form action="hapus-user.php" method="POST">
                                <input type="hidden" name="id" value="">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Konfirmasi Hapus</h5>
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Yakin ingin menghapus data user
                                        <strong>nama</strong>?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Batal</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </tbody>
            </table>
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
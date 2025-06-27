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
            <h1>Data User</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                <li class="breadcrumb-item active">Data User</li>
            </ol>
        </div>
    </div>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <div class="card card-outline card-primary">
        <div class="card-header">
            <div class="d-flex flex-row justify-content-between align-items-center">
                <h3 class="card-title">Data User</h3>
                <div class="d-flex flex-row justify-content-center align-items-center">
                    <button class="btn btn-primary mr-2" data-toggle="modal" data-target="#modalTambah">
                        <i class="fa fa-plus mr-2"></i>Tambah Data
                    </button>
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
                    <th>Level</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; foreach ($users as $user): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= esc($user['nama']) ?></td>
                    <td><?= esc($user['email']) ?></td>
                    <td><?= $user['role'] == 1 ? 'Admin' : 'Guru Penguji' ?></td>
                    <td><?= date('d-m-Y H:i', strtotime($user['created_at'])) ?></td>
                    <td><?= date('d-m-Y H:i', strtotime($user['updated_at'])) ?></td>
                    <td>
                        <div class="d-flex justify-content-center gap-2">
                            <!-- Tombol Modal Edit -->
                            <button class="btn btn-sm btn-warning mr-2" data-toggle="modal"
                                data-target="#modalEdit<?= $user['id'] ?>">
                                <i class="fa fa-edit mr-1"></i>Edit
                            </button>

                            <!-- Tombol Modal Hapus -->
                            <button class="btn btn-sm btn-danger" data-toggle="modal"
                                data-target="#modalHapus<?= $user['id'] ?>">
                                <i class="fa fa-trash mr-1"></i>Hapus
                            </button>
                        </div>
                    </td>
                </tr>

                <!-- Modal Edit -->
                <div class="modal fade" id="modalEdit<?= $user['id'] ?>" tabindex="-1">
                    <div class="modal-dialog">
                        <form action="<?= base_url('user/update/' . $user['id']) ?>" method="POST">
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
                                        <input type="text" name="nama" value="<?= esc($user['nama']) ?>" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Email</label>
                                        <input type="email" name="email" value="<?= esc($user['email']) ?>" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Role</label>
                                        <select name="role" class="form-control" required>
                                            <option value="1" <?= $user['role'] == 1 ? 'selected' : '' ?>>Admin</option>
                                            <option value="2" <?= $user['role'] == 2 ? 'selected' : '' ?>>Guru Penguji</option>
                                        </select>
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
                <div class="modal fade" id="modalHapus<?= $user['id'] ?>" tabindex="-1">
                    <div class="modal-dialog">
                        <form action="<?= base_url('user/delete/' . $user['id']) ?>" method="POST">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Konfirmasi Hapus</h5>
                                    <button type="button" class="close" data-dismiss="modal"
                                        aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Yakin ingin menghapus user <strong><?= esc($user['nama']) ?></strong>?
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

                <?php endforeach ?>
            </tbody>
          </table>
        </div>
    </div>

    <!-- Modal Tambah -->
    <div class="modal fade" id="modalTambah" tabindex="-1">
        <div class="modal-dialog">
            <form action="<?= base_url('user/tambah') ?>" method="POST">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Nama</label>
                            <input type="text" name="nama" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Role</label>
                            <select name="role" class="form-control" required>
                                <option value="1">Admin</option>
                                <option value="2">Guru Penguji</option>
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
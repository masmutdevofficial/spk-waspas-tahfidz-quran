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
            <h1>Data Siswa</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                <li class="breadcrumb-item active">Data Siswa</li>
            </ol>
        </div>
    </div>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <div class="card card-outline card-primary">
        <div class="card-header">
            <div class="d-flex flex-row justify-content-between align-items-center">
                <h3 class="card-title">Data Siswa</h3>
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
        <?= $this->include('layouts/periode') ?>

        <table id="basicTable" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Siswa</th>
                    <th>Periode</th>
                    <th>Guru Penguji</th> <!-- baru -->
                    <th>Jenis Kelamin</th>
                    <th>Tanggal Lahir</th>
                    <th>Kelas</th>
                    <th>Juz</th>
                    <?php if (session()->get('role') == 1): ?>
                    <th>Aksi</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; foreach ($siswa as $s): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= esc($s['nama_siswa']) ?></td>
                    <td><?= esc($s['tahun'] . ' - ' . $s['semester']) ?></td>
                    <td><?= esc($s['nama_guru'] ?? '-') ?></td>
                    <td><?= $s['jenis_kelamin'] == 'L' ? 'Laki-laki' : 'Perempuan' ?></td>
                    <td><?= date('d/m/Y', strtotime($s['tgl_lahir'])) ?></td>
                    <td><?= esc($s['kelas']) ?></td>
                    <td><?= esc($s['juz']) ?></td>
                    <?php if (session()->get('role') == 1): ?>
                    <td>
                        <div class="d-flex justify-content-center gap-2">
                            <!-- Tombol Modal Edit -->
                            <button class="btn btn-sm btn-warning mr-2" data-toggle="modal"
                                data-target="#modalEdit<?= $s['id'] ?>">
                                <i class="fa fa-edit mr-1"></i>Edit
                            </button>

                            <!-- Tombol Modal Hapus -->
                            <button class="btn btn-sm btn-danger" data-toggle="modal"
                                data-target="#modalHapus<?= $s['id'] ?>">
                                <i class="fa fa-trash mr-1"></i>Hapus
                            </button>
                        </div>
                    </td>
                    <?php endif; ?>
                </tr>

                <?php if (session()->get('role') == 1): ?>
                <!-- Modal Edit -->
                <div class="modal fade" id="modalEdit<?= $s['id'] ?>" tabindex="-1">
                    <div class="modal-dialog">
                        <form action="<?= base_url('siswa/update/' . $s['id']) ?>" method="POST">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Siswa</h5>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>Periode</label>
                                        <select name="id_periode" class="form-control" required>
                                            <?php foreach ($periode as $p): ?>
                                            <option value="<?= $p['id'] ?>" <?= $p['id'] == $s['id_periode'] ? 'selected' : '' ?>>
                                                <?= $p['tahun'] . ' - ' . $p['semester'] ?>
                                            </option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Nama Siswa</label>
                                        <input type="text" name="nama_siswa" class="form-control" value="<?= esc($s['nama_siswa']) ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Jenis Kelamin</label>
                                        <select name="jenis_kelamin" class="form-control">
                                            <option value="L" <?= $s['jenis_kelamin'] == 'L' ? 'selected' : '' ?>>Laki-laki</option>
                                            <option value="P" <?= $s['jenis_kelamin'] == 'P' ? 'selected' : '' ?>>Perempuan</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Tanggal Lahir</label>
                                        <input type="date" name="tgl_lahir" class="form-control" value="<?= $s['tgl_lahir'] ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Kelas</label>
                                        <input type="text" name="kelas" class="form-control" value="<?= esc($s['kelas']) ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Juz</label>
                                        <input type="text" name="juz" class="form-control" value="<?= esc($s['juz']) ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Guru Penguji</label>
                                        <select name="id_user" class="form-control" required>
                                            <option value="">-- Pilih Guru --</option>
                                            <?php foreach ($guru as $g): ?>
                                                <option value="<?= $g['id'] ?>" <?= $g['id'] == $s['id_user'] ? 'selected' : '' ?>>
                                                    <?= esc($g['nama']) ?>
                                                </option>
                                            <?php endforeach; ?>
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
                <div class="modal fade" id="modalHapus<?= $s['id'] ?>" tabindex="-1">
                    <div class="modal-dialog">
                        <form action="<?= base_url('siswa/delete/' . $s['id']) ?>" method="POST">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Hapus Siswa</h5>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                    Yakin ingin menghapus <strong><?= esc($s['nama_siswa']) ?></strong>?
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
            <form action="<?= base_url('siswa/tambah') ?>" method="POST">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Siswa</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Periode</label>
                            <select name="id_periode" class="form-control" required>
                                <option value="" >Pilih Periode</option>
                                <?php foreach ($periode as $p): ?>
                                <option value="<?= $p['id'] ?>">
                                    <?= $p['tahun'] . ' - ' . $p['semester'] ?>
                                </option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Guru Penguji</label>
                            <select name="id_user" class="form-control" required>
                                <option value="">-- Pilih Guru Penguji --</option>
                                <?php foreach ($guru as $g): ?>
                                <option value="<?= $g['id'] ?>">
                                    <?= esc($g['nama']) ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Nama Siswa</label>
                            <input type="text" name="nama_siswa" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="form-control">
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tanggal Lahir</label>
                            <input type="date" name="tgl_lahir" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Kelas</label>
                            <input type="text" name="kelas" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Juz</label>
                            <input type="text" name="juz" class="form-control" required>
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
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
            <h1>Penilaian</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                <li class="breadcrumb-item active">Penilaian</li>
            </ol>
        </div>
    </div>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <div class="card card-outline card-primary">
        <div class="card-header">
            <div class="d-flex flex-row justify-content-between align-items-center">
                <h3 class="card-title">Penilaian</h3>
                <div class="d-flex flex-row justify-content-center align-items-center">
                    <button class="btn btn-primary mr-2" data-toggle="modal" data-target="#modalTambah">
                        <i class="fa fa-plus mr-2"></i>Tambah Data
                    </button>
                    <a href="<?= base_url('mulai-algoritma') ?>" class="btn btn-primary mr-2">
                        <i class="fa fa-history mr-2"></i>Mulai Algoritma
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
          <?= $this->include('layouts/periode') ?>
          <table id="basicTable" class="table table-bordered table-striped">
              <thead>
                  <tr>
                      <th>No</th>
                      <th>Nama Siswa</th>
                      <?php foreach ($kriteria as $k): ?>
                          <th><?= esc($k['nama_kriteria']) ?></th>
                      <?php endforeach ?>
                      <th>Aksi</th>
                  </tr>
              </thead>
              <tbody>
                  <?php $no = 1; foreach ($nilai_siswa as $id_siswa => $data): ?>
                  <tr>
                      <td><?= $no++ ?></td>
                      <td><?= esc($data['nama_siswa']) ?></td>
                      <?php foreach ($kriteria as $k): ?>
                          <td><?= esc(intval($data['nilai'][$k['id']]['nilai']) ?? '-') ?></td>
                      <?php endforeach ?>
                      <td>
                        <div class="d-flex justify-content-center gap-2">
                            <!-- Tombol Modal Edit -->
                            <button class="btn btn-sm btn-warning mr-2" data-toggle="modal"
                                data-target="#modalEdit<?= $id_siswa ?>">
                                <i class="fa fa-edit mr-1"></i>Edit
                            </button>

                            <!-- Tombol Modal Hapus -->
                            <button class="btn btn-sm btn-danger" data-toggle="modal"
                                data-target="#modalHapus<?= $id_siswa ?>">
                                <i class="fa fa-trash mr-1"></i>Hapus
                            </button>
                        </div>
                    </td>
                  </tr>

                  <!-- Modal Edit Nilai Siswa -->
                  <div class="modal fade" id="modalEdit<?= $id_siswa ?>" tabindex="-1">
                      <div class="modal-dialog">
                          <form action="<?= base_url('penilaian/update/' . $id_siswa) ?>" method="POST">
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <h5 class="modal-title">Edit Nilai - <?= esc($data['nama_siswa']) ?></h5>
                                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  </div>
                                  <div class="modal-body">
                                      <?php foreach ($kriteria as $k): ?>
                                          <div class="form-group">
                                              <label><?= esc($k['nama_kriteria']) ?></label>
                                              <input type="hidden" name="id_kriteria[]" value="<?= $k['id'] ?>">
                                              <input type="number" name="nilai[<?= $k['id'] ?>]" step="0.01"
                                                  class="form-control"
                                                  value="<?= esc(intval($data['nilai'][$k['id']]['nilai']) ?? '') ?>" required>
                                          </div>
                                      <?php endforeach ?>
                                  </div>
                                  <div class="modal-footer">
                                      <button type="submit" class="btn btn-warning">Update</button>
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                  </div>
                              </div>
                          </form>
                      </div>
                  </div>

                  <!-- Modal Hapus Nilai Siswa-->
                  <div class="modal fade" id="modalHapus<?= $id_siswa ?>" tabindex="-1">
                      <div class="modal-dialog">
                          <form action="<?= base_url('penilaian/delete/' . $id_siswa) ?>" method="POST">
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <h5 class="modal-title">Konfirmasi Hapus</h5>
                                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  </div>
                                  <div class="modal-body">
                                      Yakin ingin menghapus semua nilai untuk <strong><?= esc($data['nama_siswa']) ?></strong>?
                                  </div>
                                  <div class="modal-footer">
                                      <button type="submit" class="btn btn-danger">Hapus Semua</button>
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                  </div>
                              </div>
                          </form>
                      </div>
                  </div>

                  <?php endforeach ?>
              </tbody>
          </table>

          <!-- Modal Tambah -->
          <div class="modal fade" id="modalTambah" tabindex="-1">
              <div class="modal-dialog">
                  <form action="<?= base_url('penilaian/tambah') ?>" method="POST">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h5 class="modal-title">Input Nilai Siswa</h5>
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>
                          <div class="modal-body">

                              <!-- Dropdown siswa yang belum punya nilai -->
                              <div class="form-group">
                                    <label>Nama Siswa</label>
                                    <select name="id_siswa" class="form-control" required>
                                        <?php foreach ($siswa as $s): ?>
                                            <option value="<?= $s['id'] ?>"><?= $s['nama_siswa'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                              <!-- Input nilai per kriteria -->
                              <?php foreach ($kriteria as $k): ?>
                                  <div class="form-group">
                                      <label><?= esc($k['nama_kriteria']) ?></label>
                                      <input type="number" step="0.01" name="nilai[<?= $k['id'] ?>]" class="form-control" required>
                                  </div>
                              <?php endforeach ?>

                          </div>
                          <div class="modal-footer">
                              <button type="submit" class="btn btn-primary">Simpan Semua</button>
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                          </div>
                      </div>
                  </form>
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
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Login | Munaqashah</title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('assets/plugins/fontawesome-free/css/all.min.css') ?>">
  <!-- Bootstrap -->
  <link rel="stylesheet" href="<?= base_url('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') ?>">
  <!-- AdminLTE -->
  <link rel="stylesheet" href="<?= base_url('assets/css/adminlte.min.css') ?>">
</head>
<body class="hold-transition login-page">
<?= $this->include('layouts/alerts') ?>
<div class="login-box">
  <!-- Logo -->
  <div class="login-logo">
    <b>Login</b>
  </div>

  <!-- Card -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Silakan login terlebih dahulu</p>

      <form action="<?= base_url('login/proses') ?>" method="post">
        <!-- Email -->
        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control" placeholder="Email" required>
          <div class="input-group-append">
            <div class="input-group-text"><span class="fas fa-envelope"></span></div>
          </div>
        </div>

        <!-- Password -->
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password" required>
          <div class="input-group-append">
            <div class="input-group-text"><span class="fas fa-lock"></span></div>
          </div>
        </div>

        <!-- Role -->
        <div class="input-group mb-3">
          <select name="role" class="form-control" required>
            <option value="">-- Pilih Peran --</option>
            <option value="1">Admin</option>
            <option value="2">Guru Penguji</option>
          </select>
          <div class="input-group-append">
            <div class="input-group-text"><span class="fas fa-user-tag"></span></div>
          </div>
        </div>

        <!-- Tombol -->
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Login</button>
          </div>
        </div>
      </form>

    </div>


    <!-- /.login-card-body -->
  </div>
</div>

<div class="login-box mt-3">
  <div class="card">
    <div class="card-body login-card-body">
        <p class="text-center text-bold">🔐 Informasi Akun Login</p>
        <ul class="small">
        <li><strong>Admin</strong><br>
            Email: <code>admin@gmail.com</code><br>
            Password: <code>admin</code>
        </li>
        <li class="mt-2"><strong>Guru Penguji 1</strong><br>
            Email: <code>gurupenguji1@gmail.com</code><br>
            Password: <code>gurupenguji1</code>
        </li>
        <li class="mt-2"><strong>Guru Penguji 2</strong><br>
            Email: <code>gurupenguji2@gmail.com</code><br>
            Password: <code>gurupenguji2</code>
        </li>
        </ul>
    </div>
  </div>
</div>
<!-- JS -->
<script src="<?= base_url('assets/plugins/jquery/jquery.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<script src="<?= base_url('assets/js/adminlte.min.js') ?>"></script>
</body>
</html>

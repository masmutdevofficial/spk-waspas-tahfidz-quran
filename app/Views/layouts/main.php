<?= $this->include('layouts/admin_header') ?>
<?= $this->include('layouts/admin_navbar') ?>
<?= $this->include('layouts/admin_sidebar') ?>
<?= $this->include('layouts/alerts') ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <?= $this->renderSection('content-header') ?>
    </div>
</section>

<!-- Content Wrapper. Contains page content -->
  <section class="content pt-3">
    <div class="container-fluid">
      <?= $this->renderSection('content') ?>
    </div>
  </section>

<?= $this->include('layouts/admin_footer') ?>

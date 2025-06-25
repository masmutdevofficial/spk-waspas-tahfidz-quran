<?= $this->include('layouts/admin_header') ?>
<?= $this->include('layouts/admin_navbar') ?>
<?= $this->include('layouts/admin_sidebar') ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <section class="content pt-3">
    <div class="container-fluid">
      <?= $this->renderSection('content') ?>
    </div>
  </section>
</div>

<?= $this->include('layouts/admin_footer') ?>

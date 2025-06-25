<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<?= service('uri')->getSegment(1) ?>
  <h1>Dashboard AdminLTE 3</h1>
<?= $this->endSection() ?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $title ?? 'ADMIN LTE' ?></title>

    <!-- REQUIRED CSS -->
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?= base_url('assets/plugins/fontawesome-free/css/all.min.css') ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('assets/css/adminlte.min.css') ?>">

    <!-- CUSTOM CSS -->
    <!-- Custom style -->
    <link rel="stylesheet" href="<?= base_url('assets/css/styles.css') ?>">
    <?= $this->renderSection('customCss') ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
<?php
$cfg = new \SConfig();
?>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= (@$judul ?: "Dashboard") ?> | <?= (@$cfg->_namaApp ?? "") ?></title>

<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Font Awesome -->
<link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/fontawesome-free/css/all.min.css">
<link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">

<!-- Ionicons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" />
<!-- Theme style -->
<!-- <link rel="stylesheet" href="<?= base_url('assets/') ?>dist/css/adminlte.min.css"> -->
<link rel="stylesheet" href="<?= base_url('assets/') ?>dist/css/adminlte.css" />
<!-- overlayScrollbars -->
<link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/overlayScrollbars/css/OverlayScrollbars.min.css" />
<!-- Notifications css -->
<link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/toastr/toastr.min.css" type="text/css" />
<!-- Daterange picker -->
<link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/daterangepicker/daterangepicker.css" />
<!-- summernote -->
<link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/summernote/summernote-bs4.min.css" />
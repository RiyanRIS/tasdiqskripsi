<?php
$cfg = new \SConfig();
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <title>Pendaftaran MAN 1 Gayo Lues | <?= (@$cfg->_namaApp ?? "") ?></title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <!-- Notifications css -->
    <link href="<?= base_url('assets/') ?>plugins/toastr/toastr.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/') ?>plugins/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <link href="//getbootstrap.com/docs/4.6/examples/checkout/form-validation.css" rel="stylesheet">
    <style>
        ul.navbar-nav .item-nav {
            color: white !important;
            font-size: 20px;
            padding-right: 25px !important;
        }
    </style>
</head>

<body class="bg-light">
    <?= view('templates/nav_depan.php') ?>
    <div class="container mt-5">
        <h3>Alur Pendaftaran</h3>
        <br>
        <ol>
            <li>Daftar melalui tautan <a href="<?= site_url('daftar') ?>">berikut</a>.</li>
            <li><a href="<?= site_url('login') ?>">Masuk/login</a> menggunakan username password yang telah dibuat.</li>
            <li>Lengkapi formulir data diri dan nilai.</li>
            <li>Upload Berkas seperti Scan Kartu Keluarga, Akta kelahiran, Foto 3x4 dll.</li>
            <li>Setelah itu datang langsung ke MAN 1 Gayo Lues untuk melakukan tes praktik.</li>
            <li>Jika semua sudah dilakukan tunggu tanggal pengumuman</li>
            <li>Pengumuman akan disebarkan melalui akun masing-masing atau dapat langsung ke MAN 1 Gayo Lues</li>
        </ol>
        <br>
        <a href="<?= site_url('daftar') ?>" class="btn btn-primary" style="background-color:green">Daftar Sekarang</a>

    </div>
    <!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->
    <!-- jQuery -->
    <script src="<?= base_url('assets/') ?>plugins/jquery/jquery.min.js"></script>
    <!-- Notifications Plugin -->
    <script src="<?= base_url('assets/') ?>plugins/toastr/toastr.min.js"></script>

    <script>
        <?php if (session()->has('msg')) {
            if (session()->get('msg')[0] == 1) { ?>
                toastr.success("<?= session()->get('msg')[1] ?>", 'Berhasil');
            <?php } elseif (session()->get('msg')[0] == 0) { ?>
                toastr.error("<?= session()->get('msg')[1] ?>", 'Gagal');
        <?php }
        } ?>
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

    <script src="<?= base_url('assets/') ?>plugins/sweetalert2/sweetalert2.all.js"></script>

</body>

</html>
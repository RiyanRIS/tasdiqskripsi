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
    <h3>PPDB ONLINE</h3>
    <br>
    <h3>SELAMAT DATANG CALON SISWA BARU</h3>
    <h3 style="padding-top:-10px;">MAN 1 GAYO LUES</h3>
    <br><br>
    <p style="font-size:20px">Untuk calon siswa baru tahun ajaran 2023/2025 <br>bisa mendaftar melalui website ini atau langsung <br>datang ke tempat pendaftaran.</p>
    <br>
    <a href="<?= site_url('daftar') ?>" class="btn btn-primary" style="background-color:green">Daftar Sekarang</a>

  </div>
  <!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->
  <!-- jQuery -->
  <script src="<?= base_url('assets/') ?>plugins/jquery/jquery.min.js"></script>
  <!-- Notifications Plugin -->
  <script src="<?= base_url('assets/') ?>plugins/toastr/toastr.min.js"></script>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

  <script src="<?= base_url('assets/') ?>plugins/sweetalert2/sweetalert2.all.js"></script>
  <script>
    <?php if (session()->has('msg')) {
      if (session()->get('msg')[0] == 1) { ?>
        toastr.success("<?= session()->get('msg')[1] ?>", 'Berhasil');
      <?php } elseif (session()->get('msg')[0] == 0) { ?>
        Swal.fire({
          icon: 'error',
          title: '<?= session()->get('msg')[1] ?>',
          confirmButtonText: "Oke"
          // text: 'Something went wrong!',
          // footer: '<a href="">Why do I have this issue?</a>'
        })
        // toastr.error("<?= session()->get('msg')[1] ?>", 'Gagal');
    <?php }
    } ?>
  </script>
</body>

</html>
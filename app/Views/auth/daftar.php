<?php
$cfg = new \SConfig();
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <title>Daftar Page | <?= (@$cfg->_namaApp ?? "") ?></title>


  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
  <!-- Notifications css -->
  <link href="<?= base_url('assets/') ?>plugins/toastr/toastr.min.css" rel="stylesheet" type="text/css" />
  <link href="<?= base_url('assets/') ?>plugins/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
  <link href="//getbootstrap.com/docs/4.6/examples/checkout/form-validation.css" rel="stylesheet">
</head>

<body class="bg-light">

  <div class="container">
    <div class="py-5 text-center">
      <img class="d-block mx-auto mb-4" src="<?= (@$cfg->_logoSekolah ?? "") ?>" alt="" width="72" height="72">
      <h2>Formulir Pendaftaran</h2>
      <!-- <p class="lead">Below is an example form built entirely with Bootstrap’s form controls. Each required form group has a validation state that can be triggered by attempting to submit the form without completing it.</p> -->
    </div>

    <div class="row justify-content-center">
      <div class="col-md-8 order-md-1">
        <h4 class="mb-3">Data Diri</h4>
        <p>Sisa kuota pendaftar: <?= $sisa ?></p>
        <form method="post" action="">
          <div class="mb-3">
            <label for="firstName">No Pendaftaran</label>
            <input type="text" readonly="" class="form-control" name="kode" id="firstName" placeholder="" value="<?= @$kode ?>" required>
          </div>
          <div class="mb-3">
            <label for="firstName">Nama Lengkap</label>
            <input type="text" class="form-control <?= (@!$err['nama'] ? "" : "is-invalid") ?>" name="nama" id="firstName" placeholder="Masukkan nama lengkap" value="<?= @$post['nama'] ?>" required>
            <div class="invalid-feedback">
              <?= @$err['nama'] ?>
            </div>
          </div>

          <div class="mb-3">
            <label for="tmpt_lahir">Tempat Lahir</label>
            <input type="text" class="form-control" name="tmpt_lahir" id="tmpt_lahir" placeholder="Masukkan tempat lahir anda" value="<?= @$post['tmpt_lahir'] ?>" required>
            <div class="invalid-feedback">
              <?= @$err['tmpt_lahir'] ?>
            </div>
          </div>

          <div class="mb-3">
            <label for="tgl_lahir">Tanggal Lahir</label>
            <input type="date" class="form-control" name="tgl_lahir" id="tgl_lahir" placeholder="" value="<?= @$post['tgl_lahir'] ?>" required>
            <div class="invalid-feedback">
              <?= @$err['tgl_lahir'] ?>
            </div>
          </div>

          <div class="d-block my-3">
            <label>Jenis Kelamin</label>
            <div class="custom-control custom-radio">
              <input id="laki" name="jenis_kelamin" type="radio" class="custom-control-input" value="Laki-laki" checked required>
              <label class="custom-control-label" for="laki">Laki-laki</label>
            </div>
            <div class="custom-control custom-radio">
              <input id="perem" name="jenis_kelamin" type="radio" class="custom-control-input" value="Perempuan" required>
              <label class="custom-control-label" for="perem">Perempuan</label>
            </div>
            <div class="invalid-feedback">
              <?= @$err['jenis_kelamin'] ?>
            </div>
          </div>

          <div class="mb-3">
            <label for="alamat">Alamat</label>
            <input type="text" class="form-control" name="alamat" id="alamat" placeholder="jl. kuhajidewo" value="<?= @$post['alamat'] ?>" required>
            <div class="invalid-feedback">
              <?= @$err['alamat'] ?>
            </div>
          </div>

          <div class="mb-3">
            <label for="asl_sekolah">Asal Sekolah</label>
            <select class="custom-select d-block w-100" name="asl_sekolah" id="asl_sekolah" required>
              <option value="">--- ASAL SEKOLAH ---</option>
              <?php foreach ($smp as $val) { ?>
                <option value="<?= $val['nama'] ?>"><?= $val['nama'] ?></option>
              <?php } ?>
            </select>
            <div class="invalid-feedback">
              <?= @$err['asl_sekolah'] ?>
            </div>
          </div>

          <div class="mb-3">
            <label for="jurusan">Jurusan</label>
            <select class="custom-select d-block w-100" name="jurusan" id="jurusan" required>
              <option value="">--- IPA/IPS ---</option>
              <option value="IPA">IPA</option>
              <option value="IPS">IPS</option>
            </select>
            <div class="invalid-feedback">
              <?= @$err['jurusan'] ?>
            </div>
          </div>

          <div class="mb-3">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" id="email" placeholder="a@gmail.com" value="<?= @$post['email'] ?>" required>
            <div class="invalid-feedback">
              <?= @$err['email'] ?>
            </div>
          </div>

          <div class="mb-3">
            <label for="no_tlpn">No. Telepon</label>
            <input type="text" class="form-control" name="no_tlpn" id="no_tlpn" placeholder="08238358485" value="<?= @$post['no_tlpn'] ?>" required>
            <div class="invalid-feedback">
              <?= @$err['no_tlpn'] ?>
            </div>
          </div>

          <div class="mb-3">
            <label for="username">Username</label>
            <input type="text" class="form-control" name="username" id="username" placeholder="Masukkan username" value="<?= @$post['username'] ?>" required>
            <div class="invalid-feedback">
              <?= @$err['username'] ?>
            </div>
          </div>

          <div class="mb-3">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Masukkan password" value="" required>
            <div class="invalid-feedback">
              <?= @$err['password'] ?>
            </div>
          </div>

          <hr class="mb-4">
          <button class="btn btn-primary btn-lg btn-block" type="submit">Daftar</button>
        </form>
      </div>
    </div>

    <footer class="my-5 pt-5 text-muted text-center text-small">
      <p class="mb-1">&copy; 2017-2022 Company Name</p>
      <ul class="list-inline">
        <li class="list-inline-item"><a href="#">Privacy</a></li>
        <li class="list-inline-item"><a href="#">Terms</a></li>
        <li class="list-inline-item"><a href="#">Support</a></li>
      </ul>
    </footer>
  </div>

  <!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->
  <!-- jQuery -->
  <script src="<?= base_url('assets/') ?>plugins/jquery/jquery.min.js"></script>
  <!-- Notifications Plugin -->
  <script src="<?= base_url('assets/') ?>plugins/toastr/toastr.min.js"></script>

  <script src="<?= base_url('assets/') ?>plugins/sweetalert2/sweetalert2.all.js"></script>

  <script>
    <?php if (session()->has('msg')) {
      if (session()->get('msg')[0] == 1) { ?>
        toastr.success("<?= session()->get('msg')[1] ?>", 'Berhasil');
      <?php } elseif (session()->get('msg')[0] == 0) { ?>
        toastr.error("<?= session()->get('msg')[1] ?>", 'Gagal');
    <?php }
    } ?>
  </script>
  <?php if ($sisa <= 0) {
  ?>
    <script>
      Swal.fire({
        icon: 'error',
        title: 'Informasi',
        confirmButtonText: "Oke",
        html: 'Kuota pendaftaran sudah habis.',
      })
    </script>
  <?php } ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

</body>

</html>
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
</head>

<body class="bg-light">

  <div class="container">
    <div class="py-5 text-center">
      <img class="d-block mx-auto mb-4" src="<?= (@$cfg->_logoSekolah ?? "") ?>" alt="" width="72" height="72">
      <h2>PPDB MAN 1 GAYO LUES TAHUN <?= $angkatan->tahun ?></h2>
      <!-- <p class="lead">Below is an example form built entirely with Bootstrap’s form controls. Each required form group has a validation state that can be triggered by attempting to submit the form without completing it.</p> -->
    </div>

    <div class="row">
      <div class="col-12">
        <h3>Informasi Pendaftaran</h3>
        <ul>
          <li>Pendaftaran mulai dibuka tanggal <?= date('d F Y', strtotime($angkatan->tgl_buka)) ?> s/d <?= date('d F Y', strtotime($angkatan->tgl_tutup)) ?></li>
          <li>Pengumuman kelulusan tanggal <?= date('d F Y', strtotime($angkatan->tgl_pengumuman)) ?></li>
        </ul>
        <h3>Syarat Pendaftaram</h3>
        <ol>
          <li>Tercatat sebagai peserta didik kelas IX Mts/SMP pada tahun pelajaran 2022/2023</li>
          <li>Berusia maksimal 21 tahun pada 1 juli 2023</li>
          <li>memiliki NISN dan terdaftar pada EMIS(bagi Mts) dan DAPODIK(bagi SMP)</li>
          <li>Scan Kartu Keluarga</li>
          <li>Scan Akta Kelahiran</li>
          <li>Pas foto ukuran 3x4</li>
          <li>Scan Kartu Bantuan Sosial</li>
          <li>Scan Surat Keterangan Telah mengikuti Ujian Akhir Nasional/Surat Keterangan Berstatus Kelas IX dari sekolah/madrasah</li>
        </ol>
        <h3>Alur Pendaftaran</h3>
        <ol>
          <li>Daftar melalui tautan <a href="<?= site_url('daftar') ?>">berikut</a>.</li>
          <li>Masuk/login menggunakan username password yang telah dibuat.</li>
          <li>Lengkapi formulir data diri dan nilai.</li>
          <li>Upload Berkas seperti Scan Kartu Keluarga, Akta kelahiran, Foto 3x4 dll.</li>
          <li>Setelah itu datang langsung ke MAN 1 Gayo Lues untuk melakukan tes praktik.</li>
          <li>Jika semua sudah dilakukan tunggu tanggal pengumuman</li>
          <li>Pengumuman akan disebarkan melalui akun masing-masing atau dapat langsung ke MAN 1 Gayo Lues</li>
        </ol>
        <h3>Kontak Person</h3>
        <ul>
          <li>0813 7538 3840 (Rahma Daini. S.Psi.,)</li>
          <li>0822 6744 2009 (Drs. Sulaiman Daud)</li>
          <li>0852 7657 8683 (Fatimah Syam. S.Pd)</li>
        </ul>
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
  <script>
    <?php if ($status == 0) { ?>
      Swal.fire({
        icon: 'error',
        title: 'Tidak Dalam Masa Pendaftaran.',
        confirmButtonText: "Oke"
        // text: 'Something went wrong!',
        // footer: '<a href="">Why do I have this issue?</a>'
      })
    <?php } ?>
    <?php if ($status == 2) { ?>
      Swal.fire({
        icon: 'success',
        title: 'Pendaftaran sudah selesai.',
        confirmButtonText: "Oke",
        text: 'Silahkan cek akun masing masing atau datang langsung ke sekolah!',
        // footer: '<a href="">Why do I have this issue?</a>'
      })
    <?php } ?>
  </script>
</body>

</html>
<?php
$cfg = new \SConfig();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?= view("templates/head") ?>
  <!-- CSS -->
  <style>
    .image-upload>input {
      display: none;
    }
  </style>
  <!-- TUTUP CSS -->
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    <?= view("templates/atas") ?>
    <?= view("templates/nav") ?>
    <div class="content-wrapper">
      <?= view("templates/breadcump") ?>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <!-- Status Diterima -->
            <div class="col-12">
              <?php if ($pesan != 0) { ?>
                <div class="alert alert-info" role="alert">
                  <h4 class="alert-heading">Ada persyaratan yang belum terpenuhi!</h4>
                </div>
                <?php } else {
                if ($pengumuman) { ?>
                  <div class="alert alert-info" role="alert">
                    <h4 class="alert-heading">Belum waktunya pengumuman!</h4>
                  </div>
                  <?php } else {
                  if ($lulus) { ?>
                    <div class="alert alert-success" role="alert">
                      <table>
                        <tr>
                          <td>No. Pendaftaran&nbsp;&nbsp;&nbsp;&nbsp;</td>
                          <td>:</td>
                          <td><?= genId($pribadi) ?></td>
                        </tr>
                        <tr>
                          <td>Nama</td>
                          <td>:</td>
                          <td><?= strtoupper($pribadi['nama']) ?></td>
                        </tr>
                        <tr>
                          <td>Asal Sekolah</td>
                          <td>:</td>
                          <td><?= strtoupper($pribadi['asl_sekolah']) ?></td>
                        </tr>
                        <tr>
                          <td>Status</td>
                          <td>:</td>
                          <td>LULUS</td>
                        </tr>
                      </table>
                      <br><br>
                      <p>Selamat, anda dinyatakan <b>Lulus</b> Seleksi penerimaan siswa baru</p>
                    </div>
                  <?php } else { ?>
                    <div class="alert alert-danger" role="alert">
                      <table>
                        <tr>
                          <td>No. Pendaftaran&nbsp;&nbsp;&nbsp;&nbsp;</td>
                          <td>:</td>
                          <td><?= genId($pribadi) ?></td>
                        </tr>
                        <tr>
                          <td>Nama</td>
                          <td>:</td>
                          <td><?= strtoupper($pribadi['nama']) ?></td>
                        </tr>
                        <tr>
                          <td>Asal Sekolah</td>
                          <td>:</td>
                          <td><?= $pribadi['asl_sekolah'] ?></td>
                        </tr>
                        <tr>
                          <td>Jurusan</td>
                          <td>:</td>
                          <td><?= strtoupper($pribadi['jurusan']) ?></td>
                        </tr>
                        <tr>
                          <td>Status</td>
                          <td>:</td>
                          <td>TIDAK LULUS</td>
                        </tr>
                      </table>
                      <br><br>
                      <p>Maaf, anda dinyatakan <b>Tidak Lulus</b> Seleksi penerimaan siswa baru</p>
                    </div>
                  <?php } ?>
                <?php } ?>
              <?php } ?>
            </div>
          </div>
        </div>
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <?= view("templates/foot") ?>

  </div>
  <!-- ./wrapper -->
  <?= view("templates/script") ?>
  <?php if ($pesan != 0) { ?>
    <?php if ($pesan == 1) { ?>
      <script>
        Swal.fire({
          icon: 'info',
          title: 'Informasi',
          confirmButtonText: "Oke",
          html: 'Mohon untuk melengkapi <a href="<?= site_url('nilai') ?>">data nilai</a> terlebih dahulu.',
        })
      </script>
    <?php } else if ($pesan == 2) { ?>
      <script>
        Swal.fire({
          icon: 'info',
          title: 'Informasi',
          confirmButtonText: "Oke",
          html: 'Tunggu proses verifikasi nilai oleh admin, harap selalu periksa <a href="<?= site_url('nilai') ?>">halaman ini</a>',
        })
      </script>
    <?php } else if ($pesan == 3) { ?>
      <script>
        Swal.fire({
          icon: 'info',
          title: 'Informasi',
          confirmButtonText: "Oke",
          html: 'Mohon untuk melengkapi <a href="<?= site_url('berkas') ?>">berkas</a> terlebih dahulu.',
        })
      </script>
    <?php } else if ($pesan == 4) { ?>
      <script>
        Swal.fire({
          icon: 'info',
          title: 'Informasi!',
          confirmButtonText: "Oke",
          text: 'Harap hadir ke MAN 1 GAYO LUES untuk melakukan tes baca Alquran, sholat dan wawancara.!',
        })
      </script>
    <?php } else if ($pesan == 5) { ?>
      <script>
        Swal.fire({
          icon: 'info',
          title: 'Informasi!',
          confirmButtonText: "Oke",
          html: 'Tunggu proses verifikasi berkas oleh admin, harap selalu periksa <a href="<?= site_url('berkas') ?>">halaman ini</a>!',
        })
      </script>
    <?php } ?>
  <?php } ?>



</body>

</html>
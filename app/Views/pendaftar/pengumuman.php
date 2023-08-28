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
              <?php if ($status == "Periksa") { ?>
                <div class="alert alert-info" role="alert">
                  <h4 class="alert-heading">Ada persyaratan yang belum terpenuhi!</h4>
                </div>
              <?php } else if ($status == "Belum waktunya pengumuman") { ?>
                <div class="alert alert-info" role="alert">
                  <h4 class="alert-heading">Belum waktunya pengumuman!</h4>
                </div>
              <?php } else if ($status == "Anda lulus") { ?>
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
                      <td><?= $pribadi['nama'] ?></td>
                    </tr>
                    <tr>
                      <td>Asal Sekolah</td>
                      <td>:</td>
                      <td><?= $pribadi['asl_sekolah'] ?></td>
                    </tr>
                    <tr>
                      <td>Status</td>
                      <td>:</td>
                      <td>Lulus</td>
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
                      <td><?= $pribadi['nama'] ?></td>
                    </tr>
                    <tr>
                      <td>Asal Sekolah</td>
                      <td>:</td>
                      <td><?= $pribadi['asl_sekolah'] ?></td>
                    </tr>
                    <tr>
                      <td>Jurusan</td>
                      <td>:</td>
                      <td><?= $pribadi['jurusan'] ?></td>
                    </tr>
                    <tr>
                      <td>Status</td>
                      <td>:</td>
                      <td>Tidak Lulus</td>
                    </tr>
                  </table>
                  <br><br>
                  <p>Maaf, anda dinyatakan <b>Tidak Lulus</b> Seleksi penerimaan siswa baru</p>
                </div>
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

  <?php if (@$nilai['nilai_ps'] == 0 || @$nilai['nilai_pa'] == 0 || @$nilai['nilai_wawancara'] == 0) { ?>
    <script>
      Swal.fire({
        icon: 'info',
        title: 'Informasi!',
        confirmButtonText: "Oke",
        text: 'Harap hadir ke MAN 1 GAYO LUES untuk melakukan tes baca Alquran, sholat dan wawancara.!',
      })
    </script>
  <?php } ?>

  <?php if (!$berkas) { ?>
    <script>
      Swal.fire({
        icon: 'error',
        title: 'Informasi',
        confirmButtonText: "Oke",
        html: 'Mohon untuk melengkapi <a href="<?= site_url('berkas') ?>">berkas</a> terlebih dahulu.',
      })
    </script>
  <?php } ?>

  <?php
  $status = json_decode(@$nilai['status']);
  $statu_res = true;
  if ($status) {
    $jenis_nilai = ['un_mat', 'un_bi', 'un_ipa', 'un_bing'];
    foreach ($jenis_nilai as $key => $value) {
      $jenisnya = 'status_' . $value;
      $stat_nil = $status->$jenisnya ?? null;
      if ($stat_nil ==  'ditolak') {
        $statu_res = false;
      }
    }
  }
  ?>
  <?php if (!$statu_res) { ?>
    <script>
      Swal.fire({
        icon: 'error',
        title: 'Informasi',
        confirmButtonText: "Oke",
        html: 'Ada berkas nilai yang ditolak, harap periksa kembali <a href="<?= site_url('pendaftar') ?>">halaman ini</a>',
      })
    </script>
  <?php } ?>

  <?php if (!$nilai) { ?>
    <script>
      Swal.fire({
        icon: 'error',
        title: 'Informasi',
        confirmButtonText: "Oke",
        html: 'Mohon untuk melengkapi <a href="<?= site_url('pendaftar') ?>">form berikut</a> terlebih dahulu.',
      })
    </script>
  <?php } ?>

  <?php if (@$nilai['berkas'] == '[]') { ?>
    <script>
      Swal.fire({
        icon: 'error',
        title: 'Informasi',
        confirmButtonText: "Oke",
        html: 'Mohon untuk mengupload <a href="<?= site_url('pendaftar') ?>">bukti nilai</a> ujian nasional.',
      })
    </script>
  <?php } ?>

</body>

</html>
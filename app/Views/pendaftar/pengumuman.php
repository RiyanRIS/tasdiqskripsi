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
              <?php if ($status == "Belum waktunya pengumuman") { ?>
                <div class="alert alert-success" role="alert">
                  <h4 class="alert-heading">Belum waktunya pengumuman!</h4>
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
  <script>
    // Swal.fire({
    //   icon: 'info',
    //   title: 'Informasi!',
    //   confirmButtonText: "Oke",
    //   text: '<?= $judul ?>',
    // })
  </script>
</body>

</html>
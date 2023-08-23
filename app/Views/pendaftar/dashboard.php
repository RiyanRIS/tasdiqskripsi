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
              <!-- <h4 class="alert-heading">Selamat datang, <?= ucwords(@session()->get('user_nama')) ?></h4> -->

              <?php if ($nilai['nilai_ps'] == 0 || $nilai['nilai_pa'] == 0 || $nilai['nilai_wawancara'] == 0) { ?>
                <div class="alert alert-danger" role="alert">
                  <p>Harap hadir ke MAN 1 GAYO LUES untuk melakukan tes baca Alquran, sholat dan wawancara.</p>
                </div>
              <?php } ?>

              <?php if (!$nilai) { ?>
                <div class="alert alert-danger" role="alert">
                  <p>Mohon untuk melengkapi <a href="<?= site_url('pendaftar') ?>">form berikut</a> terlebih dahulu.</p>
                </div>
              <?php } ?>

              <?php if ($nilai['berkas'] == '[]') { ?>
                <div class="alert alert-danger" role="alert">
                  <p>Mohon untuk mengupload <a href="<?= site_url('pendaftar') ?>">bukti nilai</a> ujian nasional.</p>
                </div>
              <?php } ?>
            </div>
            <!-- Nilai -->
            <!-- FORM Nilai -->

            <div class="col-md-6">
              <form method="post" action="edit" data-url="<?= site_url(" ubah/datanilai2") ?>" id="myForm2" enctype="multipart/form-data" accept-charset="utf-8" class="col-md-12">
                <?php
                $berkasnya = json_decode(@$nilai['berkas']);
                ?>
                <input type="hidden" name="id" value="<?= session()->user_id ?>">

                <table class="table table-bordered">
                  <tr style="background-color: #28a745;color: #fff;">
                    <th>Data Nilai</th>
                    <th>Upload Bukti</th>
                  </tr>
                  <?php
                  $jenis_nilai = ['un_mat', 'un_bi', 'un_ipa', 'un_bing'];
                  $nama_nilai = ['Nilai UN Matematika', 'Nilai UN Bahasa Indonesia', 'Nilai UN Ilmu Pengetahuan Alam', 'Nilai UN Bahasa Inggris'];
                  foreach ($jenis_nilai as $key => $value) {
                    $jenis = $value;
                    $nama = $nama_nilai[$key]; ?>
                    <tr>
                      <td>
                        <div class="form-group col-12" id="notifikasi_<?= $jenis ?>">
                          <label for="<?= $jenis ?>"><?= $nama ?></label>
                          <input type="number" class="form-control" id="<?= $jenis ?>" value="<?= @$nilai[$jenis] ?>" name="<?= $jenis ?>" placeholder="Masukkan <?= $nama ?>" required="true" autocomplete="off" min="1" max="100">
                        </div>
                      </td>
                      <td>
                        <div id="pilihan-<?= $jenis ?>">
                          <p>File: <?php if (isset($berkasnya->$jenis)) {
                                    ?><a target="BLANK" href="<?= base_url('uploads/temp/' . $berkasnya->$jenis) ?>">klik disini</a><?php } ?></p>
                        </div>
                        <div class="image-upload">
                          <label for="file-<?= $jenis ?>">
                            <i class="mt-1 ml-5 fa fa-upload fa-3x"></i>
                          </label>

                          <input id="file-<?= $jenis ?>" type="file" name="file<?= $jenis ?>" />
                        </div>
                      </td>
                    </tr>
                  <?php } ?>

                  <?php
                  $jenis_nilai2 = ['nilai_pa', 'nilai_ps', 'nilai_wawancara'];
                  $nama_nilai2 = ['Nilai Baca Alquran', 'Nilai Praktik Sholat Indonesia', 'Nilai Wawancara'];
                  foreach ($jenis_nilai2 as $key => $value) {
                    $jenis = $value;
                    $nama = $nama_nilai2[$key]; ?>

                    <tr>
                      <td colspan="2">
                        <div class="form-group col-12" id="notifikasi_<?= $jenis ?>">
                          <label for="<?= $jenis ?>"><?= $nama ?></label>
                          <input disabled title="Diisi Oleh Admin" type="number" class="form-control" id="<?= $jenis ?>" value="<?= @$nilai[$jenis] ?>" name="<?= $jenis ?>" placeholder="Masukkan <?= $nama ?>" required="true" autocomplete="off" min="1" max="100">
                        </div>
                      </td>
                    <tr>

                    <?php } ?>
                    <tr>
                      <td colspan='2'>
                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
                      </td>
                    </tr>
                </table>
              </form>
            </div>
            <!-- Berkas -->
            <div class="col-md-6">
              <div class="card card-success">
                <div class="card-header">
                  <h5 class="cart-title">Detail Berkas</h5>
                </div>
                <div class="card-body">
                  <?php if ($berkas == null) { ?>
                    <div class="alert alert-danger" role="alert">
                      <p>Mohon untuk melengkapi <a href="<?= site_url('berkas') ?>">berkas</a> yang dibutuhkan!</p>
                    </div>
                  <?php } else { ?>
                    <table id="datatable" class="table table-bordered table-hover">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>NAMA BERKAS</th>
                          <th>STATUS</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if ($berkas != null) {
                          foreach ($berkas as $key => $v) { ?>
                            <tr>
                              <td><?= ++$key ?></td>
                              <td><a target="_BLANK" href="<?= base_url('uploads/temp/' . $v->file) ?>"><?= $v->nama ?></a></td>
                              <td>
                                <?php if ($v->status == "Terverifikasi") { ?>
                                  <span class='badge badge-success'>Terverifikasi<span>
                                    <?php } else if ($v->status == "Ditolak") { ?>
                                      <span class='badge badge-danger'>Ditolak<span>
                                        <?php } else { ?>
                                          <span class='badge badge-warning'>Belum Dicek<span>
                                            <?php } ?>
                              </td>
                            </tr>
                        <?php }
                        } ?>
                      </tbody>
                    </table>
                  <?php } ?>
                </div>
              </div>
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
    <?php foreach ($jenis_nilai as $key => $value) { ?>
      const file_<?= $value ?> = document.getElementById("file-<?= $value ?>");

      file_<?= $value ?>.addEventListener("change", function() {
        const selectedFiles = file_<?= $value ?>.files;
        if (selectedFiles.length > 0) {
          html = "<p>File: " + selectedFiles[0].name + "</p>";
          $('#pilihan-<?= $value ?>').html(html)
        } else {
          html = "<p>File: - </p>";
          $('#pilihan-<?= $value ?>').html(html)
        }
      });
    <?php } ?>
  </script>

</body>

</html>
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
              <?php if ($nilai) { ?>
                <?php if ($status_peserta) { ?>
                  <div class="alert alert-success" role="alert">
                    <h4 class="alert-heading">Selamat datang, <?= ucwords(@session()->get('user_nama')) ?></h4>
                    <p>Selamat, nilai kamu sudah memenuhi standar.</p>
                    <hr>
                    <!-- <p class="mb-0">Hingga tanggal deatline berkas belum lengkap, akan dinyatakan gugur.</p> -->
                  </div>
                <?php } else { ?>
                  <div class="alert alert-danger" role="alert">
                    <h4 class="alert-heading">Selamat datang, <?= ucwords(@session()->get('user_nama')) ?></h4>
                    <p>Mohon maaf, nilai kamu belum memenuhi standar.</p>
                  </div>
                <?php } ?>
              <?php } else { ?>
                <div class="alert alert-warning" role="alert">
                  <h4 class="alert-heading">Halo, <?= ucwords(@session()->get('user_nama')) ?></h4>
                  <p>Silahkan lengkapi data diri anda <a href="<?= site_url('pendaftar') ?>">disini</a>.</p>
                </div>
              <?php } ?>

            </div>
            <!-- Nilai -->
            <div class="col-md-6">
              <!-- FORM Nilai -->
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
                  $jenis_nilai = ['nilai_un', 'nilai_raport', 'nilai_ps', 'nilai_pa', 'nilai_wawancara'];
                  foreach ($jenis_nilai as $key => $value) {
                    $jenis = $value ?>
                    <tr>
                      <td>
                        <div class="form-group col-12" id="notifikasi_<?= $jenis ?>">
                          <label for="<?= $jenis ?>"><?= ucwords(str_replace('_', ' ', $jenis)) ?></label>
                          <input type="number" class="form-control" id="<?= $jenis ?>" value="<?= @$nilai[$jenis] ?>" name="<?= $jenis ?>" placeholder="Masukkan <?= ucwords(str_replace('_', ' ', $jenis)) ?>" required="true" autocomplete="off" min="1" max="100">
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
                      <p>Belum ada berkas masuk!</p>
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
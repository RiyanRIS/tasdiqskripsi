<?php
$cfg = new \SConfig();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?= view("templates/head") ?>
  <!-- CSS -->
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
            <!-- <div class="col-md-6">
              <div class="card card-success">
                <div class="card-header">
                  <h5 class="cart-title">Detail Pendaftar</h5>
                </div>
                <div class="card-body">
                  <table class="table table-bordered">
                    <tr>
                      <th>Nama</th>
                      <td>:</td>
                      <td><?= session()->get('user_nama') ?></td>
                    </tr>
                    <tr>
                      <th>Jurusan</th>
                      <td>:</td>
                      <td><?= @$pribadi['jurusan'] ?></td>
                    </tr>
                    <?php if ($nilai) { ?>
                      <tr>
                        <th>Nilai</th>
                        <td>:</td>
                        <td>UN = <?= $nilai['nilai_un'] ?></td>
                      </tr>
                      <tr>
                        <th colspan="2" rowspan="3"></th>
                        <td>Raport = <?= $nilai['nilai_raport'] ?></td>
                      </tr>
                      <tr>
                        <td>PS = <?= $nilai['nilai_ps'] ?></td>
                      </tr>
                      <tr>
                        <td>PA = <?= $nilai['nilai_pa'] ?></td>
                      </tr>
                    <?php } else { ?>
                      <tr>
                        <th>Nilai</th>
                        <td>:</td>
                        <td>Belum Ada Nilai</td>
                      </tr>
                    <?php } ?>
                  </table>
                </div>
              </div>
            </div> -->
            <div class="col-md-6">
              <table class="table table-bordered">
                <tr style="background-color: #28a745;color: #fff;">
                  <th>Data Nilai</th>
                  <th>Upload Bukti</th>
                </tr>
                <tr>
                  <td>
                    <form method="post" action="edit" data-url="<?= site_url("ubah/datanilai2") ?>" id="myForm2" enctype="multipart/form-data" accept-charset="utf-8">
                      <div class="form-group col-12" id="notifikasi_nilai_un">
                        <label for="nilai_un">Nilai UN</label>
                        <input type="hidden" name="id" value="<?= session()->user_id ?>">
                        <input type="number" class="form-control" id="nilai_un" value="<?= @$nilai['nilai_un'] ?>" name="nilai_un" placeholder="Masukkan Nilai UN" required="true" autocomplete="off" min="1" max="100">
                      </div>
                    </form>
                  </td>
                  <td>
                    <a href="<?= site_url('berkas') ?>" class="mt-1 ml-5 btn btn-default"><i class="fa fa-upload fa-3x"></i></a>
                  </td>
                </tr>
                <tr>
                  <td>
                    <form method="post" action="edit" data-url="<?= site_url("ubah/datanilai2") ?>" id="myForm3" enctype="multipart/form-data" accept-charset="utf-8">
                      <div class="form-group col-12" id="notifikasi_nilai_raport">
                        <label for="nilai_raport">Nilai Raport</label>
                        <input type="hidden" name="id" value="<?= session()->user_id ?>">
                        <input type="number" class="form-control" id="nilai_raport" value="<?= @$nilai['nilai_raport'] ?>" name="nilai_raport" placeholder="Masukkan Nilai Raport" required="true" autocomplete="off" min="1" max="100">
                      </div>
                    </form>
                  </td>
                  <td>
                    <a href="<?= site_url('berkas') ?>" class="mt-1 ml-5 btn btn-default"><i class="fa fa-upload fa-3x"></i></a>
                  </td>
                </tr>
                <tr>
                  <td>
                    <form method="post" action="edit" data-url="<?= site_url("ubah/datanilai2") ?>" id="myForm4" enctype="multipart/form-data" accept-charset="utf-8">
                      <div class="form-group col-12" id="notifikasi_nilai_ps">
                        <label for="nilai_ps">Nilai PS</label>
                        <input type="hidden" name="id" value="<?= session()->user_id ?>">
                        <input type="number" class="form-control" id="nilai_ps" value="<?= @$nilai['nilai_ps'] ?>" name="nilai_ps" placeholder="Masukkan Nilai UN" required="true" autocomplete="off" min="1" max="100">
                      </div>
                    </form>
                  </td>
                  <td>
                    <a href="<?= site_url('berkas') ?>" class="mt-1 ml-5 btn btn-default"><i class="fa fa-upload fa-3x"></i></a>
                  </td>
                </tr>
                <tr>
                  <td>
                    <form method="post" action="edit" data-url="<?= site_url("ubah/datanilai2") ?>" id="myForm5" enctype="multipart/form-data" accept-charset="utf-8">
                      <div class="form-group col-12" id="notifikasi_nilai_pa">
                        <label for="nilai_pa">Nilai PA</label>
                        <input type="hidden" name="id" value="<?= session()->user_id ?>">
                        <input type="number" class="form-control" id="nilai_pa" value="<?= @$nilai['nilai_pa'] ?>" name="nilai_ps" placeholder="Masukkan Nilai UN" required="true" autocomplete="off" min="1" max="100">
                      </div>
                    </form>
                  </td>
                  <td>
                    <a href="<?= site_url('berkas') ?>" class="mt-1 ml-5 btn btn-default"><i class="fa fa-upload fa-3x"></i></a>
                  </td>
                </tr>
              </table>
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
                              <td><a target="_BLANK" href="<?= site_url('uploads/temp/' . $v->file) ?>"><?= $v->nama ?></a></td>
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

</body>

</html>
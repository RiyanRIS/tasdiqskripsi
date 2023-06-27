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
                    <h4 class="alert-heading">Halo, <?= ucwords(@session()->get('user_nama')) ?></h4>
                    <p>Selamat, kamu telah diterima menjadi siswa di <?= $cfg->_namaSekolah ?>. Silahkan datang langsung ke bagian admisi untuk melengkapi berkas dan pembayaran sebelum tgl 14 April 2023.</p>
                    <hr>
                    <p class="mb-0">Hingga tanggal deatline berkas belum lengkap, akan dinyatakan gugur.</p>
                  </div>
                <?php } else { ?>
                  <div class="alert alert-danger" role="alert">
                    <h4 class="alert-heading">Halo, <?= ucwords(@session()->get('user_nama')) ?></h4>
                    <p>Mohon maaf, kamu gagal menjadi siswa di <?= $cfg->_namaSekolah ?>.</p>
                  </div>
                <?php } ?>
              <?php } ?>
            </div>
            <!-- Nilai -->
            <div class="col-md-6">
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
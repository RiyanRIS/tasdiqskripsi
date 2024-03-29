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
              <?php if ($pesan == 0) { ?>
                <div class="alert alert-success" role="alert">
                  <h4 class="alert-heading">Terima kasih</h4>
                  <p>Kamu telah menyelesaikan tahapan pendaftaran siswa baru MAN 1 GAYO LUES. Mohon menunggu hingga tanggal <a href="<?= site_url('pengumuman') ?>">pengumuman</a> tiba.</p>
                </div>
              <?php } ?>

            </div>
            <!-- Nilai -->
            <div class="col-md-6">
              <form method="post" action="edit" data-url="<?= site_url(" ubah/datanilai2") ?>" id="myForm2" enctype="multipart/form-data" accept-charset="utf-8" class="col-md-12">
                <?php
                $berkasnya = $berkasnya;
                $status = $status_berkas;
                ?>
                <input type="hidden" name="id" value="<?= session()->user_id ?>">

                <table class="table table-bordered">
                  <tr style="background-color: #28a745;color: #fff;">
                    <th>Data Nilai</th>
                    <th>Upload Bukti</th>
                    <th>Status</th>
                  </tr>
                  <?php
                  $jenis_nilai = ['un_mat', 'un_bi', 'un_ipa', 'un_bing'];
                  $nama_nilai = ['Nilai Ujian Nasional Matematika', 'Nilai Ujian Nasional Bahasa Indonesia', 'Nilai Ujian Nasional Ilmu Pengetahuan Alam', 'Nilai Ujian Nasional Bahasa Inggris'];
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
                          <p>File: <?php if ($berkasnya->$jenis != 'Belum upload') {
                                    ?><a target="BLANK" href="<?= base_url('uploads/temp/' . $berkasnya->$jenis) ?>">klik disini</a><?php } ?></p>
                        </div>
                        <div class="image-upload">
                          <label for="file-<?= $jenis ?>">
                            <i class="mt-1 ml-5 fa fa-upload fa-3x"></i>
                          </label>

                          <input id="file-<?= $jenis ?>" type="file" name="file<?= $jenis ?>" />
                        </div>
                      </td>
                      <td>
                        <?php $jenisnya = 'status_' . $value; ?>
                        <div id="pilihan-<?= $jenisnya ?>">
                          <p><?php
                              $stat_nil = $status->$jenisnya ? $status->$jenisnya : "belum upload";
                              if ($stat_nil ==  'terverifikasi') {
                                echo "<span class='badge badge-success'>" . $stat_nil . "<span>";
                              } else {
                                echo "<span class='badge badge-danger'>" . $stat_nil . "<span>";
                              }
                              ?></p>
                        </div>
                      </td>
                    </tr>
                  <?php } ?>

                  <?php
                  $jenis_nilai2 = ['nilai_pa', 'nilai_ps', 'nilai_wawancara'];
                  $nama_nilai2 = ['Nilai Tes Praktek pembacaan al quran', 'Nilai Tes Praktik Sholat', 'Nilai Tes Wawancara'];
                  foreach ($jenis_nilai2 as $key => $value) {
                    $jenis = $value;
                    $nama = $nama_nilai2[$key]; ?>

                    <tr>
                      <td colspan="3">
                        <div class="form-group col-12" id="notifikasi_<?= $jenis ?>">
                          <label for="<?= $jenis ?>"><?= $nama ?></label>
                          <input disabled title="Diisi Oleh Admin" type="number" class="form-control" id="<?= $jenis ?>" value="<?= @$nilai[$jenis] ?>" name="<?= $jenis ?>" placeholder="Masukkan <?= $nama ?>" required="true" autocomplete="off" min="1" max="100">
                        </div>
                      </td>
                    <tr>

                    <?php } ?>
                    <tr>
                      <td colspan='3'>
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
                          foreach ($berkas as $key => $v) {
                            $tampil = ($v->jenis == "kk" ? "Kartu Keluarga" : ($v->jenis == 'akta' ? "Akta Kelahiran" : ($v->jenis == 'bukti' ? "Ijazah/Surat Keterangan Lulus" : "Dokumen Lain"))); ?>
                            <tr>
                              <td><?= ++$key ?></td>
                              <td><a target="_BLANK" href="<?= base_url('uploads/temp/' . $v->file) ?>"><?= $tampil ?></a></td>
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
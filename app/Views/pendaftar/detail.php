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
            <!-- FORM Data Diri -->
            <form method="post" action="edit" data-url="<?= site_url("ubah/datapribadi") ?>" id="myForm" enctype="multipart/form-data" accept-charset="utf-8" class="col-6">
              <div class="card card-success">

                <div class="card-header">
                  <h3 class="card-title">Data Pribadi</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                    </button>
                  </div>
                </div>

                <div class="card-body">
                  <div class="form-group" id="notifikasi_nama">
                    <label for="nama">Nama Lengkap</label>
                    <input type="hidden" name="id" value="<?= @$record['id'] ?>">
                    <input type="text" class="form-control" id="nama" value="<?= @$record['nama'] ?>" name="nama" placeholder="Masukkan Nama" required="true" autocomplete="off">
                  </div>

                  <div class="form-group" id="notifikasi_tmpt_lahir">
                    <label for="tmpt_lahir">Tempat Lahir</label>
                    <input type="text" class="form-control" id="tmpt_lahir" value="<?= @$record['tmpt_lahir'] ?>" name="tmpt_lahir" placeholder="Masukkan Tempat Lahir" required="true" autocomplete="off">
                  </div>

                  <div class="form-group" id="notifikasi_tgl_lahir">
                    <label for="tgl_lahir">Tanggal Lahir</label>
                    <input type="date" class="form-control" id="tgl_lahir" value="<?= @$record['tgl_lahir'] ?>" name="tgl_lahir" placeholder="Masukkan Tanggal Lahir" required="true" autocomplete="off">
                  </div>

                  <div class="form-group" id="notifikasi_jenis_kelamin">
                    <label for="jenis_kelamin">Jenis Kelamin</label>
                    <select class="custom-select d-block w-100" name="jenis_kelamin" id="jenis_kelamin" required>
                      <option value="Laki-laki" <?= is_selected(@$record['jenis_kelamin'], "Laki-laki") ?>>Laki-Laki
                      </option>
                      <option value="Perempuan" <?= is_selected(@$record['jenis_kelamin'], "Perempuan") ?>>Perempuan
                      </option>
                    </select>
                  </div>

                  <div class="form-group" id="notifikasi_alamat">
                    <label for="alamat">Alamat</label>
                    <input type="text" class="form-control" id="alamat" value="<?= @$record['alamat'] ?>" name="alamat" placeholder="Masukkan " required="true" autocomplete="off">
                  </div>

                  <div class="form-group" id="notifikasi_asl_sekolah">
                    <label for="asl_sekolah">Asal Sekolah</label>
                    <input type="text" class="form-control" id="asl_sekolah" value="<?= @$record['asl_sekolah'] ?>" name="asl_sekolah" placeholder="Masukkan " required="true" autocomplete="off">
                  </div>

                  <div class="form-group" id="notifikasi_no_tlpn">
                    <label for="no_tlpn">Nomor Telepon</label>
                    <input type="text" class="form-control" id="no_tlpn" value="<?= @$record['no_tlpn'] ?>" name="no_tlpn" placeholder="Masukkan " required="true" autocomplete="off">
                  </div>

                  <div class="form-group" id="notifikasi_email">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" value="<?= @$record['email'] ?>" name="email" placeholder="Masukkan " required="true" autocomplete="off">
                  </div>
                </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
                </div>
              </div>
            </form>

            <div class="col-md-6">
              <form method="post" action="edit" data-url="<?= site_url(" ubah/datanilai2") ?>" id="myForm2" enctype="multipart/form-data" accept-charset="utf-8" class="col-md-12">
                <?php
                $berkasnya = json_decode(@$nilai['berkas']);
                $status = json_decode(@$nilai['status']);
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
                      <td>
                        <?php $jenisnya = 'status_' . $value; ?>
                        <div id="pilihan-<?= $jenisnya ?>">
                          <p><?php
                              if (isset($berkasnya->$jenis)) {
                                $stat_nil = $status->$jenisnya ?? null;
                                if ($stat_nil) {
                                  if ($stat_nil ==  'terverifikasi') {
                                    echo "<span class='badge badge-success'>" . $stat_nil . "<span>";
                                  } else {
                                    echo "<span class='badge badge-danger'>" . $stat_nil . "<span>";
                                  }
                                } else {
                                  echo "Belum verifikasi";
                                } ?></p>
                        <?php } else {
                                echo "<span class='badge badge-danger'>Belum upload berkas<span>";
                              } ?>
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

              <form method="post" action="edit" data-url="<?= site_url("ubah/datamasuk") ?>" id="myForm3" enctype="multipart/form-data" accept-charset="utf-8" class="col-12">
                <div class="card card-success">
                  <div class="card-header">
                    <h3 class="card-title">Ubah Password</h3>
                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                      </button>
                    </div>
                  </div>

                  <div class="card-body">
                    <div class="form-group" id="notifikasi_username">
                      <label for="username">Username</label>
                      <input type="hidden" name="id" value="<?= @$record['id'] ?>">
                      <input type="text" class="form-control" id="username" value="<?= @$record['username'] ?>" name="username" placeholder="Masukkan Username" required="true" autocomplete="off">
                    </div>

                    <div class="form-group" id="notifikasi_password">
                      <label for="password">Password</label>
                      <input type="password" class="form-control" id="password" name="password" placeholder="Jika Merubah Password*">
                    </div>
                  </div>

                  <div class="card-footer">
                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
                  </div>
                </div>
              </form>
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

    function update_nilai() {
      var nil1 = Number($('#nilai_un').val())
      var nil2 = Number($('#nilai_raport').val())
      var nil3 = Number($('#nilai_ps').val())
      var nil4 = Number($('#nilai_pa').val())
      rata = (nil1 + nil2 + nil3 + nil4) / 4
      $('.rata-rata').html("Rata-rata: " + rata)
    }
    update_nilai()

    const form = document.querySelector('#myForm2');
    form.addEventListener('change', function() {
      update_nilai()
    });
  </script>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
  <?= view("admin/templates/head") ?>
  <!-- CSS -->
  <!-- TUTUP CSS -->
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    <?= view("admin/templates/atas") ?>
    <?= view("admin/templates/nav") ?>
    <div class="content-wrapper">
      <?= view("admin/templates/breadcump") ?>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <!-- FORM Data Diri -->
            <form method="post" action="edit" data-url="<?= site_url("admin/pendaftar/ubah/datapribadi") ?>" id="myForm" enctype="multipart/form-data" accept-charset="utf-8" class="col-6">
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
                      <option value="Laki-laki" <?= is_selected(@$record['jenis_kelamin'], "Laki-laki") ?>>Laki-Laki</option>
                      <option value="Perempuan" <?= is_selected(@$record['jenis_kelamin'], "Perempuan") ?>>Perempuan</option>
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

            <div class="col-6">
              <div class="row">

                <!-- FORM Data Nilai -->
                <form method="post" action="edit" data-url="<?= site_url("admin/pendaftar/ubah/datanilai") ?>" id="myForm2" enctype="multipart/form-data" accept-charset="utf-8" class="col-12">
                  <input type="hidden" name="id" value="<?= @$record['id'] ?>">

                  <div class="card card-success">
                    <div class="card-header">
                      <h3 class="card-title">Data Nilai</h3>
                      <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                        </button>
                      </div>
                    </div>

                    <?php
                    $berkasnya = json_decode($nilai['berkas']);
                    ?>

                    <div class="card-body">
                      <?php if (count((array)$berkasnya) != 5) { ?>
                        <div class="alert alert-warning" role="alert">
                          <p>Berkas peserta belum lengkap.</p>
                        </div>
                      <?php } ?>
                      <div class="form-group" id="notifikasi_nilai_un">
                        <label for="nilai_un">Nilai UN</label>
                        <input type="number" class="form-control" id="nilai_un" value="<?= @$nilai['nilai_un'] ?>" name="nilai_un" placeholder="Masukkan Nilai UN" required="true" autocomplete="off" min="1" max="100">
                        <span class="text-disabled">File: <?php if (isset($berkasnya->nilai_un)) { ?><a target="BLANK" href="<?= base_url('uploads/temp/' . $berkasnya->nilai_un) ?>">klik disini</a><?php } ?></span>
                      </div>

                      <div class="form-group" id="notifikasi_nilai_raport">
                        <label for="nilai_raport">Nilai Raport</label>
                        <input type="number" class="form-control" id="nilai_raport" value="<?= @$nilai['nilai_raport'] ?>" name="nilai_raport" placeholder="Masukkan Nilai Raport" required="true" autocomplete="off" min="1" max="100">
                        <span class="text-disabled">File: <?php if (isset($berkasnya->nilai_raport)) { ?><a target="BLANK" href="<?= base_url('uploads/temp/' . $berkasnya->nilai_raport) ?>">klik disini</a><?php } ?></span>
                      </div>

                      <div class="form-group" id="notifikasi_nilai_ps">
                        <label for="nilai_ps">Nilai PS</label>
                        <input type="number" class="form-control" id="nilai_ps" value="<?= @$nilai['nilai_ps'] ?>" name="nilai_ps" placeholder="Masukkan Nilai PS" required="true" autocomplete="off" min="1" max="100">
                        <span class="text-disabled">File: <?php if (isset($berkasnya->nilai_ps)) { ?><a target="BLANK" href="<?= base_url('uploads/temp/' . $berkasnya->nilai_ps) ?>">klik disini</a><?php } ?></span>
                      </div>

                      <div class="form-group" id="notifikasi_nilai_pa">
                        <label for="nilai_pa">Nilai PA</label>
                        <input type="number" class="form-control" id="nilai_pa" value="<?= @$nilai['nilai_pa'] ?>" name="nilai_pa" placeholder="Masukkan Nilai PA" required="true" autocomplete="off" min="1" max="100">
                        <span class="text-disabled">File: <?php if (isset($berkasnya->nilai_pa)) { ?><a target="BLANK" href="<?= base_url('uploads/temp/' . $berkasnya->nilai_pa) ?>">klik disini</a><?php } ?></span>
                      </div>

                      <div class="form-group" id="notifikasi_nilai_wawancara">
                        <label for="nilai_wawancara">Nilai Wawancara</label>
                        <input type="number" class="form-control" id="nilai_wawancara" value="<?= @$nilai['nilai_wawancara'] ?>" name="nilai_wawancara" placeholder="Masukkan Nilai Wawancara" required="true" autocomplete="off" min="1" max="100">
                        <span class="text-disabled">File: <?php if (isset($berkasnya->nilai_wawancara)) { ?><a target="BLANK" href="<?= base_url('uploads/temp/' . $berkasnya->nilai_wawancara) ?>">klik disini</a><?php } ?></span> <br>
                        <small class="text-muted small rata-rata">Rata-rata: </small>
                      </div>
                    </div>

                    <div class="card-footer">
                      <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
                    </div>

                  </div>
                </form>

                <!-- FORM Data Masuk -->
                <form method="post" action="edit" data-url="<?= site_url("admin/pendaftar/ubah/datamasuk") ?>" id="myForm3" enctype="multipart/form-data" accept-charset="utf-8" class="col-12">
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
        </div>
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <?= view("admin/templates/foot") ?>

  </div>
  <!-- ./wrapper -->
  <?= view("admin/templates/script") ?>
  <script>
    function update_nilai() {
      var nil1 = Number($('#nilai_un').val())
      var nil2 = Number($('#nilai_raport').val())
      var nil3 = Number($('#nilai_ps').val())
      var nil4 = Number($('#nilai_pa').val())
      var nil4 = Number($('#nilai_wawancara').val())
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
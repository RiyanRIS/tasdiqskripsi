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
                    <select class="custom-select d-block w-100" name="asl_sekolah" id="asl_sekolah" required>
                      <option value="">--- ASAL SEKOLAH ---</option>
                      <?php foreach ($smp as $val) { ?>
                        <option <?= $val['nama'] == $record['asl_sekolah'] ? 'selected' : '' ?> value="<?= $val['nama'] ?>"><?= $val['nama'] ?></option>
                      <?php } ?>
                    </select>
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

  </script>
</body>

</html>
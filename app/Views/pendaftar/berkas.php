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
            <!-- TABEL berkas peserta -->
            <div class="col-8">
              <div class="card card-success">
                <div class="card-header">
                  <h3 class="card-title">List Berkas <?= ucwords(@$record['nama']) ?></h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                    </button>
                  </div>
                </div>

                <div class="card-body">
                  <table id="datatable" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>NAMA BERKAS</th>
                        <th>STATUS</th>
                        <th>AKSI</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if ($berkas != null) {
                        foreach ($berkas as $key => $v) {
                          $tampil = ($v->jenis == "kk" ? "Kartu Keluarga" : ($v->jenis == 'akta' ? "Akta Kelahiran" : ($v->jenis == 'bukti' ? "Ijazah/Surat Keterangan Lulus" : "Dokumen Lain")));
                      ?>
                          <tr>
                            <td><?= ++$key ?></td>
                            <td><a target="_BLANK" href="<?= base_url('uploads/temp/' . $v->file) ?>"><?= $tampil ?></a></td>
                            <td>
                              <?php if ($v->status == "Terverifikasi") { ?>
                                <span class='badge badge-success'>Terverifikasi<span>
                                  <?php } else if ($v->status == "Ditolak") { ?>
                                    <span class='badge badge-danger'>Ditolak<span>
                                        <?php } else {
                                        if ($v->file) { ?>
                                          <span class='badge badge-warning'>Belum Dicek<span>
                                            <?php } else { ?>
                                              <span class='badge badge-danger'>Belum upload<span>
                                                <?php } ?>
                                              <?php } ?>
                            </td>
                            <td>
                              <a onclick="return confirm('Hapus Data?\nTindakan ini tidak dapat diurungkan.')" href="<?= site_url('ubah/berkas/hapus/' . $v->id_berkas) ?>" class="btn btn-sm btn-danger" title="Hapus"><i class="fa fa-trash"></i></a>
                            </td>
                          </tr>
                      <?php }
                      } ?>
                    </tbody>
                  </table>

                </div>
              </div>
            </div>

            <!-- FORM Berkas -->
            <form method="post" action="tambah" data-refresh="refresh" data-url="<?= site_url("tambah/berkas") ?>" id="myForm" enctype="multipart/form-data" accept-charset="utf-8" class="col-4">
              <div class="card card-success">

                <div class="card-header">
                  <h3 class="card-title">Upload Berkas</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                    </button>
                  </div>
                </div>

                <div class="card-body">
                  <div class="alert alert-info" role="alert">
                    <p>Wajib Upload berkas berikut:</p>
                    <ul>
                      <li>Ijazah/Surat keterangan lulus</li>
                      <li>Akta kelahiran</li>
                      <li>Kartu Keluarga</li>
                    </ul>
                    <p><strong>Mohon upload berkas dalam bentuk PDF</strong></p>
                    <p>Berkas yang anda upload dengan jenis yang sama akan menimpa yang lama</p>
                    <!-- <p class="mb-0">Hingga tanggal deatline berkas belum lengkap, akan dinyatakan gugur.</p> -->
                  </div>
                  <div class="form-group" id="notifikasi_nama">
                    <label for="nama">Jenis Berkas</label>
                    <input type="hidden" name="id" value="<?= @$record['id'] ?>">
                    <!-- <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama Berkas" required="true" autocomplete="off"> -->
                    <select name="jenis" id="" class="form-control" required="true">
                      <option value="">--PILIH JENIS DOKUMEN--</option>
                      <option value="kk">Kartu Keluarga</option>
                      <option value="akta">Akta Kelahiran</option>
                      <option value="bukti">Ijazah/Surat Keterangan Lulus</option>
                      <!-- <option value="lain">Lainya</option> -->
                    </select>
                  </div>

                  <div class="form-group" id="notifikasi_file">
                    <label for="file">File</label>
                    <input type="file" class="form-control" id="file" name="file" placeholder="Masukkan File" required="true" autocomplete="off">
                  </div>
                </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Upload</button>
                </div>
              </div>
            </form>

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
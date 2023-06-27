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
                  <div class="form-group" id="notifikasi_nama">
                    <label for="nama">Nama Berkas</label>
                    <input type="hidden" name="id" value="<?= @$record['id'] ?>">
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama Berkas" required="true" autocomplete="off">
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
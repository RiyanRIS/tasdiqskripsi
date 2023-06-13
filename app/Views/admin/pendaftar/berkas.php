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
          <!-- TABEL berkas peserta -->
          <div class="col-8">
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">List Berkas <a href="<?=site_url('admin/pendaftar')?>"><?=ucwords(@$record['nama'])?></a></h3>
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
                  <?php if($berkas != null){ 
                    foreach ($berkas as $key => $v) { ?>
                    <tr>
                      <td><?=++$key?></td>
                      <td><a target="_BLANK" href="<?=site_url('uploads/temp/' . $v->file)?>"><?=$v->nama?></a></td>
                      <td>
                        <?php if($v->status == "Terverifikasi"){ ?>
                          <span class='badge badge-success'>Terverifikasi<span>
                        <?php } else if($v->status == "Ditolak"){ ?>
                          <span class='badge badge-danger'>Ditolak<span>
                        <?php } else { ?>
                          <span class='badge badge-warning'>Belum Dicek<span>
                        <?php } ?>
                      </td>
                      <td>
                        <a onclick="return confirm('Hapus Data?\nTindakan ini tidak dapat diurungkan.')" href="<?=site_url('admin/pendaftar/ubah/berkas/hapus/' . $v->id_berkas)?>" class="btn btn-sm btn-danger"  title="Hapus"><i class="fa fa-trash"></i></a>

                        <div class="btn-group" role="group">
                          <button id="btnGroupDrop1" type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Status
                          </button>
                          <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                            <a class="dropdown-item" href="<?=site_url("admin/pendaftar/ubah/berkas/status/terverifikasi/".$v->id_berkas)?>">Terverifikasi</a>
                            <a class="dropdown-item" href="<?=site_url("admin/pendaftar/ubah/berkas/status/ditolak/".$v->id_berkas)?>">Ditolak</a>
                          </div>
                        </div>
                      </td>
                    </tr>
                  <?php }} ?>
                 </tbody>
                </table>

              </div>
            </div>
          </div>
        
          <!-- FORM Berkas -->
          <form method="post" action="tambah" data-refresh="refresh" data-url="<?=site_url("admin/pendaftar/tambah/berkas")?>" id="myForm" enctype="multipart/form-data" accept-charset="utf-8" class="col-4">
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
                  <input type="hidden" name="id" value="<?=@$record['id']?>">
                  <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama Berkas" required="true" autocomplete="off">
                </div>

                <div class="form-group" id="notifikasi_file">
                  <label for="file">File</label>
                  <input type="file" class="form-control" id="file" name="file" placeholder="Masukkan File" required="true" autocomplete="off">
                </div>
              </div>

              <div class="card-footer">
                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Upload</button>
                <a href="<?=site_url('admin/pendaftar')?>" class="btn btn-success">Kembali</a>
              </div>
            </div>
          </form>

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

</body>
</html>

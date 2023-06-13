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
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <!-- <h3 class="card-title">DataTable with minimal features & hover style</h3> -->
              <a target="_BLANK" href="<?=site_url('daftar')?>" class="btn btn-success">Tambah Peserta</a>
            </div>

            <div class="card-body">
              <table id="datatable" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>ID DAFTAR</th>
                    <th>NAMA</th>
                    <th>ASAL SEKOLAH</th>
                    <th>STATUS</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  foreach ($record as $key => $v) { ?>
                  <tr>
                    <td>
                      <a href="<?=site_url('admin/pendaftar/detail/' . $v['id'])?>" class="btn btn-sm btn-prim" title="Detail"><i class="fa fa-eye"></i></a>
                      <a href="<?=site_url('admin/pendaftar/berkas/' . $v['id'])?>" class="btn btn-sm btn-prim" title="Upload Berkas"><i class="fa fa-file-alt"></i></a>
                      <a onclick="return confirm('Cabut Berkas Untuk Peserta Ini?\nTindakan ini tidak dapat diurungkan.')" href="<?=site_url('admin/pendaftar/ubah/berkas/cabut/' . $v['id'])?>" class="btn btn-sm btn-danger" title="Cabut Berkas"><i class="fa fa-file-export"></i></a>
                      <button class="btn btn-sm btn-danger delete_data" title="Hapus data"><i class="fa fa-trash"></i></button>
                    </td>
                    <td><?=genId($v)?></td>
                    <td><?=$v['nama']?></td>
                    <td><?=$v['asl_sekolah']?></td>
                    <td>Lulus</td>
                  </tr>
                  <?php  } ?>
                </tbody>
              </table>

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

</body>
</html>

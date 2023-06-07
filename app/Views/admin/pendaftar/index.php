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
              <h3 class="card-title">DataTable with minimal features & hover style</h3>
            </div>

            <div class="card-body">
              <table id="datatable" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>NAMA</th>
                    <th>ASAL SEKOLAH</th>
                    <th>NILAI</th>
                    <th>STATUS</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  foreach ($record as $key => $v) { ?>
                  <tr>
                    <td>
                      <button class="btn btn-sm btn-info ubahModal" title="Ubah data"><i class="fa fa-pencil-alt"></i></button>
                      <button class="btn btn-sm btn-danger delete_data" title="Hapus data"><i class="fa fa-trash"></i></button>
                    </td>
                    <td><?=$v['nama']?></td>
                    <td><?=$v['asl_sekolah']?></td>
                    <td>87</td>
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

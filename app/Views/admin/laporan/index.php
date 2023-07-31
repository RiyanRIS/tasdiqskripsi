<?php
$cfg = new \SConfig();
$get = @$_GET;

?>
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

            </div>
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <form action="" method="get" class="row">
                    <div class="col-md-3 col-sm-6 mb-2 mb-md-0">
                      <select name="angkatan" id="angkatan" class="form-control">
                        <option value="">--Semua Angkatan--</option>
                        <?php foreach ($angkatans as $key => $v) { ?>
                          <option <?= is_selected(@$get['angkatan'], $v['id_angkatan']) ?> value="<?= $v['id_angkatan'] ?>"><?= $v['angkatan'] ?></option>
                        <?php } ?>
                      </select>
                    </div>

                    <div class="col-md-3 col-sm-6 mb-2 mb-md-0">
                      <select name="status" id="status" class="form-control">
                        <option value="">--Semua Status--</option>
                        <option <?= is_selected(@$get['status'], '1') ?> value="1">Lulus</option>
                        <option <?= is_selected(@$get['status'], '2') ?> value="0">Tidak Lulus</option>
                      </select>
                    </div>

                    <div class="col-md-3 col-sm-6 mb-2 mb-sm-0 mb-md-0">
                      <input type="submit" class="btn btn-success" value="Cari">
                    </div>
                  </form>
                </div>

                <div class="card-body">

                  <table id="tabelexport" class="table table-bordered table-hover table-pendaftar">
                    <thead>
                      <tr>
                        <th rowspan="2">NO</th>
                        <th rowspan="2">ID DAFTAR</th>
                        <th rowspan="2">NAMA</th>
                        <th rowspan="2">ASAL SEKOLAH</th>
                        <th colspan="5">NILAI</th>
                        <th rowspan="2">STATUS</th>
                      </tr>
                      <tr>
                        <th>UN</th>
                        <th>RAPORT</th>
                        <th>PS</th>
                        <th>PA</th>
                        <th>WAWANCARA</th>
                        <th>RATA RATA</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      foreach ($record as $key => $v) {
                      ?>
                        <tr>
                          <td><?= ++$key ?></td>
                          <td><?= genId($v) ?></td>
                          <td><?= $v['nama'] ?></td>
                          <td><?= $v['asl_sekolah'] ?></td>
                          <td><?= $v['nilai_un'] ?></td>
                          <td><?= $v['nilai_raport'] ?></td>
                          <td><?= $v['nilai_ps'] ?></td>
                          <td><?= $v['nilai_pa'] ?></td>
                          <td><?= $v['nilai_wawancara'] ?></td>
                          <td><?= $v['rata'] ?></td>
                          <td><?= ($v['rata'] > $cfg->_nilaiminim ? "<span class='badge badge-success'>Lulus<span>" : "<span class='badge badge-danger'>Tidak Lulus<span>") ?></td>
                        </tr>
                      <?php  } ?>
                    </tbody>
                  </table>

                </div>
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
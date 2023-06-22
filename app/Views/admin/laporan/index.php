<?php
  $cfg = new \SConfig();
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
              <div class="card-header row">
                <div class="col-md-3 col-sm-6 mb-2 mb-sm-0">
                  <select name="angkatan" id="angkatan" class="form-control">
                    <option value="">--Semua Angkatan--</option>
                    <?php foreach ($angkatans as $key => $v) { ?>
                      <option value="<?=$v['id_angkatan']?>"><?=$v['angkatan']?></option>
                    <?php } ?>
                  </select>
                </div>

                <div class="col-md-3 col-sm-6 mb-2 mb-sm-0">
                  <select name="angkatan" id="angkatan" class="form-control">
                    <option value="">--Semua Status--</option>
                    <option value="1">Lulus</option>
                    <option value="0">Tidak Lulus</option>
                  </select>
                </div>

                <div class="col-md-3 col-sm-6 mb-2 mb-sm-0 mb-md-0">
                  <input type="submit" class="btn btn-success" value="Cari">
                </div>
              </div>

              <div class="card-body">
              
                <table id="datatable" class="table table-bordered table-hover table-pendaftar">
                  <thead>
                    <tr>
                      <th>ID DAFTAR</th>
                      <th>NAMA</th>
                      <th>ASAL SEKOLAH</th>
                      <th>NILAI</th>
                      <th>STATUS</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      foreach ($record as $key => $v) {
                        $rata = genNilai($v);
                    ?>
                    <tr>
                      <td class="cell" data-id="<?=$v['id']?>"><?=genId($v)?></td>
                      <td class="cell" data-id="<?=$v['id']?>"><?=$v['nama']?></td>
                      <td class="cell" data-id="<?=$v['id']?>"><?=$v['asl_sekolah']?></td>
                      <td class="cell" data-id="<?=$v['id']?>"><?=$rata?></td>
                      <td class="cell" data-id="<?=$v['id']?>"><?=($rata > $cfg->_nilaiminim ? "<span class='badge badge-success'>Lulus<span>" : "<span class='badge badge-danger'>Tidak Lulus<span>")?></td>
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

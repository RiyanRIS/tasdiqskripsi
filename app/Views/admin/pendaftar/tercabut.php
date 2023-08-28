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
              <div class="card">
                <div class="card-header">
                  <a onclick="return confirm('Kosongkan sampah?\nTindakan ini tidak dapat diurungkan.')" href="<?= site_url('admin/pendaftar/ubah/berkas/cabutpermanen/') ?>" class="btn btn-sm btn-danger" title="Cabut Berkas"><i class="fa fa-trash"></i> Kosongkan Sampah</a>
                </div>

                <div class="card-body">

                  <table id="tabelexport" class="table table-bordered table-hover table-pendaftar">
                    <thead>
                      <tr>
                        <th>#</th>
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
                        $rata = $v['rata'];
                      ?>
                        <tr>
                          <td>
                            <a onclick="return confirm('Kembalikan Peserta Ini?')" href="<?= site_url('admin/pendaftar/ubah/berkas/balik/' . $v['id']) ?>" class="btn btn-sm btn-success" title="Cabut Berkas"><i class="fa fa-recycle"></i> Kembalikan</a>
                          </td>
                          <td class="cell" data-id="<?= $v['id'] ?>"><?= genId($v) ?></td>
                          <td class="cell" data-id="<?= $v['id'] ?>"><?= $v['nama'] ?></td>
                          <td class="cell" data-id="<?= $v['id'] ?>"><?= $v['asl_sekolah'] ?></td>
                          <td class="cell" data-id="<?= $v['id'] ?>"><?= $v['rata'] ?? 0 ?></td>
                          <td class="cell" data-id="<?= $v['id'] ?>"><?= ($v['rata'] > $cfg->_nilaiminim ? "<span class='badge badge-success'>Lulus<span>" : "<span class='badge badge-danger'>Tidak Lulus<span>") ?></td>
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
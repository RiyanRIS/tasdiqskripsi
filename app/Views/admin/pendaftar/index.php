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
              <div class="alert alert-info alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-info"></i> Info!</h5>
                Angkatan Aktif: <?= $angkatan ?> <br>
                Total Pendaftar: <?= count($record) ?> orang
              </div>
            </div>
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <a target="_BLANK" href="<?= site_url('daftar') ?>" class="btn btn-success">Tambah Peserta</a>
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
                        $rata = ($v['nilai_un'] + $v['nilai_raport'] + $v['nilai_ps'] + $v['nilai_pa']) / 4;
                      ?>
                        <tr>
                          <td>
                            <a href="<?= site_url('admin/pendaftar/detail/' . $v['id']) ?>" class="btn btn-sm btn-success" title="Detail"><i class="fa fa-eye"></i> Detail</a>
                            <!-- <a href="<?= site_url('admin/pendaftar/berkas/' . $v['id']) ?>" class="btn btn-sm btn-success" title="Upload Berkas"><i class="fa fa-file-alt"></i></a> -->
                            <a href="<?= site_url('admin/pendaftar/cetak/' . $v['id']) ?>" class="btn btn-sm btn-success" title="Cetak Data"><i class="fa fa-print"></i> Cetak</a>
                            <a onclick="return confirm('Cabut Berkas Untuk Peserta Ini?\nTindakan ini tidak dapat diurungkan.')" href="<?= site_url('admin/pendaftar/ubah/berkas/cabut/' . $v['id']) ?>" class="btn btn-sm btn-danger" title="Cabut Berkas"><i class="fa fa-file-export"></i> Cabut Berkas</a>
                            <!-- <a onclick="return confirm('Hapus Peserta Ini?\nTindakan ini tidak dapat diurungkan.')" href="<?= site_url('admin/pendaftar/hapus/' . $v['id']) ?>" class="btn btn-sm btn-danger" title="Hapus data"><i class="fa fa-trash"></i> Hapus</a> -->
                          </td>
                          <td class="cell" data-id="<?= $v['id'] ?>"><?= genId($v) ?></td>
                          <td class="cell" data-id="<?= $v['id'] ?>"><?= $v['nama'] ?></td>
                          <td class="cell" data-id="<?= $v['id'] ?>"><?= $v['asl_sekolah'] ?></td>
                          <td class="cell" data-id="<?= $v['id'] ?>"><?= $rata ?></td>
                          <td class="cell" data-id="<?= $v['id'] ?>"><?= ($rata > $cfg->_nilaiminim ? "<span class='badge badge-success'>Lulus<span>" : "<span class='badge badge-danger'>Tidak Lulus<span>") ?></td>
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
  <script>
    $('#datatable.table-pendaftar tbody').on('click', '.cell', function() {
      var id = $(this).data("id");
      window.location.href = '<?= site_url('admin/pendaftar/detail/') ?>' + id
    });
  </script>
</body>

</html>
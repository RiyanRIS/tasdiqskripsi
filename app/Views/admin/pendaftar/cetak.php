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
                <div class="card-body">

                  <table id="tabelexport2" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td><?= $pribadi['nama'] ?></td>
                      </tr>
                      <tr>
                        <td>Tempat/Tanggal Lahir</td>
                        <td>:</td>
                        <td><?= $pribadi['tmpt_lahir'] ?>/<?= date('d-F-Y', strtotime($pribadi['tgl_lahir'])) ?></td>
                      </tr>
                      <tr>
                        <td>Jenis Kelamin</td>
                        <td>:</td>
                        <td><?= $pribadi['jenis_kelamin'] ?></td>
                      </tr>
                      <tr>
                        <td>Alamat</td>
                        <td>:</td>
                        <td><?= $pribadi['alamat'] ?></td>
                      </tr>
                      <tr>
                        <td>No. Telp</td>
                        <td>:</td>
                        <td><?= $pribadi['no_tlpn'] ?></td>
                      </tr>
                      <tr>
                        <td>Jurusan</td>
                        <td>:</td>
                        <td><?= $pribadi['jurusan'] ?></td>
                      </tr>
                      <?php $nilai = @$nilai[0]; ?>
                      <tr>
                        <td>NILAI Ujian Nasional MATEMATIKA</td>
                        <td>:</td>
                        <td><?= $nilai['un_mat'] ?? 0 ?></td>
                      </tr>
                      <tr>
                        <td>NILAI Ujian Nasional B. INDONESIA</td>
                        <td>:</td>
                        <td><?= $nilai['un_bi'] ?? 0 ?></td>
                      </tr>
                      <tr>
                        <td>NILAI Ujian Nasional IPA</td>
                        <td>:</td>
                        <td><?= $nilai['un_ipa'] ?? 0 ?></td>
                      </tr>
                      <tr>
                        <td>NILAI Ujian Nasional B. INGGRIS</td>
                        <td>:</td>
                        <td><?= $nilai['un_bing'] ?? 0 ?></td>
                      </tr>
                      <tr>
                        <td>PRAKTIK SHOLAT</td>
                        <td>:</td>
                        <td><?= $nilai['nilai_ps'] ?? 0 ?></td>
                      </tr>
                      <tr>
                        <td>PRAKTIK AL QURAN</td>
                        <td>:</td>
                        <td><?= $nilai['nilai_pa'] ?? 0 ?></td>
                      </tr>
                      <tr>
                        <td>WAWANCARA</td>
                        <td>:</td>
                        <td><?= $nilai['nilai_wawancara'] ?? 0 ?></td>
                      </tr>
                      <tr>
                        <td>Rata-rata</td>
                        <td>:</td>
                        <td><?= $nilai['rata'] ?? 0 ?></td>
                      </tr>
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
<!DOCTYPE html>
<html lang="en">

<head>
    <?= view("templates/head") ?>
    <!-- CSS -->
    <style>
        .image-upload>input {
            display: none;
        }
    </style>
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

                        <div class="col-md-12">
                            <div class="alert alert-info" role="alert">
                                <p>Aturan pengisian formulir</p>
                                <ul>
                                    <li>Formulir data nilai wajib diisi dengan angka 1-100</li>
                                    <li>Lalu upload bukti yang menerangkan nilai anda(wajib)</li>
                                    <li>Ukuran file bukti maksimal 2mb dengan format pdf atau image(jpg, png, jpeg)</li>
                                    <li>Untuk mendapatkan nilai tes, harap datang ke MAN 1 GAYO LUES pada jam kerja, selanjutnya cek halaman ini untuk melihat nilai tes anda.</li>
                                    <li>Selalu cek status nilai anda, pastikan telah diverifikasi oleh admin.</li>
                                </ul>
                            </div>
                            <form method="post" action="edit" data-refresh="refresh" data-url="<?= site_url("ubah/datanilai2") ?>" id="myForm2" enctype="multipart/form-data" accept-charset="utf-8" class="col-md-12">
                                <?php
                                $berkasnya = json_decode(@$nilai['berkas']);
                                $status = json_decode(@$nilai['status']);
                                ?>
                                <input type="hidden" name="id" value="<?= session()->user_id ?>">

                                <table class="table table-bordered">
                                    <tr style="background-color: #28a745;color: #fff;">
                                        <th>Data Nilai</th>
                                        <th>Upload Bukti</th>
                                        <th>Status</th>
                                    </tr>
                                    <?php
                                    $jenis_nilai = ['un_mat', 'un_bi', 'un_ipa', 'un_bing'];
                                    $nama_nilai = ['Nilai Ujian Nasional Matematika', 'Nilai Ujian Nasional Bahasa Indonesia', 'Nilai Ujian Nasional Ilmu Pengetahuan Alam', 'Nilai Ujian Nasional Bahasa Inggris'];
                                    foreach ($jenis_nilai as $key => $value) {
                                        $jenis = $value;
                                        $nama = $nama_nilai[$key]; ?>
                                        <tr>
                                            <td>
                                                <div class="form-group col-12" id="notifikasi_<?= $jenis ?>">
                                                    <label for="<?= $jenis ?>"><?= $nama ?></label>
                                                    <input type="number" class="form-control" id="<?= $jenis ?>" value="<?= @$nilai[$jenis] ?>" name="<?= $jenis ?>" placeholder="Masukkan <?= $nama ?>" required="true" autocomplete="off" min="1" max="100">
                                                </div>
                                            </td>
                                            <td>
                                                <div id="pilihan-<?= $jenis ?>">
                                                    <p>File: <?php if ($berkasnya->$jenis != "Belum upload") {
                                                                ?><a target="BLANK" href="<?= base_url('uploads/temp/' . $berkasnya->$jenis) ?>">klik disini</a><?php } ?></p>
                                                </div>
                                                <div class="image-upload">
                                                    <label for="file-<?= $jenis ?>">
                                                        <i class="mt-1 ml-5 fa fa-upload fa-3x"></i>
                                                    </label>

                                                    <input id="file-<?= $jenis ?>" type="file" name="file<?= $jenis ?>" />
                                                </div>
                                            </td>
                                            <td>
                                                <?php $jenisnya = 'status_' . $value; ?>
                                                <div id="pilihan-<?= $jenisnya ?>">
                                                    <p><?php
                                                        if (isset($berkasnya->$jenis)) {
                                                            $stat_nil = $status->$jenisnya ?? null;
                                                            if ($stat_nil) {
                                                                if ($stat_nil ==  'terverifikasi') {
                                                                    echo "<span class='badge badge-success'>" . $stat_nil . "<span>";
                                                                } else {
                                                                    echo "<span class='badge badge-danger'>" . $stat_nil . "<span>";
                                                                }
                                                            } else {
                                                                echo "Belum verifikasi";
                                                            } ?></p>
                                                <?php } else {
                                                            echo "<span class='badge badge-danger'>Belum upload berkas<span>";
                                                        } ?>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php } ?>

                                    <?php
                                    $jenis_nilai2 = ['nilai_pa', 'nilai_ps', 'nilai_wawancara'];
                                    $nama_nilai2 = ['Nilai Tes Praktek pembacaan al quran', 'Nilai Tes Praktik Sholat', 'Nilai Tes Wawancara'];
                                    foreach ($jenis_nilai2 as $key => $value) {
                                        $jenis = $value;
                                        $nama = $nama_nilai2[$key]; ?>

                                        <tr>
                                            <td colspan="3">
                                                <div class="form-group col-12" id="notifikasi_<?= $jenis ?>">
                                                    <label for="<?= $jenis ?>"><?= $nama ?></label>
                                                    <input disabled title="Diisi Oleh Admin" type="text" class="form-control" id="<?= $jenis ?>" value="<?= $nilai[$jenis] != 0 ? $nilai[$jenis] : "Datang ke sekolah untuk mendapatkan nilai" ?>" name="<?= $jenis ?>" placeholder="<?= $nilai[$jenis] != 0 ? $nilai[$jenis] : "Datang ke sekolah untuk melakukan tes" ?>" required="true" autocomplete="off" min="1" max="100">
                                                </div>
                                            </td>
                                        <tr>

                                        <?php } ?>
                                        <tr>
                                            <td colspan='3'>
                                                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
                                            </td>
                                        </tr>
                                </table>
                            </form>

                        </div>

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
    <script>
        <?php foreach ($jenis_nilai as $key => $value) { ?>
            const file_<?= $value ?> = document.getElementById("file-<?= $value ?>");

            file_<?= $value ?>.addEventListener("change", function() {
                const selectedFiles = file_<?= $value ?>.files;
                if (selectedFiles.length > 0) {
                    html = "<p>File: " + selectedFiles[0].name + "</p>";
                    $('#pilihan-<?= $value ?>').html(html)
                } else {
                    html = "<p>File: - </p>";
                    $('#pilihan-<?= $value ?>').html(html)
                }
            });
        <?php } ?>

        function update_nilai() {
            var nil1 = Number($('#nilai_un').val())
            var nil2 = Number($('#nilai_raport').val())
            var nil3 = Number($('#nilai_ps').val())
            var nil4 = Number($('#nilai_pa').val())
            rata = (nil1 + nil2 + nil3 + nil4) / 4
            $('.rata-rata').html("Rata-rata: " + rata)
        }
        update_nilai()

        const form = document.querySelector('#myForm2');
        form.addEventListener('change', function() {
            update_nilai()
        });
    </script>
</body>

</html>
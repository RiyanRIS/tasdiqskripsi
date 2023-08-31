<?php

function is_selected($a, $b)
{
    if ($a == $b) {
        echo "selected";
    }
}

function genNilai($v): int
{
    return ($v['un_mat'] + $v['un_bi'] + $v['un_ipa'] + $v['un_bing'] + $v['nilai_ps'] + $v['nilai_pa'] + $v['nilai_wawancara']) / 7;
}

function genId($v)
{
    echo $v['tahun'] . str_pad($v['id'], 4, "0", STR_PAD_LEFT);
}

function ubahFormatTanggal($tanggal)
{
    $bulanIndonesia = array(
        1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
        5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
        9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
    );

    $tanggalArray = explode('-', $tanggal);

    if (count($tanggalArray) === 3) {
        $tahun = $tanggalArray[0];
        $bulan =  (int)$tanggalArray[1];
        $hari = $tanggalArray[2];

        $bulanIndo = $bulanIndonesia[$bulan];

        $tanggalFormatIndo = "$hari $bulanIndo $tahun";
        return $tanggalFormatIndo;
    }
    return "-";
}

function hilangkanNolDiDepan($angka)
{
    if ($angka === '0') {
        return $angka;
    }

    return ltrim($angka, '0');
}


function genId1($v)
{
    print_r($v);
    die();
    // echo $v['tahun'] . "_" . ($v['jurusan'] == 'IPA' ? 'A' : 'B') . str_pad($v['id'], 4, "0", STR_PAD_LEFT);
}

// 0 = belum dibuka, 1 = pendaftaran, 2 = pengumuman
function mode_sistem($angkatan, $now = false)
{
    $date_now = $now ? $now : date("Y-m-d");
    $status = 0;
    if ($date_now >= $angkatan->tgl_buka && $date_now <= $angkatan->tgl_tutup) {
        $status = 1;
    }
    if ($date_now >= $angkatan->tgl_pengumuman) {
        $status = 2;
    }
    return $status;
}

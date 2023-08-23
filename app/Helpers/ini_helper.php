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

function genId1($v)
{
    print_r($v);
    die();
    // echo $v['tahun'] . "_" . ($v['jurusan'] == 'IPA' ? 'A' : 'B') . str_pad($v['id'], 4, "0", STR_PAD_LEFT);
}

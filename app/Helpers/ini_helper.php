<?php

function is_selected($a, $b){
  if($a == $b){
    echo "selected";
  }
}

function genNilai($v):int{
  return ($v['nilai_un'] + $v['nilai_raport'] + $v['nilai_ps'] + $v['nilai_pa']) / 4;
}

function genId($v){
  echo $v['tahun']."_".($v['jurusan'] == 'IPA' ? 'A' : 'B').str_pad($v['id'], 4, "0", STR_PAD_LEFT);
}
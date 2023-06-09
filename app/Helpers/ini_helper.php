<?php

function is_selected($a, $b){
  if($a == $b){
    echo "selected";
  }
}

function genId($v){
  echo $v['tahun']."_".($v['jurusan'] == 'IPA' ? 'A' : 'B').str_pad($v['id'], 4, "0", STR_PAD_LEFT);
}
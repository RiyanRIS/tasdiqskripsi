<?php

namespace App\Controllers\Admin;
use App\Controllers\BaseController;

class Home extends BaseController
{
    public function index()
    {
        if(!$this->isSecure()) return redirect()->to(site_url('/admin/login'));

        $pendaftars = $this->pribadi->join('tbl_nilai', 'tbl_nilai.id_dt_pribadi = tbl_dt_pribadi.id')->find();
        // print_r($pendaftars);die();
        $total = count($pendaftars);

        $laporan = [];
        $ipa = $ips = $lulus = $tidak_lulus = 0;
        foreach ($pendaftars as $key => $v) {
            if($v['jurusan'] == 'IPA') $ipa++;
            if($v['jurusan'] == 'IPS') $ips++;
            (genNilai($v) > $this->cfg->_nilaiminim ? $lulus++ : $tidak_lulus++); 
        }

        $laporan = [
            'ipa' => $ipa,
            'ips' => $ips,
            'total' => $total,
            'lulus' => $lulus,
            'tidak_lulus' => $tidak_lulus,
        ];

        // echo "<br>Total: " . $total;
        // echo "<br>Total Lulus: " . $lulus;
        // echo "<br>Total Tidak Lulus: " . $tidak_lulus;
        // die();

        $data = [
            "laporan" => $laporan,
            "angkatans" => $this->angkatan->where('isDelete', null)->orderby('tahun', 'DESC')->find(),
            "judul" => "Dashboard"
        ];

        return view('admin/home/index', $data);
    }

}

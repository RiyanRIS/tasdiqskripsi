<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Home extends BaseController
{
    public function index()
    {
        if (!$this->isSecure()) return redirect()->to(site_url('/admin/login'));

        $pendaftars = $this->pribadi->find_now();

        $total = count($pendaftars);

        $laporan = [];
        $ipa = $ips = $lulus = $tidak_lulus = 0;
        foreach ($pendaftars as $key => $v) {
            ($v['rata'] > $this->cfg->_nilaiminim ? $lulus++ : $tidak_lulus++);
        }

        $laporan = [
            'total' => $total,
            'lulus' => $lulus,
            'tidak_lulus' => $tidak_lulus,
        ];

        $data = [
            "laporan" => $laporan,
            'sisa' => $this->cfg->_kuota - count($pendaftars),
            "angkatans" => $this->angkatan->where('isDelete', null)->orderby('tahun', 'DESC')->find(),
            "judul" => "Dashboard"
        ];

        return view('admin/home/index', $data);
    }
}

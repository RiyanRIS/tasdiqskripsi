<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Laporan extends BaseController
{
    public function index()
    {
        if (!$this->isSecure()) return redirect()->to(site_url('/admin/login'))->with('msg', [0, 'Sesi anda telah kadaluarsa.']);

        $record = $this->pribadi->table('tbl_dt_pribadi');

        if (@$_GET['angkatan']) {
            $record = $record->where('tbl_dt_pribadi.id_angkatan', $_GET['angkatan']);
        }

        if (@$_GET['status'] == 1) {
            $record = $record->where('tbl_nilai.rata >', $this->cfg->_nilaiminim);
        } else if (@$_GET['status'] == 2) {
            $record = $record->where('tbl_nilai.rata <', $this->cfg->_nilaiminim);
        }

        $record = $record->join('tbl_angkatan', 'tbl_angkatan.id_angkatan = tbl_dt_pribadi.id_angkatan')
            ->join('tbl_nilai', 'tbl_nilai.id_dt_pribadi = tbl_dt_pribadi.id')
            ->orderby('tbl_nilai.rata', 'DESC')
            ->get()
            ->getResultArray();

        $data = [
            "record" => $record,
            "angkatans" => $this->angkatan->find_active(),
            "judul" => "Laporan"
        ];

        return view('admin/laporan/index', $data);
    }
}

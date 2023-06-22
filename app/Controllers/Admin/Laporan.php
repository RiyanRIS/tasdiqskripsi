<?php

namespace App\Controllers\Admin;
use App\Controllers\BaseController;

class Laporan extends BaseController
{
    public function index()
    {
        if(!$this->isSecure()) return redirect()->to(site_url('/admin/login'))->with('msg', [0, 'Sesi anda telah kadaluarsa.']);

        // $data = $this->angkatan->find_active();
        // print_r($data); die();

        $data = [
            "record" => $this->pribadi->find_now(),
            "angkatans" => $this->angkatan->find_active(),
            "judul" => "Laporan"
        ];

        return view('admin/laporan/index', $data);
    }

}

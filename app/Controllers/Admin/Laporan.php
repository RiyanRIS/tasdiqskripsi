<?php

namespace App\Controllers\Admin;
use App\Controllers\BaseController;

class Laporan extends BaseController
{
    public function index()
    {
        if($this->isSecure()) return redirect()->to(site_url('/admin/login'))->with('msg', [0, 'Sesi anda telah kadaluarsa.']);

        $data = [
            "judul" => "Laporan"
        ];

        return view('admin/laporan/index', $data);
    }

}

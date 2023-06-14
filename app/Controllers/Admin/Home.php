<?php

namespace App\Controllers\Admin;
use App\Controllers\BaseController;

class Home extends BaseController
{
    public function index()
    {
        if(!$this->isSecure()) return redirect()->to(site_url('/admin/login'))->with('msg', [0, 'Sesi anda telah kadaluarsa.']);

        $data = [
            "angkatans" => $this->angkatan->where('isDelete', null)->orderby('tahun', 'DESC')->find(),
            "judul" => "Dashboard"
        ];

        return view('admin/home/index', $data);
    }

}

<?php

namespace App\Controllers\Admin;
use App\Controllers\BaseController;

class Home extends BaseController
{
    public function index()
    {
        // var_dump(session()->get());
        // var_dump($this->isSecure()); die();
        if(!$this->isSecure()) return redirect()->to(site_url('/admin/login'))->with('msg', [0, 'Sesi anda telah kadaluarsa.']);

        $data = [
            "judul" => "Dashboard"
        ];

        return view('admin/home/index', $data);
    }

}

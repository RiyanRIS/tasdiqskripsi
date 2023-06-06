<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        if($this->isSecure('user')) return redirect()->to(site_url('login'))->with('msg', [0, 'Sesi anda telah kadaluarsa.']);

        return "Belum jadi bre... <a href='/login'>klik disini</a>";
        // return view('welcome_message');
    }
}

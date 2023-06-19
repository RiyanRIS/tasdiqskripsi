<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        // var_dump(session()->get());
        // var_dump($this->isSecure('user')); die();
        if(!$this->isSecure('user')) return redirect()->to(site_url('login'))->with('msg', [0, 'Sesi anda telah kadaluarsa.']);

        return "Belum jadi bre... <a href='/login'>klik disini</a>";
        // return view('welcome_message');
    }

    public function pendaftar()
    {
        if(!$this->isSecure('user')) return redirect()->to(site_url('/login'))->with('msg', [0, 'Sesi anda telah kadaluarsa.']);

        $id = session()->get('user_id');
        $data = [
            "record" => $this->pribadi->find($id),
            "nilai" => $this->nilai->find($id),
            "judul" => "Halaman Pendaftar"
        ];

        return view('pendaftar/detail', $data);
    }

    public function berkas()
    {
        if(!$this->isSecure('user')) return redirect()->to(site_url('/login'))->with('msg', [0, 'Sesi anda telah kadaluarsa.']);

        $id = session()->get('user_id');
        $data = [
            "record" => $this->pribadi->find($id),
            "berkas" => $this->berkas->getByUser($id),
            "judul" => "Halaman Berkas"
        ];

        return view('pendaftar/berkas', $data);
    }
}

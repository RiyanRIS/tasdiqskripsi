<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $angkatan = $this->angkatan->isActive();
        $date_now = date('Y-m-d');
        // $date_now = "2023-03-20"; // ubah ini untuk tes
        $status = 0; // 1=masa pendaftaran, 2=pengumuman

        if ($date_now >= $angkatan->tgl_buka && $date_now <= $angkatan->tgl_tutup) {
            $status = 1;
        }
        if ($date_now >= $angkatan->tgl_pengumuman) {
            $status = 2;
        }
        $data = [
            'status' => $status,
            'angkatan' => $angkatan,
        ];
        return view('index', $data);
    }

    public function alur()
    {
        return view('alur');
    }

    public function jadwal()
    {
        $angkatan = $this->angkatan->isActive();
        $date_now = date('Y-m-d');
        // $date_now = "2023-03-20"; // ubah ini untuk tes
        $status = 0; // 1=masa pendaftaran, 2=pengumuman

        if ($date_now >= $angkatan->tgl_buka && $date_now <= $angkatan->tgl_tutup) {
            $status = 1;
        }
        if ($date_now >= $angkatan->tgl_pengumuman) {
            $status = 2;
        }
        $data = [
            'status' => $status,
            'angkatan' => $angkatan,
        ];
        return view('jadwal', $data);
    }

    public function persyaratan()
    {
        return view('persyaratan');
    }

    public function dashboard()
    {
        if (!$this->isSecure('user')) return redirect()->to(site_url('login'))->with('msg', [0, 'Sesi anda telah kadaluarsa.']);

        $id = session()->get('user_id');
        $v = @$this->nilai->getBySiswa($id)[0];
        $status_peserta = false;

        if ($v) {
            if (genNilai($v) > $this->cfg->_nilaiminim) {
                $status_peserta = true;
            }
        }

        $data = [
            "nilai" => $v,
            "pribadi" => $this->pribadi->find($id),
            "berkas" => $this->berkas->getByUser($id),
            "status_peserta" => $status_peserta,
            "judul" => "Dashboard Peserta"
        ];

        return view('pendaftar/dashboard', $data);
    }

    public function pengumuman()
    {
        if (!$this->isSecure('user')) return redirect()->to(site_url('login'))->with('msg', [0, 'Sesi anda telah kadaluarsa.']);

        $id = session()->get('user_id');
        $v = @$this->nilai->getBySiswa($id)[0];
        $status_peserta = false;

        if ($v) {
            if (genNilai($v) > $this->cfg->_nilaiminim) {
                $status_peserta = true;
            }
        }

        $status = "Belum waktunya pengumuman";

        $angkatan = $this->angkatan->isActive();
        $tgl_now = date("Y-m-d");
        if ($angkatan->tgl_pengumuman <= $tgl_now) {
            if ($status_peserta) {
                $status = "Anda lulus";
            } else {
                $status = "Anda tidak lulus";
            }
        }

        $data = [
            "nilai" => $v,
            "pribadi" => $this->pribadi->find($id),
            "berkas" => $this->berkas->getByUser($id),
            "status_peserta" => $status_peserta,
            "judul" => $status
        ];

        return view('pendaftar/pengumuman', $data);
    }

    public function pendaftar()
    {
        if (!$this->isSecure('user')) return redirect()->to(site_url('/login'))->with('msg', [0, 'Sesi anda telah kadaluarsa.']);

        $id = session()->get('user_id');
        $data = [
            "record" => $this->pribadi->find($id),
            "nilai" => @$this->nilai->getBySiswa($id)[0],
            "judul" => "Halaman Pendaftar"
        ];

        return view('pendaftar/detail', $data);
    }

    public function berkas()
    {
        if (!$this->isSecure('user')) return redirect()->to(site_url('/login'))->with('msg', [0, 'Sesi anda telah kadaluarsa.']);

        $id = session()->get('user_id');
        $data = [
            "record" => $this->pribadi->find($id),
            "berkas" => $this->berkas->getByUser($id),
            "judul" => "Halaman Berkas"
        ];

        return view('pendaftar/berkas', $data);
    }
}

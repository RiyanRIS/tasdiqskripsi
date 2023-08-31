<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $angkatan = $this->angkatan->isActive();
        $data = [
            'status' => mode_sistem($angkatan),
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

        $data = [
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
        $v = $this->nilai->getBySiswa($id)[0];
        $pesan = 0;

        $status_nilai = json_decode($v['status']);
        $bukti_nilai = json_decode($v['berkas']);

        // cek berkas nilai peserta
        $statu_res = true;
        $jenis_nilai = ['un_mat', 'un_bi', 'un_ipa', 'un_bing'];
        foreach ($jenis_nilai as $key => $value) {
            $jenisnya = 'status_' . $value;
            $stat_nil = $status_nilai->$jenisnya ?? null;
            if ($stat_nil !=  'terverifikasi') {
                $statu_res = false;
            }
        }

        if (!$statu_res) {
            $pesan = 2;
        }

        // cek verifikasi berkas
        $status_berkas = true;
        $berkas = $this->berkas->getByUser($id);
        foreach ($berkas as $key => $value) {
            if ($value->status != "Terverifikasi") $status_berkas = false;
        }

        if (!$status_berkas) {
            $pesan = 5;
        }

        // cek nilai admin
        $status_nil = true;
        $jenis_nilai_admin = ['nilai_ps', 'nilai_pa', 'nilai_wawancara'];
        foreach ($jenis_nilai_admin as $k => $val) {
            if ($v[$val] == 0) $status_nil = false;
        }

        if (!$status_nil) {
            $pesan = 4;
        }

        // cek berkas
        $status_berkas = true;
        $berkas = $this->berkas->getByUser($id);
        foreach ($berkas as $key => $value) {
            if ($value->file == null) $status_berkas = false;
        }

        if (!$status_berkas) {
            $pesan = 3;
        }

        // cek nilai
        if ($bukti_nilai->un_mat == 'Belum upload') {
            $pesan = 1;
        }

        $pribadi = $this->pribadi->find($id);

        $data = [
            "pesan" => $pesan,
            'status_berkas' => $status_nilai,
            "berkasnya" => $bukti_nilai,
            "nilai" => $v,
            "pribadi" => $pribadi,
            "berkas" => $berkas,
            "judul" => "Dashboard Peserta"
        ];

        return view('pendaftar/dashboard', $data);
    }

    public function pengumuman()
    {
        if (!$this->isSecure('user')) return redirect()->to(site_url('login'))->with('msg', [0, 'Sesi anda telah kadaluarsa.']);

        $id = session()->get('user_id');
        $v = $this->nilai->getBySiswa($id)[0];
        $pesan = 0;

        $status_nilai = json_decode($v['status']);
        $bukti_nilai = json_decode($v['berkas']);

        // cek berkas nilai peserta
        $statu_res = true;
        $jenis_nilai = ['un_mat', 'un_bi', 'un_ipa', 'un_bing'];
        foreach ($jenis_nilai as $key => $value) {
            $jenisnya = 'status_' . $value;
            $stat_nil = $status_nilai->$jenisnya ?? null;
            if ($stat_nil !=  'terverifikasi') {
                $statu_res = false;
            }
        }

        if (!$statu_res) {
            $pesan = 2;
        }

        // cek verifikasi berkas
        $status_berkas = true;
        $berkas = $this->berkas->getByUser($id);
        foreach ($berkas as $key => $value) {
            if ($value->status != "Terverifikasi") $status_berkas = false;
        }

        if (!$status_berkas) {
            $pesan = 5;
        }

        // cek nilai admin
        $status_nil = true;
        $jenis_nilai_admin = ['nilai_ps', 'nilai_pa', 'nilai_wawancara'];
        foreach ($jenis_nilai_admin as $k => $val) {
            if ($v[$val] == 0) $status_nil = false;
        }

        if (!$status_nil) {
            $pesan = 4;
        }

        // cek berkas
        $status_berkas = true;
        $berkas = $this->berkas->getByUser($id);
        foreach ($berkas as $key => $value) {
            if ($value->file == null) $status_berkas = false;
        }

        if (!$status_berkas) {
            $pesan = 3;
        }

        // cek nilai
        if ($bukti_nilai->un_mat == 'Belum upload') {
            $pesan = 1;
        }

        $pengumuman = true;
        $angkatan = $this->angkatan->isActive();
        if ($angkatan->tgl_pengumuman <= date('Y-m-d')) {
            $pengumuman = false;
        }

        $lulus = false;
        if ($v['rata'] >= $this->cfg->_nilaiminim)
            $lulus = true;

        $pribadi = $this->pribadi->find_noww($id)[0];

        $data = [
            "pesan" => $pesan,
            'status_berkas' => $status_nilai,
            "berkasnya" => $bukti_nilai,
            "nilai" => $v,
            "pribadi" => $pribadi,
            "berkas" => $berkas,
            "judul" => "Halaman Pengumuman",
            "pengumuman" => $pengumuman,
            "lulus" => $lulus
        ];

        return view('pendaftar/pengumuman', $data);
    }

    public function pendaftar()
    {
        if (!$this->isSecure('user')) return redirect()->to(site_url('/login'))->with('msg', [0, 'Sesi anda telah kadaluarsa.']);

        $id = session()->get('user_id');
        $smp = $this->smp->find();
        $data = [
            "record" => $this->pribadi->find($id),
            "nilai" => @$this->nilai->getBySiswa($id)[0],
            "smp" => $smp,
            "judul" => "Halaman Pendaftar"
        ];

        return view('pendaftar/detail', $data);
    }

    public function nilai()
    {
        if (!$this->isSecure('user')) return redirect()->to(site_url('/login'))->with('msg', [0, 'Sesi anda telah kadaluarsa.']);

        $id = session()->get('user_id');
        $data = [
            "nilai" => @$this->nilai->getBySiswa($id)[0],
            "judul" => "Halaman Nilai"
        ];

        return view('pendaftar/nilai', $data);
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

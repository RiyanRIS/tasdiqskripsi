<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Auth extends BaseController
{
	public function index()
	{
		return view('welcome_message');
	}

	public function login()
	{
		$angkatan = $this->angkatan->isActive();
		$status = mode_sistem($angkatan);
		if ($status == 0) {
			return redirect()->back()->with('msg', [0, "Pendaftaran belum dibuka."]);
		}

		if (session()->islogin) {
			return redirect()->to(site_url("admin"));
		}

		$username = '';

		$this->validation->setRule('username', "Username", 'required');
		$this->validation->setRule('password', "Password", 'required');
		if ($this->request->getPost() && $this->validation->withRequest($this->request)->run()) {
			$username =  (string)$this->request->getVar('username');
			$password =  (string)$this->request->getVar('password');

			if ($this->authuser->login($username, $password)) {
				$data_user = $this->pribadi->getByUsername($username);
				if (session()->isAdmin) {
					return redirect()->to(site_url("admin"))->with('msg', [1, "Selamat datang, " . $data_user->nama]);
				} else {
					if ($data_user->deleted_at == null) {
						return redirect()->to(site_url("dashboard"))->with('msg', [1, "Selamat datang, " . $data_user->nama]);
					} else {
						$ses = [0, "Hubungi admin untuk mengurus akun anda"];
						session()->setFlashdata(['msg' => $ses]);
					}
				}
			} else {
				$ses = [0, "Kombinasi username dan password belum tepat"];
				session()->setFlashdata(['msg' => $ses]);
			}
		}
		$data = [
			'err' => $this->validation->getErrors(),
			'username' => (@$username ?: '')
		];
		return view("auth/login", $data);
	}

	public function daftar()
	{
		$err = false;
		$angkatan = $this->angkatan->isActive();
		$status = mode_sistem($angkatan);
		if ($status == 0) {
			return redirect()->back()->with('msg', [0, "Pendaftaran belum dibuka."]);
		}
		if ($status == 2) {
			return redirect()->back()->with('msg', [0, "Pendaftaran ditutup."]);
		}

		$kuota = $this->cfg->_kuota;
		$find_now = $this->pribadi->find_now();
		$sisa = $kuota - count($find_now);

		if ($sisa <= 0) {
			return redirect()->back()->with('msg', [0, "Kuota pendaftar sudah penuh."]);
		}

		$this->validation->setRules($this->pribadi->rules_tambah_ubah);
		if ($this->request->getPost() && $this->validation->withRequest($this->request)->run()) {
			// inisialisasi data yang akan dimasukkan ke database
			$additionalData = $this->request->getPost();
			unset($additionalData['kode']);

			$pass = (string)$this->request->getPost('password');

			$additionalData['id_angkatan'] = $this->angkatanAktif;
			$additionalData['password'] =  password_hash($pass, PASSWORD_DEFAULT);

			// Cek Valid Username
			$isValidUsername = $this->pribadi->isValidUsername($additionalData['username']);
			if ($isValidUsername) {
				// Input ke database
				$lastid = $this->pribadi->simpan($additionalData);
				$json_nilai = [
					'status_un_mat' => "Belum upload",
					'status_un_bi' => "Belum upload",
					'status_un_ipa' => "Belum upload",
					'status_un_bing' => "Belum upload",
				];

				$json_berkas = [
					'un_mat' => "Belum upload",
					'un_bi' => "Belum upload",
					'un_ipa' => "Belum upload",
					'un_bing' => "Belum upload",
				];

				$add_nilai = [
					'id_dt_pribadi' => $lastid,
					'un_mat' => 0,
					'un_bi' => 0,
					'un_ipa' => 0,
					'un_bing' => 0,
					'nilai_ps' => 0,
					'nilai_pa' => 0,
					'nilai_wawancara' => 0,
					'rata' => 0,
					'berkas' => json_encode($json_berkas),
					'status' => json_encode($json_nilai),
				];
				$lastid_nilai = $this->nilai->simpan($add_nilai);

				$berkas_wajib = ['kk', 'akta', 'bukti'];
				foreach ($berkas_wajib as $k => $v) {
					$add_berkas = [
						'id_dt_pribadi' => $lastid,
						'jenis' => $v
					];
					$lastid_berkas = $this->berkas->simpan($add_berkas);
				}

				if ($lastid && $lastid_nilai) {
					return redirect()->to(site_url("login"))->with('msg', [1, "Berhasil Mendaftar"]);
				} else {
					return redirect()->to(site_url("login"))->with('msg', [1, "Gagal Mendaftar"]);
				}
			} else {
				$err = ['username' => "Username telah digunakan"];
				session()->setFlashdata('msg', [0, "Username telah digunakan"]);
			}
		}
		$tot = count($find_now) + 1;
		$kode = date('Y') . str_pad($tot, 4, "0", STR_PAD_LEFT);
		$smp = $this->smp->find();
		$data = [
			'smp' => $smp,
			'kode' => $kode,
			'sisa' => $sisa,
			'post' => $this->request->getPost(),
			'err' => $err ? $err : $this->validation->getErrors()
		];
		if ($this->validation->getErrors()) {
			session()->setFlashdata('msg', [0, "Isian belum lengkap atau ada yang belum valid"]);
		}

		return view('auth/daftar', $data);
	}

	public function logout()
	{
		$this->auth->logout(session()->user_id);
		return redirect()->to(site_url('login'))->with('msg', [1, "Berhasil Logout"]);
	}
}

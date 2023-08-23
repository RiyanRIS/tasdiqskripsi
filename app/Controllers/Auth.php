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
			if (!$isValidUsername) {
				$data = [
					'post' => $this->request->getPost(),
					'err' => ['username' => "Username telah digunakan"]
				];
				session()->setFlashdata('msg', [0, "Username telah digunakan"]);

				return view('auth/daftar', $data);
			}

			// Input ke database
			$lastid = $this->pribadi->simpan($additionalData);

			if ($lastid) // Kondisi berhasil menambah data
			{
				return redirect()->to(site_url("login"))->with('msg', [1, "Berhasil Mendaftar"]);
			} else { // kondisi gagal
				return redirect()->to(site_url("login"))->with('msg', [1, "Gagal Mendaftar"]);
			}
		} else { // kondisi validasi error
			$find_now = $this->pribadi->find_now();
			$tot = count($find_now) + 1;
			$kode = date('Y') . str_pad($tot, 4, "0", STR_PAD_LEFT);
			$smp = $this->smp->find();
			$data = [
				'smp' => $smp,
				'kode' => $kode,
				'post' => $this->request->getPost(),
				'err' => $this->validation->getErrors()
			];
			if ($this->validation->getErrors()) {
				session()->setFlashdata('msg', [0, "Isian belum lengkap"]);
			}
			return view('auth/daftar', $data);
		}

		// return view('auth/daftar');
	}

	public function logout()
	{
		$this->auth->logout(session()->user_id);
		return redirect()->to(site_url('login'))->with('msg', [1, "Berhasil Logout"]);
	}
}

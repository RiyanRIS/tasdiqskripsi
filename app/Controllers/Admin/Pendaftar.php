<?php

namespace App\Controllers\Admin;
use App\Controllers\BaseController;

class Pendaftar extends BaseController
{
    public function index()
    {
        if(!$this->isSecure()) return redirect()->to(site_url('/admin/login'))->with('msg', [0, 'Sesi anda telah kadaluarsa.']);

        $data = [
            "record" => $this->pribadi->find(),
            "judul" => "Data Pendaftar"
        ];

        return view('admin/pendaftar/index', $data);
    }

    public function nilai($id)
    {
        if(!$this->isSecure()) return redirect()->to(site_url('/admin/login'))->with('msg', [0, 'Sesi anda telah kadaluarsa.']);

        $data = [
            "record" => $this->pribadi->find($id),
            "nilai" => $this->nilai->find($id),
            "judul" => "Halaman Nilai Pendaftar"
        ];

        return view('admin/pendaftar/nilai', $data);
    }

    public function ubahdatamasuk()
    {
      // Cek hak akses user
      if(!$this->isSecure()){
        $msg = [
          'status' => false,
          'url' => site_url("admin/pendaftaran"),
          'pesan'	 => 'Anda tidak berhak mengakses halaman ini',
        ];
        return json_encode($msg);
      }

      // Cek username ngga boleh kosong
      $rules = [
        'username' => [
          'label'  => 'Username',
          'rules'  => 'required',
          'errors' => [],
        ],
      ];
      $this->validation->setRules($rules);

      if ($this->request->getPost() && $this->validation->withRequest($this->request)->run()) {
          $additionalData = $this->request->getPost();
          $id = $this->request->getPost('id');
          unset($additionalData['id']);

          // Cek Valid Username
          $isValidUsername = $this->pribadi->isValidUsername($additionalData['username'], $id);
          if(!$isValidUsername){
            $msg = [
              'status' => false, 
              'errors' => ['username' => "Username telah digunakan"],
            ];
            echo json_encode($msg);
            die();
          }

          // Hash Password
          if($additionalData['password'] != ''){
            $additionalData['password'] = password_hash($additionalData['password'], PASSWORD_DEFAULT);
          } else {
            unset($additionalData['password']);
          }

          // Proses Update
          $lastid = $this->pribadi->update(["id" => $id], $additionalData);

          if($lastid){
              $msg = [
                  'status' => true,
                  'url' => site_url("admin/pendaftar/nilai/" . $id),
              ];
              // $this->session->setFlashdata('msg', [1, 'Data berhasil dirubah']);
          } else {
              $msg = [
                  'status' => false,
                  'url' => site_url("admin/pendaftar/nilai/" . $id),
                  'pesan'	 => 'Data gagal dirubah',
              ];
          }

      } else {
          $msg = [
              'status' => false, 
              'errors' => $this->validation->getErrors(),
          ];
      }
      echo json_encode($msg);
      die();
    }

    public function ubahdatanilai()
    {
      // Cek hak akses user
      if(!$this->isSecure()){
        $msg = [
          'status' => false,
          'url' => site_url("admin/pendaftaran"),
          'pesan'	 => 'Anda tidak berhak mengakses halaman ini',
        ];
        return json_encode($msg);
      }

      // Cek isian ngga boleh kosong dan nilai minimal 1 dan maksimal 100
      $rules = [
        'nilai_un' => [
          'label'  => 'Nilai Un',
          'rules'  => 'required|less_than[100]|greater_than[1]',
          'errors' => [],
        ],
        'nilai_raport' => [
          'label'  => 'Nilai Raport',
          'rules'  => 'required|less_than[100]|greater_than[1]',
          'errors' => [],
        ],
        'nilai_ps' => [
          'label'  => 'Nilai PS',
          'rules'  => 'required|less_than[100]|greater_than[1]',
          'errors' => [],
        ],
        'nilai_pa' => [
          'label'  => 'Nilai PA',
          'rules'  => 'required|less_than[100]|greater_than[1]',
          'errors' => [],
        ],
      ];
      $this->validation->setRules($rules);

      if ($this->request->getPost() && $this->validation->withRequest($this->request)->run()) {
          $additionalData = $this->request->getPost();
          $id = $this->request->getPost('id');
          unset($additionalData['id']);

          // Cek Nilai Sudah Pernah Simpan
          $isSudahAda = $this->nilai->isSudahAda($id);
          if($isSudahAda){
            // Proses Update
            $lastid = $this->nilai->updateS(["id_dt_pribadi" => $id], $additionalData);
          } else {
            $additionalData['id_dt_pribadi'] = $id;
            $lastid = $this->nilai->simpan($additionalData);
          }

          if($lastid){
              $msg = [
                  'status' => true,
                  'url' => site_url("admin/pendaftar/nilai/" . $id),
              ];
              // $this->session->setFlashdata('msg', [1, 'Data berhasil dirubah']);
          } else {
              $msg = [
                  'status' => false,
                  'url' => site_url("admin/pendaftar/nilai/" . $id),
                  'pesan'	 => 'Data gagal dirubah',
              ];
          }

      } else {
          $msg = [
              'status' => false, 
              'errors' => $this->validation->getErrors(),
          ];
      }
      echo json_encode($msg);
      die();
    }

    public function ubahdatapribadi()
    {
      // Cek hak akses user
      if(!$this->isSecure()){
        $msg = [
          'status' => false,
          'url' => site_url("admin/pendaftaran"),
          'pesan'	 => 'Anda tidak berhak mengakses halaman ini',
        ];
        return json_encode($msg);
      }

      // Cek isian
      $rules = [
        'nama' => [
          'label'  => 'Nama Lengkap',
          'rules'  => 'required',
          'errors' => [],
        ],
        'tmpt_lahir' => [
          'label'  => 'Tempat Lahir',
          'rules'  => 'required',
          'errors' => [],
        ],
        'tgl_lahir' => [
          'label'  => 'Tanggal Lahir',
          'rules'  => 'required',
          'errors' => [],
        ],
        'jenis_kelamin' => [
          'label'  => 'Jenis Kelamin',
          'rules'  => 'required',
          'errors' => [],
        ],
        'agama' => [
          'label'  => 'Agama',
          'rules'  => 'required',
          'errors' => [],
        ],
        'alamat' => [
          'label'  => 'Alamat',
          'rules'  => 'required',
          'errors' => [],
        ],
        'asl_sekolah' => [
          'label'  => 'Asal Sekolah',
          'rules'  => 'required',
          'errors' => [],
        ],
        'no_tlpn' => [
          'label'  => 'Nomor Telepon',
          'rules'  => 'required',
          'errors' => [],
        ],
        'email' => [
          'label'  => 'Email',
          'rules'  => 'required|valid_email',
          'errors' => [],
        ],
      ];
      $this->validation->setRules($rules);

      if ($this->request->getPost() && $this->validation->withRequest($this->request)->run()) {
          $additionalData = $this->request->getPost();
          $id = $this->request->getPost('id');
          unset($additionalData['id']);

          $lastid = $this->pribadi->update(["id" => $id], $additionalData);

          if($lastid){
              $msg = [
                  'status' => true,
                  'url' => site_url("admin/pendaftar/nilai/" . $id),
              ];
              // $this->session->setFlashdata('msg', [1, 'Data berhasil dirubah']);
          } else {
              $msg = [
                  'status' => false,
                  'url' => site_url("admin/pendaftar/nilai/" . $id),
                  'pesan'	 => 'Data gagal dirubah',
              ];
          }

      } else {
          $msg = [
              'status' => false, 
              'errors' => $this->validation->getErrors(),
          ];
      }
      echo json_encode($msg);
      die();
    }

    function tes()
    {
      var_dump($this->pribadi->isValidUsername('1234', '2'));
    }

}

<?php

namespace App\Controllers\Admin;
use App\Controllers\BaseController;

class Pendaftar extends BaseController
{
    public function index()
    {
        if(!$this->isSecure()) return redirect()->to(site_url('/admin/login'))->with('msg', [0, 'Sesi anda telah kadaluarsa.']);

        $data = [
            "record" => $this->pribadi->find_now(),
            "angkatan" => $this->angkatan()->angkatan,
            "judul" => "Data Pendaftar"
        ];

        return view('admin/pendaftar/index', $data);
    }

    public function detail($id)
    {
        if(!$this->isSecure()) return redirect()->to(site_url('/admin/login'))->with('msg', [0, 'Sesi anda telah kadaluarsa.']);

        $data = [
            "record" => $this->pribadi->find($id),
            "nilai" => $this->nilai->find($id),
            "judul" => "Halaman Detail Pendaftar"
        ];

        return view('admin/pendaftar/detail', $data);
    }

    public function berkas($id)
    {
        if(!$this->isSecure()) return redirect()->to(site_url('/admin/login'))->with('msg', [0, 'Sesi anda telah kadaluarsa.']);

        $data = [
            "record" => $this->pribadi->find($id),
            "berkas" => $this->berkas->getByUser($id),
            "judul" => "Halaman Berkas Pendaftar"
        ];

        return view('admin/pendaftar/berkas', $data);
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

    public function tambahberkas()
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
          'label'  => 'Nama Berkas',
          'rules'  => 'required',
          'errors' => [],
        ]
      ];

      $this->validation->setRules($rules);

      if ($this->request->getPost() && $this->validation->withRequest($this->request)->run()) {
        $file = $this->request->getFile('file');
        $newName = $file->getRandomName();
        $file->move(ROOTPATH . 'public/uploads/temp/', $newName);
        
        $id = $this->request->getPost('id');

        $additionalData['file'] = $newName;
        $additionalData['nama'] = $this->request->getPost('nama');
        $additionalData['id_dt_pribadi'] = $id;
        $additionalData['status'] = "Terverifikasi";

        $lastid = $this->berkas->insert($additionalData);

        if($lastid){
            $msg = [
                'status' => true,
                'url' => site_url("admin/pendaftar/berkas/" . $id),
            ];
        } else {
            $msg = [
                'status' => false,
                'url' => site_url("admin/pendaftar/berkas/" . $id),
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

    public function updstatusberkas(string $id, string $kode)
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

      if($kode == 1){
        $data['status'] = "Terverifikasi";
      } else {
        $data['status'] = "Ditolak";
      }

      $get = $this->berkas->find($id);

      $lastId = $this->berkas->update(['id_berkas' => $id], $data);

      $msg = ($lastId ? [1, "Berhasil memperbarui data"] : [0, "Gagal memperbarui data"]);

      return redirect()->to(site_url('admin/pendaftar/berkas/'.$get['id_dt_pribadi']))->with('msg', $msg);
    }

    public function hapusberkas(string $id)
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

      $get = $this->berkas->find($id);

      $hapus = $this->berkas->delete($id);

      $msg = ($hapus ? [1, "Berhasil menghapus data"] : [0, "Gagal menghapus data"]);

      return redirect()->to(site_url('admin/pendaftar/berkas/'.$get['id_dt_pribadi']))->with('msg', $msg);
    }

    public function cabutberkas(string $id)
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

      $hapus = $this->berkas->where('id_dt_pribadi', $id)->delete();

      $msg = ($hapus ? [1, "Berhasil mencabut berkas"] : [0, "Gagal mencabut berkas"]);

      return redirect()->to(site_url('admin/pendaftar/'))->with('msg', $msg);
    }

    public function hapus(string $id)
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
      
      $this->db->transStart();
      // Hapus nilai
      $del_nilai = $this->nilai->where('id_dt_pribadi', $id)->delete();

      // Hapus berkas
      $del_berkas = $this->berkas->where('id_dt_pribadi', $id)->delete();

      // Hapus Pendaftar
      $del_berkas = $this->pribadi->delete($id);
      $this->db->transComplete();

      $msg = ($this->db->transStatus() ? [1, "Berhasil menghapus data"] : [0, "Gagal menghapus data"]);

      return redirect()->to(site_url('admin/pendaftar/'))->with('msg', $msg);
    }

}

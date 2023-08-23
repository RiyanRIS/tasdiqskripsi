<?php

namespace App\Controllers;

class Pendaftar extends BaseController
{
  public function ubahdatamasuk()
  {
    // Cek hak akses user
    if (!$this->isSecure('user')) {
      $msg = [
        'status' => false,
        'url' => site_url("pendaftaran"),
        'pesan'   => 'Anda tidak berhak mengakses halaman ini',
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
      if (!$isValidUsername) {
        $msg = [
          'status' => false,
          'errors' => ['username' => "Username telah digunakan"],
        ];
        echo json_encode($msg);
        die();
      }

      // Hash Password
      if ($additionalData['password'] != '') {
        $additionalData['password'] = password_hash($additionalData['password'], PASSWORD_DEFAULT);
      } else {
        unset($additionalData['password']);
      }

      // Proses Update
      $lastid = $this->pribadi->update(["id" => $id], $additionalData);

      if ($lastid) {
        $msg = [
          'status' => true,
          'url' => site_url("pendaftar"),
        ];
      } else {
        $msg = [
          'status' => false,
          'url' => site_url("pendaftar"),
          'pesan'   => 'Data gagal dirubah',
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
    if (!$this->isSecure('user')) {
      $msg = [
        'status' => false,
        'url' => site_url("login"),
        'pesan'   => 'Anda tidak berhak mengakses halaman ini',
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
      'nilai_wawancara' => [
        'label'  => 'Nilai Wawancara',
        'rules'  => 'required|less_than[100]|greater_than[1]',
        'errors' => [],
      ],
    ];
    $this->validation->setRules($rules);

    if ($this->request->getPost() && $this->validation->withRequest($this->request)->run()) {
      $additionalData = $this->request->getPost();
      $id = $this->request->getPost('id');
      unset($additionalData['id']);

      $additionalData['rata'] = genNilai($additionalData);

      // Cek Nilai Sudah Pernah Simpan
      $isSudahAda = $this->nilai->isSudahAda($id);
      if ($isSudahAda) {
        // Proses Update
        $lastid = $this->nilai->updateS(["id_dt_pribadi" => $id], $additionalData);
      } else {
        $additionalData['id_dt_pribadi'] = $id;
        $lastid = $this->nilai->simpan($additionalData);
      }

      if ($lastid) {
        $msg = [
          'status' => true,
          'url' => site_url("pendaftar"),
        ];
      } else {
        $msg = [
          'status' => false,
          'url' => site_url("pendaftar"),
          'pesan'   => 'Data gagal dirubah',
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

  public function ubahdatanilai2()
  {
    // Cek hak akses user
    if (!$this->isSecure('user')) {
      $msg = [
        'status' => false,
        'url' => site_url("login"),
        'pesan'   => 'Anda tidak berhak mengakses halaman ini',
      ];
      return json_encode($msg);
    }

    // Cek isian ngga boleh kosong dan nilai minimal 1 dan maksimal 100

    if ($this->request->getPost()) {
      $id = $this->request->getPost('id');
      $additionalData = $this->request->getPost();
      unset($additionalData['id']);
      // Cek Nilai Sudah Pernah Simpan
      $isSudahAda = $this->nilai->isSudahAda($id);

      $berkass = [];
      // $nilais = $isSudahAda ? $this->nilai->getBySiswa($id)[0] : [];
      // $berkasnya = $isSudahAda ? (array)json_decode(@$nilais['berkas']) : [];

      $jenis_nilai = ['un_mat', 'un_bi', 'un_ipa', 'un_bing'];

      foreach ($jenis_nilai as $k => $v) {
        $file = $this->request->getFile('file' . $v);
        if ($file->isValid()) {
          $newName = $file->getRandomName();
          $file->move(ROOTPATH . 'public/uploads/temp/', $newName);
          $berkass[$v] = $newName;
        }
        // } else {
        //   if ($isSudahAda) {
        //     $berkass[$v] = $berkasnya[$v];
        //   }
        // }
      }

      $additionalData['berkas'] = json_encode($berkass);

      if ($isSudahAda) {
        // Proses Update
        $lastid = $this->nilai->updateS(["id_dt_pribadi" => $id], $additionalData);
      } else {
        $additionalData['id_dt_pribadi'] = $id;
        $lastid = $this->nilai->simpan($additionalData);
      }

      $nilais = $this->nilai->getBySiswa($id)[0];
      $rata = genNilai($nilais);
      $lastid = $this->nilai->updateS(["id_dt_pribadi" => $id], ['rata' => $rata]);

      if ($lastid) {
        $msg = [
          'status' => true,
          'url' => site_url("pendaftar"),
        ];
      } else {
        $msg = [
          'status' => false,
          'url' => site_url("pendaftar"),
          'pesan'   => 'Data gagal dirubah',
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
    if (!$this->isSecure('user')) {
      $msg = [
        'status' => false,
        'url' => site_url("login"),
        'pesan'   => 'Anda tidak berhak mengakses halaman ini',
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

      if ($lastid) {
        $msg = [
          'status' => true,
          'url' => site_url("pendaftar"),
        ];
        // $this->session->setFlashdata('msg', [1, 'Data berhasil dirubah']);
      } else {
        $msg = [
          'status' => false,
          'url' => site_url("pendaftar"),
          'pesan'   => 'Data gagal dirubah',
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
    if (!$this->isSecure('user')) {
      $msg = [
        'status' => false,
        'url' => site_url("login"),
        'pesan'   => 'Anda tidak berhak mengakses fitur ini',
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
      $additionalData['status'] = "Belum Dicek";

      $lastid = $this->berkas->insert($additionalData);

      if ($lastid) {
        $msg = [
          'status' => true,
          'url' => site_url("berkas"),
        ];
      } else {
        $msg = [
          'status' => false,
          'url' => site_url("berkas"),
          'pesan'   => 'Data gagal dirubah',
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

  public function hapusberkas(string $id)
  {
    // Cek hak akses user
    if (!$this->isSecure('user')) {
      $msg = [
        'status' => false,
        'url' => site_url("login"),
        'pesan'   => 'Anda tidak berhak mengakses fitur ini',
      ];
      return json_encode($msg);
    }

    $get = $this->berkas->find($id);

    $hapus = $this->berkas->delete($id);

    $msg = ($hapus ? [1, "Berhasil menghapus data"] : [0, "Gagal menghapus data"]);

    return redirect()->to(site_url('berkas'))->with('msg', $msg);
  }
}

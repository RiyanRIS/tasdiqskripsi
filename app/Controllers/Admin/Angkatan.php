<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Angkatan extends BaseController
{
    // public function index()
    // {
    //     if(!$this->isSecure()) return redirect()->to(site_url('/admin/login'))->with('msg', [0, 'Sesi anda telah kadaluarsa.']);

    //     $data = [
    //         "angkatans" => $this->angkatan->orderby('tahun', 'DESC')->find(),
    //         "judul" => "Dashboard"
    //     ];

    //     return view('admin/home/index', $data);
    // }

    public function get(string $id)
    {
        if (!$this->isSecure()) {
            $msg = [
                'status' => false,
                'url' => site_url("admin/pendaftaran"),
                'pesan'     => 'Anda tidak berhak mengakses halaman ini',
            ];
            return json_encode($msg);
        }

        $hasil = $this->angkatan->find($id);

        echo json_encode($hasil);
    }

    public function tambah(string $id = null)
    {
        if (!$this->isSecure()) {
            $msg = [
                'status' => false,
                'url' => site_url("admin/pendaftaran"),
                'pesan'     => 'Anda tidak berhak mengakses halaman ini',
            ];
            return json_encode($msg);
        }

        // Cek isian ngga boleh kosong
        $rules = [
            'angkatan' => [
                'label'  => 'Angkatan',
                'rules'  => 'required',
                'errors' => [],
            ],
            'tahun' => [
                'label'  => 'Tahun',
                'rules'  => 'required',
                'errors' => [],
            ],
            'status' => [
                'label'  => 'Status',
                'rules'  => 'required',
                'errors' => [],
            ],
        ];
        $this->validation->setRules($rules);

        if ($this->request->getPost() && $this->validation->withRequest($this->request)->run()) {
            $additionalData = $this->request->getPost();
            unset($additionalData['id']);

            if ($id == null) {
                if ($additionalData['status'] == 1) {
                    $this->angkatan->updateStatusOff();
                }
                $lastid = $this->angkatan->simpan($additionalData);
            } else {
                if ($additionalData['status'] == 1) {
                    $this->angkatan->updateStatusOff();
                } else {
                    $angkatan = $this->angkatan->find($id);
                    if ($angkatan['status'] == 1) {
                        $msg = [
                            'status' => false,
                            'url' => site_url("admin"),
                            'pesan'     => 'Minimal satu angkatan aktif',
                        ];
                        echo json_encode($msg);
                        die();
                    }
                }
                $lastid = $this->angkatan->update(['id_angkatan', $id], $additionalData);
            }

            if ($lastid) {
                $msg = [
                    'status' => true,
                    'url' => site_url("admin"),
                ];
            } else {
                $msg = [
                    'status' => false,
                    'url' => site_url("admin"),
                    'pesan'     => 'Data gagal dirubah',
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

    public function hapus(string $id)
    {
        // Cek hak akses user
        if (!$this->isSecure()) {
            $msg = [
                'status' => false,
                'url' => site_url("admin/pendaftaran"),
                'pesan'     => 'Anda tidak berhak mengakses halaman ini',
            ];
            return json_encode($msg);
        }

        $get = $this->angkatan->find($id);

        if ($get['status'] == 1) {
            $msg = [0, "Tidak dapat menghapus Angkatan aktif."];
            return redirect()->to(site_url('admin'))->with('msg', $msg);
        }

        $hapus = $this->angkatan->update(['id_angkatan', $id], ['isDelete' => 1]);

        $msg = ($hapus ? [1, "Berhasil menghapus data"] : [0, "Gagal menghapus data"]);

        return redirect()->to(site_url('admin'))->with('msg', $msg);
    }
}

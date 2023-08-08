<?php

namespace App\Models;

use CodeIgniter\Model;
use \App\Models\AngkatanModel;

class PribadiModel extends Model
{
	protected $table = 'tbl_dt_pribadi';
	protected $primaryKey = 'id';

	protected $returnType     = 'array';
	protected $useSoftDeletes = true;
	protected $deletedField  = 'deleted_at';

	protected $allowedFields = ['id', 'nama', 'tmpt_lahir', 'tgl_lahir', 'jenis_kelamin', 'alamat', 'asl_sekolah', 'no_tlpn', 'email', 'username', 'password', 'deleted_at'];

	public $rules_tambah_ubah = [
		'nama' => [
			'label'  => 'Nama',
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
			'label'  => 'No Telepon',
			'rules'  => 'required',
			'errors' => [],
		],
		'email' => [
			'label'  => 'Email',
			'rules'  => 'required',
			'errors' => [],
		],
		'username' => [
			'label'  => 'Username',
			'rules'  => 'required',
			'errors' => [],
		],
		'password' => [
			'label'  => 'Password',
			'rules'  => 'required',
			'errors' => [],
		],
	];

	public function simpan($data)
	{
		$this->db->table($this->table)->insert($data);
		$id = $this->db->insertId($this->table);
		return $id ?? false;
	}

	public function find_now()
	{
		$angkatan = new AngkatanModel();
		$angkatanAktif = $angkatan->isActive()->id_angkatan;
		return $this->db->table($this->table)
			->where('tbl_dt_pribadi.id_angkatan', $angkatanAktif)
			->where('tbl_dt_pribadi.deleted_at', null)
			->join('tbl_angkatan', 'tbl_angkatan.id_angkatan = tbl_dt_pribadi.id_angkatan')
			->join('tbl_nilai', 'tbl_nilai.id_dt_pribadi = tbl_dt_pribadi.id', 'left')
			->get()
			->getResultArray();
	}

	public function find_tercabut()
	{
		$angkatan = new AngkatanModel();
		$angkatanAktif = $angkatan->isActive()->id_angkatan;
		return $this->db->table($this->table)
			->where('tbl_dt_pribadi.id_angkatan', $angkatanAktif)
			->where('tbl_dt_pribadi.deleted_at is not null')
			->join('tbl_angkatan', 'tbl_angkatan.id_angkatan = tbl_dt_pribadi.id_angkatan')
			->join('tbl_nilai', 'tbl_nilai.id_dt_pribadi = tbl_dt_pribadi.id', 'left')
			->get()
			->getResultArray();
	}

	public function getByUsername(string $username)
	{
		return $this->db->table($this->table)
			->where('username', $username)
			->limit(1)
			->get()
			->getRow();
	}

	function isValidUsername(string $username, $isUpdate = null): bool
	{
		$data = $this->getByUsername($username);

		if ($data == null) {
			return true;
		} else {
			if ($isUpdate == null) {
				return false;
			} else {
				if ($data->id == $isUpdate) {
					return true;
				} else {
					return false;
				}
			}
		}
	}
}

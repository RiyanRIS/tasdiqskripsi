<?php

namespace App\Models;

use CodeIgniter\Model;

class AngkatanModel extends Model
{
	protected $table = 'tbl_angkatan';
	protected $primaryKey = 'id_angkatan';

	protected $returnType     = 'array';

	protected $allowedFields = ['id', 'angkatan', 'tahun', 'tgl_buka', 'tgl_tutup', 'tgl_pengumuman', 'status', 'isDelete'];

	public function simpan($data)
	{
		$this->db->table($this->table)->insert($data);
		$id = $this->db->insertId($this->table);
		return $id ?? false;
	}

	public function find_active()
	{
		return $this->db->table($this->table)
			->where('isDelete', null)
			->get()
			->getResultArray();
	}

	public function isActive()
	{
		return $this->db->table($this->table)
			->where('status', '1')
			->where('isDelete', null)
			->orderby('tahun', 'DESC')
			->limit(1)
			->get()
			->getRow();
	}

	public function updateStatusOff()
	{
		return $this->db->table($this->table)->update(['status' => 0]);
	}

	public function cekOff($id = 1): bool
	{
		$angkatan = $this->find();
		foreach ($angkatan as $key => $v) {
		}
		print_r($angkatan);
		return false;
	}
}

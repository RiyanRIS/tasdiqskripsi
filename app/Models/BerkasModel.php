<?php

namespace App\Models;

use CodeIgniter\Model;

class BerkasModel extends Model
{
	protected $table = 'tbl_berkas';
	protected $primaryKey = 'id_berkas';

	protected $returnType     = 'array';
	protected $useSoftDeletes = true;

	protected $allowedFields = ['id_berkas', 'id_dt_pribadi', 'nama', 'file', 'status', 'upload_at', 'deleted_at'];

	public function simpan($data)
	{
		$this->db->table($this->table)->insert($data);
		$id = $this->db->insertId($this->table);
		return $id ?? false;
	}

	public function getTercabut()
	{
		return $this->db->table($this->table)->select('tbl_berkas.*, tbl_dt_pribadi.nama nama_peserta')
			->join('tbl_dt_pribadi', $this->table . ".id_dt_pribadi = tbl_dt_pribadi.id")
			->where('tbl_berkas.deleted_at is NOT NULL', null, false)
			->get()
			->getResult();
	}

	public function getByUser(string $id)
	{
		return $this->db->table($this->table)
			->where('id_dt_pribadi', $id)
			->where('deleted_at', null)
			->get()
			->getResult();
	}
}

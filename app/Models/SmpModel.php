<?php

namespace App\Models;

use CodeIgniter\Model;

class SmpModel extends Model
{
	protected $table = 'tbl_smp';
	protected $primaryKey = 'id_smp';

	protected $returnType     = 'array';

	protected $allowedFields = ['id_smp', 'nama'];

	public function simpan($data)
	{
		$this->db->table($this->table)->insert($data);
		$id = $this->db->insertId($this->table);
		return $id ?? false;
	}

	public function getByUsername(string $username)
	{
		return $this->db->table($this->table)
			->where('username', $username)
			->limit(1)
			->get()
			->getRow();
	}
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class PribadiModel extends Model
{
	protected $table = 'tbl_dt_pribadi';
	protected $primaryKey = 'id';

	protected $returnType     = 'array';

	protected $allowedFields = ['id', 'nama', 'tmpt_lahir', 'tgl_lahir', 'jenis_kelamin', 'agama', 'alamat', 'asl_sekolah', 'no_tlpn', 'email', 'username', 'password'];

	public function simpan($data){
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

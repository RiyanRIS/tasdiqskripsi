<?php

namespace App\Models;
use CodeIgniter\Model;

class AngkatanModel extends Model
{
	protected $table = 'tbl_angkatan';
	protected $primaryKey = 'id_angkatan';

	protected $returnType     = 'array';

	protected $allowedFields = ['id', 'angkatan', 'tahun', 'status', 'isDelete'];

	public function simpan($data){
		$this->db->table($this->table)->insert($data);
		$id = $this->db->insertId($this->table);
		return $id ?? false;
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

}

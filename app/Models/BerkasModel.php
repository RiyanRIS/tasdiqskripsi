<?php

namespace App\Models;

use CodeIgniter\Model;

class BerkasModel extends Model
{
	protected $table = 'tbl_berkas';
	protected $primaryKey = 'id_berkas';

	protected $returnType     = 'array';

	protected $allowedFields = ['id_berkas', 'id_dt_pribadi', 'nama', 'file', 'status', 'upload_at'];

	public function simpan($data){
			$this->db->table($this->table)->insert($data);
			$id = $this->db->insertId($this->table);
			return $id ?? false;
	}

	public function getByUser(string $id)
	{
		return $this->db->table($this->table)
											->where('id_dt_pribadi', $id)
											->get()
											->getResult();
	}

}

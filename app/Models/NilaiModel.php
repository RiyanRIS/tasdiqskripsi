<?php

namespace App\Models;

use CodeIgniter\Model;

class NilaiModel extends Model
{
	protected $table = 'tbl_nilai';
	protected $primaryKey = 'id_nilai';

	protected $returnType     = 'array';

	protected $allowedFields = ['id_nilai', 'id_dt_pribadi', 'nilai_un', 'nilai_raport', 'nilai_ps', 'nilai_pa', 'nilai_wawancara', 'rata', 'berkas'];

	public function simpan($data)
	{
		$this->db->table($this->table)->insert($data);
		$id = $this->db->insertId($this->table);
		return $id ?? false;
	}

	public function updateS($where, $data)
	{
		return $this->db->table($this->table)->where($where)->update($data);
	}

	public function getBySiswa(string $param)
	{
		return $this->db->table($this->table)
			->where('id_dt_pribadi', $param)
			->limit(1)
			->get()
			->getResult('array');
	}

	public function isSudahAda(string $id): bool
	{
		$data = $this->getBySiswa($id);
		if ($data == null) {
			return false;
		}
		return true;
	}
}

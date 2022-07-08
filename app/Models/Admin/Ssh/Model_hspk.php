<?php

namespace App\Models\Admin\Ssh;

use CodeIgniter\Model;

class Model_hspk extends Model
{
	protected $table = 'tb_hspk';
	protected $useTimestamps = true;
	protected $primaryKey = 'id_hspk';
	protected $allowedFields = ['hspk_paket', 'hspk_satuan', 'tahun', 'opd_id', 'created_by', 'updated_by', 'created_at', 'updated_at'];

	public function hspk($id)
	{
		return $this
			->select('tb_hspk.*')
			->select('auth_groups.name')
			->join('auth_groups', 'tb_hspk.opd_id = auth_groups.id', 'LEFT')
			->getWhere(['tb_hspk.tahun' => $_SESSION['tahun'], 'tb_hspk.opd_id' => $id])->getResultArray();
	}
	public function hspk_cetak()
	{
		return $this
			->DISTINCT('auth_groups.description')
			->DISTINCT('tb_hspk.opd_id')
			->select('tb_hspk.opd_id')
			->select('auth_groups.description')
			->join('auth_groups', 'tb_hspk.opd_id = auth_groups.id', 'LEFT')
			->join('tb_verifikasi', 'tb_hspk.id_hspk = tb_verifikasi.hspk_id', 'LEFT')
			->getWhere(['tb_hspk.tahun' => $_SESSION['tahun'], 'tb_verifikasi.verifikasi' => 'lolos'])->getResultArray();
	}
	public function hspk_cetak_filter($id)
	{
		return $this
			->DISTINCT('auth_groups.description')
			->DISTINCT('tb_hspk.opd_id')
			->select('tb_hspk.opd_id')
			->select('auth_groups.description')
			->join('auth_groups', 'tb_hspk.opd_id = auth_groups.id', 'LEFT')
			->join('tb_verifikasi', 'tb_hspk.id_hspk = tb_verifikasi.hspk_id', 'LEFT')
			->getWhere(['tb_hspk.tahun' => $_SESSION['tahun'], 'tb_hspk.opd_id' => $id, 'tb_verifikasi.verifikasi' => 'lolos'])->getResultArray();
	}
}

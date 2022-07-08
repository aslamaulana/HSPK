<?php

namespace App\Models\Admin\Asb;

use CodeIgniter\Model;

class Model_asb extends Model
{
	protected $table = 'tb_asb';
	protected $useTimestamps = true;
	protected $primaryKey = 'id_asb';
	protected $allowedFields = ['asb_paket', 'asb_satuan', 'tahun', 'opd_id', 'created_by', 'updated_by', 'created_at', 'updated_at'];

	// public function hspk($id)
	// {
	// 	return $this
	// 		->select('tb_hspk.*')
	// 		->select('auth_groups.name')
	// 		->join('auth_groups', 'tb_hspk.opd_id = auth_groups.id', 'LEFT')
	// 		->getWhere(['tb_hspk.tahun' => $_SESSION['tahun'], 'tb_hspk.opd_id' => $id])->getResultArray();
	// }
	// public function hspk_cetak_filter($id)
	// {
	// 	return $this
	// 		->select('tb_hspk.*')
	// 		->select('auth_groups.name')
	// 		->join('auth_groups', 'tb_hspk.opd_id = auth_groups.id', 'LEFT')
	// 		->getWhere(['tb_hspk.tahun' => $_SESSION['tahun'], 'tb_hspk.opd_id' => $id])->getResultArray();
	// }
	// public function hspk_cetak()
	// {
	// 	return $this
	// 		->select('tb_hspk.*')
	// 		->select('auth_groups.name')
	// 		->join('auth_groups', 'tb_hspk.opd_id = auth_groups.id', 'LEFT')
	// 		->getWhere(['tb_hspk.tahun' => $_SESSION['tahun']])->getResultArray();
	// }
}

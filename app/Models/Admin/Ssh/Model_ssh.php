<?php

namespace App\Models\Admin\Ssh;

use CodeIgniter\Model;

class Model_ssh extends Model
{
	protected $table = 'tb_ssh';
	protected $useTimestamps = true;
	protected $primaryKey = 'id_ssh';
	protected $allowedFields = ['komponen', 'spesifikasi', 'satuan', 'opd_id', 'harga', 'keterangan', 'kelompok_id', 'tahun', 'created_by', 'updated_by', 'created_at', 'updated_at'];

	public function ssh()
	{
		return $this
			->select('tb_ssh.*')
			->join('tb_ssh_verifikasi', 'tb_ssh.id_ssh = tb_ssh_verifikasi.ssh_id', 'LEFT')
			->getWhere(['tb_ssh.tahun' => $_SESSION['tahun'], 'verifikasi' => 'lolos'])->getResultArray();
	}

	public function ssh_pengajuan($id)
	{
		return $this
			->select('tb_ssh.*')
			->select('auth_groups.name')
			->join('auth_groups', 'tb_ssh.opd_id = auth_groups.id', 'LEFT')
			->getWhere(['tb_ssh.tahun' => $_SESSION['tahun'], 'tb_ssh.opd_id' => $id])->getResultArray();
	}
}

<?php

namespace App\Models\User\Ssh;

use CodeIgniter\Model;

class Model_hspk_komponen extends Model
{
	protected $table = 'tb_hspk_komponen';
	protected $useTimestamps = true;
	protected $primaryKey = 'id_hspk_komponen';
	protected $allowedFields = ['ssh_id', 'hspk_id', 'index', 'group', 'tahun', 'opd_id', 'created_by', 'updated_by', 'created_at', 'updated_at'];

	// public function ssh()
	// {
	// 	return $this->db->table('tb_ssh')->getWhere(['tb_ssh.tahun' => $_SESSION['tahun']])->getResultArray();
	// }
	public function ssh()
	{
		return $this->db->table('tb_ssh')
			->select('tb_ssh.*')
			->join('tb_ssh_verifikasi', 'tb_ssh.id_ssh = tb_ssh_verifikasi.ssh_id', 'LEFT')
			->getWhere(['tb_ssh.tahun' => $_SESSION['tahun'], 'verifikasi' => 'lolos'])->getResultArray();
	}
	public function hspk_komponen_A($id)
	{
		return $this->select('tb_hspk_komponen.*')
			->select('tb_ssh.komponen')
			->select('tb_ssh.spesifikasi')
			->select('tb_ssh.satuan')
			->select('tb_ssh.harga')
			->select('tb_ssh.kelompok')
			->join('tb_ssh', 'tb_hspk_komponen.ssh_id = tb_ssh.id_ssh', 'LEFT')
			->getWhere(['tb_hspk_komponen.tahun' => $_SESSION['tahun'], 'tb_hspk_komponen.hspk_id' => $id, 'tb_hspk_komponen.group' => 'A'])->getResultArray();
	}
	public function hspk_komponen_B($id)
	{
		return $this->select('tb_hspk_komponen.*')
			->select('tb_ssh.komponen')
			->select('tb_ssh.spesifikasi')
			->select('tb_ssh.satuan')
			->select('tb_ssh.harga')
			->select('tb_ssh.kelompok')
			->join('tb_ssh', 'tb_hspk_komponen.ssh_id = tb_ssh.id_ssh', 'LEFT')
			->getWhere(['tb_hspk_komponen.tahun' => $_SESSION['tahun'], 'tb_hspk_komponen.hspk_id' => $id, 'tb_hspk_komponen.group' => 'B'])->getResultArray();
	}
	public function hspk_komponen_C($id)
	{
		return $this->select('tb_hspk_komponen.*')
			->select('tb_ssh.komponen')
			->select('tb_ssh.spesifikasi')
			->select('tb_ssh.satuan')
			->select('tb_ssh.harga')
			->select('tb_ssh.kelompok')
			->join('tb_ssh', 'tb_hspk_komponen.ssh_id = tb_ssh.id_ssh', 'LEFT')
			->getWhere(['tb_hspk_komponen.tahun' => $_SESSION['tahun'], 'tb_hspk_komponen.hspk_id' => $id, 'tb_hspk_komponen.group' => 'C'])->getResultArray();
	}

	function getssh($ssh)
	{
		$query = $this->db->table('tb_ssh')
			->select('tb_ssh.*')
			->select('tb_ssh.*')
			->join('tb_ssh_verifikasi', 'tb_ssh.id_ssh = tb_ssh_verifikasi.ssh_id', 'LEFT')
			->getWhere(['tb_ssh.tahun' => $_SESSION['tahun'], 'kelompok' => $ssh, 'verifikasi' => 'lolos'])->getResult();
		return $query;
	}
}

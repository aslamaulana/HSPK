<?php

namespace App\Models\User\Ssh;

use CodeIgniter\Model;

class Model_ssh extends Model
{
	protected $table = 'tb_ssh';
	protected $useTimestamps = true;
	protected $primaryKey = 'id_ssh';
	protected $allowedFields = ['komponen', 'jenis_rincian_objek_sub_id', 'spesifikasi', 'satuan', 'opd_id', 'harga', 'keterangan', 'kelompok', 'tahun', 'created_by', 'updated_by', 'created_at', 'updated_at'];

	public function ssh_edit($id)
	{
		return $this
			->select('tb_ssh.*')
			->select('tb_jenis_rincian_objek_sub.id_jenis_rincian_objek_sub')
			->select('tb_jenis_rincian_objek_sub.kode_jenis_rincian_objek_sub')
			->select('tb_jenis_rincian_objek_sub.jenis_rincian_objek_sub')
			->join('tb_jenis_rincian_objek_sub', 'tb_ssh.jenis_rincian_objek_sub_id = tb_jenis_rincian_objek_sub.id_jenis_rincian_objek_sub', 'LEFT')
			->getWhere(['tb_ssh.tahun' => $_SESSION['tahun'], 'tb_ssh.id_ssh' => $id])->getRowArray();
	}
	public function ssh()
	{
		return $this->getWhere(['tb_ssh.tahun' => $_SESSION['tahun']])->getResultArray();
	}
	public function ssh_opd()
	{
		return $this->getWhere(['tb_ssh.tahun' => $_SESSION['tahun'], 'tb_ssh.opd_id' => user()->opd_id])->getResultArray();
	}

	function getkelompok($akun_id)
	{
		$query = $this->db->table('tb_jenis_kelompok')->getWhere(['jenis_akun_id' => $akun_id])->getResult();
		return $query;
	}
	function getjenis($kelompok_id)
	{
		$query = $this->db->table('tb_jenis_jenis')->getWhere(['jenis_kelopok_id' => $kelompok_id])->getResult();
		return $query;
	}
	function getobjek($jenis_id)
	{
		$query = $this->db->table('tb_jenis_objek')->getWhere(['jenis_jenis_id' => $jenis_id])->getResult();
		return $query;
	}
	function getrincianobjek($objek_id)
	{
		$query = $this->db->table('tb_jenis_rincian_objek')->getWhere(['jenis_objek_id' => $objek_id])->getResult();
		return $query;
	}
	function getsubrincianobjek($rincianobjek_id)
	{
		$query = $this->db->table('tb_jenis_rincian_objek_sub')->getWhere(['jenis_rincian_objek_id' => $rincianobjek_id])->getResult();
		return $query;
	}
}

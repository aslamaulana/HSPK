<?php

namespace App\Models\User\Ssh;

use CodeIgniter\Model;

class Model_hspk extends Model
{
	protected $table = 'tb_hspk';
	protected $useTimestamps = true;
	protected $primaryKey = 'id_hspk';
	protected $allowedFields = ['hspk_paket', 'hspk_satuan', 'jenis_rincian_objek_sub_id', 'tahun', 'opd_id', 'created_by', 'updated_by', 'created_at', 'updated_at'];

	public function hspk_edit($id)
	{
		return $this->db->table('tb_hspk')
			->select('tb_jenis_rincian_objek_sub.kode_jenis_rincian_objek_sub')
			->select('tb_jenis_rincian_objek_sub.jenis_rincian_objek_sub')
			->select('tb_jenis_rincian_objek_sub.kelompok_id')
			->select('tb_jenis_rincian_objek_sub.id_jenis_rincian_objek_sub')
			->select('tb_jenis_rincian_objek.id_jenis_rincian_objek')
			->select('tb_jenis_rincian_objek.kode_jenis_rincian_objek')
			->select('tb_jenis_rincian_objek.jenis_rincian_objek')
			->select('tb_jenis_objek.id_jenis_objek')
			->select('tb_jenis_objek.kode_jenis_objek')
			->select('tb_jenis_objek.jenis_objek')
			->select('tb_jenis_jenis.id_jenis_jenis')
			->select('tb_jenis_jenis.kode_jenis_jenis')
			->select('tb_jenis_jenis.jenis_jenis')
			->select('tb_jenis_kelompok.id_jenis_kelompok')
			->select('tb_jenis_kelompok.kode_jenis_kelompok')
			->select('tb_jenis_kelompok.jenis_kelompok')
			->select('tb_jenis_akun.id_jenis_akun')
			->select('tb_jenis_akun.kode_jenis_akun')
			->select('tb_jenis_akun.jenis_akun')
			->select('tb_hspk.hspk_paket')
			->select('tb_hspk.hspk_satuan')
			->select('tb_hspk.id_hspk')
			->join('tb_jenis_rincian_objek_sub', 'tb_hspk.jenis_rincian_objek_sub_id = tb_jenis_rincian_objek_sub.id_jenis_rincian_objek_sub', 'LEFT')
			->join('tb_jenis_rincian_objek', 'tb_jenis_rincian_objek_sub.jenis_rincian_objek_id = tb_jenis_rincian_objek.id_jenis_rincian_objek', 'LEFT')
			->join('tb_jenis_objek', 'tb_jenis_rincian_objek.jenis_objek_id = tb_jenis_objek.id_jenis_objek', 'LEFT')
			->join('tb_jenis_jenis', 'tb_jenis_objek.jenis_jenis_id = tb_jenis_jenis.id_jenis_jenis', 'LEFT')
			->join('tb_jenis_kelompok', 'tb_jenis_jenis.jenis_kelopok_id = tb_jenis_kelompok.id_jenis_kelompok', 'LEFT')
			->join('tb_jenis_akun', 'tb_jenis_kelompok.jenis_akun_id = tb_jenis_akun.id_jenis_akun', 'LEFT')
			->getWhere(['tb_hspk.id_hspk' => $id])->getRowArray();
	}

	public function hspk()
	{
		return $this->getWhere(['tb_hspk.tahun' => $_SESSION['tahun'], 'tb_hspk.opd_id' => user()->opd_id])->getResultArray();
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
		$query = $this->db->table('tb_jenis_rincian_objek_sub')->getWhere(['jenis_rincian_objek_id' => $rincianobjek_id, 'kelompok_id' => 'HSPK'])->getResult();
		return $query;
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

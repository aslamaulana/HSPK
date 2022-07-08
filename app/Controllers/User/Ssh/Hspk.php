<?php

namespace App\Controllers\User\Ssh;

use App\Controllers\BaseController;
use App\Models\User\Ssh\Model_hspk;
use App\Models\Admin\Permen\Model_jenis_akun;

class Hspk extends BaseController
{
	protected $hspk, $akun;

	public function __construct()
	{
		$this->hspk = new Model_hspk();
		$this->akun = new Model_jenis_akun();
	}

	public function index()
	{
		if (has_permission('User')) :
			$hspk = $this->hspk->hspk();
			$data = [
				'gr' => 'hspk',
				'mn' => 'hspk',
				'lok' => '<b>HSPK</b>',
				'hspk' => $hspk,
				'db' => \Config\Database::connect(),
			];
			echo view('user/Ssh/hspk', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function AmbilKelompok()
	{
		$akun_id = $this->request->getVar('id');
		$data = $this->hspk->getkelompok($akun_id);

		echo json_encode($data);
	}
	public function AmbilJenis()
	{
		$kelompok_id = $this->request->getVar('id');
		$data = $this->hspk->getjenis($kelompok_id);

		echo json_encode($data);
	}
	public function AmbilObjek()
	{
		$jenis_id = $this->request->getVar('id');
		$data = $this->hspk->getobjek($jenis_id);

		echo json_encode($data);
	}
	public function AmbilRincianObjek()
	{
		$objek_id = $this->request->getVar('id');
		$data = $this->hspk->getrincianobjek($objek_id);

		echo json_encode($data);
	}
	public function AmbilSubRincianObjek()
	{
		$rincianobjek_id = $this->request->getVar('id');
		$data = $this->hspk->getsubrincianobjek($rincianobjek_id);

		echo json_encode($data);
	}
	public function hspk_add()
	{
		if (has_permission('User')) :
			$akun = $this->akun->where(['kode_jenis_akun' => '8'])->findAll();
			$data = [
				'gr' => 'hspk',
				'mn' => 'hspk',
				'lok' => '<a href="/user/ssh/hspk">HSPK</a> -> <b>Tambah HSPK</b>',
				'akun' => $akun,
				'validation' => \Config\Services::validation(),
			];
			echo view('user/Ssh/hspk_add', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function hspk_create()
	{
		if (has_permission('User')) :
			$this->hspk->save([
				'hspk_paket' => $this->request->getVar('nm_paket'),
				'jenis_rincian_objek_sub_id' => $this->request->getVar('sub_rincian_objek'),
				'hspk_satuan' => $this->request->getVar('satuan'),
				'opd_id' => user()->opd_id,
				'tahun' => $_SESSION['tahun'],
				'created_by' => user()->full_name,
			]);

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/user/ssh/hspk');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function hspk_edit($id)
	{
		if (has_permission('User')) :
			$hspk = $this->hspk->hspk_edit($id);
			$akun = $this->akun->where(['kode_jenis_akun' => '8'])->findAll();
			$data = [
				'gr' => 'hspk',
				'mn' => 'hspk',
				'lok' => '<a href="/user/ssh/hspk">HSPK</a> -> <b>Edit HSPK</b>',
				'hspk' => $hspk,
				'akun' => $akun,
				'validation' => \Config\Services::validation(),
			];
			echo view('user/Ssh/hspk_edit', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function hspk_update()
	{
		if (has_permission('User')) :
			$this->hspk->save([
				'id_hspk' => $this->request->getVar('id'),
				'jenis_rincian_objek_sub_id' => $this->request->getVar('sub_rincian_objek'),
				'hspk_paket' => $this->request->getVar('nm_paket'),
				'hspk_satuan' => $this->request->getVar('satuan'),
				// 'opd_id' => user()->opd_id,
				// 'tahun' => $_SESSION['tahun'],
				'updated_by' => user()->full_name,
			]);

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/user/ssh/hspk');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function hspk_hapus($id)
	{
		if (has_permission('User')) :
			try {
				$this->hspk->delete($id);
			} catch (\Exception $e) {
				session()->setFlashdata('error', 'Data Gagal di hapus.');
				return redirect()->back();
			}
			session()->setFlashdata('pesan', 'Data berhasil di hapus.');
			return redirect()->back();
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}

	// ---------------------------------------------------------
}

<?php

namespace App\Controllers\User\Ssh;

use App\Controllers\BaseController;
use App\Models\User\Ssh\Model_ssh;
use App\Models\Admin\Permen\Model_jenis_akun;

class Ssh_pengajuan extends BaseController
{
	protected $ssh, $akun;

	public function __construct()
	{
		$this->ssh = new Model_ssh();
		$this->akun = new Model_jenis_akun();
	}

	public function index()
	{
		if (has_permission('User')) :
			$ssh = $this->ssh->ssh_opd();
			$data = [
				'gr' => 'ssh',
				'mn' => 'ssh_pengajuan',
				'lok' => '<b>Pengajuan</b>',
				'ssh' => $ssh,
				'db' => \Config\Database::connect(),
			];
			echo view('user/Ssh_pengajuan/ssh', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function AmbilKelompok()
	{
		$akun_id = $this->request->getVar('id');
		$data = $this->ssh->getkelompok($akun_id);

		echo json_encode($data);
	}
	public function AmbilJenis()
	{
		$kelompok_id = $this->request->getVar('id');
		$data = $this->ssh->getjenis($kelompok_id);

		echo json_encode($data);
	}
	public function AmbilObjek()
	{
		$jenis_id = $this->request->getVar('id');
		$data = $this->ssh->getobjek($jenis_id);

		echo json_encode($data);
	}
	public function AmbilRincianObjek()
	{
		$objek_id = $this->request->getVar('id');
		$data = $this->ssh->getrincianobjek($objek_id);

		echo json_encode($data);
	}
	public function AmbilSubRincianObjek()
	{
		$rincianobjek_id = $this->request->getVar('id');
		$data = $this->ssh->getsubrincianobjek($rincianobjek_id);

		echo json_encode($data);
	}
	public function pengajuan_add()
	{
		if (has_permission('User')) :
			$akun = $this->akun->where(['kode_jenis_akun' => '1'])->findAll();
			$data = [
				'gr' => 'ssh',
				'mn' => 'ssh_pengajuan',
				'lok' => '<a href="/user/ssh/ssh_pengajuan">Pengajuan</a> -> <b>Tambah Pengajuan</b>',
				'akun' => $akun,
				'validation' => \Config\Services::validation(),
			];
			echo view('user/Ssh_pengajuan/ssh_add', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function ssh_create()
	{
		if (has_permission('User')) :
			$this->ssh->save([
				'komponen' => $this->request->getVar('komponen'),
				'spesifikasi' => $this->request->getVar('spesifikasi'),
				'satuan' => $this->request->getVar('satuan'),
				'harga' => $this->request->getVar('harga'),
				'kelompok' => $this->request->getVar('type'),
				'jenis_rincian_objek_sub_id' => $this->request->getVar('sub_rincian_objek'),
				'opd_id' => user()->opd_id,
				'tahun' => $_SESSION['tahun'],
				'created_by' => user()->full_name,
			]);

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/user/ssh/ssh_pengajuan');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function pengajuan_edit($id)
	{
		if (has_permission('User')) :
			$akun = $this->akun->where(['kode_jenis_akun' => '1'])->findAll();
			$ssh = $this->ssh->ssh_edit($id);
			$data = [
				'gr' => 'ssh',
				'mn' => 'ssh_pengajuan',
				'lok' => '<a href="/user/ssh/ssh_pengajuan">Pengajuan</a> -> <b>Ubah Pengajuan</b>',
				'akun' => $akun,
				'ssh' => $ssh,
				'validation' => \Config\Services::validation(),
			];
			echo view('user/Ssh_pengajuan/ssh_edit', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function ssh_update()
	{
		if (has_permission('User')) :
			$this->ssh->save([
				'id_ssh' => $this->request->getVar('id_ssh'),
				'komponen' => $this->request->getVar('komponen'),
				'spesifikasi' => $this->request->getVar('spesifikasi'),
				'satuan' => $this->request->getVar('satuan'),
				'harga' => $this->request->getVar('harga'),
				'kelompok' => $this->request->getVar('type'),
				'jenis_rincian_objek_sub_id' => $this->request->getVar('sub_rincian_objek'),
				'opd_id' => user()->opd_id,
				'tahun' => $_SESSION['tahun'],
				'created_by' => user()->full_name,
			]);

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/user/ssh/ssh_pengajuan');
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

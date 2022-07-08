<?php

namespace App\Controllers\Admin\Ssh;

use App\Controllers\BaseController;
use App\Models\Admin\Ssh\Model_hspk_komponen;
use App\Models\User\Ssh\Model_hspk;
use App\Models\Admin\User\Model_bidang;

class Hspk_komponen extends BaseController
{
	protected $hspk, $hspk1, $opd;

	public function __construct()
	{
		$this->hspk = new Model_hspk_komponen();
		$this->hspk1 = new Model_hspk();
		$this->opd = new Model_bidang();
	}

	public function data($id, $opd = '')
	{
		if (has_permission('Admin')) :
			$A = $this->hspk->hspk_komponen_A($id);
			$B = $this->hspk->hspk_komponen_B($id);
			$C = $this->hspk->hspk_komponen_C($id);
			$hspk1 = $this->hspk1->find($id);
			$skpd = $this->opd->find($opd);
			$data = [
				'gr' => 'a-hspk',
				'mn' => 'a-hspk',
				'lok' => 'HSPK OPD -> <a href="/admin/ssh/hspk/paket/' . $opd . '">HSPK</a> -> <b>HSPK Komponen</b>',
				'A' => $A,
				'B' => $B,
				'C' => $C,
				'hspk1' => $hspk1,
				'id_hspk' => $id,
				'opd' => $skpd,
				'db' => \Config\Database::connect(),
			];
			echo view('admin/Ssh/hspk_komponen', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	// public function data_add($id)
	// {
	// 	if (has_permission('Admin')) :
	// 		$ssh = $this->hspk->ssh();
	// 		$data = [
	// 			'gr' => 'a-hspk',
	// 			'mn' => 'a-hspk',
	// 			'lok' => 'HSPK -> <a href="/admin/ssh/hspk_komponen/data/' . $id . '">HSPK Komponen</a> -> <b>Tambah HSPK Komponen</b>',
	// 			'ssh' => $ssh,
	// 			'id_hspk' => $id,
	// 		];
	// 		echo view('admin/Ssh/hspk_komponen_add', $data);
	// 	else :
	// 		throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
	// 	endif;
	// }
	// public function data_create()
	// {
	// 	if (has_permission('Admin')) :
	// 		$this->hspk->save([
	// 			'hspk_id' => $this->request->getVar('id_hspk'),
	// 			'ssh_id' => $this->request->getVar('ssh'),
	// 			'index' => $this->request->getVar('index'),
	// 			'tahun' => $_SESSION['tahun'],
	// 			'created_by' => user()->full_name,
	// 		]);

	// 		session()->setFlashdata('pesan', 'Data berhasil di simpan.');
	// 		return redirect()->to(base_url() . '/user/ssh/hspk_komponen/data/' . $this->request->getVar('id_hspk'));
	// 	else :
	// 		throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
	// 	endif;
	// }
	// public function data_edit($id, $id_hspk)
	// {
	// 	if (has_permission('Admin')) :
	// 		$data = $this->hspk->find($id);
	// 		$data = [
	// 			'gr' => 'a-hspk',
	// 			'mn' => 'a-hspk',
	// 			'lok' => 'HSPK -> <a href="/admin/ssh/hspk_komponen/data/' . $id_hspk . '">HSPK Komponen</a> -> <b>Ubah HSPK Komponen</b>',
	// 			'data' => $data,
	// 			'id_hspk' => $id_hspk,
	// 		];
	// 		echo view('admin/Ssh/hspk_komponen_edit', $data);
	// 	else :
	// 		throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
	// 	endif;
	// }
	// public function data_update()
	// {
	// 	if (has_permission('Admin')) :
	// 		$this->hspk->save([
	// 			'id_hspk_komponen' => $this->request->getVar('id'),
	// 			'index' => $this->request->getVar('index'),
	// 			'updated_by' => user()->full_name,
	// 		]);

	// 		session()->setFlashdata('pesan', 'Data berhasil di simpan.');
	// 		return redirect()->to(base_url() . '/user/ssh/hspk_komponen/data/' . $this->request->getVar('id_hspk'));
	// 	else :
	// 		throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
	// 	endif;
	// }
	// public function data_hapus($id)
	// {
	// 	if (has_permission('Admin')) :
	// 		try {
	// 			$this->hspk->delete($id);
	// 		} catch (\Exception $e) {
	// 			session()->setFlashdata('error', 'Data Gagal di hapus.');
	// 			return redirect()->back();
	// 		}
	// 		session()->setFlashdata('pesan', 'Data berhasil di hapus.');
	// 		return redirect()->back();
	// 	else :
	// 		throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
	// 	endif;
	// }

	// ---------------------------------------------------------
}

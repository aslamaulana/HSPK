<?php

namespace App\Controllers\Admin\Ssh;

use App\Controllers\BaseController;
use App\Models\Admin\Ssh\Model_hspk;
use App\Models\Admin\User\Model_bidang;

class Hspk_laporan extends BaseController
{
	protected $hspk, $opd;

	public function __construct()
	{
		$this->hspk = new Model_hspk();
		$this->opd = new Model_bidang();
	}

	public function index()
	{
		if (has_permission('Admin')) :
			$opd = $this->opd->skpd();
			$data = [
				'gr' => 'a-hspk',
				'mn' => 'a-hspk-laporan',
				'lok' => '<b>HSPK Laporan</b>',
				'opd' => $opd,
				'db' => \Config\Database::connect(),
			];
			echo view('admin/Ssh/hspk_laporan', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function cetak()
	{
		if (has_permission('admin')) {
			$type = $this->request->getVar('type');
			if ($type == 'excel') {
				$filename = "Print Data" . "-" . date('Y-m-d') . ".xls";

				header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
				header('Content-Disposition: attachment; filename="' . $filename . '";');

				$id = $this->request->getVar('opd');
				if ($id == 'all') {
					$hspk = $this->hspk->hspk_cetak();
				} else {
					$hspk = $this->hspk->hspk_cetak_filter($id);
				}
				$data = [
					'lok' => '<b>Data</b>',
					'hspk' => $hspk,
					'db' => \Config\Database::connect(),
				];
				return view('admin/Ssh/excel', $data);
			}
		} else {
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		}
	}
}

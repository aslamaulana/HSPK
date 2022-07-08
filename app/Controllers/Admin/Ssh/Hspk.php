<?php

namespace App\Controllers\Admin\Ssh;

use App\Controllers\BaseController;
use App\Models\Admin\Ssh\Model_hspk;
use App\Models\Admin\User\Model_bidang;

class Hspk extends BaseController
{
	protected $hspk, $opd;

	public function __construct()
	{
		$this->hspk = new Model_hspk();
		$this->opd = new Model_bidang();
	}

	public function paket($id)
	{
		if (has_permission('Admin')) :
			$hspk = $this->hspk->hspk($id);
			$opd = $this->opd->find($id);
			$data = [
				'gr' => 'a-hspk',
				'mn' => 'a-hspk',
				'lok' => '<a href="/admin/ssh/opd_data">HSKP OPD</a> -><b>HSPK</b>',
				'hspk' => $hspk,
				'opd' => $opd,
				'db' => \Config\Database::connect(),
			];
			echo view('admin/Ssh/hspk', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
}

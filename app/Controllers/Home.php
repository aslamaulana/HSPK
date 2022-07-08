<?php

namespace App\Controllers;

class Home extends BaseController
{
	protected $session;

	function __construct()
	{
		$this->session = \Config\Services::session();
		$this->session->start();
	}
	public function index()
	{
		$data = [
			'gr' => 'home',
			'mn' => 'home',
			'title' => 'ROPK',
			'lok' => '<a href=".">Program</a> -> <b>Tambah Program</b>',
		];

		if (!isset($_SESSION['tahun'])) {
			$this->session->set('tahun', date('Y'));
		}

		echo view('dashboard', $data);
	}
	public function Set_Tahun($tahun)
	{
		$this->session->set('tahun', $tahun);

		//return redirect()->back();
		return redirect()->to(base_url() . '/');

	}
	public function max($id)
	{
		if ($id == 'max') {
			$this->session->set('max', 'maximized-card');
		} else {
			$this->session->remove('max');
		}

		return redirect()->back();
	}
}

<?= $this->extend('_layout/template'); ?>

<?= $this->section('stylesheet'); ?>
<link rel="stylesheet" href="<?= base_url('/toping/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
<style>
	.c1 {
		width: 30px;
		text-align: center;
	}

	.c2 {
		width: 100px;
		text-align: center;
	}

	.c3 {
		width: 100px;
		text-align: center;
	}

	.c4 {
		width: 130px;
		text-align: center;
	}

	.c5 {
		width: 120px;
	}
</style>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="card-body">
	<h4> <?= $opd['description']; ?></h4>
</div>
<div class="card-body">
	<table id="example1" class="table table-bordered">
		<thead>
			<tr class="">
				<th class="c1">No</th>
				<th class="">Paket</th>
				<th class="c2">Satuan</th>
				<th class="c2">Komponen</th>
				<th class="c4">Total</th>
				<!-- <th class="c4">OPD</th> -->
				<th class="c5"></th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<th>No</th>
				<th>Paket</th>
				<th>Satuan</th>
				<th class="c2">komponen</th>
				<th class="c4">Total</th>
				<!-- <th class="c4">OPD</th> -->
				<th class="c5"></th>
			</tr>
		</tfoot>
		<tbody>
			<?php $nomor = 1;
			foreach ($hspk as $row) : ?>
				<tr class="">
					<td class="c1"><?= $nomor++; ?></td>
					<td><?= $row['hspk_paket']; ?></td>
					<td class="c2"><?= $row['hspk_satuan']; ?></td>
					<td class="c2">
						<?php $komponen = $db->table('tb_hspk_komponen')->getWhere(['hspk_id' => $row['id_hspk']])->getNumRows(); ?>
						<a class="btn btn-success btn-circle btn-xs" href="<?= base_url('/admin/ssh/hspk_komponen/data/' . $row['id_hspk'] . '/' . $opd['id']); ?>">
							<?= $komponen . '   '; ?><i class="nav-icon fas fa-list"></i>
						</a>
					</td>
					<!-- ------------------------------------------------------------------------------------ -->
					<?php
					$A = $db->table('tb_hspk_komponen')->select('tb_hspk_komponen.index')->select('tb_ssh.harga')->join('tb_ssh', 'tb_hspk_komponen.ssh_id = tb_ssh.id_ssh', 'LEFT')->getWhere(['tb_hspk_komponen.tahun' => $_SESSION['tahun'], 'tb_hspk_komponen.hspk_id' => $row['id_hspk'], 'tb_hspk_komponen.group' => 'A'])->getResultArray();
					$B = $db->table('tb_hspk_komponen')->select('tb_hspk_komponen.index')->select('tb_ssh.harga')->join('tb_ssh', 'tb_hspk_komponen.ssh_id = tb_ssh.id_ssh', 'LEFT')->getWhere(['tb_hspk_komponen.tahun' => $_SESSION['tahun'], 'tb_hspk_komponen.hspk_id' => $row['id_hspk'], 'tb_hspk_komponen.group' => 'B'])->getResultArray();
					$C = $db->table('tb_hspk_komponen')->select('tb_hspk_komponen.index')->select('tb_ssh.harga')->join('tb_ssh', 'tb_hspk_komponen.ssh_id = tb_ssh.id_ssh', 'LEFT')->getWhere(['tb_hspk_komponen.tahun' => $_SESSION['tahun'], 'tb_hspk_komponen.hspk_id' => $row['id_hspk'], 'tb_hspk_komponen.group' => 'C'])->getResultArray();

					foreach ($A as $roA) :
						$num[$row['id_hspk'] . 'A'][] = ($roA['harga'] * $roA['index']);
					endforeach;
					foreach ($B as $roB) :
						$num[$row['id_hspk'] . 'B'][] = ($roB['harga'] * $roB['index']);
					endforeach;
					foreach ($C as $roC) :
						$num[$row['id_hspk'] . 'C'][] = ($roC['harga'] * $roC['index']);
					endforeach; ?>
					<!-- ------------------------------------------------------------------------------------ -->
					<td class="text-right">
						<?php
						isset($num[$row['id_hspk'] . 'A']) ? $AA = ($num[$row['id_hspk'] . 'A']) : $AA = ['0'];
						isset($num[$row['id_hspk'] . 'B']) ? $BB = ($num[$row['id_hspk'] . 'B']) : $BB = ['0'];
						isset($num[$row['id_hspk'] . 'C']) ? $CC = ($num[$row['id_hspk'] . 'C']) : $CC = ['0'];
						echo number_format((array_sum($AA) + array_sum($BB) + array_sum($CC)), 2, ',', '.');
						?>
					</td>
					<!-- <td class="text-center"><?= $row['name']; ?></td> -->
					<td class="align-baseline text-center">
						<!-- ------------------------------------------------------------------------------------------- -->
						<?php $jawab = $db->table('tb_verifikasi')
							->join('auth_groups', 'tb_verifikasi.opd_id = auth_groups.id', 'left')
							->getWhere(['hspk_id' => $row['id_hspk']])->getRow();
						if (isset($jawab)) :
						?>
							<div class="d-flex justify-content-center">
								<?php if ($jawab->verifikasi == 'lolos') : ?>
									<a class="dropdown-toggle btn btn-success btn-circle btn-xs" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										Verifikasi
									</a>
									<div class="dropdown-menu dropdown-menu-right" style="width: 600px;" aria-labelledby="navbarDropdown">
										<a class="dropdown-item" href="#">
											<div class="media">
												<div class="media-body">
													<h3 class="dropdown-item-title">
														Verifikator:
													</h3>
													<p class="text-sm"><?= $jawab->nm_verifikator; ?></p>
												</div>
											</div>
										</a>
										<div class="dropdown-divider"></div>
										<form action="<?= base_url('/admin/verifikasi/data/verifikasi') ?>" method="POST">
											<textarea name="verifikasi_keterangan" class="dropdown-item form-control" placeholder="Keterangan Dikembalikan" required></textarea>
											<input type="hidden" name="id_hspk" value="<?= $row['id_hspk']; ?>">
											<button type="submit" name="dikembalikan_lolos" class="dropdown-item" style="color: white;background: #007bff;font-weight: bold;">Kembalikan</button>
										</form>
										<div class="dropdown-divider"></div>
										<form action="<?= base_url('/admin/verifikasi/data/verifikasi') ?>" method="POST">
											<textarea name="verifikasi_keterangan" class="dropdown-item form-control" placeholder="Keterangan Ditolak"></textarea>
											<input type="hidden" name="id_hspk" value="<?= $row['id_hspk']; ?>">
											<button type="submit" name="ditolak_lolos" class="dropdown-item" style="color: white;background: #dc3545;font-weight: bold;">Tolak</button>
										</form>
									</div>
								<?php elseif ($jawab->verifikasi == 'ditolak') : ?>
									<a class="dropdown-toggle btn btn-danger btn-circle btn-xs" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										Ditolak
									</a>
									<div class="dropdown-menu dropdown-menu-right" style="width: 600px;" aria-labelledby="navbarDropdown">
										<a class="dropdown-item" href="#">
											<div class="media">
												<div class="media-body">
													<h3 class="dropdown-item-title">
														Keterangan:
													</h3>
													<p class="text-sm" style="white-space: pre-wrap;"><?= $jawab->verifikasi_keterangan; ?></p>
													<h3 class="dropdown-item-title">
														Verifikator:
													</h3>
													<p class="text-sm"><?= $jawab->nm_verifikator; ?></p>
												</div>
											</div>
										</a>
									</div>
								<?php elseif ($jawab->verifikasi == 'dikembalikan') : ?>
									<a class="dropdown-toggle btn btn-danger btn-circle btn-xs" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										Dikembalikan
									</a>
									<div class="dropdown-menu dropdown-menu-right" style="width: 600px;" aria-labelledby="navbarDropdown">
										<a class="dropdown-item" href="#">
											<div class="media">
												<div class="media-body">
													<h3 class="dropdown-item-title">
														Keterangan:
													</h3>
													<p class="text-sm" style="white-space: pre-wrap;"><?= $jawab->verifikasi_keterangan; ?></p>
													<h3 class="dropdown-item-title">
														Verifikator:
													</h3>
													<p class="text-sm"><?= $jawab->nm_verifikator; ?></p>
												</div>
											</div>
										</a>
									</div>
								<?php elseif ($jawab->verifikasi == 'edit') : ?>
									<a class="dropdown-toggle btn btn-primary btn-circle btn-xs" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										Diperbaharui
									</a>
									<div class="dropdown-menu dropdown-menu-right" style="width: 600px;" aria-labelledby="navbarDropdown">
										<h5 class="dropdown-item"> Diajukan Kembali </h5>
										<div class="dropdown-divider"></div>
										<a class="dropdown-item" href="#">
											<div class="media">
												<div class="media-body">
													<h3 class="dropdown-item-title">
														Keterangan:
													</h3>
													<p class="text-sm" style="white-space: pre-wrap;"><?= $jawab->verifikasi_keterangan; ?></p>
													<h3 class="dropdown-item-title">
														Verifikator:
													</h3>
													<p class="text-sm"><?= $jawab->nm_verifikator; ?></p>
												</div>
											</div>
										</a>
										<div class="dropdown-divider"></div>
										<form action="<?= base_url('/admin/verifikasi/data/verifikasi') ?>" method="POST">
											<input type="hidden" name="id_hspk" value="<?= $row['id_hspk']; ?>">
											<button type="submit" name="lolos_ubah" class="dropdown-item" style="color: white;background: #28a745;font-weight: bold;">Terima</button>
										</form>
										<div class="dropdown-divider"></div>
										<form action="<?= base_url('/admin/verifikasi/data/verifikasi') ?>" method="POST">
											<textarea name="verifikasi_keterangan" class="dropdown-item form-control" placeholder="Keterangan Dikembalikan" required></textarea>
											<input type="hidden" name="id_hspk" value="<?= $row['id_hspk']; ?>">
											<button type="submit" name="dikembalikan_ubah" class="dropdown-item" style="color: white;background: #007bff;font-weight: bold;">Kembalikan</button>
										</form>
										<div class="dropdown-divider"></div>
										<form action="<?= base_url('/admin/verifikasi/data/verifikasi') ?>" method="POST">
											<textarea name="verifikasi_keterangan" class="dropdown-item form-control" placeholder="Keterangan Ditolak" required></textarea>
											<input type="hidden" name="id_hspk" value="<?= $row['id_hspk']; ?>">
											<button type="submit" name="ditolak_ubah" class="dropdown-item" style="color: white;background: #dc3545;font-weight: bold;">Tolak</button>
										</form>
									</div>
								<?php elseif ($jawab->verifikasi == 'diajukan') : ?>
									<a class="dropdown-toggle btn btn-warning btn-circle btn-xs" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										Belum Verifikasi
									</a>
									<div class="dropdown-menu dropdown-menu-right" style="width: 600px;" aria-labelledby="navbarDropdown">
										<form action="<?= base_url('/admin/verifikasi/data/verifikasi') ?>" method="POST">
											<input type="hidden" name="id_hspk" value="<?= $row['id_hspk']; ?>">
											<button type="submit" name="lolos" class="dropdown-item" style="color: white;background: #28a745;font-weight: bold;">Terima</button>
										</form>
										<div class="dropdown-divider"></div>
										<form action="<?= base_url('/admin/verifikasi/data/verifikasi') ?>" method="POST">
											<textarea name="verifikasi_keterangan" class="dropdown-item form-control" placeholder="Keterangan Dikembalikan" required></textarea>
											<input type="hidden" name="id_hspk" value="<?= $row['id_hspk']; ?>">
											<button type="submit" name="dikembalikan" class="dropdown-item" style="color: white;background: #007bff;font-weight: bold;">Kembalikan</button>
										</form>
										<div class="dropdown-divider"></div>
										<form action="<?= base_url('/admin/verifikasi/data/verifikasi') ?>" method="POST">
											<textarea name="verifikasi_keterangan" class="dropdown-item form-control" placeholder="Keterangan Ditolak" required></textarea>
											<input type="hidden" name="id_hspk" value="<?= $row['id_hspk']; ?>">
											<button type="submit" name="ditolak" class="dropdown-item" style="color: white;background: #dc3545;font-weight: bold;">Tolak</button>
										</form>
									</div>
								<?php endif; ?>
							</div>
						<?php endif; ?>
						<!-- ------------------------------------------------------------------------------------------- -->
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>
<?= $this->endSection(); ?>

<?= $this->section('Javascript'); ?>
<!-- DataTables  & Plugins -->
<script src="<?= base_url('/toping/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('/toping/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>

<script>
	$(function() {
		bsCustomFileInput.init();
	});
	$(function() {
		$("#example1").DataTable({
			"responsive": true,
			"autoWidth": false,
			"ordering": false,
		});
		$('#example2').DataTable({
			"paging": true,
			"lengthChange": false,
			"searching": false,
			"ordering": true,
			"info": true,
			"autoWidth": false,
			"responsive": true,
		});
	});
</script>
<?= $this->endSection(); ?>
<?= $this->extend('_layout/template'); ?>

<?= $this->section('stylesheet'); ?>
<link rel="stylesheet" href="<?= base_url('/toping/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
<style>
	.c1 {
		width: 50px;
		text-align: center;
	}

	.c2 {
		width: 150px;
	}

	.c3 {
		width: 300px;
	}

	.c4 {
		width: 450px;
	}

	.c5 {
		width: 550px;
	}

	.c6 {
		width: 90px;
	}

	.c7 {
		width: 150px;
	}

	.c8 {
		width: 80px;
	}

	.c9 {
		width: 150px;
	}
</style>
<?= $this->endSection(); ?>

<?= $this->section('tombol'); ?>
<div style="width:90px;position: absolute;right: 0px;">
	<a href="<?= base_url('/user/ssh/ssh_pengajuan/pengajuan_add'); ?>">
		<li class="btn btn-block btn-warning btn-sm" active><i class="nav-icon fa fa-plus"></i> Add</li>
	</a>
</div>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="card-body">

	<table id="example1" class="table table-bordered">
		<thead>
			<tr>
				<th class="c1">No</th>
				<th class="c4">Komponen</th>
				<th class="c5">Spesifikasi</th>
				<th class="c6">satuan</th>
				<th class="c7">harga</th>
				<th class="c8">Kelompok</th>
				<th class="c9">Aksi</th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<th class="c1">No</th>
				<th class="c4">Komponen</th>
				<th class="c5">Spesifikasi</th>
				<th class="c6">satuan</th>
				<th class="c7">harga</th>
				<th class="c8">Kelompok</th>
				<th class="c9">Aksi</th>
			</tr>
		</tfoot>
		<tbody>
			<?php $nomor = 1;
			foreach ($ssh as $row) : ?>
				<tr class="">
					<td><?= $nomor++; ?></td>
					<td><?= $row['komponen']; ?></td>
					<td><?= $row['spesifikasi']; ?></td>
					<td><?= $row['satuan']; ?></td>
					<td><?= $row['harga']; ?></td>
					<td><?= $row['kelompok']; ?></td>

					<!-- ------------------------------------------------------------------------------------ -->
					<td class="text-center align-baseline">
						<div class="justify-content-center">
							<?php $jawab = $db->table('tb_ssh_verifikasi')->join('auth_groups', 'tb_ssh_verifikasi.opd_id = auth_groups.id', 'left')->getWhere(['ssh_id' => $row['id_ssh']])->getRow();
							if (isset($jawab)) :
							?>
								<?php if ($jawab->verifikasi == 'lolos') : ?>
									<a class="dropdown-toggle btn btn-success btn-circle btn-xs" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										Lolos Verifikasi
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
									<a class="btn btn-info btn-circle btn-xs" href="<?= base_url() . '/user/ssh/ssh_pengajuan/pengajuan_edit/' . $row['id_ssh']; ?>">
										<i class="nav-icon fas fa-pen-alt"></i>
									</a>
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
										<div class="dropdown-divider"></div>
										<form action="<?= base_url('/user/verifikasi/data/ajukan_ssh_ulang/') ?>" method="POST">
											<input type="hidden" name="id_ssh" value="<?= $row['id_ssh']; ?>">
											<button type="submit" name="ajukan_kembali" class="dropdown-item" style="color: white;background: green;font-weight: bold;"> Ajukan Kembali</button>
										</form>
									</div>
								<?php elseif ($jawab->verifikasi == 'edit') : ?>
									<a class="dropdown-toggle btn btn-primary btn-circle btn-xs" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										Diperbaharui
									</a>
									<div class="dropdown-menu dropdown-menu-right" style="width: 600px;" aria-labelledby="navbarDropdown">
										<h6 class="dropdown-item"> Diajukan Kembali : Menunggu verifikasi ulang </h6>
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
									</div>
								<?php elseif ($jawab->verifikasi == 'diajukan') : ?>
									<a class="dropdown-toggle btn btn-warning btn-circle btn-xs" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										Menunggu Verifikasi
									</a>
								<?php endif; ?>
							<?php else : ?>
								<!-- ------------------------------------------------------------------------------------------- -->
								<a class="btn btn-info btn-circle btn-xs" href="<?= base_url() . '/user/ssh/ssh_pengajuan/pengajuan_edit/' . $row['id_ssh']; ?>">
									<i class="nav-icon fas fa-pen-alt"></i>
								</a>
								<a class="btn btn-danger btn-circle btn-xs" onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){location.href='<?= base_url() . '/user/ssh/hspk/hspk_hapus/' . $row['id_ssh']; ?>'}" href="#">
									<i class="nav-icon fas fa-trash-alt"></i>
								</a>
								<!-- ------------------------------------------------------------------------------------------- -->
								<a class="btn btn-success btn-circle btn-xs" onclick="if(confirm('Ajukan Verifikasi ??')){location.href='<?= base_url() . '/user/verifikasi/data/ajukan_ssh/' . $row['id_ssh']; ?>'}">
									Ajukan Verifikasi
								</a>
							<?php endif; ?>
							<!-- ------------------------------------------------------------------------------------------- -->
						</div>
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
<?= $this->extend('_layout/template'); ?>

<?= $this->section('stylesheet'); ?>
<link rel="stylesheet" href="<?= base_url('/toping/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="card-body">
	<table id="example1" class="table table-bordered table-responsive" style="height: 69vh;">
		<thead>
			<tr>
				<th style="text-align: center;" width="40px">No</th>
				<th style="text-align: center;" width="60px">Kode</th>
				<th>Sub Rincian Objek</th>
				<th style="text-align: center;" width="60px">Kelompok</th>
				<th style="width: 80px; text-align:center;">Aksi</th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<th style="text-align:center;">No</th>
				<th style="text-align: center;" width="60px">Kode</th>
				<th>Sub Rincian Objek</th>
				<th style="text-align: center;" width="60px">Kelompok</th>
				<th style="text-align:center;">Aksi</th>
			</tr>
		</tfoot>
		<tbody>
			<?php $nomor = 1;
			foreach ($jenis_rincian_objek_sub as $row) : ?>
				<tr>
					<td><?= $nomor++; ?></td>
					<td><?= $row['kode_jenis_rincian_objek_sub']; ?></a></td>
					<td style="width: 100%;"><?= $row['jenis_rincian_objek_sub']; ?></a></td>
					<td><?= $row['kelompok_id']; ?></a></td>
					<td style="text-align: center;">
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
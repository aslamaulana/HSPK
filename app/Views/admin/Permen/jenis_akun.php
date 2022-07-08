<?= $this->extend('_layout/template'); ?>
<?= $this->section('content'); ?>
<div class="card-body">
	<table id="example1" class="table table-bordered">
		<thead>
			<tr>
				<th style="text-align: center;" width="40px">No</th>
				<th style="text-align: center;" width="60px">Kode</th>
				<th>Akun</th>
				<th style="width: 80px; text-align:center;">Aksi</th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<th style="text-align:center;">No</th>
				<th style="text-align: center;" width="60px">Kode</th>
				<th>Akun</th>
				<th style="text-align:center;">Aksi</th>
			</tr>
		</tfoot>
		<tbody>
			<?php $nomor = 1;
			foreach ($jenis_akun as $row) : ?>
				<tr>
					<td><?= $nomor++; ?></td>
					<td><?= $row['kode_jenis_akun']; ?></a></td>
					<td><?= $row['jenis_akun']; ?></a></td>
					<td style="text-align: center;">
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>
<?= $this->endSection(); ?>
<?= $this->extend('_layout/template'); ?>

<?= $this->section('stylesheet'); ?>
<style>
	.c1 {
		width: 30px;
		text-align: center;
	}

	.c2 {}

	.c3 {
		width: 170px;
		text-align: center;
	}

	.c4 {
		width: 170px;
		text-align: center;
	}

	.c5 {
		text-align: center;
		width: 80px;
	}
</style>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="card-body">
	<b>
		<div style="padding-left:20px;">OPD &nbsp;&nbsp;:&nbsp;<?= $opd['description']; ?></div>
		<div style="padding-left:20px;">Paket :&nbsp;<?= $hspk1['hspk_paket']; ?></div>
	</b>
	<table id="example2" class="table table-bordered">
		<thead>
			<tr class="">
				<th class="c1">No</th>
				<th class="">Komponen</th>
				<th class="c2">Spesifikasi</th>
				<th class="c3">Satuan</th>
				<th class="c3">Koefisien</th>
				<th class="c4">Harga Satuan (Rp)</th>
				<th class="c4">Jumlah Harga (Rp)</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td style="padding:3px;" class="text-center">1</td>
				<td style="padding:3px;" class="text-center">2</td>
				<td style="padding:3px;" class="text-center">3</td>
				<td style="padding:3px;" class="text-center">4</td>
				<td style="padding:3px;" class="text-center">5</td>
				<td style="padding:3px;" class="text-center">6</td>
				<td style="padding:3px;" class="text-center">7</td>
			</tr>
			<!--Tenaga Kerja-->
			<tr style="background: antiquewhite;">
				<td class="text-center">A</td>
				<td colspan="6">
					<a href="<?= base_url('/user/ssh/hspk_komponen/data_add/' . $id_hspk . '/?g=A'); ?>" title="Tambah Komponen Tenaga Kerja">
						Tenaga Kerja
					</a>
				</td>
			</tr>
			<?php $nomor = 1;
			foreach ($A as $row) : ?>
				<tr>
					<td class="text-center"><?= $nomor++; ?></td>
					<td><?= $row['komponen']; ?></td>
					<td><?= $row['spesifikasi']; ?></td>
					<td class="text-center"><?= $row['satuan']; ?></td>
					<td class="text-center"><?= $row['index']; ?></td>
					<td class="text-right"><?= number_format($row['harga'], 2, ',', '.'); ?></td>
					<td class="text-right"><?= number_format(($row['harga'] * $row['index']), 2, ',', '.'); ?></td>
					<?php $num['A'][] = ($row['harga'] * $row['index']); ?>
				</tr>
			<?php endforeach; ?>
			<tr style="font-weight: bold;">
				<td colspan="6" class="text-right">Jumlah Harga Tenaga Kerja</td>
				<td class="text-right"><?= isset($num['A']) ? number_format(array_sum($num['A']), 2, ',', '.') : '-'; ?></td>
			</tr>
			<!--Tenaga Kerja-->

			<!--Bahan-->
			<tr style="background: antiquewhite;">
				<td class="text-center">B</td>
				<td colspan="6">
					<a href="<?= base_url('/user/ssh/hspk_komponen/data_add/' . $id_hspk . '/?g=B'); ?>" title="Tambah Komponen Bahan">
						Bahan
					</a>
				</td>
			</tr>
			<?php $nomor = 1;
			foreach ($B as $row) : ?>
				<tr>
					<td class="text-center"><?= $nomor++; ?></td>
					<td><?= $row['komponen']; ?></td>
					<td><?= $row['spesifikasi']; ?></td>
					<td class="text-center"><?= $row['satuan']; ?></td>
					<td class="text-center"><?= $row['index']; ?></td>
					<td class="text-right"><?= number_format($row['harga'], 2, ',', '.'); ?></td>
					<td class="text-right"><?= number_format(($row['harga'] * $row['index']), 2, ',', '.'); ?></td>
					<?php $num['B'][] = ($row['harga'] * $row['index']); ?>
				</tr>
			<?php endforeach; ?>
			<tr style="font-weight: bold;">
				<td colspan="6" class="text-right">Jumlah Harga Bahan</td>
				<td class="text-right"><?= isset($num['B']) ? number_format(array_sum($num['B']), 2, ',', '.') : '-'; ?></td>
			</tr>
			<!--Bahan-->
			<!--Peralatan-->
			<tr style="background: antiquewhite;">
				<td class="text-center">C</td>
				<td colspan="6">
					<a href="<?= base_url('/user/ssh/hspk_komponen/data_add/' . $id_hspk . '/?g=C'); ?>" title="Tambah Komponen Peralatan">
						Peralatan
					</a>
				</td>
			</tr>
			<?php $nomor = 1;
			foreach ($C as $row) : ?>
				<tr>
					<td class="text-center"><?= $nomor++; ?></td>
					<td><?= $row['komponen']; ?></td>
					<td><?= $row['spesifikasi']; ?></td>
					<td class="text-center"><?= $row['satuan']; ?></td>
					<td class="text-center"><?= $row['index']; ?></td>
					<td class="text-right"><?= number_format($row['harga'], 2, ',', '.'); ?></td>
					<td class="text-right"><?= number_format(($row['harga'] * $row['index']), 2, ',', '.'); ?></td>
					<?php $num['C'][] = ($row['harga'] * $row['index']); ?>
				</tr>
			<?php endforeach; ?>
			<tr style="font-weight: bold;">
				<td colspan="6" class="text-right">Jumlah Harga Peralatan</td>
				<td class="text-right"><?= isset($num['C']) ? number_format(array_sum($num['C']), 2, ',', '.') : '-'; ?></td>
			</tr>
			<tr>
				<td class="text-center">D</td>
				<td colspan="4">Jumlah Harga Tenaga Kerja, Bahan dan Peralatan (A+B+C)</td>
				<td></td>
				<td class="text-right">
					<?php
					isset($num['A']) ? $AA = ($num['A']) : $AA = ['0'];
					isset($num['C']) ? $CC = ($num['C']) : $CC = ['0'];
					isset($num['B']) ? $BB = ($num['B']) : $BB = ['0'];
					echo number_format((array_sum($AA) + array_sum($BB) + array_sum($CC)), 2, ',', '.');
					?>
				</td>
			</tr>

		</tbody>
	</table>
</div>
<?= $this->endSection(); ?>
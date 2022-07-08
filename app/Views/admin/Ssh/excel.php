<!DOCTYPE html>
<html lang="">
<table>
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td>Filter</td>
		<td>Filter</td>
		<td>Filter</td>
	</tr>
</table>
<?php foreach ($hspk as $row) : ?>
	<table>
		<tbody>
			<tr>
				<td colspan="9"><?= $row['description']; ?></td>
				<td></td>
				<td>OPD</td>
				<td></td>
			</tr>
			<?php $rincian_objek = $db->table('tb_hspk')->DISTINCT('tb_hspk.id_hspk')->select('tb_jenis_rincian_objek_sub.jenis_rincian_objek_sub')->select('tb_jenis_rincian_objek_sub.id_jenis_rincian_objek_sub')->join('tb_jenis_rincian_objek_sub', 'tb_hspk.jenis_rincian_objek_sub_id = tb_jenis_rincian_objek_sub.id_jenis_rincian_objek_sub', 'LEFT')->join('tb_verifikasi', 'tb_hspk.id_hspk = tb_verifikasi.hspk_id', 'LEFT')->getWhere(['tb_hspk.opd_id' => $row['opd_id'], 'tb_hspk.tahun' => $_SESSION['tahun'], 'tb_verifikasi.verifikasi' => 'lolos'])->getResultArray(); ?>
			<?php foreach ($rincian_objek as $ros) : ?>
				<tr>
					<td></td>
					<td colspan="8"><?= $ros['jenis_rincian_objek_sub']; ?></td>
					<td></td>
					<td>Rincian_sub_objek</td>
				</tr>
				<?php $hspk = $db->table('tb_hspk')->select('tb_hspk.hspk_paket')->select('tb_hspk.id_hspk')->join('tb_verifikasi', 'tb_hspk.id_hspk = tb_verifikasi.hspk_id', 'LEFT')->getWhere(['tb_hspk.jenis_rincian_objek_sub_id' => $ros['id_jenis_rincian_objek_sub'], 'tb_hspk.tahun' => $_SESSION['tahun'], 'tb_verifikasi.verifikasi' => 'lolos'])->getResultArray(); ?>
				<?php foreach ($hspk as $rol) : ?>
					<tr>
						<td></td>
						<td></td>
						<td colspan="7"><?= $rol['hspk_paket']; ?></td>
						<td></td>
						<td>hspk</td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td width="0.5cm"><b>No</b></td>
						<td width="0.5cm"><b>Komponen</b></td>
						<td width="40px"><b>spesifikasi</b></td>
						<td width="40px"><b>Satuan</b></td>
						<td width="60px"><b>Koefisien</b></td>
						<td width="60px"><b>Harga Satuan (Rp)</b></td>
						<td width="60px"><b>Jumlah Harga (Rp)</b></td>
						<td></td>
						<td>Judul</td>
					</tr>
					<tr class="font-weight-bold">
						<td></td>
						<td></td>
						<td>A</td>
						<td colspan="6">Tenaga Kerja</td>
						<td></td>
						<td>Tenaga_kerja</td>
					</tr>
					<?php $no = 1;
					$hspk_komponen = $db->table('tb_hspk_komponen')->select('tb_hspk_komponen.index')->select('tb_ssh.*')->join('tb_ssh', 'tb_hspk_komponen.ssh_id = tb_ssh.id_ssh', 'LEFT')->getWhere(['tb_hspk_komponen.hspk_id' => $rol['id_hspk'], 'tb_hspk_komponen.group' => 'A'])->getResultArray(); ?>
					<?php foreach ($hspk_komponen as $rox) : ?>
						<tr>
							<td></td>
							<td></td>
							<td><?= $nn = $no++ ?></td>
							<td><?= $rox['komponen']; ?></td>
							<td><?= $rox['spesifikasi']; ?></td>
							<td><?= $rox['satuan']; ?></td>
							<td><?= $rox['index']; ?></td>
							<td><?= $rox['harga']; ?></td>
							<td><?= $num['A'][] = ($rox['harga'] * $rox['index']); ?></td>
							<td></td>
							<td></td>
							<td>Tenaga_kerja<?= $nn; ?></td>
						</tr>
					<?php endforeach; ?>
					<tr>
						<td></td>
						<td></td>
						<td colspan="6" class="text-right">Jumlah Harga Tenaga Kerja</td>
						<td class="text-right"><?= isset($num['A']) ? number_format(array_sum($num['A']), 2, ',', '.') : '-'; ?></td>
						<td></td>
						<td></td>
						<td></td>
						<td>Total_Tenaga_kerja</td>
					</tr>
					<tr class="font-weight-bold">
						<td></td>
						<td></td>
						<td>B</td>
						<td colspan="6">Bahan</td>
						<td></td>
						<td>Bahan</td>
					</tr>
					<?php $no = 1;
					$hspk_komponen = $db->table('tb_hspk_komponen')->select('tb_hspk_komponen.index')->select('tb_ssh.*')->join('tb_ssh', 'tb_hspk_komponen.ssh_id = tb_ssh.id_ssh', 'LEFT')->getWhere(['tb_hspk_komponen.hspk_id' => $rol['id_hspk'], 'tb_hspk_komponen.group' => 'B'])->getResultArray(); ?>
					<?php foreach ($hspk_komponen as $rox) : ?>
						<tr>
							<td></td>
							<td></td>
							<td><?= $nn = $no++ ?></td>
							<td><?= $rox['komponen']; ?></td>
							<td><?= $rox['spesifikasi']; ?></td>
							<td><?= $rox['satuan']; ?></td>
							<td><?= $rox['index']; ?></td>
							<td><?= $rox['harga']; ?></td>
							<td><?= $num['B'][] = ($rox['harga'] * $rox['index']); ?></td>
							<td></td>
							<td></td>
							<td>Bahan<?= $nn; ?></td>
						</tr>
					<?php endforeach; ?>
					<tr>
						<td></td>
						<td></td>
						<td colspan="6" class="text-right">Jumlah Harga Bahan</td>
						<td class="text-right"><?= isset($num['B']) ? number_format(array_sum($num['B']), 2, ',', '.') : '-'; ?></td>
						<td></td>
						<td></td>
						<td></td>
						<td>Total_Bahan</td>
					</tr>
					<tr class="font-weight-bold">
						<td></td>
						<td></td>
						<td>C</td>
						<td colspan="6">Peralatan</td>
						<td></td>
						<td>Peralatan</td>
					</tr>
					<?php $no = 1;
					$hspk_komponen = $db->table('tb_hspk_komponen')->select('tb_hspk_komponen.index')->select('tb_ssh.*')->join('tb_ssh', 'tb_hspk_komponen.ssh_id = tb_ssh.id_ssh', 'LEFT')->getWhere(['tb_hspk_komponen.hspk_id' => $rol['id_hspk'], 'tb_hspk_komponen.group' => 'C'])->getResultArray(); ?>
					<?php foreach ($hspk_komponen as $rox) : ?>
						<tr>
							<td></td>
							<td></td>
							<td><?= $nn = $no++ ?></td>
							<td><?= $rox['komponen']; ?></td>
							<td><?= $rox['spesifikasi']; ?></td>
							<td><?= $rox['satuan']; ?></td>
							<td><?= $rox['index']; ?></td>
							<td><?= $rox['harga']; ?></td>
							<td><?= $num['C'][] = ($rox['harga'] * $rox['index']); ?></td>
							<td></td>
							<td></td>
							<td>Peralatan<?= $nn; ?></td>
						</tr>
					<?php endforeach; ?>
					<tr>
						<td></td>
						<td></td>
						<td colspan="6" class="text-right">Jumlah Peralatan</td>
						<td class="text-right"><?= isset($num['C']) ? number_format(array_sum($num['C']), 2, ',', '.') : '-'; ?></td>
						<td></td>
						<td></td>
						<td></td>
						<td>Total_Peralatan</td>
					</tr>
					<tr>
						<td></td>
						<td></td>
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
						<td></td>
						<td></td>
						<td></td>
						<td>(A+B+C)</td>
					</tr>
					<tr>
						<td colspan="9">&nbsp;</td>
					</tr>
				<?php endforeach; ?>
			<?php endforeach; ?>
		</tbody>
	</table>
<?php endforeach; ?>

</html>
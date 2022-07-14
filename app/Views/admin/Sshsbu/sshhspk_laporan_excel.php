<!DOCTYPE html>
<html lang="">
<table>
	<tbody>
		<tr>
			<td><b>Kode Rincian Objek</b></td>
			<td><b>Sub Rincian Objek</b></td>
			<td><b>Komponen</b></td>
			<td><b>Spesifikasi</b></td>
			<td><b>Satuan</b></td>
			<td><b>Harga</b></td>
			<td><b>Kelompok</b></td>
			<td><b>OPD</b></td>
		</tr>
		<?php $ssh = $db->table('tb_ssh')
			->select('tb_ssh.*')
			->select('tb_jenis_rincian_objek_sub.jenis_rincian_objek_sub')
			->select('tb_jenis_rincian_objek_sub.kode_jenis_rincian_objek_sub')
			->select('auth_groups.name')
			->join('tb_jenis_rincian_objek_sub', 'tb_ssh.jenis_rincian_objek_sub_id = tb_jenis_rincian_objek_sub.id_jenis_rincian_objek_sub', 'LEFT')
			->join('auth_groups', 'tb_ssh.opd_id = auth_groups.id', 'LEFT')
			->getWhere(['tb_ssh.opd_id' => $opd, 'tb_ssh.tahun' => $_SESSION['tahun']])->getResultArray(); ?>
		<?php foreach ($ssh as $rox) : ?>
			<tr>
				<td><?= $rox['kode_jenis_rincian_objek_sub']; ?></td>
				<td><?= $rox['jenis_rincian_objek_sub']; ?></td>
				<td><?= $rox['komponen']; ?></td>
				<td><?= $rox['spesifikasi']; ?></td>
				<td><?= $rox['satuan']; ?></td>
				<td><?= number_format(($rox['harga']), 2, ',', '.'); ?></td>
				<td><?= $rox['kelompok']; ?></td>
				<td><?= $rox['name']; ?></td>
			</tr>
		<?php endforeach; ?>
		<?php $ssh = $db->table('tb_hspk')
			->select('tb_hspk.*')
			->select('tb_jenis_rincian_objek_sub.jenis_rincian_objek_sub')
			->select('tb_jenis_rincian_objek_sub.kode_jenis_rincian_objek_sub')
			->select('auth_groups.name')
			->join('tb_jenis_rincian_objek_sub', 'tb_hspk.jenis_rincian_objek_sub_id = tb_jenis_rincian_objek_sub.id_jenis_rincian_objek_sub', 'LEFT')
			->join('auth_groups', 'tb_hspk.opd_id = auth_groups.id', 'LEFT')
			->getWhere(['tb_hspk.opd_id' => $opd, 'tb_hspk.tahun' => $_SESSION['tahun']])->getResultArray(); ?>
		<?php foreach ($ssh as $rox) : ?>
			<tr>
				<td><?= $rox['kode_jenis_rincian_objek_sub']; ?></td>
				<td><?= $rox['jenis_rincian_objek_sub']; ?></td>
				<td><?= $rox['hspk_paket']; ?></td>
				<td></td>
				<td><?= $rox['hspk_satuan']; ?></td>
				<?php
				$A = $db->table('tb_hspk_komponen')->select('tb_hspk_komponen.index')->select('tb_ssh.harga')->join('tb_ssh', 'tb_hspk_komponen.ssh_id = tb_ssh.id_ssh', 'LEFT')->getWhere(['tb_hspk_komponen.tahun' => $_SESSION['tahun'], 'tb_hspk_komponen.hspk_id' => $rox['id_hspk'], 'tb_hspk_komponen.group' => 'A'])->getResultArray();
				$B = $db->table('tb_hspk_komponen')->select('tb_hspk_komponen.index')->select('tb_ssh.harga')->join('tb_ssh', 'tb_hspk_komponen.ssh_id = tb_ssh.id_ssh', 'LEFT')->getWhere(['tb_hspk_komponen.tahun' => $_SESSION['tahun'], 'tb_hspk_komponen.hspk_id' => $rox['id_hspk'], 'tb_hspk_komponen.group' => 'B'])->getResultArray();
				$C = $db->table('tb_hspk_komponen')->select('tb_hspk_komponen.index')->select('tb_ssh.harga')->join('tb_ssh', 'tb_hspk_komponen.ssh_id = tb_ssh.id_ssh', 'LEFT')->getWhere(['tb_hspk_komponen.tahun' => $_SESSION['tahun'], 'tb_hspk_komponen.hspk_id' => $rox['id_hspk'], 'tb_hspk_komponen.group' => 'C'])->getResultArray();

				foreach ($A as $roA) :
					$num[$rox['id_hspk'] . 'A'][] = ($roA['harga'] * $roA['index']);
				endforeach;
				foreach ($B as $roB) :
					$num[$rox['id_hspk'] . 'B'][] = ($roB['harga'] * $roB['index']);
				endforeach;
				foreach ($C as $roC) :
					$num[$rox['id_hspk'] . 'C'][] = ($roC['harga'] * $roC['index']);
				endforeach; ?>
				<!-- ------------------------------------------------------------------------------------ -->
				<td class="text-right">
					<?php
					isset($num[$rox['id_hspk'] . 'A']) ? $AA = ($num[$rox['id_hspk'] . 'A']) : $AA = ['0'];
					isset($num[$rox['id_hspk'] . 'B']) ? $BB = ($num[$rox['id_hspk'] . 'B']) : $BB = ['0'];
					isset($num[$rox['id_hspk'] . 'C']) ? $CC = ($num[$rox['id_hspk'] . 'C']) : $CC = ['0'];
					echo number_format((array_sum($AA) + array_sum($BB) + array_sum($CC)), 2, ',', '.');
					// echo round(array_sum($AA) + array_sum($BB) + array_sum($CC));
					// echo array_sum($AA) + array_sum($BB) + array_sum($CC);
					?>
				</td>
				<td>HSPK</td>
				<td><?= $rox['name']; ?></td>
			</tr>
		<?php endforeach; ?>

	</tbody>
</table>

</html>
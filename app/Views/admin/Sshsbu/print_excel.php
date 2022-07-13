<!DOCTYPE html>
<html lang="">
<table>
	<tbody>
		<tr>
			<td><b>Sub Rincian Objek</b></td>
			<td><b>Komponen</b></td>
			<td><b>Spesifikasi</b></td>
			<td><b>Satuan</b></td>
			<td><b>Harga</b></td>
			<td><b>Kelompok</b></td>
			<td><b>OPD</b></td>
		</tr>
		<?php foreach ($ssh as $rox) : ?>
			<tr>
				<td><?= $rox['jenis_rincian_objek_sub']; ?></td>
				<td><?= $rox['komponen']; ?></td>
				<td><?= $rox['spesifikasi']; ?></td>
				<td><?= $rox['satuan']; ?></td>
				<td><?= $rox['harga']; ?></td>
				<td><?= $rox['kelompok']; ?></td>
				<td><?= $rox['name']; ?></td>
			</tr>
		<?php endforeach; ?>

	</tbody>
</table>

</html>
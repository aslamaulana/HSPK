<nav class="main-header navbar navbar-expand navbar-white navbar-light">
	<ul class="navbar-nav">
		<li class="nav-item">
			<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
		</li>
		<li class="nav-item">
			<select class="form-control" onchange="location = this.value;">
				<option <?= $_SESSION['tahun'] == '2021' ? 'selected' : ''; ?> value="<?= base_url('/home/Set_Tahun/2021') ?>">2021</option>
				<option <?= $_SESSION['tahun'] == '2022' ? 'selected' : ''; ?> value="<?= base_url('/home/Set_Tahun/2022') ?>">2022</option>
				<option <?= $_SESSION['tahun'] == '2023' ? 'selected' : ''; ?> value="<?= base_url('/home/Set_Tahun/2023') ?>">2023</option>
				<option <?= $_SESSION['tahun'] == '2024' ? 'selected' : ''; ?> value="<?= base_url('/home/Set_Tahun/2024') ?>">2024</option>
			</select>
		</li>
		<!-- <li class="nav-item d-none d-sm-inline-block">
			<a href="<?= base_url(); ?>" class="nav-link">Home</a>
		</li> -->
		<li class="nav-item d-none d-sm-inline-block">
			<a style="pointer-events: none" class="nav-link"><?= opd()->name; ?></a>
		</li>
	</ul>
	<ul class="navbar-nav ml-auto">
		<li class="nav-item d-none d-md-inline-block" style="font-size: larger;">
			<a style="pointer-events: none" class="nav-link">
				<p id="timer"></p>
			</a>
		</li>
		<li class="nav-item dropdown">
			<a class="nav-link" data-toggle="dropdown" href="#">
				<div class="image">
					<img src="<?= base_url('/toping/dist/img/user2-160x160.jpg') ?>" class="img-size-32 mr-3 img-circle" alt="User Image">
				</div>
				<span class="badge badge-success navbar-badge">&nbsp;&nbsp;</span>
			</a>
			<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
				<span class="dropdown-item dropdown-header"><?= user()->full_name; ?></span>
				<div class="dropdown-divider"></div>
				<a href="<?= base_url('/logout'); ?>" class="dropdown-item">
					<i class="fa fa-reply mr-2"></i> LogOut
				</a>
			</div>
		</li>
		<li class="nav-item">
			<a class="nav-link" data-widget="fullscreen" href="#" role="button">
				<i class="fas fa-expand-arrows-alt"></i>
			</a>
		</li>
		<!-- <li class="nav-item">
			<a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
				<i class="fas fa-th-large"></i>
			</a>
		</li> -->
	</ul>
</nav>

<?php
$timer = "no";
if ($timer == "aktif") {
?>
	<script>
		// Mengatur waktu akhir perhitungan mundur
		var countDownDate = new Date("Apr 30, 2022 22:50:25").getTime();

		// Memperbarui hitungan mundur setiap 1 detik
		var x = setInterval(function() {
			// Untuk mendapatkan tanggal dan waktu hari ini
			var now = new Date().getTime();
			// Temukan jarak antara sekarang dan tanggal hitung mundur
			var distance = countDownDate - now;
			// Perhitungan waktu untuk hari, jam, menit dan detik
			var days = Math.floor(distance / (1000 * 60 * 60 * 24));
			var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
			var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
			var seconds = Math.floor((distance % (1000 * 60)) / 1000);
			// Keluarkan hasil dalam elemen dengan id = "demo"
			document.getElementById("timer").innerHTML = days + "d " + hours + "h " +
				minutes + "m " + seconds + "s ";
			// Jika hitungan mundur selesai, tulis beberapa teks 
			if (distance < 0) {
				clearInterval(x);
				document.getElementById("timer").innerHTML = "EXPIRED";
				window.location.href = "<?php echo base_url('logout'); ?>";
			}
		}, 1000);
	</script>
<?php }	?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
	<!-- Brand Logo -->
	<a href="<?= base_url(); ?>" class="brand-link">
		<img src="<?= base_url('/toping/material/logo.png'); ?>" alt="AdminLTE Logo" style="width: 20%; margin-left: .8rem;">
		<!-- <img src="<?= base_url('/toping/material/logo.png'); ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
		<span class="brand-text font-weight-light">Siapaju</span>
	</a>

	<!-- Sidebar -->
	<div class="sidebar">
		<!-- Sidebar user panel (optional) -->
		<!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
			<div class="image">
				<img src="<?= base_url('/toping/dist/img/user2-160x160.jpg') ?>" class="img-circle elevation-2" alt="User Image">
			</div>
			<div class="info">
				<a href="#" class="d-block">Alexander Pierce</a>
			</div>
		</div> -->

		<!-- SidebarSearch Form -->
		<!-- <div class="form-inline">
			<div class="input-group" data-widget="sidebar-search">
				<input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
				<div class="input-group-append">
					<button class="btn btn-sidebar">
						<i class="fas fa-search fa-fw"></i>
					</button>
				</div>
			</div>
		</div> -->

		<nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
				<li class="nav-item ">
					<a href="<?= base_url('/home'); ?>" class="nav-link <?= $mn == 'home' ? 'active' : ''; ?>">
						<i class="nav-icon fas fa-tachometer-alt"></i>
						<p>
							Dashboard
							<!-- <i class="right fas fa-angle-left"></i> -->
						</p>
					</a>
				</li>
				<?php if (has_permission('Admin')) : ?>
					<li class="nav-item <?= $gr == 'skpd' ? 'menu-open' : ''; ?>">
						<a href="#" class="nav-link <?= $gr == 'skpd' ? 'active' : ''; ?>">
							<i class="nav-icon fas fa-university"></i>
							<p>
								SKPD
								<i class="fas fa-angle-left right"></i>
							</p>
						</a>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="<?= base_url('/admin/user/bidang'); ?>" class="nav-link <?= $mn == 'skpd' ? 'active' : ''; ?>">
									<i class="far nav-icon"></i>
									<p><small>1. </small> Skpd</p>
								</a>
							</li>
						</ul>
					</li>
				<?php endif; ?>
				<!-- <li class="nav-header">PD</li> -->
				<?php if (has_permission('Admin')) : ?>
					<li class="nav-item <?= $gr == 'jenis' ? 'menu-open' : ''; ?>">
						<a href="#" class="nav-link <?= $gr == 'jenis' ? 'active' : ''; ?>">
							<i class="nav-icon fas fa-comment"></i>
							<p>
								Permen
								<i class="fas fa-angle-left right"></i>
							</p>
						</a>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="<?= base_url('/admin/permen/jenis_akun'); ?>" class="nav-link <?= $mn == 'jenis_akun' ? 'active' : ''; ?>">
									<i class="far nav-icon"></i>
									<p><small>1. </small> Akun</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="<?= base_url('/admin/permen/jenis_kelompok'); ?>" class="nav-link <?= $mn == 'jenis_kelompok' ? 'active' : ''; ?>">
									<i class="far nav-icon"></i>
									<p><small>2. </small> Kelompok</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="<?= base_url('/admin/permen/jenis_jenis'); ?>" class="nav-link <?= $mn == 'jenis_jenis' ? 'active' : ''; ?>">
									<i class="far nav-icon"></i>
									<p><small>3. </small> Jenis</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="<?= base_url('/admin/permen/jenis_objek'); ?>" class="nav-link <?= $mn == 'jenis_objek' ? 'active' : ''; ?>">
									<i class="far nav-icon"></i>
									<p><small>3. </small> Objek</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="<?= base_url('/admin/permen/jenis_rincian_objek'); ?>" class="nav-link <?= $mn == 'jenis_rincian_objek' ? 'active' : ''; ?>">
									<i class="far nav-icon"></i>
									<p><small>3. </small> Rincian Objek</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="<?= base_url('/admin/permen/jenis_rincian_objek_sub'); ?>" class="nav-link <?= $mn == 'jenis_rincian_objek_sub' ? 'active' : ''; ?>">
									<i class="far nav-icon"></i>
									<p><small>3. </small> Sub Rincian Objek</p>
								</a>
							</li>
						</ul>
					</li>
					<li class="nav-item <?= $gr == 'ssh' ? 'menu-open' : ''; ?>">
						<a href="#" class="nav-link <?= $gr == 'ssh' ? 'active' : ''; ?>">
							<i class="nav-icon fas fa-comment"></i>
							<p>
								SSH/ SBU
								<i class="fas fa-angle-left right"></i>
							</p>
						</a>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="<?= base_url('/admin/ssh/opd_data_ssh'); ?>" class="nav-link <?= $mn == 'ssh_pengajuan' ? 'active' : ''; ?>">
									<i class="far nav-icon"></i>
									<p><small>1. </small> Pengajuan</p>
								</a>
							</li>
						</ul>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="<?= base_url('/admin/ssh/ssh'); ?>" class="nav-link <?= $mn == 'ssh' ? 'active' : ''; ?>">
									<i class="far nav-icon"></i>
									<p><small>2. </small> SSH/SBU</p>
								</a>
							</li>
						</ul>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="<?= base_url('/admin/sshsbu/ssh_laporan'); ?>" class="nav-link <?= $mn == 'ssh_laporan' ? 'active' : ''; ?>">
									<i class="far nav-icon"></i>
									<p><small>3. </small> SSH/SBU Cetak</p>
								</a>
							</li>
						</ul>
					</li>
					<li class="nav-item <?= $gr == 'a-hspk' ? 'menu-open' : ''; ?>">
						<a href="#" class="nav-link <?= $gr == 'a-hspk' ? 'active' : ''; ?>">
							<i class="nav-icon fas fa-comment"></i>
							<p>
								HSPK
								<i class="fas fa-angle-left right"></i>
							</p>
						</a>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="<?= base_url('/admin/ssh/opd_data'); ?>" class="nav-link <?= $mn == 'a-hspk' ? 'active' : ''; ?>">
									<i class="far nav-icon"></i>
									<p><small>1. </small> Hspk</p>
								</a>
							</li>
						</ul>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="<?= base_url('/admin/ssh/hspk_laporan'); ?>" class="nav-link <?= $mn == 'a-hspk-laporan' ? 'active' : ''; ?>">
									<i class="far nav-icon"></i>
									<p><small>2. </small> Laporan hspk</p>
								</a>
							</li>
						</ul>
					</li>
					<li class="nav-item <?= $gr == 'a-asb' ? 'menu-open' : ''; ?>">
						<a href="#" class="nav-link <?= $gr == 'a-asb' ? 'active' : ''; ?>">
							<i class="nav-icon fas fa-comment"></i>
							<p>
								ASB
								<i class="fas fa-angle-left right"></i>
							</p>
						</a>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="<?= base_url('/admin/asb/asb'); ?>" class="nav-link <?= $mn == 'a-asb' ? 'active' : ''; ?>">
									<i class="far nav-icon"></i>
									<p><small>1. </small> Asb</p>
								</a>
							</li>
						</ul>
					</li>
				<?php endif; ?>
				<?php if (has_permission('User')) : ?>
					<li class="nav-item <?= $gr == 'ssh' ? 'menu-open' : ''; ?>">
						<a href="#" class="nav-link <?= $gr == 'ssh' ? 'active' : ''; ?>">
							<i class="nav-icon fas fa-comment"></i>
							<p>
								SSH/ SBU
								<i class="fas fa-angle-left right"></i>
							</p>
						</a>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="<?= base_url('/user/ssh/ssh_pengajuan'); ?>" class="nav-link <?= $mn == 'ssh_pengajuan' ? 'active' : ''; ?>">
									<i class="far nav-icon"></i>
									<p><small>1. </small> Pengajuan</p>
								</a>
							</li>
						</ul>
					</li>
					<li class="nav-item <?= $gr == 'hspk' ? 'menu-open' : ''; ?>">
						<a href="#" class="nav-link <?= $gr == 'hspk' ? 'active' : ''; ?>">
							<i class="nav-icon fas fa-comment"></i>
							<p>
								HSPK
								<i class="fas fa-angle-left right"></i>
							</p>
						</a>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="<?= base_url('/user/ssh/hspk'); ?>" class="nav-link <?= $mn == 'hspk' ? 'active' : ''; ?>">
									<i class="far nav-icon"></i>
									<p><small>1. </small> hspk</p>
								</a>
							</li>
						</ul>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="<?= base_url('/user/ssh/hspk_laporan'); ?>" class="nav-link <?= $mn == 'hspk-laporan' ? 'active' : ''; ?>">
									<i class="far nav-icon"></i>
									<p><small>2. </small> Laporan hspk</p>
								</a>
							</li>
						</ul>
					</li>
				<?php endif; ?>
			</ul>
		</nav>
	</div>
</aside>
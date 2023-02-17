<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<?php
			$pengaturan = $this->m_data->get_data('pengaturan')->result();
			foreach($pengaturan as $p) {
		?>
  			<title><?php echo $p->nama?></title>
		  
		  
	<link href="<?php echo base_url().'/gambar/website/'.$p->logo; ?>" rel="icon">
	<?php }?>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/Ionicons/css/ionicons.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/skins/_all-skins.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/morris.js/morris.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/jvectormap/jquery-jvectormap.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/bootstrap-daterangepicker/daterangepicker.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">

		<header class="main-header">			
			<a href="<?php echo base_url(); ?>" class="logo">
				<?php
					$pengaturan = $this->m_data->get_data('pengaturan')->result();
					foreach($pengaturan as $p) {
				?>
				<span class="logo-lg"><b><?php echo $p->nama ?></b></span>
					<?php }?>
			</a>
			
			<nav class="navbar navbar-static-top">
				
				<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
					<span class="sr-only">Toggle navigation</span>
				</a>

				<div class="navbar-custom-menu">
					<ul class="nav navbar-nav">
						<li class="dropdown user user-menu">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<?php
								$id_user = $this->session->userdata('id');
								$user = $this->db->query("select * from pengguna where pengguna_id='$id_user'")->row();
								?>
								<img src="<?php echo base_url(); ?>gambar/profil/pengguna/<?php echo $user->foto ?>" width="30" height="30" class="img-circle">
								<span class="hidden-xs">HAK AKSES : <b><?php echo $this->session->userdata('level') ?></b></span>
							</a>
							<ul class="dropdown-menu">
								<li class="user-header">
								<?php
									$id_user = $this->session->userdata('id');
									$user = $this->db->query("select * from pengguna where pengguna_id='$id_user'")->row();
								?>
									<img src="<?php echo base_url(); ?>gambar/profil/pengguna/<?php echo $user->foto ?>" class="img-circle" alt="User Image">
									<p>
										<?php echo $this->session->userdata('username') ?>
										<small>Hak akses : <?php echo $this->session->userdata('level') ?></small>
									</p>
								</li>
								
								<li class="user-footer">
									<div class="pull-left">
										<a href="<?php echo base_url().'dashboard/profil' ?>" class="btn btn-default btn-flat">Profil</a>
									</div>
									<div class="pull-right">
										<a href="<?php echo base_url().'dashboard/keluar' ?>" class="btn btn-default btn-flat">Keluar</a>
									</div>
								</li>
							</ul>
						</li>
						
					</ul>
				</div>
			</nav>
		</header>
		<aside class="main-sidebar">
			<section class="sidebar">
				<div class="user-panel">
					<div class="pull-left image">
						<?php
							$id_user = $this->session->userdata('id');
							$user = $this->db->query("select * from pengguna where pengguna_id='$id_user'")->row();
						?>
						<img src="<?php echo base_url(); ?>gambar/profil/pengguna/<?php echo $user->foto ?>" class="img-circle" alt="User Image">
					</div>
					<div class="pull-left info">
						<?php 
						$id_user = $this->session->userdata('id');
						$user = $this->db->query("select * from pengguna where pengguna_id='$id_user'")->row();
						?>
						<p><?php echo $user->pengguna_nama; ?></p>
						<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
					</div>
				</div>
				
				<ul class="sidebar-menu" data-widget="tree">
					<li class="header">MAIN NAVIGATION</li>
					<li>
						<a href="<?php echo base_url().'dashboard' ?>">
							<i class="fa fa-dashboard"></i>
							<span>DASHBOARD</span>


						</a>
					</li>
					<?php 
					if($this->session->userdata('level') == "admin"){
					?>
					<li class="treeview">
						<a href="#"><i class="fa fa-th"></i><span>KATEGORI</span><i class="fa fa-angle-left pull-right"></i></a>
						<ul class="treeview-menu">
					<li>
						<a href="<?php echo base_url().'dashboard/kategori' ?>">
							<i class="fa fa-th"></i>
							<span>KATEGORI ARTIKEL</span>
						</a>
					</li>
					<li>
						<a href="<?php echo base_url().'dashboard/provinsi' ?>">
							<i class="fa fa-globe"></i>
							<span>KATEGORI PROVINSI</span>
						</a>
					</li>
					<li>
						<a href="<?php echo base_url().'dashboard/kota' ?>">
							<i class="fa fa-globe"></i>
							<span>KATEGORI KOTA</span>
						</a>
					</li>
					<li>
						<a href="<?php echo base_url().'dashboard/jurusan' ?>">
							<i class="fa fa-drivers-license"></i>
							<span>KATEGORI PROGRAM KEAHLIAN</span>
						</a>
					</li>
					<li>
						<a href="<?php echo base_url().'dashboard/pendapatan' ?>">
							<i class="fa fa-dollar"></i>
							<span>KATEGORI PENDAPATAN</span>
						</a>
					</li>
					<li>
						<a href="<?php echo base_url().'dashboard/pekerjaan' ?>">
							<i class="fa fa-black-tie"></i>
							<span>KATEGORI PEKERJAAN</span>
						</a>
					</li>
					<li>
						<a href="<?php echo base_url().'dashboard/pendidikan' ?>">
							<i class="fa fa-graduation-cap"></i>
							<span>KATEGORI PENDIDIKAN</span>
						</a>
					</li>
					<li>
						<a href="<?php echo base_url().'dashboard/kat_galeri' ?>">
							<i class="fa fa-image"></i>
							<span>KATEGORI GALERI</span>
						</a>
					</li>
						</ul>
					</li>
					<li class="treeview">
						<a href="#"><i class="fa fa-database"></i><span>DATA</span><i class="fa fa-angle-left pull-right"></i></a>
						<ul class="treeview-menu">
					<li>
						<a href="<?php echo base_url().'dashboard/datasiswa' ?>">
							<i class="fa fa-user-o"></i>
							<span>DATA SISWA BARU</span>
						</a>
					</li>
					<li>
						<a href="<?php echo base_url().'dashboard/dataortu' ?>">
							<i class="fa fa-user-o"></i>
							<span>DATA ORANG TUA SISWA</span>
						</a>
					</li>
						</ul>
					</li>
					<li class="treeview">
							<a href="#"><i class="fa fa-upload"></i><span>MANAJEMEN UPLOAD</span><i class="fa fa-angle-left pull-right"></i></a>
						<ul class="treeview-menu">
					<li>
						<a href="<?php echo base_url().'dashboard/kata' ?>">
							<i class="fa fa-video-camera"></i>
							<span>UPLOAD VIDEO KEGIATAN</span>
						</a>
					</li>

					<li>
						<a href="<?php echo base_url().'dashboard/banner' ?>">
							<i class="fa fa-file-image-o"></i>
							<span>UPLOAD BANNER HOME</span>
						</a>
					</li>

					<li>
						<a href="<?php echo base_url().'dashboard/galeri' ?>">
							<i class="fa fa-file-image-o"></i>
							<span>UPLOAD GALERI FOTO</span>
						</a>
					</li>
						</ul>
					</li>

					<li class="treeview">
							<a href="#"><i class="fa fa-thumb-tack"></i><span>BACKGROUND MENU</span><i class="fa fa-angle-left pull-right"></i></a>
						<ul class="treeview-menu">
							<li>
								<a href="<?php echo base_url().'dashboard/background' ?>">
									<i class="fa fa-edit"></i>
									<span>GANTI BACKGROUND LAMAN</span>
								</a>
							</li>
							<li>
								<a href="<?php echo base_url().'dashboard/bg_faq' ?>">
									<i class="fa fa-edit"></i>
									<span>GANTI FOTO FAQ</span>
								</a>
							</li>
						</ul>
					</li>

					<li class="treeview">
						<a href="#"><i class="fa fa-keyboard-o"></i><span>INPUT MENU</span><i class="fa fa-angle-left pull-right"></i></a>
						<ul class="treeview-menu">
							<li>
								<a href="<?php echo base_url().'dashboard/infoppdb' ?>">
								<i class="fa fa-sticky-note"></i>
									<span>INPUT INFO PPDB</span>
								</a>
							</li>
							<li>
								<a href="<?php echo base_url().'dashboard/partner' ?>">
								<i class="fa fa-sticky-note"></i>
									<span>INPUT PARTNER</span>
								</a>
							</li>
							
							<li>
								<a href="<?php echo base_url().'dashboard/guru' ?>">
									<i class="fa fa-graduation-cap"></i>
									<span>INPUT NAMA GURU</span>
								</a>
							</li>

							<li>
								<a href="<?php echo base_url().'dashboard/sambutan' ?>">
									<i class="fa fa-microphone"></i>
									<span>INPUT SAMBUTAN KEPSEK</span>
								</a>
							</li>

							<li>
								<a href="<?php echo base_url().'dashboard/faq' ?>">
									<i class="fa fa-question"></i>
									<span>INPUT PERTANYAAN</span>
								</a>
							</li>
						</ul>
					</li>
					<?php
					} 
					?>
					<li>
						<a href="<?php echo base_url().'dashboard/artikel' ?>">
							<i class="fa fa-pencil"></i>
							<span>ARTIKEL</span>
						</a>
					</li>

					<?php 
					if($this->session->userdata('level') == "admin"){
					?>
					<li>
						<a href="<?php echo base_url().'dashboard/pages' ?>">
							<i class="fa fa-files-o"></i>
							<span>PAGES</span>
						</a>
					</li>
					<li>
						<a href="<?php echo base_url().'dashboard/pengguna' ?>">
							<i class="fa fa-users"></i>
							<span>PENGGUNA & HAK AKSES</span>
						</a>
					</li>
					<li>
						<a href="<?php echo base_url().'dashboard/pengaturan' ?>">
							<i class="fa fa-edit"></i>
							<span>PENGATURAN WEBSITE</span>
						</a>
					</li>

					
					<?php
					} 
					?>

					<li>
						<a href="<?php echo base_url().'dashboard/profil' ?>">
							<i class="fa fa-user"></i>
							<span>PROFIL</span>
						</a>
					</li>
					<li>
						<a href="<?php echo base_url().'dashboard/ganti_password' ?>">
							<i class="fa fa-lock"></i>
							<span>GANTI PASSWORD</span>
						</a>
					</li>
					<li>
						<a href="<?php echo base_url().'dashboard/keluar' ?>">
							<i class="fa fa-share"></i>
							<span>KELUAR</span>
						</a>
					</li>
				</ul>
			</section>
		</aside>
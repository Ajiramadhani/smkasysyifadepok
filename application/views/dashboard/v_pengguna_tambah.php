<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Pengguna
			<small>Tambah Pengguna</small>
		</h1>
	</section>

	<section class="content">

		<div class="row">
			<div class="col-lg-6">
				<a href="<?php echo base_url().'dashboard/pengguna'; ?>" class="btn btn-sm btn-primary">Kembali</a>
				
				<br/>
				<br/>

				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">Pengguna</h3>
					</div>
					<div class="box-body">
						
						<form method="post" action="<?php echo base_url('dashboard/pengguna_aksi') ?>">
							<div class="box-body">
								<div class="form-group">
									<label>Nama</label>
									<input type="text" name="nama" class="form-control" placeholder="Masukkan nama pengguna .." value="<?= set_value('nama')?>">
									<small class="text-danger pl-3"><?php echo form_error('nama'); ?></small>
								</div>
								<div class="form-group">
									<label>Email</label>
									<input type="email" name="email" class="form-control" placeholder="Masukkan email pengguna .."  value="<?= set_value('email')?>">
									<small class="text-danger pl-3"><?php echo form_error('email'); ?></small>
								</div>
								<div class="form-group">
									<label>Username</label>
									<input type="text" name="username" class="form-control" placeholder="Masukkan username pengguna.."  value="<?= set_value('username')?>">
									<small class="text-danger pl-3"><?php echo form_error('username'); ?></small>
								</div>
								<div class="form-group">
									<label>Password</label>
									<input type="password" name="password" class="form-control" placeholder="Masukkan password pengguna..">
									<small class="text-danger pl-3"><?php echo form_error('password'); ?></small>
								</div>
								<div class="form-group">
									<label>Level</label>
									<select class="form-control" name="level">
										<option value="">- Pilih Level -</option>
										<option value="admin">Admin</option>
										<option value="penulis">Penulis</option>
									</select>
									<small class="text-danger pl-3"><?php echo form_error('level'); ?></small>
								</div>
								<div class="form-group">
									<label>Quotes of Profile</label>
									<input type="text" name="deskripsi" class="form-control" placeholder="Masukkan quotes anda.."  value="<?= set_value('deskripsi')?>">
									<small class="text-danger pl-3"><?php echo form_error('deskripsi'); ?></small>
								</div>
								<div class="form-group">
									<label>Status</label>
									<select class="form-control" name="status">
										<option value="">- Pilih Status -</option>
										<option value="1">Aktif</option>
										<option value="0">Non-Aktif</option>
									</select>
									<small class="text-danger pl-3"><?php echo form_error('status'); ?></small>
								</div>
							</div>

							<div class="box-footer">
								<input type="submit" class="btn btn-success" value="Simpan">
							</div>
						</form>

					</div>
				</div>

			</div>
		</div>

	</section>

</div>
<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Provinsi
			<small>Tambah Data Provinsi</small>
		</h1>
	</section>

	<section class="content">

		<div class="row">
			<div class="col-lg-6">
				<a href="<?php echo base_url().'dashboard/provinsi'; ?>" class="btn btn-sm btn-primary">Kembali</a>
				
				<br/>
				<br/>

				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">Provinsi</h3>
					</div>
					<div class="box-body">
						
						
						<form method="post" action="<?php echo base_url('dashboard/provinsi_aksi') ?>">
							<div class="box-body">
								<div class="form-group">
									<label>Nama Provinsi</label>
									<input type="text" name="provinsi" class="form-control" placeholder="Masukkan nama provinsi ..">
									<?php echo form_error('provinsi'); ?>
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
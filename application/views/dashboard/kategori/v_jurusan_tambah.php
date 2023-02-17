<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Program Keahlian
			<small>Tambah Data Program Keahlian</small>
		</h1>
	</section>

	<section class="content">

		<div class="row">
			<div class="col-lg-6">
				<a href="<?php echo base_url().'dashboard/jurusan'; ?>" class="btn btn-sm btn-primary">Kembali</a>
				
				<br/>
				<br/>

				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">Program Keahlian</h3>
					</div>
					<div class="box-body">
						
						
						<form method="post" action="<?php echo base_url('dashboard/jurusan_aksi') ?>">
							<div class="box-body">
								<div class="form-group">
									<label>Nama Program Keahlian</label>
									<input type="text" name="jurusan" class="form-control" placeholder="Masukkan nama jurusan ..">
									<?php echo form_error('jurusan'); ?>
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
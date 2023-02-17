<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Kategori Galeri
			<small>Edit Data Kategori Galeri</small>
		</h1>
	</section>

	<section class="content">

		<div class="row">
			<div class="col-lg-6">
				<a href="<?php echo base_url().'dashboard/kat_galeri'; ?>" class="btn btn-sm btn-primary">Kembali</a>
				
				<br/>
				<br/>

				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">Kategori Galeri</h3>
					</div>
					<div class="box-body">
						
						<?php foreach($kat_galeri as $k){ ?>

							<form method="post" action="<?php echo base_url('dashboard/kat_galeri_update') ?>">
								<div class="box-body">
									<div class="form-group">
										<label>Nama Kategori Galeri</label>
										<input type="hidden" name="id" value="<?php echo $k->kat_galeri_id; ?>">
										<input type="text" name="kat_galeri" class="form-control" placeholder="Masukkan nama kategori galeri .." value="<?php echo $k->kat_galeri_nama; ?>">
										<?php echo form_error('kat_galeri'); ?>
									</div>
								</div>

								<div class="box-footer">
									<input type="submit" class="btn btn-success" value="Update">
								</div>
							</form>

						<?php } ?>

					</div>
				</div>

			</div>
		</div>

	</section>

</div>
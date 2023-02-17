<div class="content-wrapper">
<section class="content-header">
		<h1>
			Banner
			<small>Edit Nama Banner</small>
		</h1>
	</section>

	<section class="content">

		<div class="row">
			<div class="col-lg-6">
				<a href="<?php echo base_url().'dashboard/banner'; ?>" class="btn btn-sm btn-primary">Kembali</a>
				
				<br/>
				<br/>

				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">Banner</h3>
					</div>
					<div class="box-body">
						
						<?php foreach($banner as $k){ ?>
                            <?= form_open_multipart('dashboard/banner_update'); ?>
							<!-- <form method="post" action="<?php echo base_url('dashboard/banner_update') ?>"> -->
								<div class="box-body">
									<div class="form-group">
										<label>Judul Banner</label>
										<input type="hidden" name="id" value="<?php echo $k->banner_id; ?>">
										<input type="text" name="banner_nama" class="form-control" value="<?php echo $k->banner_nama; ?>">
										<?php echo form_error('banner_nama'); ?>
									</div>
									<div class="form-group">
										<label>Narasi Banner</label>
										<input type="text" name="teks" class="form-control" value="<?php echo $k->teks; ?>">
										<?php echo form_error('teks'); ?>
									</div>
									<div class="form-group">
										<label>Upload Foto Banner</label>
										<input type="file" name="foto" class="form-control" value="<?php echo $k->foto; ?>">
										<?php echo form_error('foto'); ?>
                                    </div>
                                    <div class="form-group">
										<label>Urutan Banner</label>
										<input type="text" name="banner_urut" class="form-control" value="<?php echo $k->banner_urut; ?>">
										<?php echo form_error('banner_urut'); ?>
									</div>
                                </div>
                                <?php
									if (isset($gambar_error)) {
										echo $gambar_error;
									}
									?>
								<?php echo form_error('foto'); ?>

								<div class="box-footer">
									<input type="submit" class="btn btn-success" value="Update">
								</div>
                            <?= form_close(); ?>

						<?php } ?>

					</div>
				</div>

			</div>
		</div>

	</section>

</div>
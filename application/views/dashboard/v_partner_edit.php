<div class="content-wrapper">
<section class="content-header">
		<h1>
			Partner
			<small>Edit Nama Partner</small>
		</h1>
	</section>

	<section class="content">

		<div class="row">
			<div class="col-lg-6">
				<a href="<?php echo base_url().'dashboard/partner'; ?>" class="btn btn-sm btn-primary">Kembali</a>
				
				<br/>
				<br/>

				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">Partner</h3>
					</div>
					<div class="box-body">
						
						<?php foreach($partner as $k){ ?>
                            <?= form_open_multipart('dashboard/partner_update'); ?>
							<!-- <form method="post" action="<?php echo base_url('dashboard/partner_update') ?>"> -->
								<div class="box-body">
									<div class="form-group">
										<label>Nama Instansi Partner</label>
										<input type="hidden" name="id" value="<?php echo $k->partner_id; ?>">
										<input type="text" name="partner_nama" class="form-control" value="<?php echo $k->partner_nama; ?>">
										<?php echo form_error('partner_nama'); ?>
									</div>
									<div class="form-group">
										<label>Narasi Kerja Sama</label>
										<input type="text" name="teks" class="form-control" value="<?php echo $k->teks; ?>">
										<?php echo form_error('teks'); ?>
									</div>
									<div class="form-group">
										<label>Upload Foto Partner</label>
										<input type="file" name="foto" class="form-control" value="<?php echo $k->foto; ?>">
										<?php echo form_error('foto'); ?>
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
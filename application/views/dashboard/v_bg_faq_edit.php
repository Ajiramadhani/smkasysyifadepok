<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Foto FAQ
			<small>Edit Daftar Banner</small>
		</h1>
	</section>

	<section class="content">

		<div class="row">
			<div class="col-lg-6">
				<a href="<?php echo base_url('dashboard/bg_faq'); ?>" class="btn btn-sm btn-primary">Kembali</a>

				<br />
				<br />

				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">Background FAQ</h3>
					</div>
					<?php
					if (isset($_GET['alert'])) {
						if ($_GET['alert'] == "gagal") {
							echo "<div class='alert alert-danger'>Data gagal ditambahkan!</div>";
						}
					}
					?>
					<div class="box-body">

						<?php foreach ($bg_faq as $k) { ?>
							<?= form_open_multipart('dashboard/bg_faq_update'); ?>
							<div class="box-body">
								<div class="form-group">
									<label>Upload Foto Banner</label>
									<input type="hidden" name="id" value="<?php echo $k->bgfaq_id; ?>">
									<input type="file" name="foto" class="form-control" value="<?php echo $k->foto; ?>">
									<?php echo form_error('foto'); ?>
								</div>
								<div class="form-group">
									<label>Kategori Background</label>
									<input type="number" name="bgfaq_kategori" class="form-control" value="<?php echo $k->bgfaq_kategori; ?>" readonly>
									<?php echo form_error('bgfaq_kategori'); ?>
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
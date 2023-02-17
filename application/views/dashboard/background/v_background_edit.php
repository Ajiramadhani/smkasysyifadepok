<div class="content-wrapper">
<section class="content-header">
<h1>
			Foto Background
			<small>Edit Daftar Background</small>
		</h1>
	</section>

	<section class="content">

		<div class="row">
			<div class="col-lg-6">
				<a href="<?php echo base_url().'dashboard/background'; ?>" class="btn btn-sm btn-primary">Kembali</a>
				
				<br/>
				<br/>

				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">Background Background</h3>
                    </div>
                    <?php 
						if(isset($_GET['alert'])){
							if($_GET['alert'] == "gagal"){
								echo "<div class='alert alert-danger'>Data gagal ditambahkan!</div>";
							}
						}
                    ?>
					<div class="box-body">
						
						<?php foreach($background as $k){ ?>
                            <?= form_open_multipart('dashboard/background_update'); ?>
								<div class="box-body">
									<div class="form-group">
										<label>Upload Foto Background</label>
                                        <input type="hidden" name="id" value="<?php echo $k->background_id; ?>">
                                        <input type="file" name="foto" class="form-control" value="<?php echo $k->foto; ?>">
										<?php echo form_error('foto'); ?>
                                    </div>
                                    <div class="form-group">
									<label>Kategori Background</label>
									<input type="text" name="background_kategori" class="form-control" value="<?php echo $k->background_kategori;?>" readonly>
									<?php echo form_error('background_kategori'); ?>
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
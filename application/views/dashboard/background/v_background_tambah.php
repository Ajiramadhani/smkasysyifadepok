<div class="content-wrapper">
<section class="content-header">
		<h1>
			Foto Background
			<small>Tambah Daftar Background</small>
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
						<h3 class="box-title">Background</h3>
                    </div>
                    <?php 
						if(isset($_GET['alert'])){
							if($_GET['alert'] == "gagal"){
								echo "<div class='alert alert-danger'>Data gagal ditambahkan!</div>";
							}
						}
                    ?>
					<div class="box-body">
						
                        <?= form_open_multipart('dashboard/background_aksi'); ?>
							<div class="box-body">
								<div class="form-group">
									<label>Foto Background</label>
									<input type="file" name="foto" class="form-control">
									<?php echo form_error('foto'); ?>
                                </div>
                                <div class="form-group">
									<label>Kategori Background</label>
									<input type="text" name="background_kategori" class="form-control" placeholder="Masukkan urutan berikutnya ..">
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
								<input type="submit" class="btn btn-success" value="Simpan">
							</div>
                            <?= form_close(); ?>

					</div>
				</div>

			</div>
		</div>

	</section>

</div>
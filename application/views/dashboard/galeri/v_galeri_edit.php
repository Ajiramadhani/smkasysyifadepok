<div class="content-wrapper">
<section class="content-header">
<h1>
			Foto Galeri
			<small>Edit Foto Galeri</small>
		</h1>
	</section>

	<section class="content">

		<div class="row">
			<div class="col-lg-6">
				<a href="<?php echo base_url().'dashboard/galeri'; ?>" class="btn btn-sm btn-primary">Kembali</a>
				
				<br/>
				<br/>

				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">Galeri</h3>
                    </div>
                    <?php 
						if(isset($_GET['alert'])){
							if($_GET['alert'] == "gagal"){
								echo "<div class='alert alert-danger'>Data gagal ditambahkan!</div>";
							}
						}
                    ?>
					<div class="box-body">
						
						<?php foreach($galeri as $k){ ?>
                            <?= form_open_multipart('dashboard/galeri_update'); ?>
								<div class="box-body">
									<div class="form-group">
										<label>Upload Foto Galeri</label>
                                        <input type="hidden" name="id" value="<?php echo $k->galeri_id; ?>">
                                        <input type="file" name="foto" class="form-control" value="<?php echo $k->foto; ?>">
										<?php echo form_error('foto'); ?>
                                    </div>
                                    <div class="form-group">
									<label>Judul Galeri</label>
										<input type="text" name="galeri_judul" class="form-control" value="<?php echo $k->galeri_judul;?>">
										<?php echo form_error('galeri_judul', '<small class="text-danger pl-3">','</small>'); ?>
									</div>
									<div class="form-group">
									<label>Kategori Galeri</label>
									<select class="form-control" name="kat_galeri">
										<option value="">- Pilih Kategori Galeri</option>
										<?php foreach($kat_galeri as $k){ ?>
										<option <?php if(set_value('kat_galeri') == $k->kat_galeri_id){echo "selected='selected'";} ?> value="<?php echo $k->kat_galeri_id ?>"><?php echo $k->kat_galeri_nama; ?></option>
										<?php }?>    
									</select>
										<br/>
										<?php echo form_error('kat_galeri', '<small class="text-danger pl-3">','</small>'); ?>
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
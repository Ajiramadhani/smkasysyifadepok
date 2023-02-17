<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Info
			<small>Update Info PPDB</small>
		</h1>
	</section>

	<section class="content">

		<div class="row">
			<div class="col-lg-6">
				
				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">Info</h3>
					</div>
					<div class="box-body">

						<?php 
						if(isset($_GET['alert'])){
							if($_GET['alert'] == "sukses"){
								echo "<div class='alert alert-success'>Info telah diupdate!</div>";
							}
						}
						?>
						
						<?php foreach($infoppdb as $p){ ?>

							<form method="post" action="<?php echo base_url('dashboard/infoppdb_update') ?>" enctype="multipart/form-data">
								<div class="box-body">
									<div class="form-group">
										<label>Heading Menu</label>
										<input type="text" name="nama" class="form-control" placeholder="Masukkan Heading menu.." value="<?php echo $p->nama; ?>">
										<?php echo form_error('nama'); ?>
                                    </div>
                                    
                                    <div class="form-group">
										<label>Judul</label>
										<input type="text" name="judul" class="form-control" placeholder="Masukkan Judul Info.." value="<?php echo $p->judul; ?>">
										<?php echo form_error('judul'); ?>
									</div>

									<div class="box-body">
                                        <div class="form-group">
                                            <label>Konten</label>
                                            <?php echo form_error('konten'); ?>
                                            <br/>
                                            <textarea class="form-control" id="editor" name="konten"> <?php echo $p->konten; ?> </textarea>
                                        </div>
                                    </div>

									<hr>

									<div class="form-group">
										<label>Foto Info PPDB</label>
										<input type="file" name="picture" value="<?php echo $p->picture; ?>">
										<small>Kosongkan jika tidak ingin mengubah foto</small>
									</div>

									<hr>

									</div>
									
								</div>

								<div class="box-footer">
									<input type="submit" class="btn btn-success" value="Simpan">
								</div>
							</form>

						<?php } ?>

					</div>
				</div>

			</div>

	</section>

</div>
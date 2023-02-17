<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Sambutan
			<small>Update Sambutan Kepala Sekolah</small>
		</h1>
	</section>

	<section class="content">

		<div class="row">
			<div class="col-lg-6">
				
				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">Sambutan</h3>
					</div>
					<div class="box-body">

						
					<?php 
						if(isset($_GET['alert'])){
							if($_GET['alert'] == "sukses"){
								echo "<div class='alert alert-success'>Sambutan telah diubah!</div>";
							}else if($_GET['alert'] == "gagal"){
								echo "<div class='alert alert-danger'>Maaf, Update sambutan anda gagal!</div>";
							}
						}
						?>
						
						<?php foreach($sambutan as $p){ ?>

							<form method="post" action="<?php echo base_url('dashboard/sambutan_update') ?>" enctype="multipart/form-data">
								<div class="box-body">
									<div class="form-group">
										<label>Nama Kepala Sekolah</label>
										<input type="text" name="nama" class="form-control" placeholder="Masukkan nama kepala sekolah.." value="<?php echo $p->nama; ?>">
										<?= form_error('nama', '<small class="text-danger pl-3">','</small>');?>
                                    </div>
                                    
                                    <div class="form-group">
										<label>Judul</label>
										<input type="text" name="judul" class="form-control" placeholder="Masukkan Judul Sambutan.." value="<?php echo $p->judul; ?>">
										<?= form_error('judul', '<small class="text-danger pl-3">','</small>');?>
									</div>

									<div class="box-body">
                                        <div class="form-group">
                                            <label>Konten</label>
                                            <?= form_error('konten', '<small class="text-danger pl-3">','</small>');?>
                                            <br/>
                                            <textarea class="form-control" id="editor" name="konten"> <?php echo $p->konten; ?> </textarea>
                                        </div>
                                    </div>

									<hr>

									<div class="form-group">
										<label>Foto Kepala Sekolah</label>
										<input type="file" name="foto" value="<?php echo $p->foto; ?>">
										<small>Kosongkan jika tidak ingin mengubah foto</small>
										<?= form_error('foto', '<small class="text-danger pl-3">','</small>');?>
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
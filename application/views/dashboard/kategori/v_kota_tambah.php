<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Kota
			<small>Tambah Data Kota</small>
		</h1>
	</section>

	<section class="content">

		<div class="row">
			<div class="col-lg-6">
				<a href="<?php echo base_url().'dashboard/kota'; ?>" class="btn btn-sm btn-primary">Kembali</a>
				
				<br/>
				<br/>

				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">Kota</h3>
					</div>
					<div class="box-body">
						
						
						<form method="post" action="<?php echo base_url('dashboard/kota_aksi') ?>">
							<div class="box-body">
								<div class="form-group">
									<label>Nama Kota</label>
									<input type="text" name="kota" class="form-control" placeholder="Masukkan nama kota ..">
									<?php echo form_error('kota'); ?>
                                </div>
                                <div class="form-group">
									<label>Provinsi</label>
									<select class="form-control" name="provinsi">
										<option value="">- Pilih Provinsi</option>
										<?php foreach($provinsi as $k){ ?>
										<option <?php if(set_value('provinsi') == $k->provinsi_id){echo "selected='selected'";} ?> value="<?php echo $k->provinsi_id ?>"><?php echo $k->provinsi_nama; ?></option>
										<?php }?>    
									</select>
								<br/>
								<?php echo form_error('provinsi'); ?>
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
<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Kota
			<small>Edit Data Kota</small>
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
						
						<?php foreach($kota as $k){ ?>

							<form method="post" action="<?php echo base_url('dashboard/kota_update') ?>">
								<div class="box-body">
									<div class="form-group">
										<label>Nama Kota</label>
										<input type="hidden" name="id" value="<?php echo $k->kota_id; ?>">
										<input type="text" name="kota" class="form-control" placeholder="Masukkan nama kota .." value="<?php echo $k->kota_nama; ?>">
										<?php echo form_error('kota'); ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Provinsi</label>
                                        <select class="form-control" name="provinsi">
                                            <option value="">- Pilih Provinsi</option>
                                                <?php foreach($provinsi as $k){ ?>
                                                    <option <?php if(set_value('provinsi') == $k->provinsi_id){echo "selected='selected'";} ?> value="<?php echo $k->provinsi_id ?>"><?php echo $k->provinsi_nama; ?></option>
                                                <?php } ?>
                                        </select>
                                        <br/>
                                        <?php echo form_error('provinsi'); ?>
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
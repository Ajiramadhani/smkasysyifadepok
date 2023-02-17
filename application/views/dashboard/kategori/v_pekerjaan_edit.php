<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Pekerjaan
			<small>Edit Data Pekerjaan</small>
		</h1>
	</section>

	<section class="content">

		<div class="row">
			<div class="col-lg-6">
				<a href="<?php echo base_url().'dashboard/pekerjaan'; ?>" class="btn btn-sm btn-primary">Kembali</a>
				
				<br/>
				<br/>

				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">Pekerjaan</h3>
					</div>
					<div class="box-body">
						
						<?php foreach($pekerjaan as $k){ ?>

							<form method="POST" action="<?php echo base_url('dashboard/pekerjaan_update') ?>">
								<div class="box-body">
									<div class="form-group">
										<label>Nama Pekerjaan</label>
										<input type="hidden" name="id" value="<?php echo $k->pekerjaan_id; ?>">
										<input type="text" name="pekerjaan_nama" class="form-control" placeholder="Masukkan nama pekerjaan.." value="<?php echo $k->pekerjaan_nama; ?>">
										<?php echo form_error('pekerjaan_nama', '<small class="text-danger pl-3">','</small>'); ?>
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
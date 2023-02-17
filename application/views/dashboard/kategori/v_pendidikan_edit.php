<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Pendidikan Orang Tua
			<small>Edit Kategori Pendidikan Orang Tua</small>
		</h1>
	</section>

	<section class="content">

		<div class="row">
			<div class="col-lg-6">
				<a href="<?php echo base_url().'dashboard/pendidikan'; ?>" class="btn btn-sm btn-primary">Kembali</a>
				
				<br/>
				<br/>

				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">Pendidikan Orang Tua</h3>
					</div>
					<div class="box-body">
						
						<?php foreach($pendidikan as $k){ ?>

							<form method="post" action="<?php echo base_url('dashboard/pendidikan_update') ?>">
								<div class="box-body">
									<div class="form-group">
										<label>Kategori Pendidikan Orang Tua</label>
										<input type="hidden" name="id" value="<?php echo $k->pendidikan_id; ?>">
										<input type="text" name="pendidikan" class="form-control" placeholder="Masukkan nama pendidikan .." value="<?php echo $k->pendidikan_nama; ?>">
										<?php echo form_error('pendidikan'); ?>
									</div>
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
<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Pendapatan Orang Tua
			<small>Edit Kategori Pendapatan Orang Tua</small>
		</h1>
	</section>

	<section class="content">

		<div class="row">
			<div class="col-lg-6">
				<a href="<?php echo base_url().'dashboard/pendapatan'; ?>" class="btn btn-sm btn-primary">Kembali</a>
				
				<br/>
				<br/>

				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">Pendapatan Orang Tua</h3>
					</div>
					<div class="box-body">
						
						<?php foreach($pendapatan as $k){ ?>

							<form method="post" action="<?php echo base_url('dashboard/pendapatan_update') ?>">
								<div class="box-body">
									<div class="form-group">
										<label>Kategori Pendapatan Orang Tua</label>
										<input type="hidden" name="id" value="<?php echo $k->pendapatan_id; ?>">
										<input type="text" name="pendapatan" class="form-control" placeholder="Masukkan nilai pendapatan .." value="<?php echo $k->pendapatan_nilai; ?>">
										<?php echo form_error('pendapatan','<small class="text-danger pl-3">','</small>'); ?>
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
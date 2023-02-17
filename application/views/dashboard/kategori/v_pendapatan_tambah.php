<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Pendapatan Orang Tua
			<small>Tambah Kategori Pendapatan Orang Tua</small>
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
						
						
						<form method="post" action="<?php echo base_url('dashboard/pendapatan_aksi') ?>">
							<div class="box-body">
								<div class="form-group">
									<label>Kategori Pendapatan Orang Tua</label>
									<input type="text" name="pendapatan" class="form-control" placeholder="Masukkan nilai pendapatan ..">
									<?php echo form_error('pendapatan','<small class="text-danger pl-3">','</small>'); ?>
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
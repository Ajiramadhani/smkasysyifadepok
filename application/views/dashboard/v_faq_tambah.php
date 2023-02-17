<div class="content-wrapper">
	<section class="content-header">
		<h1>
			FAQ
			<small>Tulis Pertanyaan Baru</small>
		</h1>
	</section>

	<section class="content">

		<a href="<?php echo base_url().'dashboard/faq'; ?>" class="btn btn-sm btn-primary">Kembali</a>

		<br/>
		<br/>

		<form method="post" action="<?php echo base_url('dashboard/faq_aksi') ?>">
			<div class="row">
				<div class="col-lg-12">

					<div class="box box-primary">
						<div class="box-body">


							<div class="box-body">
								<div class="form-group">
									<label>Judul Halaman</label>
									<input type="text" name="judul" class="form-control" placeholder="Masukkan judul halaman.." value="<?php echo set_value('judul'); ?>">
									<?php echo form_error('judul'); ?>
								</div>
							</div>

							<div class="box-body">
								<div class="form-group">
									<label>Jawaban</label>
									<?php echo form_error('jawab'); ?>
									<br/>
									<textarea class="form-control" id="editor" name="jawab"> <?php echo set_value('jawab'); ?> </textarea>
								</div>
							</div>

							<input type="submit" value="Publish" class="btn btn-success btn-block">

						</div>
					</div>

				</div>
				
			</div>
		</form>

	</section>

</div>
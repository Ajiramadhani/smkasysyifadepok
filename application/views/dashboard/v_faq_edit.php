<div class="content-wrapper">
	<section class="content-header">
		<h1>
			FAQ
			<small>Edit Pertanyaan Umum</small>
		</h1>
	</section>

	<section class="content">

		<a href="<?php echo base_url().'dashboard/faq'; ?>" class="btn btn-sm btn-primary">Kembali</a>

		<br/>
		<br/>

		<?php foreach($faq as $h){ ?>

		<form method="post" action="<?php echo base_url('dashboard/faq_update') ?>">
			<div class="row">
				<div class="col-lg-12">

					<div class="box box-primary">
						<div class="box-body">


							<div class="box-body">
								<div class="form-group">
									<label>Judul</label>
									<input type="hidden" name="id" value="<?php echo $h->faq_id; ?>">
									<input type="text" name="judul" class="form-control" placeholder="Masukkan judul faq.." value="<?php echo $h->faq_judul; ?>">
									<br/>
									<?php echo form_error('judul'); ?>
								</div>
							</div>

							<div class="box-body">
								<div class="form-group">
									<label>Jawaban</label>
									<?php echo form_error('jawab'); ?>
									<br/>
									<textarea class="form-control" id="editor" name="jawab"> <?php echo $h->faq_jawab; ?> </textarea>
								</div>
							</div>

							<input type="submit" name="status" value="Publish" class="btn btn-success btn-block">

						</div>
					</div>

				</div>

			</div>
		</form>
		<?php } ?>

	</section>

</div>
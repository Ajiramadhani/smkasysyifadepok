<div class="content-wrapper">
	<section class="content-header">
		<h1>
			FAQ
			<small>Manajemen Pertanyaan Umum</small>
		</h1>
	</section>

	<section class="content">

		<div class="row">
			<div class="col-lg-12">
				
				<a href="<?php echo base_url().'dashboard/faq_tambah'; ?>" class="btn btn-sm btn-primary">Buat Pertanyaan Baru</a>

				<br/>
				<br/>

				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">Pertanyaan</h3>
					</div>
					<div class="box-body">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th width="1%">NO</th>
									<th>Judul Pertanyaan</th>
									<th>Jawaban</th>
									<th width="15%">OPSI</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$no = 1;
								foreach($faq as $h){ 
									?>
									<tr>
										<td><?php echo $no++; ?></td>
										<td><?php echo $h->faq_judul; ?></td>
										<td><?php echo $h->faq_jawab; ?></td>
										<td>
											<a href="<?php echo base_url().'dashboard/faq_edit/'.$h->faq_id; ?>" class="btn btn-warning btn-sm"> <i class="fa fa-pencil"></i> </a>
											<a onclick="javascript: return confirm('Anda Yakin Hapus ?')" href="<?php echo base_url().'dashboard/faq_hapus/'.$h->faq_id; ?>" class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i> </a>
										</td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
						

					</div>
				</div>

			</div>
		</div>

	</section>

</div>
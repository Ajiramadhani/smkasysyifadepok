<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Foto FAQ
			<small>Manajemen Foto Menu FAQ</small>
		</h1>
	</section>

	<section class="content">

		<div class="row">
			<div class="col-lg-12">
				
				<!-- <a href="<?php echo base_url().'dashboard/bg_faq_tambah'; ?>" class="btn btn-sm btn-primary">Buat Pertanyaan Baru</a> -->

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
									<th>Nama File</th>
									<th>Kategori</th>
									<th width="15%">OPSI</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$no = 1;
								foreach($bg_faq as $h){ 
									?>
									<tr>
										<td><?php echo $no++; ?></td>
										<td><img width="400px" class="img-responsive" src="<?php echo base_url().'/gambar/bgfaq/'.$h->foto; ?>"></td>
										<td><?php echo $h->bgfaq_kategori; ?></td>
										<td>
											<a  href="<?php echo base_url().'dashboard/bg_faq_edit/'.$h->bgfaq_id; ?>" class="btn btn-warning btn-sm"> <i class="fa fa-pencil"></i> </a>
											<!-- <a onclick="javascript: return confirm('Anda Yakin Hapus ?')" href="<?php echo base_url().'dashboard/bg_faq_hapus/'.$h->bg_faq_id; ?>" class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i> </a> -->
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
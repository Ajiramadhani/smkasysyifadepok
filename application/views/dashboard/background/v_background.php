<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Foto Background
			<small>Manajemen Foto Menu Background</small>
		</h1>
	</section>

	<section class="content">

		<div class="row">
			<div class="col-lg-12">

				<!-- <a href="<?php echo base_url() . 'dashboard/background_tambah'; ?>" class="btn btn-sm btn-primary">Buat Background Baru</a> -->

				<br />
				<br />

				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">Background</h3>
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
								foreach ($background as $h) {
								?>
									<tr>
										<td><?php echo $no++; ?></td>
										<td><img width="400px" class="img-responsive" src="<?php echo base_url() . '/gambar/background/' . $h->foto; ?>"></td>
										<td><?php echo $h->background_kategori; ?></td>
										<td>
											<a href="<?php echo base_url() . 'dashboard/background_edit/' . $h->background_id; ?>" class="btn btn-warning btn-sm"> <i class="fa fa-pencil"></i> </a>
											<!-- <a onclick="javascript: return confirm('Anda Yakin Hapus ?')" href="<?php echo base_url() . 'dashboard/background_hapus/' . $h->background_id; ?>" class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i> </a> -->
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
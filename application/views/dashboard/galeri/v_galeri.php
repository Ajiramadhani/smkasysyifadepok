<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Foto Galeri
			<small>Manajemen Foto Galeri</small>
		</h1>
	</section>

	<section class="content">

		<div class="row">
			<div class="col-lg-12">

				<a href="<?php echo base_url() . 'dashboard/galeri_tambah'; ?>" class="btn btn-sm btn-primary">Buat Galeri Baru</a>

				<br />
				<br />

				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">Galeri</h3>
					</div>
					<div class="box-body">
						<?php
						if (isset($_GET['alert'])) {
							if ($_GET['alert'] == "sukses") {
								echo "<div class='alert alert-success'>Foto sukses di tambahkan!</div>";
							}
						}
						?>
						<?php
						if (isset($_GET['alert'])) {
							if ($_GET['alert'] == "update") {
								echo "<div class='alert alert-success'>Foto sukses di update!</div>";
							}
						}
						?>
						<div class="table-responsive">
							<table class="table table-bordered">
								<thead>
									<tr>
										<th width="1%">NO</th>
										<th>Foto Galeri</th>
										<th>Judul Foto</th>
										<th>Kategori Galeri</th>
										<th width="15%">OPSI</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$no = 1;
									foreach ($galeri as $h) {
									?>
										<tr>
											<td><?php echo $no++; ?></td>
											<td><img width="400px" class="img-responsive" src="<?php echo base_url() . '/gambar/galeri/' . $h->foto; ?>"></td>
											<td><?php echo $h->galeri_judul; ?></td>
											<td><?php echo $h->kat_galeri_nama; ?></td>
											<td>
												<a href="<?php echo base_url() . 'dashboard/galeri_edit/' . $h->galeri_id; ?>" class="btn btn-warning btn-sm"> <i class="fa fa-pencil"></i> </a>
												<a onclick="javascript: return confirm('Anda Yakin Hapus ?')" href="<?php echo base_url() . 'dashboard/galeri_hapus/' . $h->galeri_id; ?>" class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i> </a>
											</td>
										</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>

					</div>
				</div>

			</div>
		</div>

	</section>

</div>
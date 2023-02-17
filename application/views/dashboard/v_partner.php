<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Partner
			<small>Daftar Partner</small>
		</h1>
	</section>

	<section class="content">

		<div class="row">
			<div class="col-lg-9">
				
				<a href="<?php echo base_url().'dashboard/partner_tambah'; ?>" class="btn btn-sm btn-primary">Input Partner Baru</a>

				<br/>
				<br/>

				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">Partner</h3>
					</div>
					<div class="box-body">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th width="1%">NO</th>
									<th>Nama Instansi Partner</th>
									<th>Narasi Kerja Sama</th>
									<th>Logo Instansi Partner</th>
									<th width="10%">OPSI</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$no = 1;
								foreach($partner as $k){ 
									?>
									<tr>
										<td><?php echo $no++; ?></td>
										<td><?php echo $k->partner_nama; ?></td>
										<td><?php echo $k->teks; ?></td>
										<td><img width="100px" class="img-responsive" src="<?php echo base_url().'/gambar/profil/'.$k->foto; ?>"></td>
										<td>
											<a href="<?php echo base_url().'dashboard/partner_edit/'.$k->partner_id; ?>" class="btn btn-warning btn-sm"> <i class="fa fa-pencil"></i> </a>
											<a onclick="javascript: return confirm('Anda Yakin Hapus ?')" href="<?php echo base_url().'dashboard/partner_hapus/'.$k->partner_id; ?>" class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i> </a>
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
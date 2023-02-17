<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Kategori Galeri
			<small>Daftar Kategori Galeri</small>
		</h1>
	</section>

	<section class="content">

		<div class="row">
			<div class="col-lg-9">
				
				<a href="<?php echo base_url().'dashboard/kat_galeri_tambah'; ?>" class="btn btn-sm btn-primary">Buat Kategori Galeri Baru</a>

				<br/>
				<br/>

				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">Kategori Galeri</h3>
					</div>
					<div class="box-body">
                    <div class="table-resposinve">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th width="1%">NO</th>
									<th>Kategori Galeri</th>
									<th width="10%">OPSI</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$no = 1;
								foreach($kat_galeri as $k){ 
									?>
									<tr>
										<td><?php echo $no++; ?></td>
										<td><?php echo $k->kat_galeri_nama; ?></td>
										<td>
											<a href="<?php echo base_url().'dashboard/kat_galeri_edit/'.$k->kat_galeri_id; ?>" class="btn btn-warning btn-sm"> <i class="fa fa-pencil"></i> </a>
											<!-- <a onclick="javascript: return confirm('Anda Yakin Hapus ?')" href="<?php echo base_url().'dashboard/kat_galeri_hapus/'.$k->kat_galeri_id; ?>" class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i> </a> -->
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
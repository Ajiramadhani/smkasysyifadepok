<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Jenis Pekerjaan
			<small>Daftar Jenis Pekerjaan</small>
		</h1>
	</section>

	<section class="content">

		<div class="row">
			<div class="col-lg-9">
				
				<a href="<?php echo base_url().'dashboard/pekerjaan_tambah'; ?>" class="btn btn-sm btn-primary">Buat Jenis Pekerjaan baru</a>

				<br/>
				<br/>

				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">Jenis Pekerjaan</h3>
					</div>
					<div class="box-body">
						
					<?php 
						if(isset($_GET['alert'])){
							if($_GET['alert'] == "sukses"){
								echo "<div class='alert alert-success'>Jenis pekerjaan telah diubah!</div>";
							}else if($_GET['alert'] == "gagal"){
								echo "<div class='alert alert-danger'>Maaf, jenis pekerjaan gagal di upload!</div>";
							}
						}
						?>
						<table class="table table-bordered">
							<thead>
								<tr>
									<th width="1%">NO</th>
									<th>Nama Pekerjaan</th>
									<th width="10%">OPSI</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$no = 1;
								foreach($pekerjaan as $k){ 
									?>
									<tr>
										<td><?php echo $no++; ?></td>
                                        <td><?php echo $k->pekerjaan_nama; ?></td>
										<td>
											<a href="<?php echo base_url().'dashboard/pekerjaan_edit/'.$k->pekerjaan_id; ?>" class="btn btn-warning btn-sm"> <i class="fa fa-pencil"></i> </a>
											<a onclick="javascript: return confirm('Anda Yakin Hapus ?')" href="<?php echo base_url().'dashboard/pekerjaan_hapus/'.$k->pekerjaan_id; ?>" class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i> </a>
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
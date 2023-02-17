<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Teachers
			<small>Manajemen Guru</small>
		</h1>
	</section>

	<section class="content">

		<div class="row">
			<div class="col-lg-12">
				
				<a href="<?php echo base_url().'dashboard/guru_tambah'; ?>" class="btn btn-sm btn-primary">Buat guru baru</a>

				<br/>
				<br/>

				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">Daftar Guru</h3>
					</div>
					<div class="box-body">

						<div class="table-responsive">
							<table class="table table-bordered">
								<thead>
									<tr>
										<th width="1%">NO</th>
										<th>Tanggal Upload</th>
										<th>Nama</th>
										<!-- <th>Author</th> -->
										<th>Kategori</th>
										<th>Profil Singkat</th>
										<th width="10%">Gambar</th>
										<th>Status</th>
										<th width="15%">OPSI</th>
									</tr>
								</thead>
								<tbody>
									<?php 
									$no = 1;
									foreach($guru as $a){ 
										?>
										<tr>
											<td><?php echo $no++; ?></td>
											<td><?php echo date('d/m/Y H:i', strtotime($a->guru_tanggal)); ?></td>
											<td>
												<?php echo $a->guru_judul; ?>
												<br/>
												<small class="text-muted">
													<?php echo base_url()."".$a->guru_slug; ?>
												</small>
											</td>
											<!-- <td><?php echo $a->pengguna_nama; ?></td> -->
											<td><?php echo $a->kategori_nama; ?></td>
											<td><?php echo $a->guru_konten; ?></td>
											<td><img width="100%" class="img-responsive" src="<?php echo base_url().'/gambar/guru/'.$a->guru_sampul; ?>"></td>
											<td>
												<?php 
												if($a->guru_status=="publish"){
													echo "<span class='label label-success'>Publish</span>"; 
												}else{
													echo "<span class='label label-danger'>Draft</span>"; 
												}
												?>

											</td>
											<!-- <td>Rp. <?= number_format($a->guru_harga, 0, '.', '.')?></td> -->
											<td>
												<a target="_blank" href="<?php echo base_url('det_guru/').$a->guru_slug; ?>" class="btn btn-success btn-sm"> <i class="fa fa-eye"></i> </a>
												<?php 
											// cek apakah pengguna yang login adalah penulis
												if($this->session->userdata('level') == "penulis"){
												// jika penulis, maka cek apakah penulis guru ini adalah si pengguna atau bukan
													if($this->session->userdata('id') == $a->guru_author){
														?>
														<a href="<?php echo base_url().'dashboard/guru_edit/'.$a->guru_id; ?>" class="btn btn-warning btn-sm"> <i class="fa fa-pencil"></i> </a>
														<a href="<?php echo base_url().'dashboard/guru_hapus/'.$a->guru_id; ?>" class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i> </a>
														<?php
													}
												}else{
												// jika yang login adalah admin
													?>
													<a href="<?php echo base_url().'dashboard/guru_edit/'.$a->guru_id; ?>" class="btn btn-warning btn-sm"> <i class="fa fa-pencil"></i> </a>
													<a onclick="javascript: return confirm('Anda Yakin Hapus ?')" href="<?php echo base_url().'dashboard/guru_hapus/'.$a->guru_id; ?>" class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i> </a>
													<?php
												}
												?>
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
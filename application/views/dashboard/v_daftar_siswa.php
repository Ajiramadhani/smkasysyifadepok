<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Siswa Baru
			<small>Manajemen Siswa Baru</small>
		</h1>
	</section>

	<section class="content">

		<div class="row">
			<div class="col-lg-12">
				
				<a href="<?php echo base_url().'dashboard/siswa_tambah'; ?>" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i>  Tambahkan Siswa Baru</a>
				<a href="<?php echo base_url().'dashboard/print'; ?>" class="btn btn-sm btn-danger" target="_blank"><i class="fa fa-print"></i>  Cetak</a>

				<div class="dropdown inline">
					<button class="btn btn-warning dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
						<i class="fa fa-download"></i>Export File
						<span class="caret"></span>
					</button>
					<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
						<li><a href="<?php echo base_url().'dashboard/pdf'; ?>">PDF</a></li>
						<li><a href="<?php echo base_url().'dashboard/excel'; ?>">Excel</a></li>
					</ul>
				</div>

				<br/>
				<br/>

				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">Siswa</h3>
					</div>
					<?= $this->session->flashdata('message'); ?>
					<div class="box-body">

						<div class="table-responsive">
							<table class="table table-bordered">
								<thead>
									<tr>
										<th width="1%">NO</th>
										<th>Nama Siswa</th>
										<th>NISN</th>
										<th>Email</th>
										<th>Program Keahlian</th>
										<th>Agama</th>
                                        <th>JK</th>
                                        <th>No. Ijazah</th>
                                        <th>No. SKHUN</th>
                                        <th>No. Ujian Nasional</th>
                                        <th>Nomor Induk Kependudukan</th>
                                        <th>Nomor Pokok Sekolah Nasional</th>
                                        <th>Asal Sekolah</th>
                                        <th>Tempat Lahir</th>
                                        <th>Tanggal Lahir</th>
                                        <th>Alamat</th>
                                        <th>Berat</th>
                                        <th width="4%">Tinggi</th>
                                        <th>Jarak Rumah</th>
										<th width="15%">OPSI</th>
									</tr>
								</thead>
								<tbody>
									<?php 
									$no = 1;
									foreach($siswa as $a){ 
										?>
										<tr>
											<td><?php echo $no++; ?></td>
											<td><?php echo $a->nama; ?></td>
											<td><?php echo $a->nisn; ?></td>
											<td><?php echo $a->email; ?></td>
											<td><?php echo $a->jurusan_nama; ?></td>
											<td><?php echo $a->agama_nama; ?></td>
											<td><?php echo $a->gender_jenis; ?></td>
											<td><?php echo $a->ijazah; ?></td>
											<td><?php echo $a->skhun; ?></td>
											<td><?php echo $a->un; ?></td>
											<td><?php echo $a->nik; ?></td>
											<td><?php echo $a->npsn; ?></td>
                                            <td><?php echo $a->sekolah; ?></td>
                                            <td><?php echo $a->tempat_lahir; ?></td>
                                            <td><?php echo $a->ttl; ?></td>
                                            <td><?= $a->alamat;?>, <?= $a->kota_nama;?>, <?= $a->provinsi_nama ?></td>
                                            <td><?php echo $a->berat; ?> Kg</td>
                                            <td><?php echo $a->tinggi; ?> Cm</td>
                                            <td><?php echo $a->jarak; ?> Km</td>
											<td>
												<?php 
											// cek apakah penggun yang login adalah penulis
												if($this->session->userdata('level') == "penulis"){
												// jika penulis, maka cek apakah penulis artikel ini adalah si pengguna atau bukan
													if($this->session->userdata('id') == $a->pengguna_id){
														?>
														<a href="<?php echo base_url().'dashboard/siswa_edit/'.$a->daftar_id; ?>" class="btn btn-warning btn-sm"> <i class="fa fa-pencil"></i> </a>
														<a href="<?php echo base_url().'dashboard/siswa_hapus/'.$a->daftar_id; ?>" class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i> </a>
														<?php
													}
												}else{
												// jika yang login adalah admin
													?>
													<a href="<?php echo base_url().'dashboard/siswa_edit/'.$a->daftar_id; ?>" class="btn btn-warning btn-sm"> <i class="fa fa-pencil"></i> </a>
													<a onclick="javascript: return confirm('Anda Yakin Hapus ?')" href="<?php echo base_url().'dashboard/siswa_hapus/'.$a->daftar_id; ?>" class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i> </a>
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
<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Data Orang Tua Siswa
			<small>Manajemen Orang Tua Siswa</small>
		</h1>
	</section>

	<section class="content">

		<div class="row">
			<div class="col-lg-12">
				
				<a href="<?php echo base_url().'dashboard/dataortu'; ?>" class="btn btn-sm btn-primary">Refresh</a>

				<br/>
				<br/>

				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">Orang Tua Siswa</h3>
					</div>
					<div class="box-body">

						<div class="table-responsive">
							<table class="table table-bordered">
								<thead>
									<tr>
										<th width="1%">NO</th>
										<th>Nama Siswa</th>
										<th>Program Keahlian</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Tanggal Lahir</th>
                                        <th>Asal Sekolah</th>
                                        <th>NIK Siswa</th>
                                        <th width="10%">Alamat</th>
                                        <th>Nama Ayah</th>
                                        <th>NIK Ayah</th>
                                        <th>Pendidikan Ayah</th>
                                        <th>Pekerjaan Ayah</th>
                                        <th width="10%">Penghasilan Ayah</th>
                                        <th>Nama Ibu</th>
                                        <th>NIK Ibu</th>
                                        <th>Pendidikan Ibu</th>
                                        <th>Pekerjaan Ibu</th>
                                        <th width="10%">Penghasilan Ibu</th>
										<!-- <th width="15%">OPSI</th> -->
									</tr>
								</thead>
								<tbody>
									<?php 
									$no = 1;
									foreach($ortu as $a){ 
										?>
										<tr>
											<td><?php echo $no++; ?></td>
											<td><?php echo $a->nama; ?></td>
											<td><?php echo $a->jurusan_nama; ?></td>
											<td><?php echo $a->gender_nama; ?></td>
											<td><?php echo $a->ttl; ?></td>
											<td><?php echo $a->sekolah; ?></td>
											<td><?php echo $a->nik; ?></td>
											<td><?php echo $a->alamat; ?>, <?= $a->kota_nama;?>, <?= $a->provinsi_nama ?></td>
											<td><?php echo $a->nama_ayah; ?></td>
                                            <td><?php echo $a->nik_ayah; ?></td>
                                            <td><?php echo $a->pendidikan_nama; ?></td>
											<td><?php echo $a->pekerjaan_nama; ?></td>
                                            <td><?php echo $a->pendapatan_nilai; ?></td>
											<td><?php echo $a->nama_ibu; ?></td>
											<td><?php echo $a->nik_ibu; ?></td>
                                            <td><?php echo $a->pekerjaan_nama; ?></td>
                                            <td><?php echo $a->pendidikan_nama; ?></td>
                                            <td><?php echo $a->pendapatan_nilai; ?></td>
											
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
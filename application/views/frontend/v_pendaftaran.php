<!-- <section class="hero-wrap hero-wrap-2" style="background-image: url('images/bg_2.jpg');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text align-items-end">
          <div class="col-md-9 ftco-animate pb-5">
          	<p class="breadcrumbs mb-2"><span class="mr-2"><a href="index.php">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Contact Us <i class="ion-ios-arrow-forward"></i></span></p>
            <h1 class="mb-0 bread">Contact Us</h1>
          </div>
        </div>
      </div>
</section> -->

<section class="ftco-section bg-light">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-12">
				<div class="wrapper">
					<div class="row no-gutters">
						<div class="col-lg-8 col-md-7 order-md-last d-flex align-items-stretch">
							<div class="contact-wrap w-100 p-md-5 p-4">
								<h3 class="mb-4">Formulir Pendaftaran PPDB <?php echo date('Y'); ?></h3>
								<?= $this->session->flashdata('message'); ?>
								<div id="form-message-warning" class="mb-4"></div>
								<form method="post" action="<?php echo base_url('welcome/daftar_aksi') ?>" enctype="multipart/form-data">
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="label" for="nama">Nama Lengkap*</label>
												<input type="text" class="form-control" name="nama" value="<?php echo set_value('nama'); ?>" placeholder="Masukkan Nama Lengkap">
												<?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="label" for="nisn">NISN*</label>
												<input type="text" class="form-control" name="nisn" value="<?php echo set_value('nisn'); ?>" placeholder="NISN">
												<?= form_error('nisn', '<small class="text-danger pl-3">', '</small>'); ?>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="label" for="email">Email Pribadi*</label>
												<input type="email" class="form-control" name="email" value="<?php echo set_value('email'); ?>" placeholder="Email Pribadi">
												<?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="label" for="agama">Agama</label>
												<select class="form-control" name="agama">
													<label class="label" for="agama">Agama</label>
													<option value="">- Pilih Agama -</option>
													<?php foreach ($agama as $k) { ?>
														<option <?php if (set_value('agama') == $k->agama_id) {
																	echo "selected='selected'";
																} ?> value="<?php echo $k->agama_id ?>"><?php echo $k->agama_nama; ?></option>
													<?php } ?>
												</select>
												<?= form_error('agama', '<small class="text-danger pl-3">', '</small>'); ?>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="label" for="jurusan">Program Keahlian</label>
												<select class="form-control" name="jurusan">
													<label class="label" for="jurusan">Program Keahlian</label>
													<option value="">- Program Keahlian -</option>
													<?php foreach ($jurusan as $k) { ?>
														<option <?php if (set_value('jurusan') == $k->jurusan_id) {
																	echo "selected='selected'";
																} ?> value="<?php echo $k->jurusan_id ?>"><?php echo $k->jurusan_nama; ?></option>
													<?php } ?>
												</select>
												<?= form_error('jurusan', '<small class="text-danger pl-3">', '</small>'); ?>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="label" for="gender">Jenis Kelamin</label>
												<select class="form-control" name="gender">
													<label class="label" for="gender">Jenis Kelamin</label>
													<option value="">- Jenis Kelamin -</option>
													<?php foreach ($gender as $k) { ?>
														<option <?php if (set_value('gender') == $k->gender_id) {
																	echo "selected='selected'";
																} ?> value="<?php echo $k->gender_id ?>"><?php echo $k->gender_nama; ?></option>
													<?php } ?>
												</select>
												<?= form_error('gender', '<small class="text-danger pl-3">', '</small>'); ?>
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label class="label" for="ijazah">Nomor Seri Ijazah*</label>
												<input type="text" class="form-control" name="ijazah" id="ijazah" value="<?php echo set_value('ijazah'); ?>" placeholder="Nomor Seri Ijazah">
												<?= form_error('ijazah', '<small class="text-danger pl-3">', '</small>'); ?>
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label class="label" for="skhun">Nomor Seri SKHUN*</label>
												<input type="text" class="form-control" name="skhun" id="skhun" value="<?php echo set_value('skhun'); ?>" placeholder="Nomor Seri SKHUN">
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label class="label" for="nik">Nomor Induk Kependudukan*</label>
												<input type="number" class="form-control" name="nik" id="nik" value="<?php echo set_value('nik'); ?>" placeholder="Nomor Induk Kependudukan">
												<?= form_error('nik', '<small class="text-danger pl-3">', '</small>'); ?>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="label" for="npsn">NPSN Sekolah Asal*</label>
												<input type="number" class="form-control" name="npsn" id="npsn" value="<?php echo set_value('npsn'); ?>" placeholder="NPSN Sekolah Asal">
												<?= form_error('skhun', '<small class="text-danger pl-3">', '</small>'); ?>
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label class="label" for="un">Nomor Peserta Ujian Nasional*</label>
												<input type="text" class="form-control" name="un" id="un" value="<?php echo set_value('un'); ?>" placeholder="Nomor Peserta Ujian Nasional">
												<?= form_error('un', '<small class="text-danger pl-3">', '</small>'); ?>
												<?= form_error('npsn', '<small class="text-danger pl-3">', '</small>'); ?>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="label" for="sekolah">Nama Sekolah Asal*</label>
												<input type="text" class="form-control" name="sekolah" id="sekolah" value="<?php echo set_value('sekolah'); ?>" placeholder="Nama Sekolah Asal">
												<?= form_error('sekolah', '<small class="text-danger pl-3">', '</small>'); ?>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="label" for="tempat">Tempat Lahir*</label>
												<input type="text" class="form-control" name="tempat" value="<?php echo set_value('tempat'); ?>" id="tempat" placeholder="Kota Kelahiran">
												<?= form_error('tempat', '<small class="text-danger pl-3">', '</small>'); ?>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="label" for="ttl">Tanggal Lahir*</label>
												<input type="date" class="form-control" name="ttl" value="<?php echo set_value('ttl'); ?>" id="ttl">
												<?= form_error('ttl', '<small class="text-danger pl-3">', '</small>'); ?>
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label class="label" for="alamat">Alamat Lengkap*</label>
												<input type="text" class="form-control" name="alamat" id="alamat" value="<?php echo set_value('alamat'); ?>" placeholder="Alamat Lengkap sertakan Nama Jalan, RT, RW, Kelurahan dan Kecamatan">
												<?= form_error('alamat', '<small class="text-danger pl-3">', '</small>'); ?>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="label" for="provinsi">Provinsi</label>
												<select class="form-control" name="provinsi" id="provinsi">
													<label class="label" for="provinsi">Provinsi</label>
													<option value="">- Provinsi -</option>
													<?php foreach ($provinsi as $k) { ?>
														<option <?php if (set_value('provinsi') == $k->provinsi_id) {
																	echo "selected='selected'";
																} ?> value="<?php echo $k->provinsi_id ?>"><?php echo $k->provinsi_nama; ?></option>
													<?php } ?>
												</select>
												<?= form_error('provinsi', '<small class="text-danger pl-3">', '</small>'); ?>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="label" for="kota">Kota</label>
												<select class="form-control" name="kota" id="kota">
													<label class="label" for="kota">Kota</label>
													<option value="">- Pilih Kota -</option>
													<?php foreach ($kota as $k) { ?>
														<option <?php if (set_value('kota') == $k->kota_id) {
																	echo "selected='selected'";
																} ?> value="<?php echo $k->kota_id ?>"><?php echo $k->kota_nama; ?></option>
													<?php } ?>
												</select>
												<?= form_error('kota', '<small class="text-danger pl-3">', '</small>'); ?>
											</div>
										</div>

									</div>
									<h4 class="mb-4">Data Informasi Keluarga</h4>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="label" for="ayah">Nama Ayah*</label>
												<input type="text" class="form-control" name="ayah" id="ayah" value="<?php echo set_value('ayah'); ?>" placeholder="Nama Lengkap Ayah">
												<?= form_error('ayah', '<small class="text-danger pl-3">', '</small>'); ?>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="label" for="nik_ayah">NIK Ayah*</label>
												<input type="number" class="form-control" name="nik_ayah" id="nik_ayah" value="<?php echo set_value('nik_ayah'); ?>" placeholder="NIK Ayah">
												<?= form_error('nik_ayah', '<small class="text-danger pl-3">', '</small>'); ?>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="label" for="pekerjaanayah">Pekerjaan Ayah</label>
												<select class="form-control" name="pekerjaanayah" id="pekerjaanayah">
													<label class="label" for="pekerjaanayah">Pekerjaan Ayah</label>
													<option value="">- Pekerjaan Ayah -</option>
													<?php foreach ($pekerjaan as $k) { ?>
														<option <?php if (set_value('pekerjaanayah') == $k->pekerjaan_id) {
																	echo "selected='selected'";
																} ?> value="<?php echo $k->pekerjaan_id ?>"><?php echo $k->pekerjaan_nama; ?></option>
													<?php } ?>
												</select>
												<?= form_error('pekerjaanayah', '<small class="text-danger pl-3">', '</small>'); ?>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="label" for="pendidikanayah">Pendidikan Ayah</label>
												<select class="form-control" name="pendidikanayah" id="pendidikanayah">
													<label class="label" for="pendidikanayah">Pendidikan Ayah</label>
													<option value="">- Pendidikan Ayah -</option>
													<?php foreach ($pendidikan as $k) { ?>
														<option <?php if (set_value('pendidikanayah') == $k->pendidikan_id) {
																	echo "selected='selected'";
																} ?> value="<?php echo $k->pendidikan_id ?>"><?php echo $k->pendidikan_nama; ?></option>
													<?php } ?>
												</select>
												<?= form_error('pendidikanayah', '<small class="text-danger pl-3">', '</small>'); ?>
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label class="label" for="penghasilanayah">Penghasilan Ayah</label>
												<select class="form-control" name="penghasilanayah" id="penghasilanayah">
													<label class="label" for="penghasilanayah">Penghasilan Ayah</label>
													<option value="">- Penghasilan Ayah -</option>
													<?php foreach ($pendapatan as $k) { ?>
														<option <?php if (set_value('penghasilanayah') == $k->pendapatan_id) {
																	echo "selected='selected'";
																} ?> value="<?php echo $k->pendapatan_id ?>"><?php echo $k->pendapatan_nilai; ?></option>
													<?php } ?>
												</select>
												<?= form_error('penghasilanayah', '<small class="text-danger pl-3">', '</small>'); ?>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="label" for="ibu">Nama Ibu*</label>
												<input type="text" class="form-control" name="ibu" id="ibu" value="<?php echo set_value('ibu'); ?>" placeholder="Nama Lengkap Ibu">
												<?= form_error('ibu', '<small class="text-danger pl-3">', '</small>'); ?>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="label" for="nik_ibu">NIK Ibu*</label>
												<input type="number" class="form-control" name="nik_ibu" value="<?php echo set_value('nik_ibu'); ?>" id="nik_ibu" placeholder="NIK Ibu">
												<?= form_error('nik_ibu', '<small class="text-danger pl-3">', '</small>'); ?>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="label" for="pekerjaanibu">Pekerjaan Ibu</label>
												<select class="form-control" name="pekerjaanibu" id="pekerjaanibu">
													<label class="label" for="pekerjaanibu">Pekerjaan Ibu</label>
													<option value="">- Pekerjaan Ibu -</option>
													<?php foreach ($pekerjaan as $k) { ?>
														<option <?php if (set_value('pekerjaanibu') == $k->pekerjaan_id) {
																	echo "selected='selected'";
																} ?> value="<?php echo $k->pekerjaan_id ?>"><?php echo $k->pekerjaan_nama; ?></option>
													<?php } ?>
												</select>
												<?= form_error('pekerjaanibu', '<small class="text-danger pl-3">', '</small>'); ?>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="label" for="pendidikanibu">Pendidikan Ibu</label>
												<select class="form-control" name="pendidikanibu" id="pendidikanibu">
													<label class="label" for="pendidikanibu">Pendidikan Ibu</label>
													<option value="">- Pendidikan Ibu -</option>
													<?php foreach ($pendidikan as $k) { ?>
														<option <?php if (set_value('pendidikanibu') == $k->pendidikan_id) {
																	echo "selected='selected'";
																} ?> value="<?php echo $k->pendidikan_id ?>"><?php echo $k->pendidikan_nama; ?></option>
													<?php } ?>
												</select>
												<?= form_error('pendidikanibu', '<small class="text-danger pl-3">', '</small>'); ?>
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label class="label" for="penghasilanibu">Penghasilan Ibu</label>
												<select class="form-control" name="penghasilanibu" id="penghasilanibu">
													<label class="label" for="penghasilanibu">Penghasilan Ibu</label>
													<option value="">- Penghasilan Ibu -</option>
													<?php foreach ($pendapatan as $k) { ?>
														<option <?php if (set_value('penghasilanibu') == $k->pendapatan_id) {
																	echo "selected='selected'";
																} ?> value="<?php echo $k->pendapatan_id ?>"><?php echo $k->pendapatan_nilai; ?></option>
													<?php } ?>
												</select>
												<?= form_error('penghasilanibu', '<small class="text-danger pl-3">', '</small>'); ?>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="label" for="tinggi">Tinggi Badan*</label>
												<input type="number" class="form-control" name="tinggi" id="tinggi" value="<?php echo set_value('tinggi'); ?>" placeholder="Tinggi Badan">
												<?= form_error('tinggi', '<small class="text-danger pl-3">', '</small>'); ?>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="label" for="berat">Berat Badan*</label>
												<input type="number" class="form-control" name="berat" id="berat" value="<?php echo set_value('berat'); ?>" placeholder="Berat Badan">
												<?= form_error('berat', '<small class="text-danger pl-3">', '</small>'); ?>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="label" for="jarak">Jarak Tempat Tinggal ke Sekolah*</label>
												<input type="number" class="form-control" name="jarak" id="jarak" value="<?php echo set_value('jarak'); ?>" placeholder="Jarak Tempat Tinggal ke Sekolah">
												<?= form_error('jarak', '<small class="text-danger pl-3">', '</small>'); ?>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="label" for="saudara">Jumlah Saudara Kandung*</label>
												<input type="number" class="form-control" name="saudara" id="saudara" value="<?php echo set_value('saudara'); ?>" placeholder="Jumlah Saudara Kandung">
												<?= form_error('saudara', '<small class="text-danger pl-3">', '</small>'); ?>
											</div>
										</div>

										<!-- <div class="col-md-12">
													<div class="form-group">
														<label class="label" for="#">Nomor Seri Ijazah</label>
														<textarea name="message" class="form-control" id="message" cols="30" rows="4" placeholder="Message"></textarea>
													</div>
												</div> -->
										<div class="col-md-12">
											<div class="form-group">
												<input onclick="javascript: return confirm('Apakah Anda yakin Data sudah Lengkap ?')" type="submit" value="Daftar Sekarang" class="btn btn-primary">
												<div class="submitting"></div>
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>

						<div class="col-lg-4 col-md-5 d-flex align-items-stretch">
							<div class="info-wrap bg-primary w-100 p-md-5 p-4">
								<h3>Mari lebih dekat dengan kami</h3>
								<p class="mb-4">Apabila anda merasa kesulitan, hubungi kami</p>
								<div class="dbox w-100 d-flex align-items-start">
									<div class="icon d-flex align-items-center justify-content-center">
										<span class="fa fa-map-marker"></span>
									</div>
									<div class="text pl-3">
										<p><span>Address:</span> <?= $pengaturan->alamat; ?></p>
									</div>
								</div>
								<div class="dbox w-100 d-flex align-items-center">
									<div class="icon d-flex align-items-center justify-content-center">
										<span class="fa fa-phone"></span>
									</div>
									<div class="text pl-3">
										<p><span>Phone:</span> <a href="<?php echo $pengaturan->telpon ?>"><?php echo $pengaturan->telpon ?></a></p>
									</div>
								</div>
								<div class="dbox w-100 d-flex align-items-center">
									<div class="icon d-flex align-items-center justify-content-center">
										<span class="fa fa-paper-plane"></span>
									</div>
									<div class="text pl-3">
										<p><span>Email:</span> <a href="mailto:<?php echo $pengaturan->email ?>"><?php echo $pengaturan->email ?></a></p>
									</div>
								</div>
								<div class="dbox w-100 d-flex align-items-center">
									<div class="icon d-flex align-items-center justify-content-center">
										<span class="fa fa-instagram"></span>
									</div>
									<div class="text pl-3">
										<p><a href="<?php echo $pengaturan->link_instagram ?>"><span>Our Instagram</span> </a></p>
									</div>
								</div>
								<div class="dbox w-100 d-flex align-items-center">
									<div class="icon d-flex align-items-center justify-content-center">
										<span class="fa fa-globe"></span>
									</div>
									<div class="text pl-3">
										<p><span>Website</span> <a href="<?php echo base_url() ?>"><?php echo base_url() ?></a></p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!DOCTYPE html>
<html lang="en"><head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Data Siswa</title>

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/Ionicons/css/ionicons.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/skins/_all-skins.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/morris.js/morris.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/jvectormap/jquery-jvectormap.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/bootstrap-daterangepicker/daterangepicker.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head><body>
    <h3 style="text-align: center">Daftar Mahasiswa</h3>
    <br><br>
<table border=".5" class="table table-bordered">
								<thead>
									<tr>
										<th width="1%">NO</th>
										<th>Nama Siswa</th>
										<th>NISN</th>
										<th>Email</th>
                                        <th>Program Keahlian</th>
                                        <th>JK</th>
                                        <th>Agama</th>
                                        <th>No. Ijazah</th>
                                        <th>No. SKHUN</th>
                                        <!-- <th>Nomor UN</th> -->
                                        <!-- <th>NIK</th> -->
                                        <th>Asal Sekolah</th>
                                        <th>Tempat Lahir</th>
                                        <th>Tanggal Lahir</th>
                                        <th>Alamat</th>
                                        <th>Berat</th>
                                        <th>Tinggi</th>
                                        <!-- <th>Jarak Rumah</th> -->
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
											<td><?php echo $a->jurusan_singkat; ?></td>
											<td><?php echo $a->gender_jenis; ?></td>
											<td><?php echo $a->agama_nama; ?></td>
											<td><?php echo $a->ijazah; ?></td>
											<td><?php echo $a->skhun; ?></td>
											<!-- <td><?php echo $a->un; ?></td> -->
											<!-- <td><?php echo $a->nik; ?></td> -->
                                            <td><?php echo $a->sekolah; ?></td>
                                            <td><?php echo $a->tempat_lahir; ?></td>
                                            <td><?php echo $a->ttl; ?></td>
                                            <td><?= $a->alamat;?>, <?= $a->kota_nama;?>, <?= $a->provinsi_nama ?></td>
                                            <td><?php echo $a->berat; ?> Kg</td>
                                            <td><?php echo $a->tinggi; ?> Cm</td>
                                            <!-- <td><?php echo $a->jarak; ?> Km</td> -->
                                        </tr>
                                    <?php }?>
                                </tbody>
                            </table>
</body></html>






<!--  -->
<!--  -->
<!--  -->
<!-- <!DOCTYPE html>
<html lang="en"><head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Export Siswa PDF</title>
</head><body>
    <h3 style="text-align: center">Daftar Mahasiswa</h3>
<table border="1" class="table table-bordered">
								<thead>
									<tr>
										<th width="1%">NO</th>
										<th>Nama Siswa</th>
										<th>NISN</th>
										<th>Email</th>
                                        <th>Prodi</th>
                                        <th>JK</th>
                                        <th>NIK Siswa</th>
                                        <th>Ijazah</th>
                                        <th>SKHUN</th>
                                        <th>UN</th>
                                        <th>Asal Sekolah</th>
                                        <th>Tempat Lahir</th>
                                        <th>Tanggal Lahir</th>
                                        <th>Alamat</th>
                                        <th>Berat</th>
                                        <th width="4%">Tinggi</th>
                                        <th>Jarak Rumah</th>
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
											<td align="center"><?php echo $a->nisn; ?></td>
											<td><?php echo $a->email; ?></td>
											<td align="center"><?php echo $a->jurusan_singkat; ?></td>
											<td align="center"><?php echo $a->gender_jenis; ?></td>
											<td><?php echo $a->nik; ?></td>
											<td><?php echo $a->ijazah; ?></td>
											<td><?php echo $a->skhun; ?></td>
											<td><?php echo $a->un; ?></td>
                                            <td><?php echo $a->sekolah; ?></td>
                                            <td><?php echo $a->tempat_lahir; ?></td>
                                            <td><?php echo $a->ttl; ?></td>
                                            <td><?= $a->alamat;?>, <?= $a->kota_nama;?>, <?= $a->provinsi_nama ?></td>
                                            <td><?php echo $a->berat; ?> Kg</td>
                                            <td><?php echo $a->tinggi; ?> Cm</td>
                                            <td><?php echo $a->jarak; ?> Km</td>
                                        </tr>
                                    <?php }?>
                                </tbody>
                            </table>
</body></html> -->
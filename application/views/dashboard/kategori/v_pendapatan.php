<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Pendapatan Orang Tua
			<small>Kategori Pendapatan Orang Tua</small>
		</h1>
	</section>

	<section class="content">

		<div class="row">
			<div class="col-lg-9">
				
				<a href="<?php echo base_url().'dashboard/pendapatan_tambah'; ?>" class="btn btn-sm btn-primary">Buat Pendapatan Orang Tua baru</a>

				<br/>
				<br/>

				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">Pendapatan Orang Tua</h3>
					</div>
					<div class="box-body">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th width="1%">NO</th>
									<th>Pendapatan Orang Tua</th>
									<th width="10%">OPSI</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$no = 1;
								foreach($pendapatan as $k){ 
									?>
									<tr>
										<td><?php echo $no++; ?></td>
										<td><?php echo $k->pendapatan_nilai ?></td>
										<td>
											<a href="<?php echo base_url().'dashboard/pendapatan_edit/'.$k->pendapatan_id; ?>" class="btn btn-warning btn-sm"> <i class="fa fa-pencil"></i> </a>
											<a onclick="javascript: return confirm('Anda Yakin Hapus ?')" href="<?php echo base_url().'dashboard/pendapatan_hapus/'.$k->pendapatan_id; ?>" class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i> </a>
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
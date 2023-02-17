<section class="ftco-section ftco-no-pt bg-light">
    	<div class="container">
    		<div class="row d-flex no-gutters">
    			<div class="col-md-6 d-flex">
				<?php foreach($sambutan as $s) {?>
    				<div class="img img-video d-flex align-self-stretch align-items-center justify-content-center justify-content-md-center mb-4 mb-sm-0">
						<img width="620px" src="<?php echo base_url(); ?>gambar/website/<?php echo $s->foto ?>" alt="">
					</div>
				<?php }?>
    			</div>
    			<div class="col-md-6 pl-md-5 py-md-5">
    				<div class="heading-section pl-md-4 pt-md-5">
						<?php foreach($sambutan as $s) {?>
    					<span class="subheading">Selamat Datang di Website SMK Asy-Syifa Depok</span>
	            <h2 class="mb-4"><?php echo $s->judul; ?></h2>
					</div>
					<div class="services-2 w-100 d-flex">
    					<div class="text pl-4">
    						<?php echo $s->konten; ?>
    					</div>
					</div>
						<?php }?>
                </div>
            </div>
    	</div>
</section>
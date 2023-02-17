<div class="hero-wrap">
  <div class="home-slider owl-carousel">
        <?php foreach ($banner as $b) { ?>
          <div class="slider-item" style="background-image:url(<?php echo base_url().'/gambar/banner/'.$b->foto; ?>);">
            <div class="overlay"></div>
              <div class="container">
                <div class="row no-gutters slider-text align-items-center justify-content-center">
                  <div class="col-md-8 ftco-animate">
                    <div class="text w-100 text-center">
                      <h2><?php echo $b->banner_nama?></h2>
                        <h5 class="mb-4 text-white"><?php echo $b->teks?></h5>
                      <p><a href="<?php echo base_url().'welcome/daftar_aksi' ?>" class="btn btn-white">Connect with us</a></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        <?php }?>
  </div>
</div>

    <?php $this->load->view('frontend/greeting'); ?>
    <?php $this->load->view('frontend/data'); ?>

    <section class="ftco-section">
      <div class="container">
        <div class="row justify-content-center pb-5 mb-3">
          <div class="col-md-7 heading-section text-center ftco-animate">
          	<span class="subheading">Info penerimaan siswa baru</span>
            <h1>#INFO PPDB <?php echo date('Y'); ?></h1>
          </div>
        </div>
        <div class="row d-flex no-gutters">
        <div class="col-md-6 pl-md-4 py-md-4">
          <div class="heading-section">
          <?php foreach($infoppdb as $s) {?>
            <span class="subheading"><?php echo $s->nama;?></span>
            <h2 class="mb-4"><?php echo $s->judul; ?></h2>
            <div class="services-2 w-100 d-flex">
                  <div class="text pl-4">
                        <?php echo $s->konten; ?>
                  </div>
          <?php }?>
            </div>          
          </div>
        </div>
                  <div class="col-md-6 pl-md-5 py-md-5">
                    <div class="heading-section pl-md-4 pt-md-5">
                    <?php foreach($infoppdb as $s) {?>
                      <div class="img img-video d-flex align-self-stretch align-items-center justify-content-center justify-content-md-center mb-4 mb-sm-0">
                        <img width="620px" src="<?php echo base_url(); ?>gambar/info/<?php echo $s->picture;?>" alt="">
                      </div>
                      <?php }?>
                  </div>
                </div>
            </div>
          </div>
    </section>

    <!-- View video kegiatan -->
    <?php $this->load->view('frontend/kegiatan',$data); ?>
    <?php $this->load->view('frontend/faq', $data); ?>
    

    <section class="ftco-section">
      <div class="container">
        <div class="row justify-content-center pb-5 mb-3">
          <div class="col-md-7 heading-section text-center ftco-animate">
          	<span class="subheading">News &amp; Blog</span>
            <h2>Latest news from our blog</h2>
          </div>
        </div>
        <div class="row d-flex">
          <?php foreach($artikel as $a){ ?>
          <div class="col-md-4 d-flex ftco-animate">
            <div class="blog-entry align-self-stretch">
              <a href="#" class="block-20 rounded">
              <?php if($a->artikel_sampul != ""){ ?>
                      <img style="height: 300px; width:400px;" src="<?php echo base_url(); ?>gambar/artikel/<?php echo $a->artikel_sampul ?>" alt="" class="img-fluid">
              <?php } ?>
              </a>
              <div class="text p-4">
              	<div class="meta mb-2">
                  <div><a href="#"><span class="fa fa-calendar"></span> <?php echo date('d-M-Y', strtotime($a->artikel_tanggal)); ?></a></div>
                  <div><a href="#"><span class="fa fa-pencil"></span> <?php echo $a->pengguna_nama; ?></a></div>
                  <!-- <div><a href="#" class="meta-chat"><span class="fa fa-comment"></span> 3</a></div> -->
                </div>
                <h3 class="heading"><a href="<?php echo base_url().$a->artikel_slug ?>"><?php echo $a->artikel_judul ?></a></h3>
              </div>
            </div>
          </div>
          <?php }?>
        </div>
      </div>
    </section>

    <?php $this->load->view('frontend/v_galeri', $data); ?>
<br><br><br>

          </div>
        </div>
      </div>
    </section>
    
    <br><br>
    <?php $this->load->view('frontend/d-alumni'); ?>
    <section class="ftco-section bg-light ftco-no-pt">
    	<div class="container">
        <h2 class="text-center pt-4 pb-5">Our Partner</h2>
    		<div class="row">
          <?php foreach($partner as $a) { ?>
          <div class="col-md-6 col-lg-3 d-flex services align-self-stretch px-4 mt-3 ftco-animate">
            <div class="d-block ">
              <div class="icon  d-flex mr-2">
                  <img class="align-items-center" src="<?php echo base_url(); ?>gambar/profil/<?php echo $a->foto ?>" width="100px" alt="<?php echo $a->partner_nama ?>">
              </div>
              <div class="media-body">
				<!-- <h3 class="heading">Accounting</h3> -->
				<br><br><br>
                <p><?php echo $a->teks?></p>
              </div>
            </div>
          </div>
          <?php }?>
          
        </div>
    	</div>
    </section>
<?php $background = $this->db->query("SELECT * FROM background WHERE background_kategori='guru' ORDER BY background_id")->result();
foreach($background as $a) { ?>
    <section class="hero-wrap hero-wrap-2" style="background-image: url('<?php echo base_url().'/gambar/background/'.$a->foto; ?>');" data-stellar-background-ratio="0.5">
    <?php }?>
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text align-items-end">
          <div class="col-md-9 ftco-animate pb-5">
          	<p class="breadcrumbs mb-2"><span class="mr-2"><a href="<?php echo base_url(); ?>">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Guru <i class="ion-ios-arrow-forward"></i></span></p>
            <h1 class="mb-0 bread">Guru</h1>
          </div>
        </div>
      </div>
    </section>


    <section class="ftco-section">
      <div class="container">
        <div class="row d-flex">
          <?php foreach($guru as $a) { ?>
          <div class="col-md-4 d-flex ftco-animate">
            <div class="blog-entry align-self-stretch">
              <a href="#" class="block-20 rounded" style="background-image: url('<?php echo base_url().'/gambar/guru/'.$a->guru_sampul; ?>');">
              </a>
              <div class="text p-4">
              	<div class="meta mb-2">
                  <!-- <div><p><?php echo $a->guru_tanggal ?></p></div> -->
                  <div><a href="#"><?php echo $a->kategori_nama ?></a></div>
                  <!-- <div><a href="#" class="meta-chat"><span class="fa fa-comment"></span> 3</a></div> -->
                </div>
                <h3 class="heading"><?php echo $a->guru_judul?></h3>
                <p class=""><?php echo $a->guru_konten ?></p>
                <!-- <p class=""><?php echo word_limiter($a->guru_konten, 10); ?></p> -->
              </div>
            </div>
          </div>
          <?php }?>
          
        </div>
        <nav class="blog-pagination justify-content-center d-flex">
		                        <ul class="pagination">
		                            <li class="page-item">
									<?php echo $this->pagination->create_links(); ?>
		                            </li>
		                        </ul>
		                    </nav>
        
      </div>
    </section>


    <?php $this->load->view('frontend/d-alumni.php'); ?>
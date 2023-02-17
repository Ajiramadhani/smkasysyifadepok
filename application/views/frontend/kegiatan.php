<section class="ftco-section testimony-section bg-light">
    	<div class="overlay"></div>
      <div class="container-fluid">
        <div class="row justify-content-center pb-5 mb-3">
          <div class="col-md-7 heading-section heading-section-white text-center ftco-animate">
			  <h2>Wujud Kegiatan Kami </h2>
          	<span class="subheading">Kreatifitas, Seni &amp; Budaya</span>
          </div>
        </div>
        
        <div class="row ftco-animate">
          <div class="col-md-12">
            <div class="carousel-testimony owl-carousel ftco-owl">
              <?php foreach ($kata as $k) {?>
              <div class="item">
                <div class="testimony-wrap py-4">
                  <div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-quote-left"></span></div>
                  <div class="text">
                    <p class="mb-4"><iframe width="<?= $k->kata_width?>" height="<?= $k->kata_height?>" src="<?= $k->kata_slug?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></p>
                    <div class="d-flex align-items-center">
                      <!-- <div class="pl-3"> -->
		                    <p class="name"><?= $k->kata_nama?></p>
		                    <!-- <span class="position">Alumni Angkatan 7</span> -->
		                  </div>
	                  </div>
                </div>
                  </div>
                  <?php }?>
                </div>
            </div>
          </div>
        </div>          
      </div>
    </section>
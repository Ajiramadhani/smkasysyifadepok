<?php $background = $this->db->query("SELECT * FROM background WHERE background_kategori='search' ORDER BY background_id")->result();
foreach($background as $a) { ?>
    <section class="hero-wrap hero-wrap-2" style="background-image: url('<?php echo base_url().'/gambar/background/'.$a->foto; ?>');" data-stellar-background-ratio="0.5">
    <?php }?>
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text align-items-end">
          <div class="col-md-9 ftco-animate pb-5">
          	<p class="breadcrumbs mb-2"><span class="mr-2"><a href="<?php echo base_url(); ?>">Home<i class="ion-ios-arrow-forward"></i></a></span> / <span><a href="<?php echo base_url('blog');?>">Search</a></span> / <?php echo $cari ?> <i class="ion-ios-arrow-forward"></i></p>
            <h1 class="mb-0 bread">Pencarian</h1>
          </div>
        </div>
      </div>
    </section>
<!--/ Intro Skew End /-->

<!--/ Section Blog-Single Star /-->
<section class="ftco-section">
      <div class="container">
        <div class="row d-flex">
        <?php if(count($artikel) == 0){ ?>
          <center>
            <h3 class="mt-5">Hasil Pencarian Tidak Ditemukan.</h3>
          </center>
        <?php } ?>
          <?php foreach($artikel as $a) { ?>
          <div class="col-md-4 d-flex ftco-animate">
            <div class="blog-entry align-self-stretch">
            <?php if($a->artikel_sampul != ""){ ?>
              <a href="<?php echo $a->artikel_slug?>" class="block-20 rounded" style="background-image: url('<?php echo base_url().'/gambar/artikel/'.$a->artikel_sampul; ?>');">
              </a>
            <?php } ?>
              <div class="text p-4">
              	<div class="meta mb-2">
                  <div><a href="#"><?php echo $a->artikel_tanggal ?></a></div>
                  <div><a href="#"><?php echo $a->pengguna_nama ?></a></div>
                  <!-- <div><a href="#" class="meta-chat"><span class="fa fa-comment"></span> 3</a></div> -->
                </div>
                <h3 class="heading"><a href="<?php echo base_url().$a->artikel_slug ?>"><?php echo mb_strtoupper($a->artikel_judul); ?></a></h3>
                <h5 class="heading"><a href="<?php echo base_url().$a->artikel_slug ?>"><?php echo word_limiter($a->artikel_konten, 10); ?></a></h5>
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


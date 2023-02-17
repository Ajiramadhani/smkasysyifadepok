<?php $background = $this->db->query("SELECT * FROM background WHERE background_kategori='single' ORDER BY background_id")->result();
foreach($background as $a) { ?>
    <section class="hero-wrap hero-wrap-2" style="background-image: url('<?php echo base_url().'/gambar/background/'.$a->foto; ?>');" data-stellar-background-ratio="0.5">
    <?php }?>
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text align-items-end">
          <div class="col-md-9 ftco-animate pb-5">
          	<p class="breadcrumbs mb-2"><span class="mr-2"><a href="<?php echo base_url(); ?>">Home <i class="ion-ios-arrow-forward"></i></a></span> <span class="mr-2">Blog <i class="ion-ios-arrow-forward"></span></p>
            <h1 class="mb-0 bread">Blog Single</h1>
          </div>
        </div>
      </div>
    </section>

    <section class="ftco-section ftco-degree-bg">
      <div class="container">
        <div class="row">
          <?php foreach($artikel as $a) {?>
          <div class="col-lg-8 ftco-animate">
          	<p>
              <img src="<?php echo base_url().'/gambar/artikel/'.$a->artikel_sampul; ?>" alt="" class="img-fluid">
            </p>
            <h2 class="mb-3"><?php echo $a->artikel_judul; ?></h2>
            <p><?php echo $a->artikel_konten?></p>
            
            <div class="tag-widget post-tag-container mb-5 mt-5">
              <div class="tagcloud">
                <a href="<?php echo $a->kategori_slug?>" class="tag-cloud-link"><?php echo $a->kategori_nama?></a>
              </div>
            </div>
          <?php }?>
            <div class="about-author d-flex p-4 bg-light">
              <div class="bio mr-5">
              <?php foreach ($artikel as $p) {?>
                <img src="<?php echo base_url().'/gambar/profil/pengguna/'.$p->foto; ?>" width="200px" alt="Image placeholder" class="img-fluid mb-4">
              </div>
              <div class="desc">
                <h3><?php echo $p->pengguna_nama?></h3>
                <p><?php echo $p->deskripsi?></p>
              </div>
              <?php }?>
            </div>


            

          </div> <!-- .col-md-8 -->
          <div class="col-lg-4 sidebar pl-lg-5 ftco-animate">
            <div class="sidebar-box">
            <?php echo form_open(base_url().'search'); ?>
              <div class="search-form">
                <div class="form-group">
                  <span class="fa fa-search"></span>
                  <input type="text" name="cari" class="form-control" placeholder="Type a keyword and hit enter">
                </div>
              </div>
              </form>
            </div>
            <!-- <div class="sidebar-box ftco-animate">
              <div class="categories">
                <h3>Services</h3>
                <li><a href="#">Market Analysis <span class="fa fa-chevron-right"></span></a></li>
                <li><a href="#">Accounting Advisor <span class="fa fa-chevron-right"></span></a></li>
                <li><a href="#">General Consultancy <span class="fa fa-chevron-right"></span></a></li>
                <li><a href="#">Structured Assesment <span class="fa fa-chevron-right"></span></a></li>
              </div>
            </div> -->

            <div class="sidebar-box ftco-animate">
              <h3>Recent Blog</h3>
              <?php 
                  $artikel = $this->db->query("SELECT * FROM artikel,pengguna,kategori WHERE artikel_status='publish' AND artikel_author=pengguna_id AND artikel_kategori=kategori_id ORDER BY artikel_id DESC LIMIT 3")->result();
                  foreach($artikel as $a){
                ?>
              <div class="block-21 mb-4 d-flex">
                <a class="blog-img mr-4" style="background-image: url('<?php echo base_url().'/gambar/artikel/'.$a->artikel_sampul; ?>');  "></a>
                <div class="text">
                
                  <h3 class="heading"><a href="<?php echo base_url().$a->artikel_slug; ?>"><?php echo $a->artikel_judul; ?></a></h3>
                  <div class="meta">
                    <div><a href="#"><span class="icon-calendar"></span><?php echo $a->artikel_tanggal ?></a></div>
                    <div><a href="#"><span class="icon-person"></span><?php echo $a->pengguna_nama ?></a></div>
                  </div>
                </div>
              </div>
              <?php }?>
            </div>

            <div class="sidebar-box ftco-animate">
              <h3>Tag Cloud</h3>
              <div class="tagcloud">
                <?php 
                    $kategori = $this->m_data->get_data('kategori')->result();
                    foreach($kategori as $k){
                ?>
                <a href="<?php echo $k->kategori_slug?>" class="tag-cloud-link"><?php echo $k->kategori_nama?></a>
                <?php }?>  
              </div>
            </div>
          </div>

        </div>
      </div>
    </section> <!-- .section -->

    <?php $this->load->view('frontend/d-alumni.php'); ?>

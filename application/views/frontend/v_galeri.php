    <!-- ##### Portfolio Area Start ###### -->
    <div class="pixel-portfolio-area section-padding-100-0 pb-4">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- Section Heading -->
                    <div class="section-heading text-center wow fadeInUp py-5" data-wow-delay="100ms">
                        <h2>Galeri <?= $pengaturan->nama?></h2>
                        <img src="img/core-img/x.png" alt="">
                    </div>
                </div>
            </div>
        </div>

        <!-- Portfolio Menu -->
        <div class="pixel-projects-menu wow fadeInUp" data-wow-delay="200ms">
            <div class="text-center portfolio-menu">
                <button class="btn active" data-filter="*">All Photos</button>
                <?php foreach ($kat_galeri as $g) {?>
                <button class="btn" data-filter=".<?php echo $g->kat_galeri_id?>"><?php echo $g->kat_galeri_nama?></button>
                <?php }?>
            </div>
        </div>

        <div class="pixel-portfolio">
          
          <!-- Single gallery Item -->
          <?php foreach ($galeri as $g) {?>
          <div class="single_gallery_item <?php echo $g->kat_galeri_id; ?> wow fadeInUp" data-wow-delay="0.2s">
                <img src="<?php echo base_url(); ?>gambar/galeri/<?php echo $g->foto ?>" alt="">
                <div class="hover-content text-center d-flex align-items-center justify-content-center">
                    <div class="hover-text">
                        <a href="<?php echo base_url(); ?>gambar/galeri/<?php echo $g->foto ?>" class="zoom-img"><i class="fa fa-eye" aria-hidden="true"></i></a>
                        <h4><?= $g->galeri_judul?></h4>
                    </div>
                </div>
            </div>
            <?php }?>
          
        </div>
    </div>
    <!-- ##### Portfolio Area End ###### -->

    

    <!-- ##### All Javascript Script ##### -->
    <!-- jQuery-2.2.4 js -->
    <script src="<?php echo base_url(); ?>assets_frontend/galeri/js/jquery/jquery-2.2.4.min.js"></script>
    <!-- Popper js -->
    <script src="<?php echo base_url(); ?>assets_frontend/galeri/js/bootstrap/popper.min.js"></script>
    <!-- Bootstrap js -->
    <script src="<?php echo base_url(); ?>assets_frontend/galeri/js/bootstrap/bootstrap.min.js"></script>
    <!-- All Plugins js -->
    <script src="<?php echo base_url(); ?>assets_frontend/galeri/js/plugins/plugins.js"></script>
    <!-- Active js -->
    <script src="<?php echo base_url(); ?>assets_frontend/galeri/js/active.js"></script>
</body>

</html>
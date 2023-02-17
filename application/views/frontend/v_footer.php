<footer class="footer">
			<div class="container-fluid px-lg-5">
				<div class="row">
					<div class="col-md-9 py-5">
						<div class="row">
							<div class="col-md-4 mb-md-0 mb-4">
								<h2 class="footer-heading">About us</h2>
								<p>Salah satu sekolah terbaik di Kota Depok dengan kualitas pendidikan yang baik dan pola pembelajaran yang tepat</p>
								<ul class="ftco-footer-social p-0">
									<li class="ftco-animate"><a href="<?php echo $pengaturan->link_facebook?>" data-toggle="tooltip" data-placement="top" title="Twitter"><span class="fa fa-twitter"></span></a></li>
									<li class="ftco-animate"><a href="<?php echo $pengaturan->link_twitter?>"  data-toggle="tooltip" data-placement="top" title="Facebook"><span class="fa fa-facebook"></span></a></li>
									<li class="ftco-animate"><a href="<?php echo $pengaturan->link_instagram?>" data-toggle="tooltip" data-placement="top" title="Instagram"><span class="fa fa-instagram"></span></a></li>
									<li class="ftco-animate"><a href="<?php echo $pengaturan->link_youtube?>" data-toggle="tooltip" data-placement="top" title="Youtube"><span class="fa fa-youtube"></span></a></li>
		            			</ul>
							</div>
							<div class="col-md-8">
								<div class="row justify-content-center">
									<div class="col-md-12 col-lg-10">
										<div class="row">
											<div class="col-md-4 mb-md-0 mb-4">
												<h2 class="footer-heading">Media Sosial</h2>
												
												<ul class="list-unstyled">
													<li><a target="_blank" href="<?php echo $pengaturan->link_instagram ?>" class="py-1 d-block">Instagram</a></li>
													<li><a target="_blank" href="<?php echo $pengaturan->link_twitter ?>" class="py-1 d-block">Twitter</a></li>
													<li><a target="_blank" href="<?php echo $pengaturan->link_facebook ?>" class="py-1 d-block">Facebook</a></li>
													<li><a target="_blank" href="<?php echo $pengaturan->link_youtube ?>" class="py-1 d-block">Youtube</a></li>
												
												</ul>
											</div>
											<div class="col-md-4 mb-md-0 mb-4">
												<h2 class="footer-heading">Daftar Menu</h2>
												<ul class="list-unstyled">
													<li><a href="<?php echo base_url(); ?>" class="py-1 d-block">Home</a></li>
													<li><a href="<?php echo base_url('page/tentang'); ?>" class="py-1 d-block">About</a></li>
													<li><a href="<?php echo base_url('guru'); ?>" class="py-1 d-block">Tenaga Pengajar</a></li>
													<li><a href="<?php echo base_url('welcome/daftar_aksi'); ?>" class="py-1 d-block">Daftar</a></li>
												</ul>
											</div>
											<!-- <div class="col-md-4 mb-md-0 mb-4">
												<h2 class="footer-heading">Resources</h2>
												<ul class="list-unstyled">
													<li><a href="#" class="py-1 d-block">Security</a></li>
													<li><a href="#" class="py-1 d-block">Global</a></li>
													<li><a href="#" class="py-1 d-block">Charts</a></li>
													<li><a href="#" class="py-1 d-block">Privacy</a></li>
												</ul>
											</div> -->
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row mt-md-5">
							<div class="col-md-12">
								<p class="copyright"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
					  Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://setiantoaji.com" target="_blank">Setiantoaji.com</a>
					  <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
							</div>
						</div>
					</div>
					<div class="col-md-3 py-md-5 py-4 aside-stretch-right pl-lg-5">
						<h2 class="footer-heading">Lokasi Kami</h2>
						<iframe src="<?= $pengaturan->link_alamat;?>" 
							width="800" height="250" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
					</div>
				</div>
			</div>
		</footer>
    
  

  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


  <script src="<?php echo base_url(); ?>assets_frontend/depan/js/jquery.min.js"></script>
  <script src="<?php echo base_url(); ?>assets_frontend/depan/js/jquery-migrate-3.0.1.min.js"></script>
  <script src="<?php echo base_url(); ?>assets_frontend/depan/js/popper.min.js"></script>
  <script src="<?php echo base_url(); ?>assets_frontend/depan/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url(); ?>assets_frontend/depan/js/jquery.easing.1.3.js"></script>
  <script src="<?php echo base_url(); ?>assets_frontend/depan/js/jquery.waypoints.min.js"></script>
  <script src="<?php echo base_url(); ?>assets_frontend/depan/js/jquery.stellar.min.js"></script>
  <script src="<?php echo base_url(); ?>assets_frontend/depan/js/jquery.animateNumber.min.js"></script>
  <script src="<?php echo base_url(); ?>assets_frontend/depan/js/owl.carousel.min.js"></script>
  <script src="<?php echo base_url(); ?>assets_frontend/depan/js/jquery.magnific-popup.min.js"></script>
  <script src="<?php echo base_url(); ?>assets_frontend/depan/js/scrollax.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="<?php echo base_url(); ?>assets_frontend/depan/js/google-map.js"></script>
  <script src="<?php echo base_url(); ?>assets_frontend/depan/js/main.js"></script>
  <!-- jQuery-2.2.4 js -->
  <script src="js/jquery/jquery-2.2.4.min.js"></script>
    <!-- Popper js -->
    <script src="js/bootstrap/popper.min.js"></script>
    <!-- Bootstrap js -->
    <script src="js/bootstrap/bootstrap.min.js"></script>
    <!-- All Plugins js -->
    <script src="js/plugins/plugins.js"></script>
    <!-- Active js -->
    <script src="js/active.js"></script>
    
  </body>
</html>
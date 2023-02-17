<section class="ftco-section ftco-no-pt bg-light ftco-faqs">
    	<div class="container">
    		<div class="row">
    			<div class="col-lg-6">
    				<div class="img-faqs w-100">
						<?php 
						$coba = $this->db->query("SELECT * FROM bg_faq WHERE bgfaq_kategori=1 ORDER BY bgfaq_id")->result();
						foreach ($coba as $bf) { ?>
	    				<div class="img mb-4 mb-sm-0" style="background-image:url(<?php echo base_url().'/gambar/bgfaq/'.$bf->foto; ?>);">
						</div>
						<?php }?>
						<?php 
						$coba = $this->db->query("SELECT * FROM bg_faq WHERE bgfaq_kategori=2 ORDER BY bgfaq_id")->result();
						foreach ($coba as $bf) { ?>
	    				<div class="img img-2 mb-4 mb-sm-0" style="background-image:url(<?php echo base_url().'/gambar/bgfaq/'.$bf->foto; ?>);">
						</div>
						<?php }?>
	    			</div>
    			</div>
    			<div class="col-lg-6 pl-lg-5">
    				<div class="heading-section mb-5 mt-5 mt-lg-0">
    					<span class="subheading">FAQs</span>
	            <h2 class="mb-3">Paling Sering di Tanyakan</h2>
	            <p>Sebagai salah satu sekolah terbaik dan berpengalaman di Kota Depok kami dengan senang hati menjawab apa yang paling sering ditanyakan</p>
    				</div>
    				<div id="accordion" class="myaccordion w-100" aria-multiselectable="true">
						<div class="card">
							<?php foreach($faq as $f) { ?>
							<div class="card-header p-0" id="headingOne">
								<input type="hidden" value="<?php echo $f->faq_id?>">
						      <h2 class="mb-0">
						        <button href="#collapseOne" class="d-flex py-3 px-4 align-items-center justify-content-between btn btn-link" data-parent="#accordion" data-toggle="collapse" aria-expanded="true" aria-controls="collapseOne">
						        	<p class="mb-0"><?php echo $f->faq_judul?></p>
						          <i class="fa" aria-hidden="true"></i>
						        </button>
						      </h2>
						    </div>
						    <div class="collapse show" id="collapseOne" role="tabpanel" aria-labelledby="headingOne">
								<?php echo $f->faq_jawab?>
						      <div class="card-body py-3 px-0">
						      </div>
						    </div>
							<?php }?>
						  </div>
						</div>
	        </div>
        </div>
    	</div>
    </section>
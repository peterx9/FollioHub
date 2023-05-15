 <!-- start banner Area -->
    <section class="banner-area relative" id="home">  
      <div class="overlay overlay-bg"></div>
      <div class="container">
        <div class="row d-flex align-items-center justify-content-center">
          <div class="about-content col-lg-12">
            <h1 class="text-white">
				<?=trans('label_saved_jobs')?>      
            </h1> 
            <p class="text-white link-nav"><a href="<?= base_url(); ?>"><?=trans('label_home')?> </a>  <span class="lnr lnr-arrow-right"></span>  <a href=""> <?=trans('label_saved_jobs')?>S</a></p>
          </div>                      
        </div>
      </div>
    </section>
    <!-- End banner Area -->  
<!-- Start post Area -->
<section class="post-area section-gap">
	<div class="container">
		<div class="row justify-content-center d-flex">
			<div class="col-lg-4 sidebar">							
				<?php $this->load->view($user_sidebar); ?>
			</div>
			<div class="col-lg-8 post-list">

				<?php if ($this->session->flashdata('success')) :?>
		            <div class="alert alert-success">
		              <a href="#" class="close" data-dimdiss="alert" aria-label="close" title="close">×</a>
		              <strong><?=$this->session->flashdata('success')?></strong> 
		            </div>
		        <?php endif;?>

                <?php if(empty($jobs)): ?>
                  <p class="text-gray"><strong><?=trans('sorry')?>,</strong> <?=trans('no_saved_job')?></p>
                <?php endif; ?>
                
				<?php foreach($jobs as $job): ?>
				<div class="single-post d-flex flex-row">
					<div class="thumb">
						<img src="<?= base_url()?>assets/img/job_icon.png" alt="">
					</div>
					<div class="details">
						<div class="title d-flex flex-row justify-content-between">
							<div class="titles">
								<a href="<?= site_url('jobs/'.$job['id'].'/'.($job['job_slug'])); ?>"><h4><?= text_limit($job['title'], 35); ?></h4></a>
								<h6><?= get_company_name($job['company_id']); ?></h6>					
							</div>
							
						</div>
						<div class="job-listing-footer">
							<ul>
								<li><i class="lnr lnr-map-marker"></i> <?= get_city_name($job['city']); ?>, <?= get_country_name($job['country']); ?></li>
								<li><i class="lnr lnr-briefcase"></i> <?= get_job_type_name($job['job_type']); ?></li>
								<li><i class="lnr lnr-apartment"></i> <?= get_industry_name($job['industry']); ?></li>
								<li><i class="lnr lnr-clock"></i> <?= time_ago($job['created_date']); ?></li>
							</ul>									
						</div>
					</div>
					<div class="job-listing-btns ml-4">
						<ul class="btns">
							<li><a class="btn-delete" href="<?= base_url('myjobs/delete/'.$job['job_id']); ?>"><span class="lnr lnr-trash"></span></a></li>
						</ul>
					</div>
				</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>	
</section>
<!-- End post Area -->		
<!-- JSsocials -->
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/plugins/jssocials/jssocials.css" />
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/plugins/jssocials/jssocials-theme-flat.css" />


<!-- start banner Area -->
<section class="banner-area relative" id="home">	
	<div class="overlay overlay-bg"></div>
	<div class="container">
		<div class="row d-flex align-items-center justify-content-center">
			<div class="about-content col-lg-12">
				<h1 class="text-white">
					<?=trans('job_details')?>
				</h1>	
				<p class="text-white link-nav"><a href="<?= base_url(); ?>"><?=trans('label_home')?> </a>  <span class="lnr lnr-arrow-right"></span>  <a href=""> <?=trans('job_details')?></a></p>
			</div>											
		</div>
	</div>
</section>
<!-- End banner Area -->	

<!-- Start post Area -->
<section class="post-area section-gap">
	<div class="container">
		<div class="row d-flex">
			<div class="col-lg-8 col-12">
				<?php if($this->session->flashdata('applied_success')): ?>
		          <div class="alert alert-success">
		            <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
		            <?=$this->session->flashdata('applied_success')?>
		          </div>
		        <?php  endif; ?>
		        <?php if($already_applied == true && $this->session->flashdata('applied_success') == null): ?>
		          <div class="alert alert-success">
		            <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
					  <?=trans('already_applied')?>
		          </div>
		        <?php  endif; ?>
		        <?php if($this->session->flashdata('validation_errors')): ?>
		         <div class="alert alert-danger">
		          <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
		          <?= $this->session->flashdata('validation_errors') ?>
		        </div>
		      <?php endif; ?>
			</div>
			<div class="col-lg-8 post-list">
				<div class="single-post d-flex flex-row">
					<div class="details col-12">
						<div class="title d-flex flex-row justify-content-between mb-2">
							<div class="titles">
								<a href="#"><h4><?= $job_detail['title']; ?></h4></a>
								<h6><?= get_company_name($job_detail['company_id']); ?></h6>					
							</div>
							<?php if($already_applied != true): ?>
							<ul class="btns">
								<li><a id="btn-apply" data-toggle="collapse" href="#collapseExample" role="button"><?=trans('apply')?></a></li>
							</ul>
							<?php endif; ?>
						</div>
						<hr/>
						<p class="address">
							<strong><?=trans('industry')?>:</strong> <?= get_industry_name($job_detail['industry']); ?>
						</p>
						<p class="address">
							<strong><?=trans('total_positions')?>:</strong> <?= $job_detail['total_positions']; ?>
						</p>
						<p class="address">
							<strong><?=trans('job_type')?>:</strong> <?= get_job_type_name($job_detail['job_type']); ?>
						</p>
						<p class="address">
							<strong><?=trans('gender')?>:</strong> <?= $job_detail['gender']; ?>
						</p>
						<p class="address">
							<strong><?=trans('salary')?>:</strong> <?= $job_detail['min_salary']; ?><?= $this->general_settings['currency']; ?> - <?= $job_detail['max_salary']; ?><?= $this->general_settings['currency']; ?>  (<?= $job_detail['salary_period']; ?>)
						</p>
						<p class="address">
							<strong><?=trans('education')?>:</strong> <?= get_education_level($job_detail['education']); ?>
						</p>
						<p class="address">
							<strong><?=trans('experience')?>:</strong> <?= $job_detail['experience']; ?> Years
						</p>
						<p class="address">
							<strong><?=trans('location')?>:</strong> <?= get_city_name($job_detail['city']); ?>, <?= get_country_name($job_detail['country']); ?>
						</p>
						<p class="address">
							<strong><?=trans('posted_date')?>:</strong> <?= date('d-m-Y', strtotime($job_detail['created_date'])); ?>
						</p>
						<p class="description">
							<?= $job_detail['description']; ?>
						</p>
						<?php  $skills = explode("," , $job_detail['skills']);?>
						<ul class="tags">
							<?php foreach($skills as $skill): ?>
							<li>
								<a href="#"><?= $skill; ?></a>
							</li>
							<?php endforeach; ?>
						</ul>
						<span class="inline-block float-right" id="share"></span> 
					</div>
				</div>	
				<div id="apply-block">
					<div class="collapse" id="collapseExample">
						<div class="card card-body">
							<h4 class="card-title"><?=trans('apply_for_job')?></h4>
						    <?php $attributes = array('id' => 'job-form', 'method' => 'post');
		        			echo form_open(base_url('jobs/apply_job'),$attributes);
		        			?>	
						      	<div class="form-group">
							       <textarea name="cover_letter" class="form-control" rows="5" placeholder="<?=trans('msg_sect_employer')?>"></textarea>
							    </div> 

							    <!-- Hidden Inputs -->
							    <input type="hidden" name="username" value="<?= $user_detail['firstname']; ?>">
							    <input type="hidden" name="email" value="<?= $user_detail['email']; ?>" >
							    <input type="hidden" name="job_id" value="<?= $job_detail['id']; ?>" >
							    <input type="hidden" name="emp_id" value="<?= $job_detail['employer_id']; ?>" >
							    <input type="hidden" name="job_title" value="<?= $job_detail['title']; ?>" >
							    <!-- current url for redirect to same job detail page  -->
							    <input type="hidden" name="job_actual_link" value="<?= $job_actual_link ?>" >
								
								<?php
								    $last_request_page = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
								    $this->session->set_userdata('last_request_page', $last_request_page); 
								 ?>

								<?php if($this->session->userdata('is_user_login') == true): ?>
								    <button type="submit" name="submit" value="submit" class="btn btn-primary btn-block"><?=trans('send_application')?></button>

								<?php elseif($this->session->userdata('is_employer_login') == true): ?>
								    <a href="<?= base_url('auth/login'); ?>" class="btn btn-primary btn-block"><?=trans('login_jobseeker')?></a>
								<?php else: ?>
								    <a href="<?= base_url('auth/login'); ?>" class="btn btn-primary btn-block"><?=trans('login_jobseeker')?></a>
								<?php endif; ?>    

							<?php echo form_close(); ?>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-4 sidebar">
				<div class="single-slidebar">
		            <h4><?=trans('label_jobs_by_loc')?></h4>
		            <ul class="cat-list">
		              <?php foreach($cities_job as $city):?>
		               <li><a class="justify-content-between d-flex" href="<?= base_url('jobs/location/'.get_city_slug($city['city_id'])); ?>"><p><?= get_city_name($city['city_id']); ?></p><span><?= $city['total_jobs']; ?></span></a></li>
		             <?php endforeach; ?>
		           </ul>
		         </div>													
			</div>
		</div>
	</div>	
</section>
<!-- End post Area -->

<script>
    $(document).ready(function (){
        $("#btn-apply").click(function (){
            $('html, body').animate({
                scrollTop: $("#apply-block").offset().top-90
            }, 1000);
        });
    });
</script>

<script src="<?= base_url() ?>assets/plugins/jssocials/jssocials.min.js"></script>
<script>
    $("#share").jsSocials({
     showLabel: false,
     showCount: false,
     shares: ["email","twitter", "facebook", "googleplus", "linkedin", "pinterest"]
 	});
</script>



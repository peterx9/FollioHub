<!-- start banner Area -->
<section class="banner-area relative" id="home">	
	<div class="overlay overlay-bg"></div>
	<div class="container">
		<div class="row d-flex align-items-center justify-content-center">
			<div class="about-content col-lg-12">
				<h1 class="text-white">
					<?=trans('applicants_listings')?>
				</h1>	
				<p class="text-white link-nav"><a href="<?= base_url(); ?>"><?=trans('label_home')?> </a>  <span class="lnr lnr-arrow-right"></span>  <a href=""> <?=trans('applicants_listings')?></a></p>
			</div>											
		</div>
	</div>
</section>
<!-- End banner Area -->	

<!-- Start post Area -->
<section class="post-area section-gap">
	<div class="container">
		<div class="row justify-content-center d-flex">

			<div class="col-lg-12 post-list">
				<?php if(empty($applicants)): ?>
				    				?>
                  <p class="alert alert-danger"><strong><?=trans('sorry')?>,</strong> <?=trans('no_applicant')?></p>
                <?php endif; ?>
				<?php foreach($applicants as $applicant): ?>
					<div class="single-post justify-content-between d-flex flex-row">
						<div class="thumb">
							<img src="<?= base_url(); ?>assets/img/user.png" height=60 alt="">
						</div>
						<div class="details">
							<div class="title d-flex flex-row justify-content-between">
								<div class="titles">
									<a><h4 class="text-capitalize"><?= $applicant['firstname']; ?> <?= $applicant['lastname']; ?> ( <?= $applicant['job_title']; ?>)</h4></a>				
								</div>
							</div>
							<div class="job-listing-footer">
								<ul>
									<li><i class="lnr lnr-map-marker"></i> <?= get_city_name($applicant['city']); ?>, <?= get_country_name($applicant['country']); ?></li>
									<li><i class="lnr lnr-apartment"></i> <?= get_category_name($applicant['category']); ?></li>
									<li><i class="fa fa-google-plus"></i> <?= $applicant['email']; ?></li>
								</ul>									
							</div>
						</div>
						<div class="job-listing-btns">
							<div class="dropdown">
								<button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<?=trans('more')?>
								</button>
								<?php $resume = ($applicant['resume'] != '')? base_url($applicant['resume']): '#'  ?>
								<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
								    <a class="dropdown-item" href="<?= $resume; ?>"><?=trans('preview_cv')?></a>
								    <a class="dropdown-item" href="<?= $resume; ?>"><?=trans('download_cv')?></a>
								    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#emailModal" data-whatever="<?= $applicant['email']; ?>"><?=trans('email_candidate')?></a>
								    <div class="dropdown-divider"></div>
								    <a class="dropdown-item" href="<?= base_url('employers/applicants/make_shortlist/'.$applicant['id'].'/'.$applicant['job_id']); ?>"><?=trans('shortlist')?></a>
								</div>
							</div>
						</div>
					</div>
					<?php endforeach; ?>
					<div class="pull-right">
				        <?php echo $this->pagination->create_links(); ?>
				    </div>
				</div>
			</div>
		</div>
	</section>
					
	<!-- End applicants Area -->	

<div class="modal fade" id="emailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><?=trans('new_message')?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php echo form_open("/",'class="email-form"') ?>
          <input type="hidden" name="email" class="form-control" id="email">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label"><?=trans('subject')?>:</label>
            <input type="text" name="subject" class="form-control" id="subject">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label"><?=trans('message')?>:</label>
            <textarea name="message" class="form-control" id="message"></textarea>
          </div>
          <div class="form-group">
          	<button type="button" class="btn btn-secondary" data-dismiss="modal"><?=trans('close')?></button>
        	<input type="submit" class="btn btn-primary send_email" name="submit" value="<?=trans('send_message')?>">
          </div>
        <?php form_close(); ?>
      </div>
     
    </div>
  </div>
</div>

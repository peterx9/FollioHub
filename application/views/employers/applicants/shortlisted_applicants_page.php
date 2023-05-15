<!-- start banner Area -->
<section class="banner-area relative" id="home">	
	<div class="overlay overlay-bg"></div>
	<div class="container">
		<div class="row d-flex align-items-center justify-content-center">
			<div class="about-content col-lg-12">
				<h1 class="text-white">
					<?= $title; ?>
				</h1>	
				<p class="text-white link-nav"><a href="index.html"><?=trans('label_home')?> </a>  <span class="lnr lnr-arrow-right"></span>  <a href=""> <?= $title; ?> </a></p>
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
        <?php $this->load->view($emp_sidebar); ?>
      </div>
      <div class="col-lg-8 post-list">
        <div class="profile_job_content col-lg-12">
         <div class="headline">
          <div class="row">
           <div class="col-md-8 col-sm-8">
            <h3><?= $title; ?></h3>
          </div>
      </div>	
    </div>
    <div class="profile_job_detail">
      <div class="row">
        <?php if(empty($applicants)): ?>
          <p class="text-gray"><strong><?=trans('sorry')?>,</strong> <?=trans('no_shortlisted')?></p>
        <?php endif; ?>
        <?php foreach($applicants as $applicant): ?>
         <div class="col-md-6 col-sm-12 mb-20">
          <div class="onjob-employer-resumes-wrap">
            <figure class="pp">
              <figcaption>
                <h2 class="title"><a href="#"><?= $applicant['firstname']; ?> <?= $applicant['lastname']; ?></a> <a href="<?= base_url($applicant['resume']); ?>" class="onjob-resumes-download"><i class="lnr lnr-download"></i> <?=trans('download_cv')?></a></h2>
                <span class="onjob-resumes-subtitle"><?= $applicant['job_title']; ?></span>
                <ul>
                  <li>
                    <span><?=trans('location')?>:</span>
                    <?= get_city_name($applicant['city']); ?>, <?= get_country_name($applicant['country']); ?>
                  </li>
                  <li>
                    <span><?=trans('cur_salary')?>:</span>
                    <?= $this->general_settings['currency']; ?> <?= $applicant['current_salary']; ?>/<small><?=trans('pa_minimum')?></small>
                  </li>
                </ul>
              </figcaption>
            </figure>
            <ul class="onjob-resumes-options">
              <li><a href="javascript:void(0)" class="get_shortlisted_user_profile" data-user="<?= $applicant['seeker_id']; ?>"><i class="lnr lnr-user"></i> <?=trans('user_profile')?></a></li>
              <li><a href="#" data-toggle="modal" data-target="#emailModal" data-whatever="<?= $applicant['email']; ?>"><i class="lnr lnr-envelope"></i> <?=trans('interview')?></a></li>
            </ul>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
    <div class="row">
       <div class="col-12">
          <div class="pull-right"><?php echo $this->pagination->create_links(); ?></div>
      </div>
    </div>
  </div>
</div>													

</div>

</div>
</div>	
</section>
<!-- End post Area -->


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
          <label for="message-text" class="col-form-label"><?=trans('Message')?>:</label>
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

<!-- candidate profile -->
<div class="modal fade" id="profileModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered p-80-width" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><?=trans('user_profile')?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body shortlisted-profile-modal-body">
      </div>
     
   </div>
 </div>
</div>
<div class="single-slidebar">
	<figure class="mb-4">
		<a href="javascript:avoid(0)" class="employer-dashboard-thumb">
        <?php 
          $profile_picture = get_employer_profile($this->session->userdata('employer_id'));
          $profile_picture = ($profile_picture) ? $profile_picture :  'assets/img/user.png';
        ?>
	      <img class="profile-picture" src="<?= base_url($profile_picture); ?>" alt="">
	      <input type="file" name="profile_picture" class="hidden" accept="image/jpg,image/jpeg,image/png">
	    </a>
		<figcaption>
			<h2><?= $this->session->userdata('username'); ?></h2>
		</figcaption>
	</figure>
	<ul class="cat-list">
		<li>
			<a class="justify-content-between d-flex text_active" href="<?= base_url('employers/dashboard'); ?>"><p><i class="fa fa-dashboard pr-2"></i> <?=trans('label_dashboard')?></p></a>
		</li>
		<li>
			<a class="justify-content-between d-flex text_active" href="<?= base_url('employers/profile'); ?>"><p><i class="fa fa-user-o pr-2"></i> <?=trans('personal_info')?></p></a>
		</li>
		<li>
			<a class="justify-content-between d-flex" href="<?= base_url('employers/company'); ?>"><p><i class="fa fa-user-o pr-2"></i>  <?=trans('company_profile')?></p></a>
		</li>
		<li>
			<a class="justify-content-between d-flex" href="<?= base_url('employers/job/post'); ?>"><p><i class="fa fa-plus pr-2"></i>  <?=trans('post_new_job')?></p></a>
		</li>
		<li>
			<a class="justify-content-between d-flex" href="<?= base_url('employers/job/listing'); ?>"><p><i class="fa fa-list pr-2"></i>  <?=trans('label_manage_jobs')?></p></a>
		</li>
		<li>
			<a class="justify-content-between d-flex" href="<?= base_url('employers/cv/shortlisted') ?>"><p><i class="fa fa-briefcase pr-2"></i>  <?=trans('shortlisted_resumes')?></p></a>
		</li>
		<li>
			<a class="justify-content-between d-flex" href="<?= base_url('employers/account/change_password'); ?>"><p><i class="fa fa-lock pr-2"></i> <?=trans('label_change_pass')?></p></a>
		</li>
		<li>
			<a class="justify-content-between d-flex" href="<?= base_url('employers/auth/logout'); ?>"><p><i class="fa fa-sign-out pr-2"></i> <?=trans('label_logout')?></p></a>
		</li>
	</ul>
</div>	
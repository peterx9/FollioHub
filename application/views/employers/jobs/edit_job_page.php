<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/plugins/texteditor/lib/css/prettify.css"></link>
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/plugins/texteditor/src/bootstrap-wysihtml5.css"></link>

<!-- start banner Area -->
<section class="banner-area relative" id="home">	
	<div class="overlay overlay-bg"></div>
	<div class="container">
		<div class="row d-flex align-items-center justify-content-center">
			<div class="about-content col-lg-12">
				<h1 class="text-white">
					<?=trans('update_job')?>
				</h1>	
				<p class="text-white link-nav"><a href="<?= base_url(); ?>"><?=trans('label_home')?> </a>  <span class="lnr lnr-arrow-right"></span>  <a href=""> <?=trans('update_job')?></a></p>
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
				<div class="row">
					<div class="col-12">
						<?php 
							if($this->session->flashdata('edit_job_error')){
				                echo '<div class="alert alert-danger">' . $this->session->flashdata('edit_job_error') . '</div>';
				        	}
						?>
					</div>

					<?php $attributes = array('id' => 'edit_job', 'method' => 'post');
        			echo form_open('employers/job/edit/'.$job_detail['id'],$attributes);
        			?>

					<div class="add_job_content col-lg-12">
						<div class="headline">
							<h3><i class="fa fa-folder-o"></i> <?=trans('update_job')?></h3>
						</div>
						<div class="add_job_detail">
							<div class="row">
								<div class="col-12">
									<div class="submit-field">
										<h5><?=trans('job_title')?> *</h5>
										<input type="text" name="job_title" value="<?= $job_detail['title']; ?>" class="form-control">
									</div>
								</div>
								<div class="col-md-6 col-sm-12">
									<div class="submit-field">
										<h5><?=trans('job_type')?> *</h5>
										<?php 
											$types = get_job_type_list();
											$options = array('' => 'Select Job Type') + array_column($types, 'type','id');
											echo form_dropdown('job_type',$options,$job_detail['job_type'],'class="form-control" required');
										?>
									</div>
								</div>
								<div class="col-md-6 col-sm-12">
									<div class="submit-field">
										<h5><?=trans('job_cat')?> *</h5>
										<select class="form-control" name="category">
										   <option><?=trans('select_category')?></option>
										   <?php foreach($categories as $category):?>
										   		<?php if($job_detail['category'] == $category['id']): ?>
													<option value="<?= $category['id']; ?>" selected> <?= $category['name']; ?> </option>
												<?php else: ?>
													<option value="<?= $category['id']; ?>"> <?= $category['name']; ?> </option>
											<?php endif; endforeach; ?>
										</select>
									</div>
								</div>
								<div class="col-md-6 col-sm-12">
									<div class="submit-field">
										<h5><?=trans('job_industry')?> *</h5>
										<select class="form-control" name="industry">
										   <option><?=trans('select_industry')?></option>
										   <?php foreach($industries as $industry):?>
										   		<?php if($job_detail['industry'] == $industry['id']): ?>
													<option value="<?= $industry['id']; ?>" selected> <?= $industry['name']; ?> </option>
												<?php else: ?>
													<option value="<?= $industry['id']; ?>"> <?= $industry['name']; ?> </option>
											<?php endif; endforeach; ?>
										</select>
									</div>
								</div>
								<div class="col-md-6 col-sm-12">
									<div class="submit-field"> 
										<h5><?=trans('position_available')?>  *</h5>
										<select name="total_positions" class="form-control">	
									  	    <?php for($i=1; $i<30; $i++): ?>
									   			<?php if($job_detail['total_positions'] == $i): ?>
									   			<option value="<?= $i; ?>" selected><?= $i; ?></option>
									   			<?php else: ?>
									   			<option value="<?= $i; ?>" ><?= $i; ?></option>	
										    <?php endif; endfor; ?>
										</select>
									</div>
								</div>

								<div class="col-md-12 col-sm-12">
									<div class="submit-field">
										<h5><?=trans('working_experience')?> *</h5>
										<?php 
											$exp = explode('-', $job_detail['experience']);
											$min = $exp[0];
											$max = $exp[1];
										?>
										<div class="row">
											<div class="col-md-6">
												<div class="input-group">
													<?php 
														$options = get_experience_list('Minimum');
														echo form_dropdown('min_experience',$options,$min,'class="form-control"');
													?>
												</div>
											</div>
											<div class="col-md-6">
												<div class="input-group">
													<?php 
														$options = get_experience_list('Maximum');
														echo form_dropdown('max_experience',$options,$max,'class="form-control"');
													?>
												</div>
											</div>
										</div>
									</div>
								</div>

								<div class="col-md-6 col-sm-12">
									<div class="submit-field">
										<h5><?=trans('salary')?> (<?= $this->general_settings['currency']; ?>) *</h5>
										<div class="row">
											<div class="col-md-6">
												<div class="input-group">
													<input type="number" name="min_salary" class="form-control" placeholder="<?=trans('minimum')?>" value="<?= $job_detail['min_salary'] ?>">
												</div>
											</div>
											<div class="col-md-6">
												<div class="input-group">
													<input type="number" name="max_salary" class="form-control" placeholder="<?=trans('maximum')?>" value="<?= $job_detail['max_salary'] ?>">
												</div>
											</div>
										</div>
									</div>
								</div>

								<div class="col-md-6 col-sm-12">
									<div class="submit-field">
										<h5><?=trans('salary_period')?>*</h5>
										<select name="salary_period" class="form-control">
											<option value="Hourly" <?= ($job_detail['salary_period'] == 'Hourly') ? 'selected' : '' ?> ><?=trans('hourly')?></option>
											<option value="Weekly" <?= ($job_detail['salary_period'] == 'Weekly') ? 'selected' : '' ?> ><?=trans('weekly')?></option>
											<option value="Monthly" <?= ($job_detail['salary_period'] == 'Monthly') ? 'selected' : '' ?> ><?=trans('monthly')?></option>
										</select>
									</div>
								</div>

								<div class="col-12">
									<div class="submit-field">
										<h5> <?=trans('skills')?> *</h5>
										<input type="text" name="skills" value="<?= $job_detail['skills']; ?>" class="form-control" placeholder="<?=trans('skills_placeholder')?>">
									</div>
								</div>
								<div class="col-md-12 col-sm-12">
									<div class="submit-field">
										<h5><?=trans('job_description')?> *</h5>
										<textarea name="description" class="textarea form-control" id="exampleFormControlTextarea1" rows="5"><?= $job_detail['description']; ?></textarea>
									</div>
								</div>
								
								<div class="col-md-6 col-sm-12">
									<div class="submit-field"> 
										<h5><?=trans('gender_requirement')?> *</h5>
										<select name="gender" class="form-control">	
									   		<option value="Male" <?php if($job_detail['gender'] == 'Male'){ echo "selected";} ?> ><?=trans('male')?></option>
									   		<option value="Female" <?php if($job_detail['gender'] == 'Female'){ echo "selected";} ?> ><?=trans('female')?></option>
									   		<option value="No Preference" <?php if($job_detail['gender'] == 'No Preference'){ echo "selected";} ?> ><?=trans('no_preference')?></option>
										</select>
									</div>
								</div>
								<div class="col-md-6 col-sm-12">
									<div class="submit-field">
										<h5><?=trans('emp_type')?> *</h5>
										<?php
											$types = get_employment_type_list();
											$options = array('' => 'Select Employement Type') + array_column($types, 'type','id');
											echo form_dropdown('employment_type',$options,$job_detail['employment_type'],'class="form-control"');
										?>
									</div>
								</div>
								<div class="col-md-6 col-sm-12">
									<div class="submit-field">
										<h5><?=trans('education')?> *</h5>
										<select class="form-control" name="education">
											<option value=""><?=trans('select_education')?></option>
											<?php foreach($educations as $education):?>
									   			<?php if($job_detail['education'] == $education['id']): ?>
												<option value="<?= $education['id']; ?>" selected> <?= $education['type']; ?> </option>
												<?php else: ?>
													<option value="<?= $education['id']; ?>"> <?= $education['type']; ?> </option>
											<?php endif; endforeach; ?>
										</select>
									</div>
								</div>
								
								<div class="col-md-6 col-sm-12">
									<div class="submit-field">
										<h5><?=trans('country')?> *</h5>
										<select class="country form-control" name="country">
										   <option><?=trans('select_country')?></option>
										    <?php foreach($countries as $country):?>
										   		<?php if($job_detail['country'] == $country['id']): ?>
													<option value="<?= $country['id']; ?>" selected> <?= $country['name']; ?> </option>
												<?php else: ?>
													<option value="<?= $country['id']; ?>"> <?= $country['name']; ?> </option>
											<?php endif; endforeach; ?>
										</select>
									</div>
								</div>
								<div class="col-md-6 col-sm-12">
									<div class="submit-field">
										<h5><?=trans('state')?> *</h5>
										<?php 
					                        $states = get_country_states($job_detail['country']);
					                        $options = array('' => trans('select_state'))+array_column($states, 'name','id');
					                        echo form_dropdown('state',$options,$job_detail['state'],'class="form-control state" required');
					                      ?>
									</div>
								</div>
								<div class="col-md-6 col-sm-12">
									<div class="submit-field">
										<h5><?=trans('city')?> *</h5>
										<?php 
				                        $cities = get_state_cities($job_detail['state']);
				                        $options = array('' => trans('select_city'))+array_column($cities, 'name','id');
				                        echo form_dropdown('city',$options,$job_detail['city'],'class="form-control city" required');
				                        ?>
									</div>
								</div>
								<div class="col-12">
									<div class="submit-field">
										<h5><?=trans('location')?> *</h5>
										<input type="text" name="location" value="<?= $job_detail['location']; ?>" class="form-control" placeholder="<?=trans('type_address')?>">
									</div>
								</div>
								<div class="col-12">
									<div class="submit-field">
										<h5> <?=trans('expiry_date')?> *</h5>
										<input type="date" name="expiry_date" value="<?= $job_detail['expiry_date']; ?>" class="form-control" placeholder="">
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="add_job_btn col-lg-12 mt-3">
						<div class="submit-field">
							<input type="submit" class="job_detail_btn" name="edit_job" value="<?=trans('update')?>">
						</div>
					</div>
					<?php echo form_close(); ?>
				</div>													
			</div>

		</div>
	</div>	
</section>
<!-- End post Area -->	



<script src="<?= base_url(); ?>assets/plugins/texteditor/lib/js/wysihtml5-0.3.0.js"></script>
<script src="<?= base_url(); ?>assets/plugins/texteditor/lib/js/prettify.js"></script>
<script src="<?= base_url(); ?>assets/plugins/texteditor/src/bootstrap-wysihtml5.js"></script>

<script>
	$('.textarea').wysihtml5();
</script>
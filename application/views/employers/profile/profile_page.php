	<!-- start banner Area -->
	<section class="banner-area relative" id="home">	
		<div class="overlay overlay-bg"></div>
		<div class="container">
			<div class="row d-flex align-items-center justify-content-center">
				<div class="about-content col-lg-12">
					<h1 class="text-white">
						<?=trans('company_profile')?>
					</h1>	
					<p class="text-white link-nav"><a href="index.html"><?=trans('label_home')?> </a>  <span class="lnr lnr-arrow-right"></span>  <a href=""> <?=trans('company_profile')?></a></p>
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
					<?php
				        if ($this->session->flashdata('update_success')) {
				                echo '<div class="alert alert-success">' . $this->session->flashdata('update_success') . '</div>';
				            }
				        if($this->session->flashdata('error_update')){
				                echo '<div class="alert alert-danger col-md-8">' . $this->session->flashdata('error_update') . '</div>';
				          }
				    ?>
					 <?php $attributes = array('id' => 'update_employers_form', 'method' => 'post' , 'class' => 'form_horizontal'); ?>
    				<?php echo form_open_multipart('employers/profile',$attributes);?>

					<div class="profile_job_content col-lg-12">
						<div class="headline">
							<h3> <?=trans('personal_info')?></h3>
						</div>
						<div class="profile_job_detail">
							<div class="row">
								<div class="col-12">
				                  <div class="submit-field">
				                    <h5><?=trans('profile_picture')?></h5>
				                    <input type="file" name="profile_picture" class="form-control" >
				                    <input type="hidden" name="old_profile_picture" value="<?= $emp_info['profile_picture']  ?>">
				                  </div>
				                </div>
								<div class="col-md-6 col-sm-12">
				                    <div class="submit-field">
				                      <h5><?=trans('first_name')?> *</h5>
				                      <input class="form-control" type="text" name="firstname" value="<?= $emp_info['firstname']; ?>" placeholder="John Wick">
				                    </div>
				                  </div>
				                  <div class="col-md-6 col-sm-12">
				                    <div class="submit-field">
				                      <h5><?=trans('last_name')?> *</h5>
				                      <input class="form-control" type="text" name="lastname" value="<?= $emp_info['lastname']; ?>" placeholder="John Wick">
				                    </div>
				                  </div>
				                  <div class="col-md-6 col-sm-12">
				                    <div class="submit-field">
				                      <h5><?=trans('email')?> *</h5>
				                      <input class="form-control" type="email" name="email" value="<?= $emp_info['email']; ?>" placeholder="example@example.com">
				                    </div>
				                  </div>
				                  <div class="col-md-6 col-sm-12">
				                    <div class="submit-field">
				                      <h5><?=trans('designation')?> *</h5>
				                      <input class="form-control" type="text" name="designation" value="<?= $emp_info['designation']; ?>" placeholder="CEO">
				                    </div>
				                  </div>
				                  <div class="col-md-6 col-sm-12">
				                    <div class="submit-field">
				                      <h5><?=trans('phone_number')?> *</h5>
				                      <input class="form-control" type="tel" name="mobile_no" value="<?= $emp_info['mobile_no']; ?>" placeholder="11 333 444">
				                    </div>
				                  </div>
				                  <div class="col-md-6 col-sm-12">
									<div class="submit-field">
										<h5><?=trans('country')?> *</h5>
										<select name="country" class="country form-control">
					                        <option><?=trans('select_country')?></option>
					                         <?php foreach($countries as $country):?>
					                            <?php if($emp_info['country'] == $country['id']): ?>
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
					                        $states = get_country_states($emp_info['country']);
					                        $options = array('' => 'Select State')+array_column($states, 'name','id');
					                        echo form_dropdown('state',$options,$emp_info['state'],'class="form-control state" required');
					                      ?>
									</div>
								</div>
								<div class="col-md-6 col-sm-12">
									<div class="submit-field">
										<h5><?=trans('city')?> *</h5>
										<?php 
				                        $cities = get_state_cities($emp_info['state']);
				                        $options = array('' => 'Select City')+array_column($cities, 'name','id');
				                        echo form_dropdown('city',$options,$emp_info['city'],'class="form-control city" required');
				                        ?>
									</div>
								</div>
								<div class="col-md-12 col-sm-12">
				                    <div class="submit-field">
				                      <h5><?=trans('address')?> *</h5>
				                      <input class="form-control" type="text" name="address" value="<?= $emp_info['address']; ?>" placeholder="">
				                    </div>
				                  </div>
							</div>
						</div>
					</div>
					<div class="add_job_btn col-lg-12 mt-3">
						<div class="submit-field">
							<input type="submit" class="job_detail_btn" name="update" value="<?=trans('update')?>">
						</div>
					</div>		
					<?php echo form_close(); ?>													
				</div>
			</div>
		</div>	
	</section>
	<!-- End post Area -->
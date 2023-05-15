<!-- start banner Area -->
<section class="banner-area relative" id="home">	
	<div class="overlay overlay-bg"></div>
	<div class="container">
		<div class="row d-flex align-items-center justify-content-center">
			<div class="about-content col-lg-12">
				<h1 class="text-white">
					<?=trans('cv_search')?>
				</h1>	
				<p class="text-white link-nav"><a href=""><?=trans('label_home')?>Home </a>  <span class="lnr lnr-arrow-right"></span>  <a href=""><?=trans('cv_search')?> </a></p>
			</div>											
		</div>
	</div>
</section>
<!-- End banner Area -->

<!-- Start post Area -->
<section class="post-area section-gap">
	<div class="container">
		<div class="row d-flex">
			<div class="col-lg-12">
				<div class="search-bar">
					<?php $attributes = array('id' => 'search_job', 'method' => 'post');
             		 echo form_open('employers/cv/search',$attributes);?>
	                <div class="row justify-content-center form-wrap no-gutters">
	                  <div class="col-lg-4 form-cols">
	                    <input type="text" class="form-control" name="job_title" value="<?php if(isset($search_value['title'])) echo str_replace('-', ' ', $search_value['title']); ?>" placeholder="<?=trans('search_place_holder')?>">
	                  </div>
	                  <div class="col-lg-4 form-cols">
	                      <select name="category" class="form-control">
	                        <option value=""><?=trans('select_category')?></option>
	                        <?php foreach($categories as $category):?>
	                          <?php if($search_value['category'] == $category['id']): ?>
	                            <option value="<?= $category['id']; ?>" selected> <?= $category['name']; ?> </option>
	                          <?php else: ?>
	                            <option value="<?= $category['id']; ?>"> <?= $category['name']; ?> </option>
	                        <?php endif; endforeach; ?>
	                      </select>
	                  </div>
	                  <div class="col-lg-4 form-cols">
	                      <select name="country" class="form-control">
	                        <option value=""><?=trans('select_location')?></option>
	                        <?php foreach($countries as $country):?>
	                          <?php if($search_value['country'] == $country['id']): ?>
	                            <option value="<?= $country['id']; ?>" selected> <?= $country['name']; ?> </option>
	                          <?php else: ?>
	                            <option value="<?= $country['id']; ?>"> <?= $country['name']; ?> </option>
	                        <?php endif; endforeach; ?>
	                      </select>
	                  </div>
	                </div>
					<div class="row form-wrap no-gutters">
						<div class="col-lg-4">
							<div class="submit-field">
								<select name="expected_salary" class="form-control">
									<option value=""><?=trans('expected_salary')?></option>
									<?php for($i=500; $i<10000; $i=$i+500){ ?>
											<option value="<?= $i; ?>"> <?= $i; ?> </option>
									<?php } ?>
								</select>
							</div>
						</div>

						<div class="col-lg-4">
							<div class="submit-field">
								<?php
								$educations = get_education_list();
								$options = array('' => 'Select Education') + array_column($educations,'type','id');
								echo form_dropdown('education_level',$options,'','class="form-control"');
								?>
							</div>
						</div>

						<div class="col-lg-4">
							<div class="submit-field">
								<select name="experience" class="form-control">
									<option value="">Select Experience</option>
									<option value="0-1">0-1 <?=trans('years')?></option>
									<option value="1-2">1-2 <?=trans('years')?></option>
									<option value="2-5">2-5 <?=trans('years')?></option>
									<option value="5-10">5-10 <?=trans('years')?></option>
									<option value="10-15">10-15 <?=trans('years')?></option>
									<option value="15+">15+ <?=trans('years')?></option>
								</select>
							</div>
						</div>
					</div>
					<div class="row justify-content-center">
						<div class="col-1">
							<input type="submit" name="search" class="btn btn-info btn-lg" value="<?=trans('btn_search_text')?>">
						</div>
					</div>
	              <?php echo form_close(); ?>
	            </div> 
			</div>
			<!-- End search sidebar -->
			<div class="col-12 post-list">
				<?php if(empty($profiles)): ?>
		          <p class="alert alert-danger"><strong><?=trans('sorry')?>,</strong> <?=trans('profile_not_found')?></p>
		        <?php endif; ?>
				<?php foreach($profiles as $row): ?>
				<div class="single-post d-flex flex-row">
					<div class="thumb">
						<img src="<?= base_url()?>assets/img/user.png" height=100 alt="">
						<?php  $skills = explode("," , $row['skills']);?>
						<ul class="tags">
							<?php foreach($skills as $skill): ?>
							<li>
								<a href="#"><?= $skill; ?></a>
							</li>
							<?php endforeach; ?>
						</ul>
					</div>
					<div class="details col-lg-7">
						<div class="title d-flex flex-row justify-content-between">
							<div class="titles">
								<a href="#"><h4><?= $row['firstname'].' '.$row['lastname']; ?></h4></a>
								<h6><?= $row['job_title']; ?></h6>					
							</div>
						</div>
						<p class=""><?=trans('location')?>: <?= get_city_name($row['city']).','. get_country_name($row['country']); ?></p>
						<p class=""><?=trans('education')?>: <?= get_education_level($row['education_level']); ?></p>
						<p class=""><?=trans('experience')?>: <?= $row['experience']; ?> Years</p>
						<p class=""><?=trans('nationality')?>: <?= get_country_name($row['nationality']); ?></p>
						<p class=""><?=trans('cur_salary')?>: <?= $this->general_settings['currency']; ?> <?= $row['current_salary']; ?></p>
						<p class=""><?=trans('expected_salary')?>: <?= $this->general_settings['currency']; ?> <?= $row['expected_salary']; ?></p>
						<p class=""><?=trans('category')?>: <?= get_category_name($row['category']); ?></p>
						<p class="address">
							<?= $row['description']; ?>
						</p>
					</div>
					<div class="options col-lg-3">
						<ul class="btns">
							<li><a href="<?= base_url('employers/cv/make_shortlist/'.$row['id']); ?>"><?=trans('shortlist')?></a></li><br/>
							<?php if(!empty($row['resume'])) :?>
							<li><a href="<?= base_url().$row['resume']; ?>"><?=trans('download_resume')?></a></li>
							<?php endif; ?>
						</ul>
					</div>
				</div>			
				<?php endforeach; ?>									
			</div>
			<div class="col-12">
          		<div class="pull-right"><?php echo $this->pagination->create_links(); ?></div>
			</div>
		</div>
	</div>	
</section>
<!-- End post Area -->


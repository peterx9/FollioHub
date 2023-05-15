<!-- start banner Area -->
<section class="banner-area relative" id="home">	
	<div class="overlay overlay-bg"></div>
	<div class="container">
		<div class="row d-flex align-items-center justify-content-center">
			<div class="about-content col-lg-12">
				<h1 class="text-white">
					<?=trans('search_results')?>
				</h1>	
				<p class="text-white link-nav"><a href=""><?=trans('label_home')?> </a>  <span class="lnr lnr-arrow-right"></span>  <a href=""><?=trans('search_results')?></a></p>
			</div>											
		</div>
	</div>
</section>
<!-- End banner Area -->

<!-- Start post Area -->
<section class="post-area section-gap">
	<div class="container">
		<div class="row justify-content-center d-flex">
			<div class="col-lg-12">
				<div class="search-bar">
					<?php $attributes = array('id' => 'search_job', 'method' => 'post');
             		 echo form_open('jobs/search',$attributes);?>
	                <div class="row justify-content-center form-wrap no-gutters">
	                  <div class="col-lg-6 form-cols">
	                    <input type="text" class="form-control" name="job_title" value="<?php if(isset($search_value['title'])) echo str_replace('-', ' ', $search_value['title']); ?>" placeholder="<?=trans('what_looking')?>">
	                  </div>
	                  <div class="col-lg-4 form-cols">
	                      <select name="country" class="form-control">
	                        <option value=""><?=trans('select_location');?></option>
	                        <?php foreach($countries as $country):?>
	                          <?php if($search_value['country'] == $country['id']): ?>
	                            <option value="<?= $country['id']; ?>" selected> <?= $country['name']; ?> </option>
	                          <?php else: ?>
	                            <option value="<?= $country['id']; ?>"> <?= $country['name']; ?> </option>
	                        <?php endif; endforeach; ?>
	                      </select>
	                  </div>
	                  <div class="col-lg-2 form-cols">
	                      <input type="submit" name="search" class="btn btn-info" value="<?=trans('btn_search_text')?>">
	                  </div>                
	                </div>
	              <?php echo form_close(); ?>
	            </div> 
			</div>

			<div class="col-lg-4 order-2 sidebar search">

				<?php $attributes = array('id' => 'post_job', 'method' => 'post');
        			echo form_open('jobs/search',$attributes);?>

				<div class="single-slidebar">
					<h4><?=trans('category')?></h4>
					<ul class="cat-list">
						<?php $category_id = (isset($search_value['category']))? $search_value['category']: '';  ?>
						<?php foreach($categories as $category): ?>
							<?php if($category_id == $category['id']): ?>
							<li>
								<p><input type="checkbox" name="category" value="<?= $category['id']?>" checked="" > <?= $category['name']?></p>
							</li>
							<?php else: ?>
	                        <li>
								<p><input type="checkbox" name="category" value="<?= $category['id']?>" > <?= $category['name']?></p>
							</li>
	                    <?php endif; endforeach; ?>
					</ul>
				</div>

				<div class="single-slidebar">
					<h4><?=trans('experience')?></h4>
					<ul class="cat-list">
						<?php $experience = (isset($search_value['experience']))? $search_value['experience']: ''; 
						?>
						<li>
							<p><input type="checkbox" name="experience" value="0-1" <?= ($experience == '0-1')? 'checked' : '' ?> > 0-1 Year </p>
						</li>
						
						<li>
							<p><input type="checkbox" name="experience" value="1-2" <?= ($experience == '1-2') ? 'checked' : '' ?>> 1-2 Years</p>
						</li>
						<li>
							<p><input type="checkbox" name="experience" value="2-5" <?= ($experience == '2-5') ? 'checked' : '' ?> > 2-5 Years</p>
						</li>
						<li>
							<p><input type="checkbox" name="experience" value="5-10" <?= ($experience == '5-10') ? 'checked' : '' ?> > 5-10 Years</p>
						</li>
						<li>
							<p><input type="checkbox" name="experience" value="10-15" <?= ($experience == '10-15') ? 'checked' : '' ?> > 10-15 Years</p>
						</li>
						<li>
							<p><input type="checkbox" name="experience" value="15+" <?= ($experience == '15+') ? 'checked' : '' ?> > 15+ Years</p>
						</li>
					</ul>
				</div>		

				<div class="single-slidebar">
					<h4><?=trans('job_type')?></h4>
					<?php 
						$job_type = (isset($search_value['job_type']))? $search_value['job_type']: '';
						$types = get_job_type_list();  
					?>
					<ul class="cat-list">
						<?php foreach ($types as $type): ?>
						<li><p><input type="checkbox" name="job_type" value="<?= $type['id'] ?>" <?= ($job_type == $type['id']) ? 'checked' : '' ?> > <?= $type['type'] ?></p></li>
						<?php endforeach; ?>
					</ul>
				</div>				

				<div class="single-slidebar">
					<h4><?=trans('emp_type')?></h4>
					<?php 
						$employment_type = (isset($search_value['employment_type']))? $search_value['employment_type']: '';  
						$emp_type = get_employment_type_list();
					?>
					<ul class="cat-list">
						<?php foreach ($emp_type as $type): ?>
						<li><p><input type="checkbox" name="employment_type" value="<?= $type['id'] ?>" <?= ($employment_type == $type['id']) ? 'checked' : '' ?> > <?= $type['type'] ?></p></li>
						<?php endforeach; ?>
					</ul>
				</div>		
				<div class="single-slidebar btn-search">	
					<input type="submit" name="search" class="btn btn-info btn-block" value="<?=trans('btn_search_text');?>">
				</div>				
				<?php echo form_close(); ?>
			</div> 
			<!-- End search sidebar -->

			<div class="col-lg-8 order-md-2  post-list">
				<div class="col-lg-12">
					<?php if(empty($jobs)): ?>
						<div class="alert alert-danger"><strong><?=trans('sorry')?>,</strong> <?=trans('sorry_text')?></div>
					<?php endif; ?>
				</div>
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
					<div class="job-listing-btns">
						<ul class="btns">
							 <li><a class="saved_job" data-job_id="<?= $job['id']; ?>"><span class="lnr lnr-heart"></span></a></li>
							<li><a href="<?= site_url('jobs/'.$job['id'].'/'.($job['job_slug'])); ?>"><?=trans('apply');?></a></li>
						</ul>
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
<!-- End post Area -->


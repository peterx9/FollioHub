  <!-- start banner Area -->
  <section class="banner-area relative" id="home">  
    <div class="overlay overlay-bg"></div>
    <div class="container">
      <div class="row fullscreen d-flex align-items-center justify-content-center">
        <div class="banner-content col-lg-12">
          <h1 class="text-white">
            <?=trans('over')?> <span>10,000+</span> <?=trans('jobs_waiting')?>
          </h1> 
          <?php $attributes = array('id' => 'search_job', 'method' => 'post');
          echo form_open('jobs/search',$attributes);?>
          <div class="row justify-content-center form-wrap no-gutters">
            <div class="col-lg-6 form-cols">
              <input type="text" class="form-control" name="job_title" placeholder="<?=trans('search_place_holder')?>">
            </div>
            <div class="col-lg-4 form-cols">
              <select name="country" class="form-control">
                <option value=""><?=trans('select_location')?></option>
                <?php foreach($countries as $country):?>
                  <option value="<?= $country['id']?>"><?= $country['name']?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="col-lg-2 form-cols">
              <input type="submit" name="search" class="btn btn-info" value="<?=trans('btn_search_text')?>">
            </div>                
          </div>
          <?php echo form_close(); ?>
        </div>                      
      </div>
    </div>
  </section>
  <!-- End banner Area -->  

  <!-- Start feature-cat Area -->
  <section class="feature-cat-area section-full" id="category">
    <div class="container">
      <div class="row d-flex justify-content-center">
        <div class="menu-content pb-60 col-lg-10">
          <div class="title text-center">
            <h1 class="mb-10"><?=trans('feature_job_cats')?></h1>
            <p><?=trans('feature_cat_subtitle')?></p>
          </div>
        </div>
      </div>            
      <div class="row">
        <div class="col-lg-2 col-md-4 col-sm-6">
          <div class="single-fcat">
            <a href="<?= base_url('jobs/category/accounting'); ?>">
              <img src="<?= base_url(''); ?>assets/img/o1.png" alt="">
              <p><?=trans('feature_accounting')?></p>
            </a>
          </div>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-6">
          <div class="single-fcat">
            <a href="<?= base_url('jobs/category/construction'); ?>">
              <img src="<?= base_url(); ?>assets/img/o2.png" alt="">
              <p><?=trans('feature_construction')?></p>
            </a>
          </div>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-6">
          <div class="single-fcat">
            <a href="<?= base_url('jobs/category/information-technology'); ?>">
              <img src="<?= base_url(); ?>assets/img/o3.png" alt="">
              <p><?=trans('feature_tech')?></p>
            </a>
          </div>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-6">
          <div class="single-fcat">
            <a href="<?= base_url('jobs/category/sales'); ?>">
              <img src="<?= base_url(); ?>assets/img/o4.png" alt="">
              <p><?=trans('feature_sales')?></p>
            </a>
          </div>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-6">
          <div class="single-fcat">
            <a href="<?= base_url('jobs/category/medical-healthcare'); ?>">
              <img src="<?= base_url(); ?>assets/img/o5.png" alt="">
              <p><?=trans('feature_medical')?></p>
            </a>
          </div>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-6">
          <div class="single-fcat">
            <a href="<?= base_url('jobs/category/engineering'); ?>">
              <img src="<?= base_url(); ?>assets/img/o6.png" alt="">
              <p><?=trans('feature_engineering')?></p>
            </a>
          </div>      
        </div>                                                      
      </div>
    </div>  
  </section>
  <!-- End feature-cat Area -->

  <!-- Start post Area -->
  <section class="post-area section-full bg-gray">
    <div class="container">
      <div class="row d-flex justify-content-center">
        <div class="menu-content pb-60 col-lg-10">
          <div class="title text-center">
            <h1 class="mb-10"><?=trans('jobs_avail')?></h1>
            <p><?=trans('jobs_avail_subtitle')?></p>
          </div>
        </div>
      </div>
      <div class="row justify-content-center d-flex">
        <div class="col-lg-8 post-list">
          <?php foreach($jobs as $job): ?>
            <div class="single-post d-flex flex-row">
              <div class="thumb">
                <img src="<?= base_url(); ?>assets/img/job_icon.png" alt="">
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
                    <li><i class="lnr lnr-apartment"></i> <?= get_industry_name($job['industry']); ?></li>
                    <li><i class="lnr lnr-clock"></i> <?= time_ago($job['created_date']); ?></li>
                  </ul>                 
                </div>
              </div>
              <div class="job-listing-btns">
                <ul class="btns">
                  <li><a class="saved_job" data-job_id="<?= $job['id']; ?>"><span class="lnr lnr-heart"></span></a></li>
                  <li><a href="<?= site_url('jobs/'.$job['id'].'/'.($job['job_slug'])); ?>"><?=trans('apply')?></a></li>
                </ul>
              </div>
            </div>
          <?php endforeach; ?>

        </div>

        <div class="col-lg-4 sidebar">
          <div class="single-slidebar">
            <h4><?=trans('jobs_by_cities')?></h4>
            <ul class="cat-list">
              <?php foreach($cities_job as $city):?>
               <li><a class="justify-content-between d-flex" href="<?= base_url('jobs/location/'.get_city_slug($city['name'])); ?>"><p><?= get_city_name($city['name']); ?></p><span><?= $city['total_jobs']; ?></span></a></li>
             <?php endforeach; ?>
           </ul>
          </div>

          <div class="single-slidebar">
            <h4><?=trans('top_rated_job_posts')?></h4>
            <div class="active-relatedjob-carusel">
              <?php foreach($jobs as $job): ?>
                <div class="single-rated">
                  <img class="img-fluid" src="<?= base_url(); ?>assets/img/r1.jpg" alt="">
                  <a href="<?= site_url('jobs/'.$job['id'].'/'.($job['job_slug'])); ?>"><h4><?= text_limit($job['title'], 35); ?></h4></a>
                  <h6><?= get_company_name($job['company_id']); ?></h6>
                  <p>
                    <?= text_limit($job['description'], 100); ?>
                  </p>
                    <p class="address"><span class="lnr lnr-apartment"></span> <?= get_industry_name($job['industry']); ?></h5>
                    <p class="address"><span class="lnr lnr-map-marker"></span>  <?= get_city_name($job['city']); ?>, <?= get_country_name($job['country']); ?></p>
                    <p class="address"><span class="lnr lnr-clock"></span> <?= time_ago($job['created_date']); ?></p>
                    <a href="<?= site_url('jobs/'.$job['id'].'/'.($job['job_slug'])); ?>" class="btns text-uppercase"><?=trans('apply_job')?></a>
                  </div>
                <?php endforeach; ?>                                 
              </div>
            </div>  
          </div>

        </div>
    </div>  
  </section>
  <!-- End post Area -->

 
      </div>
    </div>
  </section>
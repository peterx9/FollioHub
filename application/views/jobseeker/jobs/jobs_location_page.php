<!-- start banner Area -->
<section class="banner-area relative" id="home">  
  <div class="overlay overlay-bg"></div>
  <div class="container">
    <div class="row d-flex align-items-center justify-content-center">
      <div class="about-content col-lg-12">
        <h1 class="text-white">
          <?=trans('label_jobs_by_loc')?>
        </h1> 
        <p class="text-white link-nav"><a href=""><?=trans('label_home')?> </a>  <span class="lnr lnr-arrow-right"></span>  <a href=""><?=trans('label_jobs_by_loc')?></a></p>
      </div>                      
    </div>
  </div>
</section>
<!-- End banner Area -->

<section class="post-area section-gap">
  <div class="container">
    <div class="row">
      <?php foreach($cities as $city): ?>
      <div class="col-md-3">
        <div class="box-item-single text-center">
          <h5 class="title"><a href="<?= base_url('jobs/location/'.get_city_slug($city['city_id'])); ?>"> <?= get_city_name($city['city_id']); ?></a></h5>
          <span class="count"><a href="<?= base_url('jobs/location/'.get_city_slug($city['city_id'])); ?>">(<?= $city['total_jobs']; ?>)</a></span>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
     
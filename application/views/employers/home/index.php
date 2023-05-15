<!-- start banner Area -->
<section class="banner-area relative" id="home">  
  <div class="overlay overlay-bg"></div>
  <div class="container">
    <div class="row d-flex align-items-center justify-content-center">
      <div class="about-content col-lg-12">
        <h1 class="text-white">
          <?=trans('welcome_to')?> <?= $this->general_settings['application_name']; ?>
        </h1> 
      </div>                      
    </div>
  </div>
</section>
<!-- End banner Area -->  

<!-- employers-home-section-starts -->
<section class="employers-home-section">
  <div class="container text-center">
    <div class="row">
     <div class="col-md-12 col-lg-12">
      <h1 class="main-title"><?=trans('hire_quickly')?></h1>
      <h3 class="main-title"><?=trans('access')?> 10,000+ CVs</h3>
    </div> 
  </div>  
</div>
</section>  


<section class="emp-solutions bg-light">
  <div class="container text-center">
    <div class="row">
      <div class="col-md-4">
        <i class="fa fa-bank fa-3x"></i> 
        <h5 class="pt-3"><?=trans('small_business')?></h5>
        <a href="<?= base_url(); ?>employers" class="btn btn-outline-primary mt-3"><?=trans('explore_now')?></a>
      </div>
      <div class="col-md-4"> 
        <i class="fa fa-briefcase fa-3x"></i> 
        <h5 class="pt-3"><?=trans('post_job')?></h5>
        <a href="<?= base_url(); ?>employers/job/post" class="btn btn-outline-primary mt-3" role="button"><?=trans('post_now')?></a>
      </div>
      <div class="col-md-4">
        <i class="fa fa-file-word-o fa-3x"></i>
        <h5 class="pt-3"><?=trans('resume_search')?></h5>
        <a href="<?= base_url(); ?>employers/cv/search" class="btn btn-outline-primary mt-3" role="button"><?=trans('search_now')?></a>
      </div>
    </div>
  </div>
</section>

<!-- employers-home-section-Ends -->



<!-- why-us-section-Starts -->
<section class="emp-why-us">
  <div class="container text-center">
    <div class="row">
      <div class="col-md-12">
        <h1 class="section-title"><?=trans('why')?> <?= $this->general_settings['application_name']; ?>?</h1>
        <div class="line-title"></div>
        <h5 class="pt-3"><?=trans('why_msg')?></h5>
      </div>
    </div>

    <div class="row">
      <div class="col-md-4 mt-5">
        <i class="fa fa-universal-access fa-3x"></i> 
        <h4 class="pt-3"><?=trans('massive_reach')?></h4>
        
      </div>
      <div class="col-md-4 mt-5">
        <i class="fa fa-handshake-o fa-3x"></i> 
        <h4 class="pt-3"><?=trans('easy_n_fast')?></h4>
        
      </div>
      <div class="col-md-4 mt-5">
        <i class="fa fa-snowflake-o fa-3x"></i> 
        <h4 class="pt-3"><?=trans('cost_effect_hiring')?></h4>
       
      </div>
    </div>
  </div>
</section>

<!-- why-us-section-Ends -->


  <!-- start Subscribe Area -->
  <section class="subscribe-area section-half" id="subscribe-area">
    <div class="container">
      <div class="row section_padding">
            <div class="col-12 col-lg-12">
               <!-- message -->
              <?php if ($this->session->flashdata('success_subscriber')): ?>
                <div class="m-b-15">
                    <div class="alert alert-success alert-dismissable">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                        <p>
                            <i class="icon fa fa-check"></i>
                            <?php echo $this->session->flashdata('success_subscriber'); ?>
                        </p>
                    </div>
                </div>
              <?php endif; ?>
    
              <?php if ($this->session->flashdata('error_subscriber')): ?>
                <div class="m-b-15">
                    <div class="alert alert-danger alert-dismissable">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                        <p>
                            <i class="icon fa fa-check"></i>
                            <?php echo $this->session->flashdata('error_subscriber'); ?>
                        </p>
                    </div>
                </div>
              <?php endif; ?>
        </div>    
        <div class="col-lg-6 col-md-6 col-12">
          <p>Join our 10,000+ subscribers and get access to the latest templates, freebies, announcements and resources!</p>
        </div>
        <div class="col-lg-6 col-md-6 col-12">
          <?php echo form_open(base_url('home/add_subscriber'), 'class="form-horizontal jsform"');  ?> 
            <div id="mc_embed_signup">
              <form action="#" method="get" class="form-inline" novalidate="true">
                <div class="form-group row no-gutters">
                  <div class="col-10">
                    <input name="subscriber_email" placeholder="Enter Email" type="email" required>
                  </div> 
                  <div class="col-2">
                    <button class="nw-btn primary-btn fa fa-paper-plane-o"></button>
                  </div> 
                </div>    
              </form>
            </div>
          <?php echo form_close( ); ?>
        </div>
      </div>
    </div>
  </section>
  <!-- End Subscribe Area --> 

<!-- start footer Area -->    

<?php $footer =  get_footer_settings(); ?>

<footer class="footer-area footer-section">
  <div class="container">
    <div class="row">

      <?php  foreach ($footer as $col):   ?>

      <div class="col-lg-<?= $col['grid_column'] ?>  col-md-<?= $col['grid_column'] ?> col-sm-6">
        <div class="single-footer-widget newsletter">
          <h6><?=trans($col['title'])?></h6>
          <?= $col['content'] ?>
        </div>
      </div>

      <?php endforeach; ?>
      
    </div>

    
  </div>
</footer>
<!-- End Footer Area -->

<!-- start Copyright Area -->
<div class="copyright1">
  <div class="container">
    <div class="row"> 
      <div class="col-md-6 col-8">
        <div class="bottom_footer_info">
          <p><?= $this->general_settings['copyright']?></p>
        </div>
      </div>
      <div class="col-md-6 col-4">
        <div class="bottom_footer_logo text-right">
          <ul class="list-inline">
            <li class="list-inline-item"><a target="_blank" href="<?= $this->general_settings['facebook_link']; ?>"><i class="fa fa-facebook"></i></a></li>
            <li class="list-inline-item"><a target="_blank" href="<?= $this->general_settings['twitter_link']; ?>"><i class="fa fa-twitter"></i></a></li>
            <li class="list-inline-item"><a target="_blank" href="<?= $this->general_settings['google_link']; ?>"><i class="fa fa-google"></i></a></li>
            <li class="list-inline-item"><a target="_blank" href="<?= $this->general_settings['linkedin_link']; ?>"><i class="fa fa-linkedin"></i></a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End Copyright Area --> 
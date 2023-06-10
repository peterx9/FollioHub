<!-- start banner Area -->
      <section class="banner-area relative" id="home">  
        <div class="overlay overlay-bg"></div>
        <div class="container">
          <div class="row d-flex align-items-center justify-content-center">
            <div class="about-content col-lg-12">
              <h1 class="text-white">
                 <?= $page['title']; ?>     
              </h1> 
              <p class="text-white"><a href="<?= base_url(); ?>">Home </a>  <span class="lnr lnr-arrow-right"></span>  <a href=""> <?= $page['title']; ?></a></p>
            </div>                      
          </div>
        </div>
      </section>
      <!-- End banner Area -->  

      <!-- Start contact-page Area -->
      <section class="contact-page-area section-gap">
        <div class="container">
          <div class="row">
           <div class="col-lg-12">
            <h2 class="mb-3"> <?= $page['title']; ?></h2>
             <?= $page['content']; ?>
          </div>
        </div>  
      </section>
      <!-- End contact-page Area -->
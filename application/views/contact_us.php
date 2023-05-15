<!-- start banner Area -->
      <section class="banner-area relative" id="home">  
        <div class="overlay overlay-bg"></div>
        <div class="container">
          <div class="row d-flex align-items-center justify-content-center">
            <div class="about-content col-lg-12">
              <h1 class="text-white">
                <?=trans('contact_us')?>
              </h1> 
              <p class="text-white"><a href="<?= base_url(); ?>"><?=trans('label_home')?> </a>  <span class="lnr lnr-arrow-right"></span>  <a href=""> <?=trans('contact_us')?></a></p>
            </div>                      
          </div>
        </div>
      </section>
      <!-- End banner Area -->  

      <!-- Start contact-page Area -->
      <section class="contact-page-area section-gap">
        <div class="container">
          <div class="row">
            <div class="col-lg-4 d-flex flex-column">
              <a class="contact-btns" href="<?= base_url('jobs'); ?>"><?=trans('label_search_job')?></a>
              <a class="contact-btns" href="<?= base_url('employers/job/post'); ?>"><?=trans('post_new_job')?></a>
              <a class="contact-btns" href="<?= base_url('auth/login'); ?>"><?=trans('create_job')?></a>
            </div>
            <div class="col-lg-8">
              <?php if($this->session->flashdata('success')): ?>
                <div class="alert alert-success">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                  <?=$this->session->flashdata('success')?>
                </div>
              <?php  endif; ?>
         
              <?php $attributes = array('id' => '', 'method' => 'post' , 'class' => 'form-area contact-form text-right'); ?>
              <?php echo form_open('contact',$attributes);?>  
                <div class="row"> 
                  <div class="col-lg-12 form-group">
                    <input name="username" placeholder="Enter your name" onfocus="this.placeholder = ''" onblur="this.placeholder = '<?=trans('enter_your_name')?>'" class="common-input mb-20 form-control" required="" type="text">
                  
                    <input name="email" placeholder="Enter email address" pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{1,63}$" onfocus="this.placeholder = ''" onblur="this.placeholder = '<?=trans('enter_email')?>'" class="common-input mb-20 form-control" required="" type="email">

                    <input name="subject" placeholder="Enter your subject" onfocus="this.placeholder = ''" onblur="this.placeholder = '<?=trans('subject')?>'" class="common-input mb-20 form-control" required="" type="text">

                    <textarea class="common-textarea mt-10 form-control" name="message" placeholder="<?=trans('message')?>" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Messege'" required=""></textarea>
                    <input type="submit" name="submit" value="<?=trans('send_message')?>" class="primary-btn mt-20 text-white" style="float: right;" />
                  </div>
                </div>
              </form> 
            </div>
          </div>
        </div>  
      </section>
      <!-- End contact-page Area -->
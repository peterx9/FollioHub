  <div class="container-login100">
    <div class="wrap-login100">
      <span class="login100-form-title pb-4">
          <?=trans('forgot_pass')?>
      </span>
      <p><?=trans('forgot_pass_msg')?></p>
      <?php if($this->session->flashdata('success')): ?>
        <div class="alert alert-success">
          <a href="#" class="close" data-dismiss="alert" aria-label="close" title="<?=trans('close')?>">×</a>
          <?=$this->session->flashdata('success')?>
        </div>
      <?php endif; ?>
      <?php if($this->session->flashdata('error')): ?>
       <div class="alert alert-danger">
        <a href="#" class="close" data-dismiss="alert" aria-label="close" title="<?=trans('close')?>">×</a>
        <?=$this->session->flashdata('error')?>
      </div>
    <?php endif; ?>

      <?php $attributes = array('id' => 'login_form', 'method' => 'post' , 'class' => 'login100-form validate-form');
        echo form_open(base_url('auth/forgot_password'), $attributes);?>

        <div class="wrap-input100  mb-3">
          <input class="input100" type="text" name="email" placeholder="<?=trans('email')?>">
          <span class="focus-input100"></span>
          <span class="symbol-input100">
            <span class="lnr lnr-envelope"></span>
          </span>
        </div>
        <div class="container-login100-form-btn pt-2">
          <input type="submit" class="login100-form-btn" name="submit" value="<?=trans('recover_pass')?>">
        </div>
      <?php echo form_close(); ?>

      <div class="text-center w-full pt-4">
          <span class="txt1">
            <?=trans('you_remember_pass')?>
          </span>
          <a class="txt1 bo1 hov1" href="<?= base_url(); ?>auth/login">
              <?=trans('login')?>
          </a>
      </div>
    </div>
  </div>

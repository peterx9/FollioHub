  <div class="container-login100">
    <div class="wrap-login100">
      <span class="login100-form-title pb-4">
          <?=trans('sign_in')?>
      </span>
      <?php    
        if ($this->session->flashdata('registration_success')) {

          echo  $this->session->flashdata('registration_success');
        }
        if($this->session->flashdata('error_login')){

          echo '<div class="alert alert-danger">' . $this->session->flashdata('error_login') . '</div>';
        }
        if($this->session->flashdata('success')){

          echo '<div class="alert alert-success">' . $this->session->flashdata('success') . '</div>';
        }
      ?> 

      <ul class="nav nav-pills mb-3 justify-content-center" id="pills-tab" role="tablist">
        <li class="nav-item">
          <a class="nav-link <?= ($this->uri->segment(1) != 'employers')? 'active': '' ?>" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true"><?=trans('job_seeker')?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= ($this->uri->segment(1) == 'employers')? 'active': '' ?>" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false"><?=trans('employer')?></a>
        </li>
      </ul>

      <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade <?= ($this->uri->segment(1) != 'employers')? 'show active': '' ?>" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
          <?php $attributes = array('id' => 'login_form', 'method' => 'post' , 'class' => 'login100-form validate-form');
            echo form_open('auth/login',$attributes);?>

            <div class="wrap-input100 mb-3" data-validate = "<?=trans('valid_email')?>: ex@abc.xyz">
              <input class="input100" type="text" name="email" placeholder="<?=trans('email')?>">
              <span class="focus-input100"></span>
              <span class="symbol-input100">
                <span class="lnr lnr-envelope"></span>
              </span>
            </div>

            <div class="wrap-input100 mb-3" data-validate = "<?=trans('password_required')?>">
              <input class="input100" type="password" name="password" placeholder="<?=trans('password')?>">
              <span class="focus-input100"></span>
              <span class="symbol-input100">
                <span class="lnr lnr-lock"></span>
              </span>
            </div>

            <div class="contact100-form-checkbox pt-2 ml-1">
              <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
              <label class="label-checkbox100" for="ckb1">
                <?=trans('remember_me')?>
              </label>
            </div>
            
            <div class="container-login100-form-btn pt-4">
              <input type="submit" class="login100-form-btn" name="login" value="<?=trans('login')?>">
            </div>
          <?php echo form_close(); ?>

          <div class="text-center w-full pt-4">
              <a class="txt1 bo1 hov1" href="<?= base_url(); ?>auth/forgot_password">
                <?=trans('forgot_pass')?>
              </a>
          </div>
          <div class="text-center w-full pt-3">
              <span class="txt1">
                <?=trans('dont_account')?>
              </span>
              <a class="txt1 bo1 hov1" href="<?= base_url(); ?>auth/registration">
                <?=trans('signup_now')?>
              </a>
          </div>
        </div>

        <!-- Employer Login Page -->
        <div class="tab-pane fade <?= ($this->uri->segment(1) == 'employers')? 'show active': '' ?>" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
          <?php $attributes = array('id' => 'login_form', 'method' => 'post' , 'class' => 'login100-form validate-form');
            echo form_open('employers/auth/login',$attributes);?>

            <div class="wrap-input100 mb-3" data-validate = "<?=trans('valid_email')?>: ex@abc.xyz">
              <input class="input100" type="text" name="email" placeholder="<?=trans('email')?>">
              <span class="focus-input100"></span>
              <span class="symbol-input100">
                <span class="lnr lnr-envelope"></span>
              </span>
            </div>

            <div class="wrap-input100 mb-3" data-validate = "<?=trans('password_required')?>">
              <input class="input100" type="password" name="password" placeholder="<?=trans('password')?>">
              <span class="focus-input100"></span>
              <span class="symbol-input100">
                <span class="lnr lnr-lock"></span>
              </span>
            </div>

            <div class="contact100-form-checkbox pt-2 ml-1">
              <input class="input-checkbox100" id="ckb" type="checkbox" name="remember-me">
              <label class="label-checkbox100" for="ckb">
                <?=trans('remember_me')?>
              </label>
            </div>
            
            <div class="container-login100-form-btn pt-4">
              <input type="submit" class="login100-form-btn" name="login" value="<?=trans('login')?>">
            </div>
          <?php echo form_close(); ?>

          <div class="text-center w-full pt-4">
              <a class="txt1 bo1 hov1" href="<?= base_url(); ?>employers/auth/forgot_password">
                <?=trans('forgot_pass')?>
              </a>
          </div>
          <div class="text-center w-full pt-3">
              <span class="txt1">
                <?=trans('dont_account')?>
              </span>
              <a class="txt1 bo1 hov1" href="<?= base_url(); ?>employers/auth/registration">
                <?=trans('signup_now')?>
              </a>
          </div>
        </div>
      </div>

      
    </div>
  </div>




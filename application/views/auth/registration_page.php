  <div class="container-login100">
      <div class="wrap-login100">
        <?php $attributes = array('id' => 'registeration_form', 'method' => 'post',  'class' => 'login100-form validate-form'); ?>

        <?php echo form_open('auth/registration',$attributes); ?>
          <span class="login100-form-title pb-5">
            <?=trans('signup')?>
          </span>
           <?php 
              if($this->session->flashdata('validation_errors')){

                echo '<div class="alert alert-danger">' . $this->session->flashdata('validation_errors') . '</div>';
              }
          ?>
          <div class="wrap-input100 mb-3" data-validate = "<?=trans('valid_name')?>: johnny">
            <input class="input100" type="text" name="firstname" placeholder="<?=trans('first_name')?>">
            <span class="focus-input100"></span>
            <span class="symbol-input100">
              <span class="lnr lnr-user"></span>
            </span>
          </div>

          <div class="wrap-input100 mb-3" data-validate = "<?=trans('valid_name')?>: smith">
            <input class="input100" type="text" name="lastname"  placeholder="<?=trans('last_name')?>">
            <span class="focus-input100"></span>
            <span class="symbol-input100">
              <span class="lnr lnr-user"></span>
            </span>
          </div>

          <div class="wrap-input100 mb-3" data-validate = "<?=trans('valid_email')?>: ex@abc.xyz">
            <input class="input100" type="text" name="email"  placeholder="<?=trans('email')?>">
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

          <div class="wrap-input100 mb-3" data-validate = "<?=trans('password_required')?>">
            <input class="input100" type="password" name="confirmpassword" placeholder="<?=trans('confirm_pass')?>">
            <span class="focus-input100"></span>
            <span class="symbol-input100">
              <span class="lnr lnr-lock"></span>
            </span>
          </div>

          <div class="contact100-form-checkbox pt-2 ml-1">
            <input class="input-checkbox100" id="ckb1" type="checkbox" name="termsncondition">
            <label class="label-checkbox100" for="ckb1">
              <?=trans('terms')?>
            </label>
          </div>

          <?php if($this->recaptcha_status): ?>
              <div class="recaptcha-cnt">
                  <?php generate_recaptcha(); ?>
              </div>
          <?php endif; ?>
          
          <div class="container-login100-form-btn">
            <input type="submit" class="login100-form-btn" name="submit" value="<?=trans('signup')?>">
          </div>
        </form>

        <div class="text-center w-full pt-4">
            <span class="txt1">
              <?=trans('already_member')?>
            </span>

            <a class="txt1 bo1 hov1" href="<?= base_url(); ?>auth/login">
              <?=trans('sign_in_now')?>
            </a>
        </div>
      </div>
    </div>
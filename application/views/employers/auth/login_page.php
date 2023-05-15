  <div class="container-login100">
    <div class="wrap-login100">

      <span class="login100-form-title pb-4">
          Employer Login
      </span>

      <?php    
        if ($this->session->flashdata('registration_success')) {

          echo  $this->session->flashdata('registration_success');
        }
        if($this->session->flashdata('error_login')){

          echo '<div class="alert alert-danger">' . $this->session->flashdata('error_login') . '</div>';
        }
      ?> 

      <?php $attributes = array('id' => 'login_form', 'method' => 'post' , 'class' => 'login100-form validate-form');
        echo form_open('employers/auth/login',$attributes);?>

        <div class="wrap-input100 validate-input mb-3" data-validate = "Valid email is required: ex@abc.xyz">
          <input class="input100" type="text" name="email" placeholder="Email">
          <span class="focus-input100"></span>
          <span class="symbol-input100">
            <span class="lnr lnr-envelope"></span>
          </span>
        </div>

        <div class="wrap-input100 validate-input mb-3" data-validate = "Password is required">
          <input class="input100" type="password" name="password" placeholder="Password">
          <span class="focus-input100"></span>
          <span class="symbol-input100">
            <span class="lnr lnr-lock"></span>
          </span>
        </div>

        <div class="contact100-form-checkbox pt-2 ml-1">
          <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
          <label class="label-checkbox100" for="ckb1">
            Remember me
          </label>
        </div>
        
        <div class="container-login100-form-btn pt-4">
          <input type="submit" class="login100-form-btn" name="login" value="LogIn">
        </div>
      <?php echo form_close(); ?>

      <div class="text-center w-full pt-4">
          <a class="txt1 bo1 hov1" href="<?= base_url(); ?>employers/auth/forgot_password">
            Forgot Password?
          </a>
      </div>
      <div class="text-center w-full pt-3">
          <span class="txt1">
            Don't have an account?
          </span>
          <a class="txt1 bo1 hov1" href="<?= base_url(); ?>employers/auth/registration">
            Sign up now             
          </a>
      </div>
    </div>
  </div>

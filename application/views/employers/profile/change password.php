<section id="change_password">
  <div class="container">
    <div class="row">
	    <div class="col-4"></div>
	    <!----------------             Change Password Section                 ---------------->
      <div class="card mt-3 col-4">
           

      	<?php

  	    	if($this->session->flashdata('error_update_password')){

  	              echo '<div class="alert alert-danger">' . $this->session->flashdata('error_update_password') . '</div>';

  	            }

              if($this->session->flashdata('update_password_failed')){

                echo '<div class="alert alert-danger">' . $this->session->flashdata('update_password_failed') . '</div>';
                
  				}

  			if ($this->session->flashdata('update_password_success')) {

                echo '<div class="alert alert-success">' . $this->session->flashdata('update_password_success') . '</div>';

              }
          ?>

        

        <div>
          <div class="card-body">
            <?php $attributes = array('id' => 'Change_Password_form', 'method' => 'post' , 'class' => 'form_horizontal'); ?>

            <?php echo form_open('employers/profile/change_password',$attributes);?>

              <div class="form-group">
                <label>Old Password</label>
                <input type="Password" class="form-control" name="old_password">
              </div><br>

              <div class="form-group">
                <label>New Password</label>
                <input type="Password" class="form-control" name="new_password">
              </div>

              <div class="form-group">
                <label>Confirm Password</label>
                <input type="Password" class="form-control" name="confirm_password">
              </div>

              <div class="row">
                <div class="col-md-12 mt-4">
                  <input class="btn btn-primary px-5 btn-md" value="Save" type="submit" name="update_password">
                  <button class="btn btn-outline-primary px-5" type="button">Cancel</button>
                </div>
              </div>

            </form>
          </div>
        </div>
      </div>
      <div class="col-4"></div>
      </div>
    </div>
</section>
    <!-- start banner Area -->
    <section class="banner-area relative" id="home">  
      <div class="overlay overlay-bg"></div>
      <div class="container">
        <div class="row d-flex align-items-center justify-content-center">
          <div class="about-content col-lg-12">
            <h1 class="text-white">
              <?=trans('cand_profile')?>
            </h1> 
            <p class="text-white link-nav"><a href="<?= base_url(); ?>"><?=trans('label_home')?> </a>  <span class="lnr lnr-arrow-right"></span>  <a href=""> <?=trans('cand_profile')?></a></p>
          </div>                      
        </div>
      </div>
    </section>
    <!-- End banner Area -->  

    <!-- Start post Area -->
    <section class="post-area section-gap">
      <div class="container">
        <div class="row justify-content-center d-flex">
          <div class="col-lg-4 sidebar">            
            <?php $this->load->view($user_sidebar); ?>
          </div>
          <div class="col-lg-8 post-list">

            <?php if ($this->session->flashdata('file_error')) {
              echo '<div class="alert alert-danger">' . $this->session->flashdata('file_error') . '</div>';
            } ?>

            <?php if ($this->session->flashdata('error_update')) {
              echo '<div class="alert alert-danger">' . $this->session->flashdata('error_update') . '</div>';
            } ?>

            <?php if ($this->session->flashdata('update_success')) {
              echo '<div class="alert alert-success">' . $this->session->flashdata('update_success') . '</div>';
            } ?>

            <?php $attributes = array('id' => 'update_user_form', 'method' => 'post' , 'class' => 'form_horizontal'); ?>

            <?php echo form_open_multipart('profile',$attributes);?>
            <div class="profile_job_content col-lg-12">
              <div class="headline">
                <h3><?=trans('personal_info')?></h3>
              </div>
              <div class="profile_job_detail">
                <div class="row">
                  <div class="col-12">
                    <div class="submit-field">
                      <h5><?=trans('profile_picture')?></h5>
                      <input type="file" name="profile_picture" class="form-control" >
                      <input type="hidden" name="old_profile_picture" value="<?= $user_info['profile_picture']  ?>">
                    </div>
                  </div>
                  <div class="col-md-6 col-sm-12">
                    <div class="submit-field">
                      <h5><?=trans('first_name')?> *</h5>
                      <input class="form-control" type="text" name="firstname" value="<?= $user_info['firstname']  ?>" placeholder="John Wick">
                    </div>
                  </div>
                  <div class="col-md-6 col-sm-12">
                    <div class="submit-field">
                      <h5><?=trans('last_name')?> *</h5>
                      <input class="form-control" type="text" name="lastname" value="<?= $user_info['lastname']  ?>" placeholder="John Wick">
                    </div>
                  </div>
                  <div class="col-md-6 col-sm-12">
                    <div class="submit-field">
                      <h5><?=trans('email')?> *</h5>
                      <input class="form-control" type="email" name="email" value="<?= $user_info['email']  ?>" placeholder="example@example.com">
                    </div>
                  </div>
                  <div class="col-md-6 col-sm-12">
                    <div class="submit-field">
                      <h5><?=trans('phone')?> *</h5>
                      <input class="form-control" type="tel" name="mobile_no" value="<?= $user_info['mobile_no']  ?>" placeholder="444 5555 66666">
                    </div>
                  </div>
                  <div class="col-md-6 col-sm-12">
                    <div class="submit-field">
                      <h5><?=trans('dob')?>:</h5>
                      <input class="form-control" type="date" name="dob" value="<?= $user_info['dob']  ?>">
                    </div>
                  </div>

                  <div class="col-md-6 col-sm-12">
                    <div class="submit-field">
                      <h5><?=trans('age')?> *</h5>
                      <select name="age" class="form-control">
                        <?php for($i=11; $i<80; $i++): ?>
                          <?php if($user_info['age'] == $i): ?>
                          <option selected><?= $i; ?></option>
                          <?php else: ?>
                          <option><?= $i; ?></option>
                        <?php endif; endfor; ?>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-6 col-sm-12">
                    <div class="submit-field">
                      <h5><?=trans('category')?> *</h5>
                      <select class="form-control" name="category">
                        <option value="">Select Category</option>
                        <?php foreach($categories as $category):?>
                            <?php if($user_info['category'] == $category['id']): ?>
                            <option value="<?= $category['id']; ?>" selected> <?= $category['name']; ?> </option>
                          <?php else: ?>
                            <option value="<?= $category['id']; ?>"> <?= $category['name']; ?> </option>
                        <?php endif; endforeach; ?>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-6 col-sm-12">
                    <div class="submit-field">
                      <h5><?=trans('your_title')?> *</h5>
                      <input class="form-control" type="text" name="job_title" value="<?= $user_info['job_title']; ?>" placeholder="web developer & designer">
                    </div>
                  </div>

                  <div class="col-md-6 col-sm-12">
                    <div class="submit-field">
                      <h5><?=trans('experience')?> *</h5>
                      <select name="experience" class="form-control">
                        <option value="0-1" <?php if($user_info['experience'] == '0-1'){ echo "selected";} ?>>0-1 <?=trans('years')?></option>
                        <option value="1-2" <?php if($user_info['experience'] == '1-2'){ echo "selected";} ?>>1-2 <?=trans('years')?></option>
                        <option value="2-5" <?php if($user_info['experience'] == '2-5'){ echo "selected";} ?>>2-5 <?=trans('years')?></option>
                        <option value="5-10" <?php if($user_info['experience'] == '5-10'){ echo "selected";} ?>>5-10 <?=trans('years')?></option>
                        <option value="10-15" <?php if($user_info['experience'] == '10-15'){ echo "selected";} ?>>10-15 <?=trans('years')?></option>
                         <option value="15+" <?php if($user_info['experience'] == '15+'){ echo "selected";} ?>>15+ <?=trans('years')?></option>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-6 col-sm-12">
                    <div class="submit-field">
                      <h5><?=trans('skills')?> *</h5>
                      <input type="tel" name="skills" value="<?= $user_info['skills']  ?>" class="form-control" placeholder="eg, html, css, php, javascript">
                    </div>
                  </div>

                  <div class="col-md-6 col-sm-12">
                    <div class="submit-field">
                      <h5><?=trans('cur_salary')?>(<?= $this->general_settings['currency']; ?>) *</h5>
                      <select name="current_salary" class="form-control">
                        <option><?=trans('select_salary')?></option>
                        <?php for($i=500; $i<10000; $i=$i+500): ?>
                          <?php if($user_info['current_salary'] == $i): ?>
                          <option value="<?= $i; ?>" selected> <?= $i; ?> </option>
                        <?php else: ?>
                            <option value="<?= $i; ?>"> <?= $i; ?> </option>
                        <?php endif; endfor; ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6 col-sm-12">
                    <div class="submit-field">
                      <h5><?=trans('expected_salary')?>(<?= $this->general_settings['currency']; ?>) *</h5>
                      <select name="expected_salary" class="form-control">
                        <option><?=trans('select_salary')?></option>
                        <?php for($i=500; $i<10000; $i=$i+500): ?>
                            <?php if($user_info['expected_salary'] == $i): ?>
                          <option value="<?= $i; ?>" selected> <?= $i; ?> </option>
                        <?php else: ?>
                            <option value="<?= $i; ?>"> <?= $i; ?> </option>
                        <?php endif; endfor; ?>
                      </select>
                    </div>
                  </div>
                  
                  <div class="col-md-6 col-sm-12">
                    <div class="submit-field">
                      <h5><?=trans('nationality')?> *</h5>
                      <select name="nationality" class="form-control">
                        <option><?=trans('select_nationality')?></option>
                         <?php foreach($countries as $country):?>
                            <?php if($user_info['nationality'] == $country['id']): ?>
                              <option value="<?= $country['id']; ?>" selected> <?= $country['name']; ?> </option>
                            <?php else: ?>
                              <option value="<?= $country['id']; ?>"> <?= $country['name']; ?> </option>
                          <?php endif; endforeach; ?>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-6 col-sm-12">
                    <div class="submit-field">
                      <h5><?=trans('country')?> *</h5>
                      <select name="country" class="country form-control">
                        <option><?=trans('select_country')?></option>
                         <?php foreach($countries as $country):?>
                            <?php if($user_info['country'] == $country['id']): ?>
                              <option value="<?= $country['id']; ?>" selected> <?= $country['name']; ?> </option>
                            <?php else: ?>
                              <option value="<?= $country['id']; ?>"> <?= $country['name']; ?> </option>
                          <?php endif; endforeach; ?>
                    </select>
                    </div>
                  </div>

                  <div class="col-md-6 col-sm-12">
                    <div class="submit-field">
                    <h5><?=trans('state')?> *</h5>
                    <?php 
                      $states = get_country_states($user_info['country']);
                      $options = array('' => 'Select State')+array_column($states, 'name','id');
                      echo form_dropdown('state',$options,$user_info['state'],'class="form-control state" required');
                    ?>
                  </div>
                </div>
                <div class="col-md-6 col-sm-12">
                  <div class="submit-field">
                    <h5><?=trans('city')?> *</h5>
                    <?php 
                      $cities = get_state_cities($user_info['state']);
                      $options = array('' => 'Select City')+array_column($cities, 'name','id');
                      echo form_dropdown('city',$options,$user_info['city'],'class="form-control city" required');
                      ?>
                  </div>
                </div>

                  <div class="col-md-12 col-sm-12">
                    <div class="submit-field">
                      <h5><?=trans('full_address')?> *</h5>
                      <input type="text" name="address" value="<?= $user_info['address']  ?>" class="form-control" >
                    </div>
                  </div>

                  <div class="col-md-12 col-sm-12">
                    <div class="submit-field">
                      <input type="submit" class="btn job_detail_btn" name="update" value="<?=trans('update')?>">
                    </div>
                  </div> 

                </div>
              </div>
            </div>
            <?php echo form_close();?> 

            <!-- resume -->
            <?php $attributes = array('id' => 'update_user_resume', 'method' => 'post' , 'class' => 'form_horizontal'); ?> 

             <!-- experience -->
            <div class="profile_job_content col-lg-12 mt-5">
              <div class="headline">
                <h3><?=trans('experience')?> <span class="pull-right action-circle add-experience"><i class="fa fa-plus" data-toggle="collapse" data-target="#user-experience"></i></span></h3>
              </div>
              <div class="profile_job_detail">
                <div class="row">
                  <?php foreach($experiences as $exp): ?>
                  <!-- experience detail -->
                  <div class="col-md-12 col-sm-12">
                    <div class="employer-job-list">
                      <h4><?= $exp['job_title'] ?> at <?= $exp['company'] ?></h4>
                      <p><?= get_nth_month($exp['starting_month']) .' '.$exp['starting_year']?> - <?= (!$exp['currently_working_here']) ? get_nth_month($exp['ending_month']) .' '.$exp['ending_year'] : 'Present ' ?> | <?= get_country_name($exp['country']) ?></p>
                      <p class="overflow-ellipsis"><?= $exp['description'] ?></p>
                      <p>
                      <a href="javascript:void(0)" class="edit-experience" data-exp_id="<?= $exp['id'] ?>"><i class="fa fa-pencil"></i> <?=trans('edit')?></a>&nbsp;
                      <a href="<?= base_url('profile/delete_experience/'.$exp['id']) ?>" class="btn-delete"><i class="fa fa-trash"></i> <?=trans('delete')?></a>&nbsp;
                      </p>
                    </div>
                  </div>
                  <?php endforeach; ?>
                  <!-- education detail -->

                </div>

                <!-- collapse -->
                <div id="user-experience" class="collapse">
                  <?php $attributes = array('method' => 'post'); ?>
                  <?php echo form_open('profile/experience',$attributes);?>

                  <div class="row">

                    <div class="col-md-6">
                      <div class="submit-field">
                        <label><?=trans('job_title')?></label>
                        <input type="text" name="job_title" class="form-control"  required>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="submit-field">
                        <label><?=trans('company')?></label>
                        <input type="text" name="company" class="form-control" required>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="submit-field">
                        <label><?=trans('country')?></label>
                        <?php 
                          $options = array('' => 'Select Option') + array_column($countries,'name','id');
                          echo form_dropdown('country',$options,'','class="form-control country" required');
                        ?>
                      </div>
                    </div>

                    <div class="col-md-3">
                      <div class="submit-field">
                        <label><?=trans('start_month')?></label>
                        <?php 
                          $options = get_months_list();
                          echo form_dropdown('starting_month',$options,'','class="form-control" required');
                        ?>
                      </div>
                    </div>

                    <div class="col-md-3">
                      <div class="submit-field">
                        <label><?=trans('start_year')?></label>
                        <?php 
                          $options = get_years_list();
                          echo form_dropdown('starting_year',$options,'','class="form-control" required');
                        ?>
                      </div>
                    </div>

                    <div class="col-md-3">
                      <div class="submit-field exp-end-field">
                        <label><?=trans('end_month')?></label>
                        <?php 
                          $options = get_months_list();
                          echo form_dropdown('ending_month',$options,'','class="form-control " required');
                        ?>
                      </div>
                    </div>

                    <div class="col-md-3">
                      <div class="submit-field exp-end-field">
                        <label><?=trans('end_year')?></label>
                        <?php 
                          $options = get_years_list();
                          echo form_dropdown('ending_year',$options,'','class="form-control " required');
                        ?>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <label class="mt-5">
                        <input type="checkbox" name="currently_working_here" class="currently_working_here" value="1">
                        <?=trans('currently_working_here')?>
                      </label>
                    </div>

                    <div class="col-md-12 col-sm-12">
                      <div class="submit-field">
                        <h5><?=trans('description')?></h5>
                        <textarea name="description" class="form-control" rows="5"></textarea>
                      </div>
                    </div>

                    <div class="col-md-12">
                      <div class="submit-field">
                      <input type="submit" class="btn job_detail_btn" name="update_experience" value="<?=trans('submit')?>">
                      <button type="button" class="btn job_detail_btn close_all_collapse"><?=trans('cancel')?></button>
                      </div>
                    </div>

                  </div>

                    <?php echo form_close(); ?>   
                </div>
                <!-- /collapse -->

                <!-- Edit collapse -->
                <div id="user-experience-edit" class="collapse"></div>
                <!-- /edit collapse -->

              </div>
            </div>
            <!-- /experience -->

            <!-- education -->
            <div class="profile_job_content col-lg-12 mt-5">
              <div class="headline">
                <h3><?=trans('education')?> <span class="pull-right action-circle add-education"><i class="fa fa-plus" data-toggle="collapse" data-target="#user-education"></i></span></h3>
              </div>
              <div class="profile_job_detail">
                <div class="row">
                  <?php foreach($education as $edu): ?>
                  <!-- education detail -->
                  <div class="col-md-12 col-sm-12">
                    <div class="employer-job-list">
                      <h5><?= get_education_level($edu['degree']).', '.$edu['degree_title'] ?></h5>
                      <p><?= $edu['institution'] ?><br> <?= $edu['completion_year'] ?></p>
                      <p>
                      <a href="javascript:void(0)" class="edit-education" data-edu_id="<?= $edu['id'] ?>"><i class="fa fa-pencil"></i> <?=trans('edit')?></a>&nbsp;
                      <a href="<?= base_url('profile/delete_education/'.$edu['id']) ?>" class="btn-delete"><i class="fa fa-trash"></i> <?=trans('delete')?></a>&nbsp;
                      </p>
                    </div>
                  </div>
                  <?php endforeach; ?>
                  <!-- education detail -->

                </div>

                <!-- collapse -->
                <div id="user-education" class="collapse">
                  <?php $attributes = array('method' => 'post'); ?>
                  <?php echo form_open('profile/add_education',$attributes);?>

                  <div class="row">

                    <div class="col-md-6">
                      <div class="submit-field">
                        <label>Degree Level </label>
                        <?php 
                          $educations = get_education_list();
                          $options = array('' => 'Select Option') + array_column($educations,'type','id');
                          echo form_dropdown('level',$options,'','class="form-control" required');
                        ?>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="submit-field">
                        <label><?=trans('degree_title')?></label>
                        <input type="text" name="title" class="form-control" placeholder="<?=trans('degree_placeholder')?>" required>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="submit-field">
                        <label><?=trans('major_subjects')?></label>
                        <input type="text" name="majors" class="form-control" placeholder="<?=trans('subject_placeholder')?>" required>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="submit-field">
                        <label><?=trans('institution')?></label>
                        <input type="text" name="institution" class="form-control" placeholder="<?=trans('institution')?>" required>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="submit-field">
                        <label><?=trans('country')?></label>
                        <?php 
                          $options = array('' => 'Select Option') + array_column($countries,'name','id');
                          echo form_dropdown('country',$options,'','class="form-control country" required');
                        ?>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="submit-field">
                        <label><?=trans('completion_year')?></label>
                        <?= year_dropdown('year', '1985', ''); ?>
                      </div>
                    </div>

                    <div class="col-md-12">
                      <div class="submit-field">
                      <button type="submit" class="btn job_detail_btn" ><?=trans('submit')?></button>
                      <button type="button" class="btn job_detail_btn close_all_collapse"><?=trans('cancel')?></button>
                      </div>
                    </div>

                  </div>

                    <?php echo form_close(); ?>   
                </div>
                <!-- /collapse -->

                <!-- Edit collapse -->
                <div id="user-education-edit" class="collapse"></div>
                <!-- /edit collapse -->

              </div>
            </div>
            <!-- /education -->

            <!-- languages -->
            <div class="profile_job_content col-lg-12 mt-5">
              <div class="headline">
                <h3><?=trans('languages')?> <span class="pull-right action-circle add-language"><i class="fa fa-plus" data-toggle="collapse" data-target="#user-language"></i></span></h3>
              </div>
              <div class="profile_job_detail">
                <div class="row">
                  <?php foreach($languages as $lang): ?>
                  <!-- education detail -->
                  <div class="col-md-12 col-sm-12">
                    <div class="employer-job-list">
                      <p><?= get_language_name($lang['language']).' ( '.get_lang_proficiency_name($lang['proficiency']).' ) ' ?></p>
                      <p>
                      <a href="javascript:void(0)" class="edit-language" data-lang_id="<?= $lang['id'] ?>"><i class="fa fa-pencil"></i> <?=trans('edit')?></a>&nbsp;
                      <a href="<?= base_url('profile/delete_language/'.$lang['id']) ?>" class="btn-delete"><i class="fa fa-trash"></i> <?=trans('delete')?></a>&nbsp;
                      </p>
                    </div>
                  </div>
                  <?php endforeach; ?>
                  <!-- education detail -->

                </div>

                <!-- collapse -->
                <div id="user-language" class="collapse">
                  <?php $attributes = array('method' => 'post'); ?>
                  <?php echo form_open('profile/add_language',$attributes);?>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="submit-field">
                        <label><?=trans('language')?></label>
                        <?php 
                          $educations = get_languages_list();
                          $options = array('' => trans('select_option')) + array_column($educations,'lang_name','lang_id');
                          echo form_dropdown('language',$options,'','class="form-control" required');
                        ?>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="submit-field">
                        <label><?=trans('lang_prof')?></label>
                        <?php 
                          $options = get_language_levels();
                          echo form_dropdown('lang_level',$options,'','class="form-control" required');
                        ?>
                      </div>
                    </div>

                    
                    <div class="col-md-12">
                      <div class="submit-field">
                      <button type="submit" class="btn job_detail_btn" ><?=trans('submit')?></button>
                      <button type="button" class="btn job_detail_btn close_all_collapse"><?=trans('cancel')?></button>
                      </div>
                    </div>

                  </div>

                    <?php echo form_close(); ?>   
                </div>
                <!-- /collapse -->

                <!-- Edit collapse -->
                <div id="user-language-edit" class="collapse"></div>
                <!-- /edit collapse -->

              </div>
            </div>
            <!-- /languages -->

            <?php echo form_open_multipart('profile/resume',$attributes);?>
            <div class="profile_job_content col-lg-12 mt-5">
              <div class="headline">
                <h3><?=trans('resume_cv')?></h3>
              </div>
              <div class="profile_job_detail">
                <div class="row">
            
                  <div class="col-md-6 col-sm-12">
                    <div class="submit-field">
                        <h5><?=trans('resume')?> * <small>(<?=trans('resume_size_msg')?>)</small></h5>

                        <input type="file" name="userfile" value="" class="onjob-upload">

                        <input type="hidden" name="old_resume" value="<?= $user_info['resume']; ?>" >

                        <?php if($user_info['resume']): ?>    
                          <a class="btn btn-outline" href="<?= base_url().$user_info['resume']; ?>"><i class="lnr lnr-download"></i> <small><?=trans('resume_down_msg')?></small></a>
                        <?php endif; ?>
                    </div>
                  </div>

                  <div class="col-md-12 col-sm-12">
                    <div class="submit-field">
                      <input type="submit" class="btn job_detail_btn" name="update_resume" value="<?=trans('update')?>">
                    </div>
                  </div>
                </div>
              </div>
            </div>
           <?php echo form_close();?>
                                
         </div>
       </div>
     </div>  
   </section>
   <!-- End post Area -->    
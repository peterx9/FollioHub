<h5><?=trans('update_education')?></h5>

<?php $attributes = array('method' => 'post'); ?>
<?php echo form_open('profile/update_education',$attributes);?>

<div class="row">
  <input type="hidden" name="edu_id" value="<?= $edu['id'] ?>">
  <div class="col-md-6">
    <div class="submit-field">
      <label><?=trans('degree_level')?> </label>
      <?php 
        $educations = get_education_list();
        $options = array('' => 'Select Option') + array_column($educations,'type','id');
        echo form_dropdown('level',$options,$edu['degree'],'class="form-control" required');
      ?>
    </div>
  </div>

  <div class="col-md-6">
    <div class="submit-field">
      <label><?=trans('degree_title')?></label>
      <input type="text" name="title" class="form-control" placeholder="<?=trans('degree_placeholder')?>" value="<?= $edu['degree_title'] ?>" required>
    </div>
  </div>

  <div class="col-md-6">
    <div class="submit-field">
      <label><?=trans('major_subjects')?></label>
      <input type="text" name="majors" class="form-control" placeholder="<?=trans('subject_placeholder')?>" value="<?= $edu['major_subjects'] ?>" required>
    </div>
  </div>

  <div class="col-md-6">
    <div class="submit-field">
      <label><?=trans('institution')?></label>
      <input type="text" name="institution" class="form-control" placeholder="<?=trans('institution')?>" value="<?= $edu['institution'] ?>" required>
    </div>
  </div>

  <div class="col-md-6">
    <div class="submit-field">
      <label><?=trans('country')?></label>
      <?php 
        $countries = get_country_list();
        $options = array('' => 'Select Option') + array_column($countries,'name','id');
        echo form_dropdown('country',$options,$edu['country'],'class="form-control country" required');
      ?>
    </div>
  </div>

  <div class="col-md-6">
    <div class="submit-field">
      <label><?=trans('completion_year')?></label>
        <?= year_dropdown('year', '1985', $edu['completion_year']); ?>
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

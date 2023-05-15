<?php $attributes = array('method' => 'post'); ?>
  <?php echo form_open('profile/experience',$attributes);?>

  <div class="row">
    <input type="hidden" name="exp_id" value="<?= $exp['id'] ?>">
    <div class="col-md-6">
      <div class="submit-field">
        <label><?=trans('job_title')?></label>
        <input type="text" name="job_title" class="form-control" value="<?= $exp['job_title'] ?>"  required>
      </div>
    </div>

    <div class="col-md-6">
      <div class="submit-field">
        <label><?=trans('company')?></label>
        <input type="text" name="company" class="form-control" value="<?= $exp['company'] ?>" required>
      </div>
    </div>

    <div class="col-md-6">
      <div class="submit-field">
        <label><?=trans('location')?></label>
        <?php 
          $countries = get_country_list();
          $options = array('' => 'Select Option') + array_column($countries,'name','id');
          echo form_dropdown('country',$options, $exp['country'],'class="form-control country" required');
        ?>
      </div>
    </div>

    <div class="col-md-3">
      <div class="submit-field">
        <label><?=trans('start_month')?></label>
        <?php 
          $options = get_months_list();
          echo form_dropdown('starting_month',$options,$exp['starting_month'],'class="form-control" required');
        ?>
      </div>
    </div>

    <div class="col-md-3">
      <div class="submit-field">
        <label><?=trans('start_year')?></label>
        <?php 
          $options = get_years_list();
          echo form_dropdown('starting_year',$options,$exp['starting_year'],'class="form-control" required');
        ?>
      </div>
    </div>

    <div class="col-md-3">
      <div class="submit-field exp-end-field <?= ($exp['currently_working_here']) ? 'hidden' : '' ?>">
        <label><?=trans('end_month')?></label>
        <?php 
          $options = get_months_list();
          echo form_dropdown('ending_month',$options,$exp['ending_month'],'class="form-control " required');
        ?>
      </div>
    </div>

    <div class="col-md-3">
      <div class="submit-field exp-end-field <?= ($exp['currently_working_here']) ? 'hidden' : '' ?>">
        <label><?=trans('end_year')?></label>
        <?php 
          $options = get_years_list();
          echo form_dropdown('ending_year',$options,$exp['ending_year'],'class="form-control " required');
        ?>
      </div>
    </div>

    <div class="col-md-12">
      <label>
        <input type="checkbox" name="currently_working_here" class="currently_working_here" value="1" <?= ($exp['currently_working_here']) ? 'checked' : '' ?>>
        <?=trans('currently_working_here')?>
      </label>
    </div>

    <div class="col-md-12 col-sm-12">
      <div class="submit-field">
        <h5><?=trans('description')?></h5>
        <textarea name="description" class="form-control" rows="5"><?= $exp['description'] ?></textarea>
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
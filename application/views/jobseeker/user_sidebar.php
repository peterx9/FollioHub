 <div class="single-slidebar">
  <figure class="mb-5">
    <a href="javascript:avoid(0)" class="employer-dashboard-thumb">
      <?php 
          $profile_picture = get_user_profile($this->session->userdata('user_id'));
          $profile_picture = ($profile_picture) ? $profile_picture :  'assets/img/user.png';
        ?>
      <img class="profile-picture" src="<?= base_url($profile_picture); ?>" alt="">
      <input type="file" name="profile_picture" class="hidden" accept="image/jpg,image/jpeg,image/png">
    </a>
    <figcaption>
      <h2><?= $this->session->userdata('username'); ?></h2>
    </figcaption>
  </figure>
  <ul class="cat-list">
    <li>
      <a class="text_active" href="<?= base_url('profile'); ?>"><p><i class="fa fa-user-o pr-2"></i> <?=trans('label_my_profile')?></p></a>
    </li>
    <li>
      <a class="" href="<?= base_url('myjobs'); ?>"><p><i class="fa fa-file-word-o pr-2"></i> <?=trans('label_my_apps')?></p></a>
    </li>
    <li>
      <a class="" href="<?= base_url('myjobs/matching'); ?>"><p><i class="fa fa-briefcase pr-2"></i> <?=trans('label_matching_jobs')?></p></a>
    </li>
    <li>
      <a class="" href="<?= base_url('myjobs/saved'); ?>"><p><i class="fa fa-heart-o pr-2"></i> <?=trans('label_saved_jobs')?></p></a>
    </li>
    <li>
      <a class="" href="<?= base_url('account/change_password'); ?>"><p><i class="fa fa-lock pr-2"></i> <?=trans('label_change_pass')?></p></a>
    </li>
    <li>
      <a class="" href="<?= base_url('auth/logout')?>"><p><i class="fa fa-sign-out pr-2"></i> <?=trans('label_logout')?></p></a>
    </li>
  </ul>
</div> 
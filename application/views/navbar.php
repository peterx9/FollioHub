 <!-- header start -->
<header id="header">
  <div class="container">
    <div class="row align-items-center d-flex">
      <div class="col-2">
        <div id="logo">
          <a href="<?= ($this->session->userdata('is_employer_login'))? base_url('employers') : base_url(); ?>"><img src="<?= base_url($this->general_settings['logo']); ?>" alt="" title="" /></a>
        </div>
      </div>
      <div class="col-10">
        <nav id="nav-menu-container">
          <ul class="nav-menu">
            <?php if ($this->session->userdata('is_user_login')): ?>
              <li class="menu-has-children"><a href=""><?=trans('label_jobs')?></a>
                <ul>
                  <li><a href="<?= base_url('jobs'); ?>"><?=trans('label_search_job')?></a></li>
                  <li><a href="<?= base_url('jobs-by-category'); ?>"><?=trans('label_jobs_by_cat')?></a></li>
                  <li><a href="<?= base_url('jobs-by-industry'); ?>"><?=trans('label_jobs_by_industry')?></a></li>
                  <li><a href="<?= base_url('jobs-by-location'); ?>"><?=trans('label_jobs_by_loc')?></a></li>
                  <li><a href="<?= base_url('jobs'); ?>"><?=trans('label_browse_jobs')?></a></li>
                </ul>
              </li>



              <li><a href="<?= base_url('employers') ?>"><?=trans('label_for_employers')?></a>
              </li>   
                <?php 
                  $profile_picture = get_user_profile($this->session->userdata('user_id'));
                  $profile_picture = ($profile_picture) ? $profile_picture :  'assets/img/user.png';
                ?>
              <li class="menu-has-children margin-left-400"><img src="<?= base_url($profile_picture)?>" alt="user_img" height=35 /><a href="#"> <?= $this->session->userdata('username'); ?> </a>
                <ul>
                  <li><a href="<?= base_url('profile'); ?>"><?=trans('label_my_profile')?></a></li>
                  <li><a href="<?= base_url('myjobs'); ?>"><?=trans('label_my_apps')?></a></li>
                  <li><a href="<?= base_url('myjobs/matching'); ?>"><?=trans('label_matching_jobs')?></a></li>
                  <li><a href="<?= base_url('myjobs/saved'); ?>"><?=trans('label_saved_jobs')?></a></li>
                  <li><a href="<?= base_url('account/change_password'); ?>"><?=trans('label_change_pass')?></a></li>
                  <li><a href="<?= base_url('auth/logout')?>"><?=trans('label_logout')?></a></li>
                </ul>
              </li>
              <li class="menu-has-children"><a href="">Lan</a>
                <ul>
                  <?php $languages = get_site_languages(); ?>
                  <?php foreach ($languages as $lang): ?>
                    <li><a href="<?= base_url('home/site_lang/'.$lang['directory_name']); ?>"><?= $lang['display_name']; ?></a></li>
                  <?php endforeach; ?>
                                  </ul>
              </li>
            <?php elseif ($this->session->userdata('is_employer_login')): ?> 
            <li><a href="<?= base_url('employers/dashboard') ?>"> <?=trans('label_dashboard')?></a>
            <li><a href="<?= base_url('employers/job/listing') ?>"> <?=trans('label_manage_jobs')?></a>
            <li><a href="<?= base_url('employers/cv/search') ?>"> <?=trans('label_find_cand')?></a>
            </li>
            <?php 
              $profile_picture = get_employer_profile($this->session->userdata('employer_id'));
              $profile_picture = ($profile_picture) ? $profile_picture :  'assets/img/user.png';
            ?>
            <li class="menu-has-children margin-left-400"><img src="<?= base_url($profile_picture)?>" alt="user_img"  height=35 /><a href="#"> <?= $this->session->userdata('username'); ?> </a>
                <ul>
                  <li><a href="<?= base_url('employers/profile') ?>"><?=trans('label_dashboard')?></a></li>
                  <li><a href="<?= base_url('employers/job/listing') ?>"><?=trans('label_manage_jobs')?></a></li>
                  <li><a href="<?= base_url('employers/account/change_password'); ?>"><?=trans('label_change_pass')?></a></li>
                <li><a href="<?= base_url('employers/auth/logout')?>"><?=trans('label_logout')?></a></li>
                </ul>
            </li>
            <li class="menu-has-children"><a href="">Lan</a>
              <ul>
                <li><a href="<?= base_url('home/site_lang/english'); ?>">English</a></li>
                <li><a href="<?= base_url('home/site_lang/french'); ?>">French</a></li>
              </ul>
            </li>
            <?php elseif ($this->uri->segment(1) == 'employers'): ?>   
              <li class=""><a href="<?= base_url('employers'); ?>"><?=trans('label_home')?></a></li>
              <li class=""><a href="<?= base_url('employers/job/post'); ?>"><?=trans('label_post_job')?></a></li>
               <li><a class="ticker-btn-nav btn_login mt-1" href="<?= base_url('employers/auth/login') ?>"><i class="lnr lnr-user pr-1"></i> Login</a></li>
              <li><a class="nav_btn mt-1" href="<?= base_url() ?>"><i class="lnr lnr-briefcase pr-1"></i><?=trans('label_for_jobseeker')?></a> </li>
              <li class="menu-has-children"><a href="">Lan</a>
                <ul>
                  <li><a href="<?= base_url('home/site_lang/english'); ?>">English</a></li>
                  <li><a href="<?= base_url('home/site_lang/french'); ?>">French</a></li>
                </ul>
              </li>
            <?php else: ?> 
                <li class=""><a href="<?= base_url(); ?>"><?=trans('label_home')?></a></li>
                <li class="menu-has-children"><a href=""><?=trans('label_jobs')?></a>
              <ul>
                <li><a href="<?= base_url('jobs'); ?>"><?=trans('label_search_job')?></a></li>
                <li><a href="<?= base_url('jobs-by-category'); ?>"><?=trans('label_jobs_by_cat')?></a></li>
                <li><a href="<?= base_url('jobs-by-industry'); ?>"><?=trans('label_jobs_by_industry')?></a></li>
                <li><a href="<?= base_url('jobs-by-location'); ?>"><?=trans('label_jobs_by_loc')?></a></li>
                <li><a href="<?= base_url('jobs'); ?>"><?=trans('label_browse_jobs')?></a></li>
              </ul>
            </li>

            <li><a class="ticker-btn-nav btn_login mt-1" href="<?= base_url('auth/login') ?>"><i class="lnr lnr-user pr-1"></i> <?=trans('label_login')?></a></li>
            <li><a class="nav_btn mt-1" href="<?= base_url('employers') ?>"><i class="lnr lnr-briefcase pr-1"></i><?=trans('label_for_employers')?></a> </li>
            <li class="menu-has-children"><a href="">Lan</a>
              <ul>
                <li><a href="<?= base_url('home/site_lang/english'); ?>">English</a></li>
                <li><a href="<?= base_url('home/site_lang/french'); ?>">French</a></li>
              </ul>
            </li>
            <?php endif; ?>                                 
          </ul>
        </nav><!-- #nav-menu-container -->      
      </div>      
    </div>
  </div>
</header><!-- #header End
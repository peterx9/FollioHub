<!-- start banner Area -->

<section class="banner-area relative" id="home">	

	<div class="overlay overlay-bg"></div>

	<div class="container">

		<div class="row d-flex align-items-center justify-content-center">

			<div class="about-content col-lg-12">

				<h1 class="text-white">

					<?=trans('label_dashboard')?>

				</h1>	

				<p class="text-white link-nav"><a href="<?= base_url('employers'); ?>"><?=trans('label_home')?> </a>  <span class="lnr lnr-arrow-right"></span>  <a href=""> <?=trans('label_dashboard')?> </a></p>

			</div>											

		</div>

	</div>

</section>

<!-- End banner Area -->	



<section class="section-gap">

	<div class="container">

		<div class="row">

			<div class="col-md-12">

				<?php if ($this->session->flashdata('success')) :?>

					<div class="alert alert-success">

						<strong><?=$this->session->flashdata('success')?></strong>

					</div>

				<?php endif;?>

				<?php if ($this->session->flashdata('errors')) :?>

					<div class="alert alert-danger">

						<strong><?=$this->session->flashdata('errors')?></strong>

					</div>

				<?php endif;?>

			</div>

			<div class="col-lg-4 sidebar">

				<?php $this->load->view($emp_sidebar); ?>					

			</div>



			<div class="col-lg-8 profile_job_content">

				<div class="headline">

					<h3><?=trans('label_dashboard')?></h3>

				</div>

				<div class="row m-4">

					<div class="col-md-6">

						<div class="card text-center">

							<div class="card-body">

							   <i class="fa fa-bullhorn fa-2x mb-3"></i>

							   <h4 class="mb-3"><?=trans('total_job_posted')?></h4>

							   <h5><?= $total_posted_jobs ?></h5>

							</div>

						</div>

					</div>

					
				</div>	

				

			</div>

		</div>

	</div>

</section>


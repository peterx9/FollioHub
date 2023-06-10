<!-- company-information-form-section start -->
<section id="company-info-form">
	<div class="container">
		<?php

			if ($this->session->flashdata('edit_company_info_success')) {

                echo '<div class="alert alert-success">' . $this->session->flashdata('edit_company_info_success') . '</div>';

            }

			if($this->session->flashdata('error_edit_company_info')){

                echo '<div class="alert alert-danger col-md-8">' . $this->session->flashdata('error_edit
            _company_info') . '</div>';

        	}

		?>
		<div class="row">
			<div class="col-md-8">
				<?php $attributes = array('id' => 'company_info_form', 'method' => 'post' , 'class' => 'form_horizontal'); ?>

		        <?php echo form_open('employers/profile/edit',$attributes);?>
					<div class="bg-light card card-body mt-3">
						<h4>Edit Company Information</h4>
						<div class="bottom-line"></div>
						<div class="form-group row mt-4">
						    <label for="inputEmail3" class="col-sm-3 col-form-label">Industry:</label>
						    <div class="col-sm-9">
						        <input type="text" name="industry" class="form-control" id="" placeholder="Marketing & Advertisement" value="<?= $company_info['industry']  ?>">
						    </div>
					    </div>
					    <div class="form-group row">
						    <label for="inputEmail3" class="col-sm-3 col-form-label">Company Name:</label>
						    <div class="col-sm-9">
						        <input type="text" name="company_name" class="form-control" id="inputEmail3" placeholder="e.g Ozient Technologies" value="<?= $company_info['company_name']  ?>">
						    </div>
					    </div>
					    <div class="form-group row">
						    <label for="inputEmail3" class="col-sm-3 col-form-label">Email ID:</label>
						    <div class="col-sm-9">
						        <input type="email" name="email" class="form-control" id="inputEmail3" placeholder="e.g @OzientTechnologies.com" value="<?= $company_info['email']  ?>">
						    </div>
					    </div>
					    <div class="form-group row">
						    <label for="inputEmail3" class="col-sm-3 col-form-label">Mobile Number:</label>
						    <div class="col-sm-9">
						        <input type="text" name="mobile_number" class="form-control" id="inputEmail3" placeholder="e.g 030000000" value="<?= $company_info['mobile_number']  ?>">
						    </div>
					    </div>
					    <div class="form-group row">
						    <label for="inputEmail3" class="col-sm-3 col-form-label">Address:</label>
						    <div class="col-sm-9">
						        <input type="text" name="address" class="form-control" id="inputEmail3" placeholder="e.g Punjab, Pakistan." value="<?= $company_info['address']  ?>">
						    </div>
					    </div>
					    <div class="form-group row">
					    	<input type="submit" class="btn btn-success form-control" name="company_info_edit" value="Save">
					    </div>
					</div>
				<?php echo form_close();?>
			</div>
		</div>
		<div class="col-md-4"></div>
	</div>
</section>
<!-- company-information-form-section end -->
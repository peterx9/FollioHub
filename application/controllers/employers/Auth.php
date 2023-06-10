<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends Main_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('employers/auth_model','auth_model');
		$this->load->library('mailer'); // load custom mailer library
		$this->load->helper('email');
		
		if($this->session->userdata('is_user_login'))
		redirect(base_url());
		
		if($this->session->has_userdata('is_admin_login'))
		redirect('admin/dashboard');
	}

	//------------------------------------------------------------------
	public function login(){
	    if(emp_id())
		redirect(base_url('employers'));
		
		if ($this->input->post('login')) {

			$this->form_validation->set_rules('email','email','trim|required|min_length[5]|valid_email' );
			$this->form_validation->set_rules('password','password','trim|required|min_length[3]');

			if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors()
				);

				$this->session->set_flashdata('error_login', $data['errors']);
				redirect(base_url('auth/login'),'refresh');
			}else{

				$data = array(
					'email' => $this->input->post('email'),
					'password' => $this->input->post('password') 
				);

				$data = $this->security->xss_clean($data);
				$result = $this->auth_model->login($data);

				if ($result) {

					if($result['is_verify'] == 0){
						$this->session->set_flashdata('error_login', 'Please verify your email address!');
						redirect(base_url('employers/auth/login'));
						exit();
					}

					$login_data = array(
						'employer_id' => $result['id'],
						'email' => $result['email'], 
						'password' => $result['password'],
						'username' => $result['firstname'],
						'is_employer_login' => TRUE
					);

					$this->session->set_userdata($login_data);
					// redirected to last request page
					if(!empty($this->session->userdata('last_request_page'))){
						$back_to = $this->session->userdata('last_request_page');
						redirect($back_to);
					}
					else{
						redirect(base_url('employers/profile'),'refresh');
					}
				}else{
					$this->session->set_flashdata('error_login',trans('invalid_email_pass'));
					redirect(base_url('auth/login'),'refresh');
				}
			}
		}else{

			$data['title'] = trans('employer_login');
			$data['meta_description'] = 'your meta description here';
			$data['keywords'] = 'meta tags here';

			$data['layout'] = 'auth/login_page';
			$this->load->view('layout', $data);
		}
	}

	//------------------------------------------------------------------
	public function registration()
	{
	    if(emp_id())
		redirect(base_url('employers'));
		
		//$this->load->model('employers/package_model', 'package_model');

		$data['categories'] = $this->common_model->get_categories_list(); 
		$data['countries'] = $this->common_model->get_countries_list(); 
		$data['cities'] = $this->common_model->get_cities_list(); 

		if ($this->input->post('submit')) {

			if ($this->recaptcha_status == true) {
	            if (!$this->recaptcha_verify_request()) {
	                $this->session->set_flashdata('form_data', $this->input->post());
	                $this->session->set_flashdata('validation_errors', 'reCaptcha Error');
	                redirect(base_url('auth/registration'));
	                exit();
	            }
	        }

	        //validate inputs
			$this->form_validation->set_rules('firstname','firstname','trim|required|min_length[3]');
			$this->form_validation->set_rules('lastname','lastname','trim|required|min_length[3]');
			$this->form_validation->set_rules('email','email','trim|required|min_length[7]|valid_email|is_unique[xx_employers.email]');
			$this->form_validation->set_rules('password','password','trim|required|min_length[3]');
			$this->form_validation->set_rules('confirmpassword','confirm password','trim|required|min_length[3]|matches[password]');
			$this->form_validation->set_rules('company_name','Company Name','trim|required|min_length[3]');
			$this->form_validation->set_rules('category','category','trim|required');
			$this->form_validation->set_rules('org_type','Organization Type','trim');
			$this->form_validation->set_rules('country','Country','trim|required');
			$this->form_validation->set_rules('state','State','trim|required');
			$this->form_validation->set_rules('city','City','trim|required');
			$this->form_validation->set_rules('postcode','Postcode','trim|required');
			$this->form_validation->set_rules('address','Address','trim|required|min_length[3]');
			$this->form_validation->set_rules('phone_no','Phone Number','trim');
			$this->form_validation->set_rules('website','website','trim');
			$this->form_validation->set_rules('description','Company Description','trim|min_length[5]');

			$this->form_validation->set_rules('termsncondition','terms n condition','required');

			if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors(), 
				);
				$this->session->set_flashdata('error', $data['errors']);
				redirect(base_url('employers/auth/registration'));
			}else{

				$emp_info = array(
					'firstname' => $this->input->post('firstname'), 
					'lastname' => $this->input->post('lastname'),
					'email' => $this->input->post('email'),
					'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
					'is_verify' => 1,
					'token' => md5(rand(0,1000)), 
					'created_date' => date('Y-m-d : h:m:s'),
					'updated_date' => date('Y-m-d : h:m:s')
				);

				$company_info = array(
					'company_name' => $this->input->post('company_name'), 
					'company_slug' => make_slug($this->input->post('company_name')),
					'category' => $this->input->post('category'),
					'org_type' => $this->input->post('org_type'),
					'address' => $this->input->post('address'),
					'country' => $this->input->post('country'),
					'state' => $this->input->post('state'),
					'city' => $this->input->post('city'),
					'postcode' => $this->input->post('postcode'),
					'phone_no' => $this->input->post('phone_no'),
					'website' => $this->input->post('website'),
					'description' => $this->input->post('description'),
					'company_logo' => 'uploads/company_logos/default.png'
				);

				$emp_info = $this->security->xss_clean($emp_info);
				$emp_id = $this->auth_model->insert_employers($emp_info); // Insert Employer Info & get ID

				$company_info['employer_id'] = $emp_id;
				$company_info = $this->security->xss_clean($company_info);
				$result = $this->auth_model->insert_company($company_info); // Insert Company Info

				// Add Free Package
				//$package_detail = $this->package_model->get_free_package();

				$buyer_data = array(
			    	'employer_id' => $emp_id,
			    	'package_id' =>  $package_detail['id'],
			    	'expire_date' => add_days_to_date($package_detail['no_of_days']),
			    	'buy_date' => date('Y-m-d : h:m:s'),
		    	);

				$buyer_data = $this->security->xss_clean($buyer_data);				
				if ($result) {

					// --- sending email
				

					$this->session->set_flashdata('registration_success');
					redirect(base_url('employers/auth/login'), 'refresh');
					exit();
				}else{
					echo "failed";
				}
			}
		}
		else{
			$data['title'] = trans('employer_registration');
			$data['meta_description'] = 'your meta description here';
			$data['keywords'] = 'meta tags here';

			$data['layout'] = 'employers/auth/registration_page';
			$this->load->view('layout', $data);
		}
	}

	//----------------------------------------------------------	
	public function verify(){
        if(emp_id())
		redirect(base_url('employers'));
		
		$verification_id = $this->uri->segment(4);
		$result = $this->auth_model->email_verification($verification_id);
		if($result){
		    
		    // --- sending welcome email
		    $mail_data = array(
		        'fullname' => $result['firstname'].' '.$result['lastname'],
		    );
			$this->mailer->mail_template($result['email'],'welcome',$mail_data);
					
			$this->session->set_flashdata('success', trans('email_verified_msg'));
			redirect(base_url('employers/auth/login'));
		}
		else{
			$this->session->set_flashdata('success', trans('url_invalid_msg'));
			redirect(base_url('employers/auth/login'));
		}	
	}


	//--------------------------------------------------		
	public function forgot_password()
	{
	    if(emp_id())
		redirect(base_url('employers'));
		
		if($this->input->post('submit')){
			//checking server side validation
			$this->form_validation->set_rules('email', 'Email', 'valid_email|trim|required');
			if ($this->form_validation->run() == FALSE) 
			{
				$data = array(
					'errors' => validation_errors(), 
				);
				$this->session->set_flashdata('error', $data['errors']);
				redirect(base_url('employers/auth/forgot_password'));
			}
			$email = $this->input->post('email');

			$response = $this->auth_model->check_emp_mail($email); // check if email exist
			if($response){
				$rand_no = rand(0,1000);
				$pwd_reset_code = md5($rand_no.$response['id']);
				$this->auth_model->update_reset_code($pwd_reset_code, $response['id']);

				// --- sending email
				$name = $response['firstname'].' '.$response['lastname'];
				$email = $response['email'];
				$reset_link = base_url('employers/auth/reset_password/'.$pwd_reset_code);
				$body = $this->mailer->pwd_reset_link($name,$reset_link);

				$this->load->helper('email_helper');
				$to = $email;
				$subject = 'Reset your password';
				$message =  $body ;
				$email = sendEmail($to, $subject, $message, $file = '' , $cc = '');
				if($email){
					$this->session->set_flashdata('success', trans('reset_pass_msg'));

					redirect(base_url('employers/auth/forgot_password'));
				}
				else{
					$this->session->set_flashdata('error', trans('problem_email_msg'));
					redirect(base_url('employers/auth/forgot_password'));
				}
			}
			else{
				$this->session->set_flashdata('error', trans('invalid_email_msg'));
				redirect(base_url('employers/auth/forgot_password'));
			}
		}
		else{
			$data['title'] = trans('forgot_pass');
			$data['meta_description'] = 'your meta description here';
			$data['keywords'] = 'meta tags here';

			$data['layout'] = 'employers/auth/forget_password_page';
			$this->load->view('layout', $data);
		}
	}

	//----------------------------------------------------------------		
	public function reset_password($id=0)
	{
	    if(emp_id())
		redirect(base_url('employers'));
		
		// check the activation code in database
		if($this->input->post('submit')){
			$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
			$this->form_validation->set_rules('confirm_password', 'Password Confirmation', 'trim|required|matches[password]');

			if ($this->form_validation->run() == FALSE) {
				$result = false;
				$data['reset_code'] = $id;
				$data['title'] = trans('reset_pass');
				$data['layout'] = 'employers/auth/reset_password_page';
				$this->load->view('layout', $data);
			}   
			else{
				$new_password = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
				$this->auth_model->reset_password($id, $new_password);
				$this->session->set_flashdata('success',trans('new_password_success_msg'));
				redirect(base_url('auth/login'));
			}
		}
		else{
			$result = $this->auth_model->check_password_reset_code($id);
			if($result){
				$data['reset_code'] = $id;
				$data['title'] = trans('reset_pass');
				$data['layout'] = 'employers/auth/reset_password_page';
				$this->load->view('layout', $data);
			}
			else{
				$this->session->set_flashdata('error',trans('passcode_invalid'));
				redirect(base_url('employers/auth/forgot_password'));
			}
		}
	}

 	//------------------------------------------------------------------
	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url('employers/home'), 'refresh');
	}

}// end classs

?>
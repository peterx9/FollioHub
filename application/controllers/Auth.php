    <?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends Main_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('auth_model','auth_model');
		
		if(emp_id())
		redirect(base_url('employers'));
		
		if($this->session->has_userdata('is_admin_login'))
		redirect('admin/dashboard');
	}

	//-------------------------------------------------------------------
	// login functionality
	public function login()
	{
	    if($this->session->userdata('is_user_login'))
	    redirect(base_url());
	    
		if ($this->input->post('login')) 
		{
			//validate inputs
			$this->form_validation->set_rules('email','email','trim|required|min_length[3]|valid_email' );
			$this->form_validation->set_rules('password','password','trim|required|min_length[3]');

			if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors()
				);

				$this->session->set_flashdata('error_login', $data['errors']);
				redirect(base_url('auth/login'),'refresh');
			}
			else{

				$data = array(
					'email' => $this->input->post('email'),
					'password' => $this->input->post('password') 
				);

				$data = $this->security->xss_clean($data); // XSS Clean

				$result = $this->auth_model->login($data);

				if ($result) {

					if($result['is_verify'] == 0){
						$this->session->set_flashdata('error_login', trans('verify_email'));
						redirect(base_url('auth/login'));
						exit();
					}

					$login_data = array(
						'user_id' => $result['id'],
						'email' => $result['email'], 
						'password' => $result['password'],
						'username' => $result['firstname'],
						'is_user_login' => TRUE
					);

					$this->session->set_userdata($login_data);

					// redirected to last request page
					if(!empty($this->session->userdata('last_request_page')))
					{
						$back_to = $this->session->userdata('last_request_page');
						redirect($back_to);
					}
					else
					{
						redirect(base_url('profile'),'refresh');
					}
				}
				else
				{
					$this->session->set_flashdata('error_login',trans('invalid_email_pass'));
					 redirect(base_url('auth/login'),'refresh');
				}
			}
		}
		else
		{
			$data['title'] = trans('login');
			$data['meta_description'] = 'your meta description here';
			$data['keywords'] = 'meta tags here';

			$data['layout'] = 'auth/login_page';
			$this->load->view('layout', $data);
		}
	}

	//-------------------------------------------------------------------------------
	// Registration Functionality
	public function registration()
	{
	    if($this->session->userdata('is_user_login'))
	    redirect(base_url());
	    
		if ($this->input->post('submit')) 
		{

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
			$this->form_validation->set_rules('email','email','trim|required|min_length[5]|valid_email|is_unique[xx_users.email]');
			$this->form_validation->set_rules('password','password','trim|required|min_length[3]');
			$this->form_validation->set_rules('confirmpassword','confirm password','trim|required|min_length[3]|matches[password]');
			$this->form_validation->set_rules('termsncondition','terms n condition','required');

			if ($this->form_validation->run() == FALSE) 
			{
				$data = array(
					'errors' => validation_errors(), 
				);
				$this->session->set_flashdata('validation_errors', $data['errors']);
				redirect(base_url('auth/registration'));
			}
			else
			{
				$data = array(
					'firstname' => $this->input->post('firstname'), 
					'lastname' => $this->input->post('lastname'),
					'email' => $this->input->post('email'),
					'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
					'is_verify' => 1,
					'token' => md5(rand(0,1000)), 
					'created_date' => date('Y-m-d : h:m:s'),
					'updated_date' => date('Y-m-d : h:m:s')
				);

				$data = $this->security->xss_clean($data); // XSS Clean Data

				$result = $this->auth_model->insert_into_users($data);
				
				if ($result) 
				{
					// Send Verification Email

					$this->session->set_flashdata('registration_success');
					redirect(base_url('auth/login'), 'refresh');
				}
			}
		}
		else
		{
			$data['title'] = trans('registration');
			$data['layout'] = 'auth/registration_page';
			$this->load->view('layout', $data);
		}
	}

	//----------------------------------------------------------	
	public function verify()
	{
        if($this->session->userdata('is_user_login'))
	    redirect(base_url());
	    
		$verification_id = $this->uri->segment(3);
		$result = $this->auth_model->email_verification($verification_id);
		if($result){
		    
		    // --- sending welcome email
		    $mail_data = array(
		        'fullname' => $result['firstname'].' '.$result['lastname'],
		    );
			$this->mailer->mail_template($result['email'],'welcome',$mail_data);
			
			$this->session->set_flashdata('success', trans('email_verified_msg'));
			redirect(base_url('auth/login'));
		}
		else{
			$this->session->set_flashdata('success', trans('url_invalid_msg'));
			redirect(base_url('auth/login'));
		}	
	}

	//--------------------------------------------------		
	public function forgot_password()
	{
	    if($this->session->userdata('is_user_login'))
	    redirect(base_url());
	    
		if($this->input->post('submit')){

			//validate inputs
			$this->form_validation->set_rules('email', 'Email', 'valid_email|trim|required');
			if ($this->form_validation->run() == FALSE) 
			{
				$data = array(
					'errors' => validation_errors(), 
				);
				$this->session->set_flashdata('error', $data['errors']);
				redirect(base_url('auth/forgot_password'));
			}
			$email = $this->input->post('email');

			$response = $this->auth_model->check_user_mail($email); // check if email exist

			if($response){
				$rand_no = rand(0,1000);
				$pwd_reset_code = md5($rand_no.$response['id']);
				$this->auth_model->update_reset_code($pwd_reset_code, $response['id']);

				// --- sending email
				$name = $response['firstname'].' '.$response['lastname'];
				$email = $response['email'];
				$reset_link = base_url('auth/reset_password/'.$pwd_reset_code);
				$body = $this->mailer->pwd_reset_link($name,$reset_link);

				$this->load->helper('email_helper');
				$to = $email;
				$subject = 'Reset your password';
				$message =  $body ;
				$email = sendEmail($to, $subject, $message, $file = '' , $cc = '');

				if($email){
					$this->session->set_flashdata('success', trans('reset_pass_msg'));

					redirect(base_url('auth/forgot_password'));
				}
				else{
					$this->session->set_flashdata('error', trans('problem_email_msg'));
					redirect(base_url('auth/forgot_password'));
				}
			}
			else{
				$this->session->set_flashdata('error', trans('invalid_email_msg'));
				redirect(base_url('auth/forgot_password'));
			}
		}
		else{
			$data['title'] = trans('forgot_pass');
			$data['meta_description'] = 'your meta description here';
			$data['keywords'] = 'meta tags here';
		
			$data['layout'] = 'auth/forget_password_page';
			$this->load->view('layout', $data);
		}
	}

	//----------------------------------------------------------------		
	public function reset_password($id=0)
	{
	    if($this->session->userdata('is_user_login'))
	    redirect(base_url());
	    
		// check the activation code in database
		if($this->input->post('submit')){
			
			$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
			$this->form_validation->set_rules('confirm_password', 'Password Confirmation', 'trim|required|matches[password]');

			if ($this->form_validation->run() == FALSE) {
				$result = false;
				$data['reset_code'] = $id;
				$data['title'] = trans('reset_pass');
				$data['layout'] = 'auth/reset_password_page';
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
				$data['title'] = 'Reseat Password';
				$data['layout'] = 'auth/reset_password_page';
				$this->load->view('layout', $data);
			}
			else{
				$this->session->set_flashdata('error',trans('passcode_invalid'));
				redirect(base_url('auth/forgot_password'));
			}
		}
	}

	//----------------------------------------------------------------------------
	// Logout Function
	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url(), 'refresh');
	}

}// endClass
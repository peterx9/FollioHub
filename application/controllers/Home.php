<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Main_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('home_model');
	}

	//-----------------------------------------------------------------------------
	// Index funciton will call bydefault
	public function index()
	{	
		$data['countries'] = $this->common_model->get_countries_list(); // get countries for dropdown
		
		$data['testimonials'] = $this->home_model->get_testimonials();

		$data['cities_job'] = $this->home_model->get_cities_with_jobs(); //get those countries who have jobs
		
		$data['jobs'] = $this->home_model->get_jobs(8,0);

		$data['companies'] =  $this->home_model->get_companies_having_active_jobs(8);

		$data['posts'] = $this->home_model->get_latest_blog_post();

		$data['title'] = trans('label_home');
		$data['meta_description'] = 'your meta description here';
		$data['keywords'] = 'meta tags here';

		$data['layout'] = 'home';
		$this->load->view('layout', $data);
	}


	//-----------------------------------------------------------------------------
	// About Us Page
	public function about_us()
	{
		$data['title'] = 'About';
		$data['meta_description'] = 'your meta description here';
		$data['keywords'] = 'meta tags here';

		$data['layout'] = 'about_us';
		$this->load->view('layout', $data);
	}

	//-----------------------------------------------------------------------------
	// Dynamic page builder 
    public function any($slug)
    {
        $slug = $this->security->xss_clean($slug);
        //index page
        if (empty($slug)) {
            redirect(base_url());
        }

        $data['page'] = $this->home_model->get_page($slug);

        //if not exists
        if (empty($data['page'])) {
            redirect(base_url());
        } else {
        	$data['title'] = $data['page']['title'];
			$data['meta_description'] = $data['page']['description'];
			$data['keywords'] = $data['page']['keywords'];

			$data['layout'] = 'page';
			$this->load->view('layout', $data);

        }
    }

	//-----------------------------------------------------------------------------
	// Contact Us Functionality
	public function contact()
	{
		if ($this->input->post('submit'))
		{
			$this->form_validation->set_rules('username','Full Name','trim|required|min_length[3]');
			$this->form_validation->set_rules('email','email','trim|required|min_length[3]');
			$this->form_validation->set_rules('subject','last name','trim|required|min_length[3]');
			$this->form_validation->set_rules('message','message','trim|required|min_length[3]');

			if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors()
				);

				$this->session->set_flashdata('error_send', $data['errors']);

				redirect(base_url('contact'),'refresh');
			}
			else
			{
				$data = array(
					'username' => $this->input->post('username'),
					'email' => $this->input->post('email'),
					'subject' => $this->input->post('subject'),
					'message' => $this->input->post('message'),
					'created_date' => date('Y-m-d : h:m:s'),
					'updated_date' => date('Y-m-d : h:m:s')
				);

				$data = $this->security->xss_clean($data); // XSS Clean Data

				$result = $this->home_model->contact($data);

				if($result) 
				{
					// email code
					$this->load->helper('email_helper');

					$to = $this->general_settings['admin_email'];
					$subject = 'Contact Us | '.$this->general_settings['application_name'];
					$message =  '<p>Username: '.$data['username'].'</p> 
					<p>Email: '.$data['email'].'</p>
					<p>Message: '.$data['message'].'</p>' ;

					sendEmail($to, $subject, $message, $file = '' , $cc = '');

					$this->session->set_flashdata('success','<p class="alert alert-success"><strong>Success! </strong>your message has been sent successfully!</p>');
					redirect(base_url('contact'), 'refresh');
				}
				else
				{
					redirect(base_url('contact'), 'refresh');
				}
			}
		}
		else
		{
			$data['title'] = 'Contact';
			$data['layout'] = 'contact_us';
			$this->load->view('layout', $data);
		}
	}
	public function site_lang($site_lang) {
		echo $site_lang;
		echo '<br>';
		echo 'you will be redirected to :'.$_SERVER['HTTP_REFERER'];
		$language_data = array(
			'site_lang' => $site_lang
		);

		$this->session->set_userdata($language_data);
		if ($this->session->userdata('site_lang')) {
			echo 'user session language is = '.$this->session->userdata('site_lang');
		}
		redirect($_SERVER['HTTP_REFERER']);

		exit;
	}

	// --------------------------------------------------------------------------
	// Add Subscriber 
	public function add_subscriber()
	{

		if ($this->input->post())
		{
			$this->form_validation->set_rules('subscriber_email','Subscriber Email','trim|required|valid_email');

			if ($this->form_validation->run() == FALSE) {

				$this->session->set_flashdata('error_subscriber',validation_errors());
			}
			else
			{
				$data = array(
					'email' => $this->input->post('subscriber_email'),
					'created_at' => date('Y-m-d h:i:s')
				);

				$this->home_model->add_subscriber($data);

				$this->session->set_flashdata('success_subscriber',trans('success_subscriber_msg'));
			}

			if($this->agent->is_referral())
			    redirect($this->agent->referrer().'#subscribe-area');
			else
				redirect(base_url().'#subscribe-area');
		}
	}

}// endClass

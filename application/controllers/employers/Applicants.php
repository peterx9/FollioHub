<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Applicants extends Main_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->per_page_record = 14;
		$this->rbac->check_emp_authentiction();	// checking user login session
		$this->load->model('employers/applicant_model', 'applicant_model');
		$this->load->model('profile_model');
		$this->load->library('mailer'); // load CI email library
	}

	//-----------------------------------------------------------------------------------------
	// Applicants who have applied for the job
	public function view($job_id){

		$count = $this->applicant_model->count_total_applicants($job_id);

		$offset = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
		$url= base_url("employers/applicants/view/".$job_id."/");

		$config = $this->functions->pagination_config($url, $count, $this->per_page_record);
		$config['uri_segment'] = 5;		
		$this->pagination->initialize($config);

		$data['applicants'] = $this->applicant_model->get_applicants($job_id, $this->per_page_record, $offset); // Get all applicants

		$data['title'] = trans('jobs_applicants');
		$data['meta_description'] = 'your meta description here';
		$data['keywords'] = 'meta tags here';

		$data['layout'] = 'employers/applicants/job_applicants_page';
		$this->load->view('layout',$data);
	}

	//-----------------------------------------------------------------------------------------
	// Make Shortlist Applicant
	public function make_shortlist($id){
	    
		$result = $this->applicant_model->do_shortlist($id);
		
		$user_email = $this->applicant_model->get_applied_candidate_email($id);
		
		$job_id = $this->uri->segment(5);
		
		$job = get_job_detail($job_id);

		// sending shortlisted email 
		$mail_data = array(
		   'job_title' => $job['title']
		);
		
		//$this->mailer->mail_template($user_email,'candidate-shortlisted',$mail_data);

		if($result){
			redirect(base_url('employers/applicants/shortlisted/'.$job_id), 'refresh');
		}
	}

	//-----------------------------------------------------------------------------------------
	// Make Shortlist Applicant
	public function get_shortlisted_user_profile()
	{
		if($this->input->post('user_id'))
		{

			$user_id = $this->input->post('user_id');

			$data['categories'] = $this->common_model->get_categories_list(); 
			$data['countries'] = $this->common_model->get_countries_list(); 
			$data['cities'] = $this->common_model->get_cities_list(); 
			$data['salaries'] = $this->common_model->get_salary_list();  
			$data['user_info'] = $this->profile_model->get_user_by_id($user_id);
			$data['education'] = $this->profile_model->get_user_education($user_id);
			$data['languages'] = $this->profile_model->get_user_language($user_id);
			$data['experiences'] = $this->profile_model->get_user_experience($user_id);

			echo $this->load->view('employers/applicants/shortlisted_single_applicant_profile',$data,true);
		}
		else
		{
			redirect('employers/profile');
		}
	}

	//-----------------------------------------------------------------------------------------
	// Shortlisted Applicant
	public function shortlisted($job_id){

		$count = $this->applicant_model->count_shortlisted_applicants($job_id);

		$offset = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
		$url= base_url("employers/applicants/shortlisted/".$job_id."/");

		$config = $this->functions->pagination_config($url, $count, $this->per_page_record);
		$config['uri_segment'] = 5;		
		$this->pagination->initialize($config);

		$data['applicants'] = $this->applicant_model->get_shortlisted_applicants($job_id, $this->per_page_record, $offset); // Get all applicants

		$data['title'] = trans('shortlisted_applicants');
		$data['meta_description'] = 'your meta description here';
		$data['keywords'] = 'meta tags here';

		$data['emp_sidebar'] = 'employers/emp_sidebar'; // load sidebar for employer
		$data['layout'] = 'employers/applicants/shortlisted_applicants_page';
		$this->load->view('layout',$data);
	}

	//-----------------------------------------------------------------------------------------
	// Sending Email to applicant
	public function email()
	{
		$email = trim($this->input->post('email'));
		$title = trim($this->input->post('subject'));
		$message = trim($this->input->post('message'));

		$this->load->helper('email');

		$to = $email;
		$subject = $title;
		$message =  '<p>Subject: '.$title.'</p>
		<p>Message: '.$message.'</p>' ;

		$email = sendEmail($to, $subject, $message, $file = '' , $cc = '');

		if(trim($email) == 'success'){
			echo trans('email_sent_success');
		}else {
			echo trans('problem_sending_email');
		}
	}


}//endClass
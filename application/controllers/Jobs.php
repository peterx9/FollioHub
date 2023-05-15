<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jobs extends Main_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->per_page_record = 14;
		$this->load->model('job_model'); // load job model
	}

	//--------------------------------------------------------------
	// Main Index Function
	public function index()
	{
		$count = $this->job_model->count_all_jobs();
		$offset = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
		$url= base_url("jobs/");

		$config = $this->functions->pagination_config($url,$count,$this->per_page_record);
		$config['uri_segment'] = 2;		
		$this->pagination->initialize($config);

		$data['jobs'] = $this->job_model->get_all_jobs($this->per_page_record, $offset, null); // Get all jobs
		$data['countries'] = $this->common_model->get_countries_list(); 
		$data['categories'] = $this->common_model->get_categories_list(); 

		$data['title'] = trans('label_jobs');

		$data['meta_description'] = 'your meta description here';
		$data['keywords'] = 'meta tags here';
		
		$data['layout'] = 'jobseeker/jobs/job_list_page';
		$this->load->view('layout', $data);
	}

	//--------------------------------------------------------------
	// Advance Search functionality 
	public function search()
	{
		$search = array();
		if($this->input->post('search'))
		{
			$this->form_validation->set_rules('job_title', 'Job Title', 'trim');
			$this->form_validation->set_rules('country', 'Location', 'trim');
			$this->form_validation->set_rules('category', 'Location', 'trim');
			$this->form_validation->set_rules('experience', 'Location', 'trim');
			$this->form_validation->set_rules('job_type', 'Location', 'trim');
			$this->form_validation->set_rules('employment_type', 'Location', 'trim');

			if ($this->form_validation->run() === FALSE) {
				redirect(base_url('jobs/search'));
				return;
			}

			// search job title
			if(!empty($this->input->post('job_title')))
				$search['title'] = make_slug($this->input->post('job_title'));

			// search job country
			if(!empty($this->input->post('country')))
				$search['country'] = $this->input->post('country');

			// search catagory
			if(!empty($this->input->post('category')))
				$search['category'] = $this->input->post('category');

			// search experience
			if(!empty($this->input->post('experience')))
				$search['experience'] = $this->input->post('experience');

			// search job type
			if(!empty($this->input->post('job_type')))
				$search['job_type'] = $this->input->post('job_type');

			// search employment type
			if(!empty($this->input->post('employment_type')))
				$search['employment_type'] = $this->input->post('employment_type');

			$query = $this->uri->assoc_to_uri($search);

			redirect(base_url('jobs/search/'.$query),'refresh');

		}
		$search_array = $this->uri->uri_to_assoc(3);
		$search_query = $this->uri->assoc_to_uri($search_array);


		$pg_arr = pagination_assoc('p', 3); // helper function

		$count = $this->job_model->count_all_search_result($search_array);

		$offset = $pg_arr['offset'];

		$url= base_url("jobs/search/".$pg_arr['uri']);

		$config = $this->functions->pagination_config($url,$count,$this->per_page_record);
		$config['uri_segment'] = $pg_arr['seg'];	

		$this->pagination->initialize($config);

		$data['search_value'] = $search_array;
		$data['jobs'] = $this->job_model->get_all_jobs($this->per_page_record, $offset, $search_array);
		$data['countries'] = $this->common_model->get_countries_list(); 
		$data['categories'] = $this->common_model->get_categories_list(); 

		$data['title'] = trans('search_results');
		$data['meta_description'] = 'your meta description here';
		$data['keywords'] = 'meta tags here';
		
		$data['layout'] = 'jobseeker/jobs/job_list_page';
		$this->load->view('layout', $data);
	}
	
	//--------------------------------------------------------------
	// Jobs by category
	public function jobs_by_category()
	{
		$data['categories'] = $this->job_model->get_categories_with_jobs();

		$data['title'] = trans('label_jobs_by_cat');
		$data['meta_description'] = 'your meta description here';
		$data['keywords'] = 'meta tags here';
		
		$data['layout'] = 'jobseeker/jobs/jobs_category_page';
		$this->load->view('layout', $data);
	}

	//--------------------------------------------------------------
	// search job by category
	public function category($title)
	{
		$search['category'] = get_category_id($title); // get category id by title

		// pagination
		$count = $this->job_model->count_all_search_result($search);
		$offset = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		$url= base_url("jobs/category/".$title);

		$config = $this->functions->pagination_config($url,$count,$this->per_page_record);
		$config['uri_segment'] = 4;		
		$this->pagination->initialize($config);

		$data['jobs'] = $this->job_model->get_all_jobs($this->per_page_record, $offset, $search);

		$data['categories'] = $this->common_model->get_categories_list();
		$data['countries'] = $this->common_model->get_countries_list(); 

		$data['title'] = trans('category');
		$data['meta_description'] = 'your meta description here';
		$data['keywords'] = 'meta tags here';
		
		$data['layout'] = 'jobseeker/jobs/job_list_page';
		$this->load->view('layout', $data);
	}

	//--------------------------------------------------------------
	// Jobs by Industry
	public function jobs_by_industry()
	{
		$data['industries'] = $this->job_model->get_industries_with_jobs();

		$data['title'] = trans('label_jobs_by_industry');
		$data['meta_description'] = 'your meta description here';
		$data['keywords'] = 'meta tags here';
		
		$data['layout'] = 'jobseeker/jobs/jobs_industry_page';
		$this->load->view('layout', $data);
	}

	//--------------------------------------------------------------
	// search job by industry
	public function industry($title)
	{
		$search['industry'] = get_industry_id($title); // get industry id by title

		// pagination
		$count = $this->job_model->count_all_search_result($search);
		$offset = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		$url= base_url("jobs/industry/".$title);

		$config = $this->functions->pagination_config($url,$count,$this->per_page_record);
		$config['uri_segment'] = 4;		
		$this->pagination->initialize($config);

		$data['jobs'] = $this->job_model->get_all_jobs($this->per_page_record, $offset, $search);

		$data['categories'] = $this->common_model->get_categories_list();
		$data['countries'] = $this->common_model->get_countries_list(); 

		$data['title'] = trans('label_jobs_by_industry');
		$data['meta_description'] = 'your meta description here';
		$data['keywords'] = 'meta tags here';
		
		$data['layout'] = 'jobseeker/jobs/job_list_page';
		$this->load->view('layout', $data);
	}

	//--------------------------------------------------------------
	// Jobs by loccation
	public function jobs_by_location()
	{
		$data['cities'] = $this->job_model->get_cities_with_jobs();

		$data['title'] = trans('label_jobs_by_loc');
		$data['meta_description'] = 'your meta description here';
		$data['keywords'] = 'meta tags here';
		
		$data['layout'] = 'jobseeker/jobs/jobs_location_page';
		$this->load->view('layout', $data);
	}

	//--------------------------------------------------------------
	// search job by city
	public function location($title)
	{
		$search['city'] = get_city_id($title); // get city id by title

		// pagination
		$count = $this->job_model->count_all_search_result($search);
		$offset = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		$url= base_url("jobs/location/".$title);

		$config = $this->functions->pagination_config($url,$count,$this->per_page_record);
		$config['uri_segment'] = 4;		
		$this->pagination->initialize($config);

		$data['jobs'] = $this->job_model->get_all_jobs($this->per_page_record, $offset, $search);

		$data['categories'] = $this->common_model->get_categories_list();
		$data['countries'] = $this->common_model->get_countries_list(); 

		$data['title'] = trans('label_jobs_by_loc');
		$data['meta_description'] = 'your meta description here';
		$data['keywords'] = 'meta tags here';
		
		$data['layout'] = 'jobseeker/jobs/job_list_page';
		$this->load->view('layout', $data);
	}

	//--------------------------------------------------------------
	// complete job detail page
	public function job_detail()
	{	
		$job_id = $this->uri->segment(2);
		$user_id = $this->session->userdata('user_id');
		
		// checking for already applied application
		$data['already_applied'] = $this->job_model->check_applied_application($user_id, $job_id);	

		$data['user_detail'] = $this->job_model->get_user_by_id($user_id);
		$data['job_detail'] = $this->job_model->get_job_by_id($job_id);

		$data['job_actual_link'] = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; // redirect to same job detail page after login 

		$data['cities_job'] = $this->job_model->get_cities_with_jobs(); //right sidebar

		// social media sharing 	
		$data['show_og_tags'] = true;
        $data['og_title'] = $data['job_detail']['title'];
        $description_text = trim(html_escape(strip_tags($data['job_detail']['description'])));
        $data['og_description'] = text_limit($description_text, 200);
        $data['og_type'] = "Job";
        $data['og_url'] = base_url('jobs/'.$data['job_detail']['id'].'/'.$data['job_detail']['job_slug']);
        $data['og_image'] = $this->general_settings['logo'];	

		$data['title'] = $data['job_detail']['title'];
		$data['meta_description'] = text_limit($description_text, 150);
		$data['keywords'] = $data['job_detail']['title'];
		
		$data['layout'] = 'jobseeker/jobs/job_detail_page';
		$this->load->view('layout', $data);
	}

	//-------------------------------------------------------------------------------------------
	// when applicant will apply for the job
	public function apply_job()
	{
		if($this->input->post('submit'))
		{
			$this->form_validation->set_rules('cover_letter', 'cover_letter', 'trim|required');
			$this->form_validation->set_rules('job_id', 'job_id', 'trim|required');
			$this->form_validation->set_rules('username', 'username', 'trim|required');
			$this->form_validation->set_rules('email', 'Email', 'valid_email|trim|required');
			$this->form_validation->set_rules('job_title', 'job_title', 'trim|required');
			$this->form_validation->set_rules('job_actual_link', 'job_actual_link', 'trim|required');

			$this->form_validation->set_error_delimiters('<div class="alert alert-danger">
                          <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>', '</div>');
			if ($this->form_validation->run() === FALSE) {
				$data = array(
					'errors' => validation_errors()
				);

				$this->session->set_flashdata('validation_errors', $data['errors']);
				redirect($this->input->post('job_actual_link'),'refresh');
			}

			$user_id = $this->session->userdata('user_id');
			$job_id = $this->input->post('job_id');
			$emp_id = $this->input->post('emp_id');
			$username = $this->input->post('username');
			$email = $this->input->post('email');
		    $job_title = $this->input->post('job_title');
		    $cover_letter = $this->input->post('cover_letter');
		    $job_actual_link = $this->input->post('job_actual_link');

			//insert job applicant to the "xx_applied_job" table
			$result = $this->job_model->insert_job_application($user_id, $emp_id, $job_id, $cover_letter); 

			if($result){
			    $emp = get_emp_by_id($emp_id);
			    $job = get_job_detail($job_id);
			    
			    $emp_to = $emp['email'];
			    
			    $user_to = get_user_email($user_id);
			    
			    // send email to employer
			    $mail_data = array(
			    'job_title' => $job['title']
			    );
			    
			    // Job Seeker
			   // $this->mailer->mail_template($user_to,'job-applied',$mail_data);
			    
			    //Employer Alert
			    //$this->mailer->mail_template($emp_to,'applicant-applied',$mail_data);
			    
				$this->session->set_flashdata('applied_success', trans('job_application_sent_msg'));
				redirect($job_actual_link);
			}
		}
	}

}// endClass

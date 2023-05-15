<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Company extends Main_Controller{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('company_model');
	}

	//----------------------------------------------------------------------------------
	// All Companies
	public function index()
	{
		$data['companies'] = $this->company_model->get_companies();

		$data['title'] = trans('top_companies');
		$data['meta_description'] = 'your meta description here';
		$data['keywords'] = 'meta tags here';
		
		$data['layout'] = 'jobseeker/company/companies_page';
		$this->load->view('layout', $data);
	}

	//----------------------------------------------------------------------------------
	// Company Detail
	public function detail($title)
	{
		$company_id = get_company_id($title);

		$data['company_info'] = $this->company_model->get_company_detail($company_id);

		$data['jobs'] = $this->company_model->get_jobs_by_companies($company_id); // Get company jobs

		$data['title'] = trans('company_details');
		$data['meta_description'] = 'your meta description here';
		$data['keywords'] = 'meta tags here';
		
		$data['layout'] = 'jobseeker/company/company_detail_page';
		$this->load->view('layout', $data);
	}

}

?> 
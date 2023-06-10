<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Main_Controller {

	public function __construct()
	{
		parent::__construct();
		//$this->load->model('employers/package_model', 'package_model');
	}

	public function index()
	{
		$data['title'] = trans('employers');
		//$data['packages'] = $this->package_model->get_all_pakages();
		$data['meta_description'] = 'your meta description here';
		$data['keywords'] = 'meta tags here';
		$data['dont_display_banner'] = true;
		//$data["package_cards"] = $this->load->view('employers/packages/packages_list', $data, TRUE);

		$data['layout'] = 'employers/home/index';
		$this->load->view('layout', $data);
	}

	
}

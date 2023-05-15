<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Main_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data['title'] = trans('employers');
		$data['meta_description'] = 'your meta description here';
		$data['keywords'] = 'meta tags here';
		$data['dont_display_banner'] = true;

		$data['layout'] = 'employers/home/index';
		$this->load->view('layout', $data);
	}

	
}

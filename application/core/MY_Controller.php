<?php
	class MY_Controller extends CI_Controller
	{
		function __construct()
		{
			parent::__construct();

			if(!$this->session->has_userdata('is_admin_login'))
			{
				redirect('admin/auth/login', 'refresh');
			}

			//general settings
	        $global_data['general_settings'] = $this->setting_model->get_general_settings();
	        $this->general_settings = $global_data['general_settings'];

	        //set timezone
	        date_default_timezone_set($this->general_settings['timezone']);
		}
	}

	class Main_Controller extends CI_Controller
	{
		function __construct()
		{
			parent::__construct();

			//general settings
	        $global_data['general_settings'] = $this->setting_model->get_general_settings();
	        $this->general_settings = $global_data['general_settings'];

	        //set timezone
	        date_default_timezone_set($this->general_settings['timezone']);

	        //recaptcha status
	        $global_data['recaptcha_status'] = true;
	        if (empty($this->general_settings['recaptcha_site_key']) || empty($this->general_settings['recaptcha_secret_key'])) {
	            $global_data['recaptcha_status'] = false;
	        }
	        $this->recaptcha_status = $global_data['recaptcha_status'];

			$site_language = ($this->general_settings['default_language'] != "")?$this->general_settings['default_language'] : "english";
			$language = ($this->session->userdata('site_lang') != "") ? $this->session->userdata('site_lang') : $site_language;
			//$this->lang->load(array('form_validation', 'home'),$language );
			$this->config->set_item('language', $language);
			$this->lang->load(array('home','user'), $language);
	        
		}

		//verify recaptcha
	    public function recaptcha_verify_request()
	    {
	        if (!$this->recaptcha_status) {
	            return true;
	        }

	        $this->load->library('recaptcha');
	        $recaptcha = $this->input->post('g-recaptcha-response');
	        if (!empty($recaptcha)) {
	            $response = $this->recaptcha->verifyResponse($recaptcha);
	            if (isset($response['success']) && $response['success'] === true) {
	                return true;
	            }
	        }
	        return false;
	    }

	}




?>

    
<?php
class RBAC 
{	
	private $ModuleAccess;
	
	function __construct()
	{
		$this->obj =& get_instance();
		$this->obj->ModuleAccess = $this->obj->session->userdata('ModuleAccess');
	}
	//-------------------------------------------------------------
	function check_user_authentication()
	{
		if(!$this->obj->session->userdata('is_user_login'))
		{	
			$last_request_page = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            $this->obj->session->set_userdata('last_request_page', $last_request_page);
			redirect('auth/login');
		}
	}

	//-------------------------------------------------------------
	function check_emp_authentiction() // check if the user is job seeker or employer
	{
		if(!$this->obj->session->userdata('is_employer_login'))
		{
			$last_request_page = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	        $this->obj->session->set_userdata('last_request_page', $last_request_page);
			redirect('employers/auth/login');
		}
	}
	
		
}
?>
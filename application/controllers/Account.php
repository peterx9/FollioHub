<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends Main_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('account_model');
	}

	//-------------------------------------------------------------------------------
	public function change_password()
	{	
		$this->rbac->check_user_authentication();	// checking user login session (rbac is a library function)
		
		if ($this->input->post('submit')) {

			$user_id = $this->session->userdata('user_id');

			$this->form_validation->set_rules('old_password','old password','trim|required|min_length[3]');
			$this->form_validation->set_rules('new_password','new password','trim|required|min_length[3]');
			$this->form_validation->set_rules('confirm_password','confirm password','trim|required|min_length[3]|matches[new_password]');

			if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors()
				);

				$this->session->set_flashdata('error_update_password', $data['errors']);
				redirect(base_url('account/change_password'),'refresh');

			}else{

				$data = array(
					'id' => $user_id,
					'old_password' => $this->input->post('old_password'),
					'password' => password_hash($this->input->post('new_password'), PASSWORD_BCRYPT),
				);

				$data = $this->security->xss_clean($data); // XSS Clean
				
				$result = $this->account_model->update_password($data,$user_id);
				
				if($result) {
					$this->session->set_flashdata('update_password_success',trans('password_updated_success'));
					
					redirect(base_url('account/change_password'));
				}else{
					$this->session->set_flashdata('update_password_failed',trans('old_pass_incorrect'));
					redirect(base_url('account/change_password'));
				}
			}
		}
		else{
			$data['user_sidebar'] = 'jobseeker/user_sidebar'; // load sidebar for user
			$data['title'] = trans('change_pass');
			$data['layout'] = 'jobseeker/account/change_password_page';
			$this->load->view('layout', $data);
		}
	}

	//-------------------------------------------------------------------------
	public function make_country_slug(){
		$this->load->model('common_model'); // for common funcitons

		$countries = $this->common_model->get_countries_list();

		foreach ($countries as $country) {

			$country_slug = make_slug($country['name']);

			$data = array('slug' => $country_slug);

			$this->db->where('name',$country['name']);
			$this->db->update('xx_countries',$data);
		}
	}

	//-------------------------------------------------------------------------
	public function make_city_slug(){
		$this->load->model('common_model'); // for common funcitons

		$cities = $this->common_model->get_cities_list();

		foreach ($cities as $city) {

			$city_slug = make_slug($city['name']);

			$data = array('slug' => $city_slug);

			$this->db->where('name',$city['name']);
			$this->db->limit(1600, 893);
			$this->db->update('xx_cities',$data);
		}
	}

	//-------------------------------------------------------------------------
	public function make_state_slug(){
		$this->load->model('common_model'); // for common funcitons

		$states = $this->common_model->get_states_list();

		foreach ($states as $state) {

			$state_slug = make_slug($state['name']);

			$data = array('slug' => $state_slug);

			$this->db->where('name',$state['name']);
			$this->db->limit(800, 0);
			$this->db->update('xx_states',$data);
			echo $this->db->last_query();
		}
	}

	//------------------------------------------------------------
	//Get States
	public function get_country_states()
	{
		$states = $this->db->select('*')->where('country_id',$this->input->post('country'))->get('xx_states')->result_array();
	    $options = array('' => 'Select State') + array_column($states,'name','id');
	    $html = form_dropdown('state',$options,'','class="form-control select2" required');
		$error =  array('msg' => $html);
		echo json_encode($error);
	}

	//------------------------------------------------------------
	//Get Cities
	public function get_state_cities()
	{
		$cities = $this->db->select('*')->where('state_id',$this->input->post('state'))->get('xx_cities')->result_array();
	    $options = array('' => 'Select City') + array_column($cities,'name','id');
	    $html = form_dropdown('city',$options,'','class="form-control select2" required');
		$error =  array('msg' => $html);
		echo json_encode($error);
	}


}// endClass

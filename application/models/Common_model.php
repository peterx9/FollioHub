<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Common_model extends CI_Model 
{

	//-----------------------------------------------------
	//Get Education
    function get_education($user_id)
    {
   	   $this->db->from('education');
	   $this->db->where('user_id',$user_id);
	   $query = $this->db->get();
	   return $query->result_array();
    }	

	//-------------------------------------------------------------
	// Experience
    function get_experience($user_id)
    {
   	   $this->db->from('experience');
	   $this->db->where('user_id',$user_id);
	   $query = $this->db->get();
	   return $query->result_array();
    }

    //-----------------------------------------------------------
    // Get Compnay record by ID
	function get_company($id=0)
	{
		if($id==0)
		{
			return  $this->db->select('id,name')->from('company')->where('active',1)->get()->result_array();	
		}
		else
		{
			return  $this->db->select('id,name')->from('company')->where('active',1)->where('id',$id)->get()->row_array();	
		}
	}

	//-----------------------------------------------
	// Get industries
    function get_industries_list()
    {
   	   $this->db->from('xx_industries');
   	   $this->db->order_by('name');
	   $query = $this->db->get();
	   return $query->result_array();
    }

	//-----------------------------------------------
	// Get Categories
    function get_categories_list()
    {
   	   $this->db->from('xx_categories');
   	   $this->db->order_by('name');
	   $query = $this->db->get();
	   return $query->result_array();
    }	

    //-----------------------------------------------
	// Get Blog Categories
    function get_blog_categories_list()
    {
   	   $this->db->from('xx_blog_categories');
   	   $this->db->order_by('name');
	   $query = $this->db->get();
	   return $query->result_array();
    }	

	//------------------------------------------------
	// Get Countries
	function get_countries_list($id=0)
	{
		if($id==0)
		{
			return  $this->db->get('xx_countries')->result_array();	
		}
		else
		{
			return  $this->db->select('id,country')->from('xx_countries')->where('id',$id)->get()->row_array();	
		}
	}	

	//------------------------------------------------
	// Get Cities
	function get_cities_list($id=0)
	{
		if($id==0){
			return  $this->db->get('xx_cities')->result_array();	
		}
		else{
			return  $this->db->select('id,city')->from('xx_cities')->where('id',$id)->get()->row_array();	
		}
	}	

	//------------------------------------------------
	// Get States
	function get_states_list($id=0)
	{
		if($id==0){
			return  $this->db->get('xx_states')->result_array();	
		}
		else{
			return  $this->db->select('id,s')->from('xx_cities')->where('id',$id)->get()->row_array();	
		}
	}	

	//------------------------------------------------
	// Get Nationality
	function get_nationality_dd($id=0)
	{
		if($id==0){
			return  $this->db->get('xx_nationality')->result_array();	
		}
		else{
			return  $this->db->select('id,nationality')->from('xx_nationality')->where('id',$id)->get()->row_array();	
		}
	}	

	//------------------------------------------------	
	// Get the Education Status Dropdown
	public function get_education_list()
	{
		return $this->db->get('xx_education')->result_array();
	}

	//------------------------------------------------	
	// Get the Education Status Dropdown
	public function get_visa_status()
	{
		return $this->db->get('xx_visa_status')->result_array();
	}

	//------------------------------------------------	
	// Get the Salary Offered Dropdown
	public function get_salary_list()
	{
		return $this->db->get('xx_expected_salary')->result_array();
	}


} // endClass
?>
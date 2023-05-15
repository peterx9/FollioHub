<?php  defined('BASEPATH') OR exit('No direct script access allowed');
class Company_Model extends CI_Model{

	//----------------------------------------------------------------------
	// Get company info
	public function company_info($data)
	{
		$this->db->insert('xx_company_info',$data);
		return true;
	}

	//----------------------------------------------------------------------
	// Get company by ID
	public function get_company_info_by_id($emp_id)
	{
		$query = $this->db->get_where('xx_companies', array( 'employer_id' => $emp_id));
		return $result = $query->row_array();
	}

	//----------------------------------------------------------------------
	// Update Company
	public function update_company_info($data, $comp_id, $emp_id)
	{
		$this->db->where('id',$comp_id);
		$this->db->where('employer_id',$emp_id);
		$this->db->update('xx_companies',$data);
		echo $this->db->last_query();
		return true;
	}

	//----------------------------------------------------------------------
	// Update Employer
	public function update_employer($data,$e_id)
	{
		$this->db->where('id',$e_id);
		$this->db->update('xx_employers',$data);
		return true;
	}

	//----------------------------------------------------------------------
	// Get company info
	public function get_info_by_id($e_id)
	{
		$query = $this->db->get_where('xx_company_info', array('employer_id' => $e_id ));
		return $result = $query->row_array();
	}
		
} // endClass
?>
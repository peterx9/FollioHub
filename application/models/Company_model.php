<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Company_Model extends CI_Model{

	//----------------------------------------------------
	// Get all companies
	public function get_companies()
	{
		$this->db->select('id, company_slug, company_logo');
		$this->db->from('xx_companies');
		$this->db->group_by('xx_companies.company_slug');
		$query = $this->db->get();
		return $query->result_array();
	}

	//----------------------------------------------------
	// Get all companies
	public function get_company_detail($id)
	{
		$query = $this->db->get_where('xx_companies', array('id' => $id));
		return $query->row_array();
	}

	//----------------------------------------------------
	// Get all companies
	public function get_jobs_by_companies($company_id)
	{
		$this->db->select('id, title, company_id, job_slug, job_type, description, country, city, created_date, industry');
		$this->db->from('xx_job_post');
		$this->db->where('company_id', $company_id);
		$this->db->where('is_status', 'active');
		$this->db->where('curdate() <  expiry_date');
		$this->db->order_by('created_date','desc');
		$query = $this->db->get();
		return $query->result_array();
	}

}

?>
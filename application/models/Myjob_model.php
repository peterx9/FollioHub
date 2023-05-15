<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Myjob_Model extends CI_Model{

	//-------------------------------------------------------
	// Get Applied Jobs
	public function get_applied_jobs()
	{
		$this->db->select('xx_seeker_applied_job.job_id,
			xx_job_post.id,
			xx_job_post.title,
			xx_job_post.company_id,
			xx_job_post.job_slug, xx_job_post.job_type,
			xx_job_post.description, xx_job_post.country,
			xx_job_post.city,
			xx_job_post.created_date,
			xx_job_post.industry');
		$this->db->from('xx_seeker_applied_job');
		$this->db->join('xx_job_post', 'xx_seeker_applied_job.job_id = xx_job_post.id', 'left');
		$this->db->where('xx_seeker_applied_job.seeker_id', $this->session->userdata('user_id'));
		$this->db->order_by('created_date','desc');
		$query = $this->db->get();
		return $query->result_array();
	}

	//-------------------------------------------------------
	// Get Matching Jobs
	public function get_matching_jobs($skills)
	{
		$this->db->select('id, title, company_id, job_slug, job_type, description, country, city,expiry_date, created_date, industry');
		$this->db->from('xx_job_post');
		$this->db->where('curdate() <  expiry_date');
		$this->db->where('is_status', 'active');


		if(!empty($skills)){
			$skills = explode(',', trim($skills));
			foreach($skills as $skill){
				$this->db->or_like('title', $skill);
				$this->db->or_like('skills', $skill);
			}
		}


		$this->db->order_by('created_date','desc');
		$this->db->group_by('title');
		$query = $this->db->get();
		return $query->result_array();
	}

	//----------------------------------------------------
	// Save Job 
	public function get_saved_jobs($user_id)
	{
		$this->db->select('xx_saved_jobs.job_id,
			xx_job_post.id,
			xx_job_post.title,
			xx_job_post.company_id,
			xx_job_post.job_slug, xx_job_post.job_type,
			xx_job_post.description, xx_job_post.country,
			xx_job_post.city,
			xx_job_post.created_date,
			xx_job_post.industry');
		$this->db->from('xx_saved_jobs');
		$this->db->join('xx_job_post', 'xx_saved_jobs.job_id = xx_job_post.id', 'left');
		$this->db->where('xx_saved_jobs.seeker_id', $this->session->userdata('user_id'));
		$this->db->order_by('created_date','desc');
		$query = $this->db->get();
		return $query->result_array();
	}

	//----------------------------------------------------
	// Save Job 
	public function save_job($data)
	{
		$this->db->insert('xx_saved_jobs', $data);

		return true;
	}

	//----------------------------------------------------
	// Save Job 
	public function is_already_saved($data)
	{
		$query = $this->db->get_where('xx_saved_jobs', $data);
		if($query->num_rows() > 0){
			return true;
		}
		else{
			return false;
		}
	}


}

?>
<?php  defined('BASEPATH') OR exit('No direct script access allowed');
class Cv_Model extends CI_Model{

	//-------------------------------------------------------------------
	// Count CV Search Result
	public function count_user_profiles($search)
	{
		$this->db->select('*');
		$this->db->from('xx_users');

		// search URI parameters
		if(!empty($search['country']))
			$this->db->where('country', $search['country']);
		if(!empty($search['category']))
			$this->db->where('category', $search['category']);
		if(!empty($search['expected_salary']))
			$this->db->where('expected_salary', $search['expected_salary']);
		if(!empty($search['education_level']))
			$this->db->where('education_level', $search['education_level']);
		if(!empty($search['experience']))
			$this->db->where('experience', $search['experience']);

		if(!empty($search['job_title'])){
			$search_text = explode('-', $search['job_title']);
			foreach($search_text as $search){
				$this->db->group_start();
				$this->db->like('job_title', $search);
				$this->db->or_like('skills', $search);
				$this->db->group_end();
			}
		}
		$this->db->where('is_active', '1');
		$this->db->where('profile_completed', '1');
		$this->db->order_by('created_date','desc');
		$this->db->group_by('job_title');

		return $this->db->count_all_results();
	}

	//-------------------------------------------------------------------
	// All CV Search Result
	public function get_user_profiles($search, $limit, $offset)
	{
		$this->db->select('*');
		$this->db->from('xx_users');
		
		// search URI parameters
		if(!empty($search['country']))
			$this->db->where('country', $search['country']);
		if(!empty($search['category']))
			$this->db->where('category', $search['category']);
		if(!empty($search['expected_salary']))
			$this->db->where('expected_salary', $search['expected_salary']);
		if(!empty($search['education_level']))
			$this->db->where('education_level', $search['education_level']);
		if(!empty($search['experience']))
			$this->db->where('experience', $search['experience']);

		if(!empty($search['job_title'])){
			$search_text = explode('-', $search['job_title']);
			foreach($search_text as $search){
				$this->db->group_start();
				$this->db->like('job_title', $search);
				$this->db->or_like('skills', $search);
				$this->db->group_end();
			}
		}
		$this->db->where('is_active', '1');
		$this->db->where('profile_completed', '1');
		$this->db->order_by('created_date','desc');
		$this->db->group_by('job_title');
		$this->db->limit($limit, $offset);
		$query = $this->db->get();
		//echo $this->db->last_query();exit;
		return $query->result_array();
	}

	public function do_shortlist($emp_id, $user_id)
	{
		$this->db->where('user_id',$user_id);
		$this->db->where('employer_id',$emp_id);
	    $query = $this->db->get('xx_cv_shortlisted');
	    if ($query->num_rows() > 0){
	        return true;
	    }
	    else{
	        $this->db->insert('xx_cv_shortlisted', array('employer_id' => $emp_id, 'user_id' => $user_id));
			return true;
	    }
		
	}

	public function get_shortlisted_applicants()
	{
		$this->db->select('xx_cv_shortlisted.id, 
			xx_cv_shortlisted.user_id,
			xx_cv_shortlisted.employer_id,
			xx_users.id as seeker_id,
			xx_users.firstname, 
			xx_users.lastname,
			xx_users.email,
			xx_users.city,
			xx_users.country,
			xx_users.job_title,
			xx_users.current_salary,
			xx_users.resume');
		$this->db->from('xx_cv_shortlisted');
		$this->db->join('xx_users','xx_users.id = xx_cv_shortlisted.user_id','left');
		$this->db->where('xx_cv_shortlisted.employer_id', $this->session->userdata('employer_id'));
		$this->db->order_by("xx_cv_shortlisted.created_date", "DESC");
		$query = $this->db->get();
		$module = array();
		if ($query->num_rows() > 0) 
		{
			$module = $query->result_array();
		}
		return $module;
	}
	
		
} // endClass
?>
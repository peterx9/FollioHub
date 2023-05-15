<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Account_Model extends CI_Model{

	//----------------------------------------------------------------------
	// Total Job Posted
	public function total_posted_job()
	{
		$this->db->where('employer_id', $this->session->userdata('employer_id'));
		return $this->db->count_all_results('xx_job_post');
	}


	//-------------------------------------------------------
	// Update New password
	public function update_password($data,$user_id)
	{
		$query = $this->db->get_where('xx_employers' , array('id' => $user_id));
		$result = $query->row_array();

		 $validPassword = password_verify($data['old_password'], $result['password']);

		if ($validPassword) {
			$this->db->where('id',$user_id);
			$this->db->update('xx_employers',array('password' => $data['password']));
			return true;
		}else{
			return false;
		}
		
	}

}

?>
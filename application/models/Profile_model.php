<?php  defined('BASEPATH') OR exit('No direct script access allowed');

class Profile_Model extends CI_Model{

	//-------------------------------------------------------
	// Get User detail
	public function get_user_by_id($id)
	{
		$query = $this->db->get_where('xx_users', array('id' => $id));
		return $result = $query->row_array();
	}

	//-------------------------------------------------------
	// Update user
	public function update_user($data,$id)
	{
		$this->db->where('id',$id);
		$this->db->update('xx_users',$data);
		return true;
	}

	//-------------------------------------------------------
	// Update Experience
	public function update_experience($data,$id)
	{
		$this->db->where('id',$id);
		$result = $this->db->get('xx_seeker_experience');
		if($result->num_rows() > 0)
		{
			$this->db->where('id',$id);
			$this->db->update('xx_seeker_experience',$data);
		}
		else
		{
			$this->db->insert('xx_seeker_experience',$data);
		}
		return true;
	}

	public function get_user_experience($user_id)
	{
		$query = $this->db->get_where('xx_seeker_experience', array('user_id' => $user_id));
		return $result = $query->result_array();
	}

	public function get_experience_by_id($id)
	{
		$query = $this->db->get_where('xx_seeker_experience', array('id' => $id));
		return $result = $query->row_array();
	}

	// ADD education

	public function add_user_education($data)
	{
		$this->db->insert('xx_seeker_education',$data);
		return true;
	}

	//-------------------------------------------------------
	// Get Applied Jobs
	public function update_education($data,$id)
	{
		$this->db->where('id',$id);
		$this->db->update('xx_seeker_education',$data);
		return true;
	}

	public function get_user_education($user_id)
	{
		$this->db->where('user_id',$user_id);
		return $this->db->get('xx_seeker_education')->result_array();
	}

	public function get_education_by_id($edu_id)
	{
		$this->db->where('id',$edu_id);
		return $this->db->get('xx_seeker_education')->row_array();
	}

	// LANGUAGE //

	public function add_user_language($data)
	{
		$this->db->insert('xx_seeker_languages',$data);
		return true;
	}

	//-------------------------------------------------------
	// Get Applied Jobs
	public function update_language($data,$id)
	{
		$this->db->where('id',$id);
		$this->db->update('xx_seeker_languages',$data);
		return true;
	}

	public function get_user_language($user_id)
	{
		$this->db->where('user_id',$user_id);
		return $this->db->get('xx_seeker_languages')->result_array();
	}

	public function get_language_by_id($lang_id)
	{
		$this->db->where('id',$lang_id);
		return $this->db->get('xx_seeker_languages')->row_array();
	}

	//-------------------------------------------------------
	// Update Skills
	public function update_skill($data,$id)
	{
		$this->db->where('id',$id);
		$this->db->insert('xx_seeker_skill',$data);
		return true;
	}

	//-------------------------------------------------------
	// Update Summery
	public function update_summary($data,$id)
	{
		$this->db->where('id',$id);
		$this->db->insert('xx_seeker_summary',$data);
		return true;
	}

	//-------------------------------------------------------
	// Update Language
	public function update_languages($data,$id)
	{
		$this->db->where('id',$id);
		$this->db->insert('xx_seeker_languages',$data);
		return true;
	}

	//-------------------------------------------------------
	// Checking Old password
	public function check_old_password($data,$id)
	{

		return 'working';
		/*$query = $this->db->get_where('xx_users' , array('id' => $id));
		$result = $query->row_array();

		echo $this->db->last_query();
		if ($result['password'] == $data['old_password']) {

			$this->db->where('id',$id);
			$this->db->update('xx_users',$data['password']);
			//return true;

		}else{
			//return false;
		}*/

	}

	//-------------------------------------------------------
	// Update New password
	public function update_password($data,$user_id)
	{
		$query = $this->db->get_where('xx_users' , array('id' => $user_id));
		$result = $query->row_array();

		if ($result['password'] == $data['old_password']) {
			$this->db->where('id',$user_id);
			$this->db->update('xx_users',array('password' => $data['password']));
			return true;
		}else{
			return false;
		}
		
	}


}// endClass
?>
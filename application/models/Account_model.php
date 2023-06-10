<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Account_Model extends CI_Model{

	//-------------------------------------------------------
	// Update New password
	public function update_password($data,$user_id)
	{
		$query = $this->db->get_where('xx_users' , array('id' => $user_id));
		$result = $query->row_array();

		 $validPassword = password_verify($data['old_password'], $result['password']);

		if ($validPassword) {
			$this->db->where('id',$user_id);
			$this->db->update('xx_users',array('password' => $data['password']));
			return true;
		}else{
			return false;
		}
		
	}

}

?>
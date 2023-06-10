<?php  defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_Model extends CI_Model{

	//----------------------------------------------------------------------
	// registration
	public function insert_employers($data)
	{
		$this->db->insert('xx_employers',$data);
		$last_id = $this->db->insert_id();
		return  $last_id;
	}

	//----------------------------------------------------------------------
	// Insert company
	public function insert_company($data)
	{
		$this->db->insert('xx_companies',$data);
		$last_id = $this->db->insert_id();
		return  $last_id;
	}

	//--------------------------------------------------------------------
	// Email Verification
	public function email_verification($code)
	{
		$this->db->select('firstname,lastname, email, token, is_active');
		$this->db->from('xx_employers');
		$this->db->where('token', $code);
		$query = $this->db->get();
		$result = $query->row_array();
		$match = count($result);
		if($match > 0){
			$this->db->where('token', $code);
			$this->db->update('xx_employers', array('is_verify' => 1, 'token'=> ''));
			return $result;
		}
		else{
			return false;
			}
	}

	//----------------------------------------------------------------------
	// login function
	public function login($data)
	{
		$query = $this->db->get_where('xx_employers', array('email' => $data['email']));
		if ($query->num_rows() == 0){
			return false;
		}
		else{
			//Compare the password attempt with the password we have stored.
			$result = $query->row_array();
		    $validPassword = password_verify($data['password'], $result['password']);
		    if($validPassword){
		        return $result = $query->row_array();
		    }
		}
	}

	//============ Check User Email ============
    function check_emp_mail($email)
    {
    	$result = $this->db->get_where('xx_employers', array('email' => $email));

    	if($result->num_rows() > 0){
    		$result = $result->row_array();
    		return $result;
    	}
    	else {
    		return false;
    	}
    }

    //============ Update Reset Code Function ===================
    public function update_reset_code($reset_code, $user_id)
    {
    	$data = array('password_reset_code' => $reset_code);
    	$this->db->where('id', $user_id);
    	$this->db->update('xx_employers', $data);
    }

    //============ Activation code for Password Reset Function ===================
    public function check_password_reset_code($code)
    {

    	$result = $this->db->get_where('xx_employers',  array('password_reset_code' => $code ));
    	if($result->num_rows() > 0){
    		return true;
    	}
    	else{
    		return false;
    	}
    }
    
    //============ Reset Password ===================
    public function reset_password($id, $new_password){
	    $data = array(
			'password_reset_code' => '',
			'password' => $new_password
	    );
		$this->db->where('password_reset_code', $id);
		$this->db->update('xx_employers', $data);
		return true;
    }

} // endClass

?>
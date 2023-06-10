<?php
class Mailer 
{
	function __construct()
	{
		$this->CI =& get_instance();
	}

	//=============================================================
    // Eamil Templates
    function mail_template($to = '',$slug = '',$mail_data = '')
    {

        $template =  $this->CI->db->get_where('xx_email_templates',array('slug' => $slug))->row_array();
        
        $body = $template['body'];

        $template_id = $template['id'];

        $data['head'] = $subject = $template['subject'];

        $data['content'] = $this->mail_template_variables($body,$slug,$mail_data);

        $data['title'] = $template['name'];

        $template =  $this->CI->load->view('admin/general_settings/email_templates/email_preview', $data,true);
        
        sendEmail($to,$subject,$template);

        return true;
    }

    //=============================================================
    // GET Eamil Templates AND REPLACE VARIABLES
    function mail_template_variables($content,$slug,$data = '')
    {

        switch ($slug) {
            case 'login-alert':
                $content = str_replace('{FULLNAME}',$this->CI->session->userdata('username'),$content);
                $content = str_replace('{TIMESTAMP}',date('F j, Y H:i:s'),$content);
                return $content;
            break;

            case 'email-verification':
                $content = str_replace('{TIMESTAMP}',date('F j, Y H:i:s'),$content);
                $content = str_replace('{VERIFICATION_LINK}','LINK HERE');
                return $content;
            break;

            case 'welcome':
                $content = str_replace('{FULLNAME}',$data['fullname'],$content);
                return $content;
            break;

            case 'forget-password':
                $content = str_replace('{NAME}',$data['fullname'],$content);
                $content = str_replace('{RESET_LINK}',$data['reset_link'],$content);
                return $content;
            break;

            case 'applicant-applied':
                $content = str_replace('{JOB_TITLE}',$data['job_title'],$content);
                return $content;
            break;
            
            case 'job-applied':
                $content = str_replace('{JOB_TITLE}',$data['job_title'],$content);
                return $content;
            break;

            case 'general-notification':
                $content = str_replace('{CONTENT}',$data['content'],$content);
                return $content;
            break;

            case 'candidate-shortlisted':
                $content = str_replace('{JOB_TITLE}',$data['job_title'],$content);
                return $content;
            break;
            
            default:
                # code...
                break;
        }
    }
    
    //=============================================================
    // VERIFICATION EMAIL
    // type - EMPLOYER / USER , ID - USER ID / EMPLOYER ID
    
    function send_verification_email($id,$type = '')
    {
        if($type == 'employer')
        {
            $user = $this->CI->db->get_where('xx_employers',array('id' => $id))->row_array();
        }
        
        if($type == 'user' || $type == '')
        {
            $user = $this->CI->db->get_where('xx_users',array('id' => $id))->row_array();
        }
        
        $token = $user['token'];
        
        if($type == 'employer')
        $varification_link = base_url('employers/auth/verify/'.$token);
        
        if($type == 'user' || $type == '')
        $varification_link = base_url('auth/verify/'.$token);


        // Get Email Template
        $temp =  $this->CI->db->get_where('xx_email_templates',array('slug' => 'email-verification'))->row_array();

        $to = $user['email'];

        $data['content'] = str_replace('{VERIFICATION_LINK}',$varification_link,$temp['body']);

        $data['head'] = $temp['subject'];

        $data['title'] = $temp['name'];
        
        $template =  $this->CI->load->view('admin/general_settings/email_templates/email_preview', $data,true);
        
        sendEmail($to,$temp['subject'],$template);

        return true;
    } 
    
    //=============================================================
    // NEWSLETTER
    function send_newsletter($to,$subject,$body)
    {
        $data['content'] = $body;

        $data['head'] = $data['title'] = $subject;

        // $data['title'] = '';
        
        $template =  $this->CI->load->view('admin/general_settings/email_templates/email_preview', $data,true);
        
        sendEmail($to,$subject,$template);

        return true;
    } 

	//=============================================================
	function registration_email($username, $email_verification_link)
	{
        $login_link = base_url('auth/login');  

		$tpl = '<h3>Hi ' .strtoupper($username).'</h3>
            <p>Welcome to Onjob!</p>
            <p>Your Account Has been Created Successfully. :</p>  
			<p>Active your account with the link above and start your Career :</p>  
            <p>'.$email_verification_link.'</p>
            
            <br>
            <br>

            <p>Regards, <br> 
               Onjob Team <br> 
            </p>
    ';
		return $tpl;		
	}

	//=============================================================
	function pwd_reset_link($username, $reset_link)
	{
		$tpl = '<h3>Hi ' .strtoupper($username).'</h3>
            <p>Welcome to OnJob!</p>
            <p>We have received a request to reset your password. If you did not initiate this request, you can simply ignore this message and no action will be taken.</p> 
            <p>To reset your password, please click the link below:</p> 
            <p>'.$reset_link.'</p>

            <br>
            <br>

            <p>© 2019 Onjob - All rights reserved</p>
    ';
		return $tpl;		
	}

	

}
?>
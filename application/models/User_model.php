<?php
class user_model extends CI_Model
{
    function __construct()
    {

        parent::__construct();
    }

    // Call login
    function login($uname, $upsd){
        $query=$this->db->query("SELECT * FROM users WHERE _EMAIL= '".$uname."' AND _PASSWORD= '".$upsd."'");
        if($query->num_rows()>0){
            return $query->row_array();
        }
        else
        {
            return "UNAVAILABLE";
        }
    }	
  
    //insert into user table
    function saveuser($data)
    {
        $this->db->insert('users', $data);
        $insert_id = $this->db->insert_id();
        return  $insert_id;
    }  
  
    //send verification email to user's email id
    function sendEmail($to_email)
    {
        $from_email = 'thileepinfo@gmail.com'; //change this to yours
        $subject = 'Verify Your Email Address';
        $message = 'Dear User,<br /><br />Please click on the below activation link to verify your email address.
<br /><br /> /signup/verify/' . md5($to_email) . '<br /><br /><br />Thanks<br />Classifieds Team';
        //configure email settings
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'ssl://smtp.gmail.com'; //smtp host name
        $config['smtp_port'] = '465'; //smtp port number
        $config['smtp_user'] = $from_email;
        $config['smtp_pass'] = 'T9842109952'; //$from_email password
        $config['mailtype'] = 'html';
        $config['charset'] = 'iso-8859-1';
        $config['wordwrap'] = TRUE;
        $config['newline'] = "\r\n"; //use double quotes
        $this->email->initialize($config);        
        //send mail
        $this->email->from($from_email, 'Classifieds');
        $this->email->to($to_email);
        $this->email->subject($subject);
        $this->email->message($message);
        return $this->email->send();
    }

    //activate user account
    function verifyEmailID($key)
    {
        $data = array('status' => 1);
        $this->db->where('md5(email)', $key);
        return $this->db->update('users', $data);
    }

    function select_user(){
        $res = $this->db->get('users')->result_array();		
        return $res;
    }

    //Forgot Password
    public function ForgotPassword($email)
    {
        $this->db->select('_EMAIL');
        $this->db->from('users'); 
        $this->db->where('_EMAIL', $email); 
        $query=$this->db->get();		
        return $query->row_array();
    }


    //Edit profile
    public function update_user_profile($data,$user_id){	   
        $this->db->where('_ID',$user_id);
        return $this->db->update('users', $data);	   
    }

    public function get_user_data($user_id){
        $this->db->select('*');
        $this->db->from('users'); 
        $this->db->where('_ID', $user_id); 
        $query=$this->db->get();		
        return $query->row_array();
    }

    public function update_user_status($user_id){	   
        $this->db->where('_ID',$user_id);
        return $this->db->update('users', array('_STATUS'=>'1'));	   
    }
}
?>
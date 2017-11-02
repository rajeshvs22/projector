<?php
class Profile extends Admin_Controller {

    //this is used when editing or adding a provider
    var $board_id = false;
    var $condition = array();

    function __construct() {
        parent::__construct();
        
        
        $this->load->library(array('auth'));
    }

    function edit_profile() {
	
	    $image_file_notsupported = true;
		
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        $data['page_title'] = 'Edit Profile';

        
        

        $this->admin_id = $this->auth_session['id'];
        
     
        $userResult = $this->auth->get_admin($this->admin_id);
        
       
                
        $data['id']         = $userResult->id;
        $data['firstname']  = $userResult->first_name;
        $data['lastname']   = $userResult->last_name;
        $data['email']      = $userResult->admin_email;
        $data['phone']      = $userResult->company_mobile;
    
            


        $this->form_validation->set_rules('first_name', 'first_name', 'trim|max_length[32]');
        $this->form_validation->set_rules('last_name', 'first_name', 'trim|max_length[32]');
        //$this->form_validation->set_rules('email', 'email', 'trim|required|valid_email|max_length[128]|callback_check_email');


        //if this is a new account require a password, or if they have entered either a password or a password confirmation
       
        if ($this->form_validation->run() == FALSE) {
            $this->load->view($this->config->item('admin_folder') . '/profile-form', $data);
        } else {
                       
            $save['id']            = $this->admin_id;
            $save['first_name']    = $this->input->post('firstname');
            $save['last_name']     = $this->input->post('lastname');
            //$save['admin_email']         = $this->input->post('email');
            $save['company_mobile']        = $this->input->post('phone');
			
			
            $admin_session = get_session_data();
            $aaa['admin'] = $admin_session;
            $aaa['admin']['name'] = $save['first_name'].' '.$save['last_name'];
            
           $this->session->set_userdata($aaa);
           //echo "<pre>";print_r($admin_session);exit;
            //$save['user_modified_on']   = date('Y-m-d H:i:s');
            //$save['user_modified_by']   = $this->auth_session['id'];
			
			
			if(is_uploaded_file($_FILES["fileToUpload"]["tmp_name"]))
			{
		    
			$filename = $_FILES["fileToUpload"]["name"];
			$ext = strtolower(substr(strrchr($filename, '.'), 1)); //Get extension
			
			if($ext =="png"|| $ext =="jpg" )
			{
			$image_name = $this->admin_id . '.' . $ext; //New image name

			
		    $png_image =substr_replace($image_name , 'png', strrpos($image_name, '.') +1);// extention change into png

			// $extention[1];
			
			move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], "./uploads/admin_profile/".$png_image);
			
			$save['user_img']           =  $png_image ;
			
			
			
			}else
				{
				   $image_file_notsupported = false;
					}
			}
			
            $this->auth->save($save);
			
			if($image_file_notsupported){
				$this->session->set_flashdata('message', "Profile Succesfully Updated");			
			}else{
				$this->session->set_flashdata('error', "image file should be png or jpg");
			}
			
			
                        
            

            //go back to the customer list
            redirect($this->config->item('admin_folder') . '/profile/edit_profile');
        }
    }
    
    function check_email($str) {
        
        $email = $this->auth->check_email($str , $this->auth_session['id']);
        if ($email) {
            $this->form_validation->set_message('check_email', lang('error_email'));
            return FALSE;
        } else {
            return TRUE;
        }
    }
    
    
    
   

}
?>
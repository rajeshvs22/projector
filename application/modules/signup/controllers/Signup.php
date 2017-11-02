<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Signup extends CI_Controller {

    function __construct() {
        parent::__construct();
        ob_start();
        $this->load->helper(array('form','rajutility'));
        $this->load->library(array('form_validation', 'email'));
        $this->form_validation->CI =& $this;
        $this->load->database();
        $this->load->model('user_model');
        $this->load->library('auth_member');   
        $this->load->library('facebook');

        $this->load->model('user_model');
        $this->load->model('home_banner_model');
        $this->load->model('email_model');
        $this->load->model('product_model');
        $this->load->database();
        $this->load->library('session');
   }

    /*     * *default functin, redirects to login page if no admin logged in yet** */
    
    
    public function index(){

        // Include the google api php libraries
        include_once APPPATH."libraries/google-api-php-client/Google_Client.php";
        include_once APPPATH."libraries/google-api-php-client/contrib/Google_Oauth2Service.php";
        // Google Project API Credentials
        $clientId = '206494637739-l5mntnf1k2j3eejeeojlmq5sffbqr2ju.apps.googleusercontent.com';
        $clientSecret = '8Btr6hj0xF2ZptC_r2K_xIqo';
        $redirectUrl = base_url() . 'signin/';
        $simple_api_key = 'AIzaSyBrmXTwiSSpSQPEWyOWJ7olPox2Zwnl2bo';
        // Google Client Configuration
        $gClient = new Google_Client();
        $gClient->setApplicationName('Login to codexworld.com');
        $gClient->setClientId($clientId);
        $gClient->setClientSecret($clientSecret);
        $gClient->setRedirectUri($redirectUrl);
        $gClient->setDeveloperKey($simple_api_key);
        $google_oauthV2 = new Google_Oauth2Service($gClient);
        $this->load->helper('rajutility');
        //find out if they're already logged in, if they are redirect them to the my account page
        $redirect = $this->auth_member->is_logged_in(false, false); 
        
        //if they are logged in, we send them back to the my_account by default, if they are not logging in
        if ($redirect) {
            redirect(site_url('home'));
        }
        $data['username'] = '';
        $data['password'] = '';
        $data['isiteuserid'] = '';
        $data['title'] = 'Signin';        
        $data['redirect'] = $this->session->flashdata('redirect');
        $submitted = $this->input->post('submitted');
        //$data['latest_products'] = $this->product_model->get_lated_viewed(3,0);
        $userData = array();
        /************************** Start FaceBook ***********************/
        // Check if user is logged in
        if (is_string($this->facebook->is_authenticated())) {
            // Get user facebook profile details
            $userProfile = $this->facebook->request('get', '/me?fields=id,first_name,last_name,email,gender,locale,picture');
            // Preparing data for database insertion
            $userData['oauth_provider'] = 'facebook';
            if($userProfile['id'] != ''){
                $userData['oauth_uid'] = $userProfile['id'];
            }
            $userData['_NAME'] = $userProfile['first_name'].' '.$userProfile['last_name'];
            if($userProfile['email']!=''){
                $userData['_EMAIL'] = $userProfile['email'];
            }
            if($userProfile['gender'] !=''){
                $userData['gender'] = $userProfile['gender'];
            }
            if($userProfile['locale'] !=''){
                $userData['locale'] = $userProfile['locale'];
            }
            if($userProfile['id'] !=''){
                $userData['profile_url'] = 'https://www.facebook.com/' . $userProfile['id'];
            }
            if($userProfile['picture']['data']['url'] !=''){
                $userData['picture_url'] = $userProfile['picture']['data']['url'];
            }
            // Insert or update user data
            $userID = $this->auth_member->login_facebook_auth($userData);
            // Check user data insert or update status
            if ($userID) {
                redirect(site_url('home'));
            }
            // Get logout URL
            $data['logoutUrl'] = $this->facebook->logout_url();
        } else {
            $fbuser = '';
            // Get login URL
            $data['authFaceBookUrl'] = $this->facebook->login_url();
        }
        /************************ End Facebook ***********/
        /************************ Start Google ***********/
        if (isset($_GET['code'])) {
            $gClient->authenticate();
            $this->session->set_userdata('token', $gClient->getAccessToken());
            redirect($redirectUrl);
        }
        $token = $this->session->userdata('token');
        if (!empty($token)) {
            $gClient->setAccessToken($token);
        }
        if ($gClient->getAccessToken()) {
            $userProfile = $google_oauthV2->userinfo->get();
            // Preparing data for database insertion           
            $userData['oauth_provider'] = 'google';
            if($userProfile['id'] != ''){
                $userData['oauth_uid'] = $userProfile['id'];
            }
            if($userProfile['given_name'] != ''){
                $userData['_NAME'] = $userProfile['given_name'].' '.$userProfile['family_name'];
            }
            if($userProfile['email'] != ''){
                $userData['_EMAIL'] = $userProfile['email'];
            }
            if($userProfile['locale'] != ''){
                $userData['locale'] = $userProfile['locale'];
            }
            if($userProfile['link'] != ''){
                $userData['profile_url'] = $userProfile['link'];
            }
            if($userProfile['picture'] != ''){
                $userData['picture_url'] = $userProfile['picture'];
            }
            // Insert or update user data
            // Insert or update user data
            $userID = $this->auth_member->login_facebook_auth($userData);
            // Check user data insert or update status
            if ($userID) {
                redirect(site_url('home'));
            }
        } else {
            $data['authGoogleUrl'] = $gClient->createAuthUrl();
        }
        /************************ End Google *************/

        
        //$this->load->helper('security');
        $redirect = $this->auth_member->is_logged_in(false, false);
        
        //if they are logged in, we send them back to the myaccount by default
        if ($redirect) {
            redirect(site_url());
        }
        
        $data['firstname'] = $this->input->post('firstname');
        $data['lastname'] = $this->input->post('lastname');
        $data['email'] = $this->input->post('email');
        $data['mobile'] = $this->input->post('mobile');
        $data['zipcode'] = $this->input->post('zipcode');      
        $data['password'] = $this->input->post('password');
        $data['is_agree'] = $this->input->post('is_agree');

        $data['title'] = "Home | World’s Largest Classifieds Portal";
        
        //set validation rules
        $this->form_validation->set_rules('username', 'Name', 'trim|required|alpha');
        $this->form_validation->set_rules('email', 'Email ID', 'trim|required|valid_email|callback_emailexists');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        $this->form_validation->set_rules('cpassword', 'Confirm Password','trim|required|matches[password]');
        $this->form_validation->run($this);
        if ($this->form_validation->run() == FALSE) {
            //if they have submitted the form already and it has returned with errors, reset the redirect       
            $data['error'] = validation_errors();
            $this->load->view('include/header', $data);
            $this->load->view('signup');
            $this->load->view('include/footer');
            
        } else {
            //insert the user registration details into database
            
            $data = array(
                '_ROLE' => 2,
                '_NAME' => $this->input->post('username'),
                '_EMAIL' => $this->input->post('email'),
                '_MOBILE' => $this->input->post('mobile'),
                '_ZIPCODE' => $this->input->post('zipcode'),
                '_PASSWORD' => sha1($this->input->post('password'))
            );
            
            $insert_id = $this->user_model->saveuser($data);
            
            if($insert_id){
                $this->session->set_flashdata('message', 'Registered successfully');
                //Email trigger function
                $login = $this->auth_member->login_auth($this->input->post('email'), $this->input->post('password') );
                redirect(site_url('home'));
            }else{
                $this->session->set_flashdata('message', 'Oops! Error.  Please try again later!!!');
                redirect(site_url('signup'));
            }
            
        }
    }
    
    function ajax_register(){
        $redirect ='';
        if($this->input->post('firstname') == '' || $this->input->post('email') == '' || $this->input->post('password') == ''){
            $data['redirect'] = $redirect;
            $data['message'] = '<div class="alert alert-danger"><a class="close" data-dismiss="alert">x</a>Please fill the mandatory fields</div>';
            $data['status'] = 3;
            echo json_encode($data);exit;
        }
        $email_exists = $this->auth_member->check_field_already_in_use($this->input->post('email'),'_EMAIL');
        if ($email_exists) {                
            $data['redirect'] = $redirect;
            $data['message'] = '<div class="alert alert-danger"><a class="close" data-dismiss="alert">x</a>Email Already Exists</div>';
            $data['status'] = 0;
            echo json_encode($data);exit;
        } 
        $save = array(
            '_ROLE' => 2,
            '_NAME' => $this->input->post('firstname').' '.$this->input->post('lastname'),
            '_EMAIL' => $this->input->post('email'),
            '_MOBILE' => $this->input->post('mobile'),
            '_ZIPCODE' => $this->input->post('zipcode'),
            '_PASSWORD' => sha1($this->input->post('password')),
            'oauth_provider' => 'Manual'
        );

        $insert_id = $this->user_model->saveuser($save);
        if($insert_id){   
            $data['redirect'] = base_url();
            $data['status'] = 1;
            $data['message'] = '<div class="alert alert-info"><a class="close" data-dismiss="alert">x</a>Registered successfully Kindly check your Email</div>';
            $this->email->clear();
            $mailtmpquy = $this->db->query("SELECT * FROM `tbl_email_template` WHERE `tplid`='3'");  
            $res = $mailtmpquy->result_array();
            $name = $save['_NAME'];
            $this->load->library('email');
            $this->email->set_mailtype('html');
            $this->email->from('vijaya@aryvart.com', 'Reload');
            $this->email->to($save['_EMAIL']);
            $this->email->subject($res[0]['tplsubject']);  
            $strvariable = str_replace("{NAME}",$name, $res[0]['tplmessage']);             
            $newstring = '<table width="300" border="0" cellpadding="0" cellspacing="0" align="center" style="line-height:26px;font-family:Arial, sans-serif; margin-top:15px;"><tr><td data-bgcolor="" style=" font-size: 16px; color: #4ED5D5; line-height:24px; border-radius:4px" height="50" valign="middle" width="300" align="center" ><a href="'.base_url().'signin/activate?id='.$insert_id.'" style="font-size: 16px; text-decoration:none; color: #4ED5D5; line-height:22px; font-weight:700;text-transform:uppercase;letter-spacing:0.9px;">Activate  Account</a></td></tr><tr><td valign="middle"><span href="#" style="text-decoration: none;font-size: 15px; color: #6D6D6D; font-family:Arial, sans-serif;margin-top:15px;"><p>Click or copy the link to activate your Reload account if button is not clickable.</p><a href="'.base_url().'signin/activate?id='.$insert_id.'" style="color:#3fd5d5;">'.base_url().'signin/activate?id='.$insert_id.'</a></span></td></tr></table>';
            $strvariable = $strvariable . ' ' .$newstring;
            $this->email->message($strvariable);
            $send_mail = $this->email->send();
            $login = $this->auth_member->login_auth($this->input->post('email'), $this->input->post('password') );
        }else{
            $data['redirect'] = $redirect;
            $data['message'] = '<div class="alert alert-danger"><a class="close" data-dismiss="alert">x</a>Oops! Error.  Please try again later!!!</div>';
            $data['status'] = 0;
        }
        echo json_encode($data);exit;
    }
    
    
    

    function success() {
        $data['title'] = "Congratulations | World’s Largest Classifieds Portal";
        $this->load->view('include/header', $data);
        $this->load->view('regsuccess');
        $this->load->view('include/footer');
    }
    
    function emailexists($str) {   
        
                $mobile = $this->auth_member->check_field_already_in_use($str,'_EMAIL');

                if ($mobile) {
                    $this->form_validation->set_message('emailexists', 'email alreday in use.');
                    return FALSE;
                } else {
                    return TRUE;
                }
        }

    /*     * *verify *** */

//    function verify($hash = NULL) {
//        if ($this->user_model->verifyEmailID($hash)) {
//            $this->session->set_flashdata('verify_msg', '<div class="alert alert-success text-center">Your Email Address is successfully verified! Please login to access your account!</div>');
//            redirect('signin');
//        } else {
//            $this->session->set_flashdata('verify_msg', '<div class="alert alert-danger text-center">Sorry! There is error verifying your Email Address!</div>');
//            redirect('signup');
//        }
//    }

    /*     * *DEFAULT NOR FOUND PAGE**** */

    function four_zero_four() {
        $this->load->view('404');
    }

    /*     * *RESET AND SEND PASSWORD TO REQUESTED EMAIL*** */

    function reset_password() {
        
    }

    /*******LOGOUT FUNCTION ****** */

    function logout() {
        
        $this->load->helper(array('rajutility'));
        $this->facebook->destroy_session();
        $this->session->unset_userdata('token');
        $this->auth_member->logout();
        redirect(site_url());
    }

}?>
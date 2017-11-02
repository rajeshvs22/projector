<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Signin extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        ob_start();
        $this->load->helper(array('form','rajutility'));
        $this->load->library('form_validation','email');
        $this->load->model('user_model');
        $this->load->database();
        $this->load->library('session');
        $this->load->library('auth_member');
        // Load facebook library
        $this->load->library('facebook');
        $data['title'] = "Jofferz | Signin ";
    }
    
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
        //echo "<pre>";print_r($this->facebook->is_authenticated());exit;
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
            //$userData['gender'] = $userProfile['gender'];
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

        $this->load->view('include/header');

        $this->load->view('signin',$data);		

        $this->load->view('include/footer');
    }
    
    
    function ajax_login(){       
        $email    = $this->input->post('email');
        $password = $this->input->post('password');
        $data = array();           
        $login = $this->auth_member->login_auth($email, $password);
        $redirect ='';
        if ($login=='1') {
            if ($redirect == '') {
                //if there is not a redirect link, send them to the my account page                    
                $redirect = site_url('home');
            }
            //to login via ajax
            //redirect($redirect);
            $data['redirect'] = $redirect;
            $data['status'] = 1;
            $data['message'] = '<div class="alert alert-info"><a class="close" data-dismiss="alert">x</a>Login Successfully!!</div>';
        } if ($login=='0') {
            //this adds the redirect back to flash data if they provide an incorrect credentials
            $data['redirect'] = $redirect;
            $data['message'] = '<div class="alert alert-danger"><a class="close" data-dismiss="alert">x</a>Enter Mail and password correctly</div>';
            $data['status'] = 0;
            //redirect('signin');
        }    
        if ($login=='2') {
            //this adds the redirect back to flash data if they provide an incorrect credentials
            $data['redirect'] = $redirect;
            $data['message'] = '<div class="alert alert-danger"><a class="close" data-dismiss="alert">x</a>Activate your account</div>';
            $data['status'] = 0;
            //redirect('signin');
        }         
        echo json_encode($data);exit;        
    }
    
    /*     * *validate login*** */
    function _validate_login($str) {
    }
    
    /*     * *DEFAULT NOR FOUND PAGE**** */
    function four_zero_four() {
        $this->load->view('404');
    }
    
    /*     * *RESET AND SEND PASSWORD TO REQUESTED EMAIL*** */
    function reset_password() {
    }
    
    public function ForgotPassword()
    {
        $email = $this->input->post('email');      
        $forgot=$this->email_model->forgot_password_mail($email); 
        if($forgot=='success')
        {
            $this->session->set_flashdata('message', 'Check Your Email Inbox');
            $data['status'] = '1';
            $data['message'] = '<div class="alert alert-info"><a class="close" data-dismiss="alert">x</a>Check Your Email Inbox</div>';
            echo json_encode($data);exit;
        }
        if($forgot=='fails')
{
            $this->session->set_flashdata('message', 'Not a valid  Email Id');
            $data['status'] = '0';
            $data['message'] = '<div class="alert alert-danger"><a class="close" data-dismiss="alert">x</a>Not a valid  Email Id</div>';
            echo json_encode($data);exit;
}
        if($forgot=='activate')
{
            $this->session->set_flashdata('message', 'Please activate account');
            $data['status'] = '0';
            $data['message'] = '<div class="alert alert-danger"><a class="close" data-dismiss="alert">x</a>Please activate account</div>';
            echo json_encode($data);exit;
}
    }
    
    public function activate()
    {
        $this->session->set_flashdata('message', 'Check Your Email Id');
        $user_id = $this->input->get('id');      
        $status=$this->user_model->update_user_status($user_id); 
        if($status)
        {
            redirect(base_url());
        }
    }


}
?>

<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Auth_member {
    var $CI;
    //this is the expiration for a non-remember session
    var $session_expire = 600;
    
    function __construct() {
        $this->CI = & get_instance();
        $this->CI->load->database();
        $this->CI->load->library('encrypt');

        $this->CI->load->helper('url');
    }

    function is_logged_in($redirect = false, $default_redirect = true) {

        $member = $this->CI->session->userdata('member');
        if (!$member) {
            if ($redirect) {
                $this->CI->session->set_flashdata('redirect', $redirect);
            }
            if ($default_redirect) {
                redirect(site_url());
            }
            return false;
        } else {
            //check if the session is expired if not reset the timer
            if ($member['expire'] && $member['expire'] < time()) {
                $this->logout();
                if ($redirect) {
                    $this->CI->session->set_flashdata('redirect', $redirect);
                }
                if ($default_redirect) {
                    redirect(site_url('signin'));
                }
                return false;
            } else {
                //update the session expiration to last more time if they are not remembered
                if ($member['expire']) {
                    $member['expire'] = time() + $this->session_expire;
                    $this->CI->session->set_userdata(array('member' => $member));
                }
            }
            return true;
        }
    }
    
    
    /*this function does the logging in.*/
    function login_auth($email, $password, $remember = false) {
        $this->CI->db->select('*');
        $this->CI->db->where('_EMAIL', $email);
        $this->CI->db->where('_PASSWORD', sha1($password));
        $this->CI->db->limit(1);
        $result = $this->CI->db->get('users');
        $result = $result->row_array();
        if (sizeof($result) > 0) {

        $this->CI->db->select('*');
        $this->CI->db->where('_EMAIL', $email);
        $this->CI->db->where('_PASSWORD', sha1($password));
        $this->CI->db->where('_STATUS', '1');
        $this->CI->db->limit(1);
        $result = $this->CI->db->get('users');
        $result = $result->row_array();
          if (sizeof($result) > 0) {

            $member = array();
            $member['member'] = array();
            $member['member']['client_logged_in'] = true;
            $member['member']['id'] = $result['_ID'];
            $member['member']['name'] = $result['_NAME'];
            $member['member']['email'] = $result['_EMAIL'];
            $member['member']['role'] = $result['_ROLE'];
            $member['member']['phone'] = $result['_MOBILE'];
            $member['member']['zipcode'] = $result['_ZIPCODE'];
            if (!$remember) {
                $member['member']['expire'] = time() + $this->session_expire;
            } else {
                $member['member']['expire'] = false;
            }
            $this->CI->session->set_userdata($member);
            return 1;
          }
          else {
            return 2;
          }
        }      
        else {
            return 0;
        }
    }
    
    /** Login with facebook*/
    function login_facebook_auth($data = array() , $remember = '') {
        $this->CI->db->from('users');
        $this->CI->db->where(array('oauth_provider'=>$data['oauth_provider'],'oauth_uid'=>$data['oauth_uid']));
        $prevQuery = $this->CI->db->get();
        $prevCheck = $prevQuery->num_rows();
        if ($prevCheck > 0) {
            //Login
            $result = $prevQuery->row_array();
            $member = array();
            $member['member'] = array();
            $member['member']['client_logged_in'] = true;
            $member['member']['id'] = $result['_ID'];
            $member['member']['name'] = $result['_NAME'];
            $member['member']['email'] = $result['_EMAIL'];
            $member['member']['role'] = $result['_ROLE'];
            $member['member']['phone'] = $result['_MOBILE'];
            $member['member']['zipcode'] = $result['_ZIPCODE'];
            if (!$remember) {
                $member['member']['expire'] = time() + $this->session_expire;
            } else {
                $member['member']['expire'] = false;
            }
            $this->CI->session->set_userdata($member);
            return true;
        } else {
            //Register
        $email_exists = $this->check_field_already_in_use($data['_EMAIL'],'_EMAIL');
        if ($email_exists) {          
         $this->CI->session->set_flashdata('socialloginerror', 'Email Already Exists..!');     
         $this->CI->session->unset_userdata('token');
         $this->CI->session->unset_userdata('member');
         $this->CI->facebook->destroy_session();
         redirect(base_url());
        } 

            $insert = $this->CI->db->insert('users',$data);
            $userID = $this->CI->db->insert_id();
            $member = array();
            $member['member'] = array();
            $member['member']['client_logged_in'] = true;
            $member['member']['id'] = $userID;
            $member['member']['name'] = $data['_NAME'];
            $member['member']['email'] = $data['_EMAIL'];
            $member['member']['role'] = 1;
            $member['member']['phone'] = $data['_MOBILE'];
            $member['member']['zipcode'] = $data['_ZIPCODE'];
            if (!$remember) {
                $member['member']['expire'] = time() + $this->session_expire;
            } else {
                $member['member']['expire'] = false;
            }
            $this->CI->session->set_userdata($member);
            return true;
        }
    }
    
    /*this function does the logging out*/
    function logout() {
        $this->CI->session->unset_userdata('member');
    }
    
/**
* param 1 : form data
* param 2 : DB field
* param 3 : current user id
*/
    
    function check_field_already_in_use($str,$db_field ,$id=false)
    {
        $this->CI->db->select($db_field);
        $this->CI->db->from('users');
        $this->CI->db->where($db_field, $str);
        if ($id)
        {
            $this->CI->db->where('_ID !=', $id);
        }
        $count = $this->CI->db->count_all_results();
        if ($count > 0){
            return true;
        }else{
            return false;
        }
    }
    
    function check_email($str, $id = false) {
        $this->CI->db->select('user_email ');
        $this->CI->db->from('tbl_school_user');
        $this->CI->db->where('user_email', $str);
        if ($id) {
            $this->CI->db->where('user_id !=', $id);
        }
        $count = $this->CI->db->count_all_results();
        if ($count > 0) {
            return true;
        } else {
            return false;
        }
    }
    
    function check_username($str, $id = false) {
        $this->CI->db->select('user_name');
        $this->CI->db->from('tbl_school_user');
        $this->CI->db->where('user_name', $str);
        if ($id) {
            $this->CI->db->where('user_id !=', $id);
        }
        $count = $this->CI->db->count_all_results();
        if ($count > 0) {
            return true;
        } else {
            return false;
        }
    }
    
}
?>

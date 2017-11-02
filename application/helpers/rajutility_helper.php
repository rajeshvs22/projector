 <?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

 function get_session_data(){
        $CI = & get_instance();  //get instance, access the CI superobject
        $admin = $CI->session->userdata('admin');
        return $admin;
    }
    
    function get_memner_session_data(){
        $CI = & get_instance();  //get instance, access the CI superobject
        $member = $CI->session->userdata('member');
        return $member;
    }
    function is_admin(){
        
        $admin = get_session_data();
        
        if($admin['role'] == 1){
            return true;
        }else{
            return false;            
        }
    }
    
      function is_member(){
        
        $admin = get_memner_session_data();
        
        if($admin['name'] != ''){
            return true;
        }else{
            return false;            
        }
    }
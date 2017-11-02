<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Auth {

    var $CI;
    //this is the expiration for a non-remember session
    var $session_expire = 600000;

    function __construct() {
        $this->CI = & get_instance();
        $this->CI->load->database();
        $this->CI->load->library('encrypt');
//		
//		$session_config = array(
//		    'sess_cookie_name' => 'session_config',
//		    'sess_expiration' => 0
//		);
//		$this->CI->load->library('session', $session_config, 'session');
//		$this->CI->load->add_package_path(APPPATH . 'themes/' . $this->CI->config->item('theme') . '/');

        $this->CI->load->helper('url');
    }

    /*
      this checks to see if the admin is logged in
      we can provide a link to redirect to, and for the login page, we have $default_redirect,
      this way we can check if they are already logged in, but we won't get stuck in an infinite loop if it returns false.
     */
    /*
      This function takes admin array and inserts/updates it to the database
     */

    function save($admin) {

        if ($admin['id']) {
            $this->CI->db->where('id', $admin['id']);
            $this->CI->db->update('tbl_admin', $admin);
        } else {
            $this->CI->db->insert('tbl_admin', $admin);
        }
    }

    function is_logged_in($redirect = false, $default_redirect = true) {

        //var_dump($this->CI->session->userdata('session_id'));
        //$redirect allows us to choose where a customer will get redirected to after they login
        //$default_redirect points is to the login page, if you do not want this, you can set it to false and then redirect wherever you wish.

        $admin = $this->CI->session->userdata('admin');
        //print_r($admin);die;

        if (!$admin) {
            if ($redirect) {
                $this->CI->session->set_flashdata('redirect', $redirect);
            }

            if ($default_redirect) {
                redirect(site_url('admin/login'));
            }

            return false;
        } else {

            //check if the session is expired if not reset the timer
            if ($admin['expire'] && $admin['expire'] < time()) {

                $this->logout();
                if ($redirect) {
                    $this->CI->session->set_flashdata('redirect', $redirect);
                }

                if ($default_redirect) {
                    redirect(site_url('admin/login'));
                }

                return false;
            } else {

                //update the session expiration to last more time if they are not remembered
                if ($admin['expire']) {
                    $admin['expire'] = time() + $this->session_expire;
                    $this->CI->session->set_userdata(array('admin' => $admin));
                }
            }

            return true;
        }
    }

    /*
      this function does the logging in.
     */

    function login_admin($email, $password, $remember = false) {
        $this->CI->db->select('*');
        $this->CI->db->where('admin_email', $email);
        $this->CI->db->where('admin_password', sha1($password));
        $this->CI->db->limit(1);
        $result = $this->CI->db->get('tbl_admin');

        //print_r($result);die;
        $result = $result->row_array();

        if (sizeof($result) > 0) {
            $admin = array();
            $admin['admin'] = array();
            $admin['admin']['admin_logged_in'] = true;
            $admin['admin']['id'] = $result['id'];
            $admin['admin']['name'] = $result['first_name'] . ' ' . $result['last_name'];
            $admin['admin']['admin_email'] = $result['admin_email'];
            $admin['admin']['admin_img'] = $result['admin_img'];

            if (!$remember) {
                $admin['admin']['expire'] = time() + $this->session_expire;
            } else {
                $admin['admin']['expire'] = false;
            }

            $this->CI->session->set_userdata($admin);
            return true;
        } else {

            return false;
        }
    }

    /*
      this function does the logging out
     */

    function logout() {
        $this->CI->session->unset_userdata('admin');
        //$this->CI->session->sess_destroy();
    }

    /*
      This function gets an individual admin
     */

    function get_admin($id) {
        $this->CI->db->select('*');
        $this->CI->db->where('id', $id);
        $result = $this->CI->db->get('tbl_admin');
        $result = $result->row();

        return $result;
    }

    function check_email($str, $id = false) {
        $this->CI->db->select('admin_email ');
        $this->CI->db->from('tbl_admin');
        $this->CI->db->where('admin_email', $str);
        if ($id) {
            $this->CI->db->where('id !=', $id);
        }
        $count = $this->CI->db->count_all_results();

        if ($count > 0) {
            return true;
        } else {
            return false;
        }
    }

//    function check_username($str, $id = false) {
//        $this->CI->db->select('user_name');
//        $this->CI->db->from('tbl_admin');
//        $this->CI->db->where('user_name', $str);
//        if ($id) {
//            $this->CI->db->where('user_id !=', $id);
//        }
//        $count = $this->CI->db->count_all_results();
//
//        if ($count > 0) {
//            return true;
//        } else {
//            return false;
//        }
//    }
//    function check_field_already_in_use($str, $db_field, $id = false) {
//        $this->CI->db->select($db_field);
//        $this->CI->db->from('users');
//        $this->CI->db->where($db_field, $str);
//        if ($id) {
//            $this->CI->db->where('_ID !=', $id);
//        }
//        $count = $this->CI->db->count_all_results();
//
//        if ($count > 0) {
//            return true;
//        } else {
//            return false;
//        }
//    }
}
?>
<?php
class change_password extends Admin_Controller {

    //this is used when editing or adding a provider
    var $user_id = false;
    var $condition = array();

    function __construct() {
        parent::__construct();

        
    }

    function index() {
        $this->load->helper('form');
        $this->load->library(array('auth','form_validation'));
        
        
        $data['passchar'] = '';
        $data['cpasschar'] = '';

        $this->form_validation->set_rules('passchar', 'Password', 'required');
            
        if ($this->form_validation->run() == FALSE) {
            $this->load->view($this->config->item('admin_folder').'/change_password', $data);
        } else {
			
            $save['id']            = $this->auth_session['id'];
            $save['admin_password']      = sha1($this->input->post('passchar'));
           
            $userId             = $this->auth->save($save);
            
            $result = $this->db->get_where('tbl_admin', array('admin_email ' => $this->auth_session['admin_email']));
        
            $member = $result->row_array();
            //echo "<pre>"; print_r($member); echo "</pre>";exit;
            /************************ MAIL TEMPLATE ***********************************/
            $res = $this->db->where('tplid', '5')->get('tbl_email_template');
            $row = $res->row_array();			
            // set replacement values for subject & body
            // {customer_name}
            $row['tplmessage'] = str_replace('{NAME}', $member['first_name'] . ' ' . $member['last_name'], $row['tplmessage']);

            $row['tplmessage'] = str_replace('{USERNAME}', $member['admin_email'],$row['tplmessage']);
            $row['tplmessage'] = str_replace('{PASSWORD}', $this->input->post('passchar') ,$row['tplmessage']);
            // {url}
            $row['tplmessage'] = str_replace('{SITE_PATH}', $this->config->item('base_url'), $row['tplmessage']);

            $row['tplmessage'] = str_replace('{code}', $this->input->post('passchar'), $row['tplmessage']);


            $this->load->library('email');
//			
            $config['mailtype'] = 'html';

            $this->email->initialize($config);

            $this->email->from($this->config->item('email'), $this->config->item('company_name'));
            $this->email->to($member['admin_email']);
            $this->email->subject($row['tplsubject']);
            $this->email->message(html_entity_decode($row['tplmessage']));

            $this->email->send();
            
            /*********************************************************************/

            $this->session->set_flashdata('message', ('Password Changed Successfully '));


            //go back to the provider list
            redirect($this->config->item('admin_folder') . '/change_password');
        }
    }

    
}
?>
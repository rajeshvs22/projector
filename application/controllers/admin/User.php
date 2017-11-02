<?php
class User extends Admin_Controller {
	
    function __construct() {
        parent::__construct();
        $this->load->model(array('user_model'));
	$this->load->helper('url');
        $this->perPage = 3;
    }
    function index() {
		
		$this->load->view($this->config->item('admin_folder') . '/user_list');	
      
    } 
   
    function user_list_response(){
            $data= array();
            $this->load->view('admin/user_list_response', $data, false);
    }
    
    
}	


?>
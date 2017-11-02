<?php

/**
 * The base controller which is used by the Front and the Admin controllers
 */
class Base_Controller extends CI_Controller
{
	var $CI;
        var $userSes;
        
	public function __construct()
	{		
		parent::__construct();
	}//end __construct()
	
}//end Base_Controller

class Front_Controller extends Base_Controller
{
	
	//we collect the categories automatically with each load rather than for each function
	//this just cuts the codebase down a bit
	var $categories	= '';
	
	//load all the pages into this variable so we can call it from all the methods
	var $pages = '';
	
	// determine whether to display gift card link on all cart pages
	//  This is Not the place to enable gift cards. It is a setting that is loaded during instantiation.
	var $gift_cards_enabled;
	
	function __construct(){
		
		parent::__construct();
	
		
		//$this->load->add_package_path(FCPATH.'themes/'.$this->config->item('theme').'/');
	}
	
	/*
	This works exactly like the regular $this->load->view()
	The difference is it automatically pulls in a header and footer.
	*/
	
}

class Admin_Controller extends Base_Controller 
{
	function __construct()
	{
		parent::__construct();
ob_start();
                $this->load->library('auth');
$this->load->helper('rajutility');
                $this->auth->is_logged_in(uri_string());
                $this->auth_session = get_session_data();
	}
}
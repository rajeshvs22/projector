<?php 

class Home extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper(array('form','rajutility'));
    }
	
    public function index() {
        
                $session = get_memner_session_data();
                $user_id = $session['id'];
                $data['user_data'] = $session;
		$this->load->view('include/logged_header',$data);

		$this->load->view('home');		

		$this->load->view('include/footer');
    }   

	
}
?>

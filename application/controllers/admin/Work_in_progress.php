<?php
class Work_in_progress extends Admin_Controller {

  
    function __construct() {
        parent::__construct();
    }

    function index() {
        $this->load->view($this->config->item('admin_folder') . '/work_in_progress', $data = array());
    }

   

}
?>
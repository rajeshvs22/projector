<?php
class Payment extends Admin_Controller {

  
    function __construct() {
        parent::__construct();
    }

    function index() {
        $this->load->view($this->config->item('admin_folder') . '/payment', $data = array());
    }
}
?>
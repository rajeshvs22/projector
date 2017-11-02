<?php 
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class LanguageSwitcherss extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    function switchLang($language = "") {

        $language = ($language != "") ? $language : "english";
        
        $lan = get_site_language($language);
        
        //$this->session->set_userdata('site_lang', $lan);
        //$this->session->set_userdata('site_lang_string', $language);

        redirect($_SERVER['HTTP_REFERER']);
    }

}

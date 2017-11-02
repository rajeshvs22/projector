<?php 
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class LanguageSwitcher extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    function switchLang($language = "") {

        $language = ($language != "") ? $language : "english";
        
        $lang = get_site_language($language);
        
        $this->session->set_userdata('site_lang', $language);
        
        $this->session->set_userdata('site_db_lang', $lang);

        redirect($_SERVER['HTTP_REFERER']);
    }

}

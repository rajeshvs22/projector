<?php
class Race extends Admin_Controller {

    //this is used when editing or adding a provider
    var $race_id = false;
    var $condition = array();

    function __construct() {
        parent::__construct();

        $this->load->model(array('race_model'));
        $this->load->model(array('company_model'));
    }

    function index() {
        
        $this->listing();
    }
    
    function listing() {
        
        $this->condition = $this->input->post(null, false); // search
        
        $data = $this->get_pagination($this->condition);

        $this->load->view($this->config->item('admin_folder') . '/race', $data);
    }

    function race_ajax() {
        
        $this->condition = $this->input->post(null, false); // search
        
        $data = $this->get_pagination($this->condition);


        $this->load->view($this->config->item('admin_folder') . '/race-list', $data);
    }

    function get_pagination($cond) {

        $this->load->library('pagination_admin');

        $data['page_title']         = 'Race Page';
        $data['count_result']       = $this->race_model->count_race($cond);

        $config['is_ajax_paging']   = true;
        $config['paging_function']  = 'race_ajax';
        $config['base_url']         = site_url('admin/group');
        $config['total_rows']       = $data['count_result'];
        $config['per_page']         = $this->config->item('admin_per_page');
        $config['uri_segment']      = 4;

        $this->pagination_admin->initialize($config);
        
        $data['search']['datepickerDateFrom'] = $cond['datepickerDateFrom'];
        $data['search']['datepickerDateTo'] = $cond['datepickerDateTo'];
        $data['search']['keyword'] = $cond['keyword'];

        $data['pagination'] = $this->pagination_admin->create_links();
        $data['races'] = $this->race_model->all_race($this->pagination_admin->per_page, $this->uri->segment(4),'race_id','DESC',$cond);

        return $data;
    }

    function form($raceId = false) {
        //force_ssl();
        $this->race_id = $raceId;
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['page_title'] = 'Race Form';

        //default values are empty if the provider is new
        $data['raceId']    = '';
        $data['raceName']  = '';
        $data['companyId']  = '';
        $data['race_active']   = '';


        $companyData = $this->company_model->all_company();

        $drop = array('' => '-Select-');
        foreach ($companyData as $key => $company) {
            $drop[$company['company_id']] = $company['company_name'];
        }

        $data['companyList']    = $drop;

        if ($raceId) {

            $race = $this->race_model->get_race($raceId);

            //if the provider does not exist, redirect them to the provider list with an error
            if (!$race) {
                $this->session->set_flashdata('error', lang('error_not_found'));
                redirect($this->config->item('admin_folder') . '/race');
            }

            //set values to db values
            $data['raceId']    = $race->race_id;
            $data['raceName']  = $race->race_name;
            $data['companyId']  = $race->company_id;
            $data['race_active']   = $race->race_active;
        }

        $this->form_validation->set_rules('raceName', 'Race Name', 'required|callback_check_field_name');



        //if this is a new account require a password, or if they have entered either a password or a password confirmation
        if ($this->form_validation->run() == FALSE) {
            $this->load->view($this->config->item('admin_folder') . '/race-form', $data);
        } else {
            $save['race_id']       = $raceId;
            $save['race_name']     = $this->input->post('raceName');
            $save['company_id']     = 4;
            $save['race_active']  = $this->input->post('race_active');
            
            if($raceId){
                $save['race_modified_date'] = date('Y-m-d H:i:s'); 
                $save['race_modified_by'] = $this->adminSes['id'];
            }else{
                $save['race_created_date'] = date('Y-m-d H:i:s');
                $save['race_created_by'] = $this->adminSes['id'];
            }

            $this->race_model->save($save);

            $this->session->set_flashdata('message', ('The Race detail has been saved!'));


            //go back to the provider list
            redirect($this->config->item('admin_folder') . '/race');
        }
    }

    function delete($id) {
        
        $count = $this->tuition_mgt->get_count($id,'m_race','race_id');
        //if the department does not exist, redirect them to the customer list with an error

        if ($count > 0) {
            $this->tuition_mgt->delete_row($id,'m_race','race_id');

            $this->session->set_flashdata('message', ('The race has been deleted!'));
            redirect($this->config->item('admin_folder') . '/race');
        } else {
            $this->session->set_flashdata('error', lang('error_not_found'));
            redirect($this->config->item('admin_folder') . '/race');
        }
    }
    
    function check_field_name($str){
        
        $this->db->select('race_name');
        $this->db->from('m_race');
        $this->db->where('race_name', $str);
        
        if ($this->race_id){
         $this->db->where('race_id !=', $this->race_id);
        }
        
        $count = $this->db->count_all_results();
        
        if ($count == 0){            
         return true;
        }else{
         $this->form_validation->set_message('check_field_name', 'The requested race is already in use.');
         return false;
        }
    }
    
    
    function makeActive(){
        $data = array();
        $data['flag'] = $this->race_model->isMakeActive($this->input->post('raceId'));
        echo json_encode( $data );
    }
    
    function makeInactive(){
        $data = array();
        $data['flag'] = $this->race_model->isMakeInactive($this->input->post('raceId'));
        echo json_encode( $data );
    }
    
    

}
?>
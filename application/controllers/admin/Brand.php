<?php

class Brand extends Admin_Controller {

    //this is used when editing or adding a provider
    var $tag_id = false;
    var $condition = array();

    function __construct() {
        parent::__construct();

        $this->load->model(array('brand_model'));
        $this->load->helper('url');
        $this->session->unset_userdata('site_lang');
        echo "eeeeeeeeeeeeeeeeeeeeeeeeeeeee";
    }

    function index() {


        $this->listing();
    }

    function listing() {

        $data['brand'] = $this->brand_model->get_brand();
        //echo "<pre>";print_r($data['product_tag']);exit;
        $this->load->view($this->config->item('admin_folder') . '/brand_list', $data);
    }

    function form($brand_id = false) {
        //force_ssl();
        $this->brand_id = $brand_id;
        $this->load->helper('form');
        $this->load->library('form_validation');
        
        $lang = '';

        //default values are empty if the provider is new
        $data['brand_id'] = '';
        $data['_brand'] = '';
        $data['_slug'] = '';
        $data['brand_image'] = array();
        foreach(get_site_language() as $l){
            $data[$l.'_brand'] = '';
            $data[$l.'_slug'] = '';
        }
        
        if ($brand_id) {


            $brand = $this->brand_model->get_brand($brand_id);
            //if the provider does not exist, redirect them to the provider list with an error
            $data['brand_image'] = $this->brand_model->get_brand_images($brand['brand_id']);
            //print_r($data['brand_image']); exit;
            //set values to db values
            
            foreach($brand as $field_k => $field_v  ){                    
                $data[$field_k] = $field_v;
            }
            $data['_brand'] = $data['en_brand'];
            $data['_slug'] = $data['en_slug'];
            
        }

        $this->form_validation->set_rules($lang.'_brand', 'brand name', 'required');
        //if this is a new account require a password, or if they have entered either a password or a password confirmation
        if ($this->form_validation->run() == FALSE) {
            $this->load->view($this->config->item('admin_folder') . '/brand_form', $data);
        } else {
            
            $save['brand_id'] = $brand_id;
            
            
            foreach($this->input->post('language-fields') as $kk => $fields  ){
                foreach($fields as $k => $field  ){                    
                    $field = (trim($field) == ''?$fields['en']:$field);
                    $save[$k.$kk] = $field;
                }
            }
            
            //echo "<pre>";print_r($this->input->post(NULL,NULL));
            //echo "<pre>";print_r($save);exit;
            
            
            
            $brand_id = $this->brand_model->save_brand($save);


            $this->load->library('image_lib');

            /** single image upload  * */
            if ($_FILES['single_image_local']['name'] != '') {

                $this->brand_model->delete_single_brand_image('', $brand_id, 'brand_image');
                brand_single_image($brand_id, $_FILES['single_image_local']);
            }
            $this->session->set_flashdata('message', ('The brand detail has been saved!'));


            //go back to the provider list
            redirect($this->config->item('admin_folder') . '/brand/listing');
        }
    }

    function delete($brand_id) {

        $this->brand_model->delete_row($brand_id);
        $this->session->set_flashdata('message', ('The brand has been deleted!'));
        redirect($this->config->item('admin_folder') . '/brand/listing');
    }

    function makeActive() {
        $data = array();
        $data['flag'] = $this->tag_model->isMakeActive($this->input->post('subject_levelId'));
        echo json_encode($data);
    }

    function makeInactive() {
        $data = array();
        $data['flag'] = $this->tag_model->isMakeInactive($this->input->post('subject_levelId'));
        echo json_encode($data);
    }

}

?>
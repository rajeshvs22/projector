<?php

class Product_category extends Admin_Controller {

    //this is used when editing or adding a provider
    var $category_id = false;
    var $condition = array();

    function __construct() {
        parent::__construct();

        $this->load->model(array('category_model'));
        $this->load->helper('url');
    }

    function index() {


        $this->listing();
    }

    function listing() {

        $data['product_category'] = $this->category_model->get_category();
        //echo "<pre>";print_r($data['product_category']);exit;
        $this->load->view($this->config->item('admin_folder') . '/product_category', $data);
    }

    function form($category_id = false) {
        //force_ssl();
        $this->product_id = $category_id;
        $this->load->helper('form');
        $this->load->library('form_validation');

        //default values are empty if the provider is new
        $data['category_id'] = '';
        $data['parent_id'] = '';
        $data['en_cat'] = '';
        $data['en_slug'] = '';
        $data['category_image'] = array();
        $category = $this->category_model->select_category();
        $data['cat'] = $this->category_model->fetchcategory();
        //  print_r($data['cat']); exit;
        $cat_option = array('' => 'Parent');
        foreach ($category as $cat_key => $cat) {
            $cat_option[$cat['category_id']] = $cat['en_cat'];
        }
        $categories = $data['category'] = $cat_option;

        if ($category_id) {

            $product_category = $this->category_model->get_category($category_id);
            $data['category_image'] = $this->category_model->get_category_images($product_category['category_id']);

            //if the provider does not exist, redirect them to the provider list with an error
            if (!$product_category) {
                $this->session->set_flashdata('error', lang('error_not_found'));
                redirect($this->config->item('admin_folder') . '/subject_level');
            }

            //set values to db values
            $data['category_id'] = $product_category['category_id'];
            $data['parent_id'] = $product_category['parent_id'];
            $data['en_cat'] = $product_category['en_cat'];
            $data['en_slug'] = $product_category['en_slug'];
        }

        $this->form_validation->set_rules('en_cat', 'category name Name', 'required');



        //if this is a new account require a password, or if they have entered either a password or a password confirmation
        if ($this->form_validation->run() == FALSE) {
            $this->load->view($this->config->item('admin_folder') . '/product_category_form', $data);
        } else {


            $save['category_id'] = $category_id;
            $save['en_cat'] = $this->input->post('en_cat');
            $save['en_slug'] = $this->input->post('en_slug');
            $save['parent_id'] = $this->input->post('parent_id');
            //$save['category_created_by'] = $this->auth_session['id'];

            $category_id = $this->category_model->save_category($save);
            if ($category_id == '') {

                $this->session->set_flashdata('message', ('The category is already exists!'));
                redirect($this->config->item('admin_folder') . '/Product_category/form');
            } else {
                $this->load->library('image_lib');

                /** single image upload  * */
                if ($_FILES['single_image_local']['name'] != '') {

                    $this->category_model->delete_single_category_image('', $category_id, 'category_image');
                    category_single_image($category_id, $_FILES['single_image_local']);
                }

                $this->session->set_flashdata('message', ('The product category detail has been saved!'));


                //go back to the provider list
                redirect($this->config->item('admin_folder') . '/Product_category');
            }
        }
    }

    function delete($category_id) {

        $this->category_model->delete_row($category_id);
        $this->session->set_flashdata('message', ('The product category has been deleted!'));
        redirect($this->config->item('admin_folder') . '/Product_category');
    }

    function makeActive() {
        $data = array();
        $data['flag'] = $this->category_model->isMakeActive($this->input->post('subject_levelId'));
        echo json_encode($data);
    }

    function makeInactive() {
        $data = array();
        $data['flag'] = $this->category_model->isMakeInactive($this->input->post('subject_levelId'));
        echo json_encode($data);
    }

}

?>

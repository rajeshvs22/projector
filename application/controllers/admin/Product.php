<?php

class Product extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model(array('product_model', 'category_model','tag_model','subject_group_model'));
        $this->load->helper('url');
    }


    function listproduct() {
        $data['products'] = $this->product_model->get_product_list();
        $this->load->view($this->config->item('admin_folder') . '/product_list', $data);
    }

    function form($product_id = false) {

        $this->load->helper('form');
        $this->load->library('form_validation');       
        
        
        $data['product_id']       = $product_id;
        $data['product_name']       = '';
        $data['product_tags']       = '';
        $data['product_unique_id']  = 'PRO'.uniqid(rand(), true).'_'.$this->db->count_all('tbl_product');;
        $data['product_description']= '';
        $data['product_name']       = '';
        $data['category_id']        = '';
		$data['subcategory_id']        = '';		
        $data['product_price']      = '';
        $data['product_quantity'] = '';
        $data['product_shipping'] = '';
        $data['product_shipping_time'] = '';
        $data['product_earnings'] = '';
        $data['offer'] ='';
        $data['offer_start_date'] ='';
        $data['stickeyoffer'] ='';
        $data['starttime'] ='';
        $data['offer_end_date'] ='';
        $data['endtime'] ='';
        $data['almost_gone'] ='';
        $data['product_images'] = array();
        
        
                

        $category = $this->category_model->select_category(); 
		$sub_category = $this->subject_group_model->select_subcategory();
        $data['product_tag'] = $this->tag_model->get_tag();
        
        $cat_option = array('' => 'Select Category');
        foreach($category as $cat_key => $cat){
            $cat_option[$cat['category_id']] = $cat['category_name'];
        }
        $categories = $data['category'] = $cat_option;       
		$subcat_option = array('' => 'Select Subcategory');		
        foreach($sub_category as $sub_cat_key => $sub_cat){
            $subcat_option[$sub_cat['subcategory_id']] = $sub_cat['subcategory_name'];
        }
        $sub_categories = $data['sub_category'] = $subcat_option;
        $this->form_validation->set_rules('category_id', 'Product Category', 'required');
        $this->form_validation->set_rules('product_description', 'Product Descriptions', 'required');
        $this->form_validation->set_rules('product_name', 'Product Name', 'required');
        $this->form_validation->set_rules('product_price', 'Product Price', 'required');
        $this->form_validation->set_rules('product_quantity', 'Product Quantity', 'required');        
   
        //If edit
        if($product_id != ''){			
            $product = $this->product_model->get_product($product_id);
            $product_category = $this->category_model->get_category_and_sub($product['category_id']);			
            $product_images1 = $this->product_model->get_product_images_single_multiple($product['product_id'],'product_image_single');
            $product_images2 = $this->product_model->get_product_images_single_multiple($product['product_id'],'product_image_multiple');
            $product_images['product_images'] = array_merge($product_images1,$product_images2);
           // echo "<pre>";print_r($product_images);exit;
            $Product_info = array_merge($product,$product_category);
            $data = array_merge($Product_info,$product_images);
            $data['category'] = $categories;
			$data['sub_category'] = $sub_categories;
            

        }

        if ($this->form_validation->run() == FALSE) {

            $this->load->view($this->config->item('admin_folder') . '/product', $data);
            
        } else {
            
            $data       = $this->input->post();
            $inputdata  = $this->input->post();

            print_r($this->input->post());

             if($this->input->post('stickeyoffer')){
                $inputdata['stickeyoffer']='1';
            }else{
                $inputdata['stickeyoffer']='0';
            }

            unset($inputdata['hour'],$inputdata['minute'],$inputdata['second']);

            /*unset($data['single_image_web'], $data['multiple_image_web'], $data['offerdate'], $data['offer'], $data['endtime'], $data['starttime'], $data['stickeyoffer'], $data['min'], $data['max']);


            $websingle      = $inputdata['single_image_web'];
            $webmultiple    = $inputdata['multiple_image_web'];
            unset($inputdata['single_image_web'], $inputdata['multiple_image_web'], $inputdata['min'], $inputdata['max'],$inputdata['product_tags']);
            */

            $inputdata['product_created_by'] = $this->auth_session['id'];
            
            //Get product id
            if ($product_id != '') {
                $inputdata['product_id'] = $product_id;
            }else{
                $inputdata['product_id'] = '';
            }

            
            $product_id_get = $this->product_model->save_product($inputdata);
            $this->load->library('image_lib');

            /*
             * Main web url image
             * 
             */
            $filename1 = rand() . '.png';

            if ($websingle != '') {
                if (file_put_contents('./uploads/product/' . $filename1, file_get_contents($websingle))) {
                    $uploaddata['referal_id'] = $product_id_get;
                    $uploaddata['referal_value'] = 'product_image_single';
                    $uploaddata['image_name'] = 'image.png';
                    $uploaddata['image_path'] = '/uploads/product/' . $filename1;
                    $uploaddata['image_type'] = 'product';
                    $this->product_model->save_product_image($uploaddata);
                }
            }
            /*
             * Additional web url image
             * 
             */
            if ($webmultiple != '') {
                $filename2 = microtime(true) . '.png';
                if (file_put_contents('./uploads/product/' . $filename2, file_get_contents($webmultiple))) {
                    $uploaddata['referal_id'] = $product_id_get;
                    $uploaddata['referal_value'] = 'product_image_multiple';
                    $uploaddata['image_name'] = 'image.png';
                    $uploaddata['image_path'] = '/uploads/product/' . $filename2;
                    $uploaddata['image_type'] = 'product';
                    $this->product_model->save_product_image($uploaddata);
                }
            }

            /** single image upload  * */
            
            if ($_FILES['single_image_local']['name'] != '') {
                
                $this->product_model->delete_single_product_image('',$product_id_get,'product_image_single');
                load_single_image($product_id_get,$_FILES['single_image_local']);
            }

            /** Multiple file upload **/           

            if ($_FILES['multiple_image_local']['name'][0] != '') {
                load_multiple_images($product_id_get,$_FILES['multiple_image_local']);
            }

            $this->session->set_flashdata('message', ('The product detail has been saved!'));

            // send mail to all registered users when add a new product..
            if ($product_id == '') {
                $load_mail_to_all_users = $this->product_model->load_mail_to_all_users($product_id_get);
            }


            //go back to the provider list
            redirect($this->config->item('admin_folder') . '/Product/listproduct');
        }
    }

    function delete($product_id) {

        $this->product_model->delete_row($product_id);
        $this->product_model->delete_single_product_image($product_id);
        
        $this->session->set_flashdata('message', ('The product has been deleted!'));
        redirect($this->config->item('admin_folder') . '/Product/listproduct');
    }
    
    function delete_image(){
        $img_id = $this->input->post('img_id'); 
        $referal_value = $this->input->post('referal_value');
        
        $this->product_model->delete_existing_product_image($img_id,$referal_value);
    }
	function get_product_category_list() {

            $category_id = $this->input->post('category_id');
            
            $this->db->select('*');
            $this->db->from('product_subcategory');
            $this->db->where('category_id', $category_id);
            $res = $this->db->get()->result_array();
            
            
            $option = '';
            $flag = 'false';
            if(count($res) > 0){
                $option .= '<option value="">Select Subcategory</option>';

                foreach ($res as $key => $val) {
                    $option .= '<option value="' . $val["subcategory_id"] . '">' . $val["subcategory_name"] . '</option>';
                }
                $flag = 'true';
            }
            
            echo json_encode(array('flag' => $flag  , 'select' => $option));
            exit;
    }

}

?>

<?php
class Brand_model extends CI_Model
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function get_brand($brand_id = ''){
        
        if($brand_id){
            $this->db->where('brand_id' , $brand_id);
            $res = $this->db->get('ary_brand')->row_array();        
            return $res;
        }
        $res = $this->db->get('ary_brand')->result_array();        
        return $res;
    }
    
    function save_brand($data){
        if($data['brand_id'])
        {
                $this->db->where('brand_id', $data['brand_id']);
                $this->db->update('ary_brand', $data);
                return $data['brand_id'];
        }
        else
        {
                $this->db->insert('ary_brand', $data);				
                return $this->db->insert_id();
        }
    }
    
   function get_images($image_id = '', $feature = '') {
        $this->db->select('tbl_product_images.*');
        $this->db->from('tbl_product_images');
        
        if ($feature != '') {
            $this->db->where('referal_value', $feature);            
        }
        
        if ($image_id != '') {
            $this->db->where('image_id', $image_id);
            $res = $this->db->get()->row_array();
            return $res;
        }else{
            $res = $this->db->get()->result_array();
            return $res;
        } 
        
        
    }
    function get_brand_images($brand_id= '', $feature = '') {
        $this->db->select('tbl_product_images.*');
        $this->db->from('tbl_product_images');
        $this->db->where('referal_id', $brand_id);
        $this->db->where('referal_value','brand_image');
        if ($feature != '') {			
            $this->db->where('referal_value', $feature);
            $res = $this->db->get()->row_array();
            return $res;

        } else {
            $res = $this->db->get()->result_array();
            return $res;
        }
    }
  function delete_single_brand_image($image_id ="",$referal_id="",$referal_value=""){
        //Get Product Image       
        $images = $this->get_brand_images($referal_id ,$referal_value );
        //Delete table
        $this->db->where('image_id', $images['image_id']);
        $this->db->delete('tbl_product_images');
        //Unlink File
        if (file_exists($images['file_path'].$images['image_name'])) {
            unlink($images['file_path'].$images['image_name']);
            //unlink($images['file_path'].'brand/'.$images['image_name']);
            //unlink($images['file_path'].'offer/'.$images['image_name']); 
        }
    }
    function select_brand()
   {
       $res = $this->db->get('ary_brand')->result_array();        
       return $res;
   }
   
    function delete_row($brand_id){

                $this->db->where('brand_id', $brand_id);
                $this->db->delete('ary_brand');

    }
 function save_brand_image($data) {
        $this->db->insert('tbl_product_images', $data);
        return $this->db->insert_id();
    }
    
}
?>
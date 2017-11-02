<?php
class Banner_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    function get_product($banner_id = '') {
        $this->db->select('*');
        $this->db->from('banners');       
        $this->db->where('banner_id', $banner_id);
        $res = $this->db->get()->row_array();
        return $res;
    }

   function get_product_images($banner_id = '', $feature = '') {
        $this->db->select('tbl_product_images.*');
        $this->db->from('tbl_product_images');
        $this->db->where('referal_id', $banner_id);

        if ($feature != '') {			
            $this->db->where('referal_value', $feature);
            $res = $this->db->get()->row_array();
            return $res;
        } else {
            $res = $this->db->get()->result_array();
            return $res;
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
	 function get_product_list($banner_id = '') {
        $this->db->select('*');
        $this->db->from('banners');		
		$res = $this->db->get()->result_array();
        return $res;
    }
	 function get_front_banner($banner_id = '' ) {
		$this->db->select('*');
		$this->db->from('banners as B');
		//$this->db->join('tbl_product as P' , 'P.product_id = B.product_id');
		$this->db->join('tbl_product_images as PI' , 'PI.referal_id = B.banner_id');
		$this->db->where('referal_value','banner_image_single');
		$this->db->group_by('B.banner_id');		
		$res = $this->db->get()->result_array();
		return $res;
    }
   
    function save_product($data) {		
        if ($data['banner_id']) {			
            $this->db->where('banner_id', $data['banner_id']);
            $this->db->update('banners', $data);
            return $data['banner_id'];
        } else {			
             $this->db->insert('banners', $data); 
            return $this->db->insert_id();
        }
    }

    function delete_row($banner_id) {

        $this->db->where('banner_id', $banner_id);
        $this->db->delete('banners');
    }

    function save_product_image($data) {
        $this->db->insert('tbl_product_images', $data);
        return $this->db->insert_id();
    }
    function delete_single_product_image($image_id ="",$referal_id="",$referal_value=""){
        //Get Product Image       
        $images = $this->get_product_images($referal_id ,$referal_value );
        //Delete table
        $this->db->where('image_id', $images['image_id']);
        $this->db->delete('tbl_product_images');
        //Unlink File
        if (file_exists($images['file_path'].$images['image_name'])) {
            unlink($images['file_path'].$images['image_name']);
            unlink($images['file_path'].'thumb/'.$images['image_name']);
            unlink($images['file_path'].'offer/'.$images['image_name']); 
        }
    }   
}

?>

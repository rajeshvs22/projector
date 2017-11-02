<?php
class Premium_product_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

   function save_premium_product($save){
	   //Delete existing recard
	    $this -> db -> where('category_id != "" ');
	    $this -> db -> delete('premium_product'); 
		//Insert New Recard
		$this->db->insert('premium_product', $save);		 
		$last_id=$this->db->insert_id(); 
		
		return $last_id; 		
    }
	
	function get_premium_product(){
		$this->db->select('*');
		$this->db->from('premium_product as PP'); 
		$this->db->join('tbl_product_images as PI' , 'PI.referal_id = PP.product_id');
		$this->db->join('tbl_product as PR' , 'PR.product_id = PI.referal_id');
		$this->db->where('referal_value','product_image_single');
		$res = $this->db->get()->row_array();			
		return $res;
	}
}
?>

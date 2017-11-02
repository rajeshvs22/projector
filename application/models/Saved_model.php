<?php
class Saved_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }
	//check If product is already inserted into db or not
	function get_saved($data =array()){
		
		$this->db->select('*');

		$this->db->from('tbl_saved_product');

		$this->db->where('product_id',$data['product_id'] );

		$this->db->where('user_id',$data['user_id'] );                

		$res = $this->db->get()->row_array();

		return $res;
	}

	//Insert into cart page
	function insert_saved($data){
		
		$saved_info = $this->get_saved($data);	
		$userid = $data['user_id'];
		$product_id = $data['product_id'];
		if(empty($saved_info)){
		$result= $this->db->query("INSERT INTO `tbl_saved_product`(`user_id`, `product_id`) VALUES ('$userid','$product_id')");

		$res = 'added in saved product';

		}else{

		$res = 'already added in saved product';
		}

		return $res;			
       
        }
	
	//View the saved Page
	function get_saved_product($user_id){		

		$this->db->select('*');

		$this->db->from('tbl_saved_product');   

		$this->db->join('tbl_product', 'tbl_product.product_id = tbl_saved_product.product_id');

		$this->db->join('tbl_product_images', 'tbl_product_images.referal_id = tbl_saved_product.product_id');

		$this->db->where('user_id',$user_id);       

		$this->db->where('referal_value', 'product_image_single');	

		$this->db->group_by('saved_id');

		$query = $this->db->get();

		$res = $query->result();
		$result = json_decode(json_encode($res),true);
		$result = $this->product_model->check_offer($result);
		$res = json_decode(json_encode($result));


		return $res;
	}          
	
	//Delete Single saved product
	function remove_savedproduct($saved_id){	
		
		$this -> db -> where('saved_id', $saved_id);
		
		$this -> db -> delete('tbl_saved_product');
		
		return true;		
	}

	//Delete all the saved product from user id
	function delete_all_savedproduct($user_id){	
		
		$this -> db -> where('user_id', $user_id);
		
		$this -> db -> delete('tbl_saved_product');
		
		return true;		
	}
	
}
?>

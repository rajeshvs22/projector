<?php
class Cart_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    //check If product is already inserted into db or not
    function get_cart($data =array()){
        $this->db->select('*');
        $this->db->from('tbl_cart');
        $this->db->where('product_id',$data['product_id'] );
        $this->db->where('user_id',$data['user_id'] );
        $this->db->where('cart_status','1' );
        $res = $this->db->get()->row_array();
        return $res;
    }

    //Insert into cart page
    function insert_cart($data){
        $cart_info = $this->get_cart($data);	
        $userid = $data['user_id'];
        $product_id = $data['product_id'];
        $shipping = $data['shipping'];
        $product_price = $data['product_price'];
        $offer = $data['offer'];
        if($offer > 0)
        {
          $actualprice = $product_price - $product_price * $offer/100;
        }
        else
        {
          $actualprice = $product_price;
        }
        if(empty($cart_info)){
            $result= $this->db->query("INSERT INTO `tbl_cart`(`user_id`, `product_id`,`product_price`,`offer`,`shipping`,`actual_amount`) VALUES ('$userid','$product_id','$product_price ','$offer','$shipping','$actualprice')");
            $res = 'added in cart';
        }else{
            $res = 'already added in cart';
        }
        return $res;			
    }

    // Cart count 
    function get_cart_count($userid){
        $this->db->select('count(*)');
        $this->db->from('tbl_cart');
        $this->db->where('user_id',$userid );
        $this->db->where('cart_status','1' );
        $data = $this->db->get()->row_array();	
        $count=$data['count(*)']; 
        return $count;
    }

    //View the cart Page
    function cart($user_id){		
        $this->db->select('*');
        $this->db->from('tbl_cart');   
        $this->db->join('tbl_product', 'tbl_product.product_id = tbl_cart.product_id');
        $this->db->join('tbl_product_images', 'tbl_product_images.referal_id = tbl_cart.product_id');
        $this->db->where('user_id',$user_id);
        $this->db->where('cart_status','1');
        $this->db->where('referal_value', 'product_image_single');	
        $this->db->group_by('cart_id');
        $query = $this->db->get();
        $res = $query->result();
        $res = json_decode(json_encode($res),true);
        $res = $this->product_model->check_offer($res);
        $res = json_decode(json_encode($res));

        
        return $res;
    }         
 
    //Update Quantity 
    function update_quantity($data){
        $this->db->where('cart_id',$data['cart_id']);
        $this->db->set('quantity',$data['quantity']);
        $this->db->update('tbl_cart');	
        return  $data;
    }

    //Delete Single product
    function remove_cart($cart_id){	
        $this -> db -> where('cart_id', $cart_id);
        $this -> db -> delete('tbl_cart');
        return true;		
    }

    //Delete all the product from user id
    function delete_all_cart($user_id){	
        $this -> db -> where('user_id', $user_id);
        $this -> db -> delete('tbl_cart');
        return true;		
    }

    //Billing Addresss
    function billing_address($user_id){
        $this->db->select('UB.*,U._NAME	,U._EMAIL,U._MOBILE');
        $this->db->from('users as U');   
        $this->db->join('user_billing_address as UB ', 'UB.user_id = U._ID','left');	
        $this->db->where('_ID',$user_id);
        $query = $this->db->get();	
        $res = $query->result();
        return $res;
    }

    function update_cart_status($cart_ides){
        $cartallid = explode(',',$cart_ides);
        foreach($cartallid as $cart_id){                
            // update cart status
            $sql_up = "update tbl_cart set cart_status='0' where cart_id='".$cart_id."'";  
            $query = $this->db->query($sql_up);
            $this->db->select('product_id,quantity');
            $this->db->from('tbl_cart');
            $this->db->where('cart_id',$cart_id);
            $products_change[] = $this->db->get()->row_array();
        }
        foreach($products_change as $productchange){
            // reduce product quantity
            $qty = $productchange['quantity'];  
            $pr_id = $productchange['product_id'];              
            $sql_up = "update tbl_product set product_quantity= product_quantity - '".$qty."' where product_id='".$pr_id."' AND product_quantity > 0";  

            $query = $this->db->query($sql_up);

        }
        return true;
    }

}
?>

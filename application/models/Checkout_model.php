<?php
class Checkout_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    //View the cart Page
    function get_product_view($user_id){		
        $this->db->select('*');
        $this->db->from('tbl_cart');   
        $this->db->join('tbl_product', 'tbl_product.product_id = tbl_cart.product_id');
        $this->db->join('tbl_product_images', 'tbl_product_images.referal_id = tbl_cart.product_id');
        $this->db->where('user_id',$user_id);
        $this->db->where('cart_status','1' );
        $this->db->where('referal_value', 'product_image_single');	
        $this->db->group_by('cart_id');
        $query = $this->db->get();
        $res = $query->result();
        $res = json_decode(json_encode($res),true);
        $res = $this->product_model->check_offer($res);
        $res = json_decode(json_encode($res));
        
        return $res;
    }  

    //Billing Addresss
    function get_billing_address($user_id){
        $this->db->select('UB.*,U._NAME	,U._EMAIL,U._MOBILE,U._ID');
        $this->db->from('users as U');   
        $this->db->join('user_billing_address as UB ', 'UB.user_id = U._ID','left');	
        $this->db->where('UB.user_id',$user_id);
        $query = $this->db->get();	
        $data = $query->result();
        return $data;
    }

    function get_current_address($id){
        $this->db->select('UB.*,U._NAME	,U._EMAIL,U._MOBILE,U._ID');
        $this->db->from('users as U');   
        $this->db->join('user_billing_address as UB ', 'UB.user_id = U._ID','left');	
        $this->db->where('UB.billing_id',$id);
        $query = $this->db->get();	
        $data = $query->result();
        return $data;
    }

    //Insert into billing details
    function billing_address_insert($data){	
        $this->db->select('*');
        $this->db->from('user_billing_address');
        $this->db->where('user_id',$data['user_id'] );
        $res = $this->db->get()->row_array();
        if(count($res)>0){

            $user_id=$data['user_id'];
            $name=$data['name'];
            $email=$data['email'];
            $phone=$data['phone'];
            $company_name=$data['company_name'];
            $street_address=$data['street_address'];
            $address=$data['address'];
            $city=$data['city'];
            $state=$data['city'];
            $country=$data['country'];
            $zipcode=$data['zipcode'];
            $comment=$data['comment'];
            $result= $this->db->query("INSERT INTO `user_billing_address`(`user_id`,`name`,`email`,`phone`, `company_name`,`street_address`,`address`,`city`,`state`,`country`,`zipcode`,`comment`) VALUES ('$user_id','$name','$email','$phone','$company_name','$street_address','$address','$city','$state','$country','$zipcode','$comment')");
            $insert_id = $this->db->insert_id();
            return  $insert_id;
        }
        
    }
    function new_billing_address_insert($data){	

            $user_id=$data['user_id'];
            $name=$data['name'];
            $email=$data['email'];
            $phone=$data['phone'];
            $company_name=$data['company_name'];
            $street_address=$data['street_address'];
            $address=$data['address'];
            $city=$data['city'];
            $state=$data['city'];
            $country=$data['country'];
            $zipcode=$data['zipcode'];
            $comment=$data['comment'];
            $result= $this->db->query("INSERT INTO `user_billing_address`(`user_id`,`name`,`email`,`phone`, `company_name`,`street_address`,`address`,`city`,`state`,`country`,`zipcode`,`comment`) VALUES ('$user_id','$name','$email','$phone','$company_name','$street_address','$address','$city','$state','$country','$zipcode','$comment')");
            $insert_id = $this->db->insert_id();

            return  $insert_id;
  
    }


    function user_order($data)
    {
        $order_number = $data['order_number'];
        $user_id = $data['user_id'];
        $cart_id = $data['cart_id'];
        $subtotal = $data['subtotal'];
        $shipping = $data['shipping'];
        $total = $shipping + $subtotal;
        $coupon_name = $data['coupon_name'];
        $coupon_percent = $data['coupon_percent'];
        $quantity = $data['quantity'];
        $billing_id = $data['billing_id'];
        $coupon_id = $data['coupon_id'];
        $result= $this->db->query("INSERT INTO `tbl_product_order`(`order_number`, `user_id`, `cart_id`,`subtotal`, `total`, `quantity`,`billing_id`,`promocode`,`promo_amount`,`shipping`,`coupon_id`) VALUES ('$order_number','$user_id','$cart_id','$subtotal','$total','$quantity','$billing_id','$coupon_name','$coupon_percent','$shipping','$coupon_id')");
        return $this->db->insert_id();
    }

    function payment_success($orderide)
    {				
        $this->db->where('order_id',$orderide);		
        $this->db->set('payment_status','1');		
        $this->db->update('tbl_product_order');								
    }

    function payment_cancel($orderide){			
        $this -> db -> where('order_id', $orderide);            
        $this -> db -> delete('tbl_product_order');	
        redirect('checkout');	
    }

    function get_all($table,$autofield="",$autofield_val=""){
        $this->db->select('*'); 
        if($autofield!="" && $autofield_val!=""){$this->db->where($autofield, $autofield_val);}
        $result = $this->db->get($table);
        $data_all   = $result->result_array();
        return $data_all;
    }

    //Edit billing address
    function get_all_address($data){
        $this->db->select('UB.*,U._NAME	,U._EMAIL,U._MOBILE,U._ID');
        $this->db->from('users as U');   
        $this->db->join('user_billing_address as UB ', 'UB.user_id = U._ID','left');	
        $this->db->where('_ID',$data['user_id']);
        $this->db->where('billing_id',$data['billing_id']);
        $query = $this->db->get();	
        $data = $query->result();
        return $data;
    }

    function billing_edit($data){	
        $this->db->select('*');
        $this->db->from('user_billing_address');
        $this->db->where('billing_id',$data['billing_id'] );
        $res = $this->db->get()->row_array();	
			
            $this->db->where('billing_id',$data['billing_id']);
            $this->db->set('email',$data['email']);
            $this->db->set('phone',$data['phone']);	
            $this->db->set('name',$data['name']);	
            $this->db->set('company_name',$data['company_name']);				
            $this->db->set('street_address',$data['street_address']);
            $this->db->set('address',$data['address']);
            $this->db->set('city',$data['city']);
            $this->db->set('state',$data['city']);
            $this->db->set('country',$data['country']);
            $this->db->set('zipcode',$data['zipcode']);
            $this->db->set('comment',$data['comment']);
            $this->db->update('user_billing_address');	
            return $data;			  	   
    }

    //Delete Billing address
    function delete_address($data){			
        $this -> db -> where('billing_id',$data);            
        $this -> db -> delete('user_billing_address');
        return true;			
    }

}

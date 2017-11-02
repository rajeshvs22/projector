<?php
class Product_model extends CI_Model {
    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }
    function bought_this_count($res){
        $i=0;
        if(array_key_exists("product_id", $res))
        {
            $pro_id = $res['product_id'];
            $sql = "select C.*,SP.*,O.*,U.* from tbl_cart AS C LEFT JOIN tbl_product AS SP ON SP.product_id = C.product_id LEFT JOIN tbl_product_order AS O ON O.user_id = C.user_id LEFT JOIN users AS U ON U._ID=O.user_id where C.`product_id`='$pro_id' and C.cart_status='0' GROUP by C.cart_id";
            $query = $this->db->query($sql);
            $count = $query->result_array();
            $res['bought_count']= count($count);
        }
        else
        {
            foreach($res as $r)
            {
                $pro_id = $r['product_id'];
                $sql = "select C.*,SP.*,O.*,U.* from tbl_cart AS C LEFT JOIN tbl_product AS SP ON SP.product_id = C.product_id LEFT JOIN tbl_product_order AS O ON O.user_id = C.user_id LEFT JOIN users AS U ON U._ID=O.user_id where C.`product_id`='$pro_id' and C.cart_status='0' GROUP by C.cart_id";
                $query = $this->db->query($sql);
                $count = $query->result_array();
                $res[$i]['bought_count']= count($count);
                $i++;
            }
        }
        return $res;
    }
    function check_offer($res){

        $today = date('Y-m-d');
        $i=0;
        if(array_key_exists("product_id", $res))
        {
if($res['offer']>0 && $res['offer_start_date'] <= $today &&  $res['offer_end_date'] >= $today)
{
    $res['offerprice'] = $res['product_price'] - ($res['product_price'] * ($res['offer']/100));
    $res['offerrange']= '1';
}
else
{
    $res['offerprice'] = $res['product_price'];
    $res['offerrange']= '0';
}

        }
        else
        {

            foreach($res as $r)
            {
if($r['offer']>0 && $r['offer_start_date'] <= $today &&  $r['offer_end_date'] >= $today)
{
    $res[$i]['offerprice'] = $r['product_price'] - ($r['product_price'] * ($r['offer']/100));
    $res[$i]['offerrange']= '1';
}
else
{
    $res[$i]['offerprice'] = $r['product_price'];
    $res[$i]['offerrange']= '0';
}

                $i++;
            }
        }
        return $res;
    }


    function select_product($product_id = '' , $select = '') {
        if($select != ''){
            $this->db->select($select);
        }
        $this->db->from('tbl_product as P');
        if($product_id != ''){
            $this->db->where('product_id', $product_id);
        }
        $res = $this->db->get()->result_array();
        return $res;
    }

    function check_stock($product_id) {
        $this->db->select('tbl_product.*');
        $this->db->from('tbl_product');
        $this->db->where('product_id', $product_id);
        $this->db->where('product_quantity >','0');
        $res = $this->db->get()->result_array();
        return $res;
    }

function check_available_quantity($data) {
$product_id = $data['product_id'];
$cart_qty= $data['cart_qty'];
        $this->db->select('*');
        $this->db->from('tbl_product');
        $this->db->where('product_id', $product_id);
        $this->db->where('product_quantity >=',$cart_qty);
        $res = $this->db->get()->result_array();
//echo $this->db->last_query(); exit;
        return $res;
    }
    function get_product($product_id = '') {
        $this->db->select('tbl_product.*,category.category_name');
        $this->db->from('tbl_product');
        $this->db->join('category', 'category.category_id = tbl_product.category_id', 'left');
        $this->db->where('product_id', $product_id);
        $res = $this->db->get()->row_array();
        $res = $this->bought_this_count($res);
        $res = $this->check_offer($res);
        return $res;
    }
    function get_product_images_api($product_id = '', $feature = '') {
        $this->db->select('tbl_product_images.*');
        $this->db->from('tbl_product_images');
        $this->db->where('referal_id', $product_id);
        $this->db->where('referal_value', 'product_image_single');
        if ($feature != '') {
            $this->db->where('referal_value', $feature);
            $res = $this->db->get()->row_array();
            return $res;
        } else {
            $res = $this->db->get()->result_array();
            return $res;
        }
    }
    function get_product_images($product_id = '', $feature = '') {
        $this->db->select('tbl_product_images.*');
        $this->db->from('tbl_product_images');
        $this->db->where('referal_id', $product_id);
        if ($feature != '') {
            $this->db->where('referal_value', $feature);
            $res = $this->db->get()->row_array();
            return $res;
        } else {
            $res = $this->db->get()->result_array();
            return $res;
        }
    }
        function get_product_images_single_multiple($product_id = '', $feature = '') {
        $this->db->select('tbl_product_images.*');
        $this->db->from('tbl_product_images');
        $this->db->where('referal_id', $product_id);

            $this->db->where('referal_value', $feature);
            $res = $this->db->get()->result_array();
            return $res;
       
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
//echo $this->db->last_query(); exit;

            return $res;
        }else{
            $res = $this->db->get()->result_array();
            return $res;
        } 
    }
    function get_product_list($cat_id = '') {
        $this->db->select('tbl_product.*,category.category_name');
        $this->db->from('tbl_product');
        $this->db->join('category', 'category.category_id = tbl_product.category_id', 'left');
        $res = $this->db->get()->result_array();
        $res = $this->bought_this_count($res);
        $res = $this->check_offer($res);
        return $res;
    }
    function save_product($data) {
	if ($data['product_id']) {
		$product_price = $data['product_price'];
		$actual_amount = $data['product_price'] - ( $data['product_price']*($data['offer']/100));
		$offer = $data['offer'];
		$vales = array('product_price' =>$product_price,'offer' =>$offer,'actual_amount' => $actual_amount);  

		$this->db->where('product_id', $data['product_id']);
		$this->db->where('cart_status','1');
		$this->db->update('tbl_cart', $vales);
		$this->db->where('product_id', $data['product_id']);
		$this->db->update('tbl_product', $data);
		return $data['product_id'];
	} else {
		$this->db->insert('tbl_product', $data);
		$lastdfdata = $this->db->insert_id();            
		return $this->db->insert_id();
	}
    }

    function load_mail_to_all_users($product_id){
        $siteurl= base_url()."product/view/".$product_id;

        // get product url
        $pro_imag_data = $this->db->query("SELECT image_url FROM `tbl_product_images` WHERE referal_id='".$product_id."' AND referal_value='product_image_single'");
        $pro_img_row = $pro_imag_data->row_array();
        $pro_img = base_url().$pro_img_row['image_name'];
        $mailtmpquy = $this->db->query("SELECT * FROM `tbl_email_template` WHERE `tplid`='10'");  
        $res = $mailtmpquy->result_array();
        $queryd = $this->db->query("SELECT _ID,_NAME,_EMAIL FROM `users`"); 
        $res1 = $queryd->result_array();
        $all_user_id = '';
        foreach($res1 as $res1) {
            $all_user_id .= $res1['_ID'].',';
            $this->email->clear();
            $this->load->library('email');
            $this->email->set_mailtype('html');
            $this->email->from('vijaya@aryvart.com', 'Reload');
            $this->email->to($res1['_EMAIL']);
            $this->email->subject($res[0]['tplsubject']);
            $strvariable = str_replace("{Name}", $res1['_NAME'], $res[0]['tplmessage']);
            $strvariable1 = str_replace("URLLINK", $siteurl, $strvariable);
            $strvariable2 = str_replace("{IMAGE}", $pro_img, $strvariable1);
            
            $this->email->message($strvariable2);

           // $send_mail = $this->email->send();    

        }

        $all_user_id = rtrim($all_user_id,',');

        // insert into notification table
        $insert_notification = $this->db->query("insert into notification set notification_type='product', user_id='".$all_user_id."', product_id='".$product_id."'");
    }

    function get_notification_list($userid){
        //$get_list = $this->db->query("SELECT * FROM `notification` WHERE user_id IN(".$userid.")");
        $get_list = $this->db->query("SELECT N.*, P.* FROM `notification` AS N LEFT JOIN tbl_product AS P ON P.product_id = N.product_id WHERE FIND_IN_SET(".$userid.",N.user_id)>0");
        $res = $get_list->result_array();
        $res = $this->bought_this_count($res);
        $res = $this->check_offer($res);
        return $res;
    }

    function delete_row($product_id) {
        $this->db->where('product_id', $product_id);
        $this->db->delete('tbl_product');
    }
    function save_product_image($data) {
        $this->db->insert('tbl_product_images', $data);
        return $this->db->insert_id();
    }
    function save_recently_view_insert($data) {
        $this->db->select('*');
        $this->db->from('recently_viewed_product');
        $this->db->where('product_id',$data['product_id'] );
        $this->db->where('user_id',$data['user_id'] );
        $res = $this->db->get()->row_array();
        if(empty($res)){
            $userid = $data['user_id'];
            $product_id = $data['product_id'];
            $result= $this->db->query("INSERT INTO `recently_viewed_product`(`user_id`, `product_id`) VALUES ('$userid','$product_id')");
            return $this->db->insert_id();
        }
    }
    function get_recent_view($user_id) {
        $this->db->select('RV.*,PI.image_name,P.product_name,P.product_price,P.offer,P.offer_start_date,P.offer_end_date');
        $this->db->from('recently_viewed_product as RV');        
        $this->db->join('tbl_product_images as PI' , 'PI.referal_id = RV.product_id');
        $this->db->join('tbl_product as P' , 'P.product_id = RV.product_id');
        $this->db->where('referal_value','product_image_single');
        $this->db->where('RV.user_id',$user_id);  
        $this->db->order_by("RV.recently_viewed_pro_id","desc");        
        $res = $this->db->get()->result_array(); 
        $res = $this->bought_this_count($res);
        $res = $this->check_offer($res);
        return $res;
    }
    function get_product_offers($offer = '0', $limit = '') {
        $today = date('Y-m-d');
        $this->db->select('tbl_product.*,category.category_name');
        $this->db->from('tbl_product');
        $this->db->join('category', 'category.category_id = tbl_product.category_id', 'left');
        $this->db->where('offer >', 0);
        $this->db->where('offer_start_date <=', $today);
        $this->db->where('offer_end_date >=', $today);
        $this->db->where('stickeyoffer ', '1');
        if ($limit != '') {
            $this->db->limit($limit);
        }
        $res = $this->db->get()->result_array();
//      echo $this->db->last_query();
        $res = $this->bought_this_count($res);
        $res = $this->check_offer($res);
        return $res;
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
    function delete_existing_product_image($img_id,$referal_value){
        //Get Product Image       
        $images = $this->get_images($img_id,$referal_value);
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
    function get_category_product($category_id){    
        $this->db->select('tbl_product.*,category.category_id');
        $this->db->from('tbl_product');
        $this->db->join('category', 'category.category_id = tbl_product.category_id', 'left');
        $this->db->where('category.category_id',$category_id);
        $res = $this->db->get()->result_array();
        $res = $this->bought_this_count($res);
        $res = $this->check_offer($res);
        return $res;
    }

    function get_sub_category_product($category_id,$sub_category_id){    
        $this->db->select('tbl_product.*');
        $this->db->from('tbl_product');
        $this->db->where('tbl_product.category_id',$category_id);
        $this->db->where('tbl_product.subcategory_id',$sub_category_id);
        $res = $this->db->get()->result_array();
        $res = $this->bought_this_count($res);
        $res = $this->check_offer($res);
        return $res;
    }
    function get_related_product($product_id,$data){    
        $category_id = $data['product_details']['category_id']; 
        $query = $this->db->query("SELECT * FROM `tbl_product` WHERE `product_id` NOT IN('".$product_id."') and `category_id`='".$category_id."' LIMIT 0,8");  
        $res = $query->result_array();
        $res = $this->bought_this_count($res);
        $res = $this->check_offer($res);
        return $res;
    }
function get_product_search($product_search){
       
      $sql = "SELECT P.*, PI.* FROM tbl_product AS P LEFT JOIN tbl_product_images AS PI ON PI.referal_id=P.product_id WHERE PI.referal_value='product_image_single' and P.product_name LIKE '%".$product_search."%' GROUP by P.product_id";
         $query = $this->db->query($sql);
        $res = $query->result_array();
        $res = $this->bought_this_count($res);
        $res = $this->check_offer($res);
        return $res;
        

    }
    function get_lated_viewed($limit='', $start='') {
        $this->db->select('tbl_product.*,category.category_name');
        $this->db->from('tbl_product');
        $this->db->join('category', 'category.category_id = tbl_product.category_id', 'left');
        $this->db->order_by("product_id", "desc");
        //$this->db->limit(2,0);
        if($limit!='' ){
            $this->db->limit($limit);
        }   
        $res = $this->db->get()->result_array();
        $res = $this->bought_this_count($res);
        $res = $this->check_offer($res);
        return $res;
    }
    function get_product_count(){
        $query  = $this->db->query("SELECT COUNT(user_id) FROM `tbl_cart` where cart_status='0'");
        return $query->num_rows();
    }
function remove_user_notification($all_user_id,$upide){
        $up_qry =  $this->db->query("update notification set user_id='".$all_user_id."' where notification_id='".$upide."'");
        return true;
    }
}
?>

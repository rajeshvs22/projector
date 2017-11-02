<?php
class Order_detail_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function get_order_detail(){
        $data=$this->db->get('tbl_product_order')->result_array();
        return $data;
    }

    function get_all($table,$autofield="",$autofield_val=""){
        $this->db->select('*'); 
        if($autofield!="" && $autofield_val!=""){$this->db->where($autofield, $autofield_val);}
        $result = $this->db->get($table);
        $data_all   = $result->result_array();
        return $data_all;
    }

    function order_details($orderide){

        $this->db->select('O.*,B.*,U.*');
        $this->db->from('tbl_product_order AS O');
        $this->db->join('user_billing_address AS B' , 'B.billing_id = O.billing_id'); 
        $this->db->join('users AS U' , 'U._ID = B.user_id');    
        $this->db->where('O.order_id',$orderide);
        $this->db->where('O.payment_status','1');
        $this->db->order_by("O.order_id", "DESC");
        $query = $this->db->get();
        $order_info = $query->result_array();
        // echo $this->db->last_query();
        //echo "<pre>";print_r($order_info);exit;
        $cart_info = array();
        $temp = array();
        $i = 1;
        foreach ($order_info as $order_) {
            $sql_2 = "SELECT C.*,P.product_name FROM tbl_cart AS C JOIN tbl_product AS P ON P.product_id = C.product_id
WHERE C.cart_id IN(" . $order_['cart_id'] . ")";
            $query_2 = $this->db->query($sql_2);
            $order_['cart_info'] = $query_2->result_array();
            $temp[] = $order_;
            $i++;
        }
        return $temp;
    }

    function cart_details($cart_id){
        $sql = "select SP.*,PI.* from tbl_cart AS C LEFT JOIN tbl_product AS SP ON SP.product_id = C.product_id LEFT JOIN tbl_product_images AS PI ON PI.referal_id=C.product_id where C.cart_id='".$cart_id."' AND PI.referal_value='product_image_single'";
        $query = $this->db->query($sql);
        return $query->row_array();
    }

    function user_order_details($user_id = '',$order_number =''){
        $this->db->select('O.*,B.*');
        $this->db->from('tbl_product_order AS O');
        $this->db->join('user_billing_address AS B' , 'B.billing_id = O.billing_id');     
        if($user_id != ''){
            $this->db->where('O.user_id',$user_id);
        }
        if($order_number != ''){
            $this->db->where('O.order_number',$order_number);
        }
        $this->db->where('O.payment_status','1');
        $this->db->order_by("O.order_id", "DESC");
        $query = $this->db->get();
        $order_info = $query->result_array();
        //echo $this->db->last_query();
        //echo "<pre>";print_r($order_info);exit;
        $cart_info = array();
        $temp = array();
        $i = 1;
        foreach ($order_info as $order_) {
            $sql_2 = "SELECT C.*,P.* FROM tbl_cart AS C JOIN tbl_product AS P ON P.product_id = C.product_id WHERE C.cart_id IN(" . $order_['cart_id'] . ")";
            $query_2 = $this->db->query($sql_2);
            $order_['cart_info'] = $query_2->result_array();
            $temp[] = $order_;
            $i++;
        }
        return $temp;
    }

    function user_order_details_api($user_id = '',$order_number =''){
        $this->db->select('O.*,B.*');
        $this->db->from('tbl_product_order AS O');
        $this->db->join('user_billing_address AS B' , 'B.billing_id = O.billing_id');     
        if($user_id != ''){
            $this->db->where('O.user_id',$user_id);
        }
        if($order_number != ''){
            $this->db->where('O.order_number',$order_number);
        }
        $this->db->where('O.payment_status','1');
        $this->db->order_by("O.order_id", "DESC");
        $query = $this->db->get();
        $order_info = $query->result_array();
        //echo $this->db->last_query();
        //echo "<pre>";print_r($order_info);exit;
        $cart_info = array();
        $temp = array();
        $i = 1;
        foreach ($order_info as $order_) {
            $sql_2 = "SELECT C.*,P.* FROM tbl_cart AS C JOIN tbl_product AS P ON P.product_id = C.product_id
WHERE C.cart_id IN(" . $order_['cart_id'] . ")";
            $query_2 = $this->db->query($sql_2);
            $order_['cart_info'] = $query_2->result_array();
            //print_r($order_['cart_info']);
            //exit;
            $j=0;
            foreach ($order_['cart_info'] as $order_2) {
                $order_['cart_info'][$j]['product_image'] = $this->product_model->get_product_images($order_2['product_id']);
                $order_['cart_info'][$j]['product_details'] = $this->product_model->get_product($order_2['product_id']);
                $inputdata2 = array('product_id' => $order_2['product_id'], 'user_id' => $user_id);
                $order_['cart_info'][$j]['review_detail']=$this->order_detail_model->order_review_details($inputdata2);
                $j++;
            }
            $temp[] = $order_;
            $i++;
        }
        return $temp;
    }

    function new_listing($user_id){
        $this->db->where('user_id', $user_id);
        $this->db->where('payment_status', '1');
        $query= $this->db->get('tbl_product_order');
        $order = $query->result_array();
        $i=0;
        if(!empty($order))
        {
            foreach($order as $val){
                $order[$i]['order_created_data'] = date('F j, Y',strtotime($order[$i]['order_created_data']));
                $sql = " SELECT * FROM tbl_cart WHERE cart_id IN (".$val['cart_id'].")";
                $query = $this->db->query($sql);
                $cart = $query->result_array();
                $j=0;
                foreach($cart as $product){
                    $product_id = $product['product_id']; 
                    $img = $this->product_model->get_product_images($product_id);
                    $order[$i]['product_details'][$j]  =  $this->product_model->get_product($product_id);
                    $order[$i]['product_details'][$j]['product_image'] =  $img;
                    $inputdata2 = array('product_id' => $product_id, 'user_id' => $user_id);
                    $order[$i]['product_details'][$j]['review_detail']=$this->order_detail_model->order_review_details($inputdata2);
                    $j++;
                }
                $i++;
            }
        }
        return $order;
    }

    function order_review_details($data){       
        $this->db->select('*');
        $this->db->from('tbl_order_review_details');
        if(!empty($data['user_id'])){
            $this->db->where('user_id',$data['user_id']);
        }
        $this->db->join('users', 'users._ID = tbl_order_review_details.user_id', 'left');
        $this->db->where('product_id',$data['product_id']);
        $res = $this->db->get()->result_array();
      //  if(empty($res))
       // {
        //    $next = $this->db->query("SHOW TABLE STATUS LIKE 'tbl_order_review_details'");
        //    $next = $next->row(0);
        //    $res = $next->Auto_increment;
       // }
        return $res;
    }

    function update_rating($data){
        $review = $this->order_review_details($data);   
        $user_id = $data['user_id'];
        $product_id = $data['product_id'];
        $rating = $data['rating'];  
        $comment = $data['comment'];
        if(empty($review)){
            $result= $this->db->query("INSERT INTO `tbl_order_review_details`(`user_id`, `product_id`,`rating`,`reviews`) VALUES ('$user_id','$product_id','$rating','$comment')");
            return true;
        }else{
            $sql ="UPDATE tbl_order_review_details SET rating='" . $data["rating"] . "' , reviews='".$data["comment"]."' WHERE id='" . $data["id"] . "'";
            $query = $this->db->query($sql);
            return true;
        }
    }
    function review_update($data){
        $review = $this->order_review_details($data);   
        $user_id = $data['user_id'];
        $product_id = $data['product_id'];      
        $comment = $data['comment'];
        if(is_string($review)){
            $result= $this->db->query("INSERT INTO `tbl_order_review_details`(`user_id`, `product_id`,`reviews`) VALUES ('$user_id','$product_id','$comment')");
            return true;
        }else{
            $sql ="UPDATE tbl_order_review_details SET reviews='".$data["comment"]."' WHERE id='" . $data["id"] . "'";          
            $query = $this->db->query($sql);
            return true;
        }
    }

    function review_details($product_id){       
        $this->db->select('*');
        $this->db->from('tbl_order_review_details');       
        $this->db->join('users', 'users._ID = tbl_order_review_details.user_id', 'left');
        $this->db->where('product_id',$product_id);
        $this->db->where('status','1');
        $this->db->order_by('id','desc');
        $res = $this->db->get()->result_array();
        return $res;
    }

    function get_review_details(){
        $data=$this->db->get('tbl_order_review_details')->result_array();
        return $data;
    }  
 
    function review_inner_details($id){
        $this->db->select('users.*,tbl_order_review_details.*,tbl_product.*,tbl_product_images.image_name');
        $this->db->from('tbl_order_review_details');    
        $this->db->join('users', 'users._ID = tbl_order_review_details.user_id', 'left');
        $this->db->join('tbl_product', 'tbl_product.product_id = tbl_order_review_details.product_id', 'left');
        $this->db->join('tbl_product_images', ' tbl_product_images.referal_id = tbl_order_review_details.product_id', 'left');
        $this->db->where('id',$id);
        $this->db->group_by('tbl_product.product_id'); 
        $res = $this->db->get()->result_array();        
        return $res;
    }

    function update_review_status($data){
        $sql ="UPDATE tbl_order_review_details SET status='".$data["status"]."' WHERE id='" . $data["id"] ."'";         
        $query = $this->db->query($sql);        
        $this->db->select('*');
        $this->db->from('tbl_order_review_details');
        $this->db->where('id',$data['id']);
        $res = $this->db->get()->result_array();
        //echo $this->db->last_query();   
        return $res;
    }

    function review_count($data){
        if(is_array($data))
        {
            $product_id = $data['product_id']; 
        }
        else
        {
            $product_id = $data;
        }
        $star1=0; $star2=0; $star3=0; $star4=0; $star5=0;
        $sql ="SELECT sum(rating) as rat FROM `tbl_order_review_details` WHERE `product_id`='".$product_id."'";         
        $query = $this->db->query($sql);
        $res=$query->result_array();
        $overall = $res[0]['rat'];
        $sql ="SELECT * FROM `tbl_order_review_details` WHERE `product_id`='".$product_id."'";         
        $query = $this->db->query($sql);
        $res=$query->result_array();
        $mainoverall= count($res);
        if(count($res) !=0 )
        {
            $overallcountpercent = $overall / count($res);
        }
        else
        {
            $overallcountpercent = 0;
        } 
        $raterscount = 0;
        for($i=1;$i<=5;$i++)
        {
            $sql ="SELECT * FROM `tbl_order_review_details` WHERE `product_id`='".$product_id."' and `rating`='".$i."'";            
            $query = $this->db->query($sql);
            $res = $query->result_array();
            $var = "star$i";
            $count = $$var;
            $$var = count($res);
            $raterscount = $raterscount + count($res);
            $sql ="SELECT sum(rating) as rat FROM `tbl_order_review_details` WHERE `product_id`='".$product_id."' and `rating`='".$i."'";           
            $query = $this->db->query($sql);
            $res=$query->result_array();
            $overall2 = $res[0]['rat'];
            if(count($res) !=0 )
            {
                $over[] =$overall2 / count($res);
            }
            else
            {
                $over[] = 0;
            }
        }
        for ($i=1;$i<=5;++$i) {
            $var = "star$i";
            $count = $$var;
            if($mainoverall !=0 )
            {
                $percent = $count * 100 / $mainoverall;
            }
            else
            {
                $overall = 0;
                $percent = 0;
            }
            $data2['usercount']=$mainoverall;
            $data2['starcount'][]=$count;
            $data2['overallcount']=$overallcountpercent;
            $data2['starpercent'][]=$percent;
            if($raterscount !=0 )
            {
                $data2['overallpercent']= $overall/$raterscount;
            }
            else
            {
                $data2['overallpercent']= 0;
            }
        }
        return $data2;
    }

    function get_search_value($data){
        $user_id = $data['user_id'];
        $search = $data['search'];
        $sql = "select C.*,SP.*,PI.*,O.*,U.*,B.* from tbl_cart AS C LEFT JOIN tbl_product AS SP ON SP.product_id = C.product_id  LEFT JOIN
tbl_product_images AS PI ON PI.referal_id=C.product_id LEFT JOIN tbl_product_order AS O ON O.user_id = C.user_id JOIN user_billing_address AS B ON B.billing_id = O.billing_id LEFT JOIN users AS U ON U._ID=O.user_id where O.user_id='".$user_id."' AND PI.referal_value='product_image_single' AND SP.product_name LIKE '%".$search."%' GROUP by SP.product_id";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    function update_name($data){
        $user_id = $data['user_id'];
        $user_name = $data['user_name'];
        $select = "select user_name from tbl_order_review_details where user_id='$user_id'";
        $res = $this->db->query($select);
        if(empty($res)){
            $sql ="insert into tbl_order_review_details (`user_name`)values('$user_name')";	
            $res = $this->db->query($sql);
            return $res;
        }else{
            $sql ="UPDATE tbl_order_review_details SET user_name='".$data["user_name"]."'  WHERE user_id='" . $data["user_id"] . "'";          
            $query = $this->db->query($sql);
            return true;
        }
    }

}
?>

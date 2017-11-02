<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Content_model extends CI_Model
{
    public function get_all_count()
    {
        $sql = "SELECT COUNT(*) as tol_records FROM tbl_product";       
        $result = $this->db->query($sql)->row();
        return $result;
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


    public function get_all_content($start,$content_per_page)
    {
        $sql = "SELECT * FROM  tbl_product LIMIT $start,$content_per_page";       
        $result = $this->db->query($sql)->result();
        $result = json_decode(json_encode($result),true);
        $result = $this->bought_this_count($result);
        $result = $this->check_offer($result);
        $result = json_decode(json_encode($result));
        return $result;
    }

    public function get_all_content_recent($start,$content_per_page,$user_id)
    {

        $sql = "SELECT `RV`.*, `PI`.`image_name`, `P`.`product_name`, `P`.`product_price`, `P`.`offer`,`P`.`offer_start_date`,`P`.`offer_end_date`, `P`.`almost_gone`, `P`.`product_quantity` FROM `recently_viewed_product` as `RV` JOIN `tbl_product_images` as `PI` ON `PI`.`referal_id` = `RV`.`product_id` JOIN `tbl_product` as `P` ON `P`.`product_id` = `RV`.`product_id` WHERE `referal_value` = 'product_image_single' AND `RV`.`user_id` = '$user_id' ORDER BY `RV`.`recently_viewed_pro_id` DESC LIMIT $start,$content_per_page";       
        $result = $this->db->query($sql)->result();
        $result = json_decode(json_encode($result),true);
        $result = $this->bought_this_count($result);
        $result = $this->check_offer($result);
        $result = json_decode(json_encode($result));
        return $result;
    }
    public function get_all_content_latest($start,$content_per_page)
    {

        $sql = "SELECT `tbl_product`.*, `category`.`category_name` FROM `tbl_product` LEFT JOIN `category` ON `category`.`category_id` = `tbl_product`.`category_id` ORDER BY `product_id` DESC LIMIT $start,$content_per_page";       
        $result = $this->db->query($sql)->result();
        $result = json_decode(json_encode($result),true);
        $result = $this->bought_this_count($result);
        $result = $this->check_offer($result);
        $result = json_decode(json_encode($result));
        return $result;
    }

}
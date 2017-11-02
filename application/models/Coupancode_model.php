<?php
class Coupancode_model extends CI_Model
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function get_coupan_code($coupan_id = ''){
        
        if($coupan_id){
            $this->db->select('*');
            $this->db->where('coupan_id' , $coupan_id);
            $res = $this->db->get('tbl_coupan_code')->row_array();   
            return $res;
        }
        $res = $this->db->get('tbl_coupan_code')->result_array();        
        return $res;
    }
    
    function save_coupan($data){
        if($data['coupan_id'])
        {
                $this->db->where('coupan_id', $data['coupan_id']);
                $this->db->update('tbl_coupan_code', $data);
                return $data['coupan_id'];
        }
        else
        {
                $this->db->insert('tbl_coupan_code', $data);				
                return $this->db->insert_id();

        }
    }
    
     
    function select_coupan_code()
   {
       $res = $this->db->get('tbl_coupan_code')->result_array();        
       return $res;
   }
   
    function delete_row($coupan_id){

                $this->db->where('coupan_id', $coupan_id);
                $this->db->delete('tbl_coupan_code');

    }	
    function coupan_code($coupan_code,$user_id){

        $sql = "SELECT C.*,UC.used_coupan from tbl_coupan_code AS C left join tbl_user_coupan AS UC ON UC.coupan_id=C.coupan_id AND UC.user_id = '$user_id'  where C.coupan_code='$coupan_code'"; 

        $query = $this->db->query($sql);
        $res = $query->result_array();

        return $res; 

    }
    function coupan_code_update($order_id){

        $sql = "SELECT * FROM `tbl_product_order` WHERE order_id='$order_id'"; 
        $query = $this->db->query($sql);
        $res = $query->row_array();

        $coupon_id = $res['coupon_id'];
        $user_id = $res['user_id'];

        $sql = "SELECT CU.* from tbl_user_coupan AS CU where CU.user_id = '$user_id' and CU.coupan_id = '$coupon_id'"; 
        $query = $this->db->query($sql);
        $res = $query->result_array();
        if(!empty($res))
        {
                $this->db->where('coupan_id', $coupon_id);
                $this->db->where('user_id', $user_id);
                $this->db->set('used_coupan', 'used_coupan+1', FALSE);
                $this->db->update('tbl_user_coupan');
                return true;
        }
        else
        {
                $this->db->insert('tbl_user_coupan', array('coupan_id'=>$coupon_id,'user_id'=>$user_id));				
                return true;
        }


    }

}
?>

<?php
class Tag_model extends CI_Model
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function get_tag($tag_id = ''){
        
        if($tag_id){
            $this->db->where('tag_id' , $tag_id);
            $res = $this->db->get('tag')->row_array();        
            return $res;
        }
        $res = $this->db->get('tag')->result_array();        
        return $res;
    }
    
    function save_tag($data){
        if($data['tag_id'])
        {
                $this->db->where('tag_id', $data['tag_id']);
                $this->db->update('tag', $data);
                return $data['tag_id'];
        }
        else
        {
                $this->db->insert('tag', $data);				
                return $this->db->insert_id();
        }
    }
    
    /*************** Sub Category *****************/
    function get_sub_category($sub_cat_id = ''){
        
        $this->db->join('tag as G' , 'G._TAG_ID = SC._CAT_ID');
        
        if($sub_cat_id){
            $this->db->where('_SUB_CAT_ID' , $sub_cat_id);
            $res = $this->db->get('sub_category as SC')->row();        
            return $res;
        }
        $res = $this->db->get('sub_category as SC')->result(); 
        
        return $res;
    }
    
    function save_sub_category($data){
        if($data['_SUB_CAT_ID'])
        {
                $this->db->where('_SUB_CAT_ID', $data['_SUB_CAT_ID']);
                $this->db->update('sub_category', $data);
                return $data['_SUB_CAT_ID'];
        }
        else
        {
                $this->db->insert('sub_category', $data);
                return $this->db->insert_id();
        }
    }
    
    function select_tag()
   {
       $res = $this->db->get('tag')->result_array();        
       return $res;
   }
   
    function delete_row($tag_id){

                $this->db->where('tag_id', $tag_id);
                $this->db->delete('tag');

    }	
}
?>
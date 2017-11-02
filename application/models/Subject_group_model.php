<?php
Class Subject_group_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    /*     * ******************************************************************

     * ****************************************************************** */

    function all_subject_group($limit = 0, $offset = 0, $order_by = 'subcategory_id', $direction = 'DESC',$search = array()) {
        
        $this->db->order_by($order_by, $direction);
        if ($limit > 0) {
            $this->db->limit($limit, $offset);
        }
        
        $likeArray = array('SG.subcategory_name','SL.category_name');
        $this->reload_mgt->backend_search($search , 'subcategory_created_date',$likeArray );//search
       
        if(!empty($search['subcategory_ids'])){ 
            $this->db->where_in('subcategory_id', $search['subcategory_ids']);
        }
        
        $this->db->select('SG.*,SL.category_id,SL.category_name');
        $this->db->from('product_subcategory as SG');
        $this->db->join('category as SL' , 'SL.category_id = SG.category_id');        
        $result = $this->db->get();
        
        return $result->result_array();
    }
    


    function count_subject_group($search = array()) {
        
        $likeArray = array('SG.subcategory_name','SL.category_name');
        $this->reload_mgt->backend_search($search , 'subcategory_created_date',$likeArray );//search
       
        $this->db->select('SG.*,SL.category_name');
        $this->db->from('product_subcategory as SG');
        $this->db->join('category as SL' , 'SL.category_id = SG.category_id');
        
        
        return $this->db->count_all_results();
    }

    function get_subject_groups($id='', $select = '') {
        
        if($select != ''){ $this->db->select($select);  }
        if($id != ''){ $this->db->where( 'category_id', $id ); }
        
        $result = $this->db->get('product_subcategory');

        return $result->result();
    }

    function get_subject_group($userid) {

        $result = $this->db->get_where('product_subcategory', array('subcategory_id' => $userid));
        return $result->row();
    }
    
    function getSubject_groupDropdown($id = '' ,$type = ''){

        $result = $this->get_subject_groups($id,'subcategory_id, subcategory_name');
        
        $data   = '';

        if($type == 'data'){
            $drop = array('' => '-Select-');
            foreach ($result as $val) {
                $drop[$val->subcategory_id] = $val->subcategory_name;
            }
            $data = $drop;
        }else{
            
            $element = '<option value="">-Select-</option>';
            foreach ($result as $val) {
                $element .= '<option value="'.$val->subcategory_id.'">'.$val->subcategory_name.'</option>';
            }
            $data = $element;
        }

        return  $data;
    }
    
    function save($subject_group) {
        if ($subject_group['subcategory_id']) {
            $this->db->where('subcategory_id', $subject_group['subcategory_id']);
            $this->db->update('product_subcategory', $subject_group);
            return $subject_group['subcategory_id'];
        } else {
            $this->db->insert('product_subcategory', $subject_group);
            return $this->db->insert_id();
        }
    }
    
    function get_subject_group_in($con = array()) {
                
        $this->db->select('SG.*,SL.category_id,SL.category_name');
        $this->db->from('product_subcategory as SG');
        $this->db->join('category as SL' , 'SL.category_id = SG.category_id' );
       
        $this->db->where_in('SG.subcategory_id',$con['subject_group_data']);
        
        $result = $this->db->get();
        
        return $result->result_array();
    }
    

    function delete($id) {

        $this->db->where('subcategory_id', $id);
        $this->db->delete('product_subcategory');
    }
    
    function isMakeActive($id){
        
        $this->db->update('product_subcategory', array('subject_group_active'=>1), array('subcategory_id' => $id));
        return $flag = 1;
        
    }
    
    function isMakeInactive($id){
        $this->db->update('product_subcategory', array('subject_group_active'=>0), array('subcategory_id' => $id));
        return $flag = 1;
    }
	 function select_subcategory(){
        $res = $this->db->get('product_subcategory')->result_array();        
        return $res;
    }

}
?>
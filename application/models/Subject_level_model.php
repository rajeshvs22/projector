<?php
Class Subject_level_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    /*     * ******************************************************************

     * ****************************************************************** */

    function all_subject_level($limit = 0, $offset = 0, $order_by = 'category_id', $direction = 'DESC',$search = array()) {
        
        $this->db->order_by($order_by, $direction);
        if ($limit > 0) {
            $this->db->limit($limit, $offset);
        }
        
        $likeArray = array('category.category_name');
        $this->reload_mgt->backend_search($search , 'subject_level_created_date',$likeArray );//search
       
        $result = $this->db->get('category');
        
        return $result->result_array();
    }
    


    function count_subject_level($search = array()) {
        
        $likeArray = array('category.category_name');
        $this->reload_mgt->backend_search($search , 'subject_level_created_date',$likeArray );//search
        
        
        return $this->db->count_all_results('category');
    }

    function get_subject_levels($id='', $select = '') {
        
        if($select != ''){ $this->db->select($select);  }
        if($id != ''){ $this->db->where( 'company_id', $id ); }
        
        $result = $this->db->get('category');

        return $result->result();
    }

    function get_subject_level($userid) {

        $result = $this->db->get_where('category', array('category_id' => $userid));
        return $result->row();
    }
    
    function get_category_ids($cond = array()) {
        
        $this->db->select('SL.category_id,SL.category_name');
        $this->db->where_in('SL.category_id' , $cond['subject_ids'] );
        $result = $this->db->get('category as SL');
        
        return $result->result_array();
    }
    
    function getSubject_levelDropdown($id = '' ,$type = ''){

        $result = $this->get_subject_levels($id,'category_id, category_name');
        
        $data   = '';

        if($type == 'data'){
            $drop = array('' => '-Select-');
            foreach ($result as $val) {
                $drop[$val->category_id] = $val->category_name;
            }
            $data = $drop;
        }else{
            
            $element = '<option value="">-Select-</option>';
            foreach ($result as $val) {
                $element .= '<option value="'.$val->category_id.'">'.$val->category_name.'</option>';
            }
            $data = $element;
        }

        return  $data;
    }
    
    function save($subject_level) {
        if ($subject_level['category_id']) {
            $this->db->where('category_id', $subject_level['category_id']);
            $this->db->update('category', $subject_level);
            return $subject_level['category_id'];
        } else {
            $this->db->insert('category', $subject_level);
            return $this->db->insert_id();
        }
    }

    function delete($prodid) {

        $this->db->where('category_id', $prodid);
        $this->db->delete('category');
    }
    
    function isMakeActive($id){
        
        $this->db->update('category', array('subject_level_active'=>1), array('category_id' => $id));
        return $flag = 1;
        
    }
    
    function isMakeInactive($id){
        $this->db->update('category', array('subject_level_active'=>0), array('category_id' => $id));
        return $flag = 1;
    }

}
?>
<?php

class Category_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    function get_category($cat_id = '') {

        if ($cat_id) {

            $this->db->where('category_id', $cat_id);
            $res = $this->db->get('ary_category')->row_array();
            // echo $this->db->last_query(); exit;
            return $res;
        }
        $category = $this->db->get('ary_category')->result_array();
        $i = 0;
        $new = array();
        foreach ($category as $categ) {
            $new[] = $categ;
            $this->db->where('category_id', $categ['category_id']);
            $new2 = $this->db->get('ary_category')->result_array();
            array_push($new[$i], $new2);
            $i++;
        }
        return $new;
    }

    function get_category_and_sub($cat_id = '') {

        if ($cat_id) {
            $this->db->where('category_id', $cat_id);
            $res = $this->db->get('ary_category')->row_array();
            return $res;
        }
        $category = $this->db->get('ary_category')->result_array();
        $i = 0;
        foreach ($category as $categ) {
            $new[] = $categ;
            $this->db->where('category_id', $categ['category_id']);
            $new2 = $this->db->get('product_subcategory')->result_array();
            array_push($new[$i], $new2);
            $i++;
        }
        return $new;
    }

    function save_category($data) {
        if ($data['category_id']) {
            $this->db->where('category_id', $data['category_id']);
            $this->db->update('ary_category', $data);
            return $data['category_id'];
        } else {

            $this->db->select('*');
            $this->db->from('ary_category');
            $this->db->where('en_cat', $data['en_cat']);
            $this->db->where('parent_id', $data['parent_id']);
            $res = $this->db->get()->row_array();
            if (empty($res)) {
                $this->db->insert('ary_category', $data);
                return $this->db->insert_id();
            }
        }
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
            return $res;
        } else {
            $res = $this->db->get()->result_array();
            return $res;
        }
    }

    function get_category_images($category_id = '', $feature = '') {
        $this->db->select('tbl_product_images.*');
        $this->db->from('tbl_product_images');
        $this->db->where('referal_id', $category_id);
        //$this->db->where('referal_value','category_image');
        if ($feature != '') {
            $this->db->where('referal_value', $feature);
            $res = $this->db->get()->row_array();
            return $res;
        } else {
            $res = $this->db->get()->result_array();
            return $res;
        }
    }

    function delete_single_category_image($image_id = "", $referal_id = "", $referal_value = "") {
        //Get Product Image       
        $images = $this->get_category_images($referal_id, $referal_value);
        //Delete table
        $this->db->where('image_id', $images['image_id']);
        $this->db->delete('tbl_product_images');
        //Unlink File
        if (file_exists($images['file_path'] . $images['image_name'])) {
            unlink($images['file_path'] . $images['image_name']);
            //unlink($images['file_path'].'brand/'.$images['image_name']);
            //unlink($images['file_path'].'offer/'.$images['image_name']); 
        }
    }

    function save_category_image($data) {

        $this->db->insert('tbl_product_images', $data);
        return $this->db->insert_id();
    }

    function select_category() {
        $res = $this->db->get('ary_category')->result_array();
        return $res;
    }

    function fetchcategory($parent = 0, $spacing = '', $user_tree_array = '') {

        if (!is_array($user_tree_array))
            $user_tree_array = array();

        $sql = "SELECT * FROM `ary_category` WHERE 1 AND `parent_id` ='$parent' ORDER BY category_id ASC";  // query
        $query = $this->db->query($sql);
        $val = $query->result_array();

        foreach ($val as $cat_sub) {
            $user_tree_array[] = array("category_id" => $cat_sub['category_id'], "en_cat" => $spacing . $cat_sub['en_cat']);
            $user_tree_array = $this->fetchcategory($cat_sub['category_id'], $spacing . '&nbsp;&nbsp;', $user_tree_array);
        }
        return $user_tree_array;
    }

    function delete_row($category_id) {

        $this->db->where('category_id', $category_id);
        $this->db->delete('ary_category');
    }

}

?>

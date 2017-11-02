<?php

class Dashboard extends Admin_Controller {

    function __construct() {
        parent::__construct();
        remove_ssl();
        $this->load->model(array('category_model', 'product_model', 'order_detail_model'));
        $this->load->helper('date');
        $this->load->helper('rajutility');
    }

    function index() {
        $this->load->helper('url');
        $data = array();
        $data['product_category'] = '202';//$this->category_model->get_category();
        $category_count = '202';//count($data['product_category']);
        $data['products'] = '888';//$this->product_model->get_product_list();
        $product_count =  '888';//count($data['products']);
        $data['order_details'] =  '456';//$this->order_detail_model->get_order_detail();
        $order_details  =  '456';//count($data['order_details']);

        $data['user_count'] = $this->db->count_all('users');

        $data['label'] = array('label1' => '1', 'label2' => '2', 'label3' => '3', 'label4' => '4');
        $data['page_title'] = 'dashboard';
        $data['total_student'] = '';
        $data['orders'] = array('total' => '');
        $data['total_parents'] = '';
        $data['total_teacher'] = '';
        $data['total_subscriber'] = '';

        $data['label'] = array('label1' => 'Category', 'label2' => 'Product', 'label3' => 'User', 'label4' => 'Order');

        $order = 100;

        $orderArr = array('category' => $category_count, 'product' => $product_count, 'Oder_detail' => $order_details);


        $data['total_student'] = '252';
        $data['orders'] = $orderArr;
        $data['total_parents'] = '36';
        $data['total_teacher'] = '652';
        $data['total_subscriber'] = 30;






        $this->load->view($this->config->item('admin_folder') . '/dashboard', $data);
    }

}

?>
<?php 

function object_to_array($object) {
    return (array) $object;
}
function array_to_object($array) {
    return (object) $array;
}
function array_to_object_two_dimension($array) {
    
    $array = array_to_object($array);
    foreach($array as $k=>$a){
        $array[$k] =  (object) $a;
    }
    return (object) $array;
}

function load_single_image($product_id,$file) {

    $CI = get_instance();
    $CI->load->model('product_model');
    $CI->load->library('reload_mgt');

    $filename = md5(date('Y-m-d H:i:s:u') . rand());
    $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
    $filename_ext = $filename . '.' . $ext;

    $config['upload_path'] = './uploads/product/';
    $config['allowed_types'] = 'gif|jpg|png|jpeg';
    //$config['maintain_ratio'] = true;
    //$config['width'] = 800;
    //$config['height'] = 800;
    $config['min_width'] = '800';
    $config['min_height'] = '600';
    $config['file_name'] = $filename_ext;
    $CI->load->library('upload', $config);
    $CI->upload->initialize($config);

    if ($CI->upload->do_upload('single_image_local')) {

        $image_data = $CI->upload->data(); //upload the image
        //echo "<pre>";print_r($file);
        //echo "<pre>";print_r($image_data);exit;
        /* image resize */
        $resize_img_values = $CI->reload_mgt->get_resize_img_values();
        $resizeconfig = array();
        foreach ($resize_img_values as $img_val) {

            $resizeconfig['source_image'] = $image_data['full_path'];
            $resizeconfig['new_image'] = $img_val['new_image'];
            $resizeconfig['maintain_ratio'] = $img_val['maintain_ratio'];
            $resizeconfig['width'] = $img_val['width'];
            $resizeconfig['height'] = $img_val['height'];

            $CI->image_lib->initialize($resizeconfig);
            $CI->image_lib->resize();
        }


        /* Insert Images */
        $uploaddata['referal_id'] = $product_id;
        $uploaddata['referal_value'] = 'product_image_single';
        $uploaddata['image_name'] = $image_data['file_name'];
        $uploaddata['original_name'] = $image_data['client_name'];
        $uploaddata['image_url'] = '/uploads/product/' . $image_data['file_name'];
        //$uploaddata['full_path']    = $image_data['full_path'];
        $uploaddata['file_path'] = $image_data['file_path'];
        $uploaddata['image_type'] = $image_data['file_type'];
        $uploaddata['file_size'] = $image_data['file_size'];
        $uploaddata['status'] = 1;

        $CI->product_model->save_product_image($uploaddata);
    }
}
function category_single_image($category_id,$file) {

    $CI = get_instance();
    $CI->load->model('category_model');
    $CI->load->library('reload_mgt');

    $filename = md5(date('Y-m-d H:i:s:u') . rand());
    $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
    $filename_ext = $filename . '.' . $ext;

    $config['upload_path'] = './uploads/category/';
    $config['allowed_types'] = 'gif|jpg|png|jpeg';
    //$config['maintain_ratio'] = true;
    //$config['width'] = 800;
    //$config['height'] = 800;
    $config['min_width'] = '800';
    $config['min_height'] = '600';
    $config['file_name'] = $filename_ext;

    $CI->load->library('upload', $config);
    $CI->upload->initialize($config);

    if ($CI->upload->do_upload('single_image_local')) {


        $image_data = $CI->upload->data(); //upload the image
        //echo "<pre>";print_r($file);
        //echo "<pre>";print_r($image_data);exit;
        /* image resize */
        $resize_img_values = $CI->reload_mgt->get_resize_img_values();
        $resizeconfig = array();
        foreach ($resize_img_values as $img_val) {

            $resizeconfig['source_image'] = $image_data['full_path'];
            $resizeconfig['new_image'] = $img_val['new_image'];
            $resizeconfig['maintain_ratio'] = $img_val['maintain_ratio'];
            $resizeconfig['width'] = $img_val['width'];
            $resizeconfig['height'] = $img_val['height'];

            $CI->image_lib->initialize($resizeconfig);
            $CI->image_lib->resize();
        }


        /* Insert Images */
        $uploaddata['referal_id'] = $category_id;
        $uploaddata['referal_value'] = 'category_image';
        $uploaddata['image_name'] = $image_data['file_name'];
        $uploaddata['original_name'] = $image_data['client_name'];
        $uploaddata['image_url'] = '/uploads/category/' . $image_data['file_name'];
        //$uploaddata['full_path']    = $image_data['full_path'];
        $uploaddata['file_path'] = $image_data['file_path'];
        $uploaddata['image_type'] = $image_data['file_type'];
        $uploaddata['file_size'] = $image_data['file_size'];
        $uploaddata['status'] = 1;

        $CI->category_model->save_category_image($uploaddata);
    }
}
function banner_single_image($banner_id,$file) {

    $CI = get_instance();
    $CI->load->model('banner_model');
    $CI->load->library('reload_mgt');

    $filename = md5(date('Y-m-d H:i:s:u') . rand());
    $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
    $filename_ext = $filename . '.' . $ext;

    $config['upload_path'] = './uploads/banner/';
    $config['allowed_types'] = 'gif|jpg|png|jpeg';
    //$config['maintain_ratio'] = true;
    //$config['width'] = 800;
    //$config['height'] = 800;
    $config['min_width'] = '800';
    $config['min_height'] = '600';
    $config['file_name'] = $filename_ext;

    $CI->load->library('upload', $config);
    $CI->upload->initialize($config);

    if ($CI->upload->do_upload('single_image_local')) {


        $image_data = $CI->upload->data(); //upload the image
        //echo "<pre>";print_r($file);
        //echo "<pre>";print_r($image_data);exit;
        /* image resize */
        $resize_img_values = $CI->reload_mgt->get_resize_img_values();
        $resizeconfig = array();
        foreach ($resize_img_values as $img_val) {

            $resizeconfig['source_image'] = $image_data['full_path'];
            $resizeconfig['new_image'] = $img_val['new_image'];
            $resizeconfig['maintain_ratio'] = $img_val['maintain_ratio'];
            $resizeconfig['width'] = $img_val['width'];
            $resizeconfig['height'] = $img_val['height'];

            $CI->image_lib->initialize($resizeconfig);
            $CI->image_lib->resize();
        }


        /* Insert Images */
        $uploaddata['referal_id'] = $banner_id;
        $uploaddata['referal_value'] = 'banner_image_single';
        $uploaddata['image_name'] = $image_data['file_name'];
        $uploaddata['original_name'] = $image_data['client_name'];
        $uploaddata['image_url'] = '/uploads/banner/' . $image_data['file_name'];
        //$uploaddata['full_path']    = $image_data['full_path'];
        $uploaddata['file_path'] = $image_data['file_path'];
        $uploaddata['image_type'] = $image_data['file_type'];
        $uploaddata['file_size'] = $image_data['file_size'];
        $uploaddata['status'] = 1;

        $CI->banner_model->save_product_image($uploaddata);
    }
}
function brand_single_image($brand_id,$file) {

    $CI = get_instance();
    $CI->load->model('brand_model');
    $CI->load->library('reload_mgt');

    $filename = md5(date('Y-m-d H:i:s:u') . rand());
    $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
    $filename_ext = $filename . '.' . $ext;

    $config['upload_path'] = './uploads/brand/';
    $config['allowed_types'] = 'gif|jpg|png|jpeg';
    //$config['maintain_ratio'] = true;
    //$config['width'] = 800;
    //$config['height'] = 800;
    $config['min_width'] = '800';
    $config['min_height'] = '600';
    $config['file_name'] = $filename_ext;

    $CI->load->library('upload', $config);
    $CI->upload->initialize($config);

    if ($CI->upload->do_upload('single_image_local')) {


        $image_data = $CI->upload->data(); //upload the image
        //echo "<pre>";print_r($file);
        //echo "<pre>";print_r($image_data);exit;
        /* image resize */
        $resize_img_values = $CI->reload_mgt->get_resize_img_values();
        $resizeconfig = array();
        foreach ($resize_img_values as $img_val) {

            $resizeconfig['source_image'] = $image_data['full_path'];
            $resizeconfig['new_image'] = $img_val['new_image'];
            $resizeconfig['maintain_ratio'] = $img_val['maintain_ratio'];
            $resizeconfig['width'] = $img_val['width'];
            $resizeconfig['height'] = $img_val['height'];

            $CI->image_lib->initialize($resizeconfig);
            $CI->image_lib->resize();
        }


        /* Insert Images */
        $uploaddata['referal_id'] = $brand_id;
        $uploaddata['referal_value'] = 'brand_image';
        $uploaddata['image_name'] = $image_data['file_name'];
        $uploaddata['original_name'] = $image_data['client_name'];
        $uploaddata['image_url'] = '/uploads/brand/' . $image_data['file_name'];
        //$uploaddata['full_path']    = $image_data['full_path'];
        $uploaddata['file_path'] = $image_data['file_path'];
        $uploaddata['image_type'] = $image_data['file_type'];
        $uploaddata['file_size'] = $image_data['file_size'];
        $uploaddata['status'] = 1;

        $CI->brand_model->save_brand_image($uploaddata);
    }
}
function load_multiple_images($product_id,$files) {
    $CI = get_instance();
    $CI->load->model('product_model');
    $CI->load->library('reload_mgt');
    $images = array();
    $i = 0;
    foreach ($files['name'] as $key => $image) {

        $_FILES['images[]']['name'] = $files['name'][$i];
        $_FILES['images[]']['type'] = $files['type'][$i];
        $_FILES['images[]']['tmp_name'] = $files['tmp_name'][$i];
        $_FILES['images[]']['error'] = $files['error'][$i];
        $_FILES['images[]']['size'] = $files['size'][$i];



        $filename = md5(date('Y-m-d H:i:s:u') . rand());
        $ext = pathinfo($files['name'][$i], PATHINFO_EXTENSION);
        $filename_ext = $filename . '.' . $ext;



        $images[] = $filename_ext;

        $config['upload_path'] = './uploads/product/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        //$config['maintain_ratio'] = true;
        //$config['width'] = 800;
        //$config['height'] = 800;
        $config['min_width'] = '800';
        $config['min_height'] = '600';
        $config['file_name'] = $filename_ext;

        $CI->load->library('upload', $config);
        $CI->upload->initialize($config);

        if ($CI->upload->do_upload('images[]')) {

            $image_data = $CI->upload->data();
            /* image resize */
            $resize_img_values = $CI->reload_mgt->get_resize_img_values();
            $resizeconfig = array();
            foreach ($resize_img_values as $img_val) {

                $resizeconfig['source_image'] = $image_data['full_path'];
                $resizeconfig['new_image'] = $img_val['new_image'];
                $resizeconfig['maintain_ratio'] = $img_val['maintain_ratio'];
                $resizeconfig['width'] = $img_val['width'];
                $resizeconfig['height'] = $img_val['height'];

                $CI->image_lib->initialize($resizeconfig);
                $CI->image_lib->resize();
            }

            $CI->load->library('upload', $config);
            $CI->image_lib->initialize($config);
            $CI->image_lib->resize();

            /* Insert Images */
            $uploaddata['referal_id'] = $product_id;
            $uploaddata['referal_value'] = 'product_image_multiple';
            $uploaddata['image_name'] = $image_data['file_name'];
            $uploaddata['original_name'] = $image_data['client_name'];
            $uploaddata['image_url'] = '/uploads/product/' . $image_data['file_name'];
            //$uploaddata['full_path']    = $image_data['full_path'];
            $uploaddata['file_path'] = $image_data['file_path'];
            $uploaddata['image_type'] = $image_data['file_type'];
            $uploaddata['file_size'] = $image_data['file_size'];
            $uploaddata['status'] = 1;
            $CI->product_model->save_product_image($uploaddata);
        }
        $i++;
    }
}

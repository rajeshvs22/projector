<?php
function ssl_support()
{
	$CI =& get_instance();
    return $CI->config->item('ssl_support');
}

if ( ! function_exists('force_ssl'))
{
	function force_ssl()
	{
		if (ssl_support() &&  (!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == 'off'))
		{
			$CI =& get_instance();
			$CI->config->config['base_url'] = str_replace('http://', 'https://', $CI->config->config['base_url']);
			redirect($CI->uri->uri_string());
		}
	}
}

//thanks C4iO [PyroDEV]
if ( ! function_exists('remove_ssl'))
{
	function remove_ssl()
	{	
		if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on')
		{
			$CI =& get_instance();
			$CI->config->config['base_url'] = str_replace('https://', 'http://', $CI->config->config['base_url']);
			
			redirect($CI->uri->uri_string());
		}
	}
}


function admin_js($uri, $tag=false)
{
	$CI =& get_instance();
	if($tag)
	{
		return '<script type="text/javascript" src="'.site_url('admin_assets/js/'.$uri).'"></script>';
	}
	else
	{
		return site_url('admin_assets/js/'.$uri);
	}
}

function admin_img($uri, $tag=false)
{
	$CI =& get_instance();
	if($tag)
	{
		return '<img src="'.site_url('admin_assets/images/'.$uri).'" alt="'.$tag.'">';
	}
	else
	{
		return site_url('admin_assets/images/'.$uri);
	}
	
}

function product_image($images = array() , $attr= array() ,$type = '')
{
    $CI =& get_instance();
    
    if(empty($images)){
        return '<img src="'.site_url('admin_assets/images/default-product-image.jpg').'" id="myimage" height="100" width="100">';
    }else{
        $url = '/uploads/product/'.$images['image_name'];
        if($type != ''){
            $url = '/uploads/product/'.$type.'/'.$images['image_name'];
        }
        $attribute = '';
        if(!empty($attr)){
            foreach($attr as $k => $v){
                $attribute .= $k .'="'.$v.'" ';
            }
            
        }
        return '<img src="'.site_url($url).'" '.$attribute.'>';
    }
}
function banner_image($images = array() , $attr= array() ,$type = '')
{
    $CI =& get_instance();

    if(empty($images)){
        return '<img src="'.site_url('admin_assets/images/default-product-image.jpg').'" id="myimage" height="100" width="100">';
    }else{
        $url = '/uploads/banner/'.$images['image_name'];
        if($type != ''){
            $url = '/uploads/banner/'.$type.'/'.$images['image_name'];
        }
        $attribute = '';
        if(!empty($attr)){
            foreach($attr as $k => $v){
                $attribute .= $k .'="'.$v.'" ';
            }
            
        }
        return '<img src="'.site_url($url).'" '.$attribute.'>';
    }
}
function brand_images($images = array() , $attr= array() ,$type = '')
{
    $CI =& get_instance();

    if(empty($images)){
        return '<img src="'.site_url('admin_assets/images/default-product-image.jpg').'" id="myimage" height="100" width="100">';
    }else{
        $url = '/uploads/brand/'.$images['image_name'];
        if($type != ''){
            $url = '/uploads/brand/'.$type.'/'.$images['image_name'];
        }
        $attribute = '';
        if(!empty($attr)){
            foreach($attr as $k => $v){
                $attribute .= $k .'="'.$v.'" ';
            }
            
        }
        return '<img src="'.site_url($url).'" '.$attribute.'>';
    }
}
function category_images($images = array() , $attr= array() ,$type = '')
{
    $CI =& get_instance();

    if(empty($images)){
        return '<img src="'.site_url('admin_assets/images/default-product-image.jpg').'" id="myimage" height="100" width="100">';
    }else{
        $url = '/uploads/category/'.$images['image_name'];
        if($type != ''){
            $url = '/uploads/category/'.$type.'/'.$images['image_name'];
        }
        $attribute = '';
        if(!empty($attr)){
            foreach($attr as $k => $v){
                $attribute .= $k .'="'.$v.'" ';
            }
            
        }
        return '<img src="'.site_url($url).'" '.$attribute.'>';
    }
}
function admin_css($uri, $tag=false)
{
	$CI =& get_instance();
	if($tag)
	{
		$media=false;
		if(is_string($tag))
		{
			$media = 'media="'.$tag.'"';
		}
		return '<link href="'.site_url('admin_assets/css/'.$uri).'" type="text/css" rel="stylesheet" '.$media.'/>';
	}
	
	return site_url('admin_assets/css/'.$uri);
}

/*********************** End Admin Part *********************************/
/*********************** Start Client Part ******************************/
function theme_url($uri)
{
    
	$CI =& get_instance();
	return $CI->config->base_url($uri);
}

//to generate an image tag, set tag to true. you can also put a string in tag to generate the alt tag
function theme_img($uri, $tag=false)
{
    
	if($tag)
	{
		return '<img src="'.theme_url('assets/images/'.$uri).'" alt="'.$tag.'">';
	}
	else
	{
		return theme_url('assets/images/'.$uri);
	}
	
}

function theme_js($uri, $tag=false)
{
    
	if($tag)
	{
		return '<script type="text/javascript" src="'.theme_url('assets/js/'.$uri).'"></script>';
	}
	else
	{
		return theme_url('assets/js/'.$uri);
	}
}
function theme_css($uri, $tag=false)
{
	if($tag)
	{
		$media=false;
		if(is_string($tag))
		{
			$media = 'media="'.$tag.'"';
		}
		return '<link href="'.theme_url('assets/css/'.$uri).'" type="text/css" rel="stylesheet" '.$media.'/>';
	}
	
	return theme_url('assets/css/'.$uri);
}


//profile image tag
function theme_profile_img($uri)
{
	
		$CI =& get_instance();
		return $CI->config->base_url('uploads/profile/source/'.$uri);
	
}
/*********************** End Client Part ********************************/


if ( ! function_exists('get_random_password'))
{
    /**
     * Generate a random password. 
     * 
     * get_random_password() will return a random password with length 6-8 of lowercase letters only.
     *
     * @access    public
     * @param    $chars_min the minimum length of password (optional, default 6)
     * @param    $chars_max the maximum length of password (optional, default 8)
     * @param    $use_upper_case boolean use upper case for letters, means stronger password (optional, default false)
     * @param    $include_numbers boolean include numbers, means stronger password (optional, default false)
     * @param    $include_special_chars include special characters, means stronger password (optional, default false)
     *
     * @return    string containing a random password 
     */    
    function get_random_password($chars_min=6, $chars_max=8, $use_upper_case=false, $include_numbers=false, $include_special_chars=false)
    {
        $length = rand($chars_min, $chars_max);
        $selection = 'aeuoyibcdfghjklmnpqrstvwxz';
        if($include_numbers) {
            $selection .= "1234567890";
        }
        if($include_special_chars) {
            $selection .= "!@04f7c318ad0360bd7b04c980f950833f11c0b1d1quot;#$%&[]{}?|";
        }
                                
        $password = "";
        for($i=0; $i<$length; $i++) {
            $current_letter = $use_upper_case ? (rand(0,1) ? strtoupper($selection[(rand() % strlen($selection))]) : $selection[(rand() % strlen($selection))]) : $selection[(rand() % strlen($selection))];            
            $password .=  $current_letter;
        }                
        
        return $password;
    }
}


//Blog image tag
function cat_img($uri)
{
    
    $CI =& get_instance();

    if(file_exists($CI->config->item('category_upload_dir').$uri)){
        $img_url = site_url($CI->config->item('category_upload_dir').$uri);
    }else{
        $img_url = admin_img('car/7.jpg');
    }
    
    if($uri == ''){
        $img_url = admin_img('car/7.jpg');
    }
    
    return $img_url ;
	
}
/**
 * Init admin footer/tails
 */
function init_tail()
{
    $CI =& get_instance();
    $CI->load->view('include/scripts');
}
/********************************************************************************************************/
/**
 * Is user logged in
 * @return boolean
 */
function is_logged_in()
{
    $CI =& get_instance();
   
    if (!$CI->session->has_userdata('member')) {
        return false;
    }
    return true;
}
/**
 * Is client logged in
 * @return boolean
 */
function is_client_logged_in()
{
    $CI =& get_instance();
    $member = $CI->session->userdata('member');
    if ($member['client_logged_in'] != false) {
        return true;
    }
    return false;
}

/**
 * Return logged client User ID from session
 * @return mixed
 */
function get_client_user_id()
{
    $CI =& get_instance();
    $admin = $CI->session->userdata('admin');
    if ($admin['client_logged_in'] == false) {
        return false;
    }
    return $admin['id'];
}
/**
 * Is client logged in
 * @return boolean
 */
function is_admin_logged_in()
{
    $CI =& get_instance();
    $admin = $CI->session->userdata('admin');
    if ($admin['admin_logged_in'] != false) {
        return true;
    }
    return false;
}

/**
 * Return logged client User ID from session
 * @return mixed
 */
function get_admin_user_id()
{
    $CI =& get_instance();
    $admin = $CI->session->userdata('admin');
    if ($admin['admin_logged_in'] == false) {
        return false;
    }
    return $admin['id'];
}

/*
 * Site Language
 */
function get_site_language($lang = ''){
    
    $arr = array('english' => 'en','french' => 'fr','german' => 'gr','dutsch'=>'de');
    
    if($lang ==''){
        return $arr;
    }
    return $arr[$lang];
}


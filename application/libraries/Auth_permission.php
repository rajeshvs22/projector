<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Auth_permission
{
	var $CI;
	
	//this is the expiration for a non-remember session
	var $session_expire	= 600;

	function __construct()
	{
		$this->CI =& get_instance();
		$this->CI->load->database();
		$this->CI->load->library('encrypt');
		
		
		$this->CI->load->helper('url');
	}
	
	function is_check_permission($roleId)
        {
            
//            echo'<pre>';print_r($this->CI->uri->segments);echo'</pre>';
//            die;
            if($roleId == 1)
            {
                return true;
            }
            
            $segments = $this->CI->uri->segments;
            
            
            // now try the specific routing
            $segments = array_splice($segments, -2, 2);

            // Turn the segment array into a URI string
            $uri = implode('/', $segments);
            
            
            
//             echo'<pre>';print_r($uri);echo'</pre>';
//            die;

//            $lastKey = count($segments);
//            $lastSlug = $segments['$lastKey'];
            
            if(count($segments) == 1)
            {
                    $row	= $this->_get_db_route($segments[0]);

                    if(!empty($row))
                    {
                            $this->_check_permission(explode('/', $row['route']),$roleId);
                    }
            }
            else
            {	
                    $segments	= array_reverse($segments);
                    //start with the end just to make sure we're not a multi-tiered category or category/product combo before moving to the second segment
                    //we could stop people from naming products or categories after numbers, but that would be limiting their use.
                    $row	= $this->_get_db_route($segments[0]);
                    //set a pagination flag. If this is set true in the next if statement we'll know that the first row is segment is possibly a page number
                    $page_flag	= false;
                    if($row)
                    {
                            $this->_check_permission(explode('/', $row['route']),$roleId);
                    }
                    else
                    {
                            //this is the second go
                            $row	= $this->_get_db_route($segments[1]);
                            $page_flag	= true;
                    }

                    //we have a hit, continue down the path!
                    if($row)
                    {
                            if(!$page_flag)
                            {
                                    $this->_check_permission(explode('/', $row['route']),$roleId);
                            }
                            else
                            {
                            $key = $row['slug'].'/([0-9]+)';

                                    //pages can only be numerical. This could end in a mighty big error!!!!
                                    if (preg_match('#^'.$key.'$#', $uri))
                                    {
                                            $row['route'] = preg_replace('#^'.$key.'$#', $row['route'],$uri);
                                            $this->_check_permission(explode('/', $row['route']),$roleId);
                                    }
                            }
                    }
            }
            
           
            $segments = $this->CI->uri->segments;
            $temp =array();
            foreach($segments as $key => $row){
                $temp[] = $row;
                
            }
//              echo'<pre>';print_r($temp);echo'</pre>';
//            die;
            // now try the specific routing
            $segments = $temp;
            
            $this->_check_permission($segments,$roleId);
            
            
        }
        
        function _check_permission($url,$roleId)
        {
            
            // Load the routes.php file.
            if (defined('ENVIRONMENT') AND is_file(APPPATH.'config/'.ENVIRONMENT.'/routes.php'))
            {
                    include(APPPATH.'config/'.ENVIRONMENT.'/routes.php');
            }
            elseif (is_file(APPPATH.'config/routes.php'))
            {
                    include(APPPATH.'config/routes.php');
            }

            $this->routes = ( ! isset($route) OR ! is_array($route)) ? array() : $route;
            unset($route);
            
            
            $segments = $url;
            
            
            
            //$segments	= array_reverse($url);
            
            if(count($segments) == 0){
                
                $routeSegment = (!empty($this->routes['default_controller']))?$this->routes['default_controller']:'';
                if($routeSegment !='')
                {
                    $innerSegment = explode('/', $routeSegment);
                    $this->_check_permission_rules($innerSegment,$roleId);
                    
                } 
                
            }            
            else if(count($segments) == 1){
                
                $routeSegment = (!empty($this->routes[$segments[0]]))?$this->routes[$segments[0]]:'';
               
                if($routeSegment !='')
                {
                    $innerSegment = explode('/', $routeSegment);
                    if (($key = array_search($segments[0], $innerSegment)) !== false) {
                        unset($innerSegment[$key]);
                    }
                    
                    $this->_check_permission_rules($innerSegment,$roleId);
                    
                }
                
                else{
                    $this->_check_permission_rules($segments,$roleId);
                }
                
                
            }
            else if(count($segments) > 1){
                
                $configFileName = str_replace('/', '', APPPATH);
                
                // Load the routes.php file.
                if (defined('ENVIRONMENT') AND is_file(APPPATH.'config/'.ENVIRONMENT.'/'.$configFileName.'.php'))
                {
                        include(APPPATH.'config/'.ENVIRONMENT.'/'.$configFileName.'.php');
                }
                elseif (is_file(APPPATH.'config/'.$configFileName.'.php'))
                {
                        include(APPPATH.'config/'.$configFileName.'.php');
                }
                
                $this->config = ( ! isset($config) OR ! is_array($config)) ? array() : $config;
                unset($config);
                
                //echo'<pre>';print_r($segments[0]);echo'</pre>';
                if (($key = array_search($segments[0], $this->config)) !== false) {
//                     echo'<pre>';print_r($key);echo'</pre>';
//                     die;
                       unset($segments[0]);
                }

//                echo'<pre>';print_r($segments);echo'</pre>';
//                die;
//              
                 
                 $this->_check_permission_rules($segments,$roleId);
                
                
            }
            

            
        }
        
        function _check_permission_rules($segments,$roleId){
            
            $temp =array();
            foreach($segments as $key => $row){
                $temp[] = $row;
                
            }  
            $segments = $temp;
            
            
            if(count($segments) == 1)
            {
                if($this->CI->permission->check_has($segments[0])){
                    
                    
                    if(!$this->CI->permission->check_isAllowed($roleId, $segments[0]))
                    {
                         $this->show_error();
                    }
                    
                }
                
            }else if((count($segments) > 1) && (count($segments) <= 2) ){
                                           
                
                if($this->CI->permission->check_has($segments[0].'/'.$segments[1])){
                    
                    if(!$this->CI->permission->check_isAllowed($roleId, $segments[0],$segments[1]))
                    {
                        $this->show_error();
                    }
                }
              
            }
            
            
                
//            }else if((count($segments) > 2) && (count($segments) <= 3)){
////                            echo'<pre>';print_r($segments);echo'</pre>';
////            die;
//                
//                if($this->CI->permission->check_has($segments[0])){
//                    if(!$this->CI->permission->check_isAllowed($roleId, $segments[0],$segments[1].'/edit'))
//                    {
//                         $this->show_error();
//                    }
//                }
//                
//            }else if(count($segments) > 3){
//                
//                if($this->CI->permission->check_has($segments[0])){
//                    if(!$this->CI->permission->check_isAllowed($roleId, $segments[0],$segments[1].'/edit'))
//                    {
//                         $this->show_error();
//                    }
//                }
//                
//            }
        }
        
        
        
        function _get_db_route($slug)
	{
		return $this->CI->db->where('slug',$slug)->get('routes')->row_array();
	}
        
        function show_error()
        {
            redirect('error');
        }
}
?>
<?php
$status = $this->uri->segment(2);
$masteractive = "";

if ($this->uri->segment(2) == "users") {
    $useractive = "active";
} else {
    $masteractive = "active";
}
?>
<?php //echo theme_js('jquery.wallform.js', true) ?>
<?php echo admin_js('admin.js', true); ?>
<div id="nav-col">
    <section id="col-left" class="col-left-nano">
        <div id="col-left-inner" class="col-left-nano-content">
            <div class="clearfix hidden-sm hidden-xs dropdown profile2-dropdown" id="user-left-box">
                <?php
                $img_url = base_url().$this->config->item('admin_profile_dir').$admin_session['id'].'.png';
                
                if (file_exists('http://localhost/tuition/uploads/admin_profile/1.png')) {
                    $img_url = $img_url.'?'.rand(8,10);
                    
                }else{
                    $img_url = admin_img('samples/scarlet-159-e.png');
                    
                }
                   
                ?>
                <img src="<?php echo $img_url; ?>" alt="">
                <div class="user-box">
                    <span class="name">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="<?php echo $admin_url; ?>">
                           <?php echo $name; ?>
                            <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo base_url('admin/profile/edit_profile'); ?>"><i class="fa fa-user"></i>Edit Profile</a></li>
                            <li><a href="<?php echo base_url('admin/login/logout'); ?>"><i class="fa fa-power-off"></i>Logout</a></li>
                        </ul>
                    </span>
                    <span class="status">
                        <i class="fa fa-circle"></i> Online
                    </span>
                </div>
            </div>
            <div class="collapse navbar-collapse navbar-ex1-collapse" id="sidebar-nav">	
                
                    <ul class="nav nav-pills nav-stacked" >                
                    <li class="dashboard">
                        <a href="<?php echo $admin_url; ?>dashboard/">
                            <i class="fa fa-dashboard"></i>
                            <span>Dashboard</span>
                            <span class="label label-primary label-circle pull-right"></span>
                        </a>
                    </li>
                    
                    <li class="tutor">
                        <a href="<?php echo $admin_url; ?>user" class="dropdown-toggle">
                            <i class="fa fa-child"></i>
                            <span>User</span>
                            <i class="fa fa-angle-right drop-icon"></i>
                        </a>
                        <ul class="submenu">                          
                            <li class="all">
                                <a href="<?php echo $admin_url; ?>user">User List</a>
                            </li>
                        </ul>
                    </li> 
                    <!--class="tutor">
                        <a href="<?php echo $admin_url; ?>user" class="dropdown-toggle">
                            <i class="fa fa-child"></i>
                            <span>Review Details</span>
                            <i class="fa fa-angle-right drop-icon"></i>
                        </a>
                        <ul class="submenu">                          
                            <li class="all">
                                <a href="<?php echo $admin_url; ?>rating_reviews">Review List</a>
                            </li>
                        </ul>
                    </li>  					
                    <li class="tutor">
                        <a href="<?php echo $admin_url; ?>" class="dropdown-toggle">
                            <i class="fa fa-child"></i>
                            <span>Order</span>
                            <i class="fa fa-angle-right drop-icon"></i>
                        </a>
                        <ul class="submenu">                          
                            <li class="all">
                                <a href="<?php echo $admin_url; ?>order_details">Order List</a>
                            </li>
                        </ul>
                    </li>-->
                    
                    
                    

                </ul>
                            
            </div>
        </div>
    </section>
    <div id="nav-col-submenu"></div>
</div>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

        <title> <?php echo $this->config->item('company_name'); ?> </title>

        <script type="text/javascript">
            var baseurl = "<?php print base_url(); ?>";
        </script>
        <!-- bootstrap -->

        <script src="<?php echo admin_js('jquery.js'); ?>"></script><!-- VER 1.7 -->
        <?php echo admin_css('bootstrap/bootstrap.min.css', true); ?>
        <?php echo admin_css('font-awesome.min.css', true); ?>
        <?php echo admin_css('datepicker.css', true); ?>
        <?php echo admin_css('daterangepicker.css', true); ?>

        <?php echo admin_css('bootstrap-timepicker.css', true); ?>
        <?php echo admin_js('jquery.confirm.js', true); ?>

        <!-- 
        If you need RTL support just include here RTL CSS file <link rel="stylesheet" type="text/css" href="css/libs/bootstrap-rtl.min.css" />
        And add "rtl" class to <body> element - e.g. <body class="rtl"> 
        -->

        <!-- libraries -->
        <?php echo admin_css('libs/font-awesome.css', true); ?>

        <?php echo admin_css('libs/nanoscroller.css', true); ?>

        <!-- global styles -->

        <?php echo admin_css('compiled/theme_styles.css', true); ?>
        <?php echo admin_css('compiled/wizard.css', true); ?>

        <!-- this page specific styles -->

        <?php echo admin_css('style.css', true); ?>

        <!-- Favicon -->
        <link type="image/x-icon" href="<?php echo theme_img('favicon.ico'); ?>" rel="shortcut icon"/>

        <!-- google font libraries -->
        <link href='//fonts.googleapis.com/css?family=Open+Sans:400,600,700,300|Titillium+Web:200,300,400' rel='stylesheet' type='text/css'>

        <!--[if lt IE 9]>
                <script src="js/html5shiv.js"></script>
                <script src="js/respond.min.js"></script>
        <![endif]-->
        <style>

        </style>
    </head>

    <body class="pace-done fixed-header theme-turquoise ">

        <?php
        $CI = & get_instance();
        $admin_session = get_session_data();

        $name = $admin_session['name'];
        ?>
        <?php $admin_url = site_url($this->config->item('admin_folder')) . '/'; ?>



        <div id="theme-wrapper">
            <header class="navbar" id="header-navbar">
                <div class="container">
                    <a href="<?php echo base_url(); ?>" id="logo" style="  font-size: 36px;  position: relative;" class="navbar-brand" target="blank">
                        <img src="<?php echo admin_img('logo.png'); ?>" alt="" class="normal-logo logo-white" style="" />
                    </a>

                    <div class="clearfix">
                        <button class="navbar-toggle" data-target=".navbar-ex1-collapse" data-toggle="collapse" type="button">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="fa fa-bars"></span>
                        </button>

                        <div class="nav-no-collapse navbar-left pull-left hidden-sm hidden-xs mmapp_header_menu">


<?php
include('menu_admin.php');
?><!-- END ADMINISTRATOR -->



                        </div>



                        <div class="nav-no-collapse pull-right" id="header-nav">
                            <ul class="nav navbar-nav pull-right">
<!--                                <li class="dropdown profile-dropdown">
                                    <select onchange="javascript:window.location.href = '<?php echo base_url(); ?>LanguageSwitcher/switchLang/' + this.value;">
                                       <option value="english" <?php if ($this->session->userdata('site_lang') == 'english') echo 'selected="selected"'; ?>>English</option>
                                       <option value="french" <?php if ($this->session->userdata('site_lang') == 'french') echo 'selected="selected"'; ?>>French</option>
                                       <option value="german" <?php if ($this->session->userdata('site_lang') == 'german') echo 'selected="selected"'; ?>>German</option>   
                                   </select>
                                </li>-->
                                <li class="dropdown profile-dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">

                                        <span class="hidden-xs"> <?php echo $name; ?> </span> <b class="caret"></b>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li><a href="<?php echo base_url('admin/profile/edit_profile'); ?>"><i class="fa fa-user"></i>Edit Profile</a></li>	
                                        <li><a href="<?php echo base_url('admin/change_password'); ?>"><i class="fa fa-cog"></i>Change Password</a></li>								
                                        <li><a href="<?php echo base_url('admin/login/logout'); ?>"><i class="fa fa-power-off"></i>Logout</a></li>
                                    </ul>
                                </li>
                                <li class="hidden-xxs">
                                    <a class="btn" href='<?php echo base_url('admin/login/logout'); ?>'>
                                        <i class="fa fa-power-off"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </header>

            <div id="page-wrapper" class="container">
                <div class="row">
                   
<?php

//lets have the flashdata overright "$message" if it exists
if ($this->session->flashdata('message')) {
    $message = $this->session->flashdata('message');
}

if ($this->session->flashdata('error')) {
    $error = $this->session->flashdata('error');
}

if (function_exists('validation_errors') && validation_errors() != '') {
    $error = validation_errors();
}
?>

                    <div class="main-box-body clearfix">
                    <?php if (!empty($message)): ?>
                            <div class="alert alert-success fade in">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <i class="fa fa-check-circle fa-fw fa-lg"></i>
                                <strong></strong> <?php echo $message; ?>
                            </div>
<?php endif; ?>

                        <?php if (!empty($error)): ?>
                            <div class="alert alert-danger fade in">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <i class="fa fa-times-circle fa-fw fa-lg"></i>
                                <strong></strong><?php echo $error; ?>
                            </div>              
<?php endif; ?>
                    </div>

                        <?php
                        include('left_admin.php');
                        ?>                   


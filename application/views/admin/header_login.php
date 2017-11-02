<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

        <title><?php echo $this->config->item('company_name'); ?></title>

        <script type="text/javascript">
            var baseurl = "<?php print base_url(); ?>";
        </script>
        <!-- bootstrap -->
        <script src="<?php echo base_url('admin_assets/js/jquery.js'); ?>"></script>
        <link type="text/css" href="<?php echo base_url('admin_assets/css/bootstrap/bootstrap.min.css'); ?>" rel="stylesheet" />
       
        <!-- 
        If you need RTL support just include here RTL CSS file <link rel="stylesheet" type="text/css" href="<?php echo base_url('admin_assets/css/libs/bootstrap-rtl.min.css'); ?>" />
        And add "rtl" class to <body> element - e.g. <body class="rtl"> 
        -->
        <!-- libraries -->
        <link type="text/css" href="<?php echo base_url('admin_assets/css/libs/font-awesome.css'); ?>" rel="stylesheet" />
        <link type="text/css" href="<?php echo base_url('admin_assets/css/libs/nanoscroller.css'); ?>" rel="stylesheet" />

        <!-- global styles -->
        <link type="text/css" href="<?php echo base_url('admin_assets/css/compiled/theme_styles.css'); ?>" rel="stylesheet" />
        <!-- this page specific styles -->
        <!-- Favicon -->
        <link type="image/x-icon" href="<?php echo theme_img('favicon.ico');?>" rel="shortcut icon"/>

        <!-- google font libraries -->
        <link href='//fonts.googleapis.com/css?family=Open+Sans:400,600,700,300|Titillium+Web:200,300,400' rel='stylesheet' type='text/css'>

        <!--[if lt IE 9]>
                <script src="<?php echo base_url('admin_assets/js/html5shiv.js'); ?>"></script>
                <script src="<?php echo base_url('admin_assets/js/respond.min.js'); ?>"></script>
        <![endif]-->
    </head>
    <body id="login-page">
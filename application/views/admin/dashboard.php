<?php include('header.php'); ?>
<div id="content-wrapper">
    <div class="row">
        <div class="col-lg-12">

            <div class="row">
                <div class="col-lg-12">
                    <ol class="breadcrumb">
                        <li><a href="#">Home</a></li>
                        <li class="active"><span>Dashboard</span></li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <?php if($label['label1'] != '') { ?>
                <div class="col-lg-3 col-sm-6 col-xs-12">
                    <div class="main-box infographic-box colored emerald-bg">
                        <i class="fa fa-globe"></i>
                        <span class="headline"><?php echo $label['label1']; ?></span>
                        <span class="value"><?= $orders['category']; ?></span>
                    </div>
                </div>
                <?php } ?>
                <?php if($label['label2'] != '') { ?>
                <div class="col-lg-3 col-sm-6 col-xs-12">
                    <div class="main-box infographic-box colored green-bg">
                        <i class="fa fa-users"></i>
                        <span class="headline"><?php echo $label['label2']; ?></span>
                        <span class="value"><?= $orders['product'] ?></span>
                    </div>
                </div>
                <?php } ?>
                <?php if($label['label3'] != '') { ?>
                <div class="col-lg-3 col-sm-6 col-xs-12">
                    <div class="main-box infographic-box colored purple-bg">
                        <i class="fa fa-user"></i>
                        <span class="headline"><?php echo $label['label3']; ?></span>
                        <span class="value"><?php echo $user_count; ?></span>
                    </div>
                </div>
                <?php } ?>
                <?php if($label['label4'] != '') { ?>
                <div class="col-lg-3 col-sm-6 col-xs-12">
                    <div class="main-box infographic-box colored red-bg">
                        <i class="fa fa-institution"></i>
                        <span class="headline"><?php echo $label['label4']; ?></span>
                        <span class="value"><?= $orders['Oder_detail']; ?></span>
                    </div>
                </div>
                <?php } ?>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="main-box">
                        <header class="main-box-header clearfix">
                            <!--<h2 class="pull-left">Daily Logged Users</h2>-->
                        </header>

                        <div class="main-box-body clearfix">
                            <div class="row">
                                <div class="col-md-12">
                                    <div id="graph-bar" style="height: 240px; padding: 0px; position: relative;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
               <!-- <div class="row">
                    <div class="col-lg-4 col-sm-6 col-xs-12">
                        <div class="main-box infographic-box">
                            <i class="fa fa-shopping-cart emerald-bg"></i>
                            <span class="headline">Approval for pending</span>
                            <span class="value">
                                <span class="timer" data-from="30" data-to="658" data-speed="800" data-refresh-interval="30">
                                    <?= '0' ?>
                                </span>
                            </span>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-xs-12">
                        <div class="main-box infographic-box">
                            <i class="fa fa-users red-bg"></i>
                            <span class="headline">Subscription</span>
                            <span class="value">
                                <span class="timer" data-from="120" data-to="2562" data-speed="1000" data-refresh-interval="50">
                                    <?= $total_subscriber; ?>
                                </span>
                            </span>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="main-box clearfix project-box green-box">
                            <div class="main-box-body clearfix">
                                <div class="project-box-header green-bg">
                                    <div class="name">
                                        <a href="#">
                                            Enquiry
                                        </a>
                                    </div>
                                </div>



                                <div class="project-box-footer clearfix">
                                    <a href="#">
                                        <span class="value"><?= $orders['total'] ?></span>
                                        <span class="label">Total</span>
                                    </a>
                                    <a href="#">
                                        <span class="value"><?= $orders['pending'] ?></span>
                                        <span class="label">Pending</span>
                                    </a>
                                    <a href="#">
                                        <span class="value"><?= $orders['complete'] ?></span>
                                        <span class="label">Completed</span>
                                    </a>
                                </div>


                            </div>
                        </div>
                    </div>

                </div>-->
            


        </div>
    </div>

    <?php echo admin_js('flot/jquery.flot.min.js', true); ?>
    <?php echo admin_js('flot/jquery.flot.resize.min.js', true); ?>
    <?php echo admin_js('flot/jquery.flot.time.min.js', true); ?>
    <?php echo admin_js('flot/jquery.flot.threshold.js', true); ?>
    <?php echo admin_js('flot/jquery.flot.axislabels.js', true); ?>  
    <!-- this page specific inline scripts -->
    
<?php include('footer.php');
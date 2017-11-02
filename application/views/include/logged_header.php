<html>
<head>
    <title>::.My Projector.::</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="<?php echo theme_img('fav-icon.png') ?>img/fav-icon.png">
    <?php echo theme_css('font-awesome.css', true) ?>
    <?php echo theme_css('bootstrap.css', true) ?>
    <?php echo theme_css('style.css', true) ?>
    <?php echo theme_css('responsive.css', true) ?>
</head>
<!--header-info-->
<section class="header-info">
	<div class="container-fluid">
		<div class="col-md-7">
			<div class="menu">
				<nav class="navbar navbar-inverse">
                        <div class="">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                                <a class="navbar-brand visible-xs hidden-sm" href="#">Menu</a> </div>
                            <!-- <div class="collapse navbar-collapse" id="myNavbar">-->
                            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                                <ul class="nav navbar-nav">
                                    <li class="active"><a href="home">Home</a></li>
                                    <li><a href="#">About Buy Projector Lamps </a></li>
									<li><div class="dropdown">
										  <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">All Categories
										  <span><i class="fa fa-angle-down" aria-hidden="true"></i></span></button>
										  <ul class="dropdown-menu">
											<li><a href="#">3D perception</a></li>
											<li><a href="#">3M</a></li>
											<li><a href="#">Acer</a></li>
										  </ul>
									</div> </li>
                                    <li><a href="#">FAQ</a></li>
                                    <li><a href="#">Contact </a></li>
                                </ul>
                                
                               
                            </div>
                        </div>
                    </nav>
			</div>
		</div>
		<div class="col-md-5">
			<ul class="list-inline">
				<li><span class="phone"><i class="fa fa-phone" aria-hidden="true"></i>
				</span>+91 1234567891</li>
				<li><span class="mail"><i class="fa fa-envelope-o" aria-hidden="true"></i>
				</span><a href="#">contact@projector.com</a></li>
				<li><a href="#"><i class="fa fa-2x fa-shopping-cart"></i></a><lavel id="cart-badge" class="badge badge-warning">3</lavel></li>
                                <?php if(count($user_data)>0){ ?>
                                <li class="drop"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
                                  <img src="<?php echo theme_img('user.png'); ?>" class="img-responsive" alt="user"/></a>
                                        <ul class="dropdown-menu">
                                                <li><a href="#">Profile</a></li>
                                                <li><a href="#">Saved Product</a></li>
                                                <li><a href="#">Shopping Cart</a></li>
                                                <li><a href="#">Order History</a></li>
                                                <li><a href="signup/logout">Logout</a></li>
                                        </ul>
                                </li><?php } ?>
								 <li class="dropdown profile-dropdown">
                                    <select onchange="javascript:window.location.href = '<?php echo base_url(); ?>LanguageSwitcher/switchLang/' + this.value;">
                                       <option value="english" <?php if ($this->session->userdata('site_lang') == 'english') echo 'selected="selected"'; ?>>English</option>
                                       <option value="french" <?php if ($this->session->userdata('site_lang') == 'french') echo 'selected="selected"'; ?>>French</option>
                                       <option value="german" <?php if ($this->session->userdata('site_lang') == 'german') echo 'selected="selected"'; ?>>German</option>   
                                   </select>
                                </li>
			</ul>
			
		</div>
	</div>
</section><div class="clearfix"></div><!--end header-info-->
<!--header-->
<section class="header">
	<div class="container">
		<div class="header-menu clearfix">
		<div class="col-md-2">
			<div class="logo">
				<a href="index.html"><img src="<?php echo theme_img('logo.png'); ?>" class="img-responsive" alt="logo"/></a>
			</div>
		</div>	
		<div class="col-md-2"></div>
		<div class="col-md-4">
			<div id="custom-search-input">
				<div class="input-group">
					<input type="text" class="  search-query form-control" placeholder="SEARCH FOR ITEM" />
					<span class="input-group-btn">
						<button class="btn btn-danger" type="button">
							<span class=" glyphicon glyphicon-search"></span>
						</button>
					</span>
				</div>
			</div>
		</div>
		<div class="col-md-2">
			 <div class="form-group">			  
			  <select class="form-control" id="sel1">
				<option>Select Brand</option>
				<option>3D Perception</option>
				<option>3M</option>
				<option>Acer</option>
				<option>Advent</option>
			  </select>
			</div> 
		</div>
		<div class="col-md-2">
			 <div class="form-group">			  
			  <select class="form-control" id="sel2">
				<option>Select Model</option>
				<option>X15e</option>
				<option>X15i</option>
				<option>X30e</option>
				<option>X30i</option>
			  </select>
			</div> 
		</div>
	</div>
	</div>
</section><div class="clearfix"></div><!--end header-->
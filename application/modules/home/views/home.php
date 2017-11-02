<!--banner-->
<section class="banner"> 
<div id="first-slider">
    <div id="carousel-example-generic" class="carousel slide carousel-fade">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
            <li data-target="#carousel-example-generic" data-slide-to="2"></li>
        
        </ol>
        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            <!-- Item 1 -->
            <div class="item active slide1">
				<img src="<?php echo theme_img('banner-1.jpg'); ?>" class="img-responsive" alt="home-banner"/>                
             </div> 
            <!-- Item 2 -->
            <div class="item slide2">
				<img src="<?php echo theme_img('banner-2.jpg'); ?>" class="img-responsive" alt="home-banner"/>                  
            </div> 
			<!-- Item 3 -->
            <div class="item slide2">
				<img src="<?php echo theme_img('banner-1.jpg'); ?>" class="img-responsive" alt="home-banner"/>                  
            </div>
        </div>      
      </div>		 	
</div>
 <?php if(count($user_data) == 0){ ?>
<section class="log-sign">
    <div class="socialmediaerror" style="padding-top:20px;color:red;font-size:20px;">
        <?php echo $this->session->flashdata('socialloginerror'); ?>
    </div> 	<div class="container">
		<div class="row">
		<div class="col-md-4 col-sm-4 btf clearfix">
		<a class="login" href="signin">
		<div class="col-md-4"><i class="fa fa-angle-right" aria-hidden="true"></i></div>
		<div class="col-md-8">
			<span>Login</span>
		</div></a>
		</div>
		</div>
		<div class="row">
		<div class="col-md-4 col-sm-4 btf clearfix">
		<a class="sign" href="signup">
		<div class="col-md-4"><i class="fa fa-angle-right" aria-hidden="true"></i></div>
		<div class="col-md-8">
			<span>Register</span>
		</div></a>
		</div>
		</div>
	</div>
</section>
<?php } ?>
</section><div class="clearfix"></div><!--end banner-->
<!--best-products-->
<section class="best">	
	<div class="container">
		<h2>The Best <span>Products</span></h2>
		<div class="b-border"></div>
	<div class="row">
		<div class="col-md-6">
			<div class="best-product">
				<img src="<?php echo theme_img('benq.png'); ?>" class="img-responsive" alt="benq"/>
			</div>
			<div class="dd">
				<div class="row">
					<div class="col-md-8"><p>For light</p></div>
					<div class="col-md-4"><button class="btn btn-default">More</button></div>
				</div>
			</div>
		</div>
		<div class="col-md-6">
    	    <div class=""> 
                <div id="myCarousel" class="carousel slide">                 
                <!-- <ol class="carousel-indicators">
                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#myCarousel" data-slide-to="1"></li>
                    <li data-target="#myCarousel" data-slide-to="2"></li>
                </ol> -->                 
                <!-- Carousel items -->
                <div class="carousel-inner">
                    
                <div class="item active">
                	<div class="row-fluid">
                	  <div class="col-md-6">
					  <a href="#x" class="thumbnail"><img src="<?php echo theme_img('image-1.png'); ?>" class="img-responsive" alt="Image" style="max-width:100%;" /></a>
					 <div class="t-h4"><h4>sale!</h4></div>
					  <div class="desc clearfix">
						<h1>Lorem ipsum dolor sit</h1>
						<div class="price-desc clearfix">
						<div class="col-md-6 col-sm-6">
						<h3><i class="fa fa-inr" aria-hidden="true"></i>&nbsp;6001.19</h3>
						<ul class="list-inline">
							<li><i class="fa fa-star" aria-hidden="true"></i></li>
							<li><i class="fa fa-star" aria-hidden="true"></i></li>
							<li><i class="fa fa-star" aria-hidden="true"></i></li>
							<li><i class="fa fa-star" aria-hidden="true"></i></li>
							<li><i class="fa fa-star-o" aria-hidden="true"></i></li>
						</ul>
					    </div>
					    <div class="col-md-6 col-sm-6">
						 <button class="btn btn-default">Add to Cart</button>
					    </div>
						</div>
					  </div>					  
					  </div>
                	  <div class="col-md-6">
					  <a href="#x" class="thumbnail"><img src="<?php echo theme_img('image-2.png'); ?>" class="img-responsive" alt="Image" style="max-width:100%;" /></a> 
					  <div class="t-h5"><h5>New!</h5></div>
					  <div class="desc clearfix">
						<h1>Lorem ipsum dolor sit</h1>
						<div class="price-desc clearfix">
						<div class="col-md-6 col-sm-6">
						<h3><i class="fa fa-inr" aria-hidden="true"></i>&nbsp;6001.19</h3>
						<ul class="list-inline">
							<li><i class="fa fa-star" aria-hidden="true"></i></li>
							<li><i class="fa fa-star" aria-hidden="true"></i></li>
							<li><i class="fa fa-star" aria-hidden="true"></i></li>
							<li><i class="fa fa-star" aria-hidden="true"></i></li>
							<li><i class="fa fa-star-o" aria-hidden="true"></i></li>
						</ul>
					    </div>
					    <div class="col-md-6 col-sm-6">
						 <button class="btn btn-default">Add to Cart</button>
					    </div>
						</div>
					  </div>  
					</div>
                	</div><!--/row-fluid-->
                </div><!--/item-->
                 
                <div class="item">
                	<div class="row-fluid">
                		<div class="col-md-6"><a href="#x" class="thumbnail"><img src="<?php echo theme_img('image-2.png'); ?>" class="img-responsive" alt="Image" style="max-width:100%;" /></a>
						<div class="t-h4"><h4>sale!</h4></div>
					  <div class="desc clearfix">
						<h1>Lorem ipsum dolor sit</h1>
						<div class="price-desc clearfix">
						<div class="col-md-6 col-sm-6">
						<h3><i class="fa fa-inr" aria-hidden="true"></i>&nbsp;6001.19</h3>
						<ul class="list-inline">
							<li><i class="fa fa-star" aria-hidden="true"></i></li>
							<li><i class="fa fa-star" aria-hidden="true"></i></li>
							<li><i class="fa fa-star" aria-hidden="true"></i></li>
							<li><i class="fa fa-star" aria-hidden="true"></i></li>
							<li><i class="fa fa-star-o" aria-hidden="true"></i></li>
						</ul>
					    </div>
					    <div class="col-md-6 col-sm-6">
						 <button class="btn btn-default">Add to Cart</button>
					    </div>
						</div>
					  </div>
						</div>
                		<div class="col-md-6"><a href="#x" class="thumbnail"><img src="<?php echo theme_img('image-2.png'); ?>" class="img-responsive" alt="Image" style="max-width:100%;" /></a>
						<div class="t-h5"><h5>New!</h5></div>
					  <div class="desc clearfix">
						<h1>Lorem ipsum dolor sit</h1>
						<div class="price-desc clearfix">
						<div class="col-md-6 col-sm-6">
						<h3><i class="fa fa-inr" aria-hidden="true"></i>&nbsp;6001.19</h3>
						<ul class="list-inline">
							<li><i class="fa fa-star" aria-hidden="true"></i></li>
							<li><i class="fa fa-star" aria-hidden="true"></i></li>
							<li><i class="fa fa-star" aria-hidden="true"></i></li>
							<li><i class="fa fa-star" aria-hidden="true"></i></li>
							<li><i class="fa fa-star-o" aria-hidden="true"></i></li>
						</ul>
					    </div>
					    <div class="col-md-6 col-sm-6">
						 <button class="btn btn-default">Add to Cart</button>
					    </div>
						</div>
					  </div>
						</div>                		
                	</div><!--/row-fluid-->
                </div><!--/item-->
                 
                <div class="item">
                	<div class="row-fluid">
                		<div class="col-md-6"><a href="#x" class="thumbnail"><img src="<?php echo theme_img('image-2.png'); ?>" class="img-responsive" alt="Image" style="max-width:100%;" /></a>
						<div class="t-h4"><h4>sale!</h4></div>
					  <div class="desc clearfix">
						<h1>Lorem ipsum dolor sit</h1>
						<div class="price-desc clearfix">
						<div class="col-md-6 col-sm-6">
						<h3><i class="fa fa-inr" aria-hidden="true"></i>&nbsp;6001.19</h3>
						<ul class="list-inline">
							<li><i class="fa fa-star" aria-hidden="true"></i></li>
							<li><i class="fa fa-star" aria-hidden="true"></i></li>
							<li><i class="fa fa-star" aria-hidden="true"></i></li>
							<li><i class="fa fa-star" aria-hidden="true"></i></li>
							<li><i class="fa fa-star-o" aria-hidden="true"></i></li>
						</ul>
					    </div>
					    <div class="col-md-6 col-sm-6">
						 <button class="btn btn-default">Add to Cart</button>
					    </div>
						</div>
					  </div>
						</div>
                		<div class="col-md-6"><a href="#x" class="thumbnail"><img src="<?php echo theme_img('image-2.png'); ?>" class="img-responsive" alt="Image" style="max-width:100%;" /></a>
						<div class="t-h5"><h5>New!</h5></div>
					  <div class="desc clearfix">
						<h1>Lorem ipsum dolor sit</h1>
						<div class="price-desc clearfix">
						<div class="col-md-6 col-sm-6">
						<h3><i class="fa fa-inr" aria-hidden="true"></i>&nbsp;6001.19</h3>
						<ul class="list-inline">
							<li><i class="fa fa-star" aria-hidden="true"></i></li>
							<li><i class="fa fa-star" aria-hidden="true"></i></li>
							<li><i class="fa fa-star" aria-hidden="true"></i></li>
							<li><i class="fa fa-star" aria-hidden="true"></i></li>
							<li><i class="fa fa-star-o" aria-hidden="true"></i></li>
						</ul>
					    </div>
					    <div class="col-md-6 col-sm-6">
						 <button class="btn btn-default">Add to Cart</button>
					    </div>
						</div>
					  </div>
						</div>                		
                	</div><!--/row-fluid-->
                </div><!--/item-->
                 
                </div><!--/carousel-inner-->
                 
                <a class="left carousel-control" href="#myCarousel" data-slide="prev"><i class="fa fa-angle-left" aria-hidden="true"></i>
</a>
                <a class="right carousel-control" href="#myCarousel" data-slide="next"><i class="fa fa-angle-right" aria-hidden="true"></i>
</a>
                </div><!--/myCarousel-->
                 
            </div><!--/well-->   
		</div>
	</div>
</div>
</section><div class="clearfix"></div><!--best-product-->
<!--splash-->
<section class="splash">
	<div class="container">
		<div class="col-md-4">
			<div class="splash-content">
				<h3>splash-proof.</h3>
				<h3>micro four thirds.</h3>
				<p>From  <i class="fa fa-inr" aria-hidden="true"></i> 796</p>
				<a href="#">view now<i class="fa fa-angle-right" aria-hidden="true"></i></a>
			</div>
		</div>
		<div class="col-md-3">
		</div>
		<div class="col-md-5">
			<div class="splash-img">
				<img src="<?php echo theme_img('splash-img.png'); ?>" class="img-responsive" alt="splash-img"/>
			</div>
		</div>
	</div>
</section><div class="clearfix"></div><!--end splash-->
<!--new-Arrival-->
<section class="portfolio">
  <div class="container">
		<h2>New <span>Arrival Products</span></h2>
		<div class="b-border"></div>
    <div class="pull-right">
      <button class="btn btn-small btn-primary" data-toggle="portfilter" data-target="all">New Arrival</button>
      <button class="btn btn-small btn-primary" data-toggle="portfilter" data-target="best-seller">Best seller</button>
      <button class="btn btn-small btn-primary" data-toggle="portfilter" data-target="popular">Popular</button>
      <button class="btn btn-small btn-primary" data-toggle="portfilter" data-target="special-offer">Special Offer</button>
      <button class="btn btn-small btn-primary" data-toggle="portfilter" data-target="latest-edition">Latest Edition</button>
    </div>
    <!--gallery-images-->
    <div class="thumbnails gallery">
      <ul class="list-inline clearfix">
        <li class="col-md-3 clearfix" data-tag='latest-edition'>
          <div class="thumbnail"> <img src="<?php echo theme_img('light1.png'); ?>" class="img-responsive"  alt="image01"/> 
		  <div class="caption">
			<ul class="list-inline">
				    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Details!"><i class="fa fa-search" aria-hidden="true"></i></a></li>
					<li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Cart!"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a></li>
					<li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Wishlist!"><i class="fa fa-heart" aria-hidden="true"></i></a></li>
			<ul>
		  </div>
		  </div>		  
		  <div class="thumb-desc">
			<h4>Lorem ipsum dolor sit</h4>
			<ul class="list-inline">
				<li><i class="fa fa-star" aria-hidden="true"></i></li>
				<li><i class="fa fa-star" aria-hidden="true"></i></li>
				<li><i class="fa fa-star" aria-hidden="true"></i></li>
				<li><i class="fa fa-star" aria-hidden="true"></i></li>
				<li><i class="fa fa-star" aria-hidden="true"></i></li>
			</ul>
			<p><i class="fa fa-inr" aria-hidden="true"></i> 19000.00 <span><i class="fa fa-inr" aria-hidden="true"></i> 20500.00</span></p>
		  </div>
        </li>
        <li class="col-md-3" data-tag='best-seller'>
          <div class="thumbnail" > <img src="<?php echo theme_img('light2.png'); ?>" class="img-responsive"  alt="image02"/> 
			<div class="caption">
			<ul class="list-inline">
				    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Details!"><i class="fa fa-search" aria-hidden="true"></i></a></li>
					<li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Cart!"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a></li>
					<li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Wishlist!"><i class="fa fa-heart" aria-hidden="true"></i></a></li>
			<ul>
		  </div>
		  </div>
		  <div class="thumb-desc">
			<h4>Lorem ipsum dolor sit</h4>
			<ul class="list-inline">
				<li><i class="fa fa-star" aria-hidden="true"></i></li>
				<li><i class="fa fa-star" aria-hidden="true"></i></li>
				<li><i class="fa fa-star" aria-hidden="true"></i></li>
				<li><i class="fa fa-star-o" aria-hidden="true"></i></li>
				<li><i class="fa fa-star-o" aria-hidden="true"></i></li>
			</ul>
			<p><i class="fa fa-inr" aria-hidden="true"></i> 19000.00 <span><i class="fa fa-inr" aria-hidden="true"></i> 20500.00</span></p>
		  </div>
        </li>
        <li class="col-md-3" data-tag='popular'>
          <div class="thumbnail"> <img src="<?php echo theme_img('light3.png'); ?>" class="img-responsive"  alt="image03"/> 
			<div class="caption">
			<ul class="list-inline">
				    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Details!"><i class="fa fa-search" aria-hidden="true"></i></a></li>
					<li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Cart!"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a></li>
					<li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Wishlist!"><i class="fa fa-heart" aria-hidden="true"></i></a></li>
			<ul>
		  </div>
		  </div>
		  <div class="thumb-desc">
			<h4>Lorem ipsum dolor sit</h4>
			<ul class="list-inline">
				<li><i class="fa fa-star" aria-hidden="true"></i></li>
				<li><i class="fa fa-star" aria-hidden="true"></i></li>
				<li><i class="fa fa-star" aria-hidden="true"></i></li>
				<li><i class="fa fa-star" aria-hidden="true"></i></li>
				<li><i class="fa fa-star-o" aria-hidden="true"></i></li>
			</ul>
			<p><i class="fa fa-inr" aria-hidden="true"></i> 19000.00 <span><i class="fa fa-inr" aria-hidden="true"></i> 20500.00</span></p>
		  </div>
        </li>
        <li class="col-md-3" data-tag='popular'>
          <div class="thumbnail"> <img src="<?php echo theme_img('light4.png'); ?>" class="img-responsive"  alt="image04"/> 
			<div class="caption">
			<ul class="list-inline">
				    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Details!"><i class="fa fa-search" aria-hidden="true"></i></a></li>
					<li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Cart!"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a></li>
					<li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Wishlist!"><i class="fa fa-heart" aria-hidden="true"></i></a></li>
			<ul>
		  </div>
		  </div>
		  <div class="thumb-desc">
			<h4>Lorem ipsum dolor sit</h4>
			<ul class="list-inline">
				<li><i class="fa fa-star" aria-hidden="true"></i></li>
				<li><i class="fa fa-star" aria-hidden="true"></i></li>
				<li><i class="fa fa-star" aria-hidden="true"></i></li>
				<li><i class="fa fa-star" aria-hidden="true"></i></li>
				<li><i class="fa fa-star-o" aria-hidden="true"></i></li>
			</ul>
			<p><i class="fa fa-inr" aria-hidden="true"></i> 19000.00 <span><i class="fa fa-inr" aria-hidden="true"></i> 20500.00</span></p>
		  </div>
        </li>
        <li class="col-md-3" data-tag='best-seller'>
          <div class="thumbnail" > <img src="<?php echo theme_img('projector1.png'); ?>" class="img-responsive"  alt="image05"/>
			<div class="caption">
			<ul class="list-inline">
				    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Details!"><i class="fa fa-search" aria-hidden="true"></i></a></li>
					<li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Cart!"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a></li>
					<li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Wishlist!"><i class="fa fa-heart" aria-hidden="true"></i></a></li>
			<ul>
		  </div>
		  </div>
		  <div class="thumb-desc">
			<h4>Lorem ipsum dolor sit</h4>
			<ul class="list-inline">
				<li><i class="fa fa-star" aria-hidden="true"></i></li>
				<li><i class="fa fa-star" aria-hidden="true"></i></li>
				<li><i class="fa fa-star" aria-hidden="true"></i></li>
				<li><i class="fa fa-star" aria-hidden="true"></i></li>
				<li><i class="fa fa-star" aria-hidden="true"></i></li>
			</ul>
			<p><i class="fa fa-inr" aria-hidden="true"></i> 19000.00 <span><i class="fa fa-inr" aria-hidden="true"></i> 20500.00</span></p>
		  </div>
        </li>
        <li class="col-md-3" data-tag='best-seller'>
          <div class="thumbnail"> <img src="<?php echo theme_img('projector2.png'); ?>" class="img-responsive"  alt="image06"/>
			<div class="caption">
			<ul class="list-inline">
				    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Details!"><i class="fa fa-search" aria-hidden="true"></i></a></li>
					<li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Cart!"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a></li>
					<li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Wishlist!"><i class="fa fa-heart" aria-hidden="true"></i></a></li>
			<ul>
		  </div>
		  </div>
		  <div class="thumb-desc">
			<h4>Lorem ipsum dolor sit</h4>
			<ul class="list-inline">
				<li><i class="fa fa-star" aria-hidden="true"></i></li>
				<li><i class="fa fa-star" aria-hidden="true"></i></li>
				<li><i class="fa fa-star" aria-hidden="true"></i></li>
				<li><i class="fa fa-star-o" aria-hidden="true"></i></li>
				<li><i class="fa fa-star-o" aria-hidden="true"></i></li>
			</ul>
			<p><i class="fa fa-inr" aria-hidden="true"></i> 19000.00 <span><i class="fa fa-inr" aria-hidden="true"></i> 20500.00</span></p>
		  </div>
        </li>
        <li class="col-md-3 clearfix" data-tag='popular'>
          <div class="thumbnail"> <img src="<?php echo theme_img('projector3.png'); ?>" class="img-responsive"  alt="image07"/> 
			<div class="caption">
			<ul class="list-inline">
				    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Details!"><i class="fa fa-search" aria-hidden="true"></i></a></li>
					<li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Cart!"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a></li>
					<li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Wishlist!"><i class="fa fa-heart" aria-hidden="true"></i></a></li>
			<ul>
		  </div>
		  </div>
		  <div class="thumb-desc">
			<h4>Lorem ipsum dolor sit</h4>
			<ul class="list-inline">
				<li><i class="fa fa-star" aria-hidden="true"></i></li>
				<li><i class="fa fa-star" aria-hidden="true"></i></li>
				<li><i class="fa fa-star" aria-hidden="true"></i></li>
				<li><i class="fa fa-star" aria-hidden="true"></i></li>
				<li><i class="fa fa-star-o" aria-hidden="true"></i></li>
			</ul>
			<p><i class="fa fa-inr" aria-hidden="true"></i> 19000.00 <span><i class="fa fa-inr" aria-hidden="true"></i> 20500.00</span></p>
		  </div>
        </li>
        <li class="col-md-3" data-tag='special-offer'>
          <div class="thumbnail"> <img src="<?php echo theme_img('projector4.png'); ?>" class="img-responsive"  alt="image08"/> 
			<div class="caption">
			<ul class="list-inline">
				    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Details!"><i class="fa fa-search" aria-hidden="true"></i></a></li>
					<li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Cart!"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a></li>
					<li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Wishlist!"><i class="fa fa-heart" aria-hidden="true"></i></a></li>
			<ul>
		  </div>
		  </div>
		  <div class="thumb-desc">
			<h4>Lorem ipsum dolor sit</h4>
			<ul class="list-inline">
				<li><i class="fa fa-star" aria-hidden="true"></i></li>
				<li><i class="fa fa-star" aria-hidden="true"></i></li>
				<li><i class="fa fa-star" aria-hidden="true"></i></li>
				<li><i class="fa fa-star" aria-hidden="true"></i></li>
				<li><i class="fa fa-star-o" aria-hidden="true"></i></li>
			</ul>
			<p><i class="fa fa-inr" aria-hidden="true"></i> 19000.00 <span><i class="fa fa-inr" aria-hidden="true"></i> 20500.00</span></p>
		  </div>
        </li>
      </ul>
      <div class="center-b">
		<button class="btn btn-default">More Collections</button>
	  </div>
      </div>    
  </div>
</section><div class="clearfix"></div><!--end-new-arrival-->
<!--projector-light-->
<section class="project-light">
	<div class="container">
		<div class="col-md-7">
			<div class="projector-img">
				<img src="<?php echo theme_img('project1.png'); ?>" class="img-responsive" alt="projector-img"/>
			</div>
			<div class="projector-content">
				<p>Lorem ipsum dolor sit</p>
				<a href="#">read more<i class="fa fa-angle-right" aria-hidden="true"></i></a>
			</div>
		</div>
		<div class="col-md-5">
			<div class="light-img">
				<img src="<?php echo theme_img('projectlight1.png'); ?>" class="img-responsive" alt="light-img"/>
			</div>
			<div class="light-content">
				<p>Lorem ipsum dolor sit</p>
				<a href="#">read more<i class="fa fa-angle-right" aria-hidden="true"></i></a>
			</div>
		</div>
	</div>
</section><div class="clearfix"></div><!--end projector-light-->
<!--newsletter-->
<section class="newsletter">
	<div class="container">
		<div class="col-md-3">
			<h3>Sign up for <span>our</span> newsletter</h3>
		</div>
		<div class="col-md-9">
			<div class="input-group">
				 <input class="form-control" placeholder="ENTER YOUR MAIL" type="email">
				 <span class="input-group-btn">
				 <button class="btn btn-theme" type="submit">Subscribe</button>
				 </span>
			</div>
		</div>
	</div>
</section><div class="clearfix"></div><!--end newsletter-->
<!--brand-slider-->
<section class="new-brands">
	<div class="container">
		<h2>New <span>Lamps by Brand</span></h2>
		<div class="b-border"></div>
		    <div id="myCarousel2" class="carousel slide">                 
                <!-- Carousel items -->
                <div class="carousel-inner"> 
					<!--item-1-->
                <div class="item active">
                	<div class="row-fluid clearfix">
                	  <div class="col-md-3"><a href="#x" class="thumbnail"><img src="<?php echo theme_img('benq-logo.png'); ?>" class="img-responsive" alt="Image" style="max-width:100%;" /></a></div>
                	  <div class="col-md-3"><a href="#x" class="thumbnail"><img src="<?php echo theme_img('acer-logo.png'); ?>" class="img-responsive" alt="Image" style="max-width:100%;" /></a></div>
                	  <div class="col-md-3"><a href="#x" class="thumbnail"><img src="<?php echo theme_img('epson-logo.png'); ?>" class="img-responsive" alt="Image" style="max-width:100%;" /></a></div>
                	  <div class="col-md-3"><a href="#x" class="thumbnail"><img src="<?php echo theme_img('toshiba-logo.png'); ?>" class="img-responsive" alt="Image" style="max-width:100%;" /></a></div>
                	</div><!--/row-fluid-->
					<div class="row-fluid clearfix">
                	  <div class="col-md-3"><a href="#x" class="thumbnail"><img src="<?php echo theme_img('hitachi-logo.png'); ?>" class="img-responsive" alt="Image" style="max-width:100%;" /></a></div>
                	  <div class="col-md-3"><a href="#x" class="thumbnail"><img src="<?php echo theme_img('infocus-logo.png'); ?>" class="img-responsive" alt="Image" style="max-width:100%;" /></a></div>
                	  <div class="col-md-3"><a href="#x" class="thumbnail"><img src="<?php echo theme_img('sony-logo.png'); ?>" class="img-responsive" alt="Image" style="max-width:100%;" /></a></div>
                	  <div class="col-md-3"><a href="#x" class="thumbnail"><img src="<?php echo theme_img('panasonic-logo.png'); ?>" class="img-responsive" alt="Image" style="max-width:100%;" /></a></div>
                	</div><!--/row-fluid-->
                </div><!--/item-->
                 
               <!--item-2-->
                <div class="item">
                	<div class="row-fluid clearfix">
                	  <div class="col-md-3"><a href="#x" class="thumbnail"><img src="<?php echo theme_img('benq-logo.png'); ?>" class="img-responsive" alt="Image" style="max-width:100%;" /></a></div>
                	  <div class="col-md-3"><a href="#x" class="thumbnail"><img src="<?php echo theme_img('acer-logo.png'); ?>" class="img-responsive" alt="Image" style="max-width:100%;" /></a></div>
                	  <div class="col-md-3"><a href="#x" class="thumbnail"><img src="<?php echo theme_img('epson-logo.png'); ?>" class="img-responsive" alt="Image" style="max-width:100%;" /></a></div>
                	  <div class="col-md-3"><a href="#x" class="thumbnail"><img src="<?php echo theme_img('toshiba-logo.png'); ?>" class="img-responsive" alt="Image" style="max-width:100%;" /></a></div>
                	</div><!--/row-fluid-->
					<div class="row-fluid clearfix">
                	  <div class="col-md-3"><a href="#x" class="thumbnail"><img src="<?php echo theme_img('hitachi-logo.png'); ?>" class="img-responsive" alt="Image" style="max-width:100%;" /></a></div>
                	  <div class="col-md-3"><a href="#x" class="thumbnail"><img src="<?php echo theme_img('infocus-logo.png'); ?>" class="img-responsive" alt="Image" style="max-width:100%;" /></a></div>
                	  <div class="col-md-3"><a href="#x" class="thumbnail"><img src="<?php echo theme_img('sony-logo.png'); ?>" class="img-responsive" alt="Image" style="max-width:100%;" /></a></div>
                	  <div class="col-md-3"><a href="#x" class="thumbnail"><img src="<?php echo theme_img('panasonic-logo.png'); ?>" class="img-responsive" alt="Image" style="max-width:100%;" /></a></div>
                	</div><!--/row-fluid-->
                </div><!--/item-->
                 
                <!--item-3-->
                <div class="item">
                	<div class="row-fluid clearfix">
                	  <div class="col-md-3"><a href="#x" class="thumbnail"><img src="<?php echo theme_img('benq-logo.png'); ?>" class="img-responsive" alt="Image" style="max-width:100%;" /></a></div>
                	  <div class="col-md-3"><a href="#x" class="thumbnail"><img src="<?php echo theme_img('acer-logo.png'); ?>" class="img-responsive" alt="Image" style="max-width:100%;" /></a></div>
                	  <div class="col-md-3"><a href="#x" class="thumbnail"><img src="<?php echo theme_img('epson-logo.png'); ?>" class="img-responsive" alt="Image" style="max-width:100%;" /></a></div>
                	  <div class="col-md-3"><a href="#x" class="thumbnail"><img src="<?php echo theme_img('toshiba-logo.png'); ?>" class="img-responsive" alt="Image" style="max-width:100%;" /></a></div>
                	</div><!--/row-fluid-->
					<div class="row-fluid clearfix">
                	  <div class="col-md-3"><a href="#x" class="thumbnail"><img src="<?php echo theme_img('hitachi-logo.png'); ?>" class="img-responsive" alt="Image" style="max-width:100%;" /></a></div>
                	  <div class="col-md-3"><a href="#x" class="thumbnail"><img src="<?php echo theme_img('infocus-logo.png'); ?>" class="img-responsive" alt="Image" style="max-width:100%;" /></a></div>
                	  <div class="col-md-3"><a href="#x" class="thumbnail"><img src="<?php echo theme_img('sony-logo.png'); ?>" class="img-responsive" alt="Image" style="max-width:100%;" /></a></div>
                	  <div class="col-md-3"><a href="#x" class="thumbnail"><img src="<?php echo theme_img('panasonic-logo.png'); ?>" class="img-responsive" alt="Image" style="max-width:100%;" /></a></div>
                	</div><!--/row-fluid-->
                </div><!--/item-->
                 
                </div><!--/carousel-inner-->
                 
                <a class="left carousel-control" href="#myCarousel2" data-slide="prev"><i class="fa fa-angle-left" aria-hidden="true"></i></a>
                <a class="right carousel-control" href="#myCarousel2" data-slide="next"><i class="fa fa-angle-right" aria-hidden="true"></i></a>
                </div><!--/myCarousel-->
	</div>
</section><div class="clearfix"></div><!--end brand slider-->
<?php init_tail();?>

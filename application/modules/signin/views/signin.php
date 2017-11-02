<!--login-->
<section class="d-reg">
<div class="container">
<div class="row">
  <div class="col-md-12 col-sm-12 d-bg">
    <div class="col-md-6 col-sm-6 d-form d-border">
    <div class="message">
    </div>     
    <h1>Returning <span>customer</span></h1>
        <form role="form" class="d-sign">
        <div class="form-group">
          <label for="email">Email Address</label>
          <input type="email" class="form-control" id="email"  placeholder="Email">
        </div>
        <div class="form-group">
          <label for="pwd">Password</label>
          <input type="password" class="form-control" id="password"  placeholder="Password">
        </div>
        </form>
	<div class="d-button2 login"><button class="btn btn-default">Login</button> </div>

        <a href="forgot">Forgot your password?</a>
	  <div class="d-bgr d-log d-log1">
                <h1 class="text-center click">One-click login<?php if(!empty($authFaceBookUrl)) { ?> <a href="<?php echo $authFaceBookUrl;?>"><img src="<?php echo theme_img('/face.png');?>"></a>&nbsp; <?php } if(!empty($authGoogleUrl)) { ?> <a href="<?php echo $authGoogleUrl;?>"><img src="<?php echo theme_img('/g-plus.png');?>"></a><?php } ?></h1>
	  </div>
    </div>  
    <div class="col-md-6 col-sm-6 d-form">
      <h1>New <span>Customer</span></h1>
      <p class="d-customer">By creating an account you will be able to shop faster, be up to date on an order's status, and keep track of the orders you have previously made.</p>
      <div class="d-button"> <a href="signup" class="btn btn-default">Continue</a> </div>
    </div>  
  </div>
</div>
</section><div class="clearfix"></div><!--end login-->
<?php init_tail();?>
<script>
$(document).ready(function () {
            $('.login').on('click', function () {
                var email = $('#email').val();
                var password = $('#password').val();

                $.ajax({
                    type: "POST",
                    url: '<?php echo base_url() ?>signin/ajax_login',
                    data: {email: email, password: password},
                    dataType: "json",
                    beforeSend: function () {
                    },
                    success: function (res) {
                        $('.message').html(res.message);
                        if (res.status == 1) {
                            window.location.href = res.redirect;
                        }
                    }
                });// ajax end
            });//end
});
</script>
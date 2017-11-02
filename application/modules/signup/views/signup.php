<!--Register-->
<section class="d-reg">
	<div class="container">
		<div class="row">
			<div class="col-md-12 d-bg d-bg1 clearfix">
                            <div class="message">
                            </div>                            	
                            <form role="form" class="d-sign">
				<div class="col-md-6 col-sm-6 d-form ">
					 <h1 class="d-login">Create an <span>account</span></h1>					 
							<div class="form-group">
							  <label for="email">First Name</label>
							   <?php echo form_input(array('name' => 'firstname', 'value' => set_value('firstname', ''), 'id' => 'firstname', 'class' => 'form-control', 'placeholder' => "First Name")); ?>
							</div>
							<div class="form-group">
							  <label for="pwd">Last Name</label>
							   <?php echo form_input(array('name' => 'lastname', 'value' => set_value('lastname', ''), 'id' => 'lastname', 'class' => 'form-control', 'placeholder' => "Last Name")); ?>
							</div>
							<div class="form-group">
							  <label for="pwd">Email</label>
							   <?php echo form_input(array('name' => 'email', 'value' => set_value('email', ''), 'id' => 'email', 'class' => 'form-control', 'placeholder' => "Email")); ?>
							</div>							
				</div>
				<div class="col-md-6 col-sm-6 d-form nxt">
						<div class="form-group">
						  <label for="pwd">Mobile</label>
						  <input name="mobile" id="mobile"  class="form-control" placeholder="Mobile number" minlength="4"  maxlength="15" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" >
						</div>
						<div class="form-group">
						  <label for="pwd">Zip Code</label>
						  <?php echo form_input(array('name' => 'zipcode', 'value' => set_value('zipcode', ''), 'id' => 'zipcode', 'class' => 'form-control', 'placeholder' => "Zipcode")); ?>
						</div>
						<div class="form-group">
						  <label for="email">Password</label>
						  <?php echo form_password(array('name' => 'password', 'value' => set_value('password', ''), 'id' => 'password', 'class' => 'form-control', 'placeholder' => "Password")); ?>
						</div>						
				</div>	
			    </form>
			</div>	
		</div>
		<div class="row">
			<div class="col-md-12 d-bg">			
			<div class="d-button2 register"> <button class="btn btn-default">Submit</button> </div>
			<div class="d-bg d-log">
                            <h1 class="text-center click">One-click Register<?php if(!empty($authFaceBookUrl)) { ?> <a href="<?php echo $authFaceBookUrl;?>"><img src="<?php echo theme_img('/face.png');?>"></a>&nbsp; <?php } if(!empty($authGoogleUrl)) { ?> <a href="<?php echo $authGoogleUrl;?>"><img src="<?php echo theme_img('/g-plus.png');?>"></a><?php } ?></h1>
			</div>
		</div>
		</div>
	</div>
</section><div class="clearfix"></div>
<?php init_tail();?>
<script>
$(document).ready(function () {
    $('.register').on('click', function () {
        var firstname    = $('#firstname').val();
        var lastname    = $('#lastname').val();
        var email       = $('#email').val();
        var mobile      = $('#mobile').val();
        var zipcode     = $('#zipcode').val();
        var password    = $('#password').val();
        
                        if(firstname == ''){
                                $('.message').html('<div class="alert alert-danger"><a class="close" data-dismiss="alert">x</a>Enter the first name!!!</div>');
                                return false;
                        }
                        if(lastname == ''){
                                $('.message').html('<div class="alert alert-danger"><a class="close" data-dismiss="alert">x</a>Enter the last name!!!</div>');
                                return false;
                        }                        
                        if(email == ''){
                                $('.message').html('<div class="alert alert-danger"><a class="close" data-dismiss="alert">x</a>Enter the email!!!</div>');
                                return false;
                        }
                        if(email != ''){
                                var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                                var a = regex.test(email);
                                if(!a){
                                $('.message').html('<div class="alert alert-danger"><a class="close" data-dismiss="alert">x</a>Enter the valid email!!!</div>');
                                return false;
                                }
                        }			

                        if(mobile == ''){
                                $('.message').html('<div class="alert alert-danger"><a class="close" data-dismiss="alert">x</a>Enter the mobile!!!</div>');
                                return false;
                        }
                        if(!$.isNumeric(mobile)){
                                $('.message').html('<div class="alert alert-danger"><a class="close" data-dismiss="alert">x</a>Enter the number only</div>');
                                return false;
                        }

                        if(zipcode == ''){
                                $('.message').html('<div class="alert alert-danger"><a class="close" data-dismiss="alert">x</a>Enter the zipcode!!!</div>');
                                return false;
                        }
                        /*if(!$.isNumeric(zipcode)){
                                $('.message').html('<div class="alert alert-danger"><a class="close" data-dismiss="alert">x</a>Enter the number only</div>');
                                return false;
                        }*/
                        if(password == ''){
                                $('.message').html('<div class="alert alert-danger"><a class="close" data-dismiss="alert">x</a>Enter the password!!!</div>');
                                return false;
                        }

                        if (password != '') {					
                          var pass = password.length >= 6 ;				
                            if(!pass)
                            {
                             $('.message').html('<div class="alert alert-danger"><a class="close" data-dismiss="alert">x</a>Password should be minium 6 character </div>');
                             return false;
                            }
                        }

        $.ajax({
            type: "POST",
            url: '<?php echo base_url() ?>signup/ajax_register',
            data: {firstname: firstname,lastname: lastname, email: email, mobile: mobile, zipcode: zipcode,password:password},
            dataType: "json",
            beforeSend: function () {
            },
            success: function (res) {
                console.log(res);
                $('.message').html(res.message);
                if (res.status == 1) {
                    setTimeout(function(){
                     window.location.href = res.redirect;
                    },3000);
                }
            }
        });// ajax end
    });//end
});
</script>
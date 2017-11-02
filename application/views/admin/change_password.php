<?php include('header.php'); ?>
<?php 
$passChar   = array('name' => 'passchar','type'  => 'password', 'value' => set_value('passchar'), 'id' => 'passchar', 'class' => 'form-control', 'placeholder' => "Minimum 6 to 12 characters allowed");
$cpassChar  = array('name' => 'cpasschar', 'type'  => 'password','value' => set_value('cpasschar'), 'id' => 'cpasschar', 'class' => 'form-control', 'placeholder' => "Password Confirmation");
?>

<div id="content-wrapper">
    <div class="row">
        <div class="col-lg-12">

            <div class="row">
                <div class="col-lg-12">
                    <ol class="breadcrumb">
                        <li><a href="#">Home</a></li>
                        <li class="active"><span>Change Password</span></li>
                    </ol>
                </div>
            </div>

            <div class="row">

                <div class="col-lg-12">
                    
                        <?php echo form_open($this->config->item('admin_folder') . '/change_password/', ' id="change-pwd-form"'); ?>
                    <div class="main-box">
                        <header class="main-box-header clearfix">
                            <h2>Change Password</h2>
                        </header>
                        <div class="main-box-body clearfix">
                            <div class="row">
                                <div class="form-group col-xs-6">
                                    <label><b>New Password</b></label>
                                    <?php
                                    echo form_input($passChar);
                                    ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-xs-6">
                                    <label><b>Re-enter Password</b></label>
                                    <?php
                                    echo form_input($cpassChar);
                                    ?>
                                </div>
                            </div>

                           

                         
                           </div>
                        </div>
                    
                    <div class="row">
                        <div class="col-lg-12">
                            <div style="padding:15px;overflow: hidden;" class="main-box">
                                <div class="row">
                                        <div class="row actions">
											<div class="admin-ordbtn">
											<button type="submit" class="btn btn-primary">Save</button>
											<button type="button" onClick="redirect();" class="btn btn-default">Cancel</button>
											</div>
										</div>
                                    </div>
                            </div>
                        </div>
                    </div>

                        </form>

                    
                </div>	
            </div>




        </div>
    </div>


    <script type="text/javascript" src="<?php echo admin_js('jquery.validate.js'); ?>"></script>


    <script>
        var baseurl = "<?php print base_url(); ?>";

        function redirect()
        {
            window.location = baseurl + '<?php echo $this->config->item('admin_folder'); ?>/change_password'
        }

        $(document).ready(function () {
            
         

            
            $("#change-pwd-form").validate({
                errorElement: "label",
                errorClass: "inputError",
                successClass: "inputSuccess",
                //set the rules for the fild names
                rules: {
                    passchar: {
                        required: true,
                        minlength: 6,
                        maxlength: 12

                    },
                    cpasschar: {
                        required: true,
                        minlength: 6,
                        equalTo: "#passchar",
                        maxlength: 12

                    },
                },
                //set messages to appear inline
                messages: {
                    passchar:{
                            required: "Password Required",
                            minlength: "Must be at least 6 characters long",
                            maxlength: "Password can not be more than 15 characters",
                        },
                    cpasschar:{
                                required: "Password Confirmation Required",
                                minlength: "Must be at least 6 characters long",
                                maxlength: "Password can not be more than 15 characters",
                                equalTo: "Password Not Matching"
                      },
                },
                errorPlacement: function (error, element) {
                    error.appendTo(element.parent());
                },
                highlight: function (element) {
                    $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
                },
                success: function (element) {
                    element.closest('.form-group').removeClass('has-error').addClass('has-success');
                }

           
        });//END

        });//document
    </script> 

<?php include('footer.php'); ?>

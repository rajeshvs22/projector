<?php include('header.php'); ?>
<?php 
$first_name = array('name' => 'firstname', 'value' => set_value('firstname', $firstname), 'class' => 'form-control');
$last_name = array('name' => 'lastname', 'value' => set_value('lastname', $lastname), 'class' => 'form-control');
$email_id = array('name' => 'email', 'value' => set_value('email', $email), 'class' => 'form-control');
$phone      = array('name' => 'phone', 'value' => set_value('phone',$phone), 'id' => 'phone', 'class' => 'form-control', 'placeholder' => "Phone");


?>

<div id="content-wrapper">
    <div class="row">
        <div class="col-lg-12">

            <div class="row">
                <div class="col-lg-12">
                    <ol class="breadcrumb">
                        <li><a href="#">Home</a></li>
                        <li class="active"><span>Edit Profile</span></li>
                    </ol>


                </div>
            </div>
            <div class="row">

                <div class="col-lg-12">
                    
                  <?php echo form_open_multipart($this->config->item('admin_folder') . '/profile/edit_profile/' . $id, ' id="admin-user-form"'); ?>
                    <div class="main-box">
                        <header class="main-box-header clearfix">
                            <h2>Edit Profile</h2>
                        </header>
                            <div class="main-box-body clearfix">
                                <div class="row">                                    
                                    <div class="form-group col-xs-6">
                                        <label><b>First Name</b></label>
                                            <?php
                                            echo form_input($first_name);
                                            ?>
                                    </div>
                                    <div class="form-group col-xs-6">
                                        <label><b>Last Name</b></label>
                                            <?php                                            
                                            echo form_input($last_name);
                                            ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <!--<div class="form-group col-xs-6">
                                        <label><b>User Email</b></label>
                                            <?php                                            
                                            //echo form_input($email_id);
                                            ?>
                                    </div>-->
                                    <div class="form-group col-xs-6">
                                        <label><b>Mobile</b></label>
                                            <?php                                            
                                            echo form_input($phone);
                                            ?>
                                    </div>
                                </div>
                                
                                
                                <!--<div class="form-group col-xs-6">
                                        <label><b>Profile image</b></label>
                                           <?php
                                           
										  // echo form_uploads("userimage"):
										   
										   ?>
                                           
                                           <input type="file" name="fileToUpload" />
                                    </div>-->
                                
                                
                                
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
  

    <script src="<?php echo admin_js('jquery.maskedinput.min.js'); ?>"></script>

    <script>
	    var baseurl = "<?php print base_url(); ?>";
        function redirect()
        {
            window.location = baseurl + '<?php echo $this->config->item('admin_folder'); ?>'
        }
        
        
        $(document).ready(function(){
            /*********************** Validation ***********************************/
            $("#admin-user-form").validate({
                errorElement: "label",
                errorClass: "inputError",
                successClass: "inputSuccess",
                //set the rules for the fild names
                rules: {
                   
                    firstname: {
                        required: true,
                    },
                    email: {
                        required: true,
                    },
                    phone:{
                        required:true,
                    }
                   
                },
                //set messages to appear inline
                messages: {
                    
                    firstname: {
                        required: " ",
                    },
                    email: {
                        required: " ",
                    },
                    phone:{
                        required:" ",
                    }
                   
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

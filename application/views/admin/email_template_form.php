<?php include('header.php'); ?>
<?php //include('left.php');  ?>

<div id="content-wrapper">
    <div class="row">
        <div class="col-lg-12">

            <div class="row">
                <div class="col-lg-12">
                    <ol class="breadcrumb">
                        <li><a href="#">Home</a></li>
                        <li class="active"><span>Add New Email Template</span></li>
                    </ol>


                </div>
            </div>


            <div id="js_error_container" class="alert alert-error" style="display:none;"> 
                <p id="js_error"></p>
            </div>

            <div id="js_note_container" class="alert alert-note" style="display:none;">

            </div>



            <div class="row">

                <div class="col-lg-12">
                    <div class="main-box">
                        <header class="main-box-header clearfix">
                            <h2>Add Email Template</h2>
                        </header>
                        <?php echo form_open($this->config->item('admin_folder') . '/settings/canned_message_form/' . $id, ' id="req-form"'); ?>
                        <div class="main-box-body clearfix">
                            <div class="row">
                                <div class="form-group col-xs-5">
                                    <label><b>Email Name</b></label>

                                    <?php
                                    $name_array = array('name' => 'email_name', 'class' => 'form-control', 'value' => set_value('email_name', $email_name));

                                    echo form_input($name_array);
                                    ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-xs-5">
                                    <label><b>Email Subject</b></label>

                                    <?php echo form_input(array('name' => 'subject', 'class' => 'form-control', 'value' => set_value('subject', $subject))); ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-xs-9">
                                    <label><b>Email Message</b></label>
                                    <?php
                                    //$data = array('id' => 'description', 'name' => 'content', 'row' => 10, 'class' => 'form-control ckeditor', 'style' => 'height: 300px;', 'value' => set_value('content', $content));
                                    //echo form_textarea($data);
                                    ?>
 <textarea id="description" name="content"  class="form-control ck_editor ckeditor"><?php echo $content; ?></textarea>
                                </div>
                            </div>
                        </div>   
                        <br/><br/>
                    </div>



                </div>
            </div>	
        </div>



        <div class="col-lg-12">
            <div style="padding:15px;overflow: hidden;" class="main-box">
                <div class="row">
                    <div class="row actions">
                        <div class="col-md-3">&nbsp;</div>
                        <div class="col-md-3"><button type="submit" style="margin-left: 35px;" class="col-md-9 btn btn-primary">Save</button></div>
                        <div class="col-md-3"><button type="button" onClick="redirect();" style="margin-left: 35px;" class="col-md-9 btn btn-default">Cancel</button></div>
                        <div class="col-md-3">&nbsp;</div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <script type="text/javascript" src="<?php echo admin_js('jquery.validate.js'); ?>"></script>
    <?php echo admin_js('jquery.validate-rules.js', true); ?>
    <script src="<?php echo admin_js('jquery.maskedinput.min.js'); ?>"></script>
    <script src="<?php echo admin_js('bootstrap-datepicker.js'); ?>"></script>
    <script src="<?php echo admin_js('ckeditor/ckeditor.js'); ?>"></script>

    <script>
        var baseurl = "<?php print base_url(); ?>";
        function redirect()
        {
            window.location = baseurl + '<?php echo $this->config->item('admin_folder'); ?>/settings'
        }
    </script> 

    <?php include('footer.php'); ?>

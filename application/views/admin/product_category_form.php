<?php include('header.php'); 

$single_img = array();
//int_r($category_image); exit;
foreach ($category_image as $img) {
    if ($img['referal_value'] == 'category_image') {
        $single_img = $img;
    }
}
?>
<div id="content-wrapper">
    <div class="row">
        <div class="col-lg-12">

            <div class="row">
                <div class="col-lg-12">
                    <ol class="breadcrumb">
                        <li><a href="#">Home</a></li>
                        <li class="active"><span>Add New Product Category</span></li>
                    </ol>
                </div>
            </div>

            <div class="row">

                <div class="col-lg-12">

                    <?php echo form_open_multipart($this->config->item('admin_folder') . '/Product_category/form/' . $category_id, ' id="product_category_form"'); ?>
                    <div class="main-box">
                        <header class="main-box-header clearfix">
                            <h2>Add Product Category</h2>
                        </header>
                        <div class="main-box-body clearfix">
                            <div class="row">
                                <div class="form-group col-xs-6">
                                    <label><b>Product Category Name</b></label>
                                    <?php
                                    $data = array('name' => 'en_cat', 'value' => set_value('en_cat', $en_cat), 'class' => 'form-control');
                                    echo form_input($data);
                                    ?>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="form-group col-xs-6">
                                    <label><b>Product Category Slug</b></label>
                                    <?php
                                    $data = array('name' => 'en_slug', 'value' => set_value('en_slug', $en_slug), 'class' => 'form-control');
                                    echo form_input($data);
                                    ?>
                                </div>
                            </div>
                             <div class="row">
                                <div class="form-group col-xs-6">
                                    <label><b>Parent</b></label>                            
                              
                                <select  name="parent_id" class="form-control">
                                    <option >Select parent</option>
                                    <?php foreach ($cat as $cl) { ?>
                                        <option value="<?php echo $cl['category_id'] ?>" <?php if ($cl['category_id'] == $parent_id) {
                                        echo 'selected';
                                    } ?> ><?php echo $cl['en_cat']; ?></option>
                                <?php } ?>
                                </select>
                                <?php
                               //echo form_dropdown('parent_id', $category, array($parent_id), 'class="form-control categoryselect"');
                                
                                ?>
                            </div>
                            </div> 
                          
                            <div class="col-md-8">
                            <div style="position:relative;    margin-top: 20px;     margin-bottom: 10px;">
                                <a class='btn btn-primary' href='javascript:;'>
                                    Upload image
                                    <input type="file" style='position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";opacity:0;background-color:transparent;color:transparent;' name="single_image_local" id="single_image_local" size="40" <?php if(empty($single_img)) { echo 'required'; } ?> >
                                </a>
                                &nbsp;
                                <span class='label label-info' id="upload-file-info"></span>
                            </div>
                            <div class="home-banner">
<?php echo category_images($single_img, array('id' => 'myimage', 'height' => '100', 'height' => '100')); ?>
                            </div>
                        </div>   


                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div style="padding:15px;overflow: hidden;" class="main-box">
                                <div class="row">
                                    <div class="row actions">                                        
                                        <button type="submit"  class="btn btn-success btn-mini btn-next" style="margin-left: 20px;margin-right: 20px;">Save</button>
                                        <button type="button" onClick="redirect();"  class="btn btn-default btn-mini btn-prev">Cancel</button>                                        
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
            window.location = baseurl + '<?php echo $this->config->item('admin_folder'); ?>/product_category'
        }

 function Single_image_perview(input) {
                                                    if (input.files && input.files[0]) {
                                                        var reader = new FileReader();
                                                        reader.onload = function (e) {
                                                            $('#myimage').attr('src', e.target.result);
                                                        }

                                                        reader.readAsDataURL(input.files[0]);
                                                    }
                                                }

                                                function check_valid_image(input) {
                                                    var reader = new FileReader();
                                                    reader.readAsDataURL(input.files[0]);
                                                    reader.onload = function (e) {
                                                        var image = new Image();

                                                        image.src = e.target.result;
                                                        image.onload = function () {
                                                            var height = this.height;
                                                            var width = this.width;
                                                            console.log(height);
                                                            console.log(width);
                                                            if (width < 800 || height < 600) {
                                                                alert("Height and Width must exceed 800X600.");
                                                                document.getElementById("single_image_local").value = "";
                                                                return false;
                                                            } else {

                                                                Single_image_perview(input);
                                                                return true;
                                                            }

                                                        }
                                                    };
                                                }

                                                $("#single_image_local").change(function () {

                                                    var res = check_valid_image(this);


                                                });
        $(document).ready(function () {
            $("#subject_level-form").validate({
                errorElement: "label",
                errorClass: "inputError",
                successClass: "inputSuccess",
                //set the rules for the fild names
                rules: {
                    subject_levelName: {
                        required: true,
                    },
                    /*classId: {
                     required: true,
                     },
                     subjectId: {
                     required: true,
                     },
                     chapterId: {
                     required: true,
                     },
                     questionTypeId: {
                     required: true,
                     },
                     questionLevelId: {
                     required: true,
                     },*/
                },
                //set messages to appear inline
                messages: {
                    subject_levelName: {
                        required: " ",
                    },
                    /*classId: {
                     required: " ",
                     },
                     subjectId: {
                     required: " ",
                     },
                     chapterId: {
                     required: " ",
                     },
                     questionTypeId: {
                     required: " ",
                     },
                     questionLevelId: {
                     required: " ",
                     },*/
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

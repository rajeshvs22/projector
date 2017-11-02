<?php 
include('header.php'); 
$single_img = array();
$multiple_img = array();
foreach($product_images as $img){
    if($img['referal_value'] == 'product_image_single'){
        $single_img = $img; 
    }else{
        $multiple_img[] = $img;
    }
}
//echo "<pre>";print_r($single_img);
//echo "<pre>";print_r($multiple_img);exit;
?>
<style>
    .category ul {
    list-style-type: none;
}
.category button {
    background: none;
    border: none;
    color: #03A9F4;
    text-decoration: underline;
    margin-top: 10px;
}
#demo1 a:hover {
    color: #000;
    box-shadow: 0px 0px 3px #777;
}
#demo1 a {
    color: #000;
    border: 2px solid #BAB9B9;
    padding: 5px;
    border-radius: 4px;
    text-decoration: none;
}
.tags button {
    background: none;
    border: none;
    color: #03A9F4;
    text-decoration: underline;
    padding: 10px 0;
}
.tags a {
    color: #000;
    border: 2px solid #BAB9B9;
    padding: 5px;
    border-radius: 4px;
    text-decoration: none;
}
.tags a:hover {
    color: #000;
    box-shadow: 0px 0px 3px #777;
}
.tags span.btn {
    border: none;
    padding: 3px;
}
.basic h2{
    background-color:#b9bdb3;
}

</style>
<?php echo admin_css('libs/select2.css', true); ?>
<body>
    <div id="theme-wrapper">
        <div id="page-wrapper" class="container">
            <div class="row">
                <div id="content-wrapper">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="manual-product">
                                </div>
                                <div class="add-products">
                                    <h3>add products</h3>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="main-box clearfix" style="height: auto;">
                                        <!--Basic-->
                                        <div class="basic">
                                            <h2>Basic Information</h2>                                           
                                            <?php echo form_open_multipart('admin/product/form/'.$product_id ,array('id'=>'product_info')); ?> 
                                            <div class="row">
                                                <div class="col-md-6">    
                                                    <div class="form-group">
                                                        <label>Product Category * </label>
                                                       
                                                        <?php
                                                        echo form_dropdown('category_id', $category, array($category_id), 'class="form-control categoryselect"');
                                                        
                                                        ?>
                                                    </div> 
                                                    <div class="form-group subcat" style="display: none;">
                                                        <label>Product Sub Category</label>
                                                       
                                                        <?php
                                                        echo form_dropdown('subcategory_id', $sub_category, array($subcategory_id), 'class="form-control subcategory-list"');
                                                        
                                                        ?>
                                                    </div>                                                      
                                                    <div class="form-group">
                                                        <label for="email">Product Name * </label>
                                                        <?php
                                                        $data = array('name' => 'product_name', 'value' => set_value('product_name', $product_name), 'class' => 'form-control');
                                                        echo form_input($data);
                                                        ?>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="email">Unique Id</label>                                                        
                                                        <input type="text" readonly class="form-control" id="product_unique_id" name="product_unique_id" value="<?php echo $product_unique_id; ?>">
                                                    </div>      
                                                    
                                                    
                                                    <div class="form-group descrip">
                                                        <label for="comment">Description * </label>
                                                        <textarea name="product_description" value="" class="form-control ck_editor ckeditor"><?php echo $product_description; ?></textarea>
                                                       
                                                    </div>
                                                    
                                                </div>     
                                                <div class="col-md-6">
                                                    <div class="main-box">
                                                        <h2>All Categories</h2> 
                                                        <div class="main-box-body clearfix">
                                                            <div class="category">                                                  
                                                                                                                   
                                                                <ul class="nav nav-tabs">
                                                                    <li class="active"><a data-toggle="tab" href="#all-category">All Category</a></li>
                                                                    <li><a data-toggle="tab" href="#most-used">Most used</a></li>									  
                                                                </ul>
                                                                <div class="tab-content">
                                                                    <div id="all-category" class="tab-pane fade in active">	
                                                                        <ul>
                                                                            <li><div class="checkbox-nice">
                                                                                    <input type="checkbox" id="checkbox-0" checked="checked" />
                                                                                    <label for="checkbox-1">
                                                                                        aaa
                                                                                    </label>
                                                                                </div>
                                                                                <ul>
                                                                                    <li><div class="checkbox-nice">
                                                                                            <input type="checkbox" id="checkbox-1"/>
                                                                                            <label for="checkbox-1">
                                                                                                aaa
                                                                                            </label>
                                                                                        </div></li>
                                                                                    <li><div class="checkbox-nice">
                                                                                            <input type="checkbox" id="checkbox-2" />
                                                                                            <label for="checkbox-2">
                                                                                                bbb
                                                                                            </label>
                                                                                        </div></li>
                                                                                    <li><div class="checkbox-nice">
                                                                                            <input type="checkbox" id="checkbox-3" />
                                                                                            <label for="checkbox-3">
                                                                                                ccc
                                                                                            </label>
                                                                                        </div></li>
                                                                                </ul>
                                                                            </li>
                                                                            <li><div class="checkbox-nice">
                                                                                    <input type="checkbox" id="checkbox-2" />
                                                                                    <label for="checkbox-2">
                                                                                        bbb
                                                                                    </label>
                                                                                </div></li>
                                                                            <li><div class="checkbox-nice">
                                                                                    <input type="checkbox" id="checkbox-3" />
                                                                                    <label for="checkbox-3">
                                                                                        ccc
                                                                                    </label>
                                                                                </div></li>
                                                                        </ul>
                                                                    </div>
                                                                    <div id="most-used" class="tab-pane fade">											
                                                                        <ul>
                                                                            <li><div class="checkbox-nice">
                                                                                    <input type="checkbox" id="checkbox-4" checked="checked" />
                                                                                    <label for="checkbox-1">
                                                                                        aaa
                                                                                    </label>
                                                                                </div>
                                                                                <ul>
                                                                                    <li><div class="checkbox-nice">
                                                                                            <input type="checkbox" id="checkbox-1" />
                                                                                            <label for="checkbox-1">
                                                                                                aaa
                                                                                            </label>
                                                                                        </div></li>
                                                                                    <li><div class="checkbox-nice">
                                                                                            <input type="checkbox" id="checkbox-2" />
                                                                                            <label for="checkbox-2">
                                                                                                bbb
                                                                                            </label>
                                                                                        </div></li>
                                                                                    <li><div class="checkbox-nice">
                                                                                            <input type="checkbox" id="checkbox-3" />
                                                                                            <label for="checkbox-3">
                                                                                                ccc
                                                                                            </label>
                                                                                        </div></li>
                                                                                </ul>
                                                                            </li>
                                                                            <li><div class="checkbox-nice">
                                                                                    <input type="checkbox" id="checkbox-2" />
                                                                                    <label for="checkbox-2">
                                                                                        bbb
                                                                                    </label>
                                                                                </div></li>
                                                                            <li><div class="checkbox-nice">
                                                                                    <input type="checkbox" id="checkbox-3" />
                                                                                    <label for="checkbox-3">
                                                                                        ccc
                                                                                    </label>
                                                                                </div></li>
                                                                        </ul>
                                                                    </div>										  
                                                                </div>
                                                                <button data-toggle="collapse" data-target="#demo1"><i class="fa fa-plus" aria-hidden="true"></i>
                                                                    Add New Category</button>
                                                                <div id="demo1" class="collapse">
                                                                    <div class="form-group">													
                                                                        <input type="email" class="form-control" id="product" placeholder="">
                                                                    </div>
                                                                    <div class="form-group">													
                                                                        <select class="form-control">
                                                                            <option>Select Category</option>
                                                                            <option>1</option>
                                                                            <option>2</option>
                                                                            <option>3</option>
                                                                            <option>4</option>
                                                                            <option>5</option>
                                                                        </select>
                                                                    </div>
                                                                    <a href="#">Add New Category</a>
                                                                </div> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="main-box">																				
                                                        <div class="main-box-body clearfix">
                                                            <div class="tags">                                                               
                                                                    <h2>Tags</h2>                                                               
                                                                <div class="form-group">													
                                                                    <input type="text" class="form-control form-tag" id="tag" placeholder="">
                                                                </div>
                                                                <div class="form-group">
                                                                    <a href="#">Add</a>
                                                                </div>
                                                                <p>Separate tags with commas</p>
                                                                <ul class="list-inline">
                                                                    <li><span class="btn"><i class="fa fa-times-circle" aria-hidden="true"></i></span>rghnd</li>
                                                                    <li><span class="btn"><i class="fa fa-times-circle" aria-hidden="true"></i></span>rghnd</li>
                                                                </ul>
                                                                <button data-toggle="collapse" data-target="#demo">Choose from the most used tags</button>
                                                                <div id="demo" class="collapse">
                                                                    <div class="form-group">													
                                                                        <input type="text" class="form-control" id="tag" placeholder="No tags found">
                                                                    </div>
                                                                </div> 
                                                            </div>						

                                                        </div>
                                                    </div>

                                                </div>                                                            
                                            </div> 
                                            
                                            <div class="ba-in"></div>
                                            
                                            <!--main-->
                                        <div class="basic" id="main">
                                            <h2>Main Image</h2>                                           
                                            <div class="main-image">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="counter-main">
                                                            <h4><a href="">Counterfeit products are prohibited on Reload.</a></h4>
                                                            <ul class="list-unstyled">
                                                                <li><i class="fa fa-check" aria-hidden="true"></i>
                                                                    Products with multiple high quality images get the most sales.
                                                                </li>
                                                                <li><i class="fa fa-check" aria-hidden="true"></i>
                                                                    Add images that are at least 800x800 pixels.
                                                                </li>
                                                                <li><i class="fa fa-check" aria-hidden="true"></i>
                                                                    Do not steal images from other merchants, or your product will be deleted.
                                                                </li>

                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="counter-button">
                                                            <div style="position:relative; text-align:center;">
                                                                
                                                                <a class='btn btn-primary' href='javascript:;'>
                                                                    Select From Your Computer *
                                                                    <input type="file" style='position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";opacity:0;background-color:transparent;color:transparent;' name="single_image_local" id="single_image_local" size="40" <?php if(empty($single_img)) { echo 'required'; } ?> >
                                                                </a>
                                                                &nbsp;
                                                                <span class='label label-info' id="upload-file-info"></span>
                                                            </div>
                                                            <?php echo product_image($single_img ,array('id' => 'myimage' , 'height'=>'100' ,'height'=>'100' ),'thumb'); ?>
                                                            
                                                            <div class="counter-zero">
                                                                <!--<p>or</p>-->
                                                            </div>
                                                            <div style="position:relative; text-align:center;">
                                                                <!--<a class='btn btn-primary' href='javascript:;'>-->
                                                                   <!--<p> Web address(URL)</p>-->
                                                                    <input type="button" style='position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";opacity:0;background-color:transparent;color:transparent;' name="" size="40">
                                                                <!--</a>-->
                                                                <div class="form-group form-ac">

                                                                   <!-- <input class="form-control input-sm" id="inputsm" name="single_image_web" type="text">-->
                                                                </div>
                                                                &nbsp;
                                                                <span class='label label-info' id="upload-file-info"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>                                        
                                        <div class="basic" id="main">
                                            <h2 class="inner-h2">Additional Images</h2>
                                            <div class="info"></div>
                                            <div class="additional-basic">
                                                <ul class="list-inline">
                                                    <li>
                                                        <div style="position:relative; text-align:center;">
                                                            <a class='btn btn-primary' href='javascript:;'>
                                                                Add From Your Computer
                                                                <input type="file" multiple style='position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";opacity:0;background-color:transparent;color:transparent;' name="multiple_image_local[]" id="multiple_image_local" size="40" >
                                                            </a>
                                                            &nbsp;
                                                            <span class='label label-info' id="upload-file-info"></span>
                                                        </div>

                                                    </li>
                                                    <li>
                                                        <div style="position:relative; text-align:center;">
                                                            <!--<a class='btn btn-primary' href='javascript:;'>-->
                                                                <!--<p>Add From Web address(URL)</p>-->
                                                                <input type="button" style='position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";opacity:0;background-color:transparent;color:transparent;' name="" size="40"  >
                                                            <!--</a>-->
                                                            &nbsp;
                                                            <span class='label label-info' id="upload-file-info"></span>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="form-group form-ac">

                                                           <!-- <input class="form-control input-sm" id="inputsm" name="multiple_image_web" type="text">-->
                                                        </div>
                                                    </li>
                                                    <div id="filess"></div>
                                                    <?php
                                                    //if image exists
                                                    foreach($multiple_img as $k => $img_arr){
                                                        echo '<li img_id="'.$img_arr['image_id'].'">
                                                                <span class="pip" >
                                                                    '.product_image($img_arr ,array('class' => 'imageThumb' ,'title'=>'undefined' )).'
                                                                    <br>
                                                                    <span class="remove remove_db">Remove</span>
                                                                </span>
                                                           </li>';
                                                    }
                                                    
                                                    ?>
                                                </ul>
                                            </div>
                                        </div>
                                        <!--main-end-->
                                        <div class="ba-in"></div>
                                        <div class="clearfix"></div>
                                        <!--inventory-->
                                        <div class="basic" id="main">
                                            <h2>Inventory and Shipping</h2>                                           
                                           <div class="shipping-09">
                                               <div class="row">
                                                   <div class="col-md-6">
                                                       <div class="form-group">
                                                           <label for="email">Price * </label>
                                                           <input type="text" class="form-control" id="product_price" onkeypress='return isNumberKeywithdot(event)' name="product_price" value="<?php echo $product_price; ?>">
                                                       </div>
                                                   </div>
                                                   <div class="col-md-6">
                                                       <div class="form-group">
                                                           <label for="email">Quantity *</label>
                                                           <input type="text" class="form-control" id="product_quantity" onkeypress='return isNumberKeywithdot(event)' onchange="return calculate_alomost_gone(this.value)" name="product_quantity" value="<?php echo $product_quantity; ?>">
                                                       </div>
                                                   </div>
                                               </div>
                                               <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="almost_gone">Almost Gone</label>
                                                            <input type="text" class="form-control" readonly="readonly" id="almost_gone" onkeypress='return isNumberKeywithdot(event)' class="form-control" name="almost_gone" value="<?php  echo $almost_gone; ?>">
                                                        </div>
                                                </div>
                                               <div class="row">                                                   
                                                   <div class="col-md-6" style="">
                                                       <fieldset>
                                                           <div class="form-group">
                                                               <label for="email">Shipping Amount</label>
                                                               <input type="text" id="product_shipping" class="form-control" placeholder="Shipping amount" name="product_shipping" value="<?php echo $product_shipping; ?>">
                                                           </div>
                                                       </fieldset>
                                                   </div>
                                               </div>
                                               <div class="row">
                                                   <div class="shipped">
                                                       <label for="email">Shipping Time</label>
                                                       <div class="radio">                                                            
                                                            <input type="radio" id="redio1"  class="myCheckbox"  name="product_shipping_time" value="5-10" <?php echo ($product_shipping_time == '5-10' ? 'checked':'') ?> >
                                                            <label class="checkbox-inline" for="redio1">5-10 Days</label>
                                                       <div>
                                                       <div class="radio"> 
                                                       <input type="radio" id="redio2"  class="myCheckbox"  name="product_shipping_time" value="7-14" <?php echo ($product_shipping_time == '7-14' ? 'checked':'') ?> >
                                                       <label class="checkbox-inline" for="redio2">7-14 Days</label>
                                                       </div>
                                                       <div class="radio">     
                                                       <input type="radio" id="redio3" class="myCheckbox"  name="product_shipping_time" value="10-15"<?php echo ($product_shipping_time == '10-15' ? 'checked':'') ?> >
                                                       <label class="checkbox-inline" for="redio3">10-15 Days</label>
                                                       </div>
                                                       <div class="radio">     
                                                           <input type="radio" id="redio4"  class="myCheckbox"  name="product_shipping_time" value="14-21"<?php echo ($product_shipping_time == '14-21' ? 'checked':'') ?> >
                                                       <label class="checkbox-inline" for="redio4">14-21 Days</label>
                                                       </div>
                                                       
                                                   </div>
                                               </div>
                                           </div>

                                        </div>
                                        <div class="ba-in"></div>
                                        <div class="clearfix"></div>
                                        <div class="tab-content">
                                            <div class="tab-pane fade in active" id="tab-home">
                                                <div class="panel-group accordion" id="accordion">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading">
                                                            <h4 class="panel-title">
                                                                Offer Information
                                                            </h4>
                                                        </div>
                                                        <div class="panel-body basic">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="email">Product Offer %</label>
                                                                        <input class="form-control" onkeypress="return isNumberKeywithdot(event)" id="msrp" type="text" name="offer" value="<?php echo $offer; ?>" >
                                                                    </div>
<div class="form-group col-md-12 nooffer" style="display: none;">                                                                        <label for="datepickerDate">Start Date</label>
                                                                        <div class="input-group" id="nooffer">
                                                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                                            <input class="form-control" id="datepickerDateFrom" name="offer_start_date" type="text"  value="<?php echo $offer_start_date; ?>" >
                                                                        </div>
                                                                        <span class="help-block">Format yyyy-mm-dd</span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 productadmin">
                                                                    <div class="form-group">
                                                                        <label for="email">Stickey offer</label>
                                                                        <div class="checkbox-nice checkbox-inline">
                                                                            <input id="checkbox-inl-1" name="stickeyoffer" type="checkbox" <?php //echo ($stickeyoffer == '1' ? 'checked':''); ?> <?php if ($stickeyoffer == 1) { echo 'checked="checked"'; } ?>>
                                                                            <label for="checkbox-inl-1"> </label>
                                                                        </div>
                                                                    </div>
<div class="form-group col-md-12 nooffer" style="display: none;">                                                                        <label for="datepickerDate">End Date</label>
                                                                        <div class="input-group">
                                                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                                            <input class="form-control" id="datepickerDateTo" name="offer_end_date" type="text" value="<?php echo $offer_end_date; ?>" >
                                                                        </div>
                                                                        <span class="help-block">Format yyyy-mm-dd</span>
                                                                    </div>
                                                                    <!--<div class="form-group col-md-12">
                                                                        <label for="timepicker">Start Time</label>
                                                                        <div class="input-group input-append bootstrap-timepicker">
                                                                            <input type="text" class="form-control timepicker" name="starttime" id="" value="<?php //echo $starttime; ?>" >
                                                                            <span class="add-on input-group-addon"><i class="fa fa-clock-o"></i></span>
                                                                        </div>
                                                                    </div>-->
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <!--<div class="form-group col-md-12">
                                                                        <label for="timepicker">End Time</label>
                                                                        <div class="input-group input-append bootstrap-timepicker">
                                                                            <input type="text" class="form-control timepicker" id=""   name="endtime" value="<?php //echo $endtime; ?>"  >
                                                                            <span class="add-on input-group-addon"><i class="fa fa-clock-o"></i></span>
                                                                        </div>
                                                                    </div>-->
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="wish-submit">
                                            <ul class="list-inline">
                                                <li><a href="<?php echo $admin_url; ?>product/listproduct"><button type="button" id="clear" onClick="redirect();"  class="btn btn-primary">Back</button></a></li>
                                                <li><input type="submit" value="Submit" class="btn btn-success"></li>
                                            </ul>
                                        </div>
                                        </form>
                                        <!--button-end-->
                                    </div>
                                </div>
                                        
                                        <div class="ba-in"></div>
                                        <div class="clearfix"></div>
                                            
                                        </div>
                                        <!--Basic-end-->
                                        
                                        
                                        
                            </div>
                        </div>
                    </div>
                    <?php include('footer.php'); ?>

<script>


$("#msrp").change(function(){
     var offer = $(this).val(); 
     if(offer !=''){
         $(".nooffer").show();

     }else{
        $(".nooffer").hide();
     }
    });


var imgd= '<?php  if(!empty($single_img)) { echo 1; } else { echo 0;}; ?>';
$('#product_form').submit(function(){
var fileToUpload = $('#single_image_local').prop('files')[0];
var myJSON = JSON.stringify(fileToUpload);
if(myJSON=='{}' || imgd == 1)
{
return  true;
}
else
{
alert('Please choose a product image...!');
return false;
}
});
</script>
                    <script src="<?php echo admin_js('ckeditor/ckeditor.js'); ?>"></script>
                    <script src="<?php echo admin_js('select2.min.js'); ?>"></script>
<script>

   
var baseurl = "<?php print base_url(); ?>";

function redirect() {
  window.location = baseurl + '<?php echo $this->config->item('
  admin_folder '); ?>/product/listproduct'
}

$('.categoryselect').on('change', function() {

  var cat_id = $(this).val();

  $.ajax({
    type: "POST",
    url: "<?php echo base_url(); ?>admin/product/get_product_category_list",
    data:{category_id:cat_id},
    beforeSend: function() {
               //$('.subcat').hide();
            },
    success: function(data) {
        
        var obj = jQuery.parseJSON(data);
        
      if (obj.flag == 'true') {
        $(".subcategory-list").html(obj.select);
        $('.subcat').show();
        

      } else {
        $('.subcat').hide();
      }
    }
  });
});//end categoryselect

$('.myCheckbox').click(function() {
  $(this).siblings('input:checkbox').add('checked', false);
});

function calculate() {
  var price = $('#product_price').val() * (0.85);
  var quantity = $('#product_quantity').val();
  var shipping = $('#product_shipping').val();
  if (shipping > 0) {
    price = price + shipping * ($('#product_price').val() * (0.0085));
  }
  $('#product_earnings').val(price);

}

function Single_image_perview(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      $('#myimage').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
  }
}
$(document).ready(function() {
  $('#clear').click(function() {

    $('.input').val("");
  });
  if (window.File && window.FileList && window.FileReader) {
    $("#multiple_image_local").on("change", function(e) {
      var files = e.target.files,
        filesLength = files.length;
      for (var i = 0; i < filesLength; i++) {
        var f = files[i]
        var fileReader = new FileReader();
        fileReader.onload = (function(e) {

          var image = new Image();
          image.src = e.target.result;
          image.onload = function() {
            var height = this.height;
            var width = this.width;
            if (width < 800 || height < 600) {
              alert("Height and Width must exceed 800X600.");

              //return false;
            } else {
              var file = e.target;
              $("<li><span class=\"pip\">" +
                "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
                "<br/><span class=\"remove\">Remove</span>" +
                "</span></li>").insertAfter("#filess");
              $(".remove").click(function() {
                $(this).parent(".pip").remove();
              });
            }

          }




        });
        fileReader.readAsDataURL(f);
      }
    }); //end multiple upload
  } //end multiple image if


  //Delete multiple images
  $('.remove_db').on('click', function() {
    var img_id = $(this).closest('li').attr('img_id');
    var that = $(this);
    if (confirm("Are you sure to delete this image?")) {
      $.ajax({
        type: "POST",
        url: '<?php echo base_url($this->config->item('
        admin_folder ')); ?>admin/product/delete_image',
        data: {
          img_id: img_id,
          referal_value: 'product_image_multiple'
        },
        dataType: "json",
        beforeSend: function() {
          that.closest('li').hide();
        },
        success: function(res) {
          alert('Image Deleted');
        }
      }); // ajax end
    } //end confirm
  }); //end remove_db

}); //end document

function check_valid_image(input) {
  var reader = new FileReader();
  reader.readAsDataURL(input.files[0]);
  reader.onload = function(e) {
    var image = new Image();

    image.src = e.target.result;
    image.onload = function() {
      var height = this.height;
      var width = this.width;
      console.log(height);
      console.log(width);
      if (width < 800 || height < 600) {
        alert("Height and Width must nexceed 800X600.");
        document.getElementById("single_image_local").value = "";
        return false;
      } else {
        Single_image_perview(input);
        return true;
      }

    }
  };
}

$("#single_image_local").change(function() {

  var res = check_valid_image(this);


});
$(function($) {
  var startDate = new Date('01/01/2012');
  var FromEndDate = new Date();
  var ToEndDate = new Date();

  ToEndDate.setDate(ToEndDate.getDate() + 365);

  $('#datepickerDateFrom').datepicker({
      weekStart: 1,
      startDate: FromEndDate,
      format: 'yyyy-mm-dd',
      autoclose: true
    })
    .on('changeDate', function(selected) {
      startDate = new Date(selected.date.valueOf());
      startDate.setDate(startDate.getDate(new Date(selected.date.valueOf())));
      $('#datepickerDateTo').datepicker('setStartDate', startDate);
    });
  $('#datepickerDateTo')
    .datepicker({
      weekStart: 1,
      startDate: ToEndDate,
      format: 'yyyy-mm-dd',
      autoclose: true
    })
    .on('changeDate', function(selected) {
      FromEndDate = new Date(selected.date.valueOf());
      FromEndDate.setDate(FromEndDate.getDate(new Date(selected.date.valueOf())));
      $('#datepickerDateFrom').datepicker('setEndDate', FromEndDate);
    });

});
$('.timepicker').timepicker({
  minuteStep: 5,
  showSeconds: true,
  showMeridian: false,
  disableFocus: false,
  showWidget: true
}).focus(function() {
  $(this).next().trigger('click');
});


$(function($) {
  $('#sel2').select2();

  $('#sel2Multi').select2({
    placeholder: 'Select a Country',
    allowClear: true
  });
});

function getState(val) {

  $.ajax({
    type: "POST",
    url: "<?php echo base_url(); ?>admin/Premium_product/get_product_list",
    data: 'category_id=' + val,
    success: function(data) {
      console.log(data);
      $("#product-list").html(data);
    }
  });
}

function getproduct(val) {

  $.ajax({
    type: "POST",
    url: "<?php echo base_url(); ?>admin/Premium_product/get_image_list",
    data: 'product_id=' + val,
    success: function(data) {
      console.log(data);
      $("#image_list").html(data);
    }
  });
}

function calculate_alomost_gone(vals){
    var cal = Math.round(vals * (5 / 100));
    var call = (vals - cal);
    $("#almost_gone").val(cal);
} 

</script>


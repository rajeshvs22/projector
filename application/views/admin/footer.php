<footer id="footer-bar" class="row">
    <p id="footer-copyright" class="col-xs-12">
        Powered by <?php echo $this->config->item('company_name'); ?>.
    </p>
</footer>
</div>
</div>
</div>
</div>



<script src="<?php echo admin_js('bootstrap.js'); ?>"></script>
<script src="<?php echo admin_js('jquery.nanoscroller.min.js'); ?>"></script>
<!-- only for demo -->
<!-- this page specific scripts -->
<script src="<?php echo admin_js('jquery.nestable.js'); ?>"></script>
<!-- theme scripts -->
<script src="<?php echo admin_js('scripts.js'); ?>"></script>
<script src="<?php echo admin_js('pace.min.js'); ?>"></script>
<script src="<?php echo admin_js('jquery-ui.js'); ?>"></script>
<script src="<?php echo admin_js('moment.min.js'); ?>"></script>
<?php echo admin_js('daterangepicker.js',true); ?>
<script src="<?php echo admin_js('jquery-dateFormat.js'); ?>"></script>
<script src="<?php //echo admin_js('admin_common_script.js'); ?>"></script>
        <?php echo admin_js('jquery.confirm.js', true); ?>     
   <?php echo admin_js('bootstrap-timepicker.js', true); ?>
        <?php echo admin_js('bootstrap-datepicker.js', true); ?>

 <script src="<?php echo admin_js('jquery.validate.js'); ?>"></script>
 <script src="<?php echo admin_js('jquery.validate-rules.js'); ?>"></script>

<!-- this page specific inline scripts -->



<script>
    var controller  = '<?php echo $this->uri->segment(2); ?>';
    var fun_name    = '<?php echo $this->uri->segment(3); ?>';
    $(document).ready(function(){
        /**** left menu active ****/
        $('#sidebar-nav ul li').removeClass('active');
        $('#sidebar-nav .submenu li').removeClass('active');
        if(controller != ''){
            $('#sidebar-nav ul').find('.'+controller).addClass('active');
            if(fun_name != ''){
                $('#sidebar-nav').find('.'+controller).find('.'+fun_name).addClass('active');
            }
        }else{
            $('#sidebar-nav ul').find('.dashboard').addClass('active');
        }
        /*************************/
        
        /******* Resel Button ***********/
        if($( "#search-form" ).hasClass( "clearfix" )){
            var search = $('#search').find('[type=submit]');
            search.parent().css({'float':'left'});
            search.closest('.input-group').append('<div class="float:left;" style="float: left; margin-left: 5px;"><button class="btn btn-primary reload" type="reset"  ><i class="fa fa-refresh"></i> Reset</button></div>');
            
            $('.reload').on('click',function(){
                window.location.href = window.location.href;
            });//end reset
        }//end if 
    });//end document
</script>



</body>
</html>
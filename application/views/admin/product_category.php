<?php include('header.php'); ?>
<style>
    .abc{
        text-transform: capitalize;
    }
</style>

<div id="content-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12">
                    <ol class="breadcrumb">
                        <li><a href="<?php echo $admin_url; ?>dashboard/">Home</a></li>
                        <li class="active"><span>Product Category</span></li>
                    </ol>

                    <div class="clearfix">
                        <h1 class="pull-left">All Product Category</h1>

                        <div class="pull-right top-page-ui">
                            <a href="<?php echo base_url($this->config->item('admin_folder') . '/product_category/form'); ?>" class="btn btn-primary pull-right">
                                <i class="fa fa-plus-circle fa-lg"></i> Add Product Category
                            </a>
                        </div>
                    </div>
                </div>
            </div>



            <div class="row">
                <div class="col-lg-12">
                    <div class="main-box no-header clearfix">
                        <div class="main-box-body clearfix">
                            <div id="pageresult">
                                <div class="table-responsive">                                             
                                    <table class="table user-list table-hover" id="exp_table">
                                        <thead>
                                            <tr>
                                                <th><span>Category Name</span></th>                                            
                                                <th><span>Category Slug</span></th>  
                                                <th><span>Category Image</span></th>  
                                                <th class="no-sort">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($product_category as $val):
                                                ?>
                                                <tr>
                                                    <td class="abc">
                                                        <?php echo $val['en_cat']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $val['en_slug']; ?>
                                                    </td> 
                                                    <td class="">
                                                        <?php echo product_image($this->category_model->get_category_images($val['category_id'], 'category_image'), '', 'thumb'); ?>

                                                    </td>

                                                    <td style="width: 20%;">																
                                                        <a href="<?php echo base_url($this->config->item('admin_folder') . '/product_category/form/' . $val['category_id']); ?>" class="table-link">
                                                            <span class="fa-stack">
                                                                <i class="fa fa-square fa-stack-2x"></i>
                                                                <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
                                                            </span>
                                                        </a>
                                                        <!--<button class="btn btn-primary" id="complexConfirm">Click me</button>-->
                                                        <a href="<?php echo base_url($this->config->item('admin_folder') . '/product_category/delete/' . $val['category_id']); ?>" str="" class="complexConfirm table-link danger">
                                                            <span class="fa-stack">
                                                                <i class="fa fa-square fa-stack-2x"></i>
                                                                <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>
                                                            </span>
                                                        </a>

                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <span class="tri_del" style="display: none;"></span>   

    <?php echo admin_js('jquery.dataTables.js', true); ?>
    <?php echo admin_js('dataTables.fixedHeader.js', true); ?>
    <?php echo admin_js('dataTables.tableTools.js', true); ?>
    <?php echo admin_js('jquery.dataTables.bootstrap.js', true); ?>
    <script>
        $(function ($) {



            $(document).ready(function () {
                $('#exp_table').DataTable(
                        {
                            "columnDefs": [{
                                    "targets": 'no-sort',
                                    "orderable": false,
                                }]
                        }
                );
            });

            var baseurl = "<?php print base_url(); ?>";

            $(document).on('click', '.complexConfirm', function (event) {
                event.preventDefault();
                var url = $(this).attr('href');
                $('.tri_del').text(url);
                $('.tri_del').trigger('click');
            });

            $(".tri_del").confirm({
                title: "Delete confirmation",
                text: "Do you want to delete this record ?",
                confirm: function (button) {
                    window.location.href = button.text();
                },
                cancel: function (button) {
                    button.text('');
                },
                confirmButton: "Yes",
                cancelButton: "No"
            });//end confirm

            $('#pageresult').on('click', '.t_active', function () {
                var that = $(this);
                var subject_levelId = $(this).attr('oi');

                $.ajax({
                    type: "POST",
                    url: baseurl + '<?php echo $this->config->item('admin_folder'); ?>/subject_level/makeActive',
                    data: {subject_levelId: subject_levelId, status: 'active'},
                    dataType: "json",
                    beforeSend: function () {
                        that.closest('td').append('<span class="t_loader_img"></span>');
                    },
                    success: function (res) {
                        if (res.flag == 1) {
                            that.text('Make Inactive');
                            that.removeClass('t_active label-success').addClass('t_inactive label-danger');
                            that.closest('td').find('.t_loader_img').remove();
                        }
                    }
                });// ajax end
            });//end


            $('#pageresult').on('click', '.t_inactive', function () {
                var that = $(this);
                var subject_levelId = $(this).attr('oi');

                $.ajax({
                    type: "POST",
                    url: baseurl + '<?php echo $this->config->item('admin_folder'); ?>/subject_level/makeInactive',
                    data: {subject_levelId: subject_levelId, status: 'inactive'},
                    dataType: "json",
                    beforeSend: function () {
                        that.closest('td').append('<span class="t_loader_img"></span>');
                    },
                    success: function (res) {
                        if (res.flag == 1) {
                            that.text('Make Active');
                            that.removeClass('t_inactive label-danger').addClass('t_active label-success');
                            that.closest('td').find('.t_loader_img').remove();
                        }
                    }
                });// ajax end
            });//end


        });
    </script>



    <?php include('footer.php'); ?>


<?php include('header.php'); ?>
<?php ?>

<script type="text/javascript" language="javascript">

    var baseurl = "<?php print base_url(); ?>";

    function areyousure()
    {
        return confirm('<?php echo 'Are you want to delete this'; ?>');
    }
</script>

<div id="content-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12">
                    <ol class="breadcrumb">
                        <li><a href="<?php echo $admin_url; ?>dashboard/">Home</a></li>
                        <li class="active"><span>Email Template</span></li>
                    </ol>

                    <div class="clearfix">
                        <h1 class="pull-left">Email Templates</h1>

                        <div class="pull-right top-page-ui">
                            <a href="<?php echo base_url($this->config->item('admin_folder').'/settings/canned_message_form'); ?>" class="btn btn-primary pull-right">
                                <i class="fa fa-plus-circle fa-lg"></i> Add Email Template
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
                                    <table class="table user-list table-hover">
                                        <thead>
                                            <tr>
                                                <th><span>Id</span></th>
                                                <th><span>Email Title</span></th>
                                                <th><span>Email subject</span></th>															
                                                <th>&nbsp;</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($canned_messages as $canned_message): ?>
                                                <tr>
                                                    <td>
                                                        <?= $canned_message['tplid'] ?>
                                                    </td>
                                                    <td>
                                                        <?= $canned_message['tplshortname'] ?>
                                                    </td>
                                                    <td>
                                                        <?= $canned_message['tplsubject']; ?> 

                                                    </td>															
                                                    <td style="width: 20%;">																
                                                        <a href="<?php echo base_url($this->config->item('admin_folder').'/settings/canned_message_form/' . $canned_message['tplid']); ?>" class="table-link">
                                                            <span class="fa-stack">
                                                                <i class="fa fa-square fa-stack-2x"></i>
                                                                <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
                                                            </span>
                                                        </a>
                                                        <a href="<?php echo base_url($this->config->item('admin_folder').'/settings/delete_message/' . $canned_message['tplid']); ?>" onclick="return areyousure();" class="table-link danger">
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


    <?php include('footer.php'); ?>

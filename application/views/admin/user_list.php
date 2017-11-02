<?php include('header.php'); ?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css"/>	

<?php echo admin_js('jquery.dataTables.js', true); ?>
<?php echo admin_js('dataTables.fixedHeader.js', true); ?>
<?php echo admin_js('dataTables.tableTools.js', true); ?>
<?php echo admin_js('jquery.dataTables.bootstrap.js', true); ?>
<div id="content-wrapper">
    <div class="container">
        <div class="table-responsive">
            <h1>User List</h1>
            <div class="">
                <table id="user_list" class="display" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Zipcode</th>
			    <th>Provider</th>
                        </tr>
                    </thead>        
                </table>
            </div>
        </div>
    </div>	 

    <script type="text/javascript">
        $(document).ready(function () {
            $('#user_list').DataTable({
                "bProcessing": true,
                "serverSide": true,
                "ajax": {
                    url: "<?php echo base_url(); ?>admin/user/user_list_response", // json datasource
                    type: "post", // type of method  ,GET/POST/DELETE			
                    error: function () {
                        $("#employee_grid_processing").css("display", "none");
                    },
                    "dataSrc": function (json) {
                        //alert(json.nivas);
                        return json.data;
                    }

                }

            });

        });
    </script>	 

    <?php include('footer.php'); ?>

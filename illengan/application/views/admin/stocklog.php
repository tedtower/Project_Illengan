<!doctype html>
<html lang="en">

<head>
    <?php include_once('templates/head.php') ?>
</head>

<body>
    <?php include_once('templates/sideNav.php') ?>
    
    <div class="content">
        <div class="container-fluid">
        
            <div class="table-cover">
            <table class="dataTable stripe table display" id="mydata">
                <thead>
                    <tr> 
                        <th>Date Recorded</th>
                        <th>Stock Item</th>
                        <th>Stock Unit</th>
                        <th>Qty</th>
                        <th>Log Type</th>
                    </tr>
                </thead>
                <tbody id="show_data">
                    
                </tbody>
            </table>
            </div>
            </div>
            </div>

            <?php include_once('stock_modal.php') ?>

</body>

<script src="<?php echo base_url().'assets/js/chef/jquery-3.2.1.js'?>"></script>
<script src="<?php echo base_url().'assets/js/chef/bootstrap.js'?>"></script>
<script src="<?php echo base_url().'assets/js/chef/jquery.dataTables.js'?>"></script>
<script src="<?php echo base_url().'assets/js/chef/dataTables.bootstrap4.js'?>"></script>
<script src="<?php echo framework_url().'bootstrap-native/bootstrap.js'?>"></script>
<script src="<?php echo base_url().'assets/js/chef/dataTables.buttons.js'?>"></script>
<script src="<?php echo base_url().'assets/js/admin/stocklog.js'?>"></script>
</html>
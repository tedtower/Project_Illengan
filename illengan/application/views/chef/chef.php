<!DOCTYPE html>
<html>
<head>
<?php include_once('head.php') ?>
</head>
<body>
<?php include_once('navigation.php') ?>
<div class="container content">
	<!-- Page Heading -->
    <div class="row">
        <div class="col-12">
    
            <table class="dataTable  dtr-inline collapsed table stripe table display" id="mydata">
                <thead>
                    <tr> 
                        <th></th>
                        <th>Menu Name</th>
                        <th>Customer Name</th>
                        <th>Table No.</th>
                        <th>Order Qty</th>
                        <th style="text-align: right;">Actions</th>
                    </tr>
                </thead>
                <tbody id="show_data">
                    
                </tbody>
            </table>
        </div>
    </div>
        
</div>

<?php include_once('scripts.php') ?>

</body>
</html>
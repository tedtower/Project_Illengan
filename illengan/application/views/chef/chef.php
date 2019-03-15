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
    
            <table class="table table-striped" id="mydata">
                <thead>
                    <tr> 
                        <th>Order Id</th>
                        <th>Customer Name</th>
                        <th>Table No.</th>
                        <th>Menu Name</th>
                        <th>Order Qty</th>
                        <th>Item Status</th>
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

<script type="text/javascript">
let UPDATE = 5000;
var table = $('#mydata');

setInterval(function() {
    table.DataTable().ajax.reload(null, false);
    console.log('reload');
    orders();
}, 1000);

function orders() {
$(document).ready(function() {

    $.ajax({
        url: 'http://www.illengan.com/chef/product_data'
            }); 
 
});
 }

$(document).ready(function() {
	  table.DataTable( {
             ajax: {
                 url: "http://www.illengan.com/orders.json",
                 dataSrc: ''
             },
		    colReorder: {
			realtime: true
		    },
            "aoColumns" : [
                {data : 'order_id'},
                {data : 'cust_name'},
                {data : 'table_code'},
                {data : 'menu_name'},
                {data : 'order_qty'},
                {data : 'item_status'}
		    ]
	        } );
          

} );

</script>
</body>
</html>
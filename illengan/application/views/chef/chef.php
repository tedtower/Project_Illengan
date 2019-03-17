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

function orders() {
$(document).ready(function() {
    $.ajax({
        type: 'POST',
        url: 'http://www.illengan.com/chef/get_orderlist'
            }); 
 
});
 }

$(document).ready(function() {
	  table.DataTable( {
             ajax: {
                 url: "http://www.illengan.com/chef/get_orderlist",
                 dataSrc: '',
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
                {
                    data: null,
                    render: function ( data, type, row, meta) {
                        return '<button id="status" class="status btn '+ data.item_status +
                        '" data-order_item_id="'+ data.order_item_id +'"'+
                        ' data-item_status="'+ data.item_status +'" onclick="change_status()">'+ data.item_status +'</button>';
                        
      }
    }
		    ]
	        } );

} );

function change_status() {
    $('.status').on('click', function() {
        var orderItemId = $(this).data("order_item_id");
        var itemStatus = $(this).data("item_status");

        if(itemStatus === "pending") {
            item_status = "ongoing";
        } else if(itemStatus === "ongoing") {
            item_status = "done";
        } else if(itemStatus === "done") {
            item_status = "pending";
        }
    
        // AJAX CODE FOR POSTING NEW STATUS
        $.ajax({
        type: 'POST',
        url: 'http://www.illengan.com/chef/change_status',
        data: {
            order_item_id: orderItemId,
            item_status: item_status
        },
        success: function() {
            table.DataTable().ajax.reload(null, false);
        }
            }); 
 
        });
}

setInterval(function() {
        table.DataTable().ajax.reload(null, false);
        console.log('reload');
        orders();
    }, 5000);

</script>
</body>
</html>
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
        type: 'POST',
        url: 'http://www.illengan.com/chef/get_orderlist'
            }); 
 
});
 }

$(document).ready(function() {
    $.ajax({
        type: 'POST',
        url: 'http://www.illengan.com/chef/get_orderlist',
        data: {
            order_id: order_id
        },
        success: function() {
           alert(order_id);
        }
            }); 
 
});

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
                {data : 'item_status'},
                {
                    data: null,
                    render: function ( data, type, row ) {
                        return '<button type="button" class="btn btn-primary"' + 
                        'data-toggle="modal" data-target="#exampleModal"></button>';
      }
    }
		    ]
	        } );

} );

function change_status() {
    
}

</script>
</body>
</html>
success : function(data){
                    var html = '';
                    var i;
                    for(i=0; i<data.length; i++){
                        html += '<tr>'+
                                '<td>'+data[i].order_id+'</td>'+
                                '<td>'+data[i].cust_name+'</td>'+
                                '<td>'+data[i].table_code+'</td>'+
                                '<td>'+data[i].menu_name+'</td>'+
                                '<td>'+data[i].order_qty+'</td>'+
                                '<td>'+data[i].item_status+'</td>'+
                                
                                '</tr>';
                    }
                    $('#mydata').html(html);
                }
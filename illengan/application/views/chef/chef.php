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

 function format ( d ) {
    // `d` is the original data object for the row
    return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
        '<tr>'+
            '<td>Add Ons</td>'+
            '<td>Remarks</td>'+
        '</tr>'+
        '<tr>'+
            '<td>---</td>'+
            '<td>'+d.remarks+'</td>'+
        '</tr>'+
    '</table>';
}

$(document).ready(function() {
    var table = $('#mydata').DataTable( {
             ajax: {
                 url: "http://www.illengan.com/chef/get_orderlist",
                 dataSrc: ''
             },
		    colReorder: {
			realtime: true
		    },
            "aoColumns" : [
                {
                "className":      'details-control',
                "data":           null,
                "defaultContent": ''
                },
                {data : 'menu_name'},
                {data : 'cust_name'},
                {data : 'table_code'},
                {data : 'order_qty'},
                {
                    data: null,
                    render: function ( data, type, row, meta) {
                        return '<button id="status" class="status btn dt-buttons '+ data.item_status +
                        '" data-order_item_id="'+ data.order_item_id +'"'+
                        ' data-item_status="'+ data.item_status +'" onclick="change_status()">'+ data.item_status +'</button>';
                        }
                    }
		        ]
	        });

// FOR SHOWING THE ACCORDION
        $('#mydata tbody').on('click', 'td.details-control', function () {
                var tr = $(this).closest('tr');
                var row = table.row(tr);
        
                if ( row.child.isShown() ) {
                    // This row is already open - close it
                    row.child.hide();
                    tr.removeClass('shown');
                }
                else {
                    // Open this row
                    row.child( format(row.data()) ).show();
                    tr.addClass('shown');
                }
            } );
        
        $("#mydata").DataTable().rows().every( function () {
                var tr = $(this.node());
                var row = table.row(tr);

                row.child(format(row.data())).show();
                tr.addClass('shown');
            });

            
} );

function change_status() {
    $('.status').on('click', function() {
        var orderItemId = $(this).data("order_item_id");
        var itemStatus = $(this).data("item_status");
        var item_status;

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

</script>
</body>
</html>
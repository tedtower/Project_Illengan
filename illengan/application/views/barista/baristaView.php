<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Barista</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/barista/bootstrap.css'?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/barista/jquery.dataTables.css'?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/barista/dataTables.bootstrap4.css'?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/barista/style.css'?>">
</head>
<body>
<?php include_once('navigation.php') ?>

<div class="container content">
	<!-- Page Heading -->
    <div class="row">
        <div class="col-12">
        <form action="barista/getDate" method="get">
         <label>Date <input type="" value="<?php echo date('Y-M-d'); ?>"/></label>
        </form>
            
            <table class="table table-striped" id="mydata">
                <thead>
                    <tr>
                        <th>Order Id</th>
                        <th>Customer Name</th>
                        <th>Table</th>
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

<!-- MODAL EDIT -->
<form>
            <div class="modal fade" id="Modal_Edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Table Code</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Order Id</label>
                            <div class="col-md-10">
                              <input type="text" name="order_id_edit" id="order_id_edit" class="form-control" placeholder="Order Id" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">New Table Code</label>
                            <div class="col-md-10">
                              <input type="text" name="table_code_edit" id="table_code_edit" class="form-control" placeholder="New Table Code">
                            </div>
                        </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" type="submit" id="btn_update" class="btn btn-primary">Update</button>
                  </div>
                </div>
              </div>
            </div>
            </form>
        <!--END MODAL EDIT-->

        

<script type="text/javascript" src="<?php echo base_url().'assets/js/barista/jquery-3.2.1.js'?>"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/js/barista/bootstrap.js'?>"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/js/barista/jquery.dataTables.js'?>"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/js/barista/dataTables.bootstrap4.js'?>"></script>

<script type="text/javascript">
var table = $('#mydata');
$(document).ready(function() {
	  table.DataTable( {
             ajax: {
                 url: "http://www.illengan.com/barista/orders_b",
                 dataSrc: ''
             },
		    colReorder: {
			realtime: true
		    },
            "aoColumns" : [
                {data : 'order_id'},
                {data : 'cust_name'},
                {
                  data: null,
                    render: function ( data, type, row, meta) {
                        return data.table_code+
                            '<a href="javascript:void(0);" class="btn btn-info btn-sm item_edit" data-order_id="'
                            +data.order_id+'" data-table_code="'+data.table_code+'">Edit</a>'
                    }        
                },

                {data : 'menu_name'},
                {data : 'order_qty'},
                {
                    data: null,
                    render: function ( data, type, row, meta) {
                        return '<button class="btn '+ data.order_id +'" data-order_id="'+ data.order_id +'">'+ data +'</button>';
                    }
                },
      
                {data: null,
                    render: function ( data, type, row, meta) {
                        return data.order_id+
                        '<div class="row"><a href="javascript:void(0);" class="btn btn-success col-xs-6 btn-sm item_done" data-order_id="'+data.order_id+'">Done</a>'+' '+
                        '<a href="javascript:void(0);" class="btn btn-danger col-xs-6 btn-sm item_delete" data-order_id="'+data.order_id+'">Remove</a>'
                         '<a href="javascript:void(0);" class="btn btn-warning col-xs-6 btn-sm item_cancel" data-order_id="'+data.order_id+'">Cancel</a></div>';       
                    }        
                }

		    ]
	        } );

} );

//start of new function
$('#show_data').on('click','.item_edit',function(){
            var order_id = $(this).data('order_id');
            var table_code        = $(this).data('table_code');
            
            $('#Modal_Edit').modal('show');
            $('[name="order_id_edit"]').val(order_id);
            $('[name="table_code_edit"]').val(table_code);
        });

        //update record to database
         $('#btn_update').on('click',function(){
            var order_id = $('#order_id_edit').val();
            var table_code = $('#table_code_edit').val();
            $.ajax({
                type : "POST",
                url  : "<?php echo site_url('barista/editTableNumber')?>",
                dataType : "JSON",
                data : {order_id:order_id , table_code:table_code},
                success: function(data){
                    $('[name="order_id_edit"]').val("");
                    $('[name="table_code_edit"]').val("");
                    $('#Modal_Edit').modal('hide');
                    view_product();
                }
            });
            return false;
        });


</script>

</body>
</html>

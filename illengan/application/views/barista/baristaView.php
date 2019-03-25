<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport'>
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Il-Lengan | Barista Orders</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/barista/bootstrap.css'?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/barista/jquery.dataTables.css'?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/barista/dataTables.bootstrap4.css'?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/barista/style.css'?>">
</head>
<body>
  <?php echo include_once('sideNavigation.php') ?>
  
  <div class="wrapper">
        <div class="sidebar" data-color="brown" data-image="assets/media/barista/Coffee_1.jpg">
            <!--Left Navigation Bar-->
            <div class="sidebar-wrapper" style="overflow: hidden">
                <div class="logo">
                    <img src="assets/media/barista/logo_lg.png" alt="il-lengan-logo" img-align="center" width="225px"
                        height="135px">
                </div>

                <ul class="nav">
                    <li class="active">
                        <a href="baristaOrders.html">
                            <p>Orders</p>
                        </a>
                    </li>
                    <li>
                        <a href="baristaBillings.html">
                            <p>Billings</p>
                            </a>
                    </li>
                    <li>
                        <a href="baristaInventory.html">
                            <p>Inventory</p>
                        </a>
                    </li>
                    <li>
                        <a href="baristaNotifications.html">
                            <p>Notifications</p>
                        </a>
                    </li>
                    </ul>
                </div>
            </div>
            
            <table class="display" id="mydata" >
                <thead>
                    <tr>
                        <th>Slip No.</th>
                        <th>Order Item No.</th>
                        <th>Customer Name</th>
                        <th>Table</th>
                        <th>Order</th>
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

        <!--MODAL DELETE-->
        <form>
            <div class="modal fade" id="Modal_Remove" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cancel Order</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                       <strong>Are you sure to remove this record?</strong>
                  </div>
                  <div class="modal-footer">
                    <input type="hidden" name="order_item_id_remove" id="order_item_id_remove" class="form-control">
                    <button type="button" type="submit" id="btn_cancel" class="btn btn-primary">Yes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                  </div>
                </div>
              </div>
            </div>
            </form>
        <!--END MODAL DELETE-->

        

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
                {data : 'order_item_id'},
                {data : 'cust_name'},
                {
                  data: null,
                    render: function ( data, type, row, meta) {
                        return data.table_code+
                            '<a href="javascript:void(0);" class="btn btn-info btn-sm item_edit" data-order_id="'+data.order_id+'" data-table_code="'+data.table_code+'">Edit</a>';
                    }        
                },

                {data : 'order_desc'},
                {data : 'order_qty'},
                {data : 'item_status'},
                /*{
                    data: null,
                    render: function ( data, type, row, meta) {
                        return '<button class="btn '+ data.order_id +'" data-order_id="'+ data.order_id +'">'+ data +'</button>';
                    }
                },*/
      
                {data: null,
                    render: function ( data, type, row, meta) {
                        return '<a href="javascript:void(0);" class="btn btn-warning btn-sm item_delete" data-order_id="'+data.order_id+'">Cancel</a>';
                               
                    }        
                }

		    ]
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
                url  : "http://illengan.com/barista/editTableNumber",
                dataType : "JSON",
                data : {order_id:order_id , table_code:table_code},
                success: function(data){
                    $('[name="order_id_edit"]').val("");
                    $('[name="table_code_edit"]').val("");
                    $('#Modal_Edit').modal('hide');
                    alert("Table Code was successfully updated!");
                    location.reload();
                    //view_product();
                }
            });
            return false;
        });

        //get data for delete record
        $('#show_data').on('click','.item_delete',function(){
            var order_item_id = $(this).data('order_item_id');
            
            $('#Modal_Remove').modal('show');
            $('[name="order_item_id_remove"]').val(order_item_id);
        });

        //delete record to database
         $('#btn_cancel').on('click',function(){
            var order_item_id = $('#order_item_id_remove').val();
            $.ajax({
                type : "POST",
                url  : "<?php echo site_url('barista/cancel')?>",
                dataType : "JSON",
                data : {order_item_id:order_item_id},
                success: function(data){
                    $('[name="order_item_id_remove"]').val("");
                    alert("Record removed successfully!");
                    $('#Modal_Remove').modal('hide');
                    
                    location.reload();
                }
            });
            return false;
        });
      } );
//change status function


</script>

</body>
</html>

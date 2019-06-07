<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport'>
        <meta name="viewport" content="width=device-width">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title>Il-Lengan | Barista Orders</title>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/barista/bootstrap.css'?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/barista/responsive.bootstrap.css'?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/barista/select.bootstrap.css'?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/barista/buttons.bootstrap.css'?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/barista/style.css'?>">
    </head>
    <body>
    <?php  if(isset($slip)){
                          foreach($slip as $slips): 
                            
                            ?> 
    <div class="container">
    <div class="row" style="overflow-x: auto;">
    <div class="card" style="display: inline-block;">
        <div class="card border-info">
            <div class="card-header">
                <!-- <form name="slip_data" action="form/get_slipData" method="post">
                    <label>Slip No : </label>
                    <input style="width: 50px; border: none; background: transparent;" type="text" name="osID" id="osID" value="">&nbsp;
                    <label>Table No : </label>
                    <input style="width: 50px; border: none; background: transparent" type="text" name="tableCode" id="tableCode" value=""><br>
                    <label>Name : </label>
                    <input style="border: none; background: transparent" type="text" name="custName" id="custName" value="">&nbsp; 
                    <label>Status : </label>
                    <input style="border: none; background: transparent" type="text" name="payStatus" id="payStatus" value="">
                </form> --> 
                <table class="table table-borderless table-sm">
                    <tr>
                        <td>Slip No:<?php echo $slips['osID'] ?></td>
                        <td>Table: <?php echo $slips['tableCode'] ?> </td>

                    </tr>
                    <tr>
                        <td>Name: <?php echo $slips['custName'] ?></td>
                        <td>Status: <?php echo $slips['payStatus'] ?></td>
                    </tr>
                </table>
            </div>
            <div class="card-body" style="width: auto; height: auto;">
                <br>
                <button class="btn btn-link btn-sm" onClick="window.location.href = '<?php echo base_url();?>customer/processCheckIn';return false;">Add Order</button>
                <br>
                <table class="pendOrders dtr-inline collapsed table display table-sm" id="pendingordersTable" style="width: auto; height: auto;">
                  <thead>
                      <tr>
                          <!-- <th>Slip No.</th>
                          <th>Order Item No.</th> 
                         <th>Customer Name</th> -->
                          <th>Order Id</th>
                          <th>Qty</th>
                          <th>Order</th>
                          <th>Subtotal</th>
                          <th>Item Status</th>
                          <th style="text-align: right;">Actions</th>
                      </tr>
                  </thead>
                  <tbody>
                  </tbody>
            </table>
            <br>
                <label>Total: <input type="text" style="border: 2px solid black; align: right" name="total_amount" id="total_amount" readonly></label>
            <div class="card-footer">
                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#ModalBill" id="bill_modal">Remove Slip</button>
            </div>
            </div> 
        </div>
     </div>
     </div>
    </div>
    <br>
    <?php 
      endforeach;

}            
?>

           <!--MODAL DELETE-->

           <div class="modal fade" id="deleteOrder" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cancel Order</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="confirmDelete">
                    <div class="modal-body">
                    <strong>Are you sure to remove this record?</strong>
                    <input type="hidden" name="olID" id="olID" class="form-control">
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </div>
                </form>
                </div>
            </div>
        </div>

    <script type="text/javascript" src="<?php echo base_url().'assets/js/barista/jquery-3.2.1.js'?>"></script>
    <script type="text/javascript" src="<?php echo base_url().'assets/js/barista/bootstrap.js'?>"></script>
    <script type="text/javascript" src="<?php echo base_url().'assets/js/barista/jquery.dataTables.js'?>"></script>
    <script type="text/javascript" src="<?php echo base_url().'assets/js/barista/tables.js'?>"></script>

    </body>

                                                <!--Transaction Items-->
                                                <a class="btn btn-primary btn-sm" data-original-title style="margin:0;color:white;font-weight:600;background:#0073e6">Add Items</a>
                                                <!--Transaction PO Items-->
                                                <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#brochure" style="color:white;font-weight:600;background:#0073e6">Add PO Items</a>
                                                <br><br>

               
                                                <!--div containing the different input fields in adding trans items -->
                                                <div class="container mb-3 inputGroup1" style="overflow:auto;width:100%">
                                                    <div style="float:left;width:95%;overflow:auto;">
                                                    
                                                        <div class="input-group mb-1">
                                                            <input type="text" name="itemName[]" class="form-control form-control-sm" placeholder="Item Name" style="width:24%">
                                                            <input type="text" class="form-control border-right-0" placeholder="Stock" style="width:15%">
                                                            <div class="input-group-append" style="border-top:1px solid #b3b3b3 !important;border-bottom:1px solid #b3b3b3 !important">
                                                                <button class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#stock" type="button" >Button</button>
                                                            </div>
                                                            <input type="number" name="itemQty[]" class="form-control form-control-sm" placeholder="Quantity" >
                                                            <input type="number" name="actualQty[]"class="form-control form-control-sm" placeholder="Actual Qty">
                                                            
                                                        </div>
                                                        <div class="input-group">
                                                            <select name="itemUnit[]" class="form-control form-control-sm">
                                                                <option value="" selected="selected">Unit</option>
                                                            </select>
                                                            <select name="actualUnit[]" class="form-control form-control-sm">
                                                                <option value="" selected="selected">Actual Unit</option>
                                                            </select>
                                                            <input type="number" name="itemPrice[]" class="form-control form-control-sm " placeholder="Price">
                                                            <input type="number" name="itemSubtotal[]" class="form-control form-control-sm " placeholder="Subtotal">
                                                            <select  name="itemStatus[]"class="form-control form-control-sm ">
                                                                <option value="" selected>Choose Status</option>
                                                            </select>
                                                        </div>
                                                    </div>

            }
            function viewOrderslipsJs() {
                  $.ajax({
                      url: "<?= site_url('barista/orderData') ?>",
                      method: "post",
                      dataType: "json",
                      success: function(data) {
                          penOrders = data;
                          setPenOrdersData(penOrders);
                      },
                      error: function(response, setting, errorThrown) {
                          console.log(response.responseText);
                          console.log(errorThrown);
                      }
                  });
            }
            function setPenOrdersData() {
                  if ($("#pendingordersTable> tbody").children().length > 0) {
                      $("#pendingordersTable> tbody").empty();
                  }
                  penOrders.forEach(table => {
                      $("#pendingordersTable> tbody").append(`
                      <tr data-olID="${table.olID}" >
                          <td>${table.olID}</td>
                          <td>${table.olQty}</td>
                          <td>${table.olDesc}</td>
                          <td>${table.olSubtotal}</td>
                          <td><button id="status" class="status btn dt-buttons"></button></td>
                          <td>
                                  <!--Action Buttons-->
                                  <div class="onoffswitch">
                                      <!--Delete button-->
                                      <button class="item_delete btn btn-danger btn-sm" data-toggle="modal" 
                                      data-target="#deleteOrder">Cancel</button>                      
                                  </div>
                              </td>
                          </tr>
                          <tr>$nbsp;$nbsp;$nbsp;
                            <td></td>
                            <td>${table.aoName}</td>
                            <td>${table.aoPrice}</td>
                            <td>${table.olRemarks}</td>
                            </tr>`);
                      $(".item_delete").last().on('click', function () {
                          $("#deleteOrder").find("input[name='olID']").val($(this).closest("tr").attr(
                                    "data-olID"));
                      });

                      //change status function
                                //function change_status() {
                                    $('.status').on('click', function() {
                                    var orderItemId = $(this).data('olID');
                                    var itemStatus = $(this).data('olStatus');
                                    var item_status;

                                    if (itemStatus === "pending") {
                                    item_status = "served";
                                    } else if (itemStatus === "served") {
                                    item_status = "pending";
                                    }

                                    $.ajax({
                                    type: 'POST',
                                    url: 'http://www.illengan.com/barista/change_status',
                                    data: {
                                        olID: orderItemId,
                                        olStatus: item_status
                                    },
                                    success: function() {
                                       // table.DataTable().ajax.reload(null, false);
                                    }
                                    });

                                });
              //  }
                  });
            }

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
                                                <button class="btn btn-success btn-sm" type="submit">Ok</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!--End of Brochure Modal"-->
                            <!--Start of Modal "Delete Stock Item"-->
                            <div class="modal fade" id="delete" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Delete
                                                Purchases/Deliveries
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form id="confirmDelete">
                                            <div class="modal-body">
                                                <h6 id="deleteTableCode"></h6>
                                                <p>Are you sure you want to delete this item?</p>
                                                <input type="text" name="" hidden="hidden">
                                                <div>
                                                    Remarks:<input type="text" name="deleteRemarks" id="deleteRemarks"
                                                        class="form-control form-control-sm">
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary btn-sm"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!--End of Modal "Delete Stock Item"-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?php include_once('templates/scripts.php') ?>
</body>
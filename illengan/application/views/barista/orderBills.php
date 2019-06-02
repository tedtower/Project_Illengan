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
    <title>Il-Lengan | Barista Billings</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/barista/bootstrap.css'?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/barista/jquery.dataTables.css'?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/barista/dataTables.bootstrap4.css'?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/barista/responsive.bootstrap.css'?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/barista/select.bootstrap.css'?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/barista/buttons.bootstrap.css'?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/barista/style.css'?>">
</head>
<body>
<body>
  <br>
  <div class="container">
    <p>*Click Table Rows for Payment*</p>
  <br>
            <table class="bills dtr-inline collapsed table display" id="ordersTable" >
                <thead>
                    <tr>
                        <!-- <th></th> -->
                        <th>Slip No.</th>
                        <th>Customer</th>
                        <th>Table Code</th>
                        <th>Total Payable</th>
                        <th>Order Date</th>
                        <th>Status</th>
                        <th>Date Paid</th>
                        <th style="text-align: left;">Actions</th>
                    </tr>
                </thead>
                <tbody id="orderslipData">
                <?php  if(isset($bills)){
                          foreach($bills as $bill) 
                          {  
                            ?> 
                               <tr data-toggle="modal" data-target="#Modal_Pay" id="open_modal" style="cursor:pointer">  
                                    <td class="clickable"><?= $bill["osID"]?></td>  
                                    <td class="clickable"><?= $bill["custName"]?></td>  
                                    <td class="clickable"><?= $bill["tableCode"]?></td>  
                                    <td class="clickable"><?= $bill["osTotal"]?></td>  
                                    <td class="clickable"><?= $bill["osDateTime"]?></td>  
                                    <td class="clickable" id="payStatus"><?= $bill["payStatus"]?></td>  
                                    <td class="clickable"><?= $bill["osPayDateTime"]?></td>  
                                    <td class="except"><button id="remove_modal" class="btn btn-warning btn-sm">Remove</button></td>  
                               </tr>    
                         
                          <?php } 
                        } ?> 
                </tbody>
            </table>
    </div>

     <!--MODAL FOR BILL COMPUTATION-->
        <form action="" method="">
            <div class="modal fade" id="Modal_Pay" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Payment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                        <!-- <div class="form-group row">
                            <label class="col-md-2 col-form-label">Slip No.</label>
                            <div class="col-md-10">
                              <input type="text" name="slipId" id="slipId" class="form-control" value="<//?php echo $bill['osID'] ?>" readonly>
                            </div>
                        </div> -->
                        <div class="form-group row">
                            <label class="col-md-10 col-form-label">Amount Payable: </label>
                            <div class="col-md-10">
                              <input type="text"  class="form-control" name="amount_payable" id="amount_payable" value="<?= $bill['osTotal'] ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-5 col-form-label">Cash:</label>
                            <div class="col-md-10">
                              <input type="text" class="form-control" name="cash" id="cash" value="0.00" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-5 col-form-label">Change:</label>
                            <div class="col-md-10">
                              <input type="text" class="form-control" name="change" id="change" value="0.00" readonly>
                            </div>
                        </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-sm" id="update-pay-status-btn" data-orderid="">Submit</button>
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
        </form>
        
        <!--END FOR MODAL COMPUTATION-->
       

            <!--MODAL DELETE-->
            <form>
            <div class="modal fade" id="Modal_Remove" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Remove Order</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                       <strong>Remove order slip?</strong>
                  </div>
                  <div class="modal-footer">
                    <input type="hidden" name="order_id_remove" id="order_id_remove" class="form-control">
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

    <script>
        $(document).ready(function(){
          var bills = {};
        //   $("#open_modal").click(function(){
        //     $("#Modal_Pay").modal();
        //   });

        $('#except').on('click','td',function(e){
          if ($(e.target).hasClass('except')){
            e.stopPropagation();
            } 
      });
        
        //   $('tr').click(function(event){
        //     console.log($(event.target).hasClass("except"));
        //     event.preventDefault();
        // });
          

        $('#remove_modal').on('click', function(){
            var osID = $(this).data('osID');
            
            
            $('#Modal_Remove').modal('show');
            $('[name="osID_remove"]').val(osID);
        });

        //delete record to database
         $('#btn_cancel').on('click',function(){
            var osID = $('#osID_remove').val();
            $.ajax({
                type : "POST",
                url  : "<?php echo site_url('barista/cancel')?>",
                dataType : "JSON",
                data : {osID:osID},
                success: function(data){
                    $('[name="osID_remove"]').val("");
                    alert("Record removed successfully!");
                    $('#Modal_Remove').modal('hide');
                    
                    table.DataTable(). ajax.reload(null, false);
                }
            });
            return false;
        });

//---------MAY AAYUSIN DITO---------------------------------------------------------
      $("#orderslipData> tbody").on("click", function() {
        var osId       = $(this).data('osID');
        var osTotal       = $(this).data('osTotal');
              $('#billModal').modal('show');
              $('[name="slipId"]').val(osID);
              $('[name="amount_payable"]').val(osTotal);

              $.ajax({
                method: "post",
                data : {
                  osID : osId,
                  osTotal : osTotal
                }

              });

      });


          //     console.log(orderId);
          //     if (bills[orderId] === undefined) {
          //         $.ajax({
          //             method: "post",
          //             url: "<//?php echo site_url('barista/orderBillsJS')?>",
          //             data: {
          //                 osID: orderId,
          //             },
          //             dataType: "json",
          //             success: function(bill) {
          //                 bills[orderId] = bill;            
          //                 setModalData(orderId);
          //             }
          //         });
          //     }else{            
          //         setModalData(orderId);
          //     }
         

          $("#cash").on('change', function() {
              if (isNaN(parseFloat($(this).val()))) {
                  $(this).val('0.00');
                  $("#change").val('0.00');
              } else {
                  $(this).val(parseInt($(this).val()).toFixed(2));
                  $("#change").val((parseFloat($(this).val()) - parseFloat($("#amount_payable").text())).toFixed(2));
              }
          });

        $("#update-pay-status-btn").on('click', function(event){
            var status;
            if($(this).attr("data-paystatus") === "Paid"){
                status = "p";
            }else{
                status = "u";
            }
            if(parseFloat($("#cash").val()) < parseFloat($("#amount_payable").text()) && status === "u"){
                alert("Customer Payment is insufficient!");
            }else{
                var orderId = $(this).attr("data-orderid");
                $.ajax({
                    method: "post",
                    url: "billings/setStatus",
                    data: {
                        osID: orderId,
                        payStatus: status
                    }, 
                    dataType: "json",
                    success: function(bill){
                        console.log(bill);
                    }
                });
            }       
        });
      });

    </script>
</body>
</html>
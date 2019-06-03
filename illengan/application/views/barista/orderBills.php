<!DOCTYPE html>
<html>

<head>
  <?php include_once('templates/head.php') ?>
</head>

<body>
  <?php include_once('templates/navigation.php') ?>
  <!--End Top Nav-->
  <div class="content">
    <div class="container-fluid">
      <br>
      <p style="text-align:right; font-weight: regular; font-size: 16px">
        <!-- Real Time Date & Time -->
        <?php echo date("M j, Y -l"); ?>
      </p>
      <div class="content" style="margin-left:auto;">
        <div class="conteiner-fluid">
          <!--Start Table-->
          <div class="card-content">
            <table id="ordersTable" class="table table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th><b class="pull-left">Slip No.</b></th>
                  <th><b class="pull-left">Customer</b></th>
                  <th><b class="pull-left">Table Code</b></th>
                  <th><b class="pull-left">Total Payable</b></th>
                  <th><b class="pull-left">Order Date</b></th>
                  <th><b class="pull-left">Status</b></th>
                  <th><b class="pull-left">Status Paid</b></th>
                  <th><b class="pull-left">Actions</b></th>
                </tr>
              </thead>
              <!--Start Table Body-->
              <tbody id="orderslipData">
                <?php if (isset($bills)) {
                  foreach ($bills as $bill) {
                    ?>
                    <tr>
                      <td><?= $bill["osID"] ?></td>
                      <td><?= $bill["custName"] ?></td>
                      <td><?= $bill["tableCode"] ?></td>
                      <td><?= $bill["osTotal"] ?></td>
                      <td><?= $bill["osDateTime"] ?></td>
                      <td id="payStatus"><?= $bill["payStatus"] ?></td>
                      <td><?= $bill["osPayDateTime"] ?></td>
                      <td>
                        <button class="editBtn btn btn-sm btn-info" data-toggle="modal" data-target="#Modal_Pay">Pay</button>
                        <button class="deleteBtn btn btn-sm btn-danger" data-toggle="modal" data-target="#Modal_Remove">Archived</button>
                      </td>
                    </tr>

                  <?php }
              } ?>
              </tbody>
            </table>
          </div>
          <!--End Table-->
        </div>
      </div>
    </div>
  </div>

  <!--Start MODAL for BILL COMPUTATION-->
  
  <div class="modal fade bd-example-sm" id="Modal_Pay" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="overflow: auto !important;">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
          <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Payment</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <!--Modal Content-->
            <form id="formAdd" action="<?= site_url('barista/billings/add')?>" method="POST" accept-charset="utf-8">
              <div class="modal-body">
              <!--Amount Payable-->
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-sm" style="width:140px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                      Amount Payable:</span>
                  </div>
                    <input type="text" class="form-control" name="amount_payable" id="amount_payable" value="<?= $bill['osTotal'] ?>" readonly>
                      <span class="text-danger"><?php echo form_error("amount_payable"); ?></span>
                </div>
                <!--Cash-->
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-sm" style="width:140px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                      Cash:</span>
                  </div>
                    <input type="text" class="form-control" name="cash" id="cash" value="0.00" required>
                      <span class="text-danger"><?php echo form_error("cash"); ?></span>
                </div>
                <!--Change-->
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-sm" style="width:140px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                      Change:</span>
                  </div>
                  <input type="text" class="form-control" name="change" id="change" value="0.00" readonly>
                      <span class="text-danger"><?php echo form_error("change"); ?></span>
                </div>
        
          <!--Footer-->
          <div class="modal-footer">
          <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
          <button class="btn btn-success btn-sm" type="submit">Done</button>
          </div>
              </div>
            </form>
      </div>
    </div>
  </div>
  
    
  
  <!--End MODAL for BILL COMPUTATION-->

  <!--Start MODAL for DELETE-->
  <div class="modal fade" id="Modal_Remove" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Remove Order</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="confirmDelete">
          <div class="modal-body">
            <h6 id="deleteTableCode"></h6>
            <p style="text-align:center;">Are you sure to remove the selected orderslip?</p>
            <input type="text" name="" hidden="hidden">
            <div>
              Remarks:<input type="text" name="deleteRemarks" id="deleteRemarks" class="form-control form-control-sm">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">No</button>
            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!--End MODAL for DELETE-->

  <?php include_once('templates/scripts.php') ?>

  <script>
    $(document).ready(function() {
      var bills = {};
      //   $("#open_modal").click(function(){
      //     $("#Modal_Pay").modal();
      //   });

      $('#except').on('click', 'td', function(e) {
        if ($(e.target).hasClass('except')) {
          e.stopPropagation();
        }
      });

      //   $('tr').click(function(event){
      //     console.log($(event.target).hasClass("except"));
      //     event.preventDefault();
      // });


      $('#remove_modal').on('click', function() {
        var osID = $(this).data('osID');


        $('#Modal_Remove').modal('show');
        $('[name="osID_remove"]').val(osID);
      });

      //delete record to database
      $('#btn_cancel').on('click', function() {
        var osID = $('#osID_remove').val();
        $.ajax({
          type: "POST",
          url: "<?php echo site_url('barista/cancel') ?>",
          dataType: "JSON",
          data: {
            osID: osID
          },
          success: function(data) {
            $('[name="osID_remove"]').val("");
            alert("Record removed successfully!");
            $('#Modal_Remove').modal('hide');

            table.DataTable().ajax.reload(null, false);
          }
        });
        return false;
      });

      //---------MAY AAYUSIN DITO---------------------------------------------------------
      $("#orderslipData> tbody").on("click", function() {
        var osId = $(this).data('osID');
        var osTotal = $(this).data('osTotal');
        $('#billModal').modal('show');
        $('[name="slipId"]').val(osID);
        $('[name="amount_payable"]').val(osTotal);

        $.ajax({
          method: "post",
          data: {
            osID: osId,
            osTotal: osTotal
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

      $("#update-pay-status-btn").on('click', function(event) {
        var status;
        if ($(this).attr("data-paystatus") === "Paid") {
          status = "p";
        } else {
          status = "u";
        }
        if (parseFloat($("#cash").val()) < parseFloat($("#amount_payable").text()) && status === "u") {
          alert("Customer Payment is insufficient!");
        } else {
          var orderId = $(this).attr("data-orderid");
          $.ajax({
            method: "post",
            url: "billings/setStatus",
            data: {
              osID: orderId,
              payStatus: status
            },
            dataType: "json",
            success: function(bill) {
              console.log(bill);
            }
          });
        }
      });
    });
  </script>
</body>

</html>
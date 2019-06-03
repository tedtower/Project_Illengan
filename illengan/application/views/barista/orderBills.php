<!DOCTYPE html>
<html>

<head>
  <?php include_once('head.php') ?>
</head>

<body>
  <?php include_once('navigation.php') ?>
  <!--End Top Nav-->
  <div class="content">
    <div class="container-fluid">
      <br>
      <p style="text-align:right; font-weight: regular; font-size: 16px">
        <!-- Real Time Date & Time -->
        <?php echo date("M j, Y -l"); ?>
      </p>
      <div class="content" style="margin-left:250px;">
        <div class="conteiner-fluid">
          <!--Start Table-->
          <div class="card-content">
            <table id="ordersTable" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th></th>
                  <th><b class="pull-left">Slip No.</b></th>
                  <th><b class="pull-left">Customer</b></th>
                  <th><b class="pull-left">Table Code</b></th>
                  <th><b class="pull-left">Total Payable</b></th>
                  <th><b class="pull-left">Order Date</b></th>
                  <th><b class="pull-left">Status</b></th>
                  <th><b class="pull-left">Status Paid</b></th>
                  <th><b class="text-align:center;">Actions</b></th>
                </tr>
              </thead>
              <!--Start Table Body-->
              <tbody id="orderslipData">
                <?php if (isset($bills)) {
                  foreach ($bills as $bill) {
                    ?>
                    <tr data-toggle="modal" data-target="#Modal_Pay" id="open_modal" style="cursor:pointer">
                      <td class="clickable"><?= $bill["osID"] ?></td>
                      <td class="clickable"><?= $bill["custName"] ?></td>
                      <td class="clickable"><?= $bill["tableCode"] ?></td>
                      <td class="clickable"><?= $bill["osTotal"] ?></td>
                      <td class="clickable"><?= $bill["osDateTime"] ?></td>
                      <td class="clickable" id="payStatus"><?= $bill["payStatus"] ?></td>
                      <td class="clickable"><?= $bill["osPayDateTime"] ?></td>
                      <td class="except"><button id="remove_modal" class="btn btn-warning btn-sm">Remove</button></td>
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
  <form action="" method="">
    <div class="modal fade bd-example-modal-sm" id="Modal_Pay" tabindex="-1" role="dialog" aria-labelledby="exampleModalLable" aria-hidden="true" style="overflow:auto !important;">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLable">Payment</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <!--Start Modal Content-->
        <div class="modal-body">
          <div class="form-row">
            <div class="form-group row">
              <label class="col-md-10 col-form-label">Amount Payable: </label>
              <div class="col-md-10">
                <input type="text" class="form-control" name="amount_payable" id="amount_payable" value="<?= $bill['osTotal'] ?>" readonly>
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
            <p>Remove orderslip?</p>
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

  <?php include_once('scripts.php') ?>

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
<!DOCTYPE html>
<html>

<head>
  <?php include_once('templates/head.php') ?>
</head>

<body style="background:white">
  <?php include_once('templates/navigation.php') ?>
  <!--End Top Nav-->
  <div class="content">
    <div class="container-fluid">
      <br>
      <p style="text-align:right; font-weight: regular; font-size: 16px">
        <!-- Real Time Date & Time -->
        <?php echo date("M j, Y - l"); ?>
      </p>
      <div class="content" style="margin-left:auto;">
        <div class="conteiner-fluid">
          <!--Start Table-->
          <div class="card-content">
            <table id="ordersTable" class="orderbills table-striped table-bordered dt-responsive nowrap" cellspacing="0"
              width="100%">
              <thead>
                <tr>
                  <th><b class="pull-left">Slip No.</b></th>
                  <th><b class="pull-left">Customer</b></th>
                  <th><b class="pull-left">Table Code</b></th>
                  <th><b class="pull-left">Total Payable</b></th>
                  <th><b class="pull-left">Order Date</b></th>
                  <th><b class="pull-left">Status Paid</b></th>
                  <th><b class="text-align:center;">Actions</b></th>
                </tr>
              </thead>
              <!--Start Table Body-->
              <tbody>
              </tbody>
            </table>
          </div>
          <!--End Table-->
        </div>
      </div>
    </div>
  </div>

  <!--Start MODAL for BILL COMPUTATION-->
  <div class="modal fade" id="Modal_Pay" name="Modal_Pay" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true" style="overflow: auto !important;">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLable">Payment</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="formEdit" accept-charset="utf-8">
          <div class="modal-body">
            <!--Quantity-->
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-sm"
                  style="width:140px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                  Amount Payable</span>
              </div>
              <input type="text" step="any" min="0" class="form-control" name="amount_payable" id="amount_payable"
                value="" readonly>
              <span class="text-danger"><?php echo form_error("amount_payable"); ?></span>
            </div>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-sm"
                  style="width:140px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                  Cash</span>
              </div>
              <input type="text" step="any" min="0" class="form-control" name="cash" id="cash" value="0.00" required>
              <span class="text-danger"><?php echo form_error("cash"); ?></span>
            </div>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-sm"
                  style="width:140px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                  Change</span>
              </div>
              <input type="text" step="any" min="0" class="form-control" name="change" id="change" value="0.00" readonly>
              <span class="text-danger"><?php echo form_error("change"); ?></span>
            </div>

            <!--Footer-->
            <div class="modal-footer">
              <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
              <button class="btn btn-success btn-sm" id="updtbutton"type="submit">Update</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!--End MODAL for BILL COMPUTATION-->

  <!--Start MODAL for DELETE-->
  <div class="modal fade" id="Modal_Remove" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
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
    //POPULATE TABLE
    var orderbills = [];
    $(function () {
      viewOrderbillsJS();
    });

    var table = $('#ordersTable');
    function viewOrderbillsJS() {
      $.ajax({
        url: "<?= site_url('barista/orderBillsJS') ?>",
        method: "post",
        dataType: "json",
        success: function (data) {
          orderbills = data;
          setOrderBills(orderbills);
        },
        error: function (response, setting, errorThrown) {
          console.log(response.responseText);
          console.log(errorThrown);
          console.log(data);
        }
      });
    }

    function setOrderBills() {
      if ($("#ordersTable> tbody").children().length > 0) {
        $("#ordersTable> tbody").empty();
      }
      orderbills.forEach(orders => {
        $("#ordersTable> tbody").append(`
            <tr data-osID="${orders.osID}" data-payable="${orders.osTotal}">
                    <td>${orders.osID}</td>
                    <td>${orders.custName}</td>
                    <td>${orders.tableCode}</td>
                    <td>${orders.osTotal}</td>
                    <td>${orders.osDateTime}</td>
                    <td>${orders.payStatus}</td>
                    <td>
                                    <!--Action Buttons-->
                                    <div class="onoffswitch">

                                        <!--Edit button-->
                                        <button class="pay btn btn-default btn-sm" data-toggle="modal"
                                            data-target="#Modal_Pay">Pay</button>
                                        <!--Delete button-->
                                        <button class="item_delete btn btn-danger btn-sm" data-toggle="modal" 
                                        data-target="#Modal_Remove">Archive</button>                      
                                    </div>
                    </td>
            </tr>`);

        $(".pay").last().on('click', function () {
            $("#Modal_Pay").find("input[name='amount_payable']").val($(this).closest("tr").attr(
                "data-payable"));
        });
        $(".item_delete").last().on('click', function () {
           
            $("#deleteSpoilage").find("input[name='prID']").val($(this).closest("tr").attr(
            	"data-id"));
            $("#deleteSpoilage").find("input[name='msID']").val($(this).closest("tr").attr(
                "data-id"));
        });
      });
    

    }
//-----------------------For the Payment Modal-------------------------
    $("#cash").on('change', function () {
      var payable = parseFloat(document.getElementById('amount_payable').value);
      var cash = parseFloat(document.getElementById('cash').value);
      if(cash < payable){
        $("#Modal_Pay").find("input[name='change']").val("Insufficient Amount");
        document.getElementById("updtbutton").disabled = true;
      }else{
        var change = parseFloat(cash - payable);
        $("#Modal_Pay").find("input[name='change']").val(change);
        document.getElementById("updtbutton").disabled = false;
      }
    });

  </script>
</body>

</html>
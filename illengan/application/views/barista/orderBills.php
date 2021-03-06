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
            <table id="ordersTable" class="table table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead class="thead-dark">
                <tr>
                  <th><b class="pull-left">SLIP NO.</b></th>
                  <th><b class="pull-left">CUSTOMER</b></th>
                  <th><b class="pull-left">TABLE CODE</b></th>
                  <th><b class="pull-left">TOTAL PAYABLE</b></th>
                  <th><b class="pull-left">ORDER TIME</b></th>
                  <th><b class="pull-left">STATUS</b></th>
                  <th><b class="pull-left">ACTIONS</b></th>
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
        <!--Modal Content-->
        <!--Table containing the different input fields in billings -->
        <table class="orderitemsTable table table-sm table-borderless">
          <thead class="thead-light">
            <tr>
              <th></th>
              <th>Item Name</th>
              <th>Qty</th>
              <th>Price</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
        <!--End Table Content-->
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
                readonly>
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
              <input type="text" step="any" min="0" class="form-control" name="change" id="change" value="0.00"
                readonly>
              <span class="text-danger"><?php echo form_error("change"); ?></span>
            </div>
            <input type="hidden" class="form-control" name="osID" id="osID" readonly>
            <input type="hidden" class="form-control" name="custName" id="custName" readonly>
            <!--Footer-->
            <div class="modal-footer">
              <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
              <button class="btn btn-success btn-sm" id="payBtn" type="submit">Pay</button>
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
                    Remarks:<input type="text" name="deleteRemarks" id="deleteRemarks"
                      class="form-control form-control-sm">
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
          //------POPULATE TABLE-----------------------------------

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
            <tr data-osID="${orders.osID}" data-custName="${orders.custName} ">
                    <td>${orders.osID}</td>
                    <td>${orders.custName}</td>
                    <td>${orders.tableCode}</td>
                    <td>${orders.osTotal}</td>
                    <td>${orders.time}</td>
                    <td>${orders.payStatus}</td>
                    <td>
                                    <!--Action Buttons-->
                                    <div class="onoffswitch">
                                    <!--Pay Button-->
                                    <button class="pay btn btn-sm btn-info" data-toggle="modal" data-target="#Modal_Pay" onclick="setOsID(${orders.osID})" >Pay</button>           
                                    </div>
                    </td>
            </tr>`);

              $(".pay").last().on('click', function () {
                $("#Modal_Pay").find("input[name='osID']").val($(this).closest("tr").attr(
                    "data-osID"));
                $("#Modal_Pay").find("input[name='custName']").val($(this).closest("tr").attr(
					          "data-custName"));
              });
            });


          }
          //---------------------------------Populate OrderItems in Brochure--------------------------
          function setOsID($osID) {
            var value = $osID;
            $('#formEdit')[0].reset();
          
            $.ajax({
              type: 'POST',
              url: 'http://www.illengan.com/barista/getOrderItems',
              data: {
                osID: value
              },
              dataType: 'json',
              success: function (data) {
                item = data;
                setItemData(item);
                for (var i = 0; i <= item.length - 1; i++) {
                  console.log(data[i].subtotal);
                  $("#Modal_Pay").find("input[name='amount_payable']").val(parseInt(data[i].osTotal));
                }

              },
              failure: function () {
                console.log('None');
              },
              error: function (response, setting, errorThrown) {
                console.log(errorThrown);
                console.log(response.responseText);
              }
            });
          }

          function setItemData(item) {
            $('#formEdit')[0].reset();
            $(".orderitemsTable> tbody").empty();
            $(".orderitemsTable> tbody").append(`${item.map(items =>{
              return `<tr>
                            <td></td>
                            <td><input type="text" name="olDesc" class="form-control form-control-sm"  value="${items.olDesc}" required readonly></td>
                            <td><input type="text" name="olQty" class="form-control form-control-sm"  value="${items.olQty}" required readonly></td>
                            <td><input type="text" name="olSubtotal" class="form-control form-control-sm"  value=${items.olSubtotal} required readonly></td>
                            <td></td>
                            </tr>`
            }).join('')}`);
          }
          //---------------------For Resolving Payment---------------------------
          $(document).ready(function() {
          $("#Modal_Pay form").on('submit', function(event) {
          event.preventDefault();
              var osID = $(this).find("input[name='osID']").val();
              var custName = $(this).find("input[name='custName']").val();
            
              $.ajax({
                  url: "<?= site_url("barista/updatePayment")?>",
                  method: "post",
                  data: {
                      osID: osID,
                      custName: custName
                  },
                  dataType: "json",
                  complete: function() {
                      $("#Modal_Pay").modal("hide");
                      location.reload();
                  },
                  error: function(error) {
                      console.log(error);
                  }
                  
                  });
              });
          });

          //---------------------For the Payment Modal-------------------------
          document.getElementById("payBtn").disabled = true;
          
          $("#cash").on('change', function () {
            var payable = parseFloat(document.getElementById('amount_payable').value);
            var cash = parseFloat(document.getElementById('cash').value);
    
            if (cash < payable) {
              $("#Modal_Pay").find("input[name='change']").val("Insufficient Amount");
              document.getElementById("payBtn").disabled = true;
            } else {
              var change = parseFloat(cash - payable);
              $("#Modal_Pay").find("input[name='change']").val(change);
              document.getElementById("payBtn").disabled = false;
            }
          });
        </script>
</body>

</html>
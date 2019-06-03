<!DOCTYPE html>
<html>
    <head>
       <?php include_once('templates/head.php') ?>
    </head>
    <body>
        <?php include_once('templates/navigation.php') ?>
    <div class="container" style="overflow: auto; margin-left:0px;">
        <div class="card border-success" style="width:40%; display: inline-block;">
            <div class="card-header">
                <form>
                    <label>Slip No : </label>
                    <input style="width: 20px; border: none; background: transparent;" type="text" name="slip_number" id="slip_number" value="">&nbsp;
                    <label>Table No : </label>
                    <input style="width: 20px; border: none; background: transparent" type="text" name="slip_number" id="slip_number" value=""><br>
                    <label>Name : </label>
                    <input style="border: none; background: transparent" type="text" name="slip_number" id="slip_number" value="">&nbsp; 
                    <label>Status : </label>
                    <input style="border: none; background: transparent" type="text" name="slip_number" id="slip_number" value="">
                </form>
            </div>
            <div class="card card-body" style="width: auto; height: auto;">
                
                
                <button class="btn btn-link btn-sm" data-toggle="modal" data-target="#Modal_Add" id="add_modal">Add Order</button>

                <br>
                <table class="pendOrders dtr-inline collapsed table display table-sm" id="pendingordersTable" style="width: auto; height: auto;">
                  <thead>
                      <tr>
                          <th style="text-align: center;">Qty</th>
                          <th style="text-align: center;">Order</th>
                          <th style="text-align: center;">Subtotal</th>
                          <th style="text-align: center;">Item Status</th>
                          <th style="text-align: center;">Actions</th>
                      </tr>
                  </thead>
                  <tbody>
                  </tbody>
            </table>
            <br>
                <label>Total: <input type="text" style="border: 2px solid black; align: right" name="total_amount" id="total_amount" readonly></label><br>
                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#ModalBill" id="bill_modal">Payment</button>
            </div>
        </div>
        <br><br>
        <div class="card border-success" style="display: inline-block;">
            <div class="card-header">
                <form>
                    <label>Slip No : </label>
                    <input style="width: 50px; border: none; background: transparent;" type="text" name="slip_number" id="slip_number" value="">&nbsp;
                    <label>Table No : </label>
                    <input style="width: 50px; border: none; background: transparent" type="text" name="slip_number" id="slip_number" value=""><br>
                    <label>Name : </label>
                    <input style="border: none; background: transparent" type="text" name="slip_number" id="slip_number" value="">&nbsp; 
                    <label>Status : </label>
                    <input style="border: none; background: transparent" type="text" name="slip_number" id="slip_number" value="">
                </form>
            </div>
            <div class="card card-body" style="width: auto; height: auto;">
                
                <br>
                <button class="btn btn-link btn-sm" data-toggle="modal" data-target="#Modal_Add" id="add_modal">Add Order</button>

                <br>
                <table class="pendOrders dtr-inline collapsed table display table-sm" id="pendingordersTable" style="width: auto; height: auto;">
                  <thead>
                      <tr>
                          <!--<th>Slip No.</th> -->
                          <!-- <th>Order Item No.</th> -->
                          <!-- <th>Customer Name</th>
                          <th>Table</th> -->
                          <th></th>
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
                <label>Total: <input type="text" style="border: 2px solid black; align: right" name="total_amount" id="total_amount" readonly></label><br>
                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#ModalBill" id="bill_modal">Payment</button>
            </div>
        </div>
    </div>


         <!--MODAL FOR BILL COMPUTATION-->  
         <form>
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
                        <div class="form-group row">
                            <label class="col-md-10 col-form-label">Amount Payable: </label>
                            <div class="col-md-10">
                              <input type="text" name="amount_payable" id="amount_payable" value="" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-5 col-form-label">Cash:</label>
                            <div class="col-md-10">
                              <input type="text" name="cash" id="cash" value="0.00" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-5 col-form-label">Change:</label>
                            <div class="col-md-10">
                              <input type="text" name="change" id="change" value="0.00" readonly>
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
            </div>
        </form>

        
        <!--END FOR MODAL COMPUTATION-->

        <?php include_once('templates/scripts.php') ?>

    </body>

    <script>
          var penOrders = [];
          $(function() {
              viewOrderslipsJs();
          });

          //POPULATE TABLE
          var table = $('#pendingordersTable');
            function format(d) {
              return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">' +
                '<tr>' +
                '<td>Remarks</td>' +
                '</tr>' +
                '<tr>' +
                '<td>' + d.ssRemarks + '</td>' +
                '</tr>' +
                '</table>';

            }
            function viewOrderslipsJs() {
                  $.ajax({
                      url: "<?= site_url('barista/viewOrderslipJS') ?>",
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
                      <tr data-osID="${table.osID}" >
                          <td><input type="checkbox" name="orderlist_checkbox"></td>
                          <td>${table.olQty}</td>
                          <td>${table.olDesc}</td>
                          <td>${table.olSubtotal}</td>
                          <td>${table.olStatus}</td>
                          <td>
                                  <!--Action Buttons-->
                                  <div class="onoffswitch">
                                      <!--Delete button-->
                                      <button class="item_delete btn btn-danger btn-sm" data-toggle="modal" 
                                      data-target="#Modal_Remove">Cancel</button>                      
                                  </div>
                              </td>
                          </tr>`);
                      $(".item_delete").last().on('click', function () {
                          $("#Modal_Remove").find("input[name='olID']").val($(this).closest("tr").attr(
                                    "data-olID"));
                      });
                  });
            }

        $(document).ready(function(){
          $("#bill_modal").click(function(){
            $("#Modal_Pay").modal();
          });

          //---------MAY AAYUSIN DITO---------------------------------------------------------
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

</html>
<!DOCTYPE html>
<htmL>

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
    <link rel="stylesheet" href="<?php echo base_url(). 'assets/css/barista/cards.css' ?>" type="text/css">
</head>
<?php include_once('templates/head.php') ?>
<body style="background:#c7ccd1;">
    <?php include_once('templates/navigation.php') ?>
    <!--End Top Nav-->
    <?php  if(isset($slip)){
                          foreach($slip as $slips): 
                            
                            ?> 
    <div class="container-fluid">
        <section class="lists-container">
            <!-- Lists container -->
            <!--Short Order Card-->
            <div class="list">
                <div class="card m-0 p-0">
                    <!--Card Header-->
                    <div class="card-header p-2">
                        <div style="overflow:auto;">
                            <div style="float:left;text-align:left;width:70%">
                                <div><b>Slip No: </b> <?php echo $slips['osID'] ?></div>
                                <div><b>Customer: </b><?php echo $slips['tableCode'] ?> </div>
                            </div>  
                            <div style="float:right;text-align:left;width:30%">
                                <div><b> Table No: </b><?php echo $slips['custName'] ?></div>
                                <div><b>Status: </b><?php echo $slips['payStatus'] ?></div>
                            </div>
                        </div>
                    </div>
                    <!--Card Body-->
                    <div class="card-body p-2">
                        <table class="table" id="pendingordersTable" style="width: auto; height: auto;border:0">
                            <thead style="background:white">
                                <tr class="border-bottom">
                                    <!-- <th width="10%">Order Id</th> -->
                                    <th>Qty</th>
                                    <th width="50%">Order</th>
                                    <th>Subtotal</th>
                                    <th width="20%">Status</th>
                                    <th style="width:2%"></th>
                                </tr>
                            </thead>
                            <tbody style="font-size:13px;overflow:">
                            </tbody>
                        </table>
                        <br>
                    </div>
                <div class="card-footer p-2">
                    <label>Total: <input type="text" style="border: 2px solid black; align: right" name="total_amount" id="total_amount" readonly></label>
                    <br>
                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#Remove_slip" id="bill_modal">Payment</button>
                    <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#Remove_slip" id="bill_modal">Remove Slip</button>
                </div>
                </div>
            </div>
    </section>
    <!-- End of lists container -->
    <!--End Cards-->
    </div>
    <?php 
      endforeach;

}            
?>

<script type="text/javascript" src="<?php echo base_url().'assets/js/barista/jquery-3.2.1.js'?>"></script>
    <script type="text/javascript" src="<?php echo base_url().'assets/js/barista/bootstrap.js'?>"></script>
    <script type="text/javascript" src="<?php echo base_url().'assets/js/barista/jquery.dataTables.js'?>"></script>
    <script type="text/javascript" src="<?php echo base_url().'assets/js/barista/tables.js'?>"></script>
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
                          <td>${table.olQty}</td>
                          <td>${table.olDesc}</td>
                          <td>${table.olSubtotal}</td>
                          <td><button id="status" class="status btn dt-buttons"></button></td>
                          <td> <img class="exitBtn1" src="/assets/media/admin/error.png" style="width:18px;height:18px; float:right;">
                              </td>
                          </tr>
                          <tr>$nbsp;$nbsp;$nbsp;
                            <td></td>
                            <td>${table.aoName}</td>
                            <td>${table.aoPrice}</td>
                            <td>${table.olRemarks}</td>
                            </tr>`);
                      $(".exitBtn1").last().on('click', function () {
                          $("#deleteOrder").find("input[name='olID']").val($(this).closest("tr").attr(
                                    "data-olID"));
                      });

                  });

            }

    </script>


</html>
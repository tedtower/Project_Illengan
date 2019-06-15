<!DOCTYPE html>
<htmL>

<head>
    <?php include_once('templates/head.php') ?>
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/css/barista/cards.css' ?>" type="text/css">
</head>
<body>
    <div class = "nav na-tabs">
    <ul class="nav nav-tabs" role="tablist">
  <li class="nav-item">
    <a href="<?php echo site_url('barista/orders') ?>" class="nav-link active" href="#pendingTab" role="tab" data-toggle="tab">Pending Orders</a>
  </li>
  <li class="nav-item">
    <a href ="<?php echo site_url('barista/servedOrderlist') ?>" class="nav-link" href="#servedTab" role="tab" data-toggle="tab">Served Orders</a>
  </li></ul>

    </div>
  <br>
  <div class="tab-content" id="pendingTab">
  <div class="container"><br>
  <button class="btn btn-link btn-sm" onClick="window.location.href = '<?php echo base_url();?>customer/processCheckIn';return false;">Add Order</button>
  <br>
            <table class="pendOrders dtr-inline collapsed table display" id="pendingordersTable" >
                <thead>
                    <tr>
                        <!--<th>Slip No.</th> -->
                        <th>Order Item No.</th>
                        <th>Customer Name</th>
                        <th>Table</th>
                        <th>Order</th>
                        <th>Order Qty</th>
                        <th>Item Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
    </div>

<body style="background:#c7ccd1;">
    <?php include_once('templates/navigation.php') ?>
    <!--End Top Nav-->
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
                                <div><b>Slip No: </b> 1</div>
                                <div><b>Customer: </b>Marvin</div>
                            </div>
                            <div style="float:right;text-align:left;width:30%">
                                <div><b> Table No: </b>T1</div>
                                <div><b>Status: </b>Pending</div>
                            </div>
                        </div>
                    </div>
                    <!--Card Body-->
                    <div class="card-body p-2">
                        <table class="table" id="pendingordersTable" style="width: auto; height: auto;border:0">
                            <thead style="background:white">
                                <tr class="border-bottom">
                                    <th>Qty</th>
                                    <th width="50%">Order</th>
                                    <th>Subtotal</th>
                                    <th width="20%">Status</th>
                                    <th style="width:2%"></th>
                                </tr>
                            </thead>
                            <tbody style="font-size:13px;overflow:">
                                <tr>
                                    <td>2</td>
                                    <td>Iced AmericanoIced AmericanoIced Americano</td>
                                    <td>180</td>
                                    <td>
                                        <button style="width:100%;padding:6%;background:green;color:white;border:0;border-radius:5px">Served</button>
                                    </td>
                                    <td>
                                        <img class="exitBtn1" src="/assets/media/admin/error.png" style="width:18px;height:18px; float:right;">
                                    </td>

                                </tr>
                                <!--Addons & Remarks Comment
                                <tr>
                                    <td colspan="5" style="">
                                        <div style="width:88%;float:right;">
                                            <div>Addons: </div>
                                            <div>Remarks : </div>
                                        </div>
                                    </td>
                                </tr>
                                -->
                                <tr>
                                    <td>2</td>
                                    <td>Iced AmericanoIced AmericanoIced Americano</td>
                                    <td>180</td>
                                    <td>
                                        <button style="width:100%;padding:6%;background:green;color:white;border:0;border-radius:5px">Served</button>
                                    </td>
                                    <td>
                                        <img class="exitBtn1" src="/assets/media/admin/error.png" style="width:18px;height:18px; float:right;">
                                    </td>
                                </tr>

                                <tr>
                                    <td>2</td>
                                    <td>Iced AmericanoIced AmericanoIced Americano</td>
                                    <td>180</td>
                                    <td>
                                        <button style="width:100%;padding:6%;background:green;color:white;border:0;border-radius:5px">Served</button>
                                    </td>
                                    <td>
                                        <img class="exitBtn1" src="/assets/media/admin/error.png" style="width:18px;height:18px; float:right;">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <!--Card Footer-->
                    </div>
                    <div class="card-footer text-muted">
                    </div>
                </div>
            </div>

            <!--Long Order Card-->
            <div class="list">
                <div class="card m-0 p-0" style="max-height:80%">
                    <!--Long Card Header-->
                    <div class="card-header p-3">
                        <div style="overflow:auto;font-size:14px">
                            <div style="float:left;text-align:left;width:73%">
                                <div><b>Slip No: </b> 1</div>
                                <div><b>Customer: </b>Marvin</div>
                            </div>
                            <div style="float:right;text-align:left;width:27%">
                                <div><b> Table No: </b>T1</div>
                                <div><b>Status: </b>Pending</div>
                            </div>
                        </div>
                    </div>
                    <!--Long Card Body-->
                    <div class="card-body p-2" style="overflow:auto">
                        <table class="table" id="pendingordersTable" style="width: auto; height: auto;border:0">
                            <thead style="background:white">
                                <tr class="border-bottom">
                                    <th>Qty</th>
                                    <th width="50%">Order</th>
                                    <th>Subtotal</th>
                                    <th width="20%">Status</th>
                                    <th style="width:2%"></th>
                                </tr>
                            </thead>
                            <tbody style="font-size:13px">
                                <tr>
                                    <td>2</td>
                                    <td>Iced AmericanoIced AmericanoIced Americano</td>
                                    <td>180</td>
                                    <td>
                                        <button style="width:100%;padding:6%;background:green;color:white;border:0;border-radius:5px">Served</button>
                                    </td>
                                    <td>
                                        <img class="exitBtn1" src="/assets/media/admin/error.png" style="width:18px;height:18px; float:right;">
                                    </td>
                                </tr>

//POPULATE TABLE
let UPDATE = 5000;
var table = $('#pendingordersTable');
	// function format(d) {
	// 	return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">' +
	// 		'<tr>' +
	// 		'<td>Remarks</td>' +
	// 		'</tr>' +
	// 		'<tr>' +
	// 		'<td>' + d.ssRemarks + '</td>' +
	// 		'</tr>' +
	// 		'</table>';

                                <tr>
                                    <td>2</td>
                                    <td>Iced AmericanoIced AmericanoIced Americano</td>
                                    <td>180</td>
                                    <td>
                                        <button style="width:100%;padding:6%;background:green;color:white;border:0;border-radius:5px">Served</button>
                                    </td>
                                    <td>
                                        <img class="exitBtn1" src="/assets/media/admin/error.png" style="width:18px;height:18px; float:right;">
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Iced AmericanoIced AmericanoIced Americano</td>
                                    <td>180</td>
                                    <td>
                                        <button style="width:100%;padding:6%;background:green;color:white;border:0;border-radius:5px">Served</button>
                                    </td>
                                    <td>
                                        <img class="exitBtn1" src="/assets/media/admin/error.png" style="width:18px;height:18px; float:right;">
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Iced AmericanoIced AmericanoIced Americano</td>
                                    <td>180</td>
                                    <td>
                                        <button style="width:100%;padding:6%;background:green;color:white;border:0;border-radius:5px">Served</button>
                                    </td>
                                    <td>
                                        <img class="exitBtn1" src="/assets/media/admin/error.png" style="width:18px;height:18px; float:right;">
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Iced AmericanoIced AmericanoIced Americano</td>
                                    <td>180</td>
                                    <td>
                                        <button style="width:100%;padding:6%;background:green;color:white;border:0;border-radius:5px">Served</button>
                                    </td>
                                    <td>
                                        <img class="exitBtn1" src="/assets/media/admin/error.png" style="width:18px;height:18px; float:right;">
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Iced AmericanoIced AmericanoIced Americano</td>
                                    <td>180</td>
                                    <td>
                                        <button style="width:100%;padding:6%;background:green;color:white;border:0;border-radius:5px">Served</button>
                                    </td>
                                    <td>
                                        <img class="exitBtn1" src="/assets/media/admin/error.png" style="width:18px;height:18px; float:right;">
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Iced AmericanoIced AmericanoIced Americano</td>
                                    <td>180</td>
                                    <td>
                                        <button style="width:100%;padding:6%;background:green;color:white;border:0;border-radius:5px">Served</button>
                                    </td>
                                    <td>
                                        <img class="exitBtn1" src="/assets/media/admin/error.png" style="width:18px;height:18px; float:right;">
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Iced AmericanoIced AmericanoIced Americano</td>
                                    <td>180</td>
                                    <td>
                                        <button style="width:100%;padding:6%;background:green;color:white;border:0;border-radius:5px">Served</button>
                                    </td>
                                    <td>
                                        <img class="exitBtn1" src="/assets/media/admin/error.png" style="width:18px;height:18px; float:right;">
                                    </td>
                                </tr>

                                

	function viewpendingOrdersJs() {
        $.ajax({
            url: "<?= site_url('barista/pendingOrdersJS') ?>",
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
                <td>${table.custName}</td>
                <td>${table.tableCode}</td>
                <td>${table.olDesc}</td>
                <td>${table.olQty}</td>
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
            $(".status").on('click', function() {
                var status = document.getElementById(status).val();
                if (status.value=="pending"){
                    status.value="served";
                }else{
                    status.value=="pending";
                }

            });
            
        });
	}
	//END OF POPULATING TABLE
//start of new function
/*$('#show_data').on('click','.item_edit',function(){
            var order_id = $(this).data('order_id');
            var table_code        = $(this).data('table_code');
            
            $('#Modal_Edit').modal('show');
            $('[name="order_id_edit"]').val(order_id);
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
        });*/

        //get data for delete record
        // $('#show_data').on('click','.item_delete',function(){
        //      var osID = $(this).data('osID');
            


    </div>
    </section>
    <!-- End of lists container -->
    <!--End Cards-->
                <!--START "Remove Slip" MODAL-->
            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteOrderModal" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Delete Addon</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body text-center py-2">
                            <i class="fas fa-times fa-4x animated rotateIn text-danger"></i>
                            <input hidden id="remID">
                            <p class="delius">Are you sure you want to remove this orderslip?</p>
                        </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                            </div>
                    </div>

                </div>
            </div>
<?= include_once('templates/scripts.php')?>
</body>
</htmL>
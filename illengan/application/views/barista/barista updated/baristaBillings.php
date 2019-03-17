<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport'>
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Il-Lengan | Barista Billings</title>
    <!--Bootstrap core CSS-->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <!--Animation library for notifications-->
    <link href="assets/css/animate.min.css" rel="stylesheet" />
    <!--  Light Bootstrap Table core CSS    -->
    <link href="assets/css/light-bootstrap-dashboard.css?v=1.4.0" rel="stylesheet" />
    <!--CSS for Demo Purpose, don't include it in your project-->
    <link href="assets/css/demo.css" rel="stylesheet" />
    <!--Fonts and icons-->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />

</head>

<body>
    <div class="wrapper">
        <div class="sidebar" data-color="brown" data-image="assets/img/Coffee_1.jpg">
            <!--Left Navigation Bar-->
            <div class="sidebar-wrapper" style="overflow: hidden">
                <div class="logo">
                    <img src="assets/img/logo_lg.png" alt="il-lengan-logo" img-align="center" width="225px"
                        height="135px">
                </div>

                <ul class="nav">
                    <li>
                        <a href="baristaOrders.html">
                            <p>Orders</p>
                        </a>
                    </li>
                    <li class="active">
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
        <!--Hamburger Nav
            <nav class="navbar navbar-transparent navbar-absolute">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse">
                            <span class="sr-only"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="#"></a>
                    </div>
                </div>
            </nav>-->
        <!--End Side Bar-->
        <div>
            <h5>Order No : </h5><!-- Order ID -->
            <p id="orderNo"></p>
            <h5>Table Code : </h5><!-- Table Code -->
            <p id="tableCode"></p>
            <h5>Customer Name : </h5><!-- Customer Name -->
            <p id="customerName"></p>
            <h5>Payment Status: </h5><!-- Payment Status -->
            <p id="paymentStatus"></p>
            <h5>Payment Date and Time: </h5><!-- Payment Status -->
            <p id="paymentDate"></p>
            <div>
                <table>
                    <thead>
                        <tr>
                            <th>Item Name</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="itemnames"></td>
                            <td class="itemqty"></td>
                            <td class="itemprice"></td>
                        </tr>
                        <tr>
                            <td cols="2">Amount Payable</td>
                            <td id="totalamountpayable"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div>
                <div class="d-inline-block">
                    <label for="cash">Cash: </label>
                    <input type="text" id="cash" name="cash" value="" />
                </div>
                <div>
                    <label for="change">Change: </label>
                    <input type="text" id="change" name="change" value="" readonly="readonly" />
                </div>
            </div>
            <div class="d-inline-block">
                <button type="button" class="closemodal">Close</button>
                <button type="button" id="update-pay-status-btn" data-orderid="">Submit</button>
            </div>
        </div>
        <div class="main-panel">
            <div class="content">
                <div class="container-fluid">
                    <!--Table-->
                    <div class="card-content">
                        <!--Search
                    <div id ="example_filter" class="dataTables_filter">
                        <label>
                        "Search:"
                        <div class="form-group form-group-sm is-empty">
                           <input type="search" class="form-control" placeholder aria-controls="example">
                               <span class="material-input"></span> 
                        </div>
                        </label>
                    </div>-->
                        <table id="example" class="table table-striped table-bordered dt-responsive nowrap"
                            cellspacing="0" width="100%">
                            <thead>
                                <th><b class="pull-left">Order No.</b></th>
                                <th><b class="pull-left">Table No.</b></th>
                                <th><b class="pull-left">Customer Name</b></th>
                                <th><b class="pull-left">Order Date</b></th>
                                <th><b class="pull-left">Amount Payable</b></th>
                                <th><b class="pull-left">Payment Status</b></th>
                                <th><b class="pull-left">Action</b></th>
                            </thead>
                            <tbody>
                                <!--Insert PHP-->
                    <?php 
                        if(!empty($bills)){
                            foreach($bills as $bill){
                    ?>
                                <tr>
                                    <td>
                                        <?php echo $bill['order_id'] ?>
                                        <!--insert PHP echo (e.g. "?php echo $row->code; ?>-->
                                    </td>
                                    <td>
                                        <?php echo $bill['table_code'] ?>
                                        <!--insert PHP echo (e.g. "?php echo $row->code; ?>-->
                                    </td>
                                    <td>
                                        <?php echo $bill['cust_name'] ?>
                                        <!--insert PHP echo (e.g. "?php echo $row->code; ?>-->
                                    </td>
                                    <td>
                                        <?php echo $bill['order_date'] ?>
                                        <!--insert PHP echo (e.g. "?php echo $row->code; ?>-->
                                    </td>
                                    <td>
                                        <?php echo $bill['order_payable'] ?>
                                        <!--insert PHP echo (e.g. "?php echo $row->code; ?>  data-toggle="modal"  data-target=""-->
                                    </td>
                                    <td>
                                        <?php echo $bill['pay_status'] ?>
                                    </td>
                                    <td>
                                        <div class="onoffswitch">
                                            <!--View button-->
                                            <button class="btn btn-info btn-sm view-btn"
                                                data-orderid="<?php echo $bill['order_id']?>">View</button>
                                            <!--Cancel button-->
                                            <button class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="">Cancel</button>
                                        </div>
                                    </td>
                                </tr>
                                <?php            
                            }
                        }
                    ?>
                            </tbody>
                            <!--End Table Content-->
                        </table>
</body>

<!--   Core JS Files   -->
<script src="assets/js/jquery.3.2.1.min.js" type="text/javascript"></script>
<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
<!--  Charts Plugin -->
<script src="assets/js/chartist.min.js"></script>
<!--  Notifications Plugin    -->
<script src="assets/js/bootstrap-notify.js"></script>
<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
<script src="assets/js/light-bootstrap-dashboard.js?v=1.4.0"></script>
<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
<script src="assets/js/demo.js"></script>

<script>
var bills = {};
$(function() {
    $('table tbody tr  td').on('click', function() {
        $("#myModal").modal("show");
        $("#txtfname").val($(this).closest('tr').children()[0].textContent);
        $("#txtlname").val($(this).closest('tr').children()[1].textContent);
    });

    $("button[class~='view-btn']").on("click", function() {
        var orderId = $(this).attr("data-orderid");
        if (bills[orderId] !== undefined) {
            $.ajax({
                method: "post",
                url: "barista/getBillDetails",
                data: {
                    order_id: order_id
                },
                dataType: "json",
                success: function(bill) {
                    bills[orderId] = bill[0];
                }
            });
        }
        setData(orderId);
    });

    $("#cash").on('change', function() {
        if ($(this).val() == undefined) {
            $("#change").val(0.00);
        } else {
            $("#change").val(parseDouble($(this).val()) - parseDouble($("#amtPayable").val()));
        }
    });

});

function setData(orderId) {
    //setting of data in modal
}
</script>

</html>
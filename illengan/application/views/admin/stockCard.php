<body style="background: white">
<div class="content">
    <div class="container-fluid">
        <br>
        <p style="text-align:right; font-weight: regular; font-size: 16px">
            <!-- Real Time Date & Time -->
            <?php echo date("M j, Y -l"); ?>
        </p>
        <div class="content" style="margin-left:250px">
            <div class="container-fluid">
                <div class="card-content">
                    <!--Card--> 
                    <div class="card" style="background:whitesmoke">
                        <div class="card-body">
                        <div style="width:100%;overflow:auto;">
                            <span style="float:left;width:40%"><b>Stock Item:</b> Milk 500 ml</span>
                            <div style="width:60%;float:right">
                            <span style="float:right;margin:0 2%"><b>Storage:</b> Stock Room</span>
                            <span style="float:right;margin:0 2%"><b>Category:</b> Condiments</span>
                            <span style="float:right;margin:0 2%"><b>Status:</b> Available</span>
                            </div>
                        </div>
                        </div>
                    </div>
                    <!--Table--> 
                    <table id="stockTable" class="table table-bordered dt-responsive nowrap" cellspacing="0" width="100%" >
                        <thead class="thead-dark">
                            <tr>
                                <th style="width:2%"></th>
                                <th><b class="pull-left">Transaction</b></th>
                                <th><b class="pull-left">Date</b></th>
                                <th><b class="pull-left">Quantity</b></th>
                                <th><b cla   ss="pull-left">Remaining Qty</b></th>
                                <th><b class="pull-left">Remarks</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><img src="/assets/media/admin/negative.png" style="height:18px;width:18px"/></td>
                                <td>Cosumed</td>
                                <td>May 28, 2019</td>
                                <td>10</td>
                                <td>15</td>
                                <td></td>
                            </tr>

                            <tr>
                                <td><img src="/assets/media/admin/plus.png" style="height:18px;width: 18px"/></td>
                                <td>Restock</td>
                                <td>May 28, 2019</td>
                                <td>10</td>
                                <td>25</td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                    </div>
            </div>
        </div>
    </div>
</div>
<!--   Core JS Files   -->
<script src="<?= framework_url().'mdb/js/jquery-3.3.1.min.js';?>"></script>
<script src="<?= framework_url().'bootstrap-native/bootstrap.bundle.min.js'?>"></script>
<!--  Charts Plugin -->
<script src="assets/js/admin/chartist.min.js"></script>
<!--  Notifications Plugin    -->
<script src="assets/js/admin/bootstrap-notify.js"></script>
<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
<script src="assets/js/admin/light-bootstrap-dashboard.js?v=1.4.0"></script>
<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
<script src="assets/js/admin/demo.js"></script>
</body>
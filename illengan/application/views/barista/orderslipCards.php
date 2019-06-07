<!DOCTYPE html>
<htmL>

<head>
    <?php include_once('templates/head.php') ?>
    <link rel="stylesheet" href="<?php echo base_url(). 'assets/css/barista/cards.css' ?>" type="text/css">
</head>

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
                    </div>
                    <!--Footer-->
                    <div class="card-footer text-muted">
                        <button style="width:100%;padding:6%;background:blue;color:white;border:0;border-radius:5px">Payment</button>
                    </div>
                </div>
            </div>
            <!--Card 02-->


    </div>
    </section>
    <!-- End of lists container -->
    <!--End Cards-->
    </div>
</body>

</htmL>
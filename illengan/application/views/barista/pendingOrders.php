<!DOCTYPE html>
<htmL>

<head>
    <?php include_once('templates/head.php') ?>
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/css/barista/cards.css' ?>" type="text/css">
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
                        <div style="overflow:auto;">
                            <div style="text-align:left;float:left;width:73%; font-size:15px;"><b>Total: </b><span style="border-bottom:1px solid gray; padding:3px 15px">&#8369;1000</span></div>
                            <div style="float:right;width:25%;float:left;">
                                <button class="btn btn-warning btn-sm" style="font-size:13px;margin:0" data-toggle="modal" data-target="#deleteModal">Remove Slip</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            


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
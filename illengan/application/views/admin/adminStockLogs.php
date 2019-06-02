<!doctype html>
<html lang="en">

<head>
    <?php include_once('templates/head.php') ?>
</head>

<body>
    <?php include_once('templates/sideNav.php') ?>
    <!--End Side Bar-->
    <div class="content">
        <div class="container-fluid">
            <br>
            <p style="text-align:right; font-weight: regular; font-size: 16px">
                <!-- Real Time Date & Time -->
                <?php echo date("M j, Y -l"); ?>
            </p>
            <div class="content" style="margin-left:250px;">
                <div class="container-fluid">
                    <div class="content">
                        <div class="container-fluid">
                            <!--Table-->
                            <div class="card-content">
                                <a class="btn btn-default btn-sm" data-toggle="modal" data-target="#newTransaction"
                                    data-original-title style="float: left" id="addTransaction">Add Restock Item</a>
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
                                <br>
                                <br>
                                <table id="transTable" class="table table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                    <thead>
                                        <th style="width:10px"></th>
                                        <th><b class="pull-left">Code</b></th>
                                        <th><b class="pull-left">Description</b></th>
                                        <th><b class="pull-left">Quantity</b></th>
                                        <th><b class="pull-left">Type</b></th>
                                        <th><b class="pull-left">Date by Type</b></th>
                                        <th><b class="pull-left">Date Recorded</b></th>
                                        <th><b class="pull-left">Actions</b></th>
                                    </thead>
                                    <tbody>
                                        <!-- <tr style="display:none">
                                                <td colspan="6">
                                                    <div class="container" style="display:none"> Container ng accordion
                                                        <span>Date Recorded: </span>
                                                        <div>Remarks:<p></p></div>
                                                        <table class="table">
                                                            <tr>
                                                                <thead style="background:white">
                                                                    <th>Name</th>
                                                                    <th>Qty</th>
                                                                    <th>Unit</th>
                                                                    <th>Price</th>
                                                                    <th>Subtotal</th>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                    </tr>
                                                                </tbody>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr> -->
                                    </tbody>
                                </table>
                                <!--End Table Content-->

                                <!-- Add Modal Restock-->
                                <div class="modal fade" id="restockInventory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="overflow: auto !important;">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Restock Inventory Item</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="<?php echo base_url() ?>admin/inventory/restock" method="get" accept-charset="utf-8">
                                                <div class="modal-body">
                                                    <!--Item Name-->
                                                    <div class="row">
                                                        <div class="col-md-12 form-group">
                                                            <div class="form-group label-floating">
                                                                <label for="name">Item Name</label>
                                                                <input class="form-control" type="text" name="source_name" required pattern="[a-zA-Z][a-zA-Z\s]*" required title="Item name should only countain letters" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--Quantity-->
                                                    <div class="row">
                                                        <div class="col-md-12 form-group">
                                                            <div class="form-group label-floating">
                                                                <label for="qty">Quanity</label>
                                                                <input name="qty" class="form-control" type="number" value="" id="example-number-input" min="0" oninput="validity.valid||(value='');" data-validate="required" max="" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--End Destock Modal-->
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
                                                        <button class="btn btn-success btn-sm" type="submit">Insert</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!--End of Modal "Add Restock Inventory"-->

                                <!-- Add Modal for Restock Inventory-->
                                <div class="modal fade" id="destockInventory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="overflow: auto !important;">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Destock Inventory Item</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="<?php echo base_url() ?>admin/inventory/destock" method="get" accept-charset="utf-8">
                                                <div class="modal-body">
                                                    <!--Item Name-->
                                                    <div class="row">
                                                        <div class="col-md-12 form-group">
                                                            <div class="form-group label-floating">
                                                                <label for="name">Item Name</label>
                                                                <input class="form-control" type="text" name="source_name" required pattern="[a-zA-Z][a-zA-Z\s]*" required title="Item name should only countain letters" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--Current Quantity-->
                                                    <div class="row">
                                                        <div class="col-md-12 form-group">
                                                            <div class="form-group label-floating">
                                                                <label for="current_qty">Current Quanity</label>
                                                                <input name="current_qty" class="form-control" type="number" value="" id="example-number-input" min="0" oninput="validity.valid||(value='');" data-validate="required" max="" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--Date of Destock-->
                                                    <div class="row">
                                                        <div class="input-group mb-3 col">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="inputGroup-sizing-sm" style="width:140px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                    Transaction Date</span>
                                                            </div>
                                                            <input type="date" name="transDate" id="transDate" class="form-control form-control-sm">
                                                        </div>
                                                    </div>
                                                    <!--End Destock Modal-->
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
                                                        <button class="btn btn-success btn-sm" type="submit">Insert</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!--End Modal Add Restock" -->

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include_once('templates/scripts.php') ?>
</body>

</html>
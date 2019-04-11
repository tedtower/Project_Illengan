<!doctype html>
<html lang="en">

<head>
    <?php include_once('templates/head.php') ?>
</head>

<body>
    <?php include_once('templates/sideNav.php') ?>
    <!--End Side Bar-->

    <!--Start of Container-->
    <div class="content">
        <div class="container-fluid"><br>
            <p style="text-align:right; font-weight: regular; font-size: 16px">
                <?php echo date("M j, Y -l"); ?><!-- Real Time Date & Time -->
            </p>
            <div class="content" style="margin-left:250px;">
                <div class="container-fluid">
                    <div class="content">
                        <div class="container-fluid">
                            <div class="card-content">

                            <!--Add button-->
                                <a class="btn btn-default btn-sm" data-toggle="modal" data-target="#addPO"
                                    data-original-title style="float: left" id="addTransaction">Add Purchase Order</a>
                                <br>
                                <br>
                            <!--Start of Table-->
                                <table id="transTable" class="table table-bordered dt-responsive nowrap"
                                    cellspacing="0" width="100%">
                                    <thead class="thead-light">
                                        <th style="width:10px"></th>
                                        <th><b class="pull-left">PO No.</b></th>
                                        <th><b class="pull-left">Supplier</b></th>
                                        <th><b class="pull-left">Purchased Date</b></th>
                                        <th><b class="pull-left">Delivery Date</b></th>
                                        <th><b class="pull-left">Status</b></th>
                                        <th><b class="pull-left">Total</b></th>
                                        <th><b class="pull-left">Actions</b></th>
                                    </thead>
                                    <tbody>
                                       <tr>
                                            <td><img class="accordionBtn" src="/assets/media/admin/down-arrow%20(1).png" style="height:15px;width:15px"/></td>
                                            <td>1</td>
                                            <td>Tiongsan</td>
                                            <td>April 9, 2019</td>
                                            <td>April 11, 2019</td>
                                            <td>Pending</td>
                                            <td>5000</td>
                                            <td>
                                            <!--Edit button-->
                                                <button class="btn btn-primary btn-sm" data-toggle="modal"
                                                data-target="#editPO">Edit</button>
                                            <!--Delete button-->
                                                <button class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="">Delete</button>
                                            </td>
                                       </tr>
                                       <tr>
                                            <td colspan="8">
                                            <div style="margin:1% 2%">
                                                <table class="table">
                                                    <thead style="background:white">
                                                        <tr>
                                                            <th>Name</th>
                                                            <th>Qty</th>
                                                            <th>Unit</th>
                                                            <th>Price</th>
                                                            <th>Subtotal</th>
                                                            <th>Remarks</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>Milk</td>
                                                            <td>10</td>
                                                            <td>bag</td>
                                                            <td>100</td>
                                                            <td>1000</td>
                                                            <td>remarks...</td>

                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            </td>
                                       </tr>
                                    </tbody>
                                </table>
                            <!--End of Table Content-->


                            <!--Start of Modal "Add Purchase Order"-->
                                <div class="modal fade bd-example-modal-lg" id="addPO" tabindex="-1"
                                    role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Add Purchase Order</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        <!--Modal Content-->
                                            <form id="formAdd" action="<?= site_url('admin/purchaseorder/add')?>" method="post" accept-charset="utf-8">
                                                <div class="modal-body">
                                                    <div class="form-row"> <!--Container of Source. and Purchase date-->
                                                    <!--Source-->
                                                        <div class="input-group mb-3 col">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="inputGroup-sizing-sm"
                                                                    style="width:90px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                    Source</span>
                                                            </div>
                                                            <select class="form-control form-control-sm" name="" id="">
                                                                <option selected>Choose</option>
                                                            </select>
                                                        </div>
                                                    <!--Purchase date-->
                                                        <div class="input-group mb-3 col">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="inputGroup-sizing-sm"
                                                                    style="width:110px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                    Purchase Date</span>
                                                            </div>
                                                            <input type="date" name="" id="" class="form-control form-control-sm">
                                                        </div>
                                                    </div>

                                                    <div class="form-row"> <!--Container of receipt no. and transaction date-->
                                                    <!--Status-->
                                                        <div class="input-group mb-3 col">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="inputGroup-sizing-sm"
                                                                    style="width:90px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                    Status</span>
                                                            </div>
                                                            <select class="form-control form-control-sm" name="" id="">
                                                                <option selected>Choose</option>
                                                                <option>Pending</option>
                                                                <option>Delivered</option>
                                                            </select>
                                                        </div>
                                                    <!--Delivery date-->
                                                        <div class="input-group mb-3 col">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="inputGroup-sizing-sm"
                                                                    style="width:110px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                    Delivery Date</span>
                                                            </div>
                                                            <input type="date" name="" id="" class="form-control form-control-sm">
                                                        </div>
                                                    </div>

                                            <!--Transaction Items-->
                                                <!--Button to add row in the table-->
                                                    <button type="button" class="addTransItemBtn btn btn-primary btn-sm">Add Trans Item</button>
                                                    <br><br>
                                                <!--Table containing the different input fields in adding PO items -->
                                                    <table class="transItemsTable table table-sm table-borderless">
                                                        <thead class="thead-light">
                                                            <tr>
                                                                <th>Name</th>
                                                                <th width="10%">Qty</th>
                                                                <th width="15%">Unit</th>
                                                                <th width="15%">Price</th>
                                                                <th width="15%">Subtotal</th>
                                                                <th>Remarks</th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td><input type="text" name="" id="" class="form-control form-control-sm"></td>
                                                                <td><input type="number" name="" id="" class="form-control form-control-sm"></td>
                                                                <td><input type="text" name="" id="" class="form-control form-control-sm"></td>
                                                                <td><input type="number" name="" id="" class="form-control form-control-sm"></td>
                                                                <td><input type="number" name="" id="" class="form-control form-control-sm"></td>
                                                                <td><textarea type="text" name="" id="" class="form-control form-control-sm"></textarea></td>
                                                                <td><img class="exitBtn" id="exitBtn" src="/assets/media/admin/error.png" style="width:20px;height:20px"></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>

                                                <!--Total of the trans items-->
                                                    <span>Total: &#8369;<span class="total"> 0</span></span>
                                                <!--Modal Footer-->
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
                                                        <button class="btn btn-success btn-sm" type="submit">Insert</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <!--End of Modal "Add Purchase Order"-->

                            <!--Start of Modal "Add Purchase Order"-->
                                <div class="modal fade bd-example-modal-lg" id="editPO" tabindex="-1"
                                    role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Add Purchase Order</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        <!--Modal Content-->
                                            <form id="formAdd" action="<?= site_url('admin/purchaseorder/add')?>" method="post" accept-charset="utf-8">
                                                <div class="modal-body">
                                                    <div class="form-row"> <!--Container of Source. and Purchase date-->
                                                    <!--Source-->
                                                        <div class="input-group mb-3 col">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="inputGroup-sizing-sm"
                                                                    style="width:90px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                    Source</span>
                                                            </div>
                                                            <select class="form-control form-control-sm" name="" id="s">
                                                                <option selected>Choose</option>
                                                            </select>
                                                        </div>
                                                    <!--Purchase date-->
                                                        <div class="input-group mb-3 col">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="inputGroup-sizing-sm"
                                                                    style="width:110px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                    Purchase Date</span>
                                                            </div>
                                                            <input type="date" name="" id="" class="form-control form-control-sm">
                                                        </div>
                                                    </div>

                                                    <div class="form-row"> <!--Container of receipt no. and transaction date-->
                                                    <!--Status-->
                                                        <div class="input-group mb-3 col">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="inputGroup-sizing-sm"
                                                                    style="width:90px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                    Status</span>
                                                            </div>
                                                            <select class="form-control form-control-sm" name="" id="">
                                                                <option selected>Choose</option>
                                                                <option>Pending</option>
                                                                <option>Delivered</option>
                                                            </select>
                                                        </div>
                                                    <!--Delivery date-->
                                                        <div class="input-group mb-3 col">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="inputGroup-sizing-sm"
                                                                    style="width:110px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                    Delivery Date</span>
                                                            </div>
                                                            <input type="date" name="" id="" class="form-control form-control-sm">
                                                        </div>
                                                    </div>

                                            <!--Transaction Items-->
                                                <!--Button to add row in the table-->
                                                    <button type="button" class="addTransItemBtn btn btn-primary btn-sm">Add Trans Item</button>
                                                    <br><br>
                                                <!--Table containing the different input fields in adding PO items -->
                                                    <table class="transItemsTable table table-sm table-borderless">
                                                        <thead class="thead-light">
                                                            <tr>
                                                                <th>Name</th>
                                                                <th width="10%">Qty</th>
                                                                <th width="15%">Unit</th>
                                                                <th width="15%">Price</th>
                                                                <th width="15%">Subtotal</th>
                                                                <th>Remarks</th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td><input type="text" name="" id="" class="form-control form-control-sm"></td>
                                                                <td><input type="number" name="" id="" class="form-control form-control-sm"></td>
                                                                <td><input type="text" name="" id="" class="form-control form-control-sm"></td>
                                                                <td><input type="number" name="" id="" class="form-control form-control-sm"></td>
                                                                <td><input type="number" name="" id="" class="form-control form-control-sm"></td>
                                                                <td><textarea type="text" name="" id="" class="form-control form-control-sm"></textarea></td>
                                                                <td><img class="exitBtn" id="exitBtn" src="/assets/media/admin/error.png" style="width:20px;height:20px"></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>

                                                <!--Total of the trans items-->
                                                    <span>Total: &#8369;<span class="total"> 0</span></span>
                                                <!--Modal Footer-->
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
                                                        <button class="btn btn-success btn-sm" type="submit">Update</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!--End of Modal "Add Purchase Order"-->
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
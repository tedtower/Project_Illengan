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
                <?php echo date("M j, Y -l"); ?>
                <!-- Real Time Date & Time -->
            </p>
            <div class="content" style="margin-left:250px;">
                <div class="container-fluid">
                    <div class="content">
                        <div class="container-fluid">
                            <div class="card-content">

                                <!--Add button-->
                                <a class="btn btn-default btn-sm" data-toggle="modal" data-target="#addPO"
                                <br>
                                <br>
                                <!--Start of Table-->
                                <table id="poTable" class="table table-bordered dt-responsive nowrap" cellspacing="0"
                                    width="100%">
                                    <thead class="thead-light">
                                        <tr>
                                            <th style="width:10px"></th>
                                            <th><b class="pull-left">PO No.</b></th>
                                            <th><b class="pull-left">Supplier</b></th>
                                            <th><b class="pull-left">Purchased Date</b></th>
                                            <th><b class="pull-left">Expected Date</b></th>
                                            <th><b class="pull-left">Status</b></th>
                                            <th><b class="pull-left">Total</b></th>
                                            <th><b class="pull-left">Actions</b></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><img class="accordionBtn" src="/assets/media/admin/down-arrow%20(1).png" style="height:15px;width:15px"/></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>
                                                <button class="editBtn btn btn-primary btn-sm" data-toggle="modal" data-target="#editPO">Edit</button>
                                                <button class="deleteBtn btn btn-danger btn-sm" data-toggle="modal" data-target="#delete">Delete</button>
                                            </td>
                                        </tr>
                                        
                                        <tr>
                                            <td colspan="8">
                                                <div style="margin:1% 3%">
                                                    <table class="table dt-responsive nowrap">
                                                        <thead class="thead-light">
                                                            <tr>
                                                                <th>Item Name</th><!--Concat ng Product name and var size-->
                                                                <th>Unit</th>
                                                                <th>Qty</th>
                                                                <th>Price</th>
                                                                <th>Subtotal</th>
                                                            </tr>
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
                                                    </table>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <!--End of Table Content-->


                                <!--Start of Modal "Add Purchase Order"-->
                                <div class="modal fade bd-example-modal-lg" id="addPO" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                            <form id="formAdd" action="<?= site_url('admin/purchaseorder/add')?>"
                                                method="post" accept-charset="utf-8">
                                                <div class="modal-body">
                                                    <div class="form-row">
                                                        <!--Container of Source. and Purchase date-->
                                                        <!--Source-->
                                                        <div class="input-group mb-3 col">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="inputGroup-sizing-sm"
                                                                    style="width:90px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                    Supplier</span>
                                                            </div>
                                                            <select class="form-control form-control-sm"
                                                                name="poSupplier" id="poSupplier">
                                                                <option value="" selected>Choose</option>
                                                            </select>
                                                        </div>
                                                        <!--Purchase date-->
                                                        <div class="input-group mb-3 col">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="inputGroup-sizing-sm"
                                                                    style="width:110px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                    Purchase Date</span>
                                                            </div>
                                                            <input type="date" name="poDate" id="poDate"
                                                                class="form-control form-control-sm">
                                                        </div>
                                                    </div>

                                                    <div class="form-row">
                                                        <!--Container of receipt no. and transaction date-->
                                                        <!--Status-->
                                                        <div class="input-group mb-3 col">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="inputGroup-sizing-sm"
                                                                    style="width:90px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                    Status</span>
                                                            </div>
                                                            <select class="form-control form-control-sm" name="status"
                                                                id="status">
                                                                <option selected="selected">Choose</option>
                                                                <option value="pending">Pending</option>
                                                                <option value="delivered">Delivered</option>
                                                            </select>
                                                        </div>
                                                        <!--Delivery date-->
                                                        <div class="input-group mb-3 col">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="inputGroup-sizing-sm"
                                                                    style="width:110px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                    Delivery Date</span>
                                                            </div>
                                                            <input type="date" name="edDate" id="edDate"
                                                                class="form-control form-control-sm">
                                                        </div>
                                                    </div>

                                                    <!--Remarks-->
                                                    <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="inputGroup-sizing-sm"
                                                                    style="width:90px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                    Remarks</span>
                                                            </div>
                                                            <textarea class="form-control form-control-sm"></textarea>
                                                        </div>
                                                    <!--Button to add row in the table-->
                                                    <a class="btn btn-default btn-sm" data-toggle="modal" data-target="#brochure" data-original-title style="margin:0" id="addTransaction">Add Items</a>
                                                    <br><br>
                                                    <!--Table containing the different input fields in adding PO items -->
                                                    <table class="poItemsTable table table-sm table-borderless">
                                                        <thead class="thead-light">
                                                            <tr>
                                                                <th>Item Name</th>
                                                                <th width="15%">Unit</th>
                                                                <th width="10%">Qty</th>
                                                                <th width="15%">Price</th>
                                                                <th width="15%">Subtotal</th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <input type="hidden" name="">
                                                                <td><input type="text" name="itemName"
                                                                        class="form-control form-control-sm"></td>
                                                                <td><input type="number" name="itemQty"
                                                                        class="form-control form-control-sm"></td>
                                                                <td><input type="text" name="itemUnit"
                                                                        class="form-control form-control-sm"></td>
                                                                <td><input type="number" name="itemPrice"
                                                                        class="form-control form-control-sm"></td>
                                                                <td><input type="number" name="itemSubtotal"
                                                                        class="form-control form-control-sm"></td>
                                                                <td><img class="exitBtn" id="exitBtn"
                                                                        src="/assets/media/admin/error.png"
                                                                        style="width:20px;height:20px"></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>

                                                    <!--Total of the trans items-->
                                                    <span>Total: &#8369;<span class="total"> 0</span></span>
                                                    <!--Modal Footer-->
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger btn-sm"
                                                            data-dismiss="modal">Cancel</button>
                                                        <button class="btn btn-success btn-sm"
                                                            type="submit">Add</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!--End of Modal "Add Purchase Order"-->

                                <!--Start of Modal "Add Purchase Order"-->
                                 <div class="modal fade bd-example-modal-lg" id="editPO" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Update Purchase Order</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <!--Modal Content-->
                                            <form id="formAdd" action="<?= site_url('admin/purchaseorder/add')?>"
                                                method="post" accept-charset="utf-8">
                                                <div class="modal-body">
                                                    <div class="form-row">
                                                        <!--Container of Source. and Purchase date-->
                                                        <!--Source-->
                                                        <div class="input-group mb-3 col">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="inputGroup-sizing-sm"
                                                                    style="width:90px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                    Supplier</span>
                                                            </div>
                                                            <select class="form-control form-control-sm"
                                                                name="poSupplier" id="poSupplier">
                                                                <option value="" selected>Choose</option>
                                                            </select>
                                                        </div>
                                                        <!--Purchase date-->
                                                        <div class="input-group mb-3 col">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="inputGroup-sizing-sm"
                                                                    style="width:110px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                    Purchase Date</span>
                                                            </div>
                                                            <input type="date" name="poDate" id="poDate"
                                                                class="form-control form-control-sm">
                                                        </div>
                                                    </div>

                                                    <div class="form-row">
                                                        <!--Container of receipt no. and transaction date-->
                                                        <!--Status-->
                                                        <div class="input-group mb-3 col">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="inputGroup-sizing-sm"
                                                                    style="width:90px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                    Status</span>
                                                            </div>
                                                            <select class="form-control form-control-sm" name="status"
                                                                id="status">
                                                                <option selected="selected">Choose</option>
                                                                <option value="pending">Pending</option>
                                                                <option value="delivered">Delivered</option>
                                                            </select>
                                                        </div>
                                                        <!--Delivery date-->
                                                        <div class="input-group mb-3 col">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="inputGroup-sizing-sm"
                                                                    style="width:110px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                    Delivery Date</span>
                                                            </div>
                                                            <input type="date" name="edDate" id="edDate"
                                                                class="form-control form-control-sm">
                                                        </div>
                                                    </div>

                                                    <!--Remarks-->
                                                    <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="inputGroup-sizing-sm"
                                                                    style="width:110px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                    Remarks</span>
                                                            </div>
                                                            <textarea class="form-control form-control-sm"></textarea>
                                                        </div>
                                                    <!--Button to add row in the table-->
                                                    <a class="btn btn-default btn-sm" data-toggle="modal" data-target="#brochure" data-original-title style="margin:0" id="addTransaction">Add Items</a>
                                                    <br><br>
                                                    <!--Table containing the different input fields in adding PO items -->
                                                    <table class="poItemsTable table table-sm table-borderless">
                                                        <thead class="thead-light">
                                                            <tr>
                                                                <th>Item Name</th>
                                                                <th width="15%">Unit</th>
                                                                <th width="10%">Qty</th>
                                                                <th width="15%">Price</th>
                                                                <th width="15%">Subtotal</th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <input type="hidden" name="">
                                                                <td><input type="text" name="itemName"
                                                                        class="form-control form-control-sm"></td>
                                                                <td><input type="number" name="itemQty"
                                                                        class="form-control form-control-sm"></td>
                                                                <td><input type="text" name="itemUnit"
                                                                        class="form-control form-control-sm"></td>
                                                                <td><input type="number" name="itemPrice"
                                                                        class="form-control form-control-sm"></td>
                                                                <td><input type="number" name="itemSubtotal"
                                                                        class="form-control form-control-sm"></td>
                                                                <td><img class="exitBtn" id="exitBtn"
                                                                        src="/assets/media/admin/error.png"
                                                                        style="width:20px;height:20px"></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>

                                                    <!--Total of the trans items-->
                                                    <span>Total: &#8369;<span class="total"> 0</span></span>
                                                    <!--Modal Footer-->
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger btn-sm"
                                                            data-dismiss="modal">Cancel</button>
                                                        <button class="btn btn-success btn-sm"
                                                            type="submit">Update</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!--End of Modal "Edit Purchase Order"-->

                             <!--Start of Brochure Modal"-->
                                <div class="modal fade bd-example-modal" id="brochure" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="background:rgba(0, 0, 0, 0.3)">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Select Stock Item</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form id="formAdd" action="<?= site_url('admin/transactions/add')?>" method="post" accept-charset="utf-8">
                                                <div class="modal-body">
                                                    <div style="margin:1% 3%">
                                                    <!--checkboxes-->
                                                        <label style="width:96%"><input type="checkbox" class="mr-2" value="">Sample data 1</label>
                                                        <label style="width:96%"><input type="checkbox" class="mr-2" value="">Sample data 2</label>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
                                                        <button class="btn btn-success btn-sm" type="submit">Ok</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <!--End of Brochure Modal"-->

                            <!--Start of Modal "Delete Stock Item"-->
                                <div class="modal fade" id="delete" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Delete Purchase Order</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form id="confirmDelete">
                                                <div class="modal-body">
                                                    <h6 id="deleteTableCode"></h6>
                                                    <p>Are you sure you want to delete this item?</p>
                                                    <input type="text" name="" hidden="hidden">
                                                    <div>
                                                        Remarks:<input type="text" name="deleteRemarks" id="deleteRemarks"
                                                            class="form-control form-control-sm">
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary btn-sm"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <!--End of Modal "Delete Stock Item"-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include_once('templates/scripts.php') ?>
</body>
<!-- <script>
var lastIndex = 0;
var pos = <?= json_encode($pos)?>;
var rowsPerPage = pos.pos.length;

$(function() {
    $("#addPOBtn").on('click', function()) {
        unsetModal($("#addPO"));
    }
    setTableDate();
    $("#formAdd").on('submit', function() {
        var supplier = $(this).find("select[name='poSupplier']");
        var poDate = $(this).find("input[name='poDate']");
        var edDate = $(this).find("input[name='edDate']");
        var status = $(this).find("select[name='status']");
        var poItems = [];
        for (var index = 0; index < $("#formAdd .poItemsTable > tbody").children().length; index++) {
            poItems.push({
                itemName : $(this).find("input[name='itemName[]']").val(),
                itemQty : $(this).find("input[name='itemQty[]']").val(),             
                itemUnit : $(this).find("input[name='itemUnit[]']").val(),
                itemPrice : $(this).find("input[name='itemPrice[]']").val(),
                remarks : $(this).find("textarea[name='remarks[]']").val()
            });
        }
        $.ajax({
            method : "post",
            url: "<?= site_url('admin/purchaseorders/add')?>",
            data : {
                poSupplier : supplier,
                poDate : poDate,
                edDate : edDate,
                poStatus : status,
                poItems : JSON.stringify(poItems)
            },
            dataType : "json",
            success: function(data){

            },
            error : function(response, setting, error){
                console.log(response.responseText);
                console.log(error);
            },
            complete : function(){

            }
        });
    });
    $("#formEdit").on('submit', function() {
        var poID = $(this).find("input[name='poID']");
        var supplier = $(this).find("select[name='poSupplier']");
        var poDate = $(this).find("input[name='poDate']");
        var edDate = $(this).find("input[name='edDate']");
        var status = $(this).find("select[name='status']");
        var poItems = [];
        for (var index = 0; index < $("#formEdit .poItemsTable > tbody").children().length; index++) {
            poItems.push({
                itemName : $(this).find("input[name='itemName[]']").val(),
                itemQty : $(this).find("input[name='itemQty[]']").val(),             
                itemUnit : $(this).find("input[name='itemUnit[]']").val(),
                itemPrice : $(this).find("input[name='itemPrice[]']").val(),
                remarks : $(this).find("textarea[name='remarks[]']").val()
            });
        }
        $.ajax({
            method : "post",
            url: "<?= site_url('admin/purchaseorders/edit')?>",
            data : {
                poID : poID,
                poSupplier : supplier,
                poDate : poDate,
                edDate : edDate,
                poStatus : status,
                poItems : JSON.stringify(poItems)
            },
            dataType : "json",
            success: function(data){

            },
            error : function(response, setting, error){
                console.log(response.responseText);
                console.log(error);
            },
            complete : function(){

            }
        });
    });

});

function setTableData() {
    var count = 0;
    if ($("#poTable > tbody").children().length === 0) {
        for (lastIndex; lastIndex < pos.pos.length; lastIndex++) {
            if (!(count < rowsPerPage) {} else {
                    appendRow(pos.pos[lastIndex]);
                    appendAccordion(pos.pos[lastIndex].po_id);
                }
            }
            $(".editBtn").on('click', function() {
                $("#editPO form")[0].reset();
                var poID = $(this).closest("tr").attr("data-id");
                setEditModal($("#editPO"), pos.pos.filter(po => po.po_id === poID)[0], pos.poItems.filter(po =>
                    po_id === poID));
            });
            $(".accordionBtn").on('click', function() {
                if ($(this).closest("tr").next("tr").css('display') === 'none') {
                    $(this).closest("tr").next("tr").show();
                    $(this).closest("tr").next("tr").find("td > div").slideDown("slow");
                } else {
                    $(this).closest("tr").next("tr").find("td > div").slideUp("slow");
                    $(this).closest("tr").next("tr").hide("slow");
                }
            });
        } else {
            $("#poTable stockTable > tbody").empty();
        }
    }

    function appendRow(po) {
        var row = `
    <tr data-id="${po.poID}">
        <td><img class="accordionBtn" src="/assets/media/admin/down-arrow%20(1).png" style="height:15px;width:15px"/></td>
        <td>${po.poID}</td>
        <td>${po.spName}</td>
        <td>${po.poDate}</td>
        <td>${po.edDate}</td>
        <td>${po.poStatus}</td>
        <td>${po.poTotal}</td>
        <td>
        <!-Edit button-->
            <!-- <button class="editBtn btn btn-primary btn-sm" data-toggle="modal"
            data-target="#editPO">Edit</button> -->
        <!--Delete button-->
            <!-- <button class="deleteBtn btn btn-danger btn-sm" data-toggle="modal"
            data-target="">Delete</button> -->
        <!-- </td>
    </tr>
    `;
        $("#poTable > tbody").append(row);
    } -->

    <!-- function appendAccordion(poID) {
        var items = pos.poItems.filter(item => item.po_id === poID);
        var row = `
    <tr style="display:none">
        <td colspan="8">
        <div style="margin:1% 2%;display:none">
        ${items.length === 0 : "No items recorded!" : `
            <span>Date Recorded: <span></span></span>
            <table class="table">
                <thead style="background:white">
                    <tr>
                        <th>Item Name</th>
                        <th>Unit</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Subtotal</th>
                        <th>Remarks</th>
                    </tr>
                </thead>
                <tbody>
                ${items.map(item => {
                    return `
                    <tr>
                        <td>${item.item_name}</td>
                        <td>${item.item_qty}</td>
                        <td>${item.item_unit}</td>
                        <td>${item.item_price}</td>
                        <td>${parseFloat(item.item_price)*parseInt(item.item_qty)}</td>
                        <td>${item.remarks}</td>
                    </tr>
                    `
                }).join('')}
                </tbody>
            </table>
        `}
        </div>
        </td>
    </tr>
    `;
        $("#poTable > tbody").append(row);
    }

    function unsetModal(modal) {
        modal.find("form")[0].reset();
        modal.find(".poItemsTable >tbody").empty();
    }

    function setEditModal(modal, po, poItems) {
        modal.find("input[name='poID']").val(po.po_id);
        modal.find("select[name='poSupplier']").find(`option[value=${po.source_id}]`).attr("selected", "selected");
        modal.find("input[name='poDate']").val(po.po_date);
        modal.find("select[name='status']").find(`option[value='${po.po_status}']`).attr("selected", "selected");
        modal.find("input[name='edDate']").val(po.ed_date);
        modal.find(".poItemsTable > tbody").append(`
    ${ poItems.length === 0 ? "" : poItems.map(item => {
        return `<tr>
                <td><input type="text" name="itemName[]" value="${item.item_name}" class="form-control form-control-sm"></td>
                <td><input type="number" name="itemQty[]" value="${item.item_qty}" class="form-control form-control-sm"></td>
                <td><input type="text" name="itemUnit[]" value="${item.item_unit}" class="form-control form-control-sm"></td>
                <td><input type="number" name="itemPrice[]" value="${item.item_price}" class="form-control form-control-sm"></td>
                <td><input type="number" name="itemSubtotal[]"  value="${parseFloat(item.item_price)*parseInt(item.item_qty)}" class="form-control form-control-sm"></td>
                <td><textarea type="text" name="remarks[]" class="form-control form-control-sm">${item.remarks}</textarea></td>
                <td><img class="exitBtn" src="/assets/media/admin/error.png" style="width:20px;height:20px"></td>
            </tr>
            `
        }).join('')
    }`);
    } 
</script> -->

</html>

<body style="background: white">
<div class="content">
    <div class="container-fluid">
        <br>
        <p style="text-align:right; font-weight: regular; font-size: 16px">
            <!-- Real Time Date & Time -->
            <?php echo date("M j, Y -l"); ?>
        </p>
        <div class="content" style="margin-left:250px">
                <!--Table-->
                <div class="container-fluid">
                <div class="card-content">
                    <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#newStock" data-original-title
                        style="margin:0;color:blue" id="addBtn">Add Stock Item</a>
                    <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#restock" data-original-title
                        style="margin:0;color:blue" id="addBtn">Restock</a>
                    <br><br>
                    <table id="stockTable" class="table table-bordered dt-responsive nowrap" cellspacing="0" width="100%" >
                        <thead class="thead-dark">
                            <tr>
                                <th><b class="pull-left">Stock Name</b></th>
                                <th><b class="pull-left">Category</b></th>
                                <th><b class="pull-left">Quantity</b></th>
                                <th><b class="pull-left">Min Qty</b></th>
                                <th><b class="pull-left">Unit</b></th>
                                <th><b class="pull-left">Status</b></th>
                                <th><b class="pull-left">Storage</b></th>
                                <th><b class="pull-left">Action</b></th>
                            </tr>

                        </thead>
                        <tbody>
                            <?php foreach($inventory['stocks'] as $stock){?>
                            <tr data-id="<?= $stock['stID']?>">
                                <td><?= $stock['stName']?></td>
                                <td><?= $stock['ctName']?></td>
                                <td><?= $stock['stQty']?></td>
                                <td><?= $stock['stMin']?></td>
                                <td><?= $stock['uomAbbreviation']?></td>
                                <td><?= $stock['stStatus']?></td>
                                <td><?= $stock['stLocation']?></td>
                                <td>
                                    <button class="btn btn-default btn-sm">Edit</button>
                                    <button class="btn btn-warning btn-sm">Archived</button>
                                    <button class="btn btn-success btn-sm">Stock Card</button>
                                </td>
                                <?php } ?>
                            </tr>
                        </tbody>
                    </table>
                    <p id="note"></p>
                <!--Start of Modal "Restock Item"-->
                    <div class="modal fade bd-example-modal-lg" id="restock" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Restock Item</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="<?php echo base_url('admin/inventory/add')?>" method="get"
                                    accept-charset="utf-8">
                                    <div class="modal-body">
                                        <!--Add Stock Item-->
                                        <a class="btn btn-primary btn-sm" style="color:blue;margin:0"
                                            data-toggle="modal" data-target="#brochure">Add Item</a>
                                        <!--Button to add row in the table-->
                                        <br><br>
                                        <table class="varianceTable table table-sm table-borderless">
                                            <!--Table containing the different input fields in adding trans items -->
                                            <thead style="border-bottom:2px solid #cecece">
                                                <tr class="text-center">
                                                    <th><b>Stock Name</b></th>
                                                    <th><b>Unit</b></th>
                                                    <th><b>Current Qty</b></th>
                                                    <th><b>Restock Qty</b></th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><input type="text" name="stockName[]"
                                                            class="form-control form-control-sm"></td>
                                                    <td><input type="text" name="stockUnit[]"
                                                            class="form-control form-control-sm"></td>
                                                    <td><input type="number" name="currentQty[]"
                                                            class="form-control form-control-sm"></td>
                                                    <td><input type="number" name="restockQty[]"
                                                            class="form-control form-control-sm"></td>
                                                    <td><img class="exitBtn" src="/assets/media/admin/error.png"
                                                        style="width:20px;height:20px"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger btn-sm"
                                                data-dismiss="modal">Cancel</button>
                                            <button class="btn btn-success btn-sm" type="submit">Insert</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--End of Modal "Retock item"-->

                    <!--Start of Brochure Modal"-->
                    <div class="modal fade bd-example-modal" id="brochure" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true" style="background:rgba(0, 0, 0, 0.3)">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Select Stock Item</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form id="formAdd" action="<?= site_url('admin/transactions/add')?>" method="post"
                                    accept-charset="utf-8">
                                    <div class="modal-body">
                                        <div style="margin:1% 3%">
                                            <!--checkboxes-->
                                            <label style="width:96%"><input type="checkbox" class="mr-2" value="">Sample
                                                data 1</label>
                                            <label style="width:96%"><input type="checkbox" class="mr-2" value="">Sample
                                                data 2</label>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger btn-sm"
                                            data-dismiss="modal">Cancel</button>
                                        <button class="btn btn-success btn-sm" type="submit">Ok</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--End of Brochure Modal"-->

                    <!--Start of Modal "Add Stock Item"-->
                    <div class="modal fade bd-example-modal-lg" id="newStock" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add Stock Item</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="<?php echo base_url('admin/inventory/add')?>" method="get"
                                    accept-charset="utf-8">
                                    <div class="modal-body" style="margin:1%;">
                                        <div class="form-row">
                                            <!--Stock name-->
                                            <div class="input-group mb-3 col">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroup-sizing-sm"
                                                        style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                        Stock Name</span>
                                                </div>
                                                <input type="text" name="stockName" id="stockName"
                                                    class="form-control form-control-sm">
                                            </div>
                                            <!--Stock Type-->
                                            <div class="input-group mb-3 col">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroup-sizing-sm"
                                                        style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                        Type</span>
                                                </div>
                                                <select name="stockType" class="form-control">
                                                    <option value="" selected>Choose</option>
                                                    <option value="liquid">Liquid</option>
                                                    <option value="solid">Solid</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <!--Stock size-->
                                            <div class="input-group mb-3 col">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">Size</span>
                                                </div>
                                                <input type="text" name="stockSize" class="form-control">
                                                <select class="form-control" name="stockUOM" style="border-left:1px solid whitesmoke">
                                                    <option value="">Choose Unit</option>
                                                    <option value=""></option>
                                                </select>
                                            </div>
                                            <!--Stock Storage-->
                                            <div class="input-group mb-3 col">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroup-sizing-sm"
                                                        style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                        Storage</span>
                                                </div>
                                                <select name="stockStorage" class="form-control">
                                                    <option value="" selected>Choose</option>
                                                    <option value=""></option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <!--Category-->
                                            <div class="input-group mb-3 col">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroup-sizing-sm"
                                                        style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                        Category</span>
                                                </div>
                                                <select name="stockCategory" class="form-control">
                                                    <option value="" selected>Choose</option>
                                                    <option value=""></option>
                                                </select>
                                            </div>
                                            <!--Status-->
                                            <div class="input-group mb-3 col">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroup-sizing-sm"
                                                        style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                        Status</span>
                                                </div>
                                                <select name="stockStatus" class="form-control">
                                                    <option value="" selected>Choose</option>
                                                    <option value="available">Available</option>
                                                    <option value="unavailable">Unavailable</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <!--Quantity-->
                                            <div class="input-group mb-3 col">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroup-sizing-sm"
                                                        style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                        Quantity</span>
                                                </div>
                                                <input type="number" name="stockQty" class="form-control">
                                            </div>
                                            <!--Min Quantity-->
                                            <div class="input-group mb-3 col">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroup-sizing-sm"
                                                        style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                        Min Qty</span>
                                                </div>
                                                <input type="number" name="stockMinQty" class="form-control">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger btn-sm"
                                            data-dismiss="modal">Cancel</button>
                                        <button class="btn btn-success btn-sm" type="submit">Add</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--End of Modal "Add Stock item"-->

                    <!--Start of Modal "Edit Stock Item"-->
                    <div class="modal fade bd-example-modal-lg" id="newStock" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit Stock Item</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="<?php echo base_url('admin/inventory/edit')?>" method="get"
                                    accept-charset="utf-8">
                                    <div class="modal-body" style="margin:1%;">
                                        <div class="form-row">
                                            <!--Stock name-->
                                            <div class="input-group mb-3 col">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroup-sizing-sm"
                                                        style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                        Stock Name</span>
                                                </div>
                                                <input type="text" name="stockName" id="stockName"
                                                    class="form-control form-control-sm">
                                            </div>
                                            <!--Stock size-->
                                            <div class="input-group mb-3 col">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="">Size</span>
                                                </div>
                                                <input type="text" name="stockSize" class="form-control">
                                                <select class="form-control" name="stockUOM" style="border-left:1px solid whitesmoke">
                                                    <option value="">Choose Unit</option>
                                                    <option value=""></option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <!--Quantity-->
                                            <div class="input-group mb-3 col">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroup-sizing-sm"
                                                        style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                        Quantity</span>
                                                </div>
                                                <input type="number" name="stockQty" class="form-control">
                                            </div>
                                            <!--Min Quantity-->
                                            <div class="input-group mb-3 col">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroup-sizing-sm"
                                                        style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                        Min Qty</span>
                                                </div>
                                                <input type="number" name="stockMinQty" class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <!--Category-->
                                            <div class="input-group mb-3 col">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroup-sizing-sm"
                                                        style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                        Category</span>
                                                </div>
                                                <select name="stockCategory" class="form-control">
                                                    <option value="" selected>Choose</option>
                                                    <option value=""></option>
                                                </select>
                                            </div>
                                            <!--Status-->
                                            <div class="input-group mb-3 col">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroup-sizing-sm"
                                                        style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                        Status</span>
                                                </div>
                                                <select name="stockStatus" class="form-control">
                                                    <option value="" selected>Choose</option>
                                                    <option value="available">Available</option>
                                                    <option value="unavailable">Unavailable</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <!--Stock Type-->
                                            <div class="input-group mb-3 col">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroup-sizing-sm"
                                                        style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                        Type</span>
                                                </div>
                                                <select name="stockType" class="form-control">
                                                    <option value="" selected>Choose</option>
                                                    <option value="liquid">Liquid</option>
                                                    <option value="solid">Solid</option>
                                                </select>
                                            </div>
                                            <!--Stock Storage-->
                                            <div class="input-group mb-3 col">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroup-sizing-sm"
                                                        style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                        Storage</span>
                                                </div>
                                                <select name="stockStorage" class="form-control">
                                                    <option value="" selected>Choose</option>
                                                    <option value=""></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger btn-sm"
                                            data-dismiss="modal">Cancel</button>
                                        <button class="btn btn-success btn-sm" type="submit">Insert</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--End of Modal "Edit Stock Item"-->

                    <!--Start of Modal "Delete Stock Item"-->
                    <div class="modal fade" id="deleteStock" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Delete Stock Item</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form id="confirmDelete">
                                    <div class="modal-body">
                                        <h6 id="deleteTableCode"></h6>
                                        <p>Are you sure you want to delete this stock item?</p>
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

<script>
var inventory = <?= json_encode($inventory)?>;
var lastIndex = 0;
var rowsPerPage = inventory.stocks.length;
$(document).ready(function() {
    $(".accordionBtn").on('click', function() {
        if ($(this).closest("tr").next(".accordion").css("display") == 'none') {
            $(this).closest("tr").next(".accordion").css("display", "table-row");
            $(this).closest("tr").next(".accordion").find("td > div").slideDown("slow");
        } else {
            $(this).closest("tr").next(".accordion").find("td > div").slideUp("slow");
            $(this).closest("tr").next(".accordion").hide("slow");
        }
    });
    $("#newStock").find("select[name='stockCategory']").append(`
    ${inventory.categories.map(category => {
        return `<option value="${category.ctID}">${category.ctName}</option>`
    }).join('')}`);
    $("#editStock").find("select[name='stockCategory']").append(`
    ${inventory.categories.map(category => {
        return `<option value="${category.ctID}">${category.ctName}</option>`
    }).join('')}`);
    console.log(inventory);
    $("#addBtn").on('click', function() {
        $("#newStock form")[0].reset();
        console.log(inventory);
    });
    $(".editBtn").on("click", function() {
        $("#editStock form")[0].reset();
        var id = $(this).closest("tr").attr("data-id")
        $.ajax({
            method : 'post',
            url : '<?=site_url('admin/inventory/getitem')?>',
            data : {
                id : id
            },
            dataType : "json",
            success : function (data){
                console.log(data);
                $("#editStock .varianceTable > tbody").empty();
                setEditModal($("#editStock"), data.stock[0], data.variances);
            },
            error : function(response, setting, error){
                console.log(response.responseText);
            }
        });
    });
    $(".addItemVarianceBtn").on('click', function() {
        var row = `
        <tr data-id="">
            <td><input type="text" name="varUnit[]"
                    class="form-control form-control-sm"></td>
            <td><input type="text" name="varSize[]"
                    class="form-control form-control-sm"></td>
            <td><input type="number" name="varMinimum[]"
                    class="form-control form-control-sm"></td>
            <td><input type="number" name="varQty[]"
                    class="form-control form-control-sm"></td>
            <td>
                <select class="form-control" name="varStatus[]">
                    <option value="" selected>Choose</option>
                    <option value="available">available</option>
                    <option value="unavailable">unavailable</option>
                </select>
            </td>
            <td><img class="exitBtn"
                    src="/assets/media/admin/error.png"
                    style="width:20px;height:20px"></td>
        </tr>
        `;
        $(this).closest(".modal").find(".varianceTable > tbody").append(row);
        $(this).closest(".modal").find(".exitBtn").last().on('click', function() {
            $(this).closest("tr").remove();
        });
    });
    // setTableData();
    $("#newStock form").on('submit', function(event) {
        event.preventDefault();
        var name = $(this).find("input[name='stockName']").val();
        var type = $(this).find("select[name='stockType']").val();
        var category = $(this).find("select[name='stockCategory']").val();
        var status = $(this).find("select[name='stockStatus']").val();
        var storage = $(this).find("select[name='stockStorage']").val();
        var min = $(this).find("input[name='stockMinQty']").val();
        var qty = $(this).find("input[name='stockQty']").val();
        var uom = $(this).find("select[name='stockUOM']").val();
        var size = ;
        $.ajax({
            url: "<?= site_url("admin/inventory/add")?>",
            method: "post",
            data: {
                name: name,
                type: type,
                category: category,
                status: status,
                variances: JSON.stringify(stockVariances)
            },
            dataType: "json",
            beforeSend: function() {
                console.log(name, type, category, status, stockVariances);
            },
            success: function(data) {
                console.log(data);
                // inventory = data;
                // lastIndex = 0;
                // setTableData();
            },
            error: function(response, setting, error) {
                console.log(response.responseText);
                console.log(error);
            },
            complete: function() {
                $("#newStock").modal("hide");
            }
        });
    });

    $("#editStock form").on('submit', function(event) {
        event.preventDefault();
        var id = $(this).find("input[name='stockID']").val();
        var name = $(this).find("input[name='stockName']").val();
        var type = $(this).find("select[name='stockType']").val();
        var category = $(this).find("select[name='stockCategory']").val();
        var status = $(this).find("select[name='stockStatus']").val();
        var stockVariances = [];
        for (var index = 0; index < $(this).find(".varianceTable > tbody").children().length; index++) {
            var row = $(this).find(".varianceTable > tbody > tr").eq(index);
            stockVariances.push({
                varID: isNaN(parseInt(row.attr('data-id'))) ? (null) : parseInt(row.attr(
                    'data-id')),
                varUnit: row.find("input[name='varUnit[]']").val(),
                varSize: row.find("input[name='varSize[]']").val(),
                varMin: parseInt(row.find("input[name='varMinimum[]']").val()),
                varQty: parseInt(row.find("input[name='varQty[]']").val()),
                varStatus: row.find("select[name='varStatus[]']").val()
            });
        }
        console.log(id, name, type, category, status, stockVariances);
        $.ajax({
            url: "<?= site_url("admin/inventory/edit")?>",
            method: "post",
            data: {
                id: id,
                name: name,
                type: type,
                category: category,
                status: status,
                variances: JSON.stringify(stockVariances)
            },
            dataType: "json",
            beforeSend: function() {
                console.log(name, type, category, status, stockVariances);
            },
            success: function(data) {
                console.log(data);
                // inventory = data;
                // lastIndex = 0;
                // setTableData();
            },
            error: function(response, setting, error) {
                console.log(response.responseText);
                console.log(error);
            },
            complete: function() {
                $("#newStock").modal("hide");
            }
        });
    });
});

function setEditModal(modal, stock, variances) {
    console.log(stock);
    modal.find("input[name='stockID']").val(stock.stID);
    modal.find("input[name='stockName']").val(stock.stName);
    modal.find("select[name='stockType']").val(stock.stType);
    modal.find("select[name='stockCategory']").find(`option[value=${stock.ctID}]`).attr("selected", "selected");
    modal.find("select[name='stockStatus']").find(`option[value="${stock.stStatus}"]`).attr("selected", "selected");

    variances.forEach(variance => {
        modal.find(".varianceTable > tbody").append(`
        <tr data-id="${variance.vID}">
            <td><input type="text" name="varUnit[]" value="${variance.vUnit}"
                    class="form-control form-control-sm"></td>
            <td><input type="text" name="varSize[]" value="${variance.vSize}"
                    class="form-control form-control-sm"></td>
            <td><input type="number" name="varMinimum[]" value="${variance.vMin}"
                    class="form-control form-control-sm"></td>
            <td><input type="number" name="varQty[]" value="${variance.vQty}"
                    class="form-control form-control-sm"></td>
            <td>
                <select class="form-control" name="varStatus[]">
                    <option value="" selected>Choose</option>
                    <option value="available">available</option>
                    <option value="unavailable">unavailable</option>
                </select>
            </td>
            <td><img class="exitBtn"
                    src="/assets/media/admin/error.png"
                    style="width:20px;height:20px"></td>
        </tr>
        `);
        modal.find("select[name='varStatus[]']").last().find(`option[value='${variance.vStatus}']`).attr(
            "selected", "selected");
    });
}
</script>
</body>
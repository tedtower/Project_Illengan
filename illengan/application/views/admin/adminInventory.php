<div class="content">
    <div class="container-fluid">
        <br>
        <p style="text-align:right; font-weight: regular; font-size: 16px">
            <!-- Real Time Date & Time -->
            <?php echo date("M j, Y -l"); ?>
        </p>
        <div class="content" style="margin-left:250px;">
            <div class="container-fluid">
                <!--Table-->
                <div class="card-content">
                    <a class="btn btn-default btn-sm" data-toggle="modal" data-target="#newStock" data-original-title
                        style="margin:0;" id="addBtn">Add Stock Item</a>
                    <a class="btn btn-default btn-sm" data-toggle="modal" data-target="#restock" data-original-title
                        style="margin:0;" id="addBtn">Restock</a>
                    <br><br>
                    <table id="stockTable" class="table table-striped table-bordered dt-responsive nowrap"
                        cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th></th>
                                <th><b class="pull-left">Item Name</b></th>
                                <th><b class="pull-left">Category</b></th>
                                <th><b class="pull-left">Quantity</b></th>
                                <th><b class="pull-left">Type</b></th>
                                <th><b class="pull-left">Status</b></th>
                                <th><b class="pull-left">Action</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($inventory['stocks'] as $stock){?>
                            <tr data-id="<?= $stock['stID']?>">
                                <td><img class="accordionBtn" src="/assets/media/admin/down-arrow%20(1).png"
                                        style="height:15px;width:15px" /></td>
                                <td><?= $stock['stName']?></td>
                                <td><?= $stock['ctName']?></td>
                                <td><?= $stock['stQty']?></td>
                                <td><?= $stock['stType']?></td>
                                <td><?= $stock['stStatus']?></td>
                                <td>
                                    <button class="editBtn btn btn-primary btn-sm" data-toggle="modal"
                                        data-target="#editStock">Edit</button>
                                    <button class="deleteBtn btn btn-danger btn-sm" data-toggle="modal"
                                        data-target="#deleteStock">Delete</button>
                                </td>
                            </tr>

                            <tr class="accordion" style="display:none">
                                <td colspan="7">
                                    <div style="margin:1% 4%;overflow:auto;display:none">
                                        <div>
                                            <span>Variances</span>
                                            <table class="table table-bordered dt-responsive nowrap">
                                                <thead style="background:white">
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Unit</th>
                                                        <th>Size</th>
                                                        <th>Beginning Qty</th>
                                                        <th>Minimum Qty</th>
                                                        <th>Qty</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php foreach($inventory['variances'] as $variance){ 
                                                    if($variance['stID'] == $stock['stID']){
                                                    ?>
                                                    <tr> 
                                                        <td><?=$variance['vName']?></td>
                                                        <td><?=$variance['vUnit']?></td>
                                                        <td><?=$variance['vSize']?></td>
                                                        <td><?=$variance['bQty']?></td>
                                                        <td><?=$variance['vMin']?></td>
                                                        <td><?=$variance['vQty']?></td>
                                                        <td><?=$variance['vStatus']?></td>
                                                    </tr>
                                                <?php }
                                                } ?>
                                                </tbody>
                                            </table>
                                        </div>

                                        <div style="overflow:auto">
                                            <!--Consumed table-->
                                            <div style="width:30%;float:left">
                                                <span>Consumed</span>
                                                <table class="table table-bordered">
                                                    <thead style="background:#4CAF50">
                                                        <tr>
                                                            <th style="color:white">Qty</th>
                                                            <th style="color:white">Date</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr style="background:white">
                                                            <td>3</td>
                                                            <td>February 2, 2019</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <!--Spoilages table-->
                                            <div style="width:30%;float:left;margin:0 5%">
                                                <span>Spoilages</span>
                                                <table class="table table-bordered">
                                                    <thead style="background:#ff6600">
                                                        <tr>
                                                            <th style="color:white">Qty</th>
                                                            <th style="color:white">Date</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr style="background:white">
                                                            <td>3</td>
                                                            <td>February 3, 2019</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <!--Returns table-->
                                            <div style="width:30%;float:left">
                                                <span>Returns</span>
                                                <table class="table table-bordered">
                                                    <thead style="background:#3366ff">
                                                        <tr>
                                                            <th style="color:white">Qty</th>
                                                            <th style="color:white">Date</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr style="background:white">
                                                            <td>1</td>
                                                            <td>February 4, 2019</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php } ?>
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
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>Unit</th>
                                                    <th>Size</th>
                                                    <th>Minimum</th>
                                                    <th>Qty</th>
                                                    <th style="width:27%">Status</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
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
                                    <div class="modal-body">
                                        <div class="form-row">
                                            <!--Container of promo name and promo type-->
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
                                            <!--Stock type-->
                                            <div class="input-group mb-3 col">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroup-sizing-sm"
                                                        style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                        Stock Type</span>
                                                </div>
                                                <select class="form-control" name="stockType" id="stockType">
                                                    <option value="" selected>Choose</option>
                                                    <option value="liquid">Liquid</option>
                                                    <option value="solid">Solid</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <!--Container of start date and end date-->
                                            <!--Category-->
                                            <div class="input-group mb-3 col">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroup-sizing-sm"
                                                        style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                        Category</span>
                                                </div>
                                                <select name="stockCategory" class="form-control">
                                                    <option value="" selected>Choose</option>
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
                                        <!--Add Stock Item-->
                                        <a class="addItemVarianceBtn btn btn-primary btn-sm"
                                            style="color:blue;margin:0">Add Item Variance</a>
                                        <!--Button to add row in the table-->
                                        <br><br>
                                        <table class="varianceTable table table-sm table-borderless">
                                            <!--Table containing the different input fields in adding trans items -->
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>Unit</th>
                                                    <th>Size</th>
                                                    <th>Minimum</th>
                                                    <th>Qty</th>
                                                    <th style="width:27%">Status</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
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
                    <!--End of Modal "Add Stock item"-->

                    <!--Start of Modal "Edit Stock Item"-->
                    <div class="modal fade bd-example-modal-lg" id="editStock" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Update Stock Item</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="<?php echo base_url('admin/inventory/edit')?>" method="get"
                                    accept-charset="utf-8">
                                    <div class="modal-body">
                                        <div class="form-row">
                                            <input type="text" name="stockID" class="form-control form-control-sm"
                                                hidden="hidden">
                                            <!--Container of promo name and promo type-->
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
                                            <!--Stock type-->
                                            <div class="input-group mb-3 col">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroup-sizing-sm"
                                                        style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                        Stock Type</span>
                                                </div>
                                                <select class="form-control" name="stockType" id="stockType">
                                                    <option value="" selected>Choose</option>
                                                    <option value="liquid">Liquid</option>
                                                    <option value="solid">Solid</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <!--Container of start date and end date-->
                                            <!--Category-->
                                            <div class="input-group mb-3 col">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroup-sizing-sm"
                                                        style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                        Category</span>
                                                </div>
                                                <select class="form-control" name="stockCategory">
                                                    <option value="" selected>Choose</option>
                                                </select>
                                            </div>
                                            <!--Status-->
                                            <div class="input-group mb-3 col">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroup-sizing-sm"
                                                        style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                        Status</span>
                                                </div>
                                                <select class="form-control" name="stockStatus">
                                                    <option value="" selected>Choose</option>
                                                    <option value="available">Available</option>
                                                    <option value="unavailable">Unavailable</option>
                                                </select>
                                            </div>
                                        </div>
                                        <!--Add Stock Item-->
                                        <a class="addItemVarianceBtn btn btn-primary btn-sm"
                                            style="color:blue;margin:0">Add Item Variance</a>
                                        <!--Button to add row in the table-->
                                        <br><br>
                                        <table class="varianceTable table table-sm table-borderless">
                                            <!--Table containing the different input fields in adding trans items -->
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>Unit</th>
                                                    <th>Size</th>
                                                    <th>Minimum</th>
                                                    <th>Qty</th>
                                                    <th style="width:27%">Status</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger btn-sm"
                                                data-dismiss="modal">Cancel</button>
                                            <button class="btn btn-success btn-sm" type="submit">Update</button>
                                        </div>
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
        var stockVariances = [];
        for (var index = 0; index < $(this).find(".varianceTable > tbody").children().length; index++) {
            stockVariances.push({
                varUnit: $(this).find("input[name='varUnit[]']").eq(index).val(),
                varSize: $(this).find("input[name='varSize[]']").eq(index).val(),
                varMin: $(this).find("input[name='varMinimum[]']").eq(index).val(),
                varQty: $(this).find("input[name='varQty[]']").eq(index).val(),
                varStatus: $(this).find("select[name='varStatus[]']").eq(index).val()
            });
        }
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

// function setTableData() {
//     var count = 0;
//     //Set Modals Stock Category Select elements' options
//     $("select[name='stockCategory']").children().first().siblings().remove();
//     $("select[name='stockCategory']").append(`
//     ${inventory.categories.length === 0 ? "" : inventory.categories.map(category => {
//         return `<option value="${category.ctID}">${category.ctName}</option>`
//     }).join('')}`);

//     //Populate Stock Table
//     if ($("#stockTable > tbody").children().length === 0) {
//         for (lastIndex; lastIndex < inventory.stocks.length; lastIndex++) {
//             if (count < rowsPerPage) {
//                 appendRow(inventory.stocks[lastIndex]);
//                 appendAccordion(inventory.variances.filter(variance => variance.stID === inventory.stocks[lastIndex]
//                     .stID));
//             }
//         }
//         //Set accordion icon event to show accordion
//         $(".editBtn").on("click", function() {
//             $("#editStock form")[0].reset();
//             $.ajax({
//                 method : 'post',
//                 url : '<?=site_url('admin/inventory/getitem')?>',
//                 data : {
//                     id : $(this).closest("tr").attr("data-id")
//                 },
//                 dataType : "json",
//                 success : function (data){
//                     setEditModal($("#editStock"), data.stock, data.variances);
//                 },
//                 error : function(response, setting, error){
//                     console.log(response.responseText);
//                 }
//             });
//             $("#editStock .varianceTable > tbody").empty();
//             var stockID = $(this).closest("tr").attr("data-id");
//             setEditModal($("#editStock"), inventory.stocks.filter(item => item.stID === stockID)[0], inventory
//                 .variances.filter(variance => variance.stID === stockID));
//         });
//     } else {
//         $("#stockTable > tbody").empty();
//     }
// }

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
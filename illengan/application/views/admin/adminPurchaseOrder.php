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
                <!--Table-->
                <div class="card-content">
                    <a class="btn btn-default btn-sm" data-toggle="modal" data-target="#addPO" data-original-title
                        style="margin:0" onclick="removeOptions()" id="addPOBtn">Add Purchase
                        Order</a>
                    <br>
                    <br>
                    <table id="poTable" class="table dt-responsive nowrap" cellspacing="0" width="100%">
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
                        </tbody>
                    </table>
                    <!--Start of Modal "Add Purchase Order"-->
                    <div class="modal fade bd-example-modal-lg" id="addPO" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true" style="overflow: auto !important;">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add Purchase Order</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <!--Modal Content-->
                                <form id="formAdd" action="<?= site_url('admin/purchaseorder/add')?>" method="post"
                                    accept-charset="utf-8">
                                    <div class="modal-body">
                                        <div class="form-row">
                                            <!--Container of Source. and Purchase date-->
                                            <!--Source-->
                                            <div class="input-group mb-3 col">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroup-sizing-lg"
                                                        style="width:90px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                        Supplier</span>
                                                </div>
                                                <select class="form-control form-control-sm" id="spName" name="spID">
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
                                            <textarea class="form-control form-control-sm" id="poRemarks" name="poRemarks"></textarea>
                                        </div>
                                        <!--Button to add row in the table-->
                                        <a class="addPOItem btn btn-default btn-sm" data-toggle="modal" data-target="#brochure"
                                            data-original-title style="margin:0" id="">Add Items</a>
                                        <br><br>
                                        <!--Table containing the different input fields in adding PO items -->
                                        <table class="poItemsTable table table-sm table-borderless">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>Item Name</th>
                                                    <th width="10%">Qty</th>
                                                    <th width="10%">Unit</th>
                                                    <th width="10%">Size</th>
                                                    <th width="15%">Price</th>
                                                    <th width="15%">Subtotal</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                            </tbody>
                                        </table>

                                        <!--Total of the trans items-->
                                        <span>Total: &#8369;<span id="total" class="total"> </span></span>
                                        <!--Modal Footer-->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger btn-sm"
                                                data-dismiss="modal">Cancel</button>
                                            <button class="btn btn-success btn-sm" id="submitPOrder" onclick="addPurchaseOrder()" type="button">Add</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- END OF ADD PURCHASE ORDER MODAL -->
                    <!--Start of Modal "Edit Purchase Order"-->
                    <div class="modal fade bd-example-modal-lg" id="editPO" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true" style="overflow: auto !important;">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Update Purchase Order</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <!--Modal Content-->
                                <form id="formEdit" action="<?= site_url('admin/purchaseorder/edit')?>" method="post"
                                    accept-charset="utf-8">
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
                                                <select class="form-control form-control-sm" id="spName" name="spID">
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
                                            <textarea name="poRemarks" class="form-control form-control-sm"></textarea>
                                        </div>
                                        <!--Button to add row in the table-->
                                        <a class="addPOItem btn btn-default btn-sm" data-toggle="modal" data-target="#brochure"
                                            data-original-title style="margin:0" id="">Add Items</a>
                                        <br><br>
                                        <!--Table containing the different input fields in adding PO items -->
                                        <table class="poItemsTables table table-sm table-borderless">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>Item Name</th>
                                                    <th width="15%">Unit</th>
                                                    <th width="10%">Qty</th>
                                                    <th width="10%">Size</th>
                                                    <th width="15%">Price</th>
                                                    <th width="15%">Subtotal</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            
                                            </tbody>
                                        </table>

                                        <!--Total of the trans items-->
                                        <span>Total: &#8369; <span id="total1" class="total"></span></span>
                                        <!--Modal Footer-->
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
                    <!-- END OF EDIT PURCHASE MODAL -->
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
                                <form id="brochureForm" method="post"
                                    accept-charset="utf-8">
                                    <div class="modal-body">
                                        <div style="margin:1% 3%" id="list">
                                            <!--checkboxes-->
                                            <label style="width:96%"><input type="checkbox" class="mr-2" value="">Sample
                                                data 2</label>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger btn-sm"
                                            data-dismiss="modal">Cancel</button>
                                        <button type="button" class="btn btn-success btn-sm" data-dismiss="modal" onclick="getSelectedMerch()">Ok</button>
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
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>

<?php include_once('templates/scripts.php') ?>
<script src="<?= admin_js().'addPO.js'?>"></script>
<script>
var POs = <?= json_encode($purchaseOrders) ?>;
var purOrders = [];
var suppliers = [];
var suppMerch = [];
    $(function () {
        $.ajax({
            url: '/admin/jsonPOrders',
            dataType: 'json',
            success: function (data) {
                var poLastIndex = 0;
                $.each(data.purOrders, function (index, item) {
                    purOrders.push({
                        "purOrders": item
                    });
                    purOrders[index].poItems = data.poItems.filter(po => po.poID == item
                        .poID);
                });
                suppliers = data.suppliers;
                suppMerch = data.supplierMerch;
                setSupplierChoices(suppliers);
                showTable();
            },
            failure: function () {
                console.log('None');
            },
            error: function (response, setting, errorThrown) {
                console.log(errorThrown);
                console.log(response.responseText);
            }
        });

        $(".addPOItem").on('click',function(){
            var supID = parseInt($(this).closest(".modal").find("select[name='spID']").val());
            console.log(supID);
            setBrochureContent(suppMerch.filter(merch => parseInt(merch.spID) == supID));
        });
    });
    function setSupplierChoices(suppliers){
        $("select[name='spID']").children().first().siblings().remove();
        $("select[name='spID']").append(`
        ${suppliers.map(supplier => {
            return `<option value="${supplier.spID}">${supplier.spName}</option>`;
        }).join('')}`);
    }
    function setBrochureContent(merchandise){
        $("#list").empty();
        $("#list").append(`${merchandise.map(merch => {
            return `<label style="width:96%"><input type="checkbox" name="suppMerch[]" class="merchChoice mr-2" value="${merch.spmID}"> ${merch.spmDesc} - ${parseFloat(merch.spmPrice).toFixed(2)}</label>`
        }).join('')}`);
    }
    function showTable() {
        purOrders.forEach(function (item) {
            var tableRow = `
                <tr class="table_row" data-id="${item.purOrders.poID}">   <!-- table row ng table -->
                    <td><img class="accordionBtn" src="/assets/media/admin/down-arrow%20(1).png" style="height:15px;width: 15px"/></td>
                    <td>${item.purOrders.poID}</td>
                    <td>${item.purOrders.spName}</td>
                    <td>${item.purOrders.poDate}</td>
                    <td>${item.purOrders.edDate}</td>
                    <td>${item.purOrders.poStatus}</td>
                    <td>${(parseFloat(item.purOrders.poTotal)).toFixed(2)}</td>
                    <td>
                        <button class="editBtn btn btn-sm btn-primary" data-toggle="modal" data-target="#editPO" id="editPOBtn">Edit</button>
                        <button class="deleteBtn btn btn-sm btn-danger" data-toggle="modal" data-target="#delete">Delete</button>
                    </td>
                </tr>
            `;
            var preferencesDiv = `
            <div class="preferences" style="float:left;margin-right:3%" > <!-- Preferences table container-->
                ${item.poItems.length === 0 ? "Not Applicable" : 
                `
                <table class="table table-bordered"> <!-- Preferences table-->
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Item Name</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Unit</th>
                            <th scope="col">Price</th>
                            <th scope="col">Subtotal Price</th>
                        </tr>
                    </thead>
                    <tbody>
                    ${item.poItems.map(po => {
                        return `
                        <tr>
                            <td>${po.poiName}: ${po.stName}</td>
                            <td>${po.poiQty}</td>
                            <td>${po.poiUnit}</td>
                            <td>&#8369; ${po.poiPrice}</td>
                            <td>${(parseFloat(po.poiPrice)*parseInt(po.poiQty)).toFixed(2)}</td>
                        </tr>
                        `;
                    }).join('')}
                    </tbody>
                </table>
                `}
            </div>
            `;
            var accordion = `
            <tr class="accordion" style="display:none">
                <td colspan="5"> <!-- table row ng accordion -->
                    <div style="overflow:auto;display:none"> <!-- container ng accordion -->
                        
                        <div style="width:100%;overflow:auto;padding-left: 5%"> <!-- description, preferences, and addons container -->
                            
                            <div class="poAccordionContent" style="overflow:auto;margin-top:1%"> <!-- Preferences and addons container-->
                                
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            `;
            $("#poTable > tbody").append(tableRow);
            $("#poTable > tbody").append(accordion);
            $(".poAccordionContent").last().append(preferencesDiv);
        });
        $(".accordionBtn").on('click', function () {
            if ($(this).closest("tr").next(".accordion").css("display") == 'none') {
                $(this).closest("tr").next(".accordion").css("display", "table-row");
                $(this).closest("tr").next(".accordion").find("td > div").slideDown("slow");
            } else {
                $(this).closest("tr").next(".accordion").find("td > div").slideUp("slow");
                $(this).closest("tr").next(".accordion").hide("slow");
            }
        });

        $(".editBtn").on("click", function() {
        $("#editPO form")[0].reset();
        $("#editPO .poItemsTables > tbody").empty();
        var poID = $(this).closest("tr").attr("data-id");
        setEditModal($("#editPO"), POs.purchorders.filter(item => item.poID === poID)[0], POs.poitems.filter(poi => poi.poID === poID));
    });
    }


function setEditModal(modal, purchOr, poitems) {
    $("#editPO form")[0].reset();
    modal.find("input[name='poID']").val(purchOr.poID);
    modal.find("input[name='poDate']").val(purchOr.poDate);
    modal.find("input[name='edDate']").val(purchOr.edDate);
    modal.find("textarea[name='poRemarks']").val(purchOr.poRemarks);
    modal.find("select[name='spID']").find(`option[value=${purchOr.spID}]`).attr("selected","selected");
    
    poitems.forEach(poi => {
        modal.find(".poItemsTables > tbody").append(`
        <tr class="merchelem" id="vID" data-id="${poi.poiID}" data-varid="${poi.vID}">
        <input type="hidden" name="poID" value="${poi.poID}">
        <input type="hidden" name="spmDesc" value="${poi.spmDesc}">
            <td><input type="text" id="stName" name="stName" class="form-control form-control-sm" data-stID="${poi.stID}" 
            value="${poi.branditem}" readonly="readonly"></td>
            <td><input type="text" id="vQty" onchange="setSubtotal()" name="vQty"
                    class="vQty form-control form-control-sm" value="${poi.poiQty}"></td>
            <td><input type="text" id="vUnit" name="vUnit" class="form-control form-control-sm" value="${poi.poiUnit}"
                    readonly="readonly"></td>
            <td><input type="text" id="vUnit" name="vUnit" class="form-control form-control-sm" value="${poi.vSize}"
                    readonly="readonly"></td>
            <td><input type="number" id="spmPrice" name="spmPrice" class="spmPrice form-control form-control-sm"
                    value="${poi.poiPrice}" readonly="readonly"></td>
            <td><input type="number" name="subtotal" class="subtotal form-control form-control-sm" value=""
                    readonly="readonly"></td>
            <td><img class="exitBtn" src="/assets/media/admin/error.png" style="width:20px;height:20px"></td>
        </tr>
        `);
    });
    setSubtotal();
}
$(document).ready(function() {
    $("#editPO form").on('submit', function(event) {
        event.preventDefault();
        var poID = $(this).find("input[name='poID']").val();
        var spName = $(this).find("select[name='spID']").val();
        var poiName = $(this).find("input[name='spmDesc']").val();
        var poDate = $(this).find("input[name='poDate']").val();
        var edDate = $(this).find("input[name='edDate']").val();
        var poRemarks = $(this).find("textarea[name='poRemarks']").val();
        var poTotal = $(this).find("span[id='total1']").text();
       
        var merch = [];
        for (var index = 0; index < $(this).find(".poItemsTables > tbody").children().length; index++) {
            var row = $(this).find(".poItemsTables > tbody > tr").eq(index);
            merch.push({
                poiID:  isNaN(parseInt(row.attr('data-id'))) ?  (null) : parseInt(row.attr('data-id')),
                vID :  row.attr('data-varid'),
                poiName: row.find("input[name='spmDesc']").val(),
                poiQty: row.find("input[name='vQty']").val(),
                poiUnit: row.find("input[name='vUnit']").val(),
                poiPrice: row.find("input[name='spmPrice']").val(),
                poiStatus: 'pending'
            });
        }
        console.log(poID, spName, poDate, edDate, merch, poTotal);
        $.ajax({
            url: "<?= site_url("admin/purchaseorder/edit")?>",
            method: "post",
            data: {
                spID: spName,
                poID: poID,
                poDate: poDate,
                edDate: edDate,
                poTotal: poTotal,
                poRemarks: poRemarks,
                merchandise: JSON.stringify(merch)
            },
            dataType: "json",
            success: function(data) {
                console.log(data);
                location.reload();
                alert('Purchase Order Updated');
            },
            complete: function() {
                $("#editPO").modal("hide");
            },
            error: function(error) {
                console.log(error);
            }
            
        });
    });
});





</script>
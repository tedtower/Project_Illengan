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
                            <a class="btn btn-default btn-sm" data-toggle="modal" data-target="#addEditModal"
                                data-original-title style="margin:0" id="addTransaction">Add Purchases/Deliveries</a>
                            <br>
                            <br>
                            <table id="transTable" class="table table-bordered dt-responsive nowrap" cellspacing="0"
                                width="100%">
                                <thead class="thead-light">
                                    <th style="width:10px"></th>
                                    <th><b class="pull-left">Receipt No.</b></th>
                                    <th><b class="pull-left">Supplier</b></th>
                                    <th><b class="pull-left">Transaction Date</b></th>
                                    <th><b class="pull-left">Total</b></th>
                                    <th><b class="pull-left">Type</b></th>
                                    <th><b class="pull-left">Status</b></th>
                                    <th><b class="pull-left">Actions</b></th>
                                </thead>
                                <tbody>
                                    <!--Start of Table row-->
                                    <?php foreach($deliveries as $delivery){
                                    ?>
                                    <tr data-id="<?= $delivery['iID']?>">
                                        <td><img class="accordionBtn" src="/assets/media/admin/down-arrow%20(1).png"
                                                style="height:15px;width: 15px" /></td>
                                        <td><?= $delivery['iNumber']?></td>
                                        <td><?= $delivery['spName']?></td>
                                        <td><?= $delivery['iDate']?></td>
                                        <td><?= $delivery['iTotal']?></td>
                                        <td><?= $delivery['iType']?></td>
                                        <td><?= $delivery['resolvedStatus']?></td>
                                        <td>
                                            <button class="editBtn btn btn-sm btn-primary" data-toggle="modal"
                                                data-target="#editTransaction">Edit</button>
                                            <button class="deleteBtn btn btn-sm btn-danger" data-toggle="modal"
                                                data-target="#delete">Delete</button>
                                        </td>
                                    </tr>
                                    <!--End of Table row-->
                                    <!--Start of Table accordion-->
                                    <tr class="accordion" style="display:none">
                                        <td colspan="8">
                                            <div class="container" style="display:none">
                                                <span>Date Recorded: <?= $delivery['iDateRecorded']?></span>
                                                <div style="overflow:auto">
                                                    <span style="float:left;margin-right:1%">Remarks:</span>
                                                    <p style="float:left"><?= $delivery['iRemarks']?></p>
                                                    <!--Remarks of Invoice-->
                                                </div>
                                                <table class="table">
                                                    <thead style="background:white">
                                                        <tr>
                                                            <th>Item Name</th>
                                                            <th>Unit</th>
                                                            <th>Qty</th>
                                                            <th>Price</th>
                                                            <th>Subtotal</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach($items as $item){
                                                        if($item['iID'] == $delivery['iID']){?>
                                                        <tr>
                                                            <td><?= $item['iName']?></td>
                                                            <td><?= $item['iUnit']?></td>
                                                            <td><?= $item['iQty']?></td>
                                                            <td><?= $item['iPrice']?></td>
                                                            <td><?= $item['iSubtotal']?></td>
                                                        </tr>
                                                        <?php }
                                                    } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>
                                    <!--End of Table accordion-->
                                    <?php }?>
                                </tbody>
                            </table>
                            <!--End Table Content-->

                            <!--Start of Modal "Add Transaction"-->
                            <div class="modal fade bd-example-modal-lg" id="addEditModal" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Add Purchases/Deliveries</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form id="form" action="<?= site_url('admin/transactions/add')?>"
                                            method="post" accept-charset="utf-8">
                                            <div class="modal-body">
                                                <div class="form-row">
                                                    <input type="text" name="transID" hidden="hidden"/>
                                                    <!--Container of supplier and receipt no.-->
                                                    <!--Source Name-->
                                                    <div class="input-group mb-3 col">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"
                                                                style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                Supplier</span>
                                                        </div>
                                                        <select class="form-control form-control-sm" name="spID">
                                                            <option value="" selected>Choose</option>
                                                        </select>
                                                    </div>
                                                    <!--Invoice Type-->
                                                    <div class="input-group mb-3 col">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"
                                                                style="width:130px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                Invoice Type</span>
                                                        </div>
                                                        <select class="form-control form-control-sm" name="transType">
                                                            <option value="" selected>Choose</option>
                                                            <option value="purchase">Purchase</option>
                                                            <option value="delivery">Delivery</option>
                                                            <option value="return">Return</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-row">
                                                    <!--Container of supplier and receipt no.-->
                                                    <!--Receipt Number-->
                                                    <div class="input-group mb-3 col">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"
                                                                style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                Receipt No.</span>
                                                        </div>
                                                        <input type="text" class="form-control" name="receiptNum">
                                                    </div>
                                                    <!--Invoice Type-->
                                                    <div class="input-group mb-3 col">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm"
                                                                style="width:130px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                Transaction Date</span>
                                                        </div>
                                                        <input type="date" class="form-control" name="transDate">
                                                    </div>
                                                </div>

                                                <div class="form-row">
                                                    <!--Container of supplier and receipt no.-->
                                                    <!--Status-->
                                                    <div class="input-group mb-3 col">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"
                                                                style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                Return Status</span>
                                                        </div>
                                                        <select class="form-control form-control-sm" name="resStatus">
                                                            <option value="" selected>Choose</option>
                                                            <option value="pending">Pending</option>
                                                            <option value="resolved">Resolved</option>
                                                            <option value="unresolved">Unresolved</option>
                                                        </select>
                                                    </div>
                                                    <!--Remarks-->
                                                    <div class="input-group mb-3 col">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm"
                                                                style="width:130px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                Remarks</span>
                                                        </div>
                                                        <textarea type="text" name="remarks"
                                                            class="form-control form-control-sm" rows="1"></textarea>
                                                    </div>
                                                </div>

                                                <!--Transaction Items-->
                                                <a class="btn btn-default btn-sm" data-toggle="modal"
                                                    data-target="#brochure" data-original-title style="margin:0"
                                                    id="addPOItems">Add PO Items</a>
                                                <!--Button to add launce the brochure modal-->
                                                <br><br>
                                                <table class="subTable1 table table-sm table-borderless">
                                                    <!--Table containing the different input fields in adding trans items -->
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th width="40%">Name</th>
                                                            <th>Qty</th>
                                                            <th>Unit</th>
                                                            <th>Price</th>
                                                            <th>Subtotal</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr data-id="" data-id2="">
                                                            <td><input type="text" name="itemName[]"
                                                                    class="form-control form-control-sm"></td>
                                                            <td><input type="number" name="itemQty[]"
                                                                    class="form-control form-control-sm"></td>
                                                            <td><input type="text" name="itemUnit[]"
                                                                    class="form-control form-control-sm"></td>
                                                            <td><input type="number" name="itemPrice[]"
                                                                    class="form-control form-control-sm"></td>
                                                            <td><input type="number" name="itemSubtotal[]"
                                                                    class="form-control form-control-sm"></td>
                                                            <td><img class="exitBtn" id="exitBtn"
                                                                    src="/assets/media/admin/error.png"
                                                                    style="width:20px;height:20px"></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <span>Total: &#8369;<span class="total">0</span></span>
                                                <!--Total of the trans items-->

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
                            <!--End of Modal "Add Transaction"-->

                            <!--Start of Brochure Modal"-->
                            <div class="modal fade bd-example-modal" id="brochure" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true"
                                style="background:rgba(0, 0, 0, 0.3)">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Select Stock Item</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form id="formAdd" action="<?= site_url('admin/transactions/add')?>"
                                            method="post" accept-charset="utf-8">
                                            <div class="modal-body">
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"
                                                            style="width:120px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                            Purchase Order</span>
                                                    </div>
                                                    <select class="form-control form-control-sm" name="po">
                                                        <option value="" selected>Choose</option>
                                                    </select>
                                                </div>
                                                <br>
                                                <table class="table">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th style="width:2%"></th>
                                                            <th>Item</th>
                                                            <th>Unit</th>
                                                            <th>Qty</th>
                                                            <th>Price</th>
                                                            <th>Subtotal</th>
                                                            <th>Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td><input type="checkbox" class="mr-2" value=""></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
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

                            <!--Start of Modal "Delete Stock Item"-->
                            <div class="modal fade" id="delete" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Delete
                                                Purchases/Deliveries
                                            </h5>
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
</div>
<?php include_once('templates/scripts.php') ?>
<script>
var suppliers = [];

$(function() {
    $(".accordionBtn").on('click', function() {
        if ($(this).closest("tr").next(".accordion").css("display") == 'none') {
            $(this).closest("tr").next(".accordion").css("display", "table-row");
            $(this).closest("tr").next(".accordion").find("td > div").slideDown("slow");
        } else {
            $(this).closest("tr").next(".accordion").find("td > div").slideUp("slow");
            $(this).closest("tr").next(".accordion").hide("slow");
        }
    });
    $("#addTransaction").on('click',function(){
        $.ajax({
            method : 'post',
            url : '<?= site_url('admin/jsonSupp')?>',
            dataType : 'json',
            success : function(data){
                suppliers = data;
            },
            error : function (response, settings, error){
                console.log(response.responseText);
            },
            complete: function(){                
                setSuppliers();
            }
        });
    });
    $("#addPOItems").on('click',function(){
        $.ajax({
            method : 'post',
            url : '<?= site_url('admin/getPurchaseOrders')?>',
            data : {
                id : $("#addEditModal").find("select[name='spID']").val()
            },
            dataType : 'json',
            success : function(data){
                console.log(data);
            },
            error : function (response, settings, error){
                console.log(response.responseText);
            },
            complete: function(){                
                setSuppliers();
            }
        });
    });
    $("#form").on('submit',function(event){
        event.preventDefault();
        var transID = isNaN(parseInt($(this).find("input[name='transID']").val())) ? (null) : parseInt($(this).find("input[name='transID']").val());
        var spID = $(this).find("select[name='spID']").val();
        var transType = $(this).find("select[name='transType']").val();
        var receiptNum = $(this).find("input[name='receiptNum']").val();
        var transDate = $(this).find("input[name='transDate']").val();
        var resStatus= $(this).find("select[name='resStatus']").val();
        var remarks = $(this).find("textarea[name='remarks']").val();
        var transitems = [];
        var row;
        for(var index = 0; index < $(this).find(".subTable1 > tbody").children().length;index++){
            row = $(this).find(".subTable1 > tbody > tr").eq(index);
            transitems.push({
                itemID : isNaN(parseInt(row.attr("data-id"))) ? (null) : parseInt(row.attr("data-id")),
                varID : row.attr("data-id2"),
                itemName : row.find("input[name='itemName[]']").val(),
                itemQty : row.find("input[name='itemQty[]']").val(),
                itemUnit : row.find("input[name='itemUnit[]']").val(),
                itemPrice : row.find("input[name='itemPrice[]']").val() 
            });
        }
    
        $.ajax({
            method : 'post',
            url : "<?= site_url('admin/transactions/add')?>",
            data : {
                transID : transID,
                spID : spID,
                transType : transType,
                receiptNum : receiptNum,
                transDate : transDate,
                resStatus : resStatus,
                remarks : remarks,
                transitems : JSON.stringify(transitems)
            },
            dataType : 'json',
            beforeSend : function(){
                console.log(transID, spID, transType, receiptNum, transDate, resStatus, remarks, transitems);
            },
            success : function(response){
                if(response.loginErr !== null){
                    window.location.href = '<?= site_url('login')?>';
                }else if(response.dataErr !== null){
                    console.log();
                }
            },
            error : function (response, setting, error){
                console.log(response.responseText);
            },
            complete : function(){
                $(this).closest(".modal").modal("hide");
            }
        });
    });
});
function setSuppliers(){
    $("#addEditModal").find('select[name="spID"]').children().first().siblings().remove();
    $("#addEditModal").find('select[name="spID"]').append(`
        ${suppliers.map(supplier => {
            return `<option value="${supplier.spID}">${supplier.spName}</option>`
        }).join('')}
    `);
}
function setPurchaseOrders(po){
    $("#brochure").find("select[name='po'] option").first().siblings().remove();
    $("#brochure").find("select[name='po']").append(`
    ${po.po.map(po => {
        return `<option value="${po.poID}">${po.poID} - ${po.poDate}</option>`
    }).join('')}
    `);
}
$("#brochure").find("select[name='po']").on('change',function(){
    var id = $(this).val();
    $("#poContent").children().remove();
    $("#poContent").append(`${po.poItems.filter(item => item.poID === id ).map(item => { return `<>`})}`);
});
</script>
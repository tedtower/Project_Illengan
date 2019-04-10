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
                                    data-original-title style="float: left" id="addTransaction">Add Transaction</a>
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
                                <table id="transTable" class="table table-bordered dt-responsive nowrap"
                                    cellspacing="0" width="100%">
                                    <thead>
                                        <th style="width:10px"></th>
                                        <th><b class="pull-left">Receipt No.</b></th>
                                        <th><b class="pull-left">Supplier Name</b></th>
                                        <th><b class="pull-left">Total</b></th>
                                        <th><b class="pull-left">Date</b></th>
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

                                <!--Start of Modal "Add Transaction"-->
                                <div class="modal fade bd-example-modal-lg" id="newTransaction" tabindex="-1"
                                    role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Add Transaction</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form id="formAdd" action="<?= site_url('admin/transactions/add')?>" method="post"
                                                accept-charset="utf-8">
                                                <div class="modal-body">
                                                    <div class="form-row">
                                                        <!--Container of receipt no. and transaction date-->
                                                        <!--Receipt no-->
                                                        <div class="input-group mb-3 col">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="inputGroup-sizing-sm"
                                                                    style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                    Receipt No.</span>
                                                            </div>
                                                            <input type="text" name="receiptNo" id="receiptNo"
                                                                class="form-control form-control-sm">
                                                        </div>
                                                        <!--Transaction date-->
                                                        <div class="input-group mb-3 col">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="inputGroup-sizing-sm"
                                                                    style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                    Transaction Date</span>
                                                            </div>
                                                            <input type="date" name="transDate" id="transDate"
                                                                class="form-control form-control-sm">
                                                        </div>
                                                    </div>
                                                    <!--Source Name-->
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm"
                                                                style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                Source</span>
                                                        </div>
                                                        <select class="sources custom-select" name="sourceName"
                                                            id="sourceName">
                                                            <option selected>Choose</option>
                                                        </select>
                                                    </div>
                                                    <!--Remarks-->
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm"
                                                                style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                Remarks</span>
                                                        </div>
                                                        <textarea type="text" name="remarks" id="remarks"
                                                            class="form-control form-control-sm"></textarea>
                                                    </div>

                                                    <!--Transaction Items-->
                                                    <button type="button" class="addTransItemBtn btn btn-primary btn-sm">Add Trans Item</button>
                                                    <!--Button to add row in the table-->
                                                    <br><br>
                                                    <table class="transItemsTable table table-sm table-borderless">
                                                        <!--Table containing the different input fields in adding trans items -->
                                                        <thead class="thead-light">
                                                            <tr>
                                                                <th>Name</th>
                                                                <th>Qty</th>
                                                                <th>Unit</th>
                                                                <th>Price</th>
                                                                <th>Subtotal</th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        </tbody>
                                                    </table>
                                                    <span>Total: &#8369;<span class="total">0</span></span>
                                                    <!--Total of the trans items-->

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger btn-sm"
                                                            data-dismiss="modal">Cancel</button>
                                                        <button class="btn btn-success btn-sm" data-dismiss="modal"
                                                            type="submit">Add</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!--End of Modal "Add Transaction"-->
                                <!--Modal "Edit Transaction" -->
                                <div class="modal fade bd-example-modal-lg" id="updateTransaction" tabindex="-1"
                                    role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Transaction</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form id="formEdit" action="<?= site_url('admin/transactions/edit')?>" method="post"
                                                accept-charset="utf-8">
                                                <div class="modal-body">
                                                    <div class="form-row">
                                                        <input type="text" name="transID" hidden="hidden"/>
                                                        <!--Container of receipt no. and transaction date-->
                                                        <!--Receipt no-->
                                                        <div class="input-group mb-3 col">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="inputGroup-sizing-sm"
                                                                    style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                    Receipt No.</span>
                                                            </div>
                                                            <input type="text" name="receiptNo" id="receiptNo"
                                                                class="form-control form-control-sm">
                                                        </div>
                                                        <!--Transaction date-->
                                                        <div class="input-group mb-3 col">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="inputGroup-sizing-sm"
                                                                    style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                    Transaction Date</span>
                                                            </div>
                                                            <input type="date" name="transDate" id="transDate"
                                                                class="form-control form-control-sm">
                                                        </div>
                                                    </div>
                                                    <!--Source Name-->
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm"
                                                                style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                Source</span>
                                                        </div>
                                                        <select class="sources custom-select" name="sourceName"
                                                            id="sourceName">
                                                            <option selected>Choose</option>
                                                        </select>
                                                    </div>
                                                    <!--Remarks-->
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm"
                                                                style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                Remarks</span>
                                                        </div>
                                                        <textarea type="text" name="remarks" id="remarks"
                                                            class="form-control form-control-sm"></textarea>
                                                    </div>

                                                    <!--Transaction Items-->
                                                    <button type="button" class="addTransItemBtn btn btn-primary btn-sm">Add Trans Item</button>
                                                    <!--Button to add row in the table-->
                                                    <br><br>
                                                    <table class="transItemsTable table table-sm table-borderless">
                                                        <!--Table containing the different input fields in adding trans items -->
                                                        <thead class="thead-light">
                                                            <tr>
                                                                <th>Name</th>
                                                                <th>Qty</th>
                                                                <th>Unit</th>
                                                                <th>Price</th>
                                                                <th>Subtotal</th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        </tbody>
                                                    </table>
                                                    <span>Total: &#8369;<span class="total"></span></span>
                                                    <!--Total of the trans items-->

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger btn-sm"
                                                            data-dismiss="modal">Cancel</button>
                                                        <button class="btn btn-success btn-sm"
                                                            type="submit">Edit</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!--End Modal "edit Transaction" -->

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include_once('templates/scripts.php') ?>
</body>
<script>
var transactions = <?= json_encode($transactions)?>;
var transLastIndex = 0;
var transPerPage = 10;
// $("#transTable").ready(function(){
// });
$(function() {
    $("select.sources").each(function(index){
        var options = "";
        transactions.sources.length == null ? $(".sources").attr("disabled","disabled") : options = transactions.sources.map(source => {        
            return `<option value="${source.source_id}">${source.source_name}</option>`
        }).join('');
        $("select.sources").eq(index).append(options);
    });
    $("#addTransaction").on('click', function(){
        $("#formAdd")[0].reset();
        $("#formAdd").find(".total").text(0.00);
        $("#formAdd").find(".transItemsTable > tbody").empty();
    });
    $(".addTransItemBtn").on('click', function(){
        $(this).closest("form").find(".transItemsTable > tbody").append(`
                                                            <tr class="transItem">
                                                                <td><input type="text" name="itemName[]" id="itemName"
                                                                        class="form-control form-control-sm"></td>
                                                                <td><input type="number" name="itemQty[]" id="itemQty"
                                                                        class="form-control form-control-sm"></td>
                                                                <td><input type="text" name="itemUnit[]" id="itemUnit"
                                                                        class="form-control form-control-sm"></td>
                                                                <td><input type="number" name="itemPrice[]"
                                                                        id="itemPrice"
                                                                        class="form-control form-control-sm"></td>
                                                                <td><input type="number" name="subtotal[]" id="subtotal"
                                                                        class="form-control form-control-sm"></td>
                                                                <td><img class="exitBtn" id="exitBtn"
                                                                        src="/assets/media/admin/error.png"
                                                                        style="width:20px;height:20px"></td>
                                                            </tr>`);
        $(".exitBtn").last().on("click", function(){
            $(this).closest("tr").remove();
        });
    });
    $("#formAdd").on('submit',function(event){
        event.preventDefault();
        var receiptNo = $(this).find('input[name="receiptNo"]').val(); //input
        var transDate = $(this).find('input[name="transDate"]').val(); //input
        var sourceName = $(this).find('select[name="sourceName"]').val(); //select
        var remarks = $(this).find('textarea[name="remarks"]').val(); //input
        var transItems = [];
        // var itemName = []; //input
        // var itemQty = []; //input
        // var itemUnit = []; //input
        // var itemPrice = []; //input
        for(var index = 0 ; index < $(this).find(".transItem").length ; index++){
            // if(!())
            transItems.push({
                itemName : $(this).find("input[name='itemName[]']").eq(index).val(),
                itemQty : $(this).find("input[name='itemQty[]']").eq(index).val(),
                itemUnit : $(this).find("input[name='itemUnit[]']").eq(index).val(),
                itemPrice : $(this).find("input[name='itemPrice[]']").eq(index).val()
            });
        }
        console.log(receiptNo, transDate, sourceName, remarks, transItems);
        $.ajax({
            method: 'post',
            url: '<?= site_url('admin/transactions/add')?>',
            data: {
                receiptNo : receiptNo,
                transDate : transDate,
                sourceName : sourceName,
                remarks : remarks,
                transItems : JSON.stringify(transItems)
            },
            dataType: 'json',
            success: function(data){
                console.log(data);
                transactions = data;
                transLastIndex = 0;
                setTableData();
            },
            error: function(response, setting, errorThrown){
                console.log(response.responseText);
                console.log(errorThrown);
            },
            complete: function(){
                $("#newTransaction").modal("hide");
            }
        });
    });
    $("#formEdit").on('submit',function(event){
        event.preventDefault();
        var transID = $(this).find('input[name="transID"]').val()
        var receiptNo = $(this).find('input[name="receiptNo"]').val(); //input
        var transDate = $(this).find('input[name="transDate"]').val(); //input
        var sourceName = $(this).find('select[name="sourceName"]').val(); //select
        var remarks = $(this).find('textarea[name="remarks"]').val(); //input
        var transItems = [];
        // var itemName = []; //input
        // var itemQty = []; //input
        // var itemUnit = []; //input
        // var itemPrice = []; //input
        for(var index = 0 ; index < $(this).find(".transItem").length ; index++){
            // if(!())
            transItems.push({
                itemName : $(this).find("input[name='itemName[]']").eq(index).val(),
                itemQty : $(this).find("input[name='itemQty[]']").eq(index).val(),
                itemUnit : $(this).find("input[name='itemUnit[]']").eq(index).val(),
                itemPrice : $(this).find("input[name='itemPrice[]']").eq(index).val()
            });
        }
        $.ajax({
            method: 'post',
            url: '<?= site_url('admin/transactions/edit')?>',
            data: {
                transID : transID,
                receiptNo : receiptNo,
                transDate : transDate,
                sourceName : sourceName,
                remarks : remarks,
                transItems : JSON.stringify(transItems)
            },
            dataType: 'json',
            beforeSend: function(){
                console.log(transID, receiptNo, transDate, sourceName, remarks, JSON.stringify(transItems));
            },
            success: function(data){
                console.log(data);
                transactions = data;
                transLastIndex = 0;
                setTableData();
            },
            error: function(response, setting, errorThrown){
                console.log(errorThrown);
                console.log(response.responseText);
            },
            complete: function(){
                $("#updateTransaction").modal("hide");
            }
        });
    });
    setTableData();
});

function setTableData() {
    var count = 0;
    var tableRow;
    var accordion;
    if(transactions.transaction.length !== 0){
        if($("#transTable > tbody").children().length !== 0){
            $("#transTable > tbody").empty();
        }
        for (transLastIndex; transLastIndex < transactions.transaction.length; transLastIndex++) {
            if (!(count < transPerPage)) {
                break;
            }
            transactions.transaction[transLastIndex].transitems = [];
            tableRow = `
            <tr data-id="${transactions.transaction[transLastIndex].trans_id}" >
                <td><img class="accordionBtn" src="/assets/media/admin/down-arrow%20(1).png" style="height:15px;width: 15px"/></td>
                <td>${transactions.transaction[transLastIndex].receipt_no}</td>
                <td>${transactions.transaction[transLastIndex].source_name}</td>
                <td>${transactions.transaction[transLastIndex].total}</td>
                <td>${transactions.transaction[transLastIndex].trans_date}</td>
                <td>
                    <div class="onoffswitch">
                        <!--View button-->
                        <button class="editBtn btn btn-default btn-sm" data-toggle="modal"
                            data-target="#updateTransaction">Edit</button>
                        <!--Delete button-->
                        <!-- <button class="deleteBtn btn btn-danger btn-sm" data-toggle="modal"
                            data-target="">Delete</button> -->
                    </div>
                </td>
            </tr>`;
            $("#transTable > tbody").append(tableRow);

            if (transactions.transaction[transLastIndex].transitems[0] == undefined) {
                transactions.transaction[transLastIndex].transitems = transactions.transitem.filter(item => item.trans_id ==
                    transactions.transaction[transLastIndex].trans_id);
            }
            accordion = `
            <tr style="display:none">
                <td colspan="6">
                    <div class="container" style="display:none"> <!-- Container ng accordion -->
                        <span>Date Recorded: ${transactions.transaction[transLastIndex].date_recorded}</span>
                        <div>Remarks:<p>${transactions.transaction[transLastIndex].remarks == null ? "No Remarks" : `${transactions.transaction[transLastIndex].remarks}`}</p></div>
                        ${transactions.transaction[transLastIndex].transitems[0] == undefined ? "No items recorded!" : `
                            <table class="table">
                            <thead style="background:white">                            
                                <tr>
                                    <th>Name</th>
                                    <th>Qty</th>
                                    <th>Unit</th>
                                    <th>Price</th>
                                    <th>Subtotal</th>                            
                                </tr>
                            </thead>
                            <tbody>
                                ${transactions.transaction[transLastIndex].transitems.map(transitem => {
                                    return `
                                    <tr>
                                        <td>${transitem.item_name}</td>
                                        <td>${transitem.item_qty}</td>
                                        <td>${transitem.item_unit}</td>
                                        <td>${transitem.item_price}</td>
                                        <td>${transitem.subtotal}</td>                            
                                    </tr>`;
                                }).join('')}
                            </tbody>
                        </table>`}                    
                    </div>
                </td>
            </tr>
            `;
            $("#transTable > tbody").append(accordion);
            $(".editBtn").on('click', function(){
                $("#formEdit")[0].reset();
                $("#formEdit").find(".total").text(0.00);
                $("#formEdit").find(".transItemsTable > tbody").empty();
            });
            count++;
        }
    }else{
        $("#transTable").after("No Transaction Recorded");
    }
}
    $(".accordionBtn").on('click', function() {
        if ($(this).closest("tr").next("tr").css('display') == "none") {
            $(this).closest("tr").next("tr").css('display', 'table-row');
            $(this).closest("tr").next("tr").find("td > div").slideDown('slow');
        } else {
            $(this).closest("tr").next("tr").find("td > div").slideUp('slow');
            $(this).closest("tr").next("tr").hide("slow");
        }
    });
    $(".editBtn").on('click', function(){
        var transID = $(this).closest("tr").attr("data-id");
        var transaction = transactions.transaction.filter(trans => trans.trans_id == transID)[0];
        console.log(transaction);
        $("#updateTransaction").find("input[name='transID']").val(transID);
        $("#updateTransaction").find("input[name='receiptNo']").val(transaction.receipt_no);
        $("#updateTransaction").find("input[name='transDate']").val(transaction.trans_date);
        $("#updateTransaction").find("select[name='sourceName']").find(`option[value=${transaction.source_id}]`).attr("selected","selected");
        $("#updateTransaction").find("textarea[name='remarks']").val(transaction.remarks);
        for(var index = 0 ; index < transaction.transitems.length ; index++){
            $("#updateTransaction").find(".transItemsTable > tbody").append(`
            <tr class="transItem">
                <td><input type="text" name="itemName[]" id="itemName"
                        class="form-control form-control-sm" value="${transaction.transitems[index].item_name}"></td>
                <td><input type="number" name="itemQty[]" id="itemQty"
                        class="form-control form-control-sm" value="${transaction.transitems[index].item_qty}"></td>
                <td><input type="text" name="itemUnit[]" id="itemUnit"
                        class="form-control form-control-sm" value="${transaction.transitems[index].item_unit}"></td>
                <td><input type="number" name="itemPrice[]"
                        id="itemPrice"
                        class="form-control form-control-sm" value="${transaction.transitems[index].item_price}"></td>
                <td><input type="number" name="subtotal[]" id="subtotal"
                        class="form-control form-control-sm" value="${transaction.transitems[index].subtotal}"></td>
                <td><img class="exitBtn" id="exitBtn"
                        src="/assets/media/admin/error.png"
                        style="width:20px;height:20px"></td>
            </tr>`);
        }
        $("#updateTransaction").find(".exitBtn").on("click", function(){
            $(this).closest("tr").remove();
        });
    });
}
</script>

</html>
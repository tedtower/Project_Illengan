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
            <!--Nav Tabs-->
            <div class="main-panel">
                <div class="content" style="margin-top: 5px;">
                    <div class="container-fluid">

                        <div class="content">
                            <div class="container-fluid">
                                <!--Table-->
                                <div class="card-content">
                                    <a class="btn btn-default btn-sm" data-toggle="modal" data-target="#newTransaction"
                                        data-original-title style="float: left">Add
                                        Transaction</a>
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
                                    <table id="transTable"
                                        class="table table-striped  table-bordered dt-responsive nowrap" cellspacing="0"
                                        width="100%">
                                        <thead>
                                            <th></th>
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
                                </div>
                                <!--End Table Content-->
                                <!--Modal-->
                                <!--Add Menu Item Modal-->
                                <div class="row">
                                    <div class="col-md-12 form-group">
                                        <div class="form-group label-floating">
                                            <label for="email">Receipt Number</label>
                                            <input class="form-control" type="text" name="receiptNumber" value=""
                                                required pattern="[a-zA-Z][a-zA-Z\s][0-9]*" required
                                                title="Receipt number should contain letters and numbers">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 form-group">
                                        <div class="form-group label-floating">
                                            <label for="supplier">Supplier Name</label>
                                            <input class="form-control" type="text" name="supplierName" value=""
                                                required title="Supplier name should only contain letters">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 form-group">
                                        <div class="form-group label-floating">
                                            <label for="description">Remarks</label>
                                            <input class="form-control" type="text" name="remarks" value="" required
                                                pattern="[a-zA-Z][a-zA-Z\s]*" required
                                                title="Remarks should only countain letters">
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-footer" style="margin-bottom:-14px;" align="right">
                                    <input type="submit" class="btn btn-danger" value="Close" />
                                    <input type="reset" class="btn btn-success" value="Add New Transaction" />
                                </div>
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
    setTableData();
});

function setTableData() {
    var count = 0;
    var tableRow;
    var accordion;
    for(transLastIndex; transLastIndex < transactions.transaction.length; transLastIndex++){
        if(!(count < transPerPage)){
            break;
        }
        transactions.transaction[transLastIndex].transitems = [];
        tableRow = `
        <tr data-id="${transactions.transaction[transLastIndex].trans_id}" >
            <td><button class="accordionBtn">+</button></td>
            <td>${transactions.transaction[transLastIndex].receipt_no}</td>
            <td>${transactions.transaction[transLastIndex].source_name}</td>
            <td>${transactions.transaction[transLastIndex].total}</td>
            <td>${transactions.transaction[transLastIndex].trans_date}</td>
            <td>
                <div class="onoffswitch">
                    <!--View button-->
                    <button class="btn btn-default btn-sm" data-toggle="modal"
                        data-target="">Edit</button>
                    <!--Delete button-->
                    <button class="btn btn-danger btn-sm" data-toggle="modal"
                        data-target="">Delete</button>
                </div>
            </td>
        </tr>`;
        $("#transTable > tbody").append(tableRow);

        if(transactions.transaction[transLastIndex].transitems[0] == undefined){
            transactions.transaction[transLastIndex].transitems = transactions.transitem.filter(item => item.trans_id == transactions.transaction[transLastIndex].trans_id);
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
        count++;
    }
    $(".accordionBtn").on('click', function(){
        if($(this).closest("tr").next("tr").css('display') == "none"){
            $(this).closest("tr").next("tr").css('display', 'table-row');
            $(this).closest("tr").next("tr").find("td > div").slideDown('slow');
        }else{
            $(this).closest("tr").next("tr").find("td > div").slideUp('slow');
            $(this).closest("tr").next("tr").hide("slow");
        }
    });
}
</script>

</html>
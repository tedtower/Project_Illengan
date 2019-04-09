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
                                <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#newTransaction"
                                    data-original-title style="float: left">Add Transaction</a>
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
                                <div class="modal fade bd-example-modal-lg" id="newTransaction" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Add Transaction</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="<?php echo base_url()?>admin/sources/edit" method="get"
                                                accept-charset="utf-8">
                                                <div class="modal-body">
                                                    <div class="form-row"> <!--Container of receipt no. and transaction date-->
                                                        <!--Receipt no-->
                                                        <div class="input-group mb-3 col">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                Receipt No.</span>
                                                            </div>
                                                            <input type="text" name="receipt_no" id="receipt_no" class="form-control form-control-sm">
                                                        </div>
                                                        <!--Transaction date-->
                                                        <div class="input-group mb-3 col">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                Transac Date</span>
                                                            </div>
                                                            <input type="date" name="trans_date" id="trans_date" class="form-control form-control-sm">
                                                        </div>
                                                    </div>
                                                    <!--Source Name-->
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                            Source</span>
                                                        </div>
                                                        <select class="custom-select" name="source_name" id="source_name">
                                                            <option selected>Choose</option>
                                                            <option></option>
                                                        </select>
                                                    </div>
                                                    <!--Remarks-->
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                            Remarks</span>
                                                        </div>
                                                        <textarea type="text" name="remarks" id="remarks" class="form-control form-control-sm"></textarea>
                                                    </div>

                                                    <!--Transaction Items-->
                                                    <button class="btn btn-primary btn-sm">Add Trans Item</button> <!--Button to add row in the table-->
                                                    <br><br>
                                                    <table class="table table-sm table-borderless"> <!--Table containing the different input fields in adding trans items -->
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
                                                            <tr>
                                                                <td><input type="text" name="item_name" id="item_name" class="form-control form-control-sm"></td>
                                                                <td><input type="number" name="item_qty" id="item_qty" class="form-control form-control-sm"></td>
                                                                <td><input type="text" name="item_unit" id="item_unit" class="form-control form-control-sm"></td>
                                                                <td><input type="number" name="item_price" id="item_price" class="form-control form-control-sm"></td>
                                                                <td><input type="number" name="subtotal" id="subtotal" class="form-control form-control-sm"></td>
                                                                <td><img class="exitBtn" id="exitBtn" src="/assets/media/admin/error.png" style="width:20px;height:20px"></td>
                                                            </tr>
                                                            <tr>
                                                                <td><input type="text" name="item_name" id="item_name" class="form-control form-control-sm"></td>
                                                                <td><input type="number" name="item_qty" id="item_qty" class="form-control form-control-sm"></td>
                                                                <td><input type="text" name="item_unit" id="item_unit" class="form-control form-control-sm"></td>
                                                                <td><input type="number" name="item_price" id="item_price" class="form-control form-control-sm"></td>
                                                                <td><input type="number" name="subtotal" id="subtotal" class="form-control form-control-sm"></td>
                                                                <td><img class="exitBtn" id="exitBtn" src="/assets/media/admin/error.png" style="width:20px;height:20px"></td>
                                                            </tr>
                                                    </table>
                                                    <span>Total: &#8369;<span>20000</span></span><!--Total of the trans items-->
                         
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger btn-sm"
                                                            data-dismiss="modal">Cancel</button>
                                                        <button class="btn btn-success btn-sm"
                                                            type="submit">Insert</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
<!--End of Modal "Add Transaction"-->

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
$(function () {
    setTableData();
});

function setTableData() {
    var count = 0;
    var tableRow;
    var accordion;
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
                    <button class="btn btn-default btn-sm" data-toggle="modal"
                        data-target="">Edit</button>
                    <!--Delete button-->
                    <button class="btn btn-danger btn-sm" data-toggle="modal"
                        data-target="">Delete</button>
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
        count++;
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
}
</script>

</html>
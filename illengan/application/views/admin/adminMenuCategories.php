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
                                    role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="overflow: auto !important;">
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
                                                        <button class="btn btn-success btn-sm"
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
                                    role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="overflow: auto !important;">
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
                                                                    style="width:250px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
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
    </div>
    <?php include_once('templates/scripts.php') ?>
</body>
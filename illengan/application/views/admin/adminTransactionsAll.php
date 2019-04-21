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
                                data-original-title style="margin:0" id="addTransaction">Add Purchases/Deliveries</a>
                            <br>
                            <br>
                            <table id="transTable" class="table table-bordered dt-responsive nowrap"
                                cellspacing="0" width="100%">
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
                                    <tr>
                                        <td><img class="accordionBtn" src="/assets/media/admin/down-arrow%20(1).png" style="height:15px;width: 15px"/></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <button class="editBtn btn btn-sm btn-primary" data-toggle="modal" data-target="#editTransaction">Edit</button>
                                            <button class="deleteBtn btn btn-sm btn-danger" data-toggle="modal" data-target="#delete">Delete</button>
                                        </td>
                                    </tr>
                                <!--End of Table row-->
                                <!--Start of Table accordion-->
                                    <tr class="accordion" style="display:none">
                                        <td colspan="8">
                                            <div class="container" style="display:none">
                                                <span>Date Recorded: </span>
                                                <div style="overflow:auto">
                                                    <span style="float:left;margin-right:1%">Remarks:</span><p style="float:left"></p> <!--Remarks of Invoice-->
                                                </div>
                                                <table class="table">
                                                    <tr>
                                                        <thead style="background:white">
                                                            <th>Item Name</th>
                                                            <th>Unit</th>
                                                            <th>Qty</th>
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
                                    </tr>
                                <!--End of Table accordion-->
                                </tbody>
                            </table>
                        <!--End Table Content-->

                        <!--Start of Modal "Add Transaction"-->
                            <div class="modal fade bd-example-modal-lg" id="newTransaction" tabindex="-1"
                                role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Add Purchases/Deliveries</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form id="formAdd" action="<?= site_url('admin/transactions/add')?>" method="post"
                                            accept-charset="utf-8">
                                            <div class="modal-body">
                                                <div class="form-row"><!--Container of supplier and receipt no.-->
                                                <!--Source Name-->
                                                    <div class="input-group mb-3 col">
                                                        <div class="input-group-prepend">      
                                                            <span class="input-group-text" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                Supplier</span>
                                                        </div>
                                                        <select class="form-control form-control-sm" name="sourceName" id="sourceName">
                                                            <option selected>Choose</option>
                                                        </select>
                                                    </div>
                                                <!--Invoice Type-->
                                                    <div class="input-group mb-3 col">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" style="width:130px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                Invoice Type</span>
                                                        </div>
                                                        <select class="form-control form-control-sm" name="transType" id="transType">
                                                            <option selected>Choose</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-row"><!--Container of supplier and receipt no.-->
                                                <!--Receipt Number-->
                                                    <div class="input-group mb-3 col">
                                                        <div class="input-group-prepend">      
                                                            <span class="input-group-text" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                Receipt No.</span>
                                                        </div>
                                                        <input type="text" class="form-control" name="receiptNum" id="receiptNum">
                                                    </div>
                                                <!--Invoice Type-->
                                                    <div class="input-group mb-3 col">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm" style="width:130px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                Transaction Date</span>
                                                        </div>
                                                        <input type="date" class="form-control" name="transDate" id="transDate">
                                                    </div>
                                                </div>

                                                <div class="form-row"><!--Container of supplier and receipt no.-->
                                                <!--Status-->
                                                    <div class="input-group mb-3 col">
                                                        <div class="input-group-prepend">      
                                                            <span class="input-group-text" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                Return Status</span>
                                                        </div>
                                                        <select class="form-control form-control-sm" name="transType" id="transType">
                                                            <option selected>Choose</option>
                                                        </select>
                                                    </div>
                                                <!--Remarks-->
                                                    <div class="input-group mb-3 col">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm" style="width:130px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                Remarks</span>
                                                        </div>
                                                        <textarea type="text" name="remarks" id="remarks" class="form-control form-control-sm" rows="1"></textarea>
                                                    </div>
                                                </div>

                                            <!--Transaction Items-->
                                                <a class="btn btn-default btn-sm" data-toggle="modal" data-target="#brochure" data-original-title style="margin:0" id="addTransaction">Add Items</a>
                                                <a class="btn btn-default btn-sm" data-toggle="modal" data-target="#brochurePO" data-original-title style="margin:0" id="addTransaction">Add PO Items</a>
                                                <!--Button to add launce the brochure modal-->
                                                <br><br>
                                                <table class="transItemsTable table table-sm table-borderless">
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
                                                            <td><input type="text" name="itemName[]" class="form-control form-control-sm"></td>
                                                            <td><input type="number" name="itemQty[]" class="form-control form-control-sm"></td>
                                                            <td><input type="text" name="itemUnit[]" class="form-control form-control-sm"></td>
                                                            <td><input type="number" name="itemPrice[]" class="form-control form-control-sm"></td>
                                                            <td><input type="number" name="itemSubtotal[]" class="form-control form-control-sm"></td>
                                                        <td><img class="exitBtn" id="exitBtn" src="/assets/media/admin/error.png" style="width:20px;height:20px"></td>
                                                    </tbody>
                                                </table>
                                                <span>Total: &#8369;<span class="total">0</span></span>
                                                <!--Total of the trans items-->

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

                        <!--Start of Modal "Edit Transaction"-->
                        <div class="modal fade bd-example-modal-lg" id="editTransaction" tabindex="-1"
                                role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Update Purchases/Deliveries</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form id="formAdd" action="<?= site_url('admin/transactions/add')?>" method="post"
                                            accept-charset="utf-8">
                                            <div class="modal-body">
                                                <div class="form-row">
                                                <!--Source Name-->
                                                    <div class="input-group mb-3 col">
                                                        <div class="input-group-prepend">      
                                                            <span class="input-group-text" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                Supplier</span>
                                                        </div>
                                                        <select class="form-control form-control-sm" name="sourceName" id="sourceName">
                                                            <option selected>Choose</option>
                                                        </select>
                                                    </div>
                                                <!--Invoice Type-->
                                                    <div class="input-group mb-3 col">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" style="width:130px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                Invoice Type</span>
                                                        </div>
                                                        <select class="form-control form-control-sm" name="transType" id="transType">
                                                            <option selected>Choose</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-row">
                                                <!--Receipt Number-->
                                                    <div class="input-group mb-3 col">
                                                        <div class="input-group-prepend">      
                                                            <span class="input-group-text" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                Receipt No.</span>
                                                        </div>
                                                        <input type="text" class="form-control" name="receiptNum" id="receiptNum">
                                                    </div>
                                                <!--Invoice Type-->
                                                    <div class="input-group mb-3 col">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm" style="width:130px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                Transaction Date</span>
                                                        </div>
                                                        <input type="date" class="form-control" name="transDate" id="transDate">
                                                    </div>
                                                </div>

                                                <div class="form-row">
                                                <!--Status-->
                                                    <div class="input-group mb-3 col">
                                                        <div class="input-group-prepend">      
                                                            <span class="input-group-text" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                Return Status</span>
                                                        </div>
                                                        <select class="form-control form-control-sm" name="transType" id="transType">
                                                            <option selected>Choose</option>
                                                        </select>
                                                    </div>
                                                <!--Remarks-->
                                                    <div class="input-group mb-3 col">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm" style="width:130px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                Remarks</span>
                                                        </div>
                                                        <textarea type="text" name="remarks" id="remarks" class="form-control form-control-sm" rows="1"></textarea>
                                                    </div>
                                                </div>

                                            <!--Transaction Items-->
                                                <a class="btn btn-default btn-sm" data-toggle="modal" data-target="#brochure" data-original-title style="margin:0" id="addTransaction">Add Items</a>
                                                <a class="btn btn-default btn-sm" data-toggle="modal" data-target="#brochurePO" data-original-title style="margin:0" id="addTransaction">Add PO Items</a>
                                                <!--Button to add launce the brochure modal-->
                                                <br><br>
                                                <table class="transItemsTable table table-sm table-borderless">
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
                                                        <tr>
                                                            <td><input type="text" name="itemName[]" class="form-control form-control-sm"></td>
                                                            <td><input type="number" name="itemQty[]" class="form-control form-control-sm"></td>
                                                            <td><input type="text" name="itemUnit[]" class="form-control form-control-sm"></td>
                                                            <td><input type="number" name="itemPrice[]" class="form-control form-control-sm"></td>
                                                            <td><input type="number" name="itemSubtotal[]" class="form-control form-control-sm"></td>
                                                            <td><img class="exitBtn" id="exitBtn" src="/assets/media/admin/error.png" style="width:20px;height:20px"></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <span>Total: &#8369;<span class="total">0</span></span>
                                                <!--Total of the trans items-->

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
                        <!--End of Modal "Edit Transaction"-->

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
                        <!--Start of Brochure Modal"-->
                            <div class="modal fade bd-example-modal" id="brochurePO" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="background:rgba(0, 0, 0, 0.3)">
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
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">      
                                                        <span class="input-group-text" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                            Supplier</span>
                                                    </div>
                                                    <select class="form-control form-control-sm" name="PO" id="PO">
                                                        <option selected>Choose</option>
                                                    </select>
                                                </div>

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
                            <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Delete Purchases/Deliveries</h5>
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
$(".accordionBtn").on('click', function(){
    if($(this).closest("tr").next(".accordion").css("display") == 'none'){
        $(this).closest("tr").next(".accordion").css("display","table-row");
        $(this).closest("tr").next(".accordion").find("td > div").slideDown("slow");
    }else{
        $(this).closest("tr").next(".accordion").find("td > div").slideUp("slow");
        $(this).closest("tr").next(".accordion").hide("slow");
    }
});
</script>
<!--End Side Bar-->
<body style="background:white">
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
                            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addEditTransaction"
                                data-original-title style="margin:0">Add Purchases/Deliveries</button>
                            <br>
                            <br>
                            <table id="transTable" class="table table-bordered dt-responsive nowrap" cellspacing="0"
                                width="100%">
                                <thead class="thead-dark">
                                    <th><b class="pull-left">Receipt No.</b></th>
                                    <th><b class="pull-left">Supplier</b></th>
                                    <th><b class="pull-left">Type</b></th>
                                    <th><b class="pull-left">Date</b></th>
                                    <th><b class="pull-left">Total</b></th>
                                    <th><b class="pull-left">Actions</b></th>
                                </thead>
                                <tbody>
                                    <!--Start of Table row-->
                                    <?php if($transactions[0] != null){
                                        foreach($transactions as $transaction){
                                    ?>
                                    <tr data-id="<?= $transaction['tID']?>">
                                        <td><a href="javascript:void(0)" class="ml-2 mr-4"><img class="accordionBtn" src="/assets/media/admin/down-arrow%20(1).png" style="height:15px;width: 15px"/></a><?= $transaction['tNum']?></td>
                                        <td><?= ucwords($transaction['spName'])?></td>
                                        <td><?= ucwords($transaction['tType'])?></td>
                                        <td><?= $transaction['tDate']?></td>
                                        <td>&#8369; <?=$transaction['tTotal']?></td>
                                        <td>
                                            <button class="editBtn btn btn-sm btn-secondary" data-toggle="modal"
                                                data-target="#editTransaction">Edit</button>
                                            <button class="deleteBtn btn btn-sm btn-warning" data-toggle="modal"
                                                data-target="#delete">Archived</button>
                                        </td>
                                    </tr>
                                    <!--End of Table row-->

                                    <!--Start of Table accordion-->
                                    <tr class="accordion" style="display:none">
                                        <td colspan="8">
                                            <div class="container" style="display:none">
                                                <span>Date Recorded: <?= $transaction['dateRecorded'] == null ? "N/A" : $transaction['dateRecorded']?></span>
                                                <div style="overflow:auto">
                                                    <span style="float:left;margin-right:1%">Remarks: </span>
                                                    <p style="float:left"><?= $transaction['tRemarks'] == null ? "No remarks" : $transaction['tRemarks']?></p>
                                                    <!--Remarks of Invoice-->
                                                </div>
                                                <table class="table">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th>Name</th>
                                                            <th>Qty</th>
                                                            <th>UOM</th>
                                                            <th>Price</th>
                                                            <th>Discount</th>
                                                            <th>Status</th>
                                                            <th>Subtotal</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php foreach($transitems as $transitem){
                                                        if($transitem['tID'] == $transaction['tID']){?>
                                                        <tr>
                                                            <td><?= ucwords($transitem['tiName'])?></td>
                                                            <td><?= $transitem['tiQty']?></td>
                                                            <td><?= strtolower($transitem['uomAbbreviation'])?></td>
                                                            <td><?= number_format($transitem['tiPrice'],2,".",',')?></td>
                                                            <td><?= number_format($transitem['tiDiscount'],2,".",',')?></td>
                                                            <td><?= ucwords($transitem['tiStatus'])?></td>
                                                            <td><?= number_format($transitem['tiSubtotal'],2,".",',')?></td>
                                                        </tr>
                                                    <?php }
                                                    }?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                        }
                                    }?>
                                    <!--End of Table accordion-->
                                </tbody>
                            </table>
                            <!--End Table Content-->

                            <!--Start of Modal "Add Transaction"-->
                            <div class="modal fade bd-example-modal-lg" id="addEditTransaction" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true" style="overflow: auto !important;">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Add Purchases/Deliveries</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form accept-charset="utf-8">
                                            <input type="text" name="tID" hidden="hidden">
                                            <div class="modal-body">
                                                <div class="form-row">
                                                    <!--Source Name-->
                                                    <div class="input-group mb-3 col">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text border border-secondary"
                                                                style="width:100px;background:#bfbfbf;color:white;font-size:14px;font-weight:600">
                                                                Supplier</span>
                                                        </div>
                                                        <select class="form-control form-control-sm  border-left-0" name="spID" >
                                                            <option value="" selected>Choose</option>
                                                        </select>
                                                    </div>
                                                    <!--Invoice Type-->
                                                    <div class="input-group mb-3 col">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text border border-secondary"
                                                                style="width:100px;background:#bfbfbf;color:white;font-size:14px;font-weight:600">      
                                                                Type</span>
                                                        </div>
                                                        <select class="form-control form-control-sm  border-left-0" name="tType">
                                                            <option value="" selected>Choose</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-row">
                                                    <!--Container of supplier and receipt no.-->
                                                    <!--Receipt Number-->
                                                    <div class="input-group mb-3 col">
                                                        <div class="input-group-prepend">
                                                        <span class="input-group-text border border-secondary"
                                                                style="width:100px;background:#bfbfbf;color:white;font-size:14px;font-weight:600">
                                                                Receipt No.</span>
                                                        </div>
                                                        <input type="text" class="form-control  border-left-0" name="tNum">
                                                    </div>
                                                    <!--Invoice Type-->
                                                    <div class="input-group mb-3 col">
                                                        <div class="input-group-prepend">
                                                        <span class="input-group-text border border-secondary"
                                                                style="width:142px;background:#bfbfbf;color:white;font-size:14px;font-weight:600">
                                                                Transaction Date</span>
                                                        </div>
                                                        <input type="date" class="form-control  border-left-0" name="tDate">
                                                    </div>
                                                </div>
                                                 
                                                <!--Remarks-->
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                    <span class="input-group-text border border-secondary"
                                                                style="width:100px;background:#bfbfbf;color:white;font-size:14px;font-weight:600">
                                                            Remarks</span>
                                                    </div>
                                                    <textarea type="text" name="tRemarks"
                                                        class="form-control form-control-sm  border-left-0" rows="1"></textarea>
                                                </div>

                                                <!--Transaction Items-->
                                                <a class="btn btn-primary btn-sm" data-original-title style="margin:0;color:white;font-weight:600;background:#0073e6">Add Items</a>
                                                <!--Transaction PO Items-->
                                                <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#brochure" style="color:white;font-weight:600;background:#0073e6">Add PO Items</a>
                                                <br><br>
                                                <!--div containing the different input fields in adding trans items -->
                                                <div class="container mb-3 inputGroup1" style="overflow:auto;width:100%">
                                                    <div style="float:left;width:95%;overflow:auto;">
                                                        <div class="input-group mb-1">
                                                            <input type="text" name="itemName[]" class="form-control form-control-sm" placeholder="Item Name" style="width:305px;"> 
                                                            <input type="number" name="itemQty[]" class="form-control form-control-sm" placeholder="Quantity">
                                                            <input type="number" name="actualQty[]"class="form-control form-control-sm" placeholder="Actual Qty">
                                                        </div>
                                                        <div class="input-group">
                                                            <select name="itemUnit[]" class="form-control form-control-sm">
                                                                <option value="" selected="selected">Unit</option>
                                                            </select>
                                                            <select name="actualUnit[]" class="form-control form-control-sm">
                                                                <option value="" selected="selected">Actual Unit</option>
                                                            </select>
                                                            <input type="number" name="itemPrice[]" class="form-control form-control-sm " placeholder="Price">
                                                            <input type="number" name="itemSubtotal[]" class="form-control form-control-sm " placeholder="Subtotal">
                                                            <select  name="itemStatus[]"class="form-control form-control-sm ">
                                                                <option value="" selected>Choose Status</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="mt-4" style="float:left:width:3%;overflow:auto;">
                                                        <img class="exitBtn" id="exitBtn"src="/assets/media/admin/error.png" style="width:20px;height:20px;float:right;">
                                                    </div>
                                                </div>
                                                <span>Total: &#8369;<span class="total">0</span></span>
                                                <!--Total of the trans items-->

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
                                                    <button class="btn btn-success btn-sm" type="submit">Insert</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!--End of Modal "Add Transaction"-->
                            
                            <!--Start of Brochure Modal"-->
                            <div class="modal fade bd-example-modal-lg" id="brochure" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="background:rgba(0, 0, 0, 0.3)">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Select Stock Item</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form>
                                            <div class="modal-body">
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text "
                                                            style="width:130px;background:#737373;color:white;font-size:14px;font-weight:600">  
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
                                                            <td><input type="checkbox" ></td>
                                                            <td>Nestle Milk 500 ml</td>
                                                            <td>cn</td>
                                                            <td>12</td>
                                                            <td>100</td>
                                                            <td>1200</td>
                                                            <td>pending</td>
                                                        </tr>

                                                        <tr>
                                                            <td><input type="checkbox" ></td>
                                                            <td>Nestle Milk 500 ml</td>
                                                            <td>cn</td>
                                                            <td>12</td>
                                                            <td>100</td>
                                                            <td>1200</td>
                                                            <td>pending</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
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
    $(function(){
        $(".accordionBtn").on('click',function(){
            if($(this).closest('tr').next('.accordion').css('display') === 'none'){
                $(this).closest('tr').next('.accordion').slideDown();
                $(this).closest('tr').next('.accordion').find('div').slideDown();
            }else{
                $(this).closest('tr').next('.accordion').find('div').slideUp();
                $(this).closest('tr').next('.accordion').slideUp();
            }
        });
    });
</script>
</body>
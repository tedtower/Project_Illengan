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
                    <a class="btn btn-primary btn-sm ml-0 mb-3" data-toggle="modal" href="#addConsumedModal" id="addConsumedBtn">Add Consumed Item/s</a>
                    <table id="consumedTable" class="table table-bordered dt-responsive text-center" cellpadding="0" width="100%">
                        <thead class="thead-dark">
                            <tr>
                                <th><b>Stock Item</b></th>
                                <th><b>Quantity</b></th>
                                <th><b>Balance</b></th>
                                <th><b>Destock Date</b></th>
                                <th><b>Recorded Date</b></th>
                                <th><b>Remarks</b></th>
                                <th width="95px"><b>Action</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $x=0; if(count($consumptions) < 1) { ?>
                                <tr><td colspan="7">There are no recorded consumption.</td></tr>
                            <?php } else { 
                                foreach ($consumptions as $c) { ?>
                                    <tr>
                                        <td><?= $c['stDesc'] ?></td>
                                        <td><?= $c['slQty'].' '.$c['uomAbbreviation'] ?></td>
                                        <td><?= $c['slBalance'].' '.$c['uomAbbreviation'] ?></td>
                                        <td><?= date("F d, Y h:i:s A", strtotime($c['slDateTime'])) ?></td>
                                        <td><?= date("F d, Y h:i:s A", strtotime($c['dateRecorded'])) ?></td>
                                        <td><?= empty($c['slRemarks']) ? "" : $c['slRemarks']; ?></td>
                                        <?php if($x != 1){ $x++ ?>
                                            <td>
                                                <a class="deleteBtn btn btn-sm btn-danger m-0" data-toggle="modal" data-id="<?= $c['slID'] ?>" href="#deleteConsumption">Delete</a>
                                            </td>
                                        <?php } else { echo '<td></td>'; } ?>
                                    </tr>
                            <?php } } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade bd-example-modal-lg" id="addConsumedModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Consumed Item/s</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!--Modal Content-->
                <form id="formAddConsumption" method="post" accept-charset="utf-8">
                    <div class="modal-body">
                        <div class="input-group input-group-sm mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Consumption Date</span>
                            </div>
                            <input type="date" name="cnDate" class="form-control" required>
                        </div>
                        <a class="btn btn-dark btn-sm ml-0 mb-3" href="javascript:void(0)" id="addConsumedInputBtn"><b>Add Additional Consumed Item</b></a>
                        <div class="d-flex justify-content-center">
                            <table class="destockTable table table-sm table-borderless" style="width:90%">
                                <thead class="thead-light">
                                    <tr class="text-center">
                                        <th width="65%"><b>Item Name</b></th>
                                        <th width="*"><b>Consumed Quantity</b></th>
                                        <th width="20px"></th>
                                    </tr>
                                </thead>
                                <tbody id="destockBodyTable">
                                    <tr>
                                        <td>
                                            <select name="cnVar[]" class="selectVar form-control form-control-sm" required>
                                                <option value="" selected disabled>Choose Item</option>
                                                <?php foreach ($variance as $v){ ?>
                                                    <option value="<?= $v['vID'] ?>" data-qty="<?= $v['vQty'] ?>"><?= $v['poItem'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                        <td><input type="number" name="cnQty[]" class="inputCnQty form-control form-control-sm text-center" min="1" required></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!--Modal Footer-->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary btn-sm" id="submitConsumed">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<?php include_once('templates/scripts.php') ?>
<script>
    <?php echo "var consumptions =".json_encode($consumptions).";\n"; ?>
    console.log(consumptions);
    
</script>
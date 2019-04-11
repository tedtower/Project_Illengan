<!-- Add Modals-->
<div class="modal fade" id="destockInventory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Destock Inventory Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo base_url() ?>admin/inventory/destock" method="get" accept-charset="utf-8">
                <div class="modal-body">
                    <!--Item Name-->
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <div class="form-group label-floating">
                                <label for="name">Item Name</label>
                                <input class="form-control" type="text" name="source_name" required pattern="[a-zA-Z][a-zA-Z\s]*" required title="Item name should only countain letters" required>
                            </div>
                        </div>
                    </div>
                    <!--Current Quantity-->
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <div class="form-group label-floating">
                                <label for="current_qty">Current Quanity</label>
                                <input name="current_qty" class="form-control" type="number" value="" id="example-number-input" min="0" oninput="validity.valid||(value='');" data-validate="required" max="" required>
                            </div>
                        </div>
                    </div>
                    <!--Date of Destock-->
                    <div class="row">
                    <div class="input-group mb-3 col">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-sm"
                                style="width:140px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                    Transaction Date</span>
                        </div>
                        <input type="date" name="transDate" id="transDate"
                            class="form-control form-control-sm">
                    </div>
                    </div>
                    <!--End Destock Modal-->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-success btn-sm" type="submit">Insert</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
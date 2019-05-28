<!-- Add Modals-->
<div class="modal fade" id="restockInventory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="overflow: auto !important;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Restock Inventory Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo base_url() ?>admin/inventory/restock" method="get" accept-charset="utf-8">
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
                    <!--Quantity-->
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <div class="form-group label-floating">
                                <label for="qty">Quanity</label>
                                <input name="qty" class="form-control" type="number" value="" id="example-number-input" min="0" oninput="validity.valid||(value='');" data-validate="required" max="" required>
                            </div>
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
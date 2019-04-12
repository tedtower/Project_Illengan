<!-- Add Modals-->
<div class="modal fade" id="addStockSpoilages" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Stock Spoilages</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo base_url() ?>adminStockSpoilage/insert" method="get" accept-charset="utf-8">
                <div class="modal-body">
                    <!--Spoilage Code-->
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <div class="form-group label-floating">
                                <label for="spoilageCode">Spoilage Code</label>
                                <input name="spoilageCode" class="form-control" type="number" value="" id="example-number-input" min="0" oninput="validity.valid||(value='');" data-validate="required" max="" required>
                            </div>
                        </div>
                        <!--Menu ID-->
                        <div class="col-md-6 form-group">
                            <div class="form-group label-floating">
                                <label for="menuId">Menu ID</label>
                                <input name="menuId" class="form-control" type="number" value="" id="example-number-input" min="0" oninput="validity.valid||(value='');" data-validate="required" max="" required>
                            </div>
                        </div>
                    </div>
                    <!--Spoilage Quantity-->
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <div class="form-group label-floating">
                                <label for="spoilage_qty">Spoilage Quantity</label>
                                <input name="spoilage_qty" class="form-control" type="number" value="" id="example-number-input" min="0" oninput="validity.valid||(value='');" data-validate="required" max="" required>
                            </div>
                        </div>
                        <!--Spoilage Date-->
                        <div class="input-group mb-6 col">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-sm">
                                    Spoilage Date</span>
                            </div>
                            <input type="date" name="spoilageDate" id="spoilageDate" class="form-control form-control-sm">
                        </div>
                        <!--Date Recorded-->
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-sm">
                                        Date Recorded</span>
                                </div>
                                <input type="date" name="dateRecorded" id="dateRecorded" class="form-control form-control-sm">
                            </div>
                            <!--Remarks-->
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                        Remarks</span>
                                </div>
                                <textarea type="text" name="remarks" id="remarks" class="form-control form-control-sm"></textarea>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
                                <button class="btn btn-success btn-sm" type="submit">Insert</button>
                            </div>
                        </div>
            </form>
                    </div>
                </div>
            </div>
    </div>
</div>
<!--End Add Stock Spoilage Modal-->

<!--Start Modal Edit Stock Spoilage-->
<div class="modal fade" id="editStockSpoilages" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Stock Spoilages</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo base_url() ?>adminStockSpoilage/edit" method="get" accept-charset="utf-8">
                <div class="modal-body">
                    <!--Spoilage Code-->
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <div class="form-group label-floating">
                                <label for="spoilageCode">Spoilage Code</label>
                                <input name="spoilageCode" class="form-control" type="number" value="" id="example-number-input" min="0" oninput="validity.valid||(value='');" data-validate="required" max="" required>
                            </div>
                        </div>
                        <!--Menu ID-->
                        <div class="col-md-6 form-group">
                            <div class="form-group label-floating">
                                <label for="menuId">Menu ID</label>
                                <input name="menuId" class="form-control" type="number" value="" id="example-number-input" min="0" oninput="validity.valid||(value='');" data-validate="required" max="" required>
                            </div>
                        </div>
                    </div>
                    <!--Spoilage Quantity-->
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <div class="form-group label-floating">
                                <label for="spoilage_qty">Spoilage Quantity</label>
                                <input name="spoilage_qty" class="form-control" type="number" value="" id="example-number-input" min="0" oninput="validity.valid||(value='');" data-validate="required" max="" required>
                            </div>
                        </div>
                        <!--Spoilage Date-->
                        <div class="input-group mb-6 col">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-sm">
                                    Spoilage Date</span>
                            </div>
                            <input type="date" name="spoilageDate" id="spoilageDate" class="form-control form-control-sm">
                        </div>
                        <!--Date Recorded-->
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-sm">
                                        Date Recorded</span>
                                </div>
                                <input type="date" name="dateRecorded" id="dateRecorded" class="form-control form-control-sm">
                            </div>
                            <!--Remarks-->
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                        Remarks</span>
                                </div>
                                <textarea type="text" name="remarks" id="remarks" class="form-control form-control-sm"></textarea>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
                                <button class="btn btn-success btn-sm" type="submit">Update</button>
                            </div>
                        </div>
            </form>
                    </div>
                </div>
            </div>
    </div>
</div>
<!--End Edit Stock Spoilages Modal-->
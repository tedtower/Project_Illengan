<!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editOrderModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" style="padding:0px;">
            <!-- Modal Body -->
            <div class="modal-body delius">
                <h3 class="text-center gab">Menu Item 1</h3>
                <h6 class="py-2">Current Quantity: 1</h6>
                <div class="md-form input-group mb-3">
                    <div class="d-flex flex-row">
                        <span class="pr-2">New Quantity:</span>
                        <div class="input-group-prepend">
                            <button class="btn btn-md btn-light m-0 px-3 py-2 z-depth-0" type="button" data-quantity="minus" data-field="quantity">
                                <i class="fa fa-minus" aria-hidden="true"></i>
                            </button>
                            <input type="text" class="form-control font-weight-bold" name="quantity" id="quantity" value="1" disabled>
                            <button class="btn btn-md btn-light m-0 px-3 py-2 z-depth-0" type="button" data-quantity="plus" data-field="quantity">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="input-group w-auto mb-3">
                        <label for="edit-temp" class="mt-1">Temperature: &nbsp;</label>
                        <input type="checkbox" class="hc mr-1" id="edit-temp" />
                        <span class="mt-1 font-weight-bold" id="edtemp"> Cold</span>
                </div>
                <div class="input-group mb-3 delius">
                    <div class="input-group-prepend">
                        <button class="btn btn-md btn-outline-mdb-color m-0 px-3 py-2 z-depth-0" type="button">Add-on</button>
                    </div>
                    <select class="browser-default custom-select w-25" id="inputGroupSelect03" aria-label="Example select with button addon">
                        <option selected disabled>Choose...</option>
                        <option value="">No Thank You.</option>
                        <option value="1">Addon One (15 php)</option>
                        <option value="2">Addon Two (20 php)</option>
                        <option value="3">Addon Three (25 php)</option>
                    </select>
                    <input type="number" min="1" placeholder="Quantity..." aria-label="Add-on Quantity" class="form-control">
                </div>
                <div class="d-flex flex-row">
                    <span class="px-1 mt-1 label-indent">Notes: </span>
                    <textarea class="form-control" id="exampleFormControlTextarea5" rows="2"></textarea>
                </div>
            </div>
            <div class="modal-footer py-1 justify-content-center">
                <button type="button" class="btn btn-outline-mdb-color" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-mdb-color" href="#proceed_order">Save</button>
            </div>
            </div>
        </div>
    </div>
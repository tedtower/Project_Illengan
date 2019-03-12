<!-- Sizable Modal -->
<div class="modal fade" id="menu_modal" tabindex="-1" role="dialog" aria-labelledby="menuItemModal" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content" style="padding:0px;">
            <!-- Modal Body -->
            <div class="modal-body">
                <!-- Menu Image -->
                <img class="w-100 img-fluid" src="" id="menu_image">
                <!-- Title And Price -->
                <div class="d-flex justify-content-between gab rp-title">
                    <p id="menu_name"></p>
                    <p><span class="fs-24">₱</span><span id="menu_price"></span></p>
                </div>
                <!-- Palitan ang teal-text to tex-danger pag unavailable yung item -->
                <h4 class="gab">Status: <span id="menu_status"></span></h4>
                <hr>
                <!-- Order Form -->
                <h3 class="gab">Order Details</h3>
                <div class="input-group mb-3 mt-2" id="sizable">
                    <div class="d-flex w-100 delius">
                        <label class="px-1 mt-1 label-indent" for="size">Size:</label>
                        <select class="browser-default custom-select" id="size" name="menu_size" required>
                        </select>
                    </div>
                </div>
                <div class="delius d-flex flex-wrap w-100" style="overflow:auto;">
                    <div class="md-form input-group mb-3 m-0 p-0 w-auto" style="width:auto;float: left;">
                        <div class="d-flex flex-row mr-5">
                            <span class="px-1 mt-1 label-indent">Qty: </span>
                            <div class="input-group-prepend">
                            <button class="btn btn-md btn-light m-0 py-1 px-3 z-depth-0" type="button" data-quantity="minus" data-field="quantity">
                                <i class="fa fa-minus" aria-hidden="true"></i>
                            </button>
                            <input type="text" class="form-control text-center font-weight-bold" name="order_quantity" id="quantity" value="1" disabled>
                            <button class="btn btn-md btn-light m-0 py-1 px-3 z-depth-0" type="button" data-quantity="plus" data-field="quantity">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                            </button>
                            </div>
                        </div>
                    </div>
                    <div class="input-group w-auto" id="temperature">
                        <label class="mt-1">Type: &nbsp;</label>
                        
                        <input type="radio" class="hc mr-1" id="hot-or-cold" value="Hot" />
                        <span class="mt-1 font-weight-bold" id="temp"> Hot</span>
                        <input type="radio" class="hc mr-1" id="hot-or-cold" value="Cold" />
                        <span class="mt-1 font-weight-bold" id="temp"> Cold</span>
                    </div>
                </div>
                <h4 class="gab">Add-ons</h4>
                <div class="input-group mb-3 delius">
                    <div class="input-group-prepend">
                        <button class="btn btn-md btn-outline-accent m-0 px-3 py-2 z-depth-0" type="button">Add-on</button>
                    </div>
                    <select class="browser-default custom-select w-25" name="addon[]" aria-label="Addon">
                        <option selected disabled>Choose...</option>
                    </select>
                    <input type="number" min="1" name="addonqty[]" placeholder="Quantity..." aria-label="Add-on Quantity" class="form-control">
                </div>
                <div class="delius form-group green-border-focus">
                    <div class="d-flex flex-row">
                        <span class="px-1 mt-1 label-indent">Notes: </span>
                        <textarea class="form-control" id="exampleFormControlTextarea5" rows="2"></textarea>
                    </div>
                </div>
                <div class="text-center float-right">
                    <button type="button" class="btn btn-outline-accent px-3" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-accent px-3" id="menu_id" data-menuid="">Save To Order List</button>
                </div>
            </div>
        </div>
    </div>
</div>
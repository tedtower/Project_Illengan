<div class="modal fade" id="menu_modal" tabindex="-1" role="dialog" aria-labelledby="menuItemModal" aria-hidden="true">
    <span id="mid" hidden></span>
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content" style="padding:0px;">
            <div class="modal-body">
                <img class="w-100 img-fluid" src="" id="menu_image">
                <div class="d-flex justify-content-between gab rp-title">
                    <p id="menu_name"></p>
                    <p><span class="fs-24">₱</span><span id="menu_price"></span></p>
                </div>
                <h4 class="gab">Status: <span id="menu_status"></span></h4>
                <hr>
                <div id="order-details">
                    <h3 class="gab">Order Details</h3>
                    <div class="md-form input-group mb-3 m-0 p-0 delius">
                        <div class="d-flex flex-row mr-5 w-100">
                            <span class="px-1 mt-1 mr-3">Quantity: </span>
                            <div class="input-group-prepend">
                                <button class="btn btn-md btn-light m-0 py-1 px-3 z-depth-0" type="button" onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                                    <i class="fa fa-minus" aria-hidden="true"></i>
                                </button>
                                <input type="number" class="form-control text-center font-weight-bold px-3" name="order_quantity" id="quantity" min="1" value="1" disabled>
                                <button class="btn btn-md btn-light m-0 py-1 px-3 z-depth-0" type="button" onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3 mt-2 delius" id="sizable">
                        <div class="d-flex w-100" id="menu_size">
                            <label class="px-1 mt-1" for="size">Preference:</label>
                            <select class="browser-default custom-select" id="size" name="menu_size">
                            </select>
                        </div>
                    </div>
                    <!-- TO BE EDITED -->
                    <div class="input-group mb-3 mt-2 delius" id="addonable">
                        <div class="d-flex w-100" id="menu_size">
                            <label class="px-1 mt-1" for="addon">Addon:</label>
                            <select class="browser-default custom-select" id="addon" name="addon" required>
                                <option disabled selected value>Choose an addon</option>
                            </select>
                            <input type="number" class="form-control text-center" placeholder="Quantity" min="1" value="1" id="addon_qty">
                            <div class="input-group-append">
                            <button class="btn btn-md btn-outline-accent m-0 px-4 py-2 z-depth-0" type="button" id="add_addon">Add</button>
                            </div>
                        </div>
                    </div>
                    <!-- Missing Add On -->
                    <div class="delius form-group green-border-focus">
                        <div class="d-flex flex-row">
                            <span class="px-1 mt-1 label-indent">Notes: </span>
                            <textarea class="form-control" id="menu_note" rows="2"></textarea>
                        </div>
                    </div>
                </div>
                <div class="text-center float-right">
                    <button type="button" class="btn btn-outline-accent px-3" data-dismiss="modal" id="close-menu">Close</button>
                    <button type="button" data-dismiss="modal" class="btn btn-accent px-3 save-order" id="save_order">Save To Order List</button>
                </div>
            </div>
        </div>
    </div>
</div>
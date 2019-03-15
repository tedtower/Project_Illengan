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
                    <button class="accordion py-2 delius">Add-ons</button>
                    <div class="panel mb-3">
                        <!-- INSERT CHECKBOX GROUP HERE -->
                    </div>
                    <div class="delius form-group green-border-focus">
                        <div class="d-flex flex-row">
                            <span class="px-1 mt-1 label-indent">Notes: </span>
                            <textarea class="form-control" id="exampleFormControlTextarea5" rows="2"></textarea>
                        </div>
                    </div>
                </div>
                <div class="text-center float-right">
                    <button type="button" class="btn btn-outline-accent px-3" data-dismiss="modal" id="close-menu">Close</button>
                    <button type="button" class="btn btn-accent px-3 save-order">Save To Order List</button>
                </div>
            </div>
        </div>
    </div>
</div>
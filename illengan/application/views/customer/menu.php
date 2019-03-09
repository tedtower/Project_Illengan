<!-- Category -->
    <div class="text-center gab py-0 my-0">
        <h1>Category #</h1>
    </div>

    <!-- Subcategory -->
    <div class="d-inline-flex px-4 animated flipInX slow subcategory mb-2 delius">
        <h5>Subcategory 1</h5>
    </div>

    <!-- Card group -->
    <div class="d-flex flex-wrap">

        <!-- Card -->
        <div class="card cd-mw">
        <!-- Card image -->
            <a data-toggle="modal" href="#menu_modal">
            <img class="card-img-top" src="media/card.jpeg" alt="Name of the Product">
            </a>
            <!-- Card content -->
            <div class="card-body p-0 m-0 gab">
                <!-- Title -->
                <p class="text-truncate float-left menu-title" id="mt">Menu Item Name</p>
                <p class="float-right menu-price" id="mp"><span class="fs-15">₱</span>100</p>
            </div>
        </div>

        <!-- Card -->
        <div class="card cd-mw">
            <!-- Card image -->
            <a data-toggle="modal" href="#menu_modal">
                <img class="card-img-top" src="media/card.jpeg" alt="Name of the Product">
            </a>
            <!-- Card content -->
            <div class="card-body p-0 m-0 gab">
            <!-- Title -->
            <p class="text-truncate float-left menu-title" id="mt">Menu Item Name</p>
            <p class="float-right menu-price" id="mp"><span class="fs-15">₱</span>85</p>
            </div>
        </div>

    </div>

    <!-- Sizable Modal -->
    <div class="modal fade" id="menu_modal" tabindex="-1" role="dialog" aria-labelledby="menuItemModal" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content" style="padding:0px;">
                <!-- Modal Body -->
                <div class="modal-body">
                    <!-- Menu Image -->
                    <img class="w-100" src="media/card.jpeg" alt="Menu Item Name">
                    <!-- Title And Price -->
                    <div class="d-flex justify-content-between gab rp-title">
                        <p>Menu Item Name</p>
                        <p><span class="fs-24">₱</span>100</p>
                    </div>
                    <h4 class="gab">Status: <span class="teal-text">Available</span></h4>
                    <h4 class="gab">Status: <span class="text-danger">Unavailable</span></h4>
                    <hr>
                    <!-- Order Form -->
                    <h3 class="gab">Order Details</h3>
                    <span class="fs-15 delius"><i class="text-danger">Note:</i>The add-ons and temperature will reflect based on the quantity of the specific menu that you will order. If you want to differ the items, please order them separately.</span>
                    <div class="input-group mb-3 mt-2" id="sizable">
                        <div class="d-flex w-100 delius">
                            <label class="px-1 mt-1 label-indent" for="size">Size:</label>
                            <select class="browser-default custom-select" id="size" name="size" required>
                            <option selected value="100">Small (100 php)</option>
                            <option value="120">Medium (120php)</option>
                            <option value="140">Large (140 php)</option>
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
                                <input type="text" class="form-control text-center font-weight-bold" name="quantity" id="quantity" value="1" disabled>
                                <button class="btn btn-md btn-light m-0 py-1 px-3 z-depth-0" type="button" data-quantity="plus" data-field="quantity">
                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                </button>
                                </div>
                            </div>
                        </div>
                        <div class="input-group w-auto">
                            <label for="hot-or-cold" class="mt-1">Temperature: &nbsp;</label>
                            <input type="checkbox" class="hc mr-1" id="hot-or-cold" />
                            <span class="mt-1 font-weight-bold" id="temp"> Cold</span>
                        </div>
                    </div>
                    <h4 class="gab">Add-ons</h4>
                    <div class="input-group mb-3 delius">
                        <div class="input-group-prepend">
                            <button class="btn btn-md btn-outline-accent m-0 px-3 py-2 z-depth-0" type="button">Add-on</button>
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
                    <div class="delius form-group green-border-focus">
                        <div class="d-flex flex-row">
                            <span class="px-1 mt-1 label-indent">Notes: </span>
                            <textarea class="form-control" id="exampleFormControlTextarea5" rows="2"></textarea>
                        </div>
                    </div>
                    <div class="text-center float-right">
                        <button type="button" class="btn btn-outline-accent px-3" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-accent px-3">Save To Order List</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
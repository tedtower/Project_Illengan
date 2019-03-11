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

        <?php foreach($menu as $items) { ?>
        <!-- Card -->
        <div class="card cd-mw menuItemCard" date-menuItemID="<?php echo $items->menu_id; ?>">
        <input type="number" id="menID" value="<?php echo $items->menu_id; ?>" hidden>
        <!-- Card image -->
            <a href="" id="menu_card">
            <img class="card-img-top" src="<?php echo cmedia_url(); ?>card.jpeg">
            </a>
            <!-- Card content -->
            <div class="card-body p-0 m-0 gab">
                <!-- Title -->
                <p class="text-truncate float-left menu-title" id="mt"><?php echo $items->menu_name; ?></p>
                <p class="float-right menu-price" id="mp"><span class="fs-15">₱</span><?php echo $items->size_price; ?></p>
            </div>
        </div>
        <?php } ?>
        
    </div>

    <!-- Sizable Modal -->
    <div class="modal fade" id="menu_modal" tabindex="-1" role="dialog" aria-labelledby="menuItemModal" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content" style="padding:0px;">
                <!-- Modal Body -->
                <div class="modal-body">
                    <!-- Menu Image -->
                    <img class="w-100" src="" alt="Menu Item">
                    <!-- Title And Price -->
                    <div class="d-flex justify-content-between gab rp-title">
                        <p id="menu_name"></p>
                        <p><span class="fs-24">₱</span><span id="menu_price"></span></p>
                    </div>
                    <!-- Palitan ang teal-text to tex-danger pag unavailable yung item -->
                    <h4 class="gab">Status: <span id="menu_availability" class="teal-text"></span></h4>
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

<script>
var menu = {};
$(function() {
    $("div [class~='menuItemCard']").on("click", function() {
        var menu_id = $(this).attr('data-menuItemID');
        if($(this).attr("data-opened") == '1'){
            setModalValues(menu_id);
        }else{
            $.ajax({
                method: "get",
                url: "customer/menu/getitemdetails",
                data: {
                    menu_id: menu_id
                },
                dataType: "json",
                success: function(details) {

                    menu[details[0]['menu_id']] = details[0];
                    setModalValues(details[0]['menu_id']);
                }
            });

        }
    });
});

function setModalValues(menu_id){    
    $("#menu_id").attr("data-menuid", menu[menu_id]["menu_id"]);
    $("#menu_modal").find("img").attr("src") = "media/"+menu[menu_id]['menu_image'];
    $("#menu_name").text(menu[menu_id]['menu_name']);
    // $("#desc").text(menu[menu_id]['menu_description']);
    $("#menu_availability").text(menu[menu_id]['menu_availability']);
    //SIZES
    if(menu[menu_id]["sizes"].length === 1){
        $("#sizeable").css("display","none");
        $("#menu_price").text(menu[menu_id]["sizes"][0]['size_price']);
        $("input [name='price']").val(menu[menu_id]["sizes"][0]['size_price']);
    }else{
        var size = "<option value=''></option>";        
        $("#sizeable").css("display","block");
        for(var x = 0 ; x < menu[menu_id]["sizes"].length ; x++ ){            
            $("#size").append(size);
            $("#size").last().val(menu[menu_id]["sizes"][x]["size_name"]);
            $("#size").last().text(menu[menu_id]["sizes"][x]["size_name"]);
        }
        $("#size").first().attr("selected","selected");
    }
    //TEMPERATURE
    if(menu[menu_id]['temp'] === 'hc'){
        $("#temperature").css("display","block");
    }else{
        $("#temperature").css("display","none");
    }
    //ADDONS
    if(menu[menu_id]['addons'].length === 0){
        
    }
}
function closeModal(){
    $("#menu_name").empty();
    $("#menu_price").empty();
    $("#size").empty();
    $("#menu_availability").empty();
    $("#menu_modal").find("img").attr("src") = "";
    $("addon");   
    $("#menu_id").attr("data-menuid", "");
}
</script>
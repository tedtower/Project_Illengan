<script>
<?php
    $menu_array = json_encode($menu);
    $pref_array = json_encode($pref_menu);
    $addon_array = json_encode($addons);
    $orders_array = json_encode($orders);
    echo "var menu =".$menu_array.";\n";
    echo "var pref =".$pref_array.";\n";
    echo "var addon =".$addon_array.";\n";
    if(isset($orders)){
        echo "var orders =".$orders_array.";\n";
    }else{
        echo "var orders = [];\n";
    }
?>
    var selected_addons = [],
        oc=0, ac=0, order="",
        menu_addon, mainSubtotal = 0,
        addonSubtotal = 0;
 
$(document).ready(function(){
    //On click Menu card
    $('a.menu_card').on('click',function(){
        unsetModalContents();        
        var item_id = $(this).attr('id');
        setModalContents(item_id);       
        $('#menu_modal').modal('show');
    });
    $("#qtyIncrement").on('click',function(){
        var quantity = parseInt($("#quantity").val());
        if(isNaN(quantity)){
            $("#quantity").val(1); 
        }else if (quantity < 1){
            $("#quantity").val(1);
        }else{
            quantity++;
            $("#quantity").val(quantity);
        }
        computeSubtotal();
    });
    $("#qtyDecrement").on('click',function(){
        var quantity = parseInt($("#quantity").val());
        if(isNaN(quantity)){
            $("#quantity").val(1); 
        }else if (quantity == 1){
            $("#quantity").val(1);
        }else{
            quantity--;
            $("#quantity").val(quantity);
        }
        computeSubtotal();
        console.log($("#dc_subtotal").val());
    });         

    $("#quantity").on('change', function(){
        var quantity = parseInt($(this).val());
        if(isNaN(quantity)){
            $(this).val(1); 
        }else if (quantity < 1){
            $(this).val(1);
        }
        computeSubtotal();
        console.log($("#dc_subtotal").val());
    });

    $('#addonSelectBtn').on('click', function(event){
        var ao_select = `<!--Select For Addons-->
            <div class="input-group mb-3 delius">
                <select class="browser-default custom-select w-50 addonSelect" name="addon[]">
                    <option selected disabled>Choose...</option>
                </select>
                <input type="number" min="1" placeholder="Qty" aria-label="Add-on Quantity"
                class="form-control" name="addonQty[]">
                <div class="input-group-prepend">
                    <!--Subtotal-->
                    <span class="aoSub mt-2 ml-1"></span>
                    <div class="rem_add mt-2">
                        <!--Delete Button-->
                        <a href="javascript:void(0)" class="text-danger ml-1 px-2"><i class="fal fa-times"></i></a>
                    </div>
                </div>
            </div>`;

        event.stopImmediatePropagation();    
        $("#ao_select_div").append(ao_select);
        for(var z=0; z<menu_addon.length; z++){
            $('#ao_select_div select[name="addon[]"]').eq($("#ao_select_div").children().length-1).append('<option class="addons" data-price="'+menu_addon[z].ao_price+'" data-name="'+menu_addon[z].ao_name+'" value="'+menu_addon[z].ao_id+'">'+menu_addon[z].ao_name+' - '+menu_addon[z].ao_price+'php</option>');
        }

        $("input[name='addonQty[]']").on('change',function(){
            var addonQty = parseInt($(this).val());
            if(isNaN(addonQty)){
                addonQty = 1;
                $(this).val(1);
            }else if(addonQty < 1){                
                addonQty = 1;
                $(this).val(1);
            }
            computeSubtotal();
        });

        $("select[name='addon[]']").on('change',function(){
            computeSubtotal();
        });
    });

    $("#menumodalform").on('submit', function(event) {        
        event.preventDefault();
        var prefId;
        if($("#sizeInput").is(":disabled")){
            prefId = parseInt($("#sizeSelect").val());
        }else{
            prefId = parseInt($("#sizeInput").attr('value'));
        }
        var qty = parseInt($("#quantity").val());
        var remarks = $("#menu_note").val();
        var addonIds = [];
        var addonQtys = [];
        for (var index = 0; index < $(this).find("select[name='addon[]']").length; index++) {
            addonIds.push($(this).find("select[name='addon[]']").eq(index).val());
            addonQtys.push($(this).find("input[name='addonQty[]']").eq(index).val());
        }
        $('#menu_modal').modal('hide');
        $.ajax({
            method: "post",
            url: "<?php echo site_url('customer/menu/addOrder')?>",
            data: {
                preference: prefId,
                quantity: qty,
                remarks: remarks,
                addons: JSON.stringify({                
                    "addonIds": addonIds,
                    "addonQtys": addonQtys,
                    "addonSubtotals" : []
                })            
            },
            beforeSend: function(){
                console.log(prefId, qty, remarks);
            },
            success: function(data) {
                alert("Menu has been added in the orderlist.");
                console.log(data);
            },
            error: function(response,setting, errorThrown) {
                console.log(response.responseText);
                console.log(errorThrown);
            }
        });
    });
});

function setOrderslipModal(cart){
    console.log(cart);
}

function unsetModalContents(){      
    $('span#mid').text('');
    $('#quantity').val(1);
    $('#sizeSelect').attr('disabled','disabled'); 
    $('#sizeSelect').empty();
    $("#sizeInput").attr('data-price','');
    $("#sizeInput").val('');
    $('#sizeInput').attr('disabled','disabled');
    $('#sizeable').hide();
    $('#addonSelectBtn').attr('disabled','disabled');
    $('#ao_select_div').empty();
    $('#addonable').hide();
    $('textarea#menu_note').val('');
    $("#menuSubtotal").text('');
}

function setModalContents(item_id){
    $('span#mid').text(item_id);
    for(var i = 0; i < menu.length; i++) {
        if(menu[i].menu_id == item_id) {
            var menu_pref = jQuery.grep(pref,function(obj){
                return obj.menu_id == item_id;
                });
            menu_addon = jQuery.grep(addon,function(obj){
                return obj.menu_id == item_id;
                });
            $('#menu_name').text(menu[i].menu_name);
            if(menu[i].menu_image){
                $('#menu_image').attr("src","<?php echo cmedia_url(); ?>menu/"+menu[i].menu_image);
            } else {
                $('#menu_image').attr("src","<?php echo cmedia_url(); ?>menu/no_image.jpg");
            }
            $('#menu_price').text(menu[i].pref_price);
            $('#menu_description').text(menu[i].menu_description);
            if(menu[i].menu_availability === 'available'){
                $('#menu_status').text(menu[i].menu_availability.charAt(0).toUpperCase() + menu[i].menu_availability.slice(1));
                $('#menu_status').attr("class","teal-text");
                $('#order-details').show();
                $('.save-order').show();
            } else {
                $('#menu_status').text("Temporarily Unavailable");
                $('#menu_status').attr("class","text-danger");
                $('#order-details').hide();
                $('.save-order').hide();
            }
            if(menu_pref.length > 1){                
                $('#sizeable').show();                
                $("#sizeSelect").removeAttr('disabled');
                for(var x=0; x<menu_pref.length; x++){
                    $('#sizeSelect').append('<option data-price="'+menu_pref[x].pref_price+'" data-name="'+menu_pref[x].size_name+'" value="'+menu_pref[x].pref_id+'">'+menu_pref[x].preference+'</option>');
                }
                $("#sizeSelect").on('change',function(){
                    computeSubtotal();
                    console.log($("#dc_subtotal").val());
                });                
                $("#menuSubtotal").text(parseFloat($("#sizeSelect > option:selected").attr("data-price")));
            }else{
                $("#sizeInput").removeAttr('disabled');
                $("#sizeInput").attr("value", menu_pref[0].pref_id);
                $("#sizeInput").attr("data-price", menu_pref[0].pref_price);
                $("#menuSubtotal").text(parseFloat(menu_pref[0].pref_price));
            }
            if(menu_addon.length > 0){
                $("#addonSelectBtn").removeAttr('disabled');
                $('#addonable').show();
                // if(menu_addon.length != 1){
                //     $('div.add_butt').show();
                //     $('div.rem_add').show();
                // }else{
                //     $('div.add_butt').hide();
                //     $('div.rem_add').hide();
                //}
            }
            break;
        }
    }
}
function computeSubtotal(){
    var addon = 0;
    var addonQty = 0;
    var aoSub = 0;
    var addonSubtotal = 0;
    var mainSubtotal = 0;
    var prefPrice = 0;
    var quantity = parseInt($("#quantity").val());
    if(!$("#sizeSelect").is(":disabled")){
        prefPrice = parseFloat($("#sizeSelect > option:selected").attr("data-price"));
    }else{
        prefPrice = parseFloat($("#sizeInput").attr("data-price"));
    }
    mainSubtotal = quantity * prefPrice;
    if($("select[name='addon[]']").length > 0){
        for (var index = 0; index < $("select[name='addon[]']").length ; index++){
            addon = parseFloat($("select[name='addon[]']").eq(index).find("option:selected").attr("data-price"));
            addonQty = parseInt($("input[name='addonQty[]']").eq(index).val());
            if(isNaN(addon)){
                addon = 0;
            }
            if(isNaN(addonQty)){
                addonQty = 1;
            }
            aoSub = addon * addonQty;
            addonSubtotal += aoSub;
            $("span[class~='aoSub']").eq(index).text(aoSub);
        }
    }
    $("#menuSubtotal").text(mainSubtotal+addonSubtotal);
}

</script>
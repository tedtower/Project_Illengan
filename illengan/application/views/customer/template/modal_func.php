<script>
<?php
    $menu_array = json_encode($menu);
    $pref_array = json_encode($pref_menu);
    $addon_array = json_encode($addons);
    echo "var menu =".$menu_array.";\n";
    echo "var pref =".$pref_array.";\n";
    echo "var addon =".$addon_array.";\n";
?>
    var orders = [],
        selected_addons = [],
        oc=0, ac=0, order="",
        menu_addon, mainSubtotal = 0,
        addonSubtotal = 0;
 
$(document).ready(function(){
    //On click Menu card
    $('a.menu_card').on('click',function(){
        unsetModalContents();        
        var item_id = $(this).attr('id');
        setModalContents(item_id);
        $("#qtyIncrement").on('click',function(){            
            var quantity = 1;
            if(!isNaN(parseInt($('#quantity').val()))){
                quantity = parseInt($("#quantity").val())+1;
                $("#quantity").val(quantity);
                console.log(quantity);
            }else{
                $("#quantity").val(quantity);
            }    
            if($("#sizeInput").is(":disabled")){
                mainSubtotal = parseFloat($("#sizeSelect > option:selected").data("price"));
            }else{
                mainSubtotal = parseFloat($("#sizeInput").data("price"));
            }
            mainSubtotal = mainSubtotal*quantity;
            mainSubtotal = mainSubtotal+addonSubtotal;
            $("#menuSubtotal").text(mainSubtotal);
        });
        $("#qtyDecrement").on('click',function(){            
            var quantity = 1;
            if(!isNaN(parseInt($('#quantity').val()))){ 
                quantity = parseInt($("#quantity").val()) - 1;
                $("#quantity").val(quantity);
                console.log(quantity);
            }else{
                $("#quantity").val(quantity);
            }    
            if($("#sizeInput").is(":disabled")){
                mainSubtotal = parseFloat($("#sizeSelect > option:selected").data("price"));
            }else{
                mainSubtotal = parseFloat($("#sizeInput").data("price"));
            }
            mainSubtotal = mainSubtotal*quantity;
            mainSubtotal = mainSubtotal+addonSubtotal;
            $("#menuSubtotal").text(mainSubtotal);
        });         
        $("#quantity").on('change', function(){
            var quantity = 1;
            if(!isNaN(parseInt($(this).val()))){
                quantity = parseInt($(this).val());
            }else{
                $(this).val(quantity);
            }    
            if($("#sizeInput").is(":disabled")){
                mainSubtotal = parseFloat($("#sizeSelect > option:selected").data("price"));
            }else{
                mainSubtotal = parseFloat($("#sizeInput").data("price"));
            }
            mainSubtotal = mainSubtotal*quantity;
            mainSubtotal = mainSubtotal+addonSubtotal;
            $("#menuSubtotal").text(mainSubtotal);
        });

        $("#sizeSelect").on('change',function(){
            var quantity = 0;
            mainSubtotal = 0;
            if(!isNaN(parseInt($('#quantity').val()))){
                quantity = parseInt($('#quantity').val());
            }
            if(!isNaN(parseFloat($(this).find('option:selected').data('price')))){            
                mainSubtotal = parseFloat($("#sizeSelect > option:selected").data("price")) * quantity;
            }
            mainSubtotal = mainSubtotal+addonSubtotal;
            $("#menuSubtotal").text(mainSubtotal);
        });        
        $('#menu_modal').modal('show');
    });

    /*$(document).ready(function(){
        $("select#size").change(function(){
            var selectedPrice = $(this).children("option:selected").val();
            $('span#menu_price').text(selectedPrice);
    });*/

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
            addonSubtotal = 0;
            var aoSub = 0;
            $("input[name='addonQty[]']").each(function(index){            
                if(!isNaN(parseInt($("select[name='addon[]']").eq(index).val())) && !isNaN(parseInt($(this).val()))){
                    aoSub = parseFloat($("select[name='addon[]']").eq(index).find('option:selected').data("price")) * parseInt($(this).val());
                    $("span[class~='aoSub']").eq(index).text(aoSub);
                    addonSubtotal += aoSub;
                }else if(isNaN(parseInt($(this).val())) && !isNaN(parseFloat($("select[name='addon[]']").eq(index).find('option:selected').data('price')))){
                    $(this).val(1);
                    aoSub = parseFloat($("select[name='addon[]']").eq(index).find('option:selected').data('price'));
                    addonSubtotal += aoSub;
                    $("span[class~='aoSub']").eq(index).text(aoSub);
                }
            });
            addonSubtotal = addonSubtotal+mainSubtotal;
            $("#menuSubtotal").text(addonSubtotal);
        });

        $("select[name='addon[]']").on('change',function(){
            addonSubtotal = 0;
            var aoSub = 0;
            $("select[name='addon[]']").each(function(index){            
                if(!isNaN(parseInt($("input[name='addonQty[]']").eq(index).val())) && !isNaN(parseFloat($(this).val()))){
                    aoSub = parseFloat($(this).find('option:selected').data("price")) * parseInt($("input[name='addonQty[]']").eq(index).val());
                    $("span[class~='aoSub']").eq(index).text(aoSub);
                    addonSubtotal = addonSubtotal + aoSub;
                }else if(isNaN(parseInt($("input[name='addonQty[]']").eq(index).val())) && !isNaN(parseInt($(this).val()))){
                    $("input[name='addonQty[]']").eq(index).val(1);
                    aoSub = parseFloat($(this).find('option:selected').data("price"));
                    addonSubtotal += aoSub;
                    $("span[class~='aoSub']").eq(index).text(aoSub);
                }
            });
            addonSubtotal += mainSubtotal;
            $("#menuSubtotal").text(addonSubtotal);
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
            }else{
                $("#sizeInput").removeAttr('disabled');
                $("#sizeInput").attr("value", menu_pref[0].pref_id);
                $("#sizeInput").attr("data-price", menu_pref[0].pref_price);
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
            var quantity = 1;
            if(!isNaN(parseInt($("#quantity").val()))){
                quantity = parseInt($("#quantity").val());
            }else{
                $("#quantity").val(quantity);
            }    
            if($("#sizeInput").is(":disabled")){
                mainSubtotal = parseFloat($("#sizeSelect > option:selected").data("price"))*quantity;
            }else{
                mainSubtotal = parseFloat($("#sizeInput").data("price"))*quantity;
            }
            $("#menuSubtotal").text(mainSubtotal);
            break;
        }
    }
}

</script>
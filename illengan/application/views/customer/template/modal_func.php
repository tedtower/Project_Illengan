<script>
<?php
    $menu_array = json_encode($menu);
    $pref_array = json_encode($pref_menu);
    $addon_array = json_encode($addons);
    echo "var menu =".$menu_array.";\n";
    echo "var pref =".$pref_array.";\n";
    echo "var addon =".$addon_array.";\n";
?>
var orders = [], oc=0;
var selected_addons = [], ac=0;
var order = "";
var menu_addon;
var mainSubtotal = 0;
var addonSubtotal = 0;
$(document).ready(function(){
    //On click Menu card
    $('a.menu_card').on('click',function(){
        unsetModalContents();        
        var item_id = $(this).attr('id');
        setModalContents(item_id);        
        $('#menu_modal').modal('show');
    });
    
    $("#quantity").on('change', function(){
        var quantity = 0;
        if($(this).val()!= undefined ){
            quantity = parseInt($(this).val());       
        }        
        if($("#sizeInput").is(":disabled")){
            mainSubtotal = parseFloat($("#sizeSelect > option:selected").data("price"));
        }else{
            mainSubtotal = parseFloat($("#sizeInput").data("price"));
        }
        mainSubtotal *= quantity;
        mainSubtotal += addonSubtotal;
        $("#menuSubtotal").text(mainSubtotal);
    });

    $("#sizeSelect").on('change',function(){
        var quantity = 0;
        mainSubtotal = 0;
        if(!isNaN(parseInt($('#quantity').val()))){
            quantity = parseInt($('#quantity').val());
        }
        if(!isNaN(parseInt($(this).find('option:selected').data('price')))){            
            mainSubtotal = parseFloat($("#sizeSelect > option:selected").data("price")) * quantity;
        }
        mainSubtotal += addonSubtotal;
        $("#menuSubtotal").text(mainSubtotal);
    });
    // Computing Subtotal of Menu Item (Total Price per Item)

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
                                        <span class="ao_subtotal mt-2 ml-1" id="">50.00</span>
                                        <div class="rem_add mt-2">
                                            <!--Delete Button-->
                                            <a href="javascript:void(0)" class="text-danger ml-1 px-2"><i
                                                    class="fal fa-times"></i></a>
                                        </div>
                                    </div>
                                </div>`;
        event.stopImmediatePropagation();    
        $("#ao_select_div").append(ao_select);
        for(var z=0; z<menu_addon.length; z++){
            $('#ao_select_div select[name="addon[]"]').eq($("#ao_select_div").children().length-1).append('<option class="addons" data-price="'+menu_addon[z].ao_id+'" data-name="'+menu_addon[z].ao_price+'" value="'+menu_addon[z].ao_id+'">'+menu_addon[z].ao_name+' - '+menu_addon[z].ao_price+'php</option>');
        }

        $("input[name='addonQty[]']").on('change',function(){
            addonSubtotal = 0;
            $("input[name='addonQty[]']").each(function(index){            
                if(!isNaN(parseInt($("select[name='addon[]']").eq(index).val())) && !isNaN(parseInt($(this).val()))){
                    addonSubtotal += parseFloat($("select[name='addon[]']").eq(index).find('option:selected').data("price")) * parseInt($(this).val());
                }
            });
            addonSubtotal += mainSubtotal;
            $("#menuSubtotal").text(addonSubtotal);
        });

        $("select[name='addon[]']").on('change',function(){
            addonSubtotal = 0;
            $("select[name='addon[]']").each(function(index){            
                if(!isNaN(parseInt($("input[name='addonQty[]']").eq(index).val())) && !isNaN(parseFloat($(this).val()))){
                    addonSubtotal += parseFloat($(this).find('option:selected').data("price")) * parseInt($("input[name='addonQty[]']").eq(index).val());
                }
            });
            addonSubtotal += mainSubtotal;
            $("#menuSubtotal").text(addonSubtotal);
        });
    });
    $("#menumodalform").on('submit', function(event) {
        var prefId;
        if($("#sizeInput").is(":disabled")){
            prefId = parseInt($("#sizeSelect > option:selected").data("id"));
        }else{
            prefId = parseInt($("#sizeInput").val());
        }        
        var qty = parseInt($("#quantity").val());
        var remarks = $("#menu_note").val();
        var addonIds = [];
        var addonQtys = [];
        for (var index = 0; index < $(this).find("select[name='addon[]']").length; index++) {
            addonIds.push($(this).find("select[name='addon[]']").eq(index).val());
            addonQtys.push($(this).find("input[name='addon_qty[]']").eq(index).val());
        }
        $.ajax({
            method: "post",
            url: "<?php echo site_url('customer/menu/addorder')?>",
            data: {
                preference: prefId,
                quantity: qty,
                remarks: remarks,
                addons: JSON.stringify({                
                    "addon_id": addonIds,
                    "addon_qty": addonQtys
                })            
            },
            beforeSend: function(){
                console.log(prefId, qty, remarks);
            },
            success: function() {
                alert("success!!");
            },
            error: function() {
                alert("there was an error");
            }
        });
        event.preventDefault();
    });

    // $('a[href="#order_modal"]').on('click',function(){
    //     $.ajax({
    //         method: 'POST',
    //         url: 'customer/menu/orderlist/view',
    //         dataType: 'JSON',
    //         success: function(cart){
    //             setOrderslipModal(cart);
    //         },
    //         error: function(){
    //             alert("asdgaksfngasd");
    //         }
    //     });
    // });
});
function setOrderslipModal(cart){
    console.log(cart);
}
function unsetModalContents(){        
    $('span#mid').text('');
    $('#sizeSelect').attr('disabled','disabled');    
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
            if(menu_pref.length !== 1){                
                $('#sizeable').show();                
                $("#sizeSelect").removeAttr('disabled');
                for(x=0; x<menu_pref.length; x++){
                    $('#sizeSelect').append('<option data-price="'+menu_pref[x].pref_price+'" data-name="'+menu_pref[x].size_name+'" value="'+menu_pref[x].pref_id+'">'+menu_pref[x].preference+'</option>');
                }
            }else{
                $("#sizeInput").removeAttr('disabled');
                $("#sizeInput").data("price") = menu[0].pref_price;
                $("#sizeInput").val(menu_pref[0].pref_id);
            }
            if(menu_addon.length > 0){
                $("#addonSelectBtn").removeAttr('disabled');
                $('#addonable').show();
                for(var z=0; z<menu_addon.length; z++){
                        $('#addon').append('<option class="addons" id="'+menu_addon[z].ao_id+'" data-name="'+menu_addon[z].ao_name+'" value="'+menu_addon[z].ao_price+'">'+menu_addon[z].ao_name+' - '+menu_addon[z].ao_price+'php</option>');
                }
                if(menu_addon.length != 1){
                    $('div.add_butt').show();
                    $('div.rem_add').show();
                }else{
                    $('div.add_butt').hide();
                    $('div.rem_add').hide();
                }
            }
            break;
        }
    }
}
</script>
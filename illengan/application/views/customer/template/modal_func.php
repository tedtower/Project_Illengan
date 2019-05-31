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
        var subtotal = $("#menuSubtotal").text();
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
                subtotal: subtotal,
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
                location.reload();
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
        if(menu[i].mID == item_id) {
            var menu_pref = jQuery.grep(pref,function(obj){
                return obj.mID == item_id;
                });
            menu_addon = jQuery.grep(addon,function(obj){
                return obj.mID == item_id;
                });
            $('#menu_name').text(menu[i].mName);
            if(menu[i].mImage){
                $('#menu_image').attr("src","<?= cmedia_url(); ?>menu/"+menu[i].mImage);
            } else {
                $('#menu_image').attr("src","<?= cmedia_url(); ?>menu/no_image.jpg");
            }
            $('#menu_price').text(menu[i].prPrice);
            $('#menu_description').text(menu[i].mDesc);
            
            if(menu[i].mAvailability === 'available'){
                $('#menu_image').css('filter',"brightness(100%)");
                $('#menu_status').text(menu[i].mAvailability.charAt(0).toUpperCase() + menu[i].mAvailability.slice(1));
                $('#menu_status').attr("class","teal-text");
                $('#order-details').show();
                $('.save-order').show();
                $('#submit_ol').show();
            } else {
                $('#menu_image').css('filter',"brightness(40%)");
                $('#menu_status').text('Unavailable');
                $('#menu_status').attr("class","text-danger");
                $('#order-details').hide();
                $('.save-order').hide();
                $('#submit_ol').hide();
            }
            if(menu_pref.length > 1){                
                $('#sizeable').show();                
                $("#sizeSelect").removeAttr('disabled');
                for(var x=0; x<menu_pref.length; x++){
                    $('#sizeSelect').append('<option data-price="'+menu_pref[x].prPrice+'" data-name="'+menu_pref[x].prName+'" value="'+menu_pref[x].prID+'">'+menu_pref[x].preference+'</option>');
                }
                $("#sizeSelect").on('change',function(){
                    $('#menu_price').text($("#sizeSelect > option:selected").attr("data-price"));
                    computeSubtotal();
                });  
                $(document).ready(function() {
                if($('#dc_subtotal').val() != null) {
                dc_subtotal = parseFloat($('#dc_subtotal').val());
                $("#menuSubtotal").text(dc_subtotal);
                $("#itemSubtotal").val(dc_subtotal);
                } else {         
                $("#menuSubtotal").text(parseFloat($("#sizeSelect > option:selected").attr("data-price")));
                $("#itemSubtotal").val(parseFloat($("#sizeSelect > option:selected").attr("data-price")));
                }
            });
            }else{
                $("#sizeInput").removeAttr('disabled');
                $("#sizeInput").attr("value", menu_pref[0].prID);
                $("#sizeInput").attr("data-price", menu_pref[0].prPrice);
                $("#menuSubtotal").text(parseFloat(menu_pref[0].prPrice));
            }
            if(menu_addon.length > 0){
                $("#addonSelectBtn").removeAttr('disabled');
                $('#addonable').show();
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
    if($('#dc_subtotal').val() != null) {
        mainSubtotal = parseFloat($('#dc_subtotal').val());
    } else {
    if(!$("#sizeSelect").is(":disabled")){
        prefPrice = parseFloat($("#sizeSelect > option:selected").attr("data-price"));
    }else{
        prefPrice = parseFloat($("#sizeInput").attr("data-price"));
    }
    mainSubtotal = quantity * prefPrice;
    }
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
$('#omButton').click(function(){
    setOrderlist();
});
$('#ceoButton').click(function(){
    $('#editModal').modal('hide');
});
$('#cosButton').click(function(){
    $('#proceed_modal').modal('hide');
});
$('#croButton').click(function(){
    $('#deleteModal').modal('hide');
});
$('#craoButton').click(function(){
    $('#deleteAllModal').modal('hide');
});
function setOrderlist() {
    $('#orderlists').html('');
    var total_qty=0, total=0;
    for(var rowid=0; rowid < orders.length; rowid++){
        var row1 = `<tr>
                        <form type="hidden" name="`+orders[rowid].id+`">
                        <th scope="row">`+orders[rowid].name+`</th>
                        <td>`+orders[rowid].qty+`</td>
                        <td>`+orders[rowid].subtotal+`</td>
                        <td>`+orders[rowid].remarks+`</td>
                        <td>`+orders[rowid].addons+`</td>
                        <td>
                            <button type="button" class="btn btn-mdb-color btn-sm m-0 p-2" data-toggle="modal" data-target="#editModal">Edit</button>
                            <button type="button" class="btn btn-danger btn-sm m-0 p-2 remOrder" data-toggle="modal" data-target="#deleteModal" data-name="`+orders[rowid].name+`" data-id="`+rowid+`">Remove</button>
                        </td>
                    </tr>`;
        $('#orderlists').append(row1);
        total_qty += orders[rowid].qty;
        total += orders[rowid].subtotal;
    }
    var row2 = `<tr>
                    <td colspan="3"><h3 class="gab">Total Quantity: `+total_qty+`</h3></td>
                    <td colspan="3"><h3 class="gab">Total Price: `+total+` php</h3></td>
                    <input type="hidden" name="total" value="`+total+`"/>
                </tr>`;
    $('#orderlists').append(row2);
    $('.remOrder').click(function(){
        $('#remName').text("'"+$(this).data('name')+"'");
        $('#remID').val($(this).data('id'));
        console.log($('#remID').val());
    });
    $('#removo').click(function(){
        var rowID = $('#remID').val();
        var rowName = $('#remName').text();
        $.ajax({
            method: "post",
            url: "<?= site_url('customer/menu/removeOrder')?>",
            data: { id: rowID },
            success: function($data) {
                $('#remID').val('');
                $('#remName').text('');
                location.reload();
            },
            error: function(response,setting, errorThrown) {
                console.log(response.responseText);
                console.log(errorThrown);
            }
        });
    });
}
</script>

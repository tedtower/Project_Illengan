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


$(document).ready(function(){
    $("select#size").change(function(){
        var selectedPrice = $(this).children("option:selected").val();
        $('span#menu_price').text(selectedPrice);
    });
});

$('a.menu_card').click(function(){
    $('#size option').remove();
    $('#addon option.addons').remove();
    $('div.ao').remove();
    $('textarea#menu_note').val('');
    var item_id = $(this).attr('id');
    $('span#mid').text(item_id);
    for(var i = 0; i < menu.length; i++) {
        if(menu[i].menu_id == item_id) {
            var menu_pref = jQuery.grep(pref,function(obj){return obj.menu_id == item_id;});
            var menu_addon = jQuery.grep(addon,function(obj){return obj.menu_id == item_id;});
            $('#menu_name').text(menu[i].menu_name);
            if(menu[i].menu_image){
                $('#menu_image').attr("src","<?php echo cmedia_url(); ?>menu/"+menu[i].menu_image);
            } else {
                $('#menu_image').attr("src","<?php echo cmedia_url(); ?>menu/no_image.jpg");
            }
            $('#menu_price').text(menu[i].pref_price);
            $('#menu_description').text(menu[i].menu_description);
            if(menu[i].menu_availability == 'available'){
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
            if(menu_pref.length == 1){
                $('#sizable').hide();
            }else{
                $('#sizable').show();
                for(x=0; x<menu_pref.length; x++){
                    $('#size').append('<option data-id="'+menu_pref[x].pref_id+'" data-name="'+menu_pref[x].size_name+'" value="'+menu_pref[x].pref_price+'">'+menu_pref[x].preference+'</option>');
                }
            }
            if(menu_addon.length > 0){
                $('#addonable').show();
                for(z=0; z<menu_addon.length; z++){
                        $('#addon').append('<option class="addons" id="'+menu_addon[z].ao_id+'" data-name="'+menu_addon[z].ao_name+'" value="'+menu_addon[z].ao_price+'">'+menu_addon[z].ao_name+' - '+menu_addon[z].ao_price+'php</option>');
                }
            }else{
                $('#addonable').hide();
            }
            break;
        }
    }
    $('#menu_modal').modal('show');
});

$('button#save_order').click(function(){
    
	$.ajax({
		url : "<?php echo site_url('add_order');?>",
		method : "POST",
		data : {id:mi, price:up, qty:q},
		success : function()
		{
            alert("Saved to Orderlist!!");
		},
		error : function()
		{
			console.log('ERROR: ');
		}
	});
});

$('button#add_addon').click(function(){
    var add_exist = 0;
    if(selected_addons.length > 0){
        $.each(selected_addons, function(a, ao){
            if(ao.name == $('select#addon option:selected').data("name")){
                addExistOns(a);
                add_exist++;
            }
        });
        if(add_exist != 1){
            addOns();
        }
        add_exist = 0;
    }else{
        addOns();
    }
});
/*
function addOrder(pid,sn,mi,up,q,n){
    setOrder(pid,sn,up,q,n);
    orders.push({});
    orders[oc].order = [];
    orders[oc].menu_id = mi;
    orders[oc].order.push(order);
    selected_addons = [];
    console.log(orders);
    console.log(orders[oc].order.length);
    oc++;
}

function addExistOrder(aeo,pid,sn,mi,up,q,n){
    var existed = 0;
    for(var b=0; b<orders[aeo].order.length; b++){
        if(orders[aeo].unit_price == mi){
            orders[aeo].order[b].quantity = orders[aeo].quantity + q;
            orders[aeo].order[b].note = order[aeo].note + n;
            existed++;
            console.log(orders);
            break;
        }
    }
    if(existed == 1){
        orders[aeo].order = [];
        setOrder(pid,sn,up,q,n);
        orders[aeo].order.push(order);
        console.log(orders);
    }
}

function setOrder(pid,sn,up,q,n){
    if(selected_addons.length > 0){
        order = {pref_id:pid, s_name:sn, quantity:q, u_price:up, note:n, addons:selected_addons}
    }else{
        order = {pref_id:pid, s_name:sn, quantity:q, u_price:up, note:n}
    }
    
}

function addOns(){
    selected_addons.push({});
    selected_addons[ac].quantity = parseInt($('input#addon_qty').val());
    selected_addons[ac].name = $('select#addon option:selected').data("name");
    selected_addons[ac].u_price = parseInt($('select#addon option:selected').val());
    selected_addons[ac].t_price = $('select#addon option:selected').val()*selected_addons[ac].quantity;
    ac++
}
function addExistOns(ad){
    selected_addons[ad].quantity = selected_addons[ad].quantity + parseInt($('input#addon_qty').val());
    selected_addons[ad].t_price = $('select#addon option:selected').val()*selected_addons[ad].quantity;
}

function sendPost(){
    $.post('menu/add_order', orders, 
    function(returnedData){
         console.log(returnedData);
    }).fail(function(){
        console.log("error");
    });
}
*/
</script>
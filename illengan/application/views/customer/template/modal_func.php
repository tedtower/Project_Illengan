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


$(document).ready(function(){
    $("select#size").change(function(){
        var selectedPrice = $(this).children("option:selected").val();
        $('span#menu_price').text(selectedPrice);
    });
});

$('a.menu_card').click(function(){
    $('#size option').remove();
    $('div.ao').remove();
    $('textarea#menu_note').val('');
    var item_id = $(this).attr('id');
    $('span#mid').text(item_id);
    for(var i = 0; i < menu.length; i++) {
        if(menu[i].menu_id == item_id) {
            var menu_pref = jQuery.grep(pref,function(obj){return obj.menu_id == item_id;});
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
            }else {
                $('#sizable').show();
            }
            for(x=0; x<pref.length; x++){
                if(pref[x].menu_id == item_id){
                    $('#size').append('<option value="'+pref[x].pref_price+'">'+pref[x].preference+'</option>');
                }
            }
        }
    }
    $('#menu_modal').modal('show');
});

$('button#save_order').click(function(){
    orders.push({});
    orders[oc].menu_id = ('span#mid').text;
    orders[oc].unit_price = $('span#menu_price').text();
    orders[oc].quantity = $('input#quantity').val();
    orders[oc].note = $('textarea#menu_note').val();
    oc++;
});

</script>
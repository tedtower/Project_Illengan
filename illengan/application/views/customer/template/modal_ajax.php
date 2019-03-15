<script>
<?php
    $menu_array = json_encode($menu);
    $pref_array = json_encode($pref_menu);
    echo "var menu =".$menu_array.";\n";
    echo "var pref =".$pref_array.";\n";
?>

$('a.menu_card').click(function(){
    var item_id = $(this).attr('id');
    for(var i = 0; i < menu.length; i++) {
        if(menu[i].menu_id == item_id) {
            var menu_pref = jQuery.grep(pref,function(obj){return obj.menu_id == item_id;});
            $('#menu_name').text(menu[i].menu_name);
            if(menu[i].menu_image){
                $('#menu_image').attr("src","<?php echo cmedia_url(); ?>menu/"+menu[i].menu_image);
            } else {
                $('#menu_image').attr("src","<?php echo cmedia_url(); ?>menu/no_image.jpg");
            }
            $('#menu_price').text(menu[i].size_price);
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
        }
    }
    $('#menu_modal').modal('show');
});
</script>
<script>
<?php
    $menu_array = json_encode($menu);
    echo "var menu =".$menu_array.";\n";
?>
console.log(menu);
$('a.menu_card').click(function(){
    var item_id = $(this).attr('id');
    for(var i = 0; i < menu.length; i++) {
        if(menu[i].menu_id == item_id) {
            $('#menu_name').text(menu[i].menu_name);
            if(menu[i].menu_image){
                $('#menu_image').attr("src","<?php echo cmedia_url(); ?>menu/"+menu[i].menu_image);
            } else {
                $('#menu_image').attr("src","<?php echo cmedia_url(); ?>menu/no_image.jpg");
            }
            $('#menu_price').text(menu[i].size_price);
            $('#menu_description').text(menu[i].menu_description);
            $('#menu_status').text(menu[i].menu_availability);
            if(menu[i].menu_availability == 'available'){
                $('#menu_status').attr("class","teal-text");
            } else {
                $('#menu_status').attr("class","text-danger");
            }
        }
    }
    $.ajax({
        url: "<?php base_url(); ?>menu/details",
        method: 'POST',
        data: {mID: item_id}
    });
    $('#menu_modal').modal('show');
});
</script>
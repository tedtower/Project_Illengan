$(window).on('load',function(){
    $('#tableModal').modal('show');
});
var baseURL= "<?php echo base_url();?>";
$(document).ready(function(){

$('#menu_card').click(function(){
    var username = $(this).val();
        $.ajax({
        url:baseURL+'customer/menuDetails',
        method: 'post',
        data: {menu_id: menu_id},
        dataType: 'json',
        success: function(result){
        var len = result.length;

        if(len > 0){
        var mTitle = result[0].menu_name;
        var mNPrice = result[0].menu_price;
        var mAvail = result[0].menu_availability;

        $('#menIt').text(mTitle);
        $('#menPr').text(mPrice);
        $('#menAv').text(mAvail);
        $('#menu_modal').modal('show');

        }else{
        $('#menIt').text('');
        $('#menPr').text('');
        $('#menAv').text('');
        }

        }
        });
    });
});
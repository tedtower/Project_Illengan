promos();
function promos() {
    $(document).ready(function() {
        $.ajax({
            url: 'http://www.illengan.com/customer/promos',
            dataType : 'json',
            success: function(data) {
                var i;
                var d_menu_id;
                var menu_id;
                $('.indicate_promo').hide();

                for(i = 0; i < data.length ; i++) {
                    if(data[i].promo_id != null) {
                    d_menu_id = data[i].menu_id; // Ito yung menu id na galing sa database
                    menu_id = document.getElementById(d_menu_id); // kinuha ko yung div na yon gamit yung value ng id
                    $('.' + d_menu_id).show();
                    
                    }     
                }
                },
              failure: function() {
                  alert('There are no current promo for today.');
              } 
                
            });
                }); 
     
    };

    // function discounts(){
    //     $document.ready(function(){
    //         $.ajax({
    //             url: 'http://www.illengan.com/customer/discounts',
    //             dataType: 'json',
    //             success: function(data){
    //                 for(var i=0; x<data.length; i++){
    //                     if(data[i].)
                       
    //             }
    //         });
    //     });
    // }

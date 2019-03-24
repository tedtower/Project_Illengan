discounts();

function discounts() {
    $(document).ready(function() {
        $.ajax({
            url: 'http://www.illengan.com/customer/discounts',
            dataType : 'json',
            success: function(data) {
                var i;
                var d_menu_id;
                var menu_id;

                for(i = 0; i < data.length ; i++) {
                    d_menu_id = data[i].menu_id; // Ito yung menu id na galing sa database
                    menu_id = document.getElementById(d_menu_id); // kinuha ko yung div na yon gamit yung value ng id
                    menu_id.style.border = '10px solid purple'; // ito na yung part na pag add ng css kung background color 
                    // ilagagay mo kunwari ganito lang menu_id.style.backgroundColor = 'black'; ganern search mo na lang yung
                    // kung pano mag change ng css gamit javascript
                    
                }
                
            }
                }); 
     
    });
     }
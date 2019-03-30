
promos();
freebie_promos();

function hide_freebies() {
    $('.please').hide();
    var elements = document.getElementsByClassName('freeBOpt');
                    while(elements.length > 0){
                        elements[0].parentNode.removeChild(elements[0]);
                    }

}

function promos() {
    $(document).ready(function() {
        $.ajax({
            url: 'http://www.illengan.com/customer/promos',
            dataType : 'json',
            success: function(data) {
                var i, d_menu_id, menu_id;
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
                  alert('There are no current discounts for today.');
              } 
                
            });
                }); 
     
            };

function freebie_promos() {  
    $(document).ready(function() {
        var e = document.getElementById("sizeSelect");
        var v_pref_id = e.options[e.selectedIndex].value;
        var v_quantity;

        v_quantity = document.getElementById('quantity').value;
        console.log('Latest View Qty Entered: ' + v_quantity);

        $.ajax({
            type: 'POST',
            url: 'http://www.illengan.com/customer/freebies',
            data: {
            pref_id: v_pref_id
            }, 
            dataType: 'json',
         success: function(data) {
             var freeBQty, freebieDrop;
         
                if(v_quantity >= data[0].pc_qty && data[0].elective == 1){
                    freeBQty = data[0].fb_qty * parseInt(v_quantity / data[0].pc_qty);
                    //console.log('Total Freebies(Early): ' + freeBQty + ' | View Qty Entered: ' + v_quantity + ' | Constraint: ' + data[0].pc_qty);
                    $('.please').show();
                    var appendDivs = []; 

                for(var i = 0; i <= freeBQty - 1; i++ ) {
                    count = i+1;
                    appendDivs.push('<select class="freeBOpt browser-default custom-select"><option>Freebie '+count+'</option></select>');

                }
                var elements = document.getElementsByClassName('freeBOpt');
                    while(elements.length > 0){
                        elements[0].parentNode.removeChild(elements[0]);
                    }

                $('#freebie').append(appendDivs);
                
                for(var i = 0; i <= data.length; i++) {
                    optionsFB = '<option>'+data[i].fb_menuname+'</option>';
                    console.log(optionsFB);
                    $('.freeBOpt').append(optionsFB);
                }
                console.log('Total Freebies(Late): ' + freeBQty + ' ' + appendDivs.length);
                    
                       
                }
                // For freebie promos which have different freebie offers
                else if {
                    
                }
             
         },
         failure: function() {
            console.log('OH NO');

         }
        });
    });
}

promos();

function hide_freebies() {
    $('.please').hide();
    var elements = document.getElementsByClassName('freeBOpt');
                    while(elements.length > 0){
                        elements[0].parentNode.removeChild(elements[0]);
                    }
    var free_elements = document.getElementsByClassName('freebieQty');
                    while(free_elements.length > 0){
                        free_elements[0].parentNode.removeChild(free_elements[0]);
                    }
    var dc_elements = document.getElementsByClassName('dc_subtotal');
                    while(dc_elements.length > 0){
                        dc_elements[0].parentNode.removeChild(dc_elements[0]);
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

function freebies_discounts() {  
    $(document).ready(function() {
        var e = document.getElementById("sizeSelect");
        var v_pref_id, v_quantity;

        v_quantity = document.getElementById('quantity').value;
        
        try {
            v_pref_id = e.options[e.selectedIndex].value;
        } catch(err) {
            v_pref_id = $('#sizeInput').attr('value');
        }

        console.log('Latest View Qty Entered: ' + v_quantity + ' PrefId ' + v_pref_id);
        $.ajax({
            type: 'POST',
            url: 'http://www.illengan.com/customer/freebies_discounts',
            data: {
            pref_id: v_pref_id
            }, 
            dataType: 'json',
         success: function(data) {
             var freeBQty, freebieDrop;

            if(data.freebies.length != 0) {
                if(v_quantity >= data.freebies[0].pc_qty && data.freebies[0].elective == 1){
                    freeBQty = data.freebies[0].fb_qty * parseInt(v_quantity / data.freebies[0].pc_qty);
                    //console.log('Total Freebies(Early): ' + freeBQty + ' | View Qty Entered: ' + v_quantity + ' | Constraint: ' + data.freebie[0].pc_qty);
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
                
                try {
                for(var i = 0; i <= data.freebies.length; i++) {
                    optionsFB = '<option>'+data.freebies[i].fb_menuname+'</option>';
                    console.log(optionsFB);
                    $('.freeBOpt').append(optionsFB);
                }
                } catch(err) {

                }
                console.log('Total Freebies(Late): ' + freeBQty + ' data.freebies[0].menu_name ' + appendDivs.length);
                    
                       
                }
                // For freebie promos which have different freebie offers
               else if(v_quantity >= data.freebies[0].pc_qty && data.freebies[0].elective == 0) {
                hide_freebies();

                freeBQty = data.freebies[0].fb_qty * parseInt(v_quantity / data.freebies[0].pc_qty);
                $('#freebie').append('<p class="freebieQty">You have '+freeBQty+' '+data.freebies[0].menu_name+' for a freebie!</p>');

               }
            } else if(data.discounts.length != 0) {
                if(v_quantity >= data.discounts[0].pc_qty){
                hide_freebies();
                var dc_price = data.discounts[0].pref_price - data.discounts[0].dc_amt;
                var dc_qty = parseInt(v_quantity - (v_quantity % data.discounts[0].pc_qty));
                var sub_total = (dc_qty * dc_price) + ((dc_qty - v_quantity) * data.discounts[0].pref_price);
                var org_price = v_quantity * data.discounts[0].pref_price;
                $('#freebie').append('<input type="text" id="dc_subtotal" class="dc_subtotal" value="'+sub_total+'" hidden="hidden">'+
                '<p class="freebieQty" >A discounted price of '+sub_total+' PHP from a price of '+org_price+' PHP!</p>');
                $("#menuSubtotal").text(sub_total);
            } 
             
         }
        },
         failure: function() {
            console.log('OH NO');

         }
        });
    });
}

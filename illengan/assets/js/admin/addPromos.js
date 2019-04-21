addItemOptions();
addFreebie();
function removeOptions() {
    $(document).ready(function() {
        var opt_elements = document.getElementsByClassName('options');
                    while(opt_elements.length > 0){
                        opt_elements[0].remove(opt_elements[0]);
                    }
        var fbTab_elements = document.getElementsByClassName('pmTab');
                    while(fbTab_elements.length > 0){
                        fbTab_elements[0].remove(fbTab_elements[0]);
                    }
    });
}
function addItemOptions() {
    $(document).ready(function() {
    $.ajax({
        url: 'http://www.illengan.com/admin/jsonMenu',
        dataType: 'json',
        success: function(data) {
            var optArr = [];
            for(var i = 0; i <= data.length-1; i++) {
                var temp;
                if(data[i].temp == 'c') {
                    temp = 'Cold';
                } else if(data[i].temp == 'h') {
                    temp = 'Hot';
                } else {
                    temp = "";
                }
                var options = '<option class="options" value="'+data[i].prID+'">'+data[i].pref_menu+' '+temp+'</option>';
                optArr.push(options);

            }
            
            $('#menu_name').append(optArr);
            $('#dc_item').append(optArr);
            $('#fb_item').append(optArr);
        },
        failure: function() {
            console.error('oh no');
        }
    });
});
}

function addFreebie() {
    $(document).ready(function() {
        var count;
        $('#addFreebie1').on('click', function() {
            var fbTable = '<table class="table table-lg table-borderless fbTable pmTab">'+
        '<thead class="thead-light"><tr>'+
                '<th>Freebie Name</th><th>Freebie Type</th>' +
                '<th>Add Freebie</th></tr></thead>' +
        '<tbody><tr>' +
               ' <td><input type="text" name="fbName" id="fbName" class="form-control form-control-sm"></td>' +
               ' <td><select class="form-control" name="isElective" id="isElective">' +
                        '<option value="0" selected>Self Freebie</option>' +
                        '<option value="1">Freebie Selection</option></select></td>' +
                '<td><a id="addFreebie2" onclick="addSubFreebie();addItemOptions();" class="btn btn-primary btn-sm" style="color:blue">Add Freebies</a></td></tr></table>';
        $('#fbTable').append(fbTable);
        });
        
      
    });
    
}

function addSubFreebie() {
    $(document).ready(function() {
            var subTable = '<table id="subAddFreebie" class="table table-lg table-borderless pmTab">'+
            '<thead class="thead-light">'+
                '<tr><th>Menu Item</th>'+
                    '<th>Quantity Constraint</th>'+
                    '<th>Freebie Item</th>'+
                    '<th>Freebie Quantity</th></tr></thead>'+
            '<tbody><tr><td><select class="form-control promoOpt" name="menu_name" id="menu_name"></select></td>'+
                    '<td><input type="number" name="pcQty" id="pcQty" min="0" class="form-control form-control-sm"></td>'+
                    '<td><select class="form-control promoOpt" name="fb_item" id="fb_item"></select></td>'+
                    '<td><input type="number" name="fbQty" id="fbQty" min="0" class="form-control form-control-sm"></td>'+
                '</tr></table>';
            $('.fbTable').after(subTable);
    });
    
}

function addPromos() {
        var pmName = $('#pmName').val();
        var pmStartDate = $('#pmStartDate').val();
        var pmEndDate = $('#pmEndDate').val();
        console.log(pmName + ' '+ pmStartDate+ ' '+pmEndDate);

}




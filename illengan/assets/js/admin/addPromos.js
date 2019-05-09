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

$(document).ready(function() {
        var count;
        $('#addFreebie1').on('click', function() {
            var fbTable = '<table class="table table-lg table-borderless fbTable pmTab">'+
        '<thead class="thead-light"><tr>'+
                '<th>Freebie Name</th><th>Freebie Type</th>' +
                '<th>Add Freebie</th></tr></thead>' +
        '<tbody><tr>' +
               ' <td><input type="text" name="fbName" id="fbName" class="form-control form-control-sm"></td>' +
               ' <td><select class="isElective form-control" name="isElective" id="isElective">' +
                        '<option value="0" selected>Self Freebie</option>' +
                        '<option value="1">Freebie Selection</option></select></td>' +
                '<td><a id="addFreebie2" class="subFB btn btn-primary btn-sm" style="color:blue">Add Freebies</a></td></tr></table>';
        $('#fbTable').append(fbTable);

        $('.subFB').on('click', function() {
            var elective = $(this).closest("tr").find("td > select").val();
            var subTable;

            if(elective != 0) {
                subTable = '<table id="subAddFreebie" class="table table-lg table-borderless pmTab">'+
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
                $(this).closest('.pmTab').after(subTable);
                addItemOptions();
            } else {
                subTable = '<table id="subAddFreebie" class="table table-lg table-borderless pmTab">'+
            '<thead class="thead-light">'+
                '<tr><th>Menu Item</th>'+
                    '<th>Quantity Constraint</th>'+
                    '<th>Freebie Item</th>'+
                    '<th>Freebie Quantity</th></tr></thead>'+
            '<tbody><tr><td><select class="form-control promoOpt" name="menu_name" id="menu_name"></select></td>'+
                    '<td><input type="number" name="pcQty" id="pcQty" min="0" class="form-control form-control-sm"></td>'+
                    '<td><select class="form-control promoOpt" name="fb_item" id="fb_item" readonly="readonly" disabled></select></td>'+
                    '<td><input type="number" name="fbQty" id="fbQty" min="0" class="form-control form-control-sm"></td>'+
                '</tr></table>';
                $(this).closest('.pmTab').after(subTable);
                addItemOptions();
            }
            
        
        });
        });

});

function addPromos() {
        var pmName = $('#pmName').val();
        var pmStartDate = $('#pmStartDate').val();
        var pmEndDate = $('#pmEndDate').val();
        var elective = $('#isElective').val();
        var fbName = $('#fbName').val();
        var menuName = $('#menu_name').val();
        var pcQty = $('#pcQty').val();
        var menuFB = $('#fb_item').val();
        var fbQty = $('#fbQty').val();
        var pcType = 'f';
        var elements = document.getElementsByClassName('pmTab');
        
        console.log(elements);
        // var itemMerch = [];
        // var merch = [];
        // for (var i = 0; i <= elements.length - 1; i++) {
        //     vID = document.getElementsByName('vID')[i].value;
        //     poiName= document.getElementsByName('spmDesc')[i].value;
        //     poiQty = document.getElementsByName('vQty')[i].value;
        //     poiUnit = document.getElementsByName('vUnit')[i].value;
        //     poiPrice = document.getElementsByName('spmPrice')[i].value;
        //     poTotal = total;
    
        //     itemMerch = {
        //         'vID': vID,
        //         'poiName': poiName,
        //         'poiQty': poiQty,
        //         'poiUnit': poiUnit,
        //         'poiPrice': poiPrice,
        //         'poiStatus': 'pending',
        //         'poiRemarks': poRemarks
        //     };
        //     merch.push(itemMerch);
        //     console.log('spID' + spID);
        //     console.log('vID' + vID);
        //     console.log('poiQty' + poiQty);
        //     console.log('pU' + poiUnit);
        //     console.log(itemMerch);
        // }

        // console.log('---------------------------------------------------');
        // console.log(pmName + ' '+ pmStartDate+ ' '+pmEndDate);
        // console.log(elective+' '+fbName)
        // console.log('constraints'+pcQty+' '+menuFB+' '+fbQty+' menuwithFB '+menuName);
        // $.ajax({
        //     type: 'POST',
        //     url: 'http://www.illengan.com/admin/promos/add',
        //     data: {
        //         pmName: pmName,
        //         pmStartDate: pmStartDate,
        //         pmEndDate: pmEndDate,
        //         fbName: fbName,
        //         isElective: elective,
        //         prID: menuName,
        //         pcType: pcType,
        //         pcQty: pcQty,
        //         prIDfb: menuFB,
        //         fbQty: fbQty

        //     },
        //     success: function(data) {
        //         alert('Promo added');
        //     },
        //     failure: function() {
        //         console.error('oh no');
        //     }
        // });

}




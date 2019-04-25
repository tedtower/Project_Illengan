addSupplierOpts();
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
        var item_elements = document.getElementsByClassName('merchelem');
                    while(item_elements.length > 0){
                        item_elements[0].remove(item_elements[0]);
                    }

                   
    });
}


function addSupplierOpts() {
    $(document).ready(function() {
    $.ajax({
        url: 'http://www.illengan.com/admin/jsonSupp',
        dataType: 'json',
        success: function(data) {
            var optArr = [];
            for(var i = 0; i <= data.length-1; i++) {
                var options = '<option class="options" value="'+data[i].spID+'">'+data[i].spName+'</option>';
                optArr.push(options);

            }
            $('#spName').append(optArr);
        },
        failure: function() {
            console.error('oh no');
        }
    });
});
}

function setSuppMerchandise() {
    $(document).ready(function() {
        $.ajax({
            url: 'http://www.illengan.com/admin/jsonMerchandise',
            dataType: 'json',
            success: function(data) {
                var optArr = [];
                for(var i = 0; i <= data.length-1; i++) {
                    var options = '<label style="width:96%">'+
                    '<input type="checkbox" class="mr-2" value="'+data[i].spmID+'">'+
                    data[i].stName+' per '+data[i].spmUnit+'</label>';
                    optArr.push(options);
    
                }
                
                $('#spName').append(optArr);
            },
            failure: function() {
                console.error('oh no');
            }
        });
    });
    
}

function getSelectedMerch() {
    var value = 0;
    var choices = document.getElementsByClassName('merchChoice');
    for(var i = 0; i <= choices.length-1; i++) {
        if(choices[i].checked) {
            var value = choices[i].value;

            $.ajax({
            url: 'http://www.illengan.com/admin/jsonMerchandise',
            dataType: 'json',
            async: false,
            success: function(data) {
                for(var i = 0; i <= data.length-1; i++) {
                    var merchArr = [];
                    var merchChecked;
                    if(data[i].spmID === value) {
                        merchChecked = `<tr class="merchelem" data-id="`+data[i].spmID+`" data-varid="`+data[i].vID+`">
                            <input type="hidden" name="">
                            <td><input type="text" id="stName" name="merchName[]"
                                    class="form-control form-control-sm"  value="`+data[i].stName+`" readonly="readonly"></td>
                            <td><input type="number" id="vQty" name="poiQty[]"
                                    class="form-control form-control-sm" value="`+data[i].vQty+`" ></td>
                            <td><input type="text" id="vUnit" name="poiUnit[]"
                                    class="form-control form-control-sm"  value="`+data[i].vUnit+`" readonly="readonly"></td>
                            <td><input type="number" id="spmPrice" name="poiPrice[]"
                                    class="form-control form-control-sm"  value="`+data[i].spmPrice+`" readonly="readonly"></td>
                            <td><input type="number" id="subtotal" name="itemSubtotal[]"
                                    class="form-control form-control-sm" value="`+parseInt(data[i].spmPrice*data[i].vQty)+`" readonly="readonly"></td>
                            <td><img class="exitBtn"
                                    src="/assets/media/admin/error.png"
                                    style="width:20px;height:20px"></td>
                            </tr>`;
                            //merchArr.push(merchChecked);
                            $('.poItemsTable > tbody').append(merchChecked);
                    }
                    
                }
            }
        });
        }

        
    }

    
}
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
var countTr = 0;
function getSelectedMerch() {
    var value = 0;
    var choices = document.getElementsByClassName('merchChoice');
    var merchChecked;
    for(var i = 0; i <= choices.length-1; i++) {
        if(choices[i].checked) {
            var value = 0;
            value = choices[i].value;

            $.ajax({
            url: 'http://www.illengan.com/admin/jsonMerchandise',
            dataType: 'json',
            async: false,
            success: function(data) {
                for(var i = 0; i <= data.length-1; i++) {
                    if(data[i].spmID === value) {
                        console.log(data[i].spmID === value);
                        merchChecked = `<tr class="merchelem" id="vID`+i+`" data-id="`+data[i].spmID+`" data-varid="`+data[i].vID+`">
                            <input type="hidden" name="">
                            <td><input type="text" id="stName`+i+`" name="merchName[]"
                                    class="form-control form-control-sm"  data-stID="`+data[i].stID+`" value="`+data[i].stName+`" readonly="readonly"></td>
                            <td><input type="number" id="vQty`+i+`" name="poiQty[]"
                                    class="form-control form-control-sm" value="`+data[i].vQty+`" ></td>
                            <td><input type="text" id="vUnit`+i+`" name="poiUnit[]"
                                    class="form-control form-control-sm"  value="`+data[i].vUnit+`" readonly="readonly"></td>
                            <td><input type="number" id="spmPrice`+i+`" name="poiPrice[]"
                                    class="form-control form-control-sm"  value="`+data[i].spmPrice+`" readonly="readonly"></td>
                            <td><input type="number" id="subtotal`+i+`" name="itemSubtotal[]"
                                    class="subtotal form-control form-control-sm" value="" readonly="readonly"></td>
                            <td><img class="exitBtn"
                                    src="/assets/media/admin/error.png"
                                    style="width:20px;height:20px"></td>
                            </tr>`;
                            $('.poItemsTable > tbody').append(merchChecked);
                            countTr = countTr + 1;
                    }
                }
               
            }
        });
        }

        
    }
}

function addPurchaseOrder() {
    var spID = $('#spID').val();
    var poDate = $('#poDate').val();
    var edDate = $('#edDate').val();
    var poStatus = $('#poStatus').val();
    var poRemarks = $('#poRemarks').val();
    var stID, poiQty, poiUnit, poiPrice, poiStatus;

    var itemMerch = [];
    var merch= [];
    for(var i = 0; i <= countTr-1; i++) {
        count = i + 1;
        vID = $('#vID'+count).data('varid');
        poiQty = $('#vQty'+count).val();
        poiUnit = $('#vUnit'+count).val();
        poiPrice = $('#spmPrice'+count).val();
        poiStatus = poStatus;
        poiRemarks = 'HAHAHAHAHHA UY ITO NA LORD THHANK YOU';

        itemMerch = {
            'vID' : vID,
            'poiQty' : poiQty,
            'poiUnit' : poiUnit,
            'poiPrice' : poiPrice,
            'poiStatus' : poiStatus,
            'poiRemarks' : poiRemarks
        };

        merch.push(itemMerch);
    }
    
    $.ajax({
        type: 'POST',
        url: 'http://www.illengan.com/admin/purchaseorder/add',
        data: {
            spID: spID,
            poDate: poDate,
            edDate: edDate,
            poStatus: poStatus,
            poRemarks: poRemarks,
            merchandise: JSON.stringify(merch)
        },
        dataType : 'json',
        success: function(data) {
            alert('Purchase Order added');

        }
    })
}
function setSubtotal() {
    eVqty = document.getElementsByClassName('subtotal');

    for(var i = 0; i <= eVqty.length-1; i++) {
        var vQtyElem = document.getElementById('#vQty'+i);
        vQtyElem.onchange = function() {
            var vQty = parseInt($('#vQty').val());
            var spmPrice = parseInt($('#spmSprice').val());
            var subtotal = spmPrice * vQty;
        
        }
    }
    
    
}



     

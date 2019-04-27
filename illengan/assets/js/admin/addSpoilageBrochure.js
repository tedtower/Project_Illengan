var countTr = 0;
function getSelectedStocks() {
    var value = 0;
    var choices = document.getElementsByClassName('choiceStock');
    var stockChecked;
    for(var i = 0; i <= choices.length-1; i++) {
        if(choices[i].checked) {
            var value = 0;
            value = choices[i].value;

            $.ajax({
            url: 'http://www.illengan.com/admin/stock/spoilages/viewStockJS',
            dataType: 'json',
            async: false,
            success: function(data) {
                for(var i = 0; i <= data.length-1; i++) {
                    if(data[i].vID === value) {
                        console.log(data[i].vID === value);
                        stockChecked = `<tr class="stockelem" id="vID`+i+`" data-id="`+data[i].vID+`" data-varid="`+data[i].vID+`">
                            <input type="hidden" id="vID`+i+`" name="vID" class="form-control form-control-sm" data-vID="`+data[i].vID+`" value="`+data[i].vID+`">
                            <td><input type="text" id="stName`+i+`" name="stName"
                                    class="form-control form-control-sm" data-stNameID="`+data[i].stName+`" value="`+data[i].vName+`" readonly="readonly"></td>
                            <td><input type="number" id="ssQty`+i+`" name="ssQty"
                                    class="form-control form-control-sm" value="" ></td>
                            <td><input type="text" id="ssRemarks`+i+`" name="ssRemarks"
                                    class="form-control form-control-sm"  value=""></td>
                            <td><img class="exitBtn"
                                    src="/assets/media/admin/error.png"
                                    style="width:20px;height:20px"></td>
                            </tr>`;
                            $('.stockSpoilageTable > tbody').append(stockChecked);
                            countTr = countTr + 1;
                    }
                    
                }
            }
        });
        }
    }
}
function addStockItems() {
        for(var i = 0; i <= countTr-1; i++) {
            count = i + 1;
            vID = $('#vID'+count).val();
            ssQty = $('#ssQty'+count).val();
            ssDate = $('#spoilDate'+count).val();
            ssRemarks = $('#ssRemarks' +count).val();
            
        }
        
        $.ajax({
            type: 'POST',
            url: 'http://www.illengan.com/admin/stock/spoilages/add',
            data: {
                'vID' : vID,
                'ssQty' : ssQty,
                'ssDate' : ssDate,
                'ssRemarks' : ssRemarks
            },
            dataType : 'json',
            success: function(data) {
                alert('Spoiled Stock Added');
    
            }
        })
    }

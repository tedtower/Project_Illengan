function getSelectedStocks() {
    var value = 0;
    var choices = document.getElementsByClassName('choiceStock');
    for(var i = 0; i <= choices.length-1; i++) {
        if(choices[i].checked) {
            var value = choices[i].value;

            $.ajax({
            url: 'http://www.illengan.com/admin/stock/spoilages/viewStockJS',
            dataType: 'json',
            async: false,
            success: function(data) {
                for(var i = 0; i <= data.length-1; i++) {
                    var stockchecked;
                    if(data[i].stID === value) {
                        stID = `<tr class="merchelem" data-id="`+data[i].stID+`">
                            <input type="hidden" name="">
                            <td><input type="text" id="stName" name="merchName[]"
                                    class="form-control form-control-sm"  value="`+data[i].vName+`" readonly="readonly"></td>
                            <td><input type="number" id="ssQty" name="poiQty[]"
                                    class="form-control form-control-sm" value="" ></td>
                            <td><input type="text" id="ssRemarks" name="poiUnit[]"
                                    class="form-control form-control-sm"  value=""></td>
                            <td><img class="exitBtn"
                                    src="/assets/media/admin/error.png"
                                    style="width:20px;height:20px"></td>
                            </tr>`;
                            $('.table > tbody').append(stID);
                    }
                    
                }
            }
        });
        }

        
    }
}

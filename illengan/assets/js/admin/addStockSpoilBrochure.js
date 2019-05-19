function getSelectedStocks() {
    var value = 0;
    var choices = document.getElementsByClassName('choiceStock');
    var stockChecked;
    for (var i = 0; i <= choices.length - 1; i++) {
        if (choices[i].checked) {
            value = choices[i].value;

            $.ajax({
                type: 'POST',
                url: 'http://www.illengan.com/admin/stock/spoilages/viewStockJS',
                data: {
                    vID : value
                },
                dataType: 'json',
                async: false,
                success: function (data) {
                   
                    stockChecked = `<tr class="stockelem" data-id="` + data[i].vID + `" >
                            <input type="hidden" id="curQty` + i + `" name="curQty" class="form-control form-control-sm" data-vID="` + data[i].vQty + `" value="` + data[i].vQty + `">
                            <input type="hidden" id="vID` + i + `" name="vID" class="form-control form-control-sm" data-vID="` + data[i].vID + `" value="` + data[i].vID + `">
                            <td><input type="text" id="stName` + i + `" name="stName"
                                    class="form-control form-control-sm" data-stNameID="` + data[i].stName + `" value="` + data[i].vName + `" readonly="readonly" required></td>
                            <td><input type="number" min="1" id="ssQty` + i + `" name="ssQty"
                                    class="form-control form-control-sm" value="" required></td>
                            <td><input type="text" id="ssRemarks` + i + `" name="ssRemarks"
                                    class="form-control form-control-sm"  value="" required></td>
                            <td><img class="exitBtn"
                                    src="/assets/media/admin/error.png"
                                    style="width:20px;height:20px"></td>
                            </tr>`;
                    $('.stockSpoilageTable > tbody').append(stockChecked);
                }

            });
        }
    }
}
var elements;
function addStockItems() {
    elements = document.getElementsByClassName('stockelem');
    var ssDate = document.getElementById('spoilDate').value;
    var stockItems = [];
    var stocks = [];
    var vID,stID,ssQty, ssRemarks;
    for (var i = 0; i <= elements.length - 1; i++) {
        vID = document.getElementsByName('vID')[i].value;
        curQty = document.getElementsByName('curQty')[i].value;
        ssQty = document.getElementsByName('ssQty')[i].value;
        ssRemarks = document.getElementsByName('ssRemarks')[i].value;

        stockItems = {
            'vID': vID,
            'curQty': curQty,
            'ssQty': ssQty,
            'ssDate': ssDate,
            'ssRemarks': ssRemarks
        };
        stocks.push(stockItems);
    }
    $.ajax({
        type: 'POST',
        url: 'http://www.illengan.com/admin/stock/spoilages/add',
        data: {
            stocks: JSON.stringify(stocks)
        },
        dataType: 'json',
        success: function (data) {
            alert('Spoiled Stock Added');
            newFunction(data);
            
        },
        complete: function() {
            $("#formAdd").modal("hide");
            location.reload();
            },
        error: function(response, setting, error) {
            console.log(response.responseText);
            console.log(error);
        }
    });
}

function newFunction(data) {
    console.log(data);
}

function getSelectedMenu() {
    var value = 0;
    var choices = document.getElementsByClassName('orderitems');
    var merchChecked;
    for (var i = 0; i <= choices.length - 1; i++) {
        if (choices[i].checked) {
            value = choices[i].value;
            console.log(value);
            $.ajax({
                type: 'POST',
                url: 'http://www.illengan.com/admin/jsonPrefDetails',
                data: {
                    prID: value
                },
                dataType: 'json',
                success: function (data) {
                    var prName;
                    if(data[0].prName === 'Normal') {
                        prName = " ";
                    } else {
                        prName = ", "+data[0].prName;
                    }
                    merchChecked = `<tr class="salesElem">
                    <input type="hidden" name="prID" value="` + data[0].prID + `">
                    <input type="hidden" name="mID" value="` + data[0].mID + `">
                    <td><input type="text" id="olDesc" name="olDesc"
                             class="form-control form-control-sm" value="` + data[0].mName +``+ prName +`" readonly="readonly"></td>
                     <td><input type="text" id="olQty" onchange="setSubtotal()" name="olQty"
                             class="form-control form-control-sm" value="1" ></td>
                     <td><input type="number" id="prPrice" name="prPrice"
                             class="spmPrice form-control form-control-sm" onchange="setSubtotal()" value="` + data[0].prPrice + `" ></td>
                     <td><input type="number" name="subtotal" class="subtotal form-control form-control-sm" value="" readonly="readonly"></td>
                    <td><a class="btn btn-default btn-sm" style="margin:0;" id="addAddons">Add Addons</a></td>
                    </td><td><img class="exitBtn"
                             src="/assets/media/admin/error.png"
                             style="width:20px;height:20px"></td>
                     </tr>`;
                    if ($('#editPO').is(':visible')) {
                        $('.salesTables > tbody').append(merchChecked);
                    } else {
                        $('.salesTable > tbody').append(merchChecked);
                    }
                    setSubtotal();
                }
            });
        }


    }
}

function setSubtotal() {
    $(document).ready(function () {
        var prPrice, olQty;
        elements = document.getElementsByClassName('salesElem');
        total = 0;

        for (var i = 0; i <= elements.length - 1; i++) {
            prPrice = parseFloat(document.getElementsByName('prPrice')[i].value);
            olQty = parseInt(document.getElementsByName('olQty')[i].value);
            document.getElementsByName('subtotal')[i].value = olQty * prPrice;

        }
        for (var i = 0; i <= elements.length - 1; i++) {
            var subtotal = parseInt(document.getElementsByName('subtotal')[i].value);
            console.log();
            total = total + subtotal;
        }
        if ($('#addSales').is(':visible')) {
            $('#total').text(total);
        } else {
            $('#total1').text(total);
        }

    });
}

function addSales() {
    var orderlists = [];
    var items = [];
    var osPayDate = $('#osPayDate').val();
    var osDate = $('#osDate').val();
    var custName = $('#custName').val();
    var tableCode = $('#tableCode').val();
    var osTotal = parseInt($('#total').text());
    var elements = document.getElementsByClassName('salesElem');

    for (var i = 0; i <= elements.length - 1; i++) { 
        prID = document.getElementsByName('prID')[i].value;
        olDesc = document.getElementsByName('olDesc')[i].value;
        olQty = document.getElementsByName('olQty')[i].value;
        olSubtotal = parseInt(document.getElementsByName('subtotal')[i].value);
        olStatus = 'served';

        items = {
            'prID': prID,
            'olDesc': olDesc,
            'olQty' : olQty,
            'olSubtotal': olSubtotal,
            'olStatus': olStatus
        };

        orderlists.push(items);
    }

    $.ajax({
        type: 'POST',
        url: 'http://www.illengan.com/admin/sales/add',
        data: {
            tableCode: tableCode,
            custName: custName,
            osTotal: osTotal,
            osDate: osDate,
            osPayDate: osPayDate,
            orderlists: JSON.stringify(orderlists)
        },
        dataType: 'json',
        success: function(data) {
            alert('Sales added');
        },
        error: function (response, setting, errorThrown) {
            console.log(errorThrown);
            console.log(response.responseText);
        }
    });
}
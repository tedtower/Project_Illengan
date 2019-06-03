function getSelectedMenu() {
    var value = 0;
    var choices = document.getElementsByClassName('orderitems');
    var merchChecked;
    for (var i = 0; i <= choices.length - 1; i++) {
        if (choices[i].checked) {
            value = choices[i].value;

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
                    <input type="hidden" name="prID" id="prID" value="` + data[0].prID + `">
                    <input type="hidden" class="mID" id="mID" name="mID" value="` + data[0].mID + `">
                    <td ><input type="text" id="olDesc" name="olDesc"
                             class="olDesc form-control form-control-sm" value="` + data[0].mName + `` + prName + `" readonly="readonly"></td>
                     <td><input type="text" id="olQty" onchange="setSubtotal()" name="olQty"
                             class="form-control form-control-sm" value="1" ></td>
                     <td><input type="number" id="prPrice" name="prPrice"
                             class="spmPrice form-control form-control-sm" onchange="setSubtotal()" value="` + data[0].prPrice + `" ></td>
                     <td><input type="number" name="subtotal" class="subtotal form-control form-control-sm" value="" readonly="readonly"></td>
                    <td><a class="addAddons btn btn-default btn-sm" style="margin:0;" onclick="addAddons(this);" id="addAddons">Add Addons</a></td>
                    </td><td><img class="exitBtn"
                             src="/assets/media/admin/error.png"
                             style="width:20px;height:20px"></td>
                     </tr>
                     `;
                    if ($('#editPO').is(':visible')) {
                        $('.salesTable > tbody').append(merchChecked);
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
    var addonItems = [];
    var addons = [];
    var osPayDate = $('#osPayDate').val();
    var osDate = $('#osDate').val();
    var custName = $('#custName').val();
    var tableCode = $('#tableCode').val();
    var osTotal = parseInt($('#total').text());
    var elements = document.getElementsByClassName('salesElem');
    var addOnElems = document.getElementsByClassName('addonsTable');

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

    for(var i = 0; i <= addOnElems.length - 1; i++) {
        prID = document.getElementsByName('aoprID')[i].value;
        aoID = document.getElementsByName('aoID')[i].value;

        if(aoID !== "null") {
            aoQty = document.getElementsByName('aoQty')[i].value;
            aoTotal = document.getElementsByName('aoSubtotal')[i].value;

        console.log('mid '+prID+' aoID '+aoID+' aoQty '+aoQty+' aoTotal '+aoTotal);
        addonItems = {
            'prID': prID,
            'aoID': aoID,
            'aoQty': aoQty,
            'aoTotal': aoTotal
        }

        addons.push(addonItems);
        
        }
    }
    console.log('ADDONS');
    console.log(addons);
    console.log('LENGTH '+ addons.length);
    console.log(addons.length === 0);
    console.log('ORDERLIST');
    console.log(orderlists);
    console.log('LENGTH'+ orderlists.length);
    console.log(orderlists.length === 0);
    $.ajax({
        type: 'POST',
        url: 'http://www.illengan.com/admin/sales/add',
        data: {
            tableCode: tableCode,
            custName: custName,
            osTotal: osTotal,
            osDate: osDate,
            osPayDate: osPayDate,
            orderlists: JSON.stringify(orderlists),
            addons: JSON.stringify(addons)
        },
        dataType: 'json',
        success: function(data) {
            alert('Sales added');
            console.log('DATAAA');
            console.log(data);
            //location.reload();
        },
        error: function (response, setting, errorThrown) {
            console.log(errorThrown);
            console.log(response.responseText);
        },
        failure: function() {
            console.log('oh no');
        }
    });
      
}
var addonsArr;
function addAddons(btn) {
    var mID = $(btn).closest('tr').find('.mID').val();
    var prID = $(btn).closest('tr').find('#prID').val();
    
    $.ajax({
        type: 'POST',
        url: 'http://www.illengan.com/admin/jsonAddons',
        data: {
            mID: mID
        },
        dataType: 'json',
        success: function (data) {
            if(data.length !== 0) {
                addonsArr = data;
            var options = [];
            for(var i = 0; i <= data.length-1; i++) {
            var option = `  <option value="`+data[i].aoID+`">`+data[i].aoName+`</option>`;
            options.push(option);
            }
            
            var addOns = `
            <tr class="addonsTable">
            <input type="hidden" name="aoprID" value="` + prID + `">
            <td>
                    <select class="form-control" style="font-size: 14px;" onchange="setAddOnVal(this)" name="aoID" id="addon" required>
                    <option value="null" selected>--- Add On ---</option>
                    `+options+`
                    </select>
            </td>
            <td>
                <input type="number" name="aoQty" id="aoQty" onchange="setAddOnSubtotal()" value="1" class="form-control form-control-sm">
            </td>
            <td>
                <input type="number" name="aoPrice" id="aoPrice" class="form-control form-control-sm" readonly>
            </td>
            <td>
                <input type="number" name="aoSubtotal" id="aoSubtotal" class="form-control form-control-sm" readonly>
            </td>
            <td style="text-align:center"> <b> --- </b></td>
            <td><img class="exitBtn" src="/assets/media/admin/error.png" style="width:20px;height:20px"></td>
        </tr>`;
    
                $(btn).closest('tr').after(addOns);
            } 
            
        }
    });
    
    
};
var select, aoPrice;
function setAddOnVal(input) {
    select = $(input);
    var aoID = input.value;
    
    try {
        var arr = addonsArr.filter(ao => ao.aoID === aoID);
        aoPrice = arr[0].aoPrice;
        $(input).closest('td').nextAll('td').find('#aoPrice')[0].value = aoPrice;
    
        setAddOnSubtotal();
    } catch(error) {
        console.log('No addon');
        aoPrice = 0;
        $(input).closest('td').nextAll('td').find('#aoPrice')[0].value = 0;

        setAddOnSubtotal();
    }
   
}

function setAddOnSubtotal() {
    var aoQty = $(select).closest('td').next('td').find('#aoQty').val();
    var aoSubtotal = parseFloat(aoPrice * aoQty);

    $(select).closest('td').nextAll('td').find('#aoSubtotal')[0].value = aoSubtotal;

}
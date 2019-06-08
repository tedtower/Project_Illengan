var subPrice = 0;
function getSelectedMenu() {
    $(document).ready(function() {
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
                         <td><input type="number" id="olQty" onchange="setSubtotal()" name="olQty"
                                 class="form-control form-control-sm" value="1" required min="1"></td>
                         <td><input type="number" id="prPrice" name="prPrice"
                                 class="spmPrice form-control form-control-sm" onchange="setSubtotal()" value="` + data[0].prPrice + `" ></td>
                         <td><input type="number" name="subtotal" class="subtotal form-control form-control-sm" value="" readonly="readonly"></td>
                        <td><a class="addAddons btn btn-default btn-sm" style="margin:0;" onclick="addAddons(this);" id="addAddons">Add Addons</a></td>
                        </td><td><img class="delBtn"
                                 src="/assets/media/admin/error.png"
                                 style="width:20px;height:20px" onclick="removeItem(this)"></td>
                         </tr>
                         `;
                        if ($('#addSales').is(':visible')) {
                            $('.salesTable > tbody').append(merchChecked);
                        } else {
                            $('.editsalesTable > tbody').append(merchChecked);
                        }

                        setSubtotal();
                    }
                });
            }
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
            <tr class="addonsTable" data-id="">
            <input type="hidden" name="aoprID" value="` + prID + `">
            <td>
                <select class="form-control" style="font-size: 14px;" onchange="setAddOnVal(this)" name="aoID" id="addon" required>
                <option></option>`+options+`
                </select>
            </td>
            <td>
                <input type="number" name="aoQty" id="aoQty" onchange="setAddOnSubtotal()" value="1" class="form-control form-control-sm" required min="1">
            </td>
            <td>
                <input type="number" name="aoPrice" id="aoPrice" value="0" class="form-control form-control-sm" readonly>
            </td>
            <td>
                <input type="number" name="aoSubtotal" id="aoSubtotal" value="0" class="aoSubtotal form-control form-control-sm" readonly>
            </td>
            <td style="text-align:center"> <b> --- </b></td>
            <td><img class="delBtn" src="/assets/media/admin/error.png" onclick="removeItem(this)" style="width:20px;height:20px"></td>
        </tr>`;
    
                $(btn).closest('tr').after(addOns);
            } 
        }
    });
    
}
 
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
        aoPrice = 0;
        $(input).closest('td').nextAll('td').find('#aoPrice')[0].value = 0;

        setAddOnSubtotal();
    }
   
}
var aosubtotal = 0;
var elSubtotal;
function setAddOnSubtotal() {
        var aoQty = $(select).closest('td').next('td').find('#aoQty').val();
        var aoSubtotal = parseFloat(aoPrice * aoQty);
        $(select).closest('td').nextAll('td').find('#aoSubtotal')[0].value = aoSubtotal;
        console.log(select);
        setAddonTotal();
}

function setAddonTotal() {
    aosubtotal = 0;
    elSubtotal = document.getElementsByClassName('aoSubtotal');
    var val = 0; 
    for(var i = 0; i <= elSubtotal.length-1; i++) {
        val = parseInt(elSubtotal[i].value);
        aosubtotal = parseInt(aosubtotal + val);
    }
    setSubtotal();
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
            var subtotal = parseInt(document.getElementsByName('subtotal')[i].value);
            total = total + subtotal;
        }
    
        try {
            if(elSubtotal.length != 0) {
            total = total + parseInt(aosubtotal);
        }
        } catch(err) {
            
        }
      
        if ($('#addSales').is(':visible')) {
            $('#total').text(total);
        } else {
            $('#total1').text(total);
        }

    });
}

$(document).ready(function() {
    $("#addSales form").on('submit', function(event) {
    event.preventDefault();
    var orderlists = [];
    var items = [];
    var addonItems = [];
    var addons = [];
    var osPayDateTime = $('#osPayDateTime').val();
    var osDateTime = $('#osDateTime').val();
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

        addonItems = {
            'prID': prID,
            'aoID': aoID,
            'aoQty': aoQty,
            'aoTotal': aoTotal
        }
        addons.push(addonItems);
        
        }
    }
   
    $.ajax({
        type: 'POST',
        url: 'http://www.illengan.com/admin/sales/add',
        data: {
            tableCode: tableCode,
            custName: custName,
            osTotal: osTotal,
            osDateTime: osDateTime,
            osPayDateTime: osPayDateTime,
            orderlists: JSON.stringify(orderlists),
            addons: JSON.stringify(addons)
        },
        beforeSend: function() {
            console.log('ADDED ADDONS');
            console.log(addons)
        },
        success: function() {
            alert('Sales added');
            //location.reload();
        },
        error: function (response, setting, errorThrown) {
            console.log(errorThrown);
            console.log(response.responseText);
        }
    });
 });
});

 function removeItem(remove) {
    $(remove).closest("tr").remove();
    setSubtotal();
 }

 function deleteItem(element) {
    var el = $(element).closest("tr");
    subPrice = $(el).find("#aoSubtotal").val();
    var orTotal = parseInt($('#total1').text());
    var newTotal;

    // if(subPrice == null) {
    //     $(el).removeClass("salesElem");
    //     $(el).find("input").attr("disabled", "disabled");
    //     $(el).find("select").attr("disabled", "disabled");
    //     console.log('AHHAHAHA');
    //     var inputs = $(el).find("input");

    //     for(var i = 0; i <= inputs.length-1; i++) {
    //         $(inputs).removeAttr("name");
    //     }
    //     subPrice = $(el).find(".subtotal").val();
    //     newTotal = orTotal - subPrice; 
    //     console.log("MENU SUB "+subPrice);

    // } else {
    //     $(el).find("#aoSubtotal").removeClass("aoSubtotal");
    //     $(el).find("input").attr("disabled", "disabled");
    //     $(el).find("select").attr("disabled", "disabled");
    //     console.log('AHHAHAHA');
    //     var inputs = $(el).find("input");

    //     for(var i = 0; i <= inputs.length-1; i++) {
    //         $(inputs).removeAttr("name");
    //     }
    //     newTotal = orTotal - subPrice;
    //     console.log("ADDON SUB "+subPrice);
    // }

    var btn = el.find(".addAddons");
    el.attr("data-delete", "0");
    el.attr("class", "deleted");
    el[0].style.textDecoration = "line-through";
    el[0].style.opacity = "0.6";
    btn.attr("onclick", " ");

    try {
        if($(el).next(".addonsTable") != null) {
            nextTr = $(el).nextAll(".salesElem");
            addonEl = $(el).nextUntil(nextTr, "tr");
            for(var i = 0; i <= addonEl.length-1; i++) {
                addonEl[i].style.textDecoration = "line-through";
                addonEl[i].style.opacity = "0.5";
            }
        }
    } catch(error) {

    }

    var delElem = $(".delete");
    try {
        $(delElem).removeClass("salesElem");
    } catch(error) {
        $(delElem).removeClass("addonsTable");
    }
    
    $(delElem).find("input").removeAttr("name");
    console.log()
    $(delElem).find("select").attr("disabled", "disabled");
    $(delElem).find("input").attr("disabled", "disabled");

    setSubtotal();
    if ($('#addSales').is(':visible')) {
        $('#total').text(total);
    } else {
        $('#total1').text(newTotal);
    }
    
 }
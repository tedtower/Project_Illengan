function getSelectedSlips() {
    var value = 0;
    var choices = document.getElementsByClassName('choiceItems');
    var itemsChecked;
    for (var i = 0; i <= choices.length - 1; i++) {
        if (choices[i].checked) {
            value = choices[i].value;

            $.ajax({
                type: 'POST',
                url: 'http://www.illengan.com/admin/viewSlip',
                data: {
                    osID : value
                },
                dataType: 'json',
                async: false,
                success: function (data) {
                   
                    itemsChecked = `<tr class="stockelem" data-id="` + data[i].stID + `" >
                    <td></td>
                    <td><input type="text" id="olQty` + i + `" name="olQty"
                            class="form-control form-control-sm"  value="` + data[i].olQty + `"  required></td>
                    <td><input type="text" id="olDesc` + i + `" name="olDesc"
                            class="form-control form-control-sm" value="` + data[i].olDesc`" required></td>
                    <td><input type="text" id="olSubtotal` + i + `" name="olSubtotal"
                            class="form-control form-control-sm"  value="`+ data[i].olSubtotal`" required></td>
                    <td></td>
                    </tr>`;
                    $('.orderitemsTable > tbody').append(itemsChecked);
                }

            });
        }
    }
}
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




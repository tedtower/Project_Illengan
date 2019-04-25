function addSupplierOpts();
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
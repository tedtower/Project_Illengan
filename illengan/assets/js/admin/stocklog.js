$(document).ready(function() {
    var table = $('#mydata').DataTable( {
             ajax: {
                 url: "http://www.illengan.com/admin/logJson",
                 dataSrc: ''
             },
		    colReorder: {
			realtime: true
		    },
            "aoColumns" : [
                {data : 'date_recorded'},
                {data : 'stock_name'},
                {data : 'stock_unit'},
                {data : 'log_qty'},
                {data : 'log_type'}
		        ]
	        });
            
} );
var action;
var dbStockQty;
$(document).ready(function() {
    $('a.stock_modal').on('click',function(){
        unsetModalContents();
        $('#stock_modal').modal('show');
        action = $(this).data('action');
        setModalContents();
        console.log('true');
        updateStock();
    });
});

function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}

function setModalContents() {
    dropDownStock();
    action = capitalizeFirstLetter(action);
    $('#stockAction').text(action);
}

function unsetModalContents() {
    var elements = document.getElementsByClassName('stockItems');
    while(elements.length > 0){
        elements[0].parentNode.removeChild(elements[0]);
    }
}

function dropDownStock() {
    $.ajax({
        type: 'POST',
        url: 'http://www.illengan.com/admin/jsonStock',
        success: function(data) {
            for(var i = 0; i <= data.stocks.length-1; i++) {
                stockItems = '<option value="'+data.stocks[0].stock_id+'" class="stockItems browser-default custom-select">'+
                data.stocks[i].stock_name+'</option>';
                
                dbStockQty = parseInt(data.stocks[i].stock_quantity);
                $('#stockSelect').append(stockItems);
            }
            for(var i = 0; i <= data.transactions.length-1; i++){
                transactions = '<option value="'+data.transactions[0].trans_id+'" class="stockItems browser-default custom-select">'+
                data.transactions[i].receipt_no+' '+data.transactions[i].source_name+'</option>';
                $('#transSelect').append(transactions);
            } 
            console.log('yey');
        }

});
}

function updateStock() {
    $(document).ready(function() {
        $('#submitStock').on('click',function(){
        var stockQty = parseInt($('#quantity').val());
        var stockItemId = parseInt($('#stockSelect').val());
        var totalStockQty;

        if(action === 'Restock') {
            totalStockQty = stockQty + dbStockQty;
            console.log('Restock '+totalStockQty);
        } else {
            totalStockQty = dbStockQty - stockQty;
            console.log('Restock '+totalStockQty);
        }

        $.ajax({
            type: 'POST',
            url: 'http://www.illengan.com/admin/stockqty/edit',
            data: {
                stockId: stockItemId,
                stockQty: totalStockQty
            },
            success: function(data) {
                
            }


    });
});
});
}

function addTransaction() {

}
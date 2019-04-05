<div class="content">
    <div class="container-fluid">
        <p style="text-align:right; font-weight: regular; font-size: 16px">
            <!-- Real Time Date & Time -->
            <?php echo date("M j, Y -l"); ?>
        </p>
        <br>
        <div class="row">

            <div class="main-panel">
                <div class="content" style="margin-top:5px;">
                    <div class="container-fluid">

                    <div class="table-responsive" style="width:100%;">
            <table class="dataTable  dtr-inline collapsed table stripe table display" id="mydata">
                <thead>
                    <tr>
                        <th></th>
                        <th>Menu Item</th>
                        <th>Description</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="show_data">
                    
                </tbody>

            </table>
        </div>
   
    </div>
    </div>
    </div>
    
   

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once('templates/scripts.php') ?>
<script>

$(document).ready(function() {
    var table = $('#mydata').DataTable( {
             ajax: {
                 url: "http://www.illengan.com/admin/menu/datatables",
                 dataSrc: ''
             },
		    colReorder: {
			realtime: true
		    },
            "aoColumns" : [
                {
                "className":      'details-control',
                "data":  null,
                "defaultContent": ''
                },
                {data : 'menu_name'},
                {data : 'menu_description'},
                {data : 'category_name'},
                {data : 'menu_availability'},
                {
                    data: null,
                    render: function ( data, type, row, meta) {
                        return '<div class="text-left mt-2">'+
                        '<button name="editMenu" data-id="'+ data.menu_id +'" class="btn btn-primary btn-sm mb-2" style="margin-right:5px;">Edit</button>'+
                        '<a href="#" class="delete_data" id="'+ data.menu_id +'"><button class="btn btn-danger btn-sm mb-2">Delete</button></a>'+
                        '</div>';
                        }
                    }
		        ]
	        });


// FOR SHOWING THE ACCORDION
        $('#mydata tbody').on('click', 'td.details-control', function () {
                var tr = $(this).closest('tr');
                var row = table.row(tr);
        
                if ( row.child.isShown() ) {
                    // This row is already open - close it
                    row.child.hide();
                    tr.removeClass('shown');
                }
                else {
                    // Open this row
                    row.child( format(row.data()) ).show();
                    tr.addClass('shown');
                }
            } );
        
            table.rows().every( function () {
                var tr = $(this.node());
                this.child(format(table.row(tr).data())).show();
                tr.addClass('shown');
                });
 
});

function format ( d ) {

    // `d` is the original data object for the row
    return'<div style="margin:1% 5% 1% 5%;overflow:auto">'+
            '<div style="width:30%;float:left">'+
                '<img name="editImage" style="width:100%;height:180px" src="http://www.illengan.com/uploads/'+d.menu_image+'" />'+
            '</div>'+
            '<div style="width:50%;float:left;margin-left:3%">'+
                '<b>Additional Information:</b>'+
                '<table>'+
                    '<tr>'+
                    '<td>Preferences:</td>'+
                    '<td></td>'+
                    '<tr>'
                '</table>'
            '</div>'
        // $.ajax({
        //     url: "http://www.illengan.com/admin/preferences",
        //     dataType: "json",
        //     success:function(data){
        //         '<div>'+
                    
        //         '<div>'
        //     }

        // })
        
    '</div>';
    
}
</script>
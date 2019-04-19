 <div class="content">
		<div class="container-fluid">
			<br>
			<p style="text-align:right; font-weight: regular; font-size: 16px">
				<!-- Real Time Date & Time -->
				<?php echo date("M j, Y -l"); ?>
			</p>
			<div class="main-panel">
				<div class="content" style="margin-top: 5px;">
					<div class="container-fluid">
						<div class="content">
							<div class="container-fluid">
								<!--Table-->
								<div class="card-content">
								<div><button class="btn btn-dark" id="btn-show-all-children" type="button">Expand All</button>&nbsp;
								<button class="btn btn-dark" id="btn-hide-all-children" type="button">Collapse All</button></div>
								<br>
									<table id="mytable" class="table table-striped table-bordered ">
										<thead>
											<th></th>
											<th>Code</th>
											<th>Type</th>
											<th>Description</th>
											<th>Quantity</th>
											<th>Damage date</th>
											<th>Date Recorded</th>
											<th>Operations</th>
										</thead>
										<tbody id="spoilage_data">
										</tbody>
									</table>
								</div>
												<!--MODAL DELETE-->
				<form>
            <div class="modal fade" id="Modal_Remove" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Stock</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                       <strong>Are you sure to remove this record?</strong>
                  </div>
                  <div class="modal-footer">
                    <input type="hidden" name="order_id_remove" id="order_id_remove" class="form-control">
                    <button type="button" type="submit" id="btn_cancel" class="btn btn-primary">Yes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                  </div>
                </div>
              </div>
            </div>
          </form>
        <!--END MODAL DELETE-->
							</div>
						</div>
						<!--End Table Content-->
					</div>
				</div>
			</div>
		</div>
</div>


</body>
	  <script type="text/javascript" src="<?php echo base_url().'assets/js/admin/jquery-3.2.1.js'?>"></script>
		<script type="text/javascript" src="<?php echo base_url().'assets/js/admin/bootstrap.js'?>"></script>
		<script type="text/javascript" src="<?php echo base_url().'assets/js/admin/jquery.dataTables.js'?>"></script>
		<script type="text/javascript" src="<?php echo base_url().'assets/js/admin/dataTables.bootstrap4.js'?>"></script>
		<script type="text/javascript" src="<?php echo base_url().'assets/js/admin/jquery.dataTables.min.js'?>"></script>
		<script type="text/javascript" src="<?php echo base_url().'assets/js/admin/dataTables.responsive.js'?>"></script>
		<script type="text/javascript" src="<?php echo base_url().'assets/js/admin/dataTables.select.js'?>"></script>
		<script type="text/javascript" src="<?php echo base_url().'assets/js/admin/dataTables.buttons.js'?>"></script>

		<script>
		var table = $('#mytable');
		function format(d){
  		return '<table>'+
      '<tr>'+
          '<td>Remarks</td>'+
      '</tr>'+
      '<tr>'+
          '<td>'+d.remarks+'</td>'+
      '</tr>'+
      '</table>';

}

			$(document).ready(function(){
			var table = $('#mytable').DataTable({
				ajax: {
				url: 'http://www.illengan.com/admin/spoilagesjson',
				dataSrc: ''
				},
				colReorder: {
				realtime: true
				},
				"columns": [
					{
					"className" : 'details-control',
						"data": null,
						"defaultContent": ''
				},
						{"data": "s_id"},
						{"data" : "s_type"},
						{"data": "description"},
						{"data": "s_qty"},
						{"data": "s_date"},
						{"data": "date_recorded"},
						{"data": null,
							render: function (data, type, row, meta) {
								return '<a href="javascript: void(0)" class="btn btn-warning btn-sm item_delete" data-s_id="' +
									data.s_id + '">Delete</a>';
							}
						}
						//{"data": "remarks"}
					]
			});

			
//For showing the accordion
  $('#mytable tbody').on('click', 'td.details-control', function(){
    var tr = $(this).closest('tr');
    var row = table.row(tr);

    if (row.child.isShown() ){
      row.child.hide(); //to hide child row if open
      tr.removeClass('shown');
    }else{
      row.child(format(row.data()) ).show(); //to open the child row
      tr.addClass('shown');
    }
  });

//function for 'Expand all' button
$('#btn-show-all-children').on('click', function(){
    table.rows().every(function(){
      if(!this.child.isShown()){
        this.child(format(this.data())).show();
        $(this.node()).addClass('shown');
      }
    });
});

$('#btn-hide-all-children').on('click', function(){
  table.rows().every(function(){
    if(this.child.isShown()){
      this.child.hide();
      $(this.node()).removeClass('shown');
    }
  });
});

		});

	//get data for delete record
$('#spoilage_data').on('click','.item_delete',function(){
            var s_id = $(this).data('s_id');
            
            $('#Modal_Remove').modal('show');
            $('[name="order_id_remove"]').val(s_id);
        });

        //delete record to database
         $('#btn_cancel').on('click',function(){
            var s_id = $('#order_id_remove').val();
            $.ajax({
                type : "POST",
                url  : "<?php echo site_url('admindelete/deletestockspoilages')?>",
                dataType : "JSON",
                data : {s_id:s_id},
                success: function(data){
                    $('[name="order_id_remove"]').val("");
                    alert("Record removed successfully!");
                    $('#Modal_Remove').modal('hide');
                    
                    table.DataTable(). ajax.reload(null, false);
                }
            });
            return false;
        });
		</script>
	</html>
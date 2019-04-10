<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!doctype html>
<html lang="en">

<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/admin/bootstrap.css'?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/admin/jquery.dataTables.css'?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/admin/dataTables.bootstrap4.css'?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/admin/responsive.bootstrap.css'?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/admin/select.bootstrap.css'?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/admin/buttons.bootstrap.css'?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/admin/style.css'?>">

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
											<th>Description</th><!--menu id-->
											<th>Quantity</th><!--sqty-->
											<th>Damage date</th><!--sdate-->
											<th>Date Recorded</th><!--date_recorded-->
											<th>Operations</th><!--remarks-->
											<!--<th>Remarks</th>-->
										</thead>
										<tbody>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<!--End Table Content-->
					</div>
				</div>
			</div>
		</div>
</div>

		
<script type="text/javascript" src="<?php echo base_url().'assets/js/admin/jquery-3.2.1.js'?>"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/js/admin/bootstrap.js'?>"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/js/admin/jquery.dataTables.js'?>"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/js/admin/dataTables.bootstrap4.js'?>"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/js/admin/tables.js'?>"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/js/admin/dataTables.responsive.js'?>"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/js/admin/dataTables.select.js'?>"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/js/admin/dataTables.buttons.js'?>"></script>
	
<?php include_once('templates/scripts.php') ?>


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
		</script>
		
		

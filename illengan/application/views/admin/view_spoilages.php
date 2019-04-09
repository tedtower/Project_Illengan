<!doctype html>
<html lang="en">

<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/admin/bootstrap.css'?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/admin/jquery.dataTables.css'?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/admin/dataTables.bootstrap4.css'?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/admin/responsive.bootstrap.css'?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/admin/style.css'?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/admin/dataTables.foundation.min' ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/admin/dataTables.material.min.css' ?>">

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
									<table id="table" class="table table-striped table-bordered dt-responsive nowrap">
										<thead>
											<th>Code</th>
											<th>Description</th><!--menu id-->
											<th>Quantity</th><!--sqty-->
											<th>Damage date</th><!--sdate-->
											<th>Date Recorded</th><!--date_recorded-->
											<th>Remarks</th><!--remarks-->
											<th>Operations</th>
										</thead>
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
		<script type="text/javascript" src="<?php echo base_url().'assets/js/admin/jquery.dataTables.min.js'?>"></script>
		<script type="text/javascript" src="<?php echo base_url().'assets/js/admin/dataTables.responsive.js'?>"></script>
		<script type="text/javascript" src="<?php echo base_url().'assets/js/admin/dataTables.select.js'?>"></script>
		<script type="text/javascript" src="<?php echo base_url().'assets/js/admin/dataTables.buttons.js'?>"></script>
		<script>
			$(document).ready(function(){
			var table = $('#table').DataTable({
				ajax: {
				url: 'http://www.illengan.com/admin/spoilagesjson',
				dataSrc: ''
				},
				colReorder: {
				realtime: true
				},
				"columns": [
						{"data": "s_id"},
						{"data": "description"},
						{"data": "s_qty"},
						{"data": "s_date"},
						{"data": "date_recorded"},
						{"data": "remarks"},
						{"data": null,
							render: function (data, type, row, meta) {
								return '<a href="javascript: void(0)" class="btn btn-warning btn-sm item_delete" data-s_id="' +
									data.s_id + '">Delete</a>';
							}
						}
					]
			});
		});
		</script>
		
		
<!doctype html>
<html lang="en">

<head>
	<?php include_once('templates/head.php') ?>
</head>

<body>
	<?php include_once('templates/sideNav.php') ?>
	<!--End Side Bar-->
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


									<!--Search
                            <div id ="example_filter" class="dataTables_filter">
                                <label>
                                    "Search:"
                                    <div class="form-group form-group-sm is-empty">
                                       <input type="search" class="form-control" placeholder aria-controls="example">
                                       <span class="material-input"></span> 
                                    </div>
                                </label>
                            </div>-->

									<table id="example" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
										<thead>
											<th><b class="pull-left">Code</b></th>
											<th><b class="pull-left">Description</b></th>
											<!--menu id-->
											<th><b class="pull-left">Quantity</b></th>
											<!--sqty-->
											<th><b class="pull-left">Damage date</b></th>
											<!--sdate-->
											<th><b class="pull-left">Date Recorded</b></th>
											<!--date_recorded-->
											<th><b class="pull-left">Remarks</b></th>
											<!--remarks-->
											<th><b class="pull-left">Operations</b></th>
										</thead>
										<tbody id="show_data">
                    
										</tbody>	
									</table>							
								</div>
							</div>
						</div>
						</td>
						<!--End Table Content-->
					</div>
				</div>
			</div>
		</div>


		<script>
var table = $('#spoilages');

$(document).ready(function(){
  var table = $('#spoilages').DataTable({
      ajax: {
      url: 'http://www.illengan.com/admin/spoilages',
      dataSrc: ''
    },
    colReorder: {
      realtime: true
    },
    "columns" : [
			{"data" : "s_id"},
			{"data" : "description"},
			{"data" : "s_qty"},
			{"data" : "s_date"},
			{"data" : "date_recorded"},
			{"data" : "remarks"},
			{"data" : null,
					render: function(data, type, row, meta){
						return '<a href="javascirpt: void(0)" class="btn btn-warning btn-sm item_delete" data-s_id="'+data.s_id+'">Delete</a>';
					}
			}
		]
  });
	
	</script>

<script type="text/javascript" src="<?php echo base_url().'assets/js/admin/jquery-3.2.1.js'?>"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/js/admin/bootstrap.js'?>"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/js/admin/jquery.dataTables.js'?>"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/js/admin/dataTables.bootstrap4.js'?>"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/js/admin/tables.js'?>"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/js/admin/dataTables.responsive.js'?>"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/js/admin/dataTables.select.js'?>"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/js/admin/dataTables.buttons.js'?>"></script>
	
<?php include_once('templates/scripts.php') ?>


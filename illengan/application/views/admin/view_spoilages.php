<head>
<?php include_once('templates/head.php') ?>
</head>
<body>
<?php include_once('templates/sideNav.php') ?>
		<div class="main-panel">
			<div class="content" style="margin-top: 5px;">
				<div class="container-fluid">
					<div class="card">
						<div class="content">
							<div class="container-fluid">
								<div class="card-header" data-background-color="brown">
									<div class="nav-tabs-navigation">
										<div class="nav-tabs-wrapper">
										<ul class="nav nav-tabs" data-tabs="tabs" data-background-color="brown">
										<li class="active">
													<a href="http://www.illengan.com/admin/spoilages">
														All Spoilages
														<div class="ripple-container"></div>
													</a>
												</li>
												<span></span>
												<li>
													<a href="http://www.illengan.com/admin/spoilages/menu">
														Menu Spoilages
														<div class="ripple-container"></div>
													</a>
												</li>
												<span></span>
												<li>
													<a href="http://www.illengan.com/admin/spoilages/stock">
														Stocks Spoilages
														<div class="ripple-container"></div>
													</a>
												</li>
												<span></span>
												<li>
													<a href="http://www.illengan.com/admin/spoilages/addons">
														Add Ons Spoilages
														<div class="ripple-container"></div>
													</a>
												</li>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="content">
							<div class="container-fluid">
								<!--Table-->
								<div class="card-content">
									<table id="spoilages" class="table table-striped table-bordered dt-responsive nowrap"
										cellspacing="0" width="100%">
										<thead>
											<th><b class="pull-left">Code</b></th>
											<th><b class="pull-left">Description</b></th> <!--menu id-->
											<th><b class="pull-left">Quantity</b></th> <!--sqty-->
											<th><b class="pull-left">Damage date</b></th> <!--sdate-->
											<th><b class="pull-left">Date Recorded</b></th> <!--date_recorded-->
											<th><b class="pull-left">Remarks</b></th> <!--remarks-->
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


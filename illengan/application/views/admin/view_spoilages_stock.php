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
									<!--MODAL DAPAT TO-->
									<a class="btn btn-default btn-sm" data-toggle="modal" href="<?php echo base_url()?>index.php/admin/spoilages/stock/add" 
										data-original-title style="float: left">Add Stock Spoilage</a>
									
									<br><br>
									<table id="stockspoilages" class="table table-striped table-bordered dt-responsive nowrap"
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
										<tbody>
										<?php
            
											if (isset($spoilagesstock)){
												foreach ($spoilagesstock as $row){
													if($row['stype'] = 'm'){
											?>
											<!--Insert PHP-->
											<tr>
											<td><?php echo $row['s_id']; ?></td>
											<td><?php echo $row['stock_name']; ?></td>
											<td><?php echo $row['s_qty']; ?></td>
											<td><?php echo $row['s_date']; ?></td>
											<td><?php echo $row['date_recorded']; ?></td>
											<td><?php echo $row['remarks']; ?></td>
													<!--Delete button-->
											<td><a class="btn btn-default btn-sm" data-toggle="modal" href="<?php echo site_url('admin/deletespoilages/'.$row['s_id']);?>">Delete</a></td>
												
											</tr>
											<?php
													}
											}
											}else{
												echo "There is no data";
											}
											?>
								</div>
							</div>
						</div>
						</td>
						<!--End Table Content-->
						<!--Modal for Activation/Deactivation-->
						<div class="modal fade" id="deactivate" tabindex="-1" data-backdrop="static"
							data-keyboard="false" role="dialog" aria-labelledby="contactLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="panel panel-primary">
									<div class="panel-heading">
										<!--Close Button-->
										<button type="button" class="close" data-dismiss="modal"
											onclick="document.getElementById('').click()" aria-hidden="true">×</button>
										<h4 class="panel-title" id="contactLabel"><span
												class="glyphicon glyphicon-warning-sign"></span>
											Activation/Deactivation
										</h4>
									</div>
									<form action="adminMenuItems/activation" method="post" accept-charset="utf-8">
										<div class="modal-body" style="padding: 5px;">
											<div class="row" style="text-align: center">
												<br>
												<h4> Are you sure you want to 'deactivate' : 'activate'?> this
													menu
													item?</h4>
												<br>
											</div>
											<div class="row">
												<div class="col-md-12 form-group">
													<div class="form-group label-floating">
														<input class="form-control" type="hidden" name="deact_id"
															value="" required>
													</div>
													<div class="form-group label-floating">
														<input class="form-control" type="hidden" name="name" value=""
															required>
													</div>
												</div>
											</div>
										</div>
										<div class="panel-footer" style="margin-bottom:-14px;">
											<input type="submit" class="btn btn-success" value="Yes" />
											<button type="button" class="btn btn-danger btn-close"
												onclick="document.getElementById('').click()"
												data-dismiss="modal">No</button>
										</div>
									</form>
								</div>
							</div>
						</div>
						<div class="modal fade" id="" tabindex="-1" role="dialog" aria-labelledby="contactLabel"
							aria-hidden="true">
							<div class="modal-dialog">
								<div class="panel panel-primary">
									<div class="panel-heading">
										<button type="button" class="close" data-dismiss="modal"
											aria-hidden="true">×</button>
										<h4 class="panel-title" id="contactLabel"><span
												class="glyphicon glyphicon-info-sign"></span> Update Menu Item
										</h4>
									</div>
									<form action="" method="post" accept-charset="utf-8">
										<div class="modal-body" style="padding: 5px;">
											<!--Add Menu Item Modal-->
											<div class="row">
												<div class="col-md-12 form-group">
													<div class="form-group label-floating">
														<label for="email">Menu Name</label>
														<input class="form-control" type="text" name="name" value=""
															required pattern="[a-zA-Z][a-zA-Z\s]*" required
															title="Menu name should only countain letters">
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12 form-group">
													<div class="form-group label-floating">

														<input class="form-control" type="hidden" name="" value=""
															required>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-6 form-group">
													<div class="form-group label-floating">
														<label for="type">Category</label>
														<select class="form-control" name="" type="textarea" value=""
															id="example-number-input" required
															pattern="[a-zA-Z][a-zA-Z\s]*" required
															title="Category hould only countain letters">
															<option disabled selected value></option>
															<!--Insert PHP-->
														</select>
													</div>
												</div>

												<div class="col-md-6 form-group">
													<div class="form-group label-floating">
														<label for="email">Status</label>
														<input class="form-control" value="" type="number" name="status"
															min="0" oninput="validity.valid||(value='');"
															data-validate="required" max="" required>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-6 form-group">
													<div class="form-group label-floating">
														<label for="uploadImage">Upload Image</label>
														<select class="form-control" name="sup_company" required>
															<option disabled selected value></option>
															<!--Insert PHP-->
														</select>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12 form-group">
														<div class="form-group label-floating">
															<label for="description">Description</label>
															<input class="form-control" type="text" name="description"
																value="" required pattern="[a-zA-Z][a-zA-Z\s]*" required
																title="Description should only countain letters">
														</div>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12 form-group">
													<div class="form-group label-floating">
														<label for="type">Sizeable</label>
														<select class="form-control" name="" type="textarea" value=""
															id="example-number-input" required
															pattern="[a-zA-Z][a-zA-Z\s]*" required
															title="Category hould only countain letters">
															<option disabled selected value></option>
															<!--Insert PHP-->
														</select>
													</div>
												</div>
											</div>

											<div class="col-md-6 form-group">
												<div class="form-group label-floating">
													<label for="email">Price</label>
													<input class="form-control" type="number" name="price" min="0"
														oninput="validity.valid||(value='');" data-validate="required"
														max="" required>
												</div>
											</div>

											<div class="panel-footer" style="margin-bottom:-14px; align:right">
												<input type="submit" class="btn btn-danger" value="Close" />
												<input type="reset" class="btn btn-success" value="Add Menu Item" />
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript" src="<?php echo base_url().'assets/js/admin/jquery-3.2.1.js'?>"></script>
	<script>
	<script type="text/javascript" src="<?php echo base_url().'assets/js/admin/bootstrap.js'?>"></script>
	<script>
	<script type="text/javascript" src="<?php echo base_url().'assets/js/admin/jquery.datatables.js'?>"></script>
	<script>
	<script type="text/javascript" src="<?php echo base_url().'assets/js/admin/dataTables.bootstrap4.js'?>"></script>
	<script>
			$(document).ready(function() {
		$('#stockspoilages').DataTable( {
		
		} );
	} );
</script>
<?php include_once('templates/scripts.php') ?>
</body>

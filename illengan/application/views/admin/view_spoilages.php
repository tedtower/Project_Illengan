<head>
	<meta charset="UTF-8">
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport'>
	<meta name="viewport" content="width=device-width">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Il-Lengan | Admin Spoilages</title>
	<!--Bootstrap core CSS-->
	<link href="assets/css/admin/bootstrap.min.css" rel="stylesheet" />
	<!--Animation library for notifications-->
	<link href="assets/css/admin/animate.min.css" rel="stylesheet" />
	<!--  Light Bootstrap Table core CSS    -->
	<link href="assets/css/admin/light-bootstrap-dashboard.css?v=1.4.0" rel="stylesheet" />
	<!--CSS for Demo Purpose, don't include it in your project-->
	<link href="assets/css/admin/demo.css" rel="stylesheet" />
	<!--Fonts and icons-->
	<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
	<link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' />
	<link href="assets/common/fontstyles/pre-icon-7/pe-icon-7-stroke.css" rel="stylesheet" />

</head>

<body>
	<div class="wrapper">
		<div class="sidebar" data-color="brown" data-image="assets/media/admin/Coffee_1.jpg">
			<!--Left Navigation Bar-->
			<div class="sidebar-wrapper" style="overflow: hidden">
				<div class="logo">
					<img src="assets/media/admin/logo_lg.png" alt="il-lengan-logo" img-align="center" width="225px"
						height="135px">
				</div>

				<ul class="nav">
					<li>
						<a href="adminDashboard.html">
							<p>Dashboard</p>
						</a>
					</li>
					<li>
						<a href="adminMenuItems.html">
							<p>Menu Items</p>
						</a>
					</li>
					<li>
						<a href="adminSales.html">
							<p>Sales</p>
						</a>
					</li>
					<li>
						<a href="adminInventory.html">
							<p>Inventory</p>
						</a>
					</li>

					<li>
						<a href="adminTables.html">
							<p>Tables</p>
						</a>
					</li>
					<li>
						<a href="adminReports.html">
							<p>Reports</p>
						</a>
					</li>
					<li>
						<a href="adminAccounts.html">
							<p>Accounts</p>
						</a>
					</li>
					<li>
						<a href="adminTransactions.html">
							<p>Transactions</p>
						</a>
					</li>
					<li class="active">
						<a href="adminSpoilages.html">
							<p>Spoilages</p>
						</a>
					</li>
				</ul>
			</div>
		</div>
		<!--End Side Bar-->
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
													<a href="adminSpoilages.html">
														All Spoilages
														<div class="ripple-container"></div>
													</a>
												</li>
												<span></span>
												<li>
													<a href="adminMenuSpoilages.html">
														Menu Spoilages
														<div class="ripple-container"></div>
													</a>
												</li>
												<span></span>
												<li>
													<a href="adminStocksSpoilages.html">
														Stocks Spoilages
														<div class="ripple-container"></div>
													</a>
												</li>
												<span></span>
												<li>
													<a href="adminAddOnsSpoilages.html">
														Add Ons Spoilages
														<div class="ripple-container"></div>
													</a>
												</li>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="content">
							<div class="container-fluid">
								<!--Table-->
								<div class="card-content">
									<a class="btn btn-default btn-sm" data-toggle="modal" data-target="#newspoilage"
										data-original-title style="float: left">Add Spoilages</a>
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
									<br><br>
									<table id="example" class="table table-striped table-bordered dt-responsive nowrap"
										cellspacing="0" width="100%">
										<thead>
											<th><b class="pull-left">Code</b></th>
											<th><b class="pull-left">Description</b></th>
											<th><b class="pull-left">Quantity</b></th>
											<th><b class="pull-left">Damage Date</b></th>
											<th><b class="pull-left">Remarks</b></th>
											<th><b class="pull-left">Actions</b></th>
										</thead>
										<tbody>
											<!--Insert PHP-->
											<tr>
												<td>
													<!--insert PHP echo (e.g. "?php echo $row->code; ?>-->
												</td>
												<td>
													<!--insert PHP echo (e.g. "?php echo $row->code; ?>-->
												</td>
												<td>
													<!--insert PHP echo (e.g. "?php echo $row->code; ?>-->
												</td>
												<td>
													<!--insert PHP echo (e.g. "?php echo $row->code; ?>-->
												</td>
												<td>
													<!--insert PHP echo (e.g. "?php echo $row->code; ?>-->
												</td>
												<td>

													<div class="onoffswitch">
														<!--
                                                       
                                                    -->
														<!--Delete button-->
														<button class="btn btn-danger btn-sm" data-toggle="modal"
															data-target="">Delete</button>
													</div>
												</td>
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

<?php include_once('scripts.php') ?>

</body>

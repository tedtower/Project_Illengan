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
									<!--Add Add Ons Spoilage-->
									<a class="btn btn-default btn-sm" data-toggle="modal" data-target="#addNewAddOnsSpoilage" data-original-title style="float: left">Add Ons Spoilage</a><br>
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
									<table id="aospoilages" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
										<thead>
											<th><b class="pull-left">Code</b></th>
											<th><b class="pull-left">Menu ID</b></th>
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
										<tbody>
											<?php

											if (isset($spoilagesao)) {
												foreach ($spoilagesao as $row) {
													if ($row['stype'] = 'm') {
														?>
														<!--Insert PHP-->
														<tr>
															<td><?php echo $row['s_id']; ?></td>
															<td><?php echo $row['ao_name']; ?></td>
															<td><?php echo $row['s_qty']; ?></td>
															<td><?php echo $row['s_date']; ?></td>
															<td><?php echo $row['date_recorded']; ?></td>
															<td><?php echo $row['remarks']; ?></td>
															<!--Delete button-->
															<td><a class="btn btn-default btn-sm" data-toggle="modal" href="<?php echo site_url('admin/deletespoilages/' . $row['s_id']); ?>">Delete</a></td>

														</tr>
													<?php
												}
											}
										} else {
											echo "There is no data";
										}
										?>
								</div>
							</div>
						</div>
						</td>
						<!--End Table Content-->
						<!--Modals-->
						<!--Modal for Activation/Deactivation-->
						<!--Modal for Add New Table-->
						<div class="modal fade" id="addNewAddOnsSpoilage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Add Add Ons Spoilage</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<form action="adminAddOnsSpoilage/insert" method="post" accept-charset="utf-8">
										<div class="modal-body">
											<!--Spoilage Code-->
											<div class="row">
												<div class="col-md-6 form-group">
													<div class="form-group label-floating">
														<label for="spoilageCode">Spoilage Code</label>
														<input class="form-control" type="text" name="spoilageCode" value="" required pattern="[a-zA-Z][a-zA-Z\s][0-9]*" required title="Spoilage Code should contain letters and numbers">
													</div>
												</div>
											<!--Menu ID-->
												<div class="col-md-6 form-group">
													<div class="form-group label-floating">
														<label for="menuId">Menu ID</label>
														<input class="form-control" type="text" name="menuId" value="" required pattern="[0-9]*" required title="Menu ID should only contains numbers">
													</div>
												</div>
											</div>
											<!--Spoilage Quantity-->
											<div class="row">
												<div class="col-md-6 form-group">
													<div class="form-group label-floating">
														<label for="spoilageQuantity">Spoilage Quantity</label>
														<input class="form-control" type="text" name="spoilageQuantity" value="" required pattern="[0-9]*" required title="Spoilage quantity should only contains numbers">
													</div>
												</div>
											<!--Spoilage Date-->
												<div class="col-md-6 form-group">
													<div class="form-group label-floating">
														<label for="spoilageDate">Spoilage Date</label>
														<!--Insert datepicker plugin-->
													</div>
												</div>
											</div>
											<!--Date Recorded-->
											<div class="row">
											<div class="col-md-12 form-group">
													<div class="form-group label-floating">
														<label for="spoilageDateRecorded">Date Recorded</label>
														<!--Insert datepicker plugin-->
													</div>
												</div>
											</div>
											<!--Remarks-->
											<div class="row">
												<div class="col-md-12 form-group">
													<div class="form-group label-floating">
														<label for="remarks">Remarks</label>
														<input class="form-control" type="text" name="name" value=""
															required pattern="[a-zA-Z][a-zA-Z\s]*" required
															title="Remarks should only countain letters">
													</div>
												</div>
											</div>

										</div>
									</form>
									<div class="modal-footer">
										<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
										<button type="button" class="btn btn-success btn-sm">Save changes</button>
									</div>
								</div>
							</div>
						</div>
						<!--Delete Confirmation Box-->
						<div class="modal fade" id="deleteSpoilage" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="contactLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="panel panel-primary">
									<div class="panel-heading">
										<form action="adminAccount/delete" method="post" accept-charset="utf-8">
											<div class="modal-body" style="padding: 5px;">
												<div class="row" style="text-align: center">
													<br>
													<h4 id="deleteTableCode"></h4>
													<h4>Are you sure you want to delete this Add Ons Spoilage?</h4>
													<br>
												</div>
											</div>
										</form>
									</div>
								</div>
								<div class="panel-footer" style="margin-bottom:-14px;" align="right">
									<input type="submit" class="btn btn-success" value="Yes" />
									<button type="button" class="btn btn-danger btn-close" onclick="document.getElementById('').click()" data-dismiss="modal">No</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<?php include_once('templates/scripts.php') ?>
			<script>
				$(document).ready(function() {
					$('#aospoilages').DataTable({

					});
				});
			</script>

</body>

</html>
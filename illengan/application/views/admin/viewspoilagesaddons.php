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
			<div class="content" style="margin-left:250px;">
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
								<a class="btn btn-default btn-sm" data-toggle="modal" data-target="#addNewAddOnsSpoilage" data-original-title style="margin:0;">Add Ons Spoilage</a><br>
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
								<br>
								<table id="aospoilages" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
									<thead>
										<th><b class="pull-left">Code</b></th>
										<th><b class="pull-left">Add Ons Name</b></th>
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
									</tbody>
								</table>
								<!--End Table Content-->

								<!--Modals-->
								<!--Start of Modal "Add Transaction"-->
								<div class="modal fade bd-example-modal-lg" id="addNewAddOnsSpoilage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
									<div class="modal-dialog modal-lg" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="exampleModalLabel">Add Ons Spoilage</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<form id="formAdd" action="<?= site_url('admin/addons/spoilages/add') ?>" method="post" accept-charset="utf-8">
												<div class="modal-body">
													<div class="form-row">
														<!--Container of Source Date-->
														<!--Source Date-->
														<div class="input-group mb-3">
															<div class="input-group-prepend">
																<span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
																	Source Date</span>
															</div>
															<input type="date" name="transDate" id="transDate" class="form-control form-control-sm">
														</div>
													</div>
													<table class="addOnSpoilageTable table table-sm table-borderless">
														<!--Table containing the different input fields in adding AO spoilages -->
														<thead class="thead-light">
															<tr>
																<th>Source Name</th>
																<th width="20%">Qty</th>
																<th>Remarks</th>
															</tr>
														</thead>
														<tbody>
															<tr>
																<td><input type="text" name="" id="" class="form-control form-control-sm"></td>
																<td><input type="number" name="" id="" class="form-control form-control-sm"></td>
																<td><textarea name="" id="" class="form-control form-control-sm"></textarea></td>
														</tbody>
													</table>

													<div class="modal-footer">
														<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
														<button class="btn btn-success btn-sm" type="submit">Add</button>
													</div>
												</div>
											</form>
										</div>
									</div>
								</div>
								<!--End of Modal "Add AO Spoilage"-->

								<!--Start of Modal "Edit AO Spoilage"-->
								<div class="modal fade bd-example-modal-lg" id="addNewAddOnsSpoilage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
									<div class="modal-dialog modal-lg" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="exampleModalLabel">Edit Add Ons Spoilage</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<form id="formAdd" action="<?= site_url('admin/addons/spoilages/edit') ?>" method="post" accept-charset="utf-8">
												<div class="modal-body">
													<div class="form-row">
														<!--Container of Add On Name & Spoilage Qty-->
														<!--Source Date-->
														<div class="input-group mb-3">
															<div class="input-group-prepend">
																<span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
																	Source Date</span>
															</div>
															<input type="date" name="transDate" id="transDate" class="form-control form-control-sm">
														</div>
													</div>
													<table class="addOnSpoilageTable table table-sm table-borderless">
														<!--Table containing the different input fields in adding AO spoilages -->
														<thead class="thead-light">
															<tr>
																<th>Source Name</th>
																<th width="20%">Qty</th>
																<tH>Remarks</th>
															</tr>
														</thead>
													</table>

													<div class="modal-footer">
														<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
														<button class="btn btn-success btn-sm" type="submit">Update</button>
													</div>
												</div>
											</form>
										</div>
									</div>
								</div>
								<!--End of Modal "Edit AO Spoilage"-->


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
			$('#aospoilages').DataTable({

			});
		});
	</script>

</body>

</html>
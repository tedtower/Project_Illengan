<!--End Side Bar-->
<div class="content">
	<div class="container-fluid">
		<br>
		<p style="text-align:right; font-weight: regular; font-size: 16px">
			<!-- Real Time Date & Time -->
			<?php echo date("M j, Y -l"); ?>
		</p>
		<div div class="content" style="margin-left:250px;">
			<div class="container-fluid">
				<div class="content">
					<div class="container-fluid">
						<!--Table-->
						<div class="card-content">

							<!--Add Stock Spoilage-->
							<a class="btn btn-default btn-sm" data-toggle="modal" data-target="#addStockSpoilage" data-original-title style="margin:0">Add Stock Spoilage</a><br>

							<br>
							<table id="tablevalues" class="dataTable dtr-inline collapsed table display">
								<thead>
									<th></th>
									<th>Code</th>
									<th>Description</th>
									<th>Quantity</th>
									<th>Damage date</th>
									<th>Date Recorded</th>
									<th>Operations</th>
								</thead>
								<tbody id="spoilage_data">
								</tbody>
							</table>
							<!--End Table Content-->
							<!--Start of Modal "Add Menu Spoilages"-->
							<div class="modal fade bd-example-modal-lg" id="addStockSpoilage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog modal-lg" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLabel">Add Stock Spoilage</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<form id="formAdd" action="<?= site_url('admin/stock/spoilages/add') ?>" method="post" accept-charset="utf-8">
											<div class="modal-body">
												<div class="form-row">
													<!--Container of Source Date-->
													<!--Spoilage Date-->
													<div class="input-group mb-3">
														<div class="input-group-prepend">
															<span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
																Source Date</span>
														</div>
														<input type="date" name="transDate" id="transDate" class="form-control form-control-sm">
													</div>
												</div>
												<!--Add Stock Item-->
												<!--Button to add row in the table-->
												<a class="btn btn-primary btn-sm" style="color:blue;margin:0">Add Row</a>
												<br><br>
												<table class="stockSpoilageTable table table-sm table-borderless">
													<!--Table containing the different input fields in adding AO spoilages -->
													<thead class="thead-light">
														<tr>
															<th>Name</th>
															<th width="20%">Qty</th>
															<th>Remarks</th>
															<th></th>
														</tr>
													</thead>
													<tbody>
														<tr>
															<td><input type="text" name="stock_name" id="stock_name" class="form-control form-control-sm"></td>
															<td><input type="number" name="s_qty" id="s_qty" class="form-control form-control-sm"></td>
															<td><textarea name="date" id="s_date" class="form-control form-control-sm"></textarea></td>
															<td><img class="exitBtn" id="exitBtn" src="/assets/media/admin/error.png" style="width:20px;height:20px"></td>
													</tbody>
												</table>
												<!--Total of the trans items-->

												<div class="modal-footer">
													<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
													<button class="btn btn-success btn-sm" type="submit">Add</button>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
							<!--End of Modal "Add Stock Spoilage"-->

							<!--Delete Confirmation Box-->
							<div class="modal fade" id="deleteSpoilage" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLongTitle">Delete Stock Spoilage</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<form id="confirmDelete">
											<div class="modal-body">
												<h6 id="deleteTableCode"></h6>
												<p>Are you sure you want to delete the selected stock spoilages?</p>
												<input type="text" name="tableCode" hidden="hidden">
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
												<button type="submit" class="btn btn-danger btn-sm">Delete</button>
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
	</div>
</div>
<!--End Table Content-->
<?php include_once('templates/scripts.php') ?>

<script>
	var table = $('#tablevalues');

	function format(d) {
		return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">' +
			'<tr>' +
			'<td>Remarks</td>' +
			'</tr>' +
			'<tr>' +
			'<td>' + d.ssRemarks + '</td>' +
			'</tr>' +
			'</table>';

	}

	$(document).ready(function() {
		var table = $('#tablevalues').DataTable({
			ajax: {
				url: 'http://www.illengan.com/admin/spoilagesstockjson',
				dataSrc: ''
			},
			colReorder: {
				realtime: true
			},
			"columns": [{
					"className": 'details-control',
					"data": null,
					"defaultContent": ''
				},
				{
					"data": "ssID"
				},
				{
					"data": "stName"
				},
				{
					"data": "ssQty"
				},
				{
					"data": "ssDate"
				},
				{
					"data": "ssDateRecorded"
				},
				{
					"data": null,
					render: function(data, type, row, meta) {
						return '<a href="javascript: void(0)" class="btn btn-warning btn-sm delete_data" data-id="' +
							data.s_id + '">Delete</a>';
					}
				}
			]
		});


		//For showing the accordion
		$('#tablevalues tbody').on('click', 'td.details-control', function() {
			var tr = $(this).closest('tr');
			var row = table.row(tr);

			if (row.child.isShown()) {
				row.child.hide(); //to hide child row if open
				tr.removeClass('shown');
			} else {
				row.child(format(row.data())).show(); //to open the child row
				tr.addClass('shown');
			}
		});

		//function for 'Expand all' button
		$('#btn-show-all-children').on('click', function() {
			table.rows().every(function() {
				if (!this.child.isShown()) {
					this.child(format(this.data())).show();
					$(this.node()).addClass('shown');
				}
			});
		});

		$('#btn-hide-all-children').on('click', function() {
			table.rows().every(function() {
				if (this.child.isShown()) {
					this.child.hide();
					$(this.node()).removeClass('shown');
				}
			});
		});

	});
	// Function for Delete
	$(document).ready(function() {
		$('.delete_data').click(function() {
			var id = $(this).attr("id");
			if (confirm("Are you sure you want to delete this?")) {
				window.location = "<?php echo base_url(); ?>admin/sources/delete/" + id;
			} else {
				return false;
			}
		});
	});
	//End Function Delete
</script>
</body>

</html>
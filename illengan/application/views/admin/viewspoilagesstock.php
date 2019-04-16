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
							<a class="btn btn-default btn-sm" data-toggle="modal" data-target="#addStockSpoilage"
								data-original-title style="margin:0">Add Stock Spoilage</a><br>

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

							<!-- ADD SPOILAGE MODAL -->
							<div class="modal fade" id="addStockSpoilage" tabindex="-1" role="dialog"
								aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLabel">Add Stock Spoilage</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<form action="<?php echo base_url()?>admin/stock/spoilages/add" method="get"
											accept-charset="utf-8">
											<div class="modal-body">
												<!--Stock Name-->
												<div class="row">
													<div class="col-md-12 form-group">
														<div class="form-group label-floating">
															<label for="stock_name">Description</label>
															<input class="form-control" type="text" name="stock_name"
																required pattern="[a-zA-Z][a-zA-Z\s]*" required
																title="Desciption name should only countain letters"
																required>
														</div>
													</div>
												</div>
												<!--Spoilage Quantity-->
												<div class="row">
													<div class="col-md-12 form-group">
														<div class="form-group label-floating">
															<label for="s_qty">Spoilage Quantity</label>
															<input name="s_qty" class="form-control" type="number"
																value="" id="example-number-input" min="0"
																oninput="validity.valid||(value='');"
																data-validate="required" max="" required>
														</div>
													</div>
												</div>
												<!--Spoilage Date-->
												<div class="row">
													<div class="col-md-12 form-group">
														<div class="form-group label-floating">
															<label for="s_date">Spoilage Date</label>
															<input name="s_date" class="form-control" type="date"
																value="" id="example-number-input" required
																pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$"
																required>
														</div>
													</div>
												</div>
												<!--Remarks-->
												<div class="row">
													<div class="col-md-12 form-group">
														<div class="form-group label-floating">
															<label for="remarks">Remarks</label>
															<input class="form-control" type="text" name="remarks"
																required pattern="[a-zA-Z][a-zA-Z\s]*" required
																title="Desciption name should only countain letters"
																required>
														</div>
													</div>
												</div>
												<!--Spoilage Type-->
												<input type="hidden" id="s_type" name="s_type" value="s">
												<div class="modal-footer">
													<button type="button" class="btn btn-danger btn-sm"
														data-dismiss="modal">Cancel</button>
													<button class="btn btn-success btn-sm" type="submit">Add</button>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
							<!--END ADD SPOILAGE MODAL-->
							<!--MODAL DELETE-->
							<form>
								<div class="modal fade" id="deleteSpoilage" tabindex="-1" role="dialog"
									aria-labelledby="exampleModalLabel" aria-hidden="true">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="exampleModalLabel">Delete Spoilage</h5>
												<button type="button" class="close" data-dismiss="modal"
													aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
												<strong>Are you sure to remove this record?</strong>
											</div>
											<div class="modal-footer">
												<input type="hidden" name="s_id_remove" id="s_id_remove"
													class="form-control">
												<button type="button" type="submit" id="btn_cancel"
													class="btn btn-primary">Yes</button>
												<button type="button" class="btn btn-secondary"
													data-dismiss="modal">No</button>
											</div>
										</div>
									</div>
								</div>
							</form>
							<!--END MODAL DELETE-->
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
				'<td>' + d.remarks + '</td>' +
				'</tr>' +
				'</table>';

		}

		$(document).ready(function () {
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
						"data": "s_id"
					},
					{
						"data": "stock_name"
					},
					{
						"data": "s_qty"
					},
					{
						"data": "s_date"
					},
					{
						"data": "date_recorded"
					},
					{
						"data": null,
						render: function (data, type, row, meta) {
							return '<a href="javascript: void(0)" class="btn btn-warning btn-sm delete_data" data-id="' +
								data.s_id + '">Delete</a>';
						}
					}
				]
			});


		//For showing the accordion
		$('#tablevalues tbody').on('click', 'td.details-control', function () {
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
		$('#btn-show-all-children').on('click', function () {
			table.rows().every(function () {
				if (!this.child.isShown()) {
					this.child(format(this.data())).show();
					$(this.node()).addClass('shown');
				}
			});
		});

		$('#btn-hide-all-children').on('click', function () {
			table.rows().every(function () {
				if (this.child.isShown()) {
					this.child.hide();
					$(this.node()).removeClass('shown');
				}
			});
		});

	});
	// Function for Delete
	$(document).ready(function () { 
            $('.delete_data').click(function () {
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
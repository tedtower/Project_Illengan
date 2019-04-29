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
									<th>vCode</th>
									<th>sCode</th>
									<th>Item Name</th>
									<th>Quantity</th>
									<th>Date Spoiled</th>
									<th>Date Recorded</th>
									<th>Operation</th>
									<th>Operation</th>
									
								</thead>
								<tbody id="spoilage_data">
								</tbody>
							</table>
							<!--End Table Content-->
							<!--Start of Modal "Add Stock Spoilages"-->
							<div class="modal fade bd-example-modal-lg" id="addStockSpoilage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog modal-lg" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLabel">Add Spoilage</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<form id="formAdd" action="<?= site_url('admin/stock/spoilages/add')?>" accept-charset="utf-8">
											<div class="modal-body">
												<div class="form-row">
													<!--Container of Stock Spoilage Date-->
													<!--Spoilage Date-->
													<div class="input-group mb-3">
														<div class="input-group-prepend">
															<span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
																Spoilage Date</span>
														</div>
														<input type="date" name="spoilDate" id="spoilDate" class="form-control form-control-sm">
													</div>
												</div>
												<!--Add Stock Item-->
												<!--Button to add row in the table-->
												<!--Button to add launche the brochure modal-->
												<a class="addSpoilageItem btn btn-default btn-sm" data-toggle="modal" data-target="#brochureSS" data-original-title style="margin:0" id="addStockSpoilage">Add Spoilage Items</a>
												<br><br>
												<table class="stockSpoilageTable table table-sm table-borderless">
													<!--Table containing the different input fields in adding stock spoilages -->
													<thead class="thead-light">
														<tr>
															<th>Name</th>
															<th width="20%">Qty</th>
															<th>Remarks</th>
															<th></th>
														</tr>
													</thead>
													<tbody>
													</tbody>
												</table>
												<!--Total of the trans items-->
					
												<div class="modal-footer">
													<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
													<button type="button" class="btn btn-success btn-sm" onclick="addStockItems()">Add</button>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
							<!--End of Modal "Add Stock Spoilage"-->

							<!--Start of Brochure Modal"-->
                            <div class="modal fade bd-example-modal" id="brochureSS" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="background:rgba(0, 0, 0, 0.3)">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Select Variance</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form id="formAdd"  method="post" accept-charset="utf-8">
                                            <div class="modal-body">
                                                <div style="margin:1% 3%" id="list">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
												<button type="button" class="btn btn-danger btn-sm"
													data-dismiss="modal">Cancel</button>
												<button type="button" class="btn btn-success btn-sm" data-dismiss="modal" onclick="getSelectedStocks()">Ok</button>
											</div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <!--End of Brochure Modal"-->

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
												<div>
													Remarks:<input type="text" name="deleteRemarks" id="deleteRemarks" class="form-control form-control-sm">
												</div>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
												<button type="submit" class="btn btn-danger btn-sm">Delete</button>
											</div>
										</form>
									</div>
								</div>
							</div>
							<!--End of Delete Modal-->
							<!--Edit Spoilage-->
							<div class="modal fade" id="editSpoil" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Spoilage</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form id="formEdit" accept-charset="utf-8">
                                                
												<div class="modal-body">
                                                    <!--Quantity-->
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm" style="width:140px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                Quantity</span>
                                                        </div>
                                                        <input type="number" min="1" name="ssQty" id="ssQty" class="form-control form-control-sm">
                                                        <span class="text-danger"><?php echo form_error("ssQty"); ?></span>
                                                    </div>
                                                    <!--Date Spoiled-->
													<div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm" style="width:140px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                Date Spoiled</span>
                                                        </div>
                                                        <input type="date" name="ssDate" id="ssDate" class="form-control form-control-sm">
                                                        <span class="text-danger"><?php echo form_error("ssDate"); ?></span>
                                                    </div>
													<div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm" style="width:140px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                Remarks</span>
                                                        </div>
                                                        <input type="text" name="ssRemarks" id="ssRemarks" class="form-control form-control-sm">
                                                        <span class="text-danger"><?php echo form_error("ssRemarks"); ?></span>
                                                    </div>
													<input name="ssID" hidden="hidden">
													<input name="vID" hidden="hidden">
                                                    <!--Footer-->
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
                                                        <button class="btn btn-success btn-sm" id="btn_update" type="submit" >Update</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                            </div>
							<!--End of Edit Modal-->
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!--End Table Content-->
<?php include_once('templates/scripts.php') ?>
<script src="<?= admin_js().'addSpoilageBrochure.js'?>"></script>
<script>
var stockchoice = [];
	//  $(function() {
    //     viewStocksJs();
	//  })
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
		var etable = $('#tablevalues').DataTable({
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
					"data": "vID"
				},
				{
					"data": "ssID",
				},
				{
					"data": "vName"
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
							data.ssID + '">Delete</a>';
					}
				},
				{
					"data": null,
					render: function(data, type, row, meta) {
						return '<button class="updateBtn btn btn-default btn-sm" data-toggle="modal" data-target="#editSpoil" data-ssID="' + 
						data.ssID +'" data-id="'+ data.vID + '">Edit</button>';
					}
				}
			]
		});



		//For showing the accordion
		$('#tablevalues tbody').on('click', 'td.details-control', function() {
			var tr = $(this).closest('tr');
			var row = etable.row(tr);

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
			etable.rows().every(function() {
				if (!this.child.isShown()) {
					this.child(format(this.data())).show();
					$(this.node()).addClass('shown');
				}
			});
		});

		$('#btn-hide-all-children').on('click', function() {
			etable.rows().every(function() {
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

	
	$(function () {
	$.ajax({
            url: '<?= site_url('admin/stock/spoilages/viewStockJS') ?>',
            dataType: 'json',
            success: function (data) {
                var poLastIndex = 0;
                stocks = data;
                setStockData(stocks);
            },
            failure: function () {
                console.log('None');
            },
            error: function (response, setting, errorThrown) {
                console.log(errorThrown);
                console.log(response.responseText);
            }
		});

	});
	function setStockData(stocks){
        $("#list").empty();
        $("#list").append(`${stocks.map(stock => {
            return `<label style="width:96%"><input type="checkbox" name="stockchoice[]" class="choiceStock mr-2" value="${stock.vID}">${stock.vName}</label>`
        }).join('')}`);
		}
		
	 // Edit Spoilage===========================================
	//  $('#spoilage_data').on('click', '.updateBtn', function() {
	//    var ssID = $(this).data('ssID');
	//    var vID = $(this).data('id');

	// 	updateSpoil(ssID,vID);		
    // });

	$('#tablevalues').on( 'click', '#btn_update', function () {
		var vID = etable.row( this ).id();
		var ssID = etable.row( this ).ssID();
        var ssQty = $('#ssQty').val();
		var ssDate = $('#ssDate').val();
		var ssRemarks = $('#ssRemarks').val();
		console.log(vID);
        $.ajax({
            type: "POST",
            url: "http://illengan.com/admin/stock/spoilage/edit",
            dataType: "JSON",
            data: {
				ssID : ssID,
				vID : vID,
				ssQty : ssQty,
				ssDate : ssDate,
				ssRemarks : ssRemarks
            },
            success: function(data) {
                // $('[name="ssID"]').val("");
                // $('[name="vID"]').val("");
                // $('[name="ssQty"]').val("");
				// $('[name="ssDate"]').val("");
				// $('[name="ssRemarks"]').val("");
                alert("Table Code was successfully updated!");
                console.log(data);
                $('#editSpoil').modal('hide');
                location.reload();
				console.log(vID);
            }
        });
		console.log(vID);
        return false;
    });


</script> 
</body>

</html>
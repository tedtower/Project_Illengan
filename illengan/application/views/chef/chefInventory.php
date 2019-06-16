<!DOCTYPE html>
<html>

<head>
	<?php include_once('head.php') ?>
</head>

<body style="background:white">
	<?php include_once('navigation.php') ?>
	<!--End Top Nav-->
	<div class="content">
		<div class="container-fluid">
			<p style="text-align:right; font-weight:regular; font-size:16px">
				<!--Real Time Date & Time-->
				<?php echo date("M, j, Y - l"); ?>
			</p>
			<div class="content" style="margin-left:auto">
				<div class="container-fluid">
					<div class="card-content">
						<!--Restock BUTTON-->
						<a class="btn btn-primary" data-toggle="modal" data-target="#restock" data-original-title style="margin:2px">Restock</a>
						<!--Destock BUTTON-->
						<a class="btn btn-primary" data-toggle="modal" data-target="#destock" data-original-title style="margin:2px">Destock</a><br>
						<!--Sart Table-->
						<br>
						<table id="ordersTable" class="table table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
							<thead class="thead-dark">
								<tr>
									<th width="50%"><b class="pull-left">ITEM NAME</b></th>
									<th><b class="pull-left">ITEM STATUS</b></th>
									<th><b class="pull-left">ITEM QTY</b></th>
									<th><b class="pull-left">ITEM STATUS</b></th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
						<!--End Table-->
						<!--Start of RESTOCK Modal-->
						<div class="modal fade bd-example-modal-lg" id="restock" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-lg" role="document" style="width:80%">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Restock Item</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<form id="addItem" method="POST" accept-charset="utf-8">
										<div class="modal-body">
											<!--Add Stock Item-->
											<a class="btn btn-primary btn-sm" style="margin:0;font-weight:600" data-toggle="modal" data-target="#restockbro">Add Item</a>
											<!--Button to add row in the table-->
											<br><br>
											<!--Restock Date-->
											<div class="input-group mb-3 col" style="width:45%;">
												<div class="input-group-prepend" style="margin-left:-15px">
													<span class="input-group-text border border-secondary" style="width:120px;background:#bfbfbf;color:black;font-size:14px;">
														Restock Date</span>
												</div>
												<input type="date" class="form-control  border-left-0" name="restock_date" id="restock_date" required>
												<span class="text-danger"><?php echo form_error("restock_date"); ?></span>
											</div>
											<!--End Restock Date-->
											<table class="restockTable table table-sm table-borderless">
												<!--Table containing the different input fields in adding trans items -->
												<thead style="border-bottom:2px solid #cecece">
													<tr class="text-center">
														<th width="65%"><b>Item Name</b></th>
														<th><b>Qty</b></th>
														<th></th>
													</tr>
												</thead>
												<tbody class="restockBodyTable">
													<!--inputContainerParent-->
												</tbody>
											</table>
											<div class="modal-footer">
												<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
												<button class="btn btn-success btn-sm" onclick="addRestockItems()">Add</button>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
						<!--End of RESTOCK Modal-->

						<!--Start of Brochure Modal"-->
						<div class="modal fade bd-example-modal" id="restockbro" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="background:rgba(0, 0, 0, 0.3)">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Select Stock Item</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<form id="restockitem" method="post" accept-charset="utf-8">
										<div class="modal-body">
											<div class="inputContainerParent" style="margin:1% 3%" id="list">
											</div>
										</div>
										<!--Footer-->
										<div class="modal-footer">
											<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
											<button type="button" class="btn btn-success btn-sm" data-dismiss="modal" onclick="getRestockStocks()">Ok</button>
										</div>
									</form>
								</div>
							</div>
						</div>
						<!--End of Brochure Modal"-->

						<!--Start of DESTOCK MODAL-->
						<div class="modal fade bd-exampl-modal-lg" id="destock" tabindex="-1" role="dialog">
							<div class="modal-dialog modal-lg" role="document" style="width:80%">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Destock Item</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<form id="addItem" method="POST" accept-charset="utf-8">
										<div class="modal-body">
											<!--Add Item Button-->
											<a class="btn btn-primary btn-sm" style="margin:0;font-weight:600" data-toggle="modal" data-target="#destockbro">Add Item</a>
											<!--Button to add row in the table-->
											<br><br>
											<div class="form-row">
												<!--Destock Date-->
												<div class="input-group mb-3 col" style="width:45%;">
													<div class="input-group-prepend">
														<span class="input-group-text border border-secondary" style="width:120px; background:#bfbfbf; color:black; font-size:14px;">
															Destock Date</span>
													</div>
													<input type="date" class="form-control  border-left-0" name="destock_date" id="destock_date" required>
													<span class="text-danger"><?php echo form_error("destock_date"); ?></span>
												</div>
												<!--Destock Type-->
												<div class="input-group mb-3 col" style="">
													<div class="input-group-prepend">
														<span class="input-group-text border border-secondary" style="width:120px; background:#bfbfbf; color:black; font-size:14px">
															Destock Type</span>
													</div>
													<select class="form-control border-left-0" name="tType">
														<option value="" selected="">Choose</option>
														<option value="consumed">Consumed</option>
														<option value="spoilage">Spoilage</option>
													</select>
												</div>
											</div>
												<!--Start Table-->
												<table class="destockTable table table-sm table-borderless inputTable">
													<!--Table containing the different input fields in adding trans items -->
													<thead style="border-bottom:2px solid #cecece">
														<tr class="text-center">
															<th width="65%"><b>Item Name</b></th>
															<th><b>Qty</b></th>
															<th></th>
														</tr>
													</thead>
													<tbody class="destockBodyTable">
														<!--inputContainerParent-->
													</tbody>
												</table>
												<!--Footer-->
												<div class="modal-footer">
													<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
													<button class="btn btn-success btn-sm" onclick="addDestockItems()">Add</button>
												</div>
										</div>
									</form>
								</div>
							</div>
						</div>
						<!--End of DESTOCK MODAL-->
						<!--Start of Brochure Modal DESTOCK"-->
						<div class="modal fade bd-example-modal" id="destockbro" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="background:rgba(0, 0, 0, 0.3)">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Select Stock Items</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<form id="destockitem" method="post" accept-charset="utf-8">
										<div class="modal-body">
											<div style="margin:1% 3%" id="list2">
											</div>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
											<button type="button" class="btn btn-success btn-sm" data-dismiss="modal" onclick="getDestockStocks()">Ok</button>
										</div>
									</form>
								</div>
							</div>
						</div>
						<!--End of Brochure Modal DESTOCK"-->
					</div>
				</div>
			</div>
		</div>
	</div>
</body>



<?php include_once('scripts.php') ?>
<script type="text/javascript" src="<?php echo base_url() . 'assets/js/barista/baristaInventoryBrochure.js' ?>">
</script>
<script>
	var inventoryitems = [];
	$(function() {
		viewInventoryJs();
		//-----------------------Populate Brochure----------------------------------------
		$.ajax({
			url: '<?= site_url('barista/inventoryJS') ?>',
			dataType: 'json',
			success: function(data) {
				var poLastIndex = 0;
				stocks = data;
				setStockData(stocks);
			},
			failure: function() {
				console.log('None');
			},
			error: function(response, setting, errorThrown) {
				console.log(errorThrown);
				console.log(response.responseText);
			}
		});

	});

	function setStockData(stocks) {
		$("#list").empty();
		$("#list").append(`${stocks.map(stock => {
				return `<label style="width:96%"><input type="checkbox" name="stockchoice[]" class="choiceStock mr-2" value="${stock.stID}">${stock.stName}</label>`
			}).join('')}`);
		$("#list2").empty();
		$("#list2").append(`${stocks.map(stock => {
				return `<label style="width:96%"><input type="checkbox" name="stockchoice[]" class="choiceStock2 mr-2" value="${stock.stID}">${stock.stName}</label>`
			}).join('')}`);
	}
	//-----------------------End of Brochure Populate--------------------------	

	//POPULATE TABLE
	var table = $('#inventoryTable');

	function viewInventoryJs() {
		$.ajax({
			url: "<?= site_url('chef/inventoryJS') ?>",
			method: "post",
			dataType: "json",
			success: function(data) {
				inventoryitems = data;
				setInventoryData(inventoryitems);
				console.log(data);
			},
			error: function(response, setting, errorThrown) {
				console.log(response.responseText);
				console.log(errorThrown);
			}
		});
	}

	function setInventoryData() {
		if ($("#inventoryTable> tbody").children().length > 0) {
			$("#inventoryTable> tbody").empty();
		}
		inventoryitems.forEach(table => {
			$("#inventoryTable> tbody").append(`
					<tr data-stID="${table.stID}" data-stID="${table.stID}">
						<td>${table.stName}</td>
						<td>${table.stStatus}</td>
						<td>${table.stQty}</td>
						<td>${table.stStatus}</td>
					</tr>`);
		});
	}
	//END OF POPULATING TABLE

	// 		//-----------------------Populate Dropdown----------------------------------------
	// 			$.ajax({
	// 				url: '<= site_url('barista/inventoryJS') ?>',
	// 				dataType: 'json',
	// 				success: function (data) {
	// 					var poLastIndex = 0;
	// 					stockitem = data;
	// 					setStockData(stockitem);
	// 				},
	// 				failure: function () {
	// 					console.log('None');
	// 				},
	// 				error: function (response, setting, errorThrown) {
	// 					console.log(errorThrown);
	// 					console.log(response.responseText);
	// 				}
	// 			});

	// 	function setStockData(stockitem){
	// 			$("#stockitems").empty();
	// 			$("#stockitems").append(`${stockitem.map(stocks => {
	// 				return `<option name= "stName" id ="stName" value="${stocks.stID}">${stocks.stName}</option>`
	// 			}).join('')}`);
	// 	}
	//   //-----------------------End of Dropdown Populate--------------------------	
</script>
</body>

</html>
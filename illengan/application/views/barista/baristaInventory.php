<head>
	<meta charset="UTF-8">
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport'>
	<meta name="viewport" content="width=device-width">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Il-Lengan | Barista Orders</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/css/barista/bootstrap.css' ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/css/barista/jquery.dataTables.css' ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/css/barista/dataTables.bootstrap4.css' ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/css/barista/responsive.bootstrap.css' ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/css/barista/select.bootstrap.css' ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/css/barista/buttons.bootstrap.css' ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/css/barista/style.css' ?>">

</head>

<div class="content">
	<p style="text-align:right; font-weight: regular; font-size: 16px">
		<!-- Real Time Date & Time -->
		<?php echo date("M j, Y -l"); ?>
	</p>
	<!--Table-->
	<div class="card-content">

		<!--Add Stock Inventory BUTTON-->
		<a class="btn btn-default btn-sm" data-toggle="modal" data-target="#Destock" data-original-title style="margin:0">Add Stock Inventory</a><br>
		<!--eND Add Stock Inventory BUTTON-->
		<br>
		<table id="inventoryTable" class="invtable dtr-inline collapsed table display" style="border:1px solid red; margin:0;left:0">
			<thead>
				<th>Item Name</th>
				<th>Item Status</th>
				<th>Item Unit</th>
				<th>Item Size</th>
				<th>Item Qty</th>
				<th>Operation</th>

			</thead>
			<tbody id="spoilage_data">
			</tbody>
		</table>
		<!--End Table Content-->
		<!--Start of Modal "Add Stock Spoilages"-->
		<div class="modal fade bd-example-modal-lg" id="Destock" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Add Inventory</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form id="formAdd" action="<?= site_url('admin//inventoryitems/add') ?>" accept-charset="utf-8">
						<div class="modal-body">
							<div class="form-row">
								<!--Container of Stock Inventory Date-->
								<!--Inventory Date-->
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
											Inventory Date</span>
									</div>
									<input type="date" name="spoilDate" id="spoilDate" class="form-control form-control-sm" required>
								</div>
							</div>
							<!--Add Stock Item-->
							<!--Button to add row in the table-->
							<!--Button to add launche the brochure modal-->
							<a class="addSpoilageItem btn btn-default btn-sm" data-toggle="modal" data-target="#brochureSS" data-original-title style="margin:0" id="Destock">Add Inventory Items</a>
							<br><br>
							<table class="inventoryItemTable table table-sm table-borderless">
								<!--Table containing the different input fields in adding  inventoryitems -->
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
	</div>
</div>
</div>
</div>
</div>
</div>
</div>

<!--End of Modal "Add Stock Inventory"-->
<!--End Table Content-->
<script src="<?= admin_js() . 'addStockSpoilBrochure.js' ?>"></script>
<script>
	var inventoryitems = [];
	var stockchoice = [];
	$(function() {
		viewInventoryJs();
	})
	//POPULATE TABLE
	var table = $('#inventoryTable');

	function viewInventoryJs() {
		$.ajax({
			url: "<?= site_url('barista/inventoryJS') ?>",
			method: "post",
			dataType: "json",
			success: function(data) {
				inventoryitems = data;
				setInventoryData(inventoryitems);
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
            <tr data-stID="${table.stID}" data-vID="${table.vID}>
                <td>${table.stName}</td>
                <td>${table.stStatus}</td>
				<td>${table.vUnit}</td>
				<td>${table.vSize}</td>
				<td>${table.vQty}</td>
                <td>
                        <!--Action Buttons-->
                        <div class="onoffswitch">

                            <!--Edit button-->
                            <button class="updateBtn btn btn-default btn-sm" data-toggle="modal"
                                data-target="#editSpoil">Edit</button>
                            <!--Delete button-->
                            <button class="item_delete btn btn-danger btn-sm" data-toggle="modal" 
                            data-target="#deleteSpoilage">Delete</button>                      
                        </div>
                    </td>
                </tr>`);
			$(".updateBtn").last().on('click', function() {
				$("#editSpoil").find("input[name='stID']").val($(this).closest("tr").attr(
					"data-stID"));
				$("#editSpoil").find("input[name='vID']").val($(this).closest("tr").attr(
					"data-vID"));
			});
			$(".item_delete").last().on('click', function() {
				$("#deleteSpoilageId").text(
					`Delete spoilage code ${$(this).closest("tr").attr("data-spoilname")}`);
				$("#deleteSpoilage").find("input[name='vID']").val($(this).closest("tr").attr(
					"data-vID"));
			});
		});
	}
	//END OF POPULATING TABLE
</script>
</body>

</html>
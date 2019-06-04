<!DOCTYPE html>
<html>

<head>
	<?php include_once('templates/head.php') ?>
</head>

<body style="background:white">
	<?php include_once('templates/navigation.php') ?>
	<!--End Top Nav-->
	<div class="content">
		<div class="container-fluid">
			<br>
			<p style="text-align:right; font-weight: regular; font-size: 16px">
				<!-- Real Time Date & Time -->
				<?php echo date("M j, Y - l"); ?>
			</p>
			<div class="content" style="margin-left:auto;">
				<div class="conteiner-fluid">
					<a class="btn btn-basic btn-sm" data-toggle="modal" data-target="#restock" data-original-title style="margin:0; color:blue;" id="addBtn">Restock</a>
					<a class="btn btn-default btn-sm" data-toggle="modal" data-target="#destock" data-original-title style="margin:0;" id="addBtn">Destock</a>
					<br><br>
					<!--Start Table-->
					<div class="card-content">
						<table id="ordersTable" class="table table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
							<thead class="thead-dark">
								<tr>
									<th><b class="pull-left">STOCK NAME</b></th>
									<th><b class="pull-left">CATEGORY</b></th>
									<th><b class="pull-left">QUANTITY</b></th>
									<th><b class="pull-left">MIN QTY</b></th>
									<th><b class="pull-left">UNIT</b></th>
									<th><b class="pull-left">STATUS</b></th>
									<th><b class="pull-left">ACTIONS</b></th>
								</tr>
							</thead>
							<!--Start Table Body-->
							<tbody>
                            <?php foreach($inventory['stocks'] as $stock){?>
                            <tr data-id="<?= $stock['stID']?>">
                                <td><?= $stock['stName']?></td>
                                <td><?= $stock['ctName']?></td>
                                <td><?= $stock['stQty']?></td>
                                <td><?= $stock['stMin']?></td>
                                <td><?= $stock['uomAbbreviation']?></td>
                                <td><?= $stock['stStatus']?></td>
                                <td><?= $stock['stLocation']?></td>
                                <td>
                                    <button class="editBtn btn btn-default btn-sm" data-toggle="modal" data-target="#addEditStock">Edit</button>
                                    <button class="btn btn-warning btn-sm">Archived</button>
                                </td>
                                <?php } ?>
                            </tr>
                        </tbody>
						</table>
					</div>
					<!--End Table-->
				</div>
			</div>
		</div>
	</div>

	<!--Start MODAL for BILL COMPUTATION-->

	<div class="modal fade bd-example-sm" id="Modal_Pay" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="overflow: auto !important;">
		<div class="modal-dialog modal-sm" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Payment</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<!--Modal Content-->
				<form id="formAdd" action="<?= site_url('barista/billings/add') ?>" method="POST" accept-charset="utf-8">
					<div class="modal-body">
						<!--Amount Payable-->
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text" id="inputGroup-sizing-sm" style="width:140px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
									Amount Payable:</span>
							</div>
							<input type="text" class="form-control" name="amount_payable" id="amount_payable" value="<?= $bill['osTotal'] ?>" readonly>
							<span class="text-danger"><?php echo form_error("amount_payable"); ?></span>
						</div>
						<!--Cash-->
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text" id="inputGroup-sizing-sm" style="width:140px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
									Cash:</span>
							</div>
							<input type="text" class="form-control" name="cash" id="cash" value="0.00" required>
							<span class="text-danger"><?php echo form_error("cash"); ?></span>
						</div>
						<!--Change-->
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text" id="inputGroup-sizing-sm" style="width:140px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
									Change:</span>
							</div>
							<input type="text" class="form-control" name="change" id="change" value="0.00" readonly>
							<span class="text-danger"><?php echo form_error("change"); ?></span>
						</div>

						<!--Footer-->
						<div class="modal-footer">
							<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
							<button class="btn btn-success btn-sm" type="submit">Done</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>



	<!--End MODAL for BILL COMPUTATION-->

	<!--Start MODAL for DELETE-->
	<div class="modal fade" id="Modal_Remove" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLongTitle">Remove Order</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form id="confirmDelete">
					<div class="modal-body">
						<h6 id="deleteTableCode"></h6>
						<p style="text-align:center;">Are you sure to remove the selected orderslip?</p>
						<input type="text" name="" hidden="hidden">
						<div>
							Remarks:<input type="text" name="deleteRemarks" id="deleteRemarks" class="form-control form-control-sm">
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">No</button>
						<button type="submit" class="btn btn-danger btn-sm">Delete</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!--End MODAL for DELETE-->

	<?php include_once('templates/scripts.php') ?>

<script>
var lastIndex = 0;
var crudUrl = '<?= site_url("admin/inventory/addEdit")?>';
var enumValsUrl = '<?= site_url('admin/inventory/getEnumVals')?>';
var getStockUrl = '<?= site_url('admin/inventory/getStockItem')?>';
var loginUrl = '<?= site_url('login')?>';
$(document).ready(function() {
    $("#addBtn").on('click', function() {
        $("#addEditStock form")[0].reset();
        getEnumVals(enumValsUrl);
    });
    $(".editBtn").on("click", function() {
        var id = $(this).closest("tr").attr("data-id");
        getEnumVals(enumValsUrl);
        populateModalForm(id, getStockUrl);
    });
    // setTableData();
    $("#addEditStock form").on('submit', function(event) {
        event.preventDefault();
        var id = $(this).find("input[name='stockID']").val();
        id = isNaN(parseInt(id)) ? (undefined) :  parseInt(id);
        var name = $(this).find("input[name='stockName']").val();
        var type = $(this).find("select[name='stockType']").val();
        var category = $(this).find("select[name='stockCategory']").val();
        var status = $(this).find("select[name='stockStatus']").val();
        var storage = $(this).find("select[name='stockStorage']").val();
        var min = $(this).find("input[name='stockMinQty']").val();
        var qty = $(this).find("input[name='stockQty']").val();
        var uom = $(this).find("select[name='stockUOM']").val();
        var size = $(this).find("input[name='stockSize']").val().concat($(this).find("select[name='stockSizeUOM']").val());
        $.ajax({
            url: crudUrl,
            method: "POST",
            data: {
                id: id,
                name: name,
                type: type,
                category: category,
                status: status,
                storage: storage,
                min: min,
                qty: qty,
                uom: uom,
                size: size
            },
            dataType: "JSON",
            beforeSend: function() {
                console.log("Name: ", name, " Type: ", type, " Category: ", category, " Status: ", status, " Storage: ", storage, " Min: ", min, " QTY: ", qty, " UOM: ", uom, " Size: ", size, "");
            },
            success: function(data) {
                 if(data.sessErr){
                     window.location.replace(loginUrl);
                 }else if(data.dbErr){
                     alert("Database Error");
                 }else{
                     console.log(data);
                 }
            },
            error: function(response, setting, error) {
                console.log(response.responseText);
                console.log(error);
            },
            complete: function() {
                $("#addEditStock").modal("hide");
            }
        });
    });
});

function getEnumVals(url){
    $.ajax({
        method: 'POST',
        url: url,
        dataType: 'JSON',
        success: function(data){
            $("#addEditStock").find("select[name='stockType']").children().first().siblings().remove();
            $("#addEditStock").find("select[name='stockStatus']").children().first().siblings().remove();
            $("#addEditStock").find("select[name='stockStorage']").children().first().siblings().remove();
            $("#addEditStock").find("select[name='stockSizeUOM']").children().first().siblings().remove();
            $("#addEditStock").find("select[name='stockUOM']").children().first().siblings().remove();
            $("#addEditStock").find("select[name='stockCategory']").children().first().siblings().remove();
            $("#addEditStock").find("select[name='stockType']").append(data.stTypes.map(type=>{
                return `<option value="${type}">${type.toUpperCase()}</option>`; 
            }).join(''));
            $("#addEditStock").find("select[name='stockStatus']").append(data.stStatuses.map(status=>{
                return `<option value="${status}">${status.toUpperCase()}</option>`;
            }).join(''));
            $("#addEditStock").find("select[name='stockStorage']").append(data.stLocations.map(storage=>{
                return `<option value="${storage}">${storage.toUpperCase()}</option>`;
            }).join(''));
            $("#addEditStock").find("select[name='stockSizeUOM']").append(data.uomVariants.map(variant=>{
                return `<option value="${variant.uomAbbreviation}" data-type="${variant.uomVariant}">${variant.uomName} - ${variant.uomAbbreviation}</option>`;
            }).join(''));
            $("#addEditStock").find("select[name='stockSizeUOM'] option").hide();
            $("#addEditStock").find("select[name='stockType']").on('change',function(){
                $("#addEditStock").find("select[name='stockSizeUOM'] option").hide();
            });
            $("#addEditStock").find("select[name='stockSizeUOM']").on('focus',function(){
                $("#addEditStock").find(`select[name='stockSizeUOM'] option[data-type="${$("#addEditStock").find("select[name='stockType']").val().toUpperCase()}"]`).show();
            });
            $("#addEditStock").find("select[name='stockUOM']").append(data.uomStores.map(unit=>{
                return `<option value="${unit.uomID}">${unit.uomName} - ${unit.uomAbbreviation}</option>`;
            }).join(''));
            $("#addEditStock").find("select[name='stockCategory']").append(data.categories.map(category=>{
                return `<option value="${category.ctID}">${category.ctName.toUpperCase()}</option>`;
            }).join(''));
        },
        error: function(response, setting, error) {
            console.log(response.responseText);
            console.log(error);
        }
    });
}

function populateModalForm(id, url){
    var matches;
    $("#addEditStock form")[0].reset();
    $.ajax({
        method: 'POST',
        url: url,
        data: {
            id: id
        },
        dataType: 'JSON',
        success: function(data){
            matches = data.stock.stSize.match(/\d+|\w+/g);
            $("#addEditStock").find("input[name='stockID']").val(data.stock.stID);
            $("#addEditStock").find("input[name='stockName']").val(data.stock.stName);
            $("#addEditStock").find("select[name='stockType']").find(`option[value="${data.stock.stType.toLowerCase()}"]`).attr("selected","selected");
            $("#addEditStock").find("select[name='stockCategory']").find(`option[value=${data.stock.ctID}]`).attr("selected","selected");
            $("#addEditStock").find("select[name='stockStatus']").find(`option[value="${data.stock.stStatus.toLowerCase()}"]`).attr("selected","selected");
            $("#addEditStock").find("select[name='stockStorage']").find(`option[value="${data.stock.stLocation.toLowerCase()}"]`).attr("selected","selected");
            $("#addEditStock").find("input[name='stockMinQty']").val(data.stock.stMin);
            $("#addEditStock").find("input[name='stockQty']").val(data.stock.stQty);
            $("#addEditStock").find("select[name='stockUOM']").find(`option[value=${data.stock.uomID}]`).attr("selected","selected");
            if(data.uomVariants.findIndex(variant => variant.uomAbbreviation === matches[matches.length-1]) !== -1){
                $("#addEditStock").find("select[name='stockSizeUOM']").find(`option[value="${matches.pop().toLowerCase()}"]`).attr("selected","selected");
            }
            $("#addEditStock").find("input[name='stockSize']").val(matches.join(' '));
        },
        error: function(response, setting, error) {
            console.log(response.responseText);
            console.log(error);
        }
    });
}
</script>
</body>

</html>
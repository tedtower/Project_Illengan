<!--Start of Modal RESTOCK-->
<div class="modal fade bd-example-modal-lg" id="restock" tabindex="-1" role="dialog">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Restock</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<!--Modal Content-->
					<form id="addItem" method="post" accept-charset="utf-8">
						<div class="modal-body">
							<a class="btn btn-default btn-sm" href="javascript:void(0)" data-toggle="modal"
								data-target="#restockbro"><b>Add Item</b></a>
							<br>
							<br>
							<div class="d-flex justify-content-center">
								<table class="restockTable table table-sm table-borderless" style="width:90%">
									<thead class="thead-light">
										<tr class="text-center">
											<th width="65%"><b>Item Name</b></th>
											<th width="*"><b>Quantity</b></th>
											<th width="20px"></th>
										</tr>
									</thead>
									<tbody id="restockBodyTable">
									</tbody>
								</table>
							</div>
							<!--Modal Footer-->
							<div class="modal-footer">
								<button type="button" class="btn btn-default btn-sm"
									data-dismiss="modal">Cancel</button>
								<button type="button" class="btn btn-success btn-sm"
									onclick="addRestockItems()">Add</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<!--End of Modal RESTOCK-->
		<!--Start of Brochure Modal RESTOCK"-->
		<div class="modal fade bd-example-modal" id="restockbro" tabindex="-1" role="dialog"
			aria-labelledby="exampleModalLabel" aria-hidden="true" style="background:rgba(0, 0, 0, 0.3)" >
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Select Stockitems</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form id="restockitem" method="post" accept-charset="utf-8">
						<div class="modal-body">
							<div style="margin:1% 3%" id="list">
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
							<button type="button" class="btn btn-success btn-sm" data-dismiss="modal"
								onclick="getRestockStocks()">Ok</button>
						</div>
					</form>
		</div>
		</div>
		</div>
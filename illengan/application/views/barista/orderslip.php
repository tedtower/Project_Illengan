<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Il-Lengan | Orderslip </title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/barista/bootstrap.css'?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/barista/jquery.dataTables.css'?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/barista/dataTables.bootstrap4.css'?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/barista/style.css'?>">
</head>
<body>
<?php include_once('headernav.php') ?>
<br>
<div class="container">

            <table id="ordersTable" class="tableorders dtr-inline collapsed table display"  >
                <thead>
                    <tr>
                        <!-- <th>Slip No.</th> -->
                        <th>Order Item No.</th>
                        <th>Customer Name</th>
                        <th>Table</th>
                        <th>Action</th>
                        <th>Order</th>
                        <th>Order Qty</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
      </div>

<!-- MODAL EDIT -->
            <div class="modal fade" id="editTable" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Table Code</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <form id="formEdit" accept-charset="utf-8" > 
                  <div class="modal-body">
                        <h6 id="editTableCode"></h6>
                        <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="inputGroup-sizing-sm" style="width:130px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                            Change Table</span>
                        </div>
                          <select name="tableCode" id="tableCode" class="form-control form-control-sm" required>
                          </select>                    
                        <input name="osID" id="osID" hidden="hidden">
                  </div>
                  <div class="modal-footer">
                  <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
                  <button class="btn btn-success btn-sm" type="submit">Update</button>
                  </div>
                </div>
                </form>
              </div>
            </div>
        <!--END MODAL EDIT-->

        <!--MODAL DELETE-->

    <div class="modal fade" id="deleteOrder" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Cancel Order</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form id="confirmDelete">
            <div class="modal-body">
              <strong>Are you sure to remove this record?</strong>
              <input type="hidden" name="osID" id="osID" class="form-control">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-danger btn-sm">Delete</button>
            </div>
          </form>
        </div>
      </div>
    </div>
        <!--END MODAL DELETE-->

        

<script type="text/javascript" src="<?php echo base_url().'assets/js/barista/jquery-3.2.1.js'?>"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/js/barista/bootstrap.js'?>"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/js/barista/jquery.dataTables.js'?>"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/js/barista/dataTables.bootstrap4.js'?>"></script>

<script type="text/javascript">
	var orders = [];
  $(function() {
		viewOrdersJs();
    //-----------------------Populate Dropdown----------------------------------------
		$.ajax({
				url: '<?= site_url('barista/getTables') ?>',
				dataType: 'json',
				success: function (data) {
					var poLastIndex = 0;
					table = data;
					setTableData(table);
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
	function setTableData(table){
			$("#tableCode").empty();
			$("#tableCode").append(`${table.map(tables => {
				return `<option name= "tableCode" id ="tableCode" value="${tables.tableCode}">${tables.tableCode}</option>`
			}).join('')}`);
	}
  //-----------------------End of Dropdown Populate--------------------------	

//POPULATE TABLE
var table = $('#ordersTable');
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
	function viewOrdersJs() {
        $.ajax({
            url: "<?= site_url('barista/viewOrderslipJS') ?>",
            method: "post",
            dataType: "json",
            success: function(data) {
                orders = data;
                setOrdersData(orders);
            },
            error: function(response, setting, errorThrown) {
                console.log(response.responseText);
                console.log(errorThrown);
            }
        });
	}
	function setOrdersData() {
        if ($("#ordersTable> tbody").children().length > 0) {
            $("#ordersTable> tbody").empty();
        }
        orders.forEach(table => {
            $("#ordersTable> tbody").append(`
            <tr data-osID="${table.osID}" data-tID="${table.tableCode}" data-olID="${table.olID}">
                <td>${table.osID}</td>
                <td>${table.custName}</td>
                <td>${table.tableCode}</td>
                <td>
                    <!--Action Buttons-->
                    <div class="onoffswitch">
                        <!--Edit button-->
                        <button class="updateBtn btn btn-default btn-sm" data-toggle="modal"
                        data-target="#editTable">Edit</button>                  
                    </div>
                </td>
                <td>${table.olDesc}</td>
                <td>${table.olQty}</td>
                <td>
                      <!--Action Buttons-->
                      <div class="onoffswitch">
                            <!--Delete button-->
                            <button class="item_delete btn btn-danger btn-sm" data-toggle="modal" 
                            data-target="#deleteOrder">Delete</button>                      
                        </div>
                </td>
                </tr>`);
            $(".updateBtn").last().on('click', function () {
				      $("#editTableCode").text(
                   `Edit table code ${$(this).closest("tr").attr("data-tID")}`);
              $("#editTable").find("input[name='osID']").val($(this).closest("tr").attr(
                    "data-osID"));
            });
            $(".item_delete").last().on('click', function () {
				      $("#deleteOrder").find("input[name='osID']").val($(this).closest("tr").attr(
                    "data-osID"));
            });
        });
	}
  //END OF POPULATING TABLE
  //-------------------------Function for Edit-------------------------------
	$(document).ready(function() {
    $("#editTable form").on('submit', function(event) {
		event.preventDefault();
		var osID = $(this).find("input[name='osID']").val();
    var tableCode = $(this).find("select[name='tableCode']").val();
      
        $.ajax({
            url: "<?= site_url("barista/editTableNumber")?>",
            method: "post",
            data: {
                osID: osID,
                tableCode: tableCode
            },
            dataType: "json",
            success: function(data) {
                alert('Table Updated');
				        console.log(data);
            },
            complete: function() {
                $("#editTable").modal("hide");
				        location.reload();
            },
            error: function(error) {
                console.log(error);
            }
            
        });
    });
});
  //--------------------End of Function for Edit-----------------------------
   // Delete Account Function====================================

   $("#confirmDelete").on('submit', function(event) {
        event.preventDefault();
        var osID = $(this).find("input[name='osID']").val();
        $.ajax({
                url: '<?= site_url('barista/deleteOrderslip') ?>',
                method: 'POST',
                data: {
                    osID: osID
                },
                dataType: 'json',
                success: function(data) {
                    orderslip = data;
                    setOrdersData();
                },
                complete: function() {
                $("#deleteOrder").modal("hide");
				        location.reload();
                }
            });
        });
</script>

</body>
</html>

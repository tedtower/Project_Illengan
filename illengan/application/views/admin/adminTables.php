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
                    <!--Table-->
                    <div class="card-content">
                        <a class="btn btn-default btn-sm" data-toggle="modal" data-target="#addNewTable"
                            data-original-title style="float: left">Add New Table</a><br>
                        <br>
                        <table id="tablesTable" class="table table-striped table-bordered dt-responsive nowrap"
                            cellspacing="0" width="100%">
                            <thead>
                                <th><b class="pull-left">Table Code</b></th>
                                <th><b class="pull-left">Actions</b></th>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                        <!--Modals-->
                        <!--Modal for Add New Table-->
                        <div class="modal fade" id="addNewTable" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Add New Table</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="<?= site_url("admin/tables/add")?>" method="post" accept-charset="utf-8">
                                        <div class="modal-body">
                                            <!--Table Code-->
                                            <div class="row">
                                                <div class="col-md-6 form-group">
                                                    <div class="form-group label-floating">
                                                        <label for="tableCode">Table Code</label>
                                                        <input class="form-control" type="text" name="tableCode"
                                                            value="" required
                                                            title="Table Code should contain letters and numbers">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Add Table</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!--Modal for Edit Table-->
                        <div class="modal fade" id="editTable" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Table</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="<?= site_url("admin/tables/edit")?>" method="post" accept-charset="utf-8">
                                        <div class="modal-body">
                                            <!--Table Code-->
                                            <div class="row">
                                                <div class="col-md-6 form-group">
                                                    <div class="form-group label-floating">
                                                        <label for="tableCode">Table Code</label>
                                                        <input class="form-control" type="text" name="tableCode"
                                                            value="" required
                                                            title="Table Code should contain letters and numbers">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Edit Table</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!--Delete Confirmation Box-->
                        <div class="modal fade" id="deleteTable" tabindex="-1" data-backdrop="static"
                            data-keyboard="false" role="dialog" aria-labelledby="contactLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <form action="adminAccount/delete" method="post" accept-charset="utf-8">
                                            <div class="modal-body" style="padding: 5px;">
                                                <div class="row" style="text-align: center">
                                                    <br>
                                                    <h4 id="deleteTableCode"></h4>
                                                    <h4>Are you sure you want to delete this table?</h4>
                                                    <br>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="panel-footer" style="margin-bottom:-14px;" align="right">
                                    <input type="submit" class="btn btn-success" value="Yes" />
                                    <button type="button" class="btn btn-danger btn-close"
                                        onclick="document.getElementById('').click()" data-dismiss="modal">No</button>
                                </div>
                            </div>
                            <!-- <div class="panel-footer" style="margin-bottom:-14px;" align="right">
                            <input type="submit" class="btn btn-danger" value="Close" />
                            <input type="reset" class="btn btn-success" value="Update Account" />
                </div> -->
                        </div>
                    </div>
                </div>
                <?php
    $error = $this->session->flashdata('error');
    $success = $this->session->flashdata('success');
    if (!empty($error)) {
      ?>
                <div class="alert alert-danger" style="margin: 80px; text-align: center; ">
                    <strong><?php echo $error; ?></strong>
                </div>
                <?php } else if (!empty($success)) { ?>
                <div class="alert alert-success" style="margin: 80px; text-align: center; ">
                    <strong><?php echo $success; ?></strong>
                </div>
                <?php } ?>
                <!--End Confirmation Modal-->
            </div>
        </div>
    </div>
    <?php include_once('templates/scripts.php') ?>
</body>
<script>
var tables = [];
$(function() {
    $.ajax({
        url: "<?= site_url('admin/tables/getTables')?>",
        method: "get",
        dataType: "json",
        success: function(data) {
            tables = data;
            setTableData(tables);
        },
        error: function(response, setting, errorThrown) {
            console.log(response.responseText);
            console.log(errorThrown);
        }
    });
});

function setTableData(tables) {
    tables.forEach(table => {
        $("#tablesTable > tbody").append(`
        <tr data-id="${table.table_code}">
            <td>${table.table_code}</td>
            <td>
                <!--Action Buttons-->
                <div class="onoffswitch">
                    <!--Edit button-->
                    <button class="updateBtn btn btn-default btn-sm" data-toggle="modal"
                        data-target="#editTable">Edit</button>
                    <!--Delete button-->
                    <button class="deleteBtn btn btn-danger btn-sm" data-toggle="modal"
                        data-target="#deleteTable">Delete</button>
                </div>
            </td>
        </tr>`);
        $(".updateBtn").last().on('click', function() {
            $("input[name='tableCode']").val($(this).closest("tr").attr("data-id"));
        });
        $(".deleteBtn").last().on('click', function() {
            $("#deleteTableCode").text(`Delete table code ${$(this).closest("tr").attr("data-id")}`);
        });
    });
}
// $('table tbody tr  td').on('click', function() {
//     $("#myModal").modal("show");
//     $("#txtfname").val($(this).closest('tr').children()[0].textContent);
//     $("#txtlname").val($(this).closest('tr').children()[1].textContent);
// });
</script>

</html>
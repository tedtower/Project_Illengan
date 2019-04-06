<div class="main-panel">
    <div class="container-fluid"></div>
    <div class="navbar-header"></div>

    <div class="content">
        <div class="container-fluid">
            <!--Table-->
            <div class="card-content">
                <a class="btn btn-default btn-sm" data-toggle="modal" data-target="#addNewTable" data-original-title
                    style="float: left">Add New Table</a><br><br>
                <br><br>
                <table id="example" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
                    width="100%">
                    <thead>
                        <th><b class="pull-left">Table Code</b></th>
                        <th><b class="pull-left">Actions</b></th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <!--insert PHP echo e.g. "?php echo $row->code; ?>"-->
                            </td>
                            <td>
                                <!--Action Buttons-->
                                <div class="onoffswitch">
                                    <!--Edit button-->
                                    <button class="btn btn-default btn-sm" data-toggle="modal"
                                        data-target="">Edit</button>
                                    <!--Delete button-->
                                    <button class="btn btn-danger btn-sm" data-toggle="modal"
                                        data-target="">Delete</button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <!--Modals-->
                <!--Modal for Edit-->
                <div class="modal-body" style="padding: 5px;">
                    <!--Add Menu Item Modal-->
                    <!--Table Code-->
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <form action="" method="post" accept-charset="utf-8">
                                <div class="form-group label-floating">
                                    <label for="tableCode">Table Code</label>
                                    <input class="form-control" type="text" name="tableCode" value="" required
                                        pattern="[a-zA-Z][a-zA-Z\s][0-9]*" required
                                        title="Table Code shoule contain letters and numbers">
                                </div>
                            </form>
                        </div>
                    </div>
                    <!--Delete Button-->
                    <button type="button" class="close" data-dismiss="modal"
                        onclick="document.getElementById('').click()" aria-hidden="true">×</button>
                    <h4 class="panel-title" id="contactLabel">
                        <span class="glyphicon glyphicon-warning-sign"></span>
                        Delete
                    </h4>
                </div>
                <!--Delete Confirmation Box-->
                <div class="modal fade" id="deactivate" tabindex="-1" data-backdrop="static" data-keyboard="false"
                    role="dialog" aria-labelledby="contactLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <form action="adminAccount/delete" method="post" accept-charset="utf-8">
                                    <div class="modal-body" style="padding: 5px;">
                                        <div class="row" style="text-align: center">
                                            <br>
                                            <h4> Are you sure you want to delete this table?</h4>
                                            <br>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="panel-footer" style="margin-bottom:-14px;" align="right">
                            <input type="submit" class="btn btn-danger" value="Close" />
                            <input type="reset" class="btn btn-success" value="Update Account" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
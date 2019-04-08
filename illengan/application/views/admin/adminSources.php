<!doctype html>
<html lang="en">

<head>
    <?php include_once('templates/head.php') ?>
</head>

<body>
    <?php include_once('templates/sideNav.php') ?>
    <!--End Side Bar-->
    <div class="main-panel">
        <div class="container-fluid"></div>
        <div class="navbar-header"></div>

        <div class="content">
            <div class="container-fluid">
                <!--Table-->
                <div class="card-content">
                    <a class="btn btn-default btn-sm" data-toggle="modal" data-target="#addNewSource" data-original-title style="float: left">Add New Source</a><br><br>
                    <br><br>
                    <table id="sourcesTable" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                        <thead>
                            <th><b class="pull-left">Name</b></th>
                            <th><b class="pull-left">Contact Number</b></th>
                            <th><b class="pull-left">Email</b></th>
                            <th><b class="pull-left">Status</b></th>
                            <th><b class="pull-left">Actions</b></th>
                        </thead>
                        <tbody>
                            <!--Insert PHP-->
                            <tr>
                                <td>
                                    <!--insert PHP echo e.g. "?php echo $row->code; ?>"-->
                                </td>
                                <td>
                                    <!--insert PHP echo e.g. "?php echo $row->code; ?>"-->
                                </td>
                                <td>
                                    <!--insert PHP echo e.g. "?php echo $row->code; ?>"-->
                                </td>
                                <td>
                                    <!--insert PHP echo e.g. "?php echo $row->code; ?>"-->
                                </td>
                                <td>
                                    <!--Action Buttons-->
                                    <div class="onoffswitch">
                                        <!--Edit button-->
                                        <button class="btn btn-default btn-sm" data-toggle="modal" data-target="">Edit</button>
                                        <!--Delete button-->
                                        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="">Delete</button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <!--Modals-->
                    <!--Modal for Add || Edit-->
                    <div class="modal fade" id="newSources" tabindex="-1" role="dialog" aria-labelledby="contactLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h4 class="panel-title" id="contactLabel"><span class="glyphicon glyphicon-info-sign"></span>New Source</h4>
                                </div>
                                <form action="adminSources/insert" method="post" accept-charset="utf-8">
                                    <div class="modal-body" style="padding: 5px;">
                                        <!--Source Name-->
                                        <div class="row">
                                            <div class="col-md-12 form-group">
                                                <div class="form-group label-floating">
                                                    <label for="name">Name</label>
                                                    <input class="form-control" type="text" name="name" required pattern="[a-zA-Z][a-zA-Z\s]*" required title="Source name should only countain letters" required>
                                                </div>
                                            </div>
                                        </div>
                                        <!--Contact Number-->
                                        <div class="row">
                                            <div class="col-md-12 form-group">
                                                <div class="form-group label-floating">
                                                    <label for="contactNum">Contact Number</label>
                                                    <input name="contactNum" class="form-control" type="number" value="" id="example-number-input" min="0" oninput="validity.valid||(value='');" data-validate="required" max="" required>
                                                </div>
                                            </div>
                                        </div>
                                        <!--Email Address-->
                                        <div class="row">
                                            <div class="col-md-12 form-group">
                                                <div class="form-group label-floating">
                                                    <label for="sourceEmail">Email</label>
                                                    <input name="sourceEmail" class="form-control" type="textarea" value="" id="example-number-input" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required title="You have entered an invalid e-mail address. Try again.">
                                                </div>
                                            </div>
                                        </div>
                                        <!--Status-->
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <div class="form-group label-floating">
                                                    <label for="status">Status</label>
                                                    <select class="form-control" type="text" name="status" required pattern="[a-zA-Z][a-zA-Z\s]*" required title="Status should only countain letters" required>
                                                        <option value="active">Active</option>
                                                        <option value="inactive">Inactive</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-footer" style="margin-bottom:-14px;" align="right">
                                        <input type="submit" class="btn btn-success" value="Save" />
                                        <!--<span class="glyphicon glyphicon-ok"></span>-->
                                        <input type="reset" class="btn btn-danger" value="Clear" />
                                        <!--<span class="glyphicon glyphicon-remove"></span>-->
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--Modal for Delete Confirmation-->
                    <div class="modal fade" id="delete" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="deleteLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <!--Close Button-->
                                    <button type="button" class="close" data-dismiss="modal" onclick="document.getElementById('').click()" aria-hidden="true">×</button>
                                    <h4 class="panel-title" id="deleteLabel"><span class="glyphicon glyphicon-warning-sign"></span> Warning
                                    </h4>
                                </div>
                                <form action="adminSources/delete" method="post" accept-charset="utf-8">
                                    <div class="modal-body" style="padding: 5px;">
                                        <div class="row" style="text-align: center">
                                            <br>
                                            <h4> Are you sure you want to 'delete' this source?</h4>
                                            <br>
                                        </div>
                                    </div>
                                    <div class="panel-footer" style="margin-bottom:-14px;">
                                        <input type="submit" class="btn btn-success" value="Yes" />
                                        <button type="button" class="btn btn-danger btn-close" onclick="document.getElementById('').click()" data-dismiss="modal">No</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--End Confirmation Modal-->
                </div>
            </div>
        </div>
    </div>
    <?php include_once('templates/scripts.php') ?>
</body>

</html>
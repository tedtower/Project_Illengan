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
            <!--Search
        <div id ="example_filter" class="dataTables_filter">
            <label>
                "Search:"
                <div class="form-group form-group-sm is-empty">
                   <input type="search" class="form-control" placeholder aria-controls="example">
                   <span class="material-input"></span> 
                </div>
            </label>
        </div>-->
            <!--Nav Tabs-->
            <div class="main-panel">
                <div class="content" style="margin-top: 5px;">
                    <div class="container-fluid">
                        <div class="card">
                            <div class="content">
                                <div class="container-fluid">
                                    <div class="card-header" data-background-color="brown">
                                        <div class="nav-tabs-navigation">
                                            <div class="nav-tabs-wrapper">
                                                <ul class="nav nav-tabs" data-tabs="tabs" data-background-color="brown">
                                                    <li>
                                                        <a href="adminTransactions.html">
                                                            Purchase Orders
                                                            <div class="ripple-container"></div>
                                                        </a>
                                                    </li>
                                                    <span></span>
                                                    <li class="active">
                                                        <a href="adminAllTransactions.html">
                                                            Transactions
                                                            <div class="ripple-container"></div>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="content">
                                <div class="container-fluid">
                                    <!--Table-->
                                    <div class="card-content">
                                        <a class="btn btn-default btn-sm" data-toggle="modal"
                                            data-target="#newTransaction" data-original-title style="float: left">Add
                                            Transaction</a>
                                        <!--Search
                            <div id ="example_filter" class="dataTables_filter">
                                <label>
                                    "Search:"
                                    <div class="form-group form-group-sm is-empty">
                                       <input type="search" class="form-control" placeholder aria-controls="example">
                                       <span class="material-input"></span> 
                                    </div>
                                </label>
                            </div>-->
                                        <br><br>
                                        <table id="example"
                                            class="table table-striped table-bordered dt-responsive nowrap"
                                            cellspacing="0" width="100%">
                                            <thead>
                                                <th><b class="pull-left">Receipt No.</b></th>
                                                <th><b class="pull-left">Supplier Name</b></th>
                                                <th><b class="pull-left">Total</b></th>
                                                <th><b class="pull-left">Date</b></th>
                                                <th><b class="pull-left">Actions</b></th>
                                            </thead>
                                            <tbody>
                                                <!--Insert PHP-->
                                                <tr>
                                                    <td>
                                                        <!--insert PHP echo (e.g. "?php echo $row->code; ?>-->
                                                    </td>
                                                    <td>
                                                        <!--insert PHP echo (e.g. "?php echo $row->code; ?>-->
                                                    </td>
                                                    <td>
                                                        <!--insert PHP echo (e.g. "?php echo $row->code; ?>-->
                                                    </td>
                                                    <td>
                                                        <!--insert PHP echo (e.g. "?php echo $row->code; ?>-->
                                                    </td>
                                                    <td>
                                                        <div class="onoffswitch">
                                                            <!--View button-->
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
                                    </div>
                                    <!--End Table Content-->
                                    <!--Modal-->
                                    <!--Add Menu Item Modal-->
                                    <div class="row">
                                        <div class="col-md-12 form-group">
                                            <div class="form-group label-floating">
                                                <label for="email">Receipt Number</label>
                                                <input class="form-control" type="text" name="receiptNumber" value=""
                                                    required pattern="[a-zA-Z][a-zA-Z\s][0-9]*" required
                                                    title="Receipt number should contain letters and numbers">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 form-group">
                                            <div class="form-group label-floating">
                                                <label for="supplier">Supplier Name</label>
                                                <input class="form-control" type="text" name="supplierName" value=""
                                                    required pattern="[a-zA-Z][a-zA-Z\s]*" required
                                                    title="Supplier name should only contain letters">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 form-group">
                                            <div class="form-group label-floating">
                                                <label for="description">Remarks</label>
                                                <input class="form-control" type="text" name="remarks" value="" required
                                                    pattern="[a-zA-Z][a-zA-Z\s]*" required
                                                    title="Remarks should only countain letters">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-footer" style="margin-bottom:-14px;" align="right">
                                        <input type="submit" class="btn btn-danger" value="Close" />
                                        <input type="reset" class="btn btn-success" value="Add New Transaction" />
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
    <?php include_once('templates/scripts.php') ?>
</body>

</html>
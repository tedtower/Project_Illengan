<!doctype html>
<html lang="en">

<head>
    <?php include_once('templates/head.php') ?>
    <title>Il-Lengan | Admin Menu Spoilages</title>
</head>

<body>
    <?php include_once('templates/sideNav.php') ?>
    <!--End Side Bar-->
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
                                                <li class="active">
                                                    <a href="adminSpoilages.html">
                                                        All Spoilages
                                                        <div class="ripple-container"></div>
                                                    </a>
                                                </li> 
                                                <span></span>
                                                <li>
                                                    <a href="adminMenuSpoilages.html">
                                                        Menu Spoilages
                                                        <div class="ripple-container"></div>
                                                    </a>
                                                </li>
                                                <span></span>
                                                <li>
                                                    <a href="adminStocksSpoilages.html">
                                                        Stocks Spoilages
                                                        <div class="ripple-container"></div>
                                                    </a>
                                                </li>
                                                <span></span>
                                                <li>
                                                    <a href="adminAddOnsSpoilages.html">
                                                        Add Ons Spoilages
                                                        <div class="ripple-container"></div>
                                                    </a>
                                                </li>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                <div class="content">
                    <div class="container-fluid">
                        <!--Table-->
                        <div class="card-content">
                            <a class="btn btn-default btn-sm" data-toggle="modal" data-target="#newMenuSpoilage"
                                data-original-title style="float: left">Add Menu Spoilage</a>
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
                            <table id="example" class="table table-striped table-bordered dt-responsive nowrap"
                                cellspacing="0" width="100%">
                                <thead>
                                    <th><b class="pull-left">Code</b></th>
                                    <th><b class="pull-left">Description</b></th>
                                    <th><b class="pull-left">Quantity</b></th>
                                    <th><b class="pull-left">Damage Date</b></th>
                                    <th><b class="pull-left">Date Recorder</b></th>
                                    <th><b class="pull-left">Remarks</b></th>
                                    <th><b class="pull-left">Operations</b></th>
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
                                            <!--insert PHP echo (e.g. "?php echo $row->code; ?>-->
                                        </td>
                                        <td>
                                            <!--insert PHP echo (e.g. "?php echo $row->code; ?>-->
                                        </td>
                                        <td>
                                            <div class="onoffswitch">
                                                <!--
                                                        <?php if ($row->menu_activation ==1):?>
                                                    -->
                                                <!--Delete button-->
                                                <button class="btn btn-danger btn-sm" data-toggle="modal"
                                                    data-target="">Delete</button>
                                            </div>
                                        </td>
                        </div>
                        </td>
                        <!--End Table Content-->
                        <!--Modal for Activation/Deactivation-->
                        <div class="modal fade" id="deactivate" tabindex="-1" data-backdrop="static"
                            data-keyboard="false" role="dialog" aria-labelledby="contactLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="panel panel-primary">
                                    <!--<div class="panel-heading">
                                        //Close Button
                                        <button type="button" class="close" data-dismiss="modal"
                                            onclick="document.getElementById('').click()" aria-hidden="true">×</button>
                                        <h4 class="panel-title" id="contactLabel"><span
                                                class="glyphicon glyphicon-warning-sign"></span> Activation/Deactivation
                                        </h4>
                                    </div>-->
                                    <form action="adminMenuItems/activation" method="post" accept-charset="utf-8">
                                        <div class="modal-body" style="padding: 5px;">
                                            <div class="row" style="text-align: center">
                                                <br>
                                                <h4> Are you sure you want to 'deactivate' : 'activate'?> this menu
                                                    spoilage?</h4>
                                                <br>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 form-group">
                                                    <div class="form-group label-floating">
                                                        <input class="form-control" type="hidden" name="deact_id"
                                                            value="" required>
                                                    </div>
                                                    <div class="form-group label-floating">
                                                        <input class="form-control" type="hidden" name="name" value=""
                                                            required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel-footer" style="margin-bottom:-14px;">
                                            <input type="submit" class="btn btn-success" value="Yes" />
                                            <button type="button" class="btn btn-danger btn-close"
                                                onclick="document.getElementById('').click()"
                                                data-dismiss="modal">No</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="" tabindex="-1" role="dialog" aria-labelledby="contactLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-hidden="true">×</button>
                                        <h4 class="panel-title" id="contactLabel"><span
                                                class="glyphicon glyphicon-info-sign"></span> Update Menu Spoilage </h4>
                                    </div>
                                    <form action="" method="post" accept-charset="utf-8">
                                        <div class="modal-body" style="padding: 5px;">
                                            <!--Add New Menu Spoilage Modal-->
                                            <div class="row">
                                                <div class="col-md-12 form-group">
                                                    <div class="form-group label-floating">
                                                        <label for="email">Menu Name</label>
                                                        <input class="form-control" type="text" name="name" value=""
                                                            required pattern="[a-zA-Z][a-zA-Z\s]*" required
                                                            title="Menu name should only countain letters">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 form-group">
                                                    <div class="form-group label-floating">

                                                        <input class="form-control" type="hidden" name="" value=""
                                                            required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 form-group">
                                                    <div class="form-group label-floating">
                                                        <label for="type">Category</label>
                                                        <select class="form-control" name="" type="textarea" value=""
                                                            id="example-number-input" required
                                                            pattern="[a-zA-Z][a-zA-Z\s]*" required
                                                            title="Category hould only countain letters">
                                                            <option disabled selected value></option>
                                                            <!--Insert PHP-->
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 form-group">
                                                    <div class="form-group label-floating">
                                                        <label for="email">Status</label>
                                                        <input class="form-control" value="" type="number" name="status"
                                                            min="0" oninput="validity.valid||(value='');"
                                                            data-validate="required" max="" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 form-group">
                                                    <div class="form-group label-floating">
                                                        <label for="uploadImage">Upload Image</label>
                                                        <select class="form-control" name="sup_company" required>
                                                            <option disabled selected value></option>
                                                            <!--Insert PHP-->
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12 form-group">
                                                        <div class="form-group label-floating">
                                                            <label for="description">Description</label>
                                                            <input class="form-control" type="text" name="description"
                                                                value="" required pattern="[a-zA-Z][a-zA-Z\s]*" required
                                                                title="Description should only countain letters">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 form-group">
                                                    <div class="form-group label-floating">
                                                        <label for="type">Sizeable</label>
                                                        <select class="form-control" name="" type="textarea" value=""
                                                            id="example-number-input" required
                                                            pattern="[a-zA-Z][a-zA-Z\s]*" required
                                                            title="Category hould only countain letters">
                                                            <option disabled selected value></option>
                                                            <!--Insert PHP-->
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 form-group">
                                                <div class="form-group label-floating">
                                                    <label for="email">Price</label>
                                                    <input class="form-control" type="number" name="price" min="0"
                                                        oninput="validity.valid||(value='');" data-validate="required"
                                                        max="" required>
                                                </div>
                                            </div>

                                            <div class="panel-footer" style="margin-bottom:-14px;" align="right">
                                                <input type="submit" class="btn btn-danger" value="Close" />
                                                <input type="reset" class="btn btn-success" value="Add Menu Item" />
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


    </body>

    <!--   Core JS Files   -->
    <script src="assets/js/admin/jquery.3.2.1.min.js" type="text/javascript"></script>
    <script src="assets/js/admin/bootstrap.min.js" type="text/javascript"></script>
    <!--  Charts Plugin -->
    <script src="assets/js/admin/chartist.min.js"></script>
    <!--  Notifications Plugin    -->
    <script src="assets/js/admin/bootstrap-notify.js"></script>
    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
    <script src="assets/js/admin/light-bootstrap-dashboard.js?v=1.4.0"></script>
    <!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
    <script src="assets/js/admin/demo.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#example').DataTable({
                "dom": ' fBrtip',
                "lengthChange": false,
                "info": true,
                buttons: [


                    {
                        "extend": 'excel', "text": '<i class="fa fa-file-excel-o"></i> CSV', "className": 'btn btn-success btn-xs',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5]
                        }
                    },

                    "extend": 'pdf',
                    "text": '<i class="fa fa-file-pdf-o"></i> PDF',
                    "className": 'btn btn-danger btn-xs',
                    "orientation": 'portrait',
                    "title": 'Il-Lengan Inventory',
                    "download": 'open',

                    "messageBottom": "\n \n \n \n \n Prepared by:  <?php echo $object->u_fname  . ' ' . $object->u_lname; ?>",
                    styles: {
                        "messageBottom": {
                            bold: true,
                            fontSize: 15
                        }
                    },
                    "exportOptions": {
                        columns: [0, 1, 2, 3, 4, 5],

                    },

                    "header": true,
                    customize: function (doc) {
                        var now = new Date();
                        var jsDate = now.getDate() + '-' + (now.getMonth() + 1) + '-' + now.getFullYear();
                        var logo = 'data:assets/img/logo.png';
                        doc.content.splice(0, 1, {
                            text: [{
                                text: 'Il-Lengan Cafe.\n',
                                bold: true,
                                fontSize: 15
                            }, {
                                text: ' \n',
                                bold: true,
                                fontSize: 11
                            }, {
                                text: '',
                                bold: true,
                                fontSize: 11
                            }],
                            margin: [0, 0, 0, 20],
                            alignment: 'center',
                            image: logo
                        });
                        doc.content[1].table.widths = ['14%', '14%', '20%', '24%', '14%', '14%'];
                        doc.pageMargins = [40, 40, 40, 40];
                        doc['footer'] = (function (page, pages) {
                            return {
                                columns: [
                                    {
                                        alignment: 'left',
                                        text: ['Date Downloaded: ', { text: jsDate.toString() }]
                                    },
                                    {
                                        alignment: 'right',
                                        text: ['page ', { text: page.toString() }, ' of ', { text: pages.toString() }]
                                    }
                                ],
                                margin: 20
                            }
                        });
                    }

                }
            ]
        });
    });
        $('table tbody tr  td').on('click', function () {
            $("#myModal").modal("show");
            $("#txtfname").val($(this).closest('tr').children()[0].textContent);
            $("#txtlname").val($(this).closest('tr').children()[1].textContent);
        });
    </script>

</html>
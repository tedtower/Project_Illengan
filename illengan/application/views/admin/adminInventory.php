<!doctype html>
<html lang="en">

<head>
    <?php include_once('templates/head.php') ?>
</head>

<body>
    <?php include_once('templates/sideNav.php') ?>
    
    <div class="content">
        <div class="container-fluid">
            <br>
            <p style="text-align:right; font-weight: regular; font-size: 16px">
                <!-- Real Time Date & Time -->
                <?php echo date("M j, Y -l"); ?>
            </p>
            <div class="content" style="margin-left:250px;">
                <div class="container-fluid">
                    <div class="content">
                        <div class="container-fluid">
                            <!--Table-->
                            <div class="card-content">
                                <a class="btn btn-default btn-sm" data-toggle="modal" data-target="#newStock"
                                    data-original-title style="float:left">Add Stock Item</a>
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
                                <th><b class="pull-left">Name</b></th>
                                <th><b class="pull-left">Quantity</b></th>
                                <th><b class="pull-left">Unit</b></th>
                                <th><b class="pull-left">Minimum</b></th>
                                <th><b class="pull-left">Category</b></th>
                                <th><b class="pull-left">Status</b></th>
                                <th><b class="pull-left">Action</b></th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Strawberry Syrup</td>
                                    <td>5</td>
                                    <td>bottle</td>
                                    <td>2</td>
                                    <td>Drinks</td>
                                    <td>Available</td>
                                    <td>
                                        <button class="btn btn-primary btn-sm" data-toggle="modal"
                                            data-target="#editStock">Edit</button>
                                        <!--Delete button-->
                                        <button class="btn btn-danger btn-sm" data-toggle="modal"
                                            data-target="">Delete</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

<!--Start of Modal "Add Stock Item"-->
<div class="modal fade" id="newStock" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Add Stock Item</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="<?php echo base_url()?>admin/inventory/add" method="get"
                                                accept-charset="utf-8">
                                                <div class="modal-body">
                                                    <!--Source Name-->
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                            Name</span>
                                                        </div>
                                                        <input type="text" name="stock_name" id="stock_name" class="form-control form-control-sm">
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                            Qty</span>
                                                        </div>
                                                        <input type="number" name="stock_quantity" id="stock_quantity" class="form-control form-control-sm">
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                            Unit</span>
                                                        </div>
                                                        <input type="text" name="stock_unit" id="stock_unit" class="form-control form-control-sm">
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                            Minimum</span>
                                                        </div>
                                                        <input type="number" name="stock_minimum" id="stock_minimum" class="form-control form-control-sm">
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                            Category</span>
                                                        </div>
                                                        <select class="custom-select" name="category_name" id="category_name">
                                                            <option selected>Choose</option>
                                                            <option></option>
                                                        </select>
                                                    </div>                                               
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger btn-sm"
                                                            data-dismiss="modal">Cancel</button>
                                                        <button class="btn btn-success btn-sm"
                                                            type="submit">Insert</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
<!--End of Modal "Add Stock Item"-->

<!--Start of Modal "Edit Stock Item"-->
<div class="modal fade" id="editStock" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Stock Item</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="<?php echo base_url()?>admin/inventory/edit" method="get"
                                                accept-charset="utf-8">
                                                <div class="modal-body">
                                                    <!--Source Name-->
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                            Name</span>
                                                        </div>
                                                        <input type="text" name="stock_name" id="stock_name" class="form-control form-control-sm">
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                            Qty</span>
                                                        </div>
                                                        <input type="number" name="stock_quantity" id="stock_quantity" class="form-control form-control-sm">
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                            Unit</span>
                                                        </div>
                                                        <input type="text" name="stock_unit" id="stock_unit" class="form-control form-control-sm">
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                            Minimum</span>
                                                        </div>
                                                        <input type="number" name="stock_minimum" id="stock_minimum" class="form-control form-control-sm">
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                            Category</span>
                                                        </div>
                                                        <select class="custom-select" name="category_name" id="category_name">
                                                            <option selected>Choose</option>
                                                            <option></option>
                                                        </select>
                                                    </div> 
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                            Status</span>
                                                        </div>
                                                        <select class="custom-select" name="category_name" id="category_name">
                                                            <option selected>Available</option>
                                                            <option>Temporary Unavailable</option>
                                                            <option>Unavailable</option>
                                                        </select>
                                                    </div>                                               
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger btn-sm"
                                                            data-dismiss="modal">Cancel</button>
                                                        <button class="btn btn-success btn-sm"
                                                            type="submit">Insert</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
<!--End of Modal "Edit Stock Item"-->
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
                        "extend": 'excel',
                        "text": '<i class="fa fa-file-excel-o"></i> CSV',
                        "className": 'btn btn-success btn-xs',
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

                    "messageBottom":
                    "\n \n \n \n \n Prepared by:  <?php echo $object->u_fname  . ' ' . $object->u_lname; ?>",
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
                        var jsDate = now.getDate() + '-' + (now.getMonth() + 1) + '-' + now
                            .getFullYear();
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
                                columns: [{
                                        alignment: 'left',
                                        text: ['Date Downloaded: ', {
                                            text: jsDate.toString()
                                        }]
                                    },
                                    {
                                        alignment: 'right',
                                        text: ['page ', {
                                            text: page.toString()
                                        }, ' of ', {
                                            text: pages.toString()
                                        }]
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
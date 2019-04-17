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
                    <div class="content">
                        <div class="container-fluid">
                            <!--Table-->
                            <div class="card-content">

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
                                <!--Add Add Ons Spoilage-->
                                <a class="btn btn-default btn-sm" data-toggle="modal" data-target="#addNewSource" data-original-title style="margin:0;">Add New Source</a><br>

                                <br>
                                <table id="tablevalues" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                    <thead>
                                        <th><b class="pull-left">Name</b></th>
                                        <th><b class="pull-left">Contact Number</b></th>
                                        <th><b class="pull-left">Email</b></th>
                                        <th><b class="pull-left">Status</b></th>
                                        <th><b class="pull-left">Actions</b></th>
                                    </thead>
                                    <tbody>
                                        <?php if (isset($source)) {
                                            foreach ($source as $item) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $item['source_name'] ?></td>
                                                    <td><?php echo $item['contact_num'] ?></td>
                                                    <td><?php echo $item['email'] ?></td>
                                                    <td><?php echo $item['status'] ?></td>
                                                    <td>
                                                        <div>
                                                            <a data-toggle="modal" data-target="#editSource" data-original-title style="float: left" name="editSource" data-id="<?php echo $item['source_id'] ?>" class="btn btn-primary btn-sm mb-2">Edit</a>

                                                            <a href="#" class="delete_data" id="<?php echo $item['source_id']; ?>"><button class="btn btn-danger btn-sm mb-2">Delete</button></a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php

                                        }
                                    } else {
                                        echo 'no data';
                                    }
                                    ?>
                                    </tbody>
                                </table>
                                <!--End Table Content-->

                                <!-- Start of "Add Sources" Modal-->
                                <div class="modal fade bd-example-modal-lg" id="addNewSource" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Add New Source</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form id="formAdd" action="<?= site_url('admin/sources/add') ?>" method="post" accept-charset="utf-8">
                                                <div class="modal-body">
                                                    <div class="form-row">
                                                        <!--Container of Source Date-->
                                                        <!--Source Name-->
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                    Name</span>
                                                            </div>
                                                            <input type="text" name="sourceName" id="sourceName" class="form-control form-control-sm">
                                                        </div>
                                                        <!--Contact Number-->
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                    Contact Num</span>
                                                            </div>
                                                            <input type="number" name="contact_num" id="sourceName" class="form-control form-control-sm">
                                                        </div>
                                                        <!--Email Address-->
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                    Email</span>
                                                            </div>
                                                            <input type="text_area" name="email" id="email" class="form-control form-control-sm">
                                                        </div>
                                                        <!--Status-->
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                    Status</span>
                                                                <select class="form-control" type="text" name="new_status" id="new_status" required pattern="[a-zA-Z][a-zA-Z\s]*" required title="Status should only countain letters" required>
                                                                    <option value="active" Selected>Active</option>
                                                                    <option value="inactive">Inactive</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
                                                            <button class="btn btn-success btn-sm" type="submit">Add</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!--End Modal "Add Source"-->

                                <!-- Edit Modal "Add Source-->
                                <div class="modal fade bd-example-modal-lg" id="editSource" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit New Source</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form id="formEdit" action="<?= site_url('admin/sources/edit') ?>" method="post" accept-charset="utf-8">
                                                <div class="modal-body">
                                                    <div class="form-row">
                                                        <!--Container of Source Date-->
                                                        <!--Source Name-->
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                    Name</span>
                                                            </div>
                                                            <input type="text" name="sourceName" id="sourceName" class="form-control form-control-sm">
                                                        </div>
                                                        <!--Contact Number-->
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                    Contact Num</span>
                                                            </div>
                                                            <input type="number" name="contact_num" id="sourceName" class="form-control form-control-sm">
                                                        </div>
                                                        <!--Email Address-->
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                    Email</span>
                                                            </div>
                                                            <input type="text_area" name="email" id="email" class="form-control form-control-sm">
                                                        </div>
                                                        <!--Status-->
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                    Status</span>
                                                                <select class="form-control" type="text" name="new_status" id="new_status" required pattern="[a-zA-Z][a-zA-Z\s]*" required title="Status should only countain letters" required>
                                                                    <option value="active" Selected>Active</option>
                                                                    <option value="inactive">Inactive</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
                                                            <button class="btn btn-success btn-sm" type="submit">Update</button>
                                                        </div>
                                                    </div>
                                </div>
                                            </form>
                                    </div>
                                </div>
                            </div>
                            <!--End Modal-->

        <?php include_once('templates/scripts.php') ?>

        <script>
            $(document).ready(function() {
                $('.delete_data').click(function() {
                    var id = $(this).attr("id");
                    if (confirm("Are you sure you want to delete this?")) {
                        window.location = "<?php echo base_url(); ?>admin/sources/delete/" + id;
                    } else {
                        return false;
                    }
                });
            });

            var tuples = ((document.getElementById('tablevalues')).getElementsByTagName('tbody'))[0].getElementsByTagName(
                'tr');
            var tupleNo = tuples.length;
            var editButtons = document.getElementsByName('editSource');
            var editModal = document.getElementById('editSource');
            for (var x = 0; x < tupleNo; x++) {
                editButtons[x].addEventListener("click", showEditModal);
            }

            function showEditModal(event) {
                var row = event.target.parentElement.parentElement.parentElement;
                document.getElementById('new_name').value = row.firstElementChild.innerHTML;
                document.getElementById('new_contact').value = row.firstElementChild.nextElementSibling.innerHTML;
                document.getElementById('new_email').value = row.firstElementChild.nextElementSibling.nextElementSibling
                    .innerHTML;
                document.getElementById('new_status').value = row.firstElementChild.nextElementSibling.nextElementSibling
                    .nextElementSibling.innerHTML;
                document.getElementById('source_id').value = event.target.getAttribute('data-id');
            }
        </script>
</body>

</html>
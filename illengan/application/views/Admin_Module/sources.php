<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url('application/css/frameworks/bootstrap.min.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('application/others/fonts/circular-std/style.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('application/css/admin/style.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('application/others/fonts/fontawesome/css/fontawesome-all.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('application/others/charts/chartist-bundle/chartist.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('application/others/charts/morris-bundle/morris.css')?>">
    <link rel="stylesheet"
        href="<?php echo base_url('application/others/material-design-iconic-font/css/materialdesignicons.min.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('application/others/charts/c3charts/c3.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('application/others/fonts/flag-icon-css/flag-icon.min.css')?>">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <title>Il-Lengan</title>
</head>

<body>
    <div class="dashboard-main-wrapper">
        <!--Navigation Bar-->
        <div class="dashboard-header">
            <nav class="navbar navbar-expand-lg bg-white fixed-top">
                <a class="navbar-brand" href="dashboard.html">Il-Lengan</a>
                <div class="collapse navbar-collapse " id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto navbar-right-top">

                        <li class="nav-item dropdown nav-user">
                            <a class="nav-link nav-user-img" href="#" id="navbarDropdownMenuLink2"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img
                                    src="assets/images/avatar-1.jpg" alt="" class="user-avatar-md rounded-circle"></a>
                            <div class="dropdown-menu dropdown-menu-right nav-user-dropdown"
                                aria-labelledby="navbarDropdownMenuLink2">
                                <div class="nav-user-info">
                                    <h5 class="mb-0 text-white nav-user-name">John Abraham </h5>
                                    <span class="status"></span><span class="ml-2">Available</span>
                                </div>
                                <a class="dropdown-item" href="#"><i class="fas fa-cog mr-2"></i>Setting</a>
                                <a class="dropdown-item" href="#"><i class="fas fa-power-off mr-2"></i>Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <!-- ============================================================== -->
        <!-- left sidebar -->
        <!-- ============================================================== -->
        <div class="nav-left-sidebar dark-sidebar">
            <div class="menu-list">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="d-xl-none d-lg-none" href="dashboard.html">Dashboard</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav flex-column"><br>

                            <li class="nav-item">
                                <a class="nav-item" href="<?php echo site_url('admin/dashboard')?>"><i
                                        class="fa fa-fw fa-user-circle"></i>Dashboard</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-item" href="<?php echo site_url('admin/menu')?>"><i class=""></i>Menu
                                    Items</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-item" href="<?php echo site_url('admin/sales')?>"><i
                                        class=""></i>Sales</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-item" href="<?php echo site_url('admin/inventory')?>"><i
                                        class=""></i>Inventory</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-item" href="<?php echo site_url('admin/tables')?>"><i
                                        class=""></i>Tables</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-item" href="<?php echo site_url('')?>"><i class=""></i>Reports</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-item" href="<?php echo site_url('admin/accounts')?>"><i
                                        class=""></i>Accounts</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-item" href="<?php echo site_url('admin/sources')?>"><i
                                        class=""></i>Sources</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end left sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- wrapper  -->
        <!-- ============================================================== -->

        <div class="dashboard-wrapper">
            <div class="dashboard-ecommerce">
                <!--Billings-->
                <div class="container-fluid dashboard-content ">

                    <div id="addModal">
                        <div>
                            <h3>Add Source</h3>
                        </div>
                        <div>
                            <form method="post" action="<?php echo base_url()?>index.php/admin/add_source"
                                style="width:40%;margin-bottom:3%;">
                                <div class="form-group">
                                    <label>Source Name</label>
                                    <input class="form-control" type="text" name="source_name" />
                                    <span class="text-danger"><?php echo form_error("source_name"); ?></span>
                                </div>

                                <div class="form-group">
                                    <label>Contact Number</label>
                                    <input class="form-control" type="text" name="contact_num" />
                                    <span class="text-danger"><?php echo form_error("contact_num"); ?></span>
                                </div>

                                <div>
                                    <input class="btn btn-info btn-xs mb-2" type="submit" name="insert"
                                        value="Insert" />
                                </div>
                            </form>
                        </div>
                    </div>

                    <div id="editModal">
                        <div>
                            <h3>Edit Source</h3>
                        </div>
                        <div>
                            <form method="get" action="<?php echo base_url()?>index.php/admin/edit_source/"
                                style="width:40%;margin-bottom:3%;">
                                <input type="hidden" name="source_id" id="source_id" value="" />
                                <div class="form-group">
                                    <label>Source Name</label>
                                    <input type="text" name="new_name" id="new_name" value="" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label>Contact Number</label>
                                    <input type="text" name="new_num" id="new_num" value="" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control" name="new_status" id="new_status" >
                                        <option value="active" selected="selected">Active
                                        </option>
                                        <option value="inactive">Inactive
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-info btn-xs mb-2" />
                                </div>
                            </form>
                        </div>
                    </div>


                    <div class="table-responsive">
                        <table class="table" id='tablevalues'>
                            <thead class="bg-light">
                                <tr class="d-flex">
                                    <th class="col-4">Source</th>
                                    <th class="col-3">Contact Number</th>
                                    <th class="col-3">Status</th>
                                    <th class="col-2" style="text-align:center;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                        if(isset($source)){
                        foreach($source as $item){   
                    ?>
                                <tr class="d-flex">
                                    <td class="col-4"><?php echo $item['source_name']?></td>
                                    <td class="col-3"><?php echo $item['contact_num']?></td>
                                    <td class="col-3"><?php echo $item['status']?></td>
                                    <td class="col-2">
                                        <div style="width:70%; margin:auto;">
                                            <button name="editSource" data-id="<?php echo $item['source_id']?>"
                                                class="btn btn-primary btn-xs mb-2">Edit</button>
                                            <a href="#" class="delete_data"
                                                id="<?php echo $item['source_id'];?>"><button
                                                    class="btn btn-danger btn-xs mb-2">Delete</button></a>
                                        </div>
                                    </td>
                                </tr>
                                <?php 
                            
                        }
                        }else{
                            echo 'no data';
                    }
                        ?>
                            </tbody>
                        </table>
                    </div>


                </div>
            </div>
            <!-- ============================================================== -->
            <!-- end wrapper  -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- end main wrapper  -->
        <!-- ============================================================== -->
        <!-- Optional JavaScript -->
        <!-- jquery 3.3.1 -->
        <script>
        $(document).ready(function() {
            $('.delete_data').click(function() {
                var id = $(this).attr("id");
                if (confirm("Are you sure you want to delete this?")) {
                    window.location = "<?php echo base_url(); ?>index.php/admin/delete_data/" + id;
                } else {
                    return false;
                }
            });
        });
        </script>
        <script>
        var tuples = ((document.getElementById('tablevalues')).getElementsByTagName('tbody'))[0].getElementsByTagName(
            'tr');
        var tupleNo = tuples.length;
        var editButtons = document.getElementsByName('editSource');
        var editModal = document.getElementById('editModal');
        for (var x = 0; x < tupleNo; x++) {
            editButtons[x].addEventListener("click", showEditModal);
        }

        function showEditModal(event) {
            var row = event.target.parentElement.parentElement.parentElement;
            document.getElementById('new_name').value = row.firstElementChild.innerHTML;
            document.getElementById('new_num').value = row.firstElementChild.nextElementSibling.innerHTML;
            document.getElementById('new_status').value = row.firstElementChild.nextElementSibling.nextElementSibling
                .innerHTML;
            document.getElementById('source_id').value = event.target.getAttribute('data-id');
        }
        </script>
        <script src="application/js/frameworks/jquery-3.3.1.min.js"></script>
        <!-- bootstap bundle js -->
        <script src="application/js/frameworks/bootstrap.bundle.js"></script>
        <!-- main js -->
        <script src="application/js/admin/main-js.js"></script>
        <!-- chart chartist js -->
        <script src="application/others/charts/chartist-bundle/chartist.min.js"></script>
        <!-- chart c3 js -->
        <script src="application/others/charts/c3charts/c3.min.js"></script>
        <script src="application/others/charts/c3charts/d3-5.4.0.min.js"></script>
        <script src="application/others/charts/c3charts/C3chartjs.js"></script>
        <script src="application/js/admin/dashboard.js"></script>
</body>

</html>
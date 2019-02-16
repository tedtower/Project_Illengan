<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width= device-width, initial-scale= 1 shrink-to-fit= no">
    <link rel="icon" type="image/ico" href="images/favicon.ico">
    <link rel="stylesheet" type="text/css" href="../../css/admin/styles.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url('application/css/frameworks/bootstrap.min.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('application/others/fonts/circular-std/style.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('application/css/admin/style.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('application/others/fonts/fontawesome/css/fontawesome-all.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('application/others/fonts/material-design-iconic-font/css/materialdesignicons.min.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('application/others/fonts/flag-icon-css/flag-icon.min.css')?>">
    <title>Il-Lengan</title>
</head>

<body>
    <div class="dashboard-main-wrapper">
        <!-- Navigation Bar -->
        <div class="dashboard-header">
            <nav class="navbar navbar-expand-lg">
                <a class="navbar-logo" href="dashboard.html">Il-Lengan</a>
            </nav>
        </div>
    </div>

    <!-- Left Sidebar-->
    <div class="nav-left-sidebar dark-sidebar">
        <div class="menu-list">
            <nav class="navbar navbar-expand-lg navbar-light">
                <a class="d-xl-none d-lg-none" href="dashboard.html">Dashboard</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>  
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav flex-column"><br>
                        
                        <li class="nav-item">
                            <a class="nav-item" href="<?php echo site_url('admin/dashboard')?>"><i class="fa fa-fw fa-user-circle"></i>Dashboard</a>
                        </li>

                        <li class="nav-item">
                                <a class="nav-item" href="<?php echo site_url('admin/menu')?>"><i class=""></i>Menu Items</a>
                        </li>

                        <li class="nav-item">
                                <a class="nav-item" href="<?php echo site_url('admin/sales')?>"><i class=""></i>Sales</a>
                           </li>

                        <li class="nav-item">
                                <a class="nav-item" href="<?php echo site_url('admin/inventory')?>"><i class=""></i>Inventory</a>
                        </li>

                        <li class="nav-item">
                                <a class="nav-item" href="<?php echo site_url('admin/tables')?>"><i class=""></i>Tables</a>
                        </li>

                        <li class="nav-item">
                                <a class="nav-item" href="<?php echo site_url('')?>"><i class=""></i>Reports</a>
                        </li>

                        <li class="nav-item">
                                <a class="nav-item" href="<?php echo site_url('admin/accounts')?>"><i class=""></i>Accounts</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
    <!-- End of Left Sidebar -->

    <!-- Content -->
    <!-- Table -->
    <div class="container">
        <table id="table" class="display">
                  <thead>
                    <tr>
                      <th scope="col">Name</th>
                      <th scope="col">Contact</th>
                      <th scope="col">Status</th>
                      <th scope="col">Actions</th>
                    </tr>
                  </thead>
    
                  <tbody>
                    <?php 
                    if (isset($source)){
                      foreach ($source as $source){
                    ?>
                    <tr data-id="<?php echo $source['source_id']?>"">
                      <td><?php echo $source['source_name'] ?></td>
                      <td><?php echo $source['contact_num']?></td>
                      <td><?php echo $source['status']?></td>
                      <td>
                        <div class="text-left mt-2">
                          <button class="btn btn-primary btn-xs mb-2">Edit</button>
                          <button class="btn btn-success btn-xs mb-2" formaction="<?php echo site_url('admin/menu/delete/'. $item[menu_id])?>">Delete</button>
                        </div>
                      </td>
                    </tr>
                    <?php  }
                    }
                    ?>
                  </tbody>
            </table>
        </div>
    </body>
    <!-- START EDIT MODAL -->
    <div id="editmodal">
        <!-- Header -->
        <div>
            <span>EDIT CATEGORY</span>
        </div>
        <!-- FORM -->
        <div>
            <span>Name: </span><input type="text" value="">
            <span>Contact No: </span><input type="text" value="">
            <span>Status: </span><input type="text" value="">
        </div>
        <!-- BUTTONS -->
        <div>
            <button>Cancel</button>
            <button href="<?php echo site_url('admin/source/edit/')?>">OK</button>
        </div>
    </div>
    <!-- END EDIT MODAL -->

    <!-- START DELETE MODAL -->
    <div>
        <!-- Header -->
        <div>
            <span>DELETE CATEGORY</span>
        </div>
        <!-- FORM -->
        <div>
            <p>Do you want to delete this category?</p>
        </div>
        <!-- BUTTONS -->
        <div>
            <button>No</button>
            <button formaction="<?php echo site_url('admin/source/delete/')?>">YES</button>
        </div>            
    </div>
    <!-- END EDIT MODAL -->
</html>
<script>
var modal = document.getElementByID("editmodal");
var tuples = ((document.getElementByID('tablevalues')).getElementsByTagName('tbody'))[0].getElementsByTagName('tr');
var tupleNo = tuples.length;
for(var x = 0; x < tupleNo;x++){
    tuples.lastChild.firstChild.addEventListener("click", showEditModal);
    tuples.lastChild.lastChild.addEventListener("click", showDeleteModal);
}   
    function editModal(event){
        var row = event.target.parentElement.parentElement;
        var okbutton = modal.lastChild.lastChild;
        var row_id = row.getAttribute("data-id");
        okbutton.setAttribute("formaction",okbutton.getAttribute("formaction")+row_id);
        for(var index = 0 ; index<model.getElementsByTagName("input")){
            modal.getElementsByTagName("input")[index].value = ;
        }
        modal.style.display = "block";
        
        event.target.parentElement.parentElement
    }
</script>
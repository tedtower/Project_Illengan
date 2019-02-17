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
                        <th scope="col">Code</th>
                        <th scope="col">Name</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Unit</th>
                        <th scope="col">Min Quantity</th>
                        <th scope="col">Category</th>
                        <th scope="col">Status</th>
                        <th scope="col">Actions</th>
                    </tr>
                  </thead>
    
                  <tbody>
                    <?php 
                    if (isset($stock)){
                      foreach ($stock as $stock){
                    ?>
                    <tr>
                      <td><?php echo $stock['stock_id'] ?></td>
                      <td><?php echo $stock['stock_name']?></td>
                      <td><?php echo $stock['stock_quantity']?></td>
                      <td><?php echo $stock['stock_unit']?></td>
                      <td><?php echo $stock['stock_minimum']?></td>
                      <td><?php echo $stock['category_name']?></td>
                      <td><?php echo $stock['stock_status']?></td>
                      <td>
                        <div class="text-left mt-2">
                          <button class="btn btn-primary btn-xs mb-2">Edit</button>
                          <button class="btn btn-success btn-xs mb-2"">Delete</button>
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
</html>
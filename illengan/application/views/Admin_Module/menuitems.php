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
                      <!-- <th scope="col">Code</th> -->
                      <th scope="col">Menu Item</th>
                      <th scope="col">Description</th>
                      <th scope="col">Size</th>
                      <th scope="col">Category</th>
                      <th scope="col">Price</th>
                      <th scope="col">Status</th>
                      <th scope="col">Actions</th>
                    </tr>
                  </thead>
    
                  <tbody>
                    <?php 
                    if (isset($menu)){
                      foreach ($menu as $item){
                    ?>
                    <tr>
                      <!-- <th scope="row">1</th> -->
                      <td><?php echo $item['menu_name'] ?></td>
                      <td><?php echo $item['menu_description']?></td>
                      <td><?php echo isset($item['size']) ? 'N/A': $item['size']?></td>
                      <td><?php echo $item['category_name']?></td>
                      <td>&#8369;<?php echo $item['menu_price']?></td>
                      <td><?php echo $item['menu_availability']?></td>
                      <td>
                        <div class="text-left mt-2">
                          <button class="btn btn-primary btn-xs mb-2">Edit</button>
                          <button class="btn btn-success btn-xs mb-2">Delete</button>
                        </div>
                      </td>
                    </tr>
                    <?php  }
                    }
                    ?>
                    

                    <!-- <tr>
                      <td>Caramel Frappe</td>
                      <td>Drinks</td>
                      <td>&#8369;75</td>
                      <td>Availble</td>
                      <td>
                        <div class="text-left mt-2">
                          <button class="btn btn-primary btn-xs mb-2">Edit</button>
                          <button class="btn btn-success btn-xs mb-2">Delete</button>
                        </div>
                      </td>
                    </tr>

                    <tr>
                      <td>Ligth Mocha Frappe</td>
                      <td>Drinks</td>
                      <td>&#8369;75</td>
                      <td>Unavailble</td>
                      <td>
                        <div class="text-left mt-2">
                          <button class="btn btn-primary btn-xs mb-2">Edit</button>
                          <button class="btn btn-success btn-xs mb-2">Delete</button>
                        </div>
                      </td>
                    </tr>

                    <tr>
                      <td>Strawberry Frappe</td>
                      <td>Drinks</td>
                      <td>&#8369;75</td>
                      <td>Unavailble</td>
                      <td>
                        <div class="text-left mt-2">
                          <button class="btn btn-primary btn-xs mb-2">Edit</button>
                          <button class="btn btn-success btn-xs mb-2">Delete</button>
                        </div>
                      </td>
                    </tr>

                    <tr>
                      <td>Chocolate Frappe</td>
                      <td>Drinks</td>
                      <td>&#8369;75</td>
                      <td>Availble</td>
                      <td>
                        <div class="text-left mt-2">
                          <button class="btn btn-primary btn-xs mb-2">Edit</button>
                          <button class="btn btn-success btn-xs mb-2">Delete</button>
                        </div>
                      </td>
                    </tr>

                    <tr>
                      <td>Mocha Frappe</td>
                      <td>Drinks</td>
                      <td>&#8369;75</td>
                      <td>Availble</td>
                      <td>
                        <div class="text-left mt-2">
                          <button class="btn btn-primary btn-xs mb-2">Edit</button>
                          <button class="btn btn-success btn-xs mb-2">Delete</button>
                        </div>
                      </td>
                    </tr>

                    <tr>
                      <td>Cappucino</td>
                      <td>Drinks</td>
                      <td>&#8369;75</td>
                      <td>Unavailble</td>
                      <td>
                        <div class="text-left mt-2">
                          <button class="btn btn-primary btn-xs mb-2">Edit</button>
                          <button class="btn btn-success btn-xs mb-2">Delete</button>
                        </div>
                      </td>
                    </tr>

                    <tr>
                      <td>Benguet French Pressed</td>
                      <td>Drinks</td>
                      <td>&#8369;75</td>
                      <td>Availble</td>
                      <td>
                        <div class="text-left mt-2">
                          <button class="btn btn-primary btn-xs mb-2">Edit</button>
                          <button class="btn btn-success btn-xs mb-2">Delete</button>
                        </div>
                      </td>
                    </tr>

                    <tr>
                      <td>Hazelnut Espresso</td>
                      <td>Drinks</td>
                      <td>&#8369;75</td>
                      <td>Unavailble</td>
                      <td>
                        <div class="text-left mt-2">
                          <button class="btn btn-primary btn-xs mb-2">Edit</button>
                          <button class="btn btn-success btn-xs mb-2">Delete</button>
                        </div>
                      </td>
                    </tr>
                    
                    <tr>
                      <td>Cafe Late</td>
                      <td>Drinks</td>
                      <td>&#8369;75</td>
                      <td>Availble</td>
                      <td>
                        <div class="text-left mt-2">
                          <button class="btn btn-primary btn-xs mb-2">Edit</button>
                          <button class="btn btn-success btn-xs mb-2">Delete</button>
                        </div>
                      </td>
                    </tr> -->
                  </tbody>
              
            </table>
        </div>
    
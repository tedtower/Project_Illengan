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
    <link rel="stylesheet"
        href="<?php echo base_url('application/others/fonts/material-design-iconic-font/css/materialdesignicons.min.css')?>">
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
                            <a class="nav-item" href="<?php echo site_url('admin/sales')?>"><i class=""></i>Sales</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-item" href="<?php echo site_url('admin/inventory')?>"><i
                                    class=""></i>Inventory</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-item" href="<?php echo site_url('admin/tables')?>"><i class=""></i>Tables</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-item" href="<?php echo site_url('')?>"><i class=""></i>Reports</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-item" href="<?php echo site_url('admin/accounts')?>"><i
                                    class=""></i>Accounts</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
    <!-- End of Left Sidebar -->

    <!-- Content -->
    <!-- ADD INVENTORY ITEM -->
    <div>
        <div><span>Add Inventory</span></div>
        <form method="post">
            <div>
                <span>Stock Name: </span>
                <span>Stock Quantity: </span>
                <span>Stock Unit: </span>
                <span>Stock Minimum Quantity: </span>
                <span>Stock Category: </span>
                <span>Stock Status: </span>
            </div>
            <div>
                <input name="stock_name" type="text" value="<?php echo set_value('stock_name')?>">
                <input name="stock_quantity" type="number" value="<?php echo set_value('stock_quantity')?>">
                <input name="stock_unit" type="text" value="<?php echo set_value('stock_unit')?>">
                <input name="stock_minqty" type="number" value="<?php echo set_value('stock_minqty')?>">
                <select name="stock_category">
                    <?php
            if(isset($category)){
                foreach($category as $category_item){
            ?>
                    <option value="<?php echo $category_item['category_id']?>">
                        <?php echo $category_item['category_name']?></option>
                    <?php        
                }
            }
            ?>
                </select>
                <select name="stock_status">
                    <option value="Available">Available</option>
                    <option value="Unavailable">Unavailable</option>
                </select>
            </div>
            <div>
                <button>Cancel</button>
                <button type="submit" formaction="<?php echo site_url('admin/inventory/add')?>">Add</button>
            </div>
        </form>
    </div>
    <!-- END ADD INVENTORY ITEM -->
    <!-- EDIT INVENTORY ITEM -->
    <div>
        <div><span>Edit Inventory</span></div>
        <form method="post">
            <div>
                <span>Stock Code: </span>
                <span>Stock Name: </span>
                <span>Stock Quantity: </span>
                <span>Stock Unit: </span>
                <span>Stock Minimum Quantity: </span>
                <span>Stock Category: </span>
                <span>Stock Status: </span>
            </div>
            <div>
                <input name="stock_id" type="text" disabled="disabled">
                <input name="stock_name" type="text" value="">
                <input name="stock_quantity" type="number" value="">
                <input name="stock_unit" type="text" value="">
                <input name="stock_minqty" type="number" value="">
                <select name="stock_category">
                    <?php
            if(isset($category)){
                foreach($category as $category_item){
            ?>
                    <option value="<?php echo $category_item['category_id']?>">
                        <?php echo $category_item['category_name']?></option>
                    <?php        
                }
            }
            ?>
                </select>
                <select name="stock_status">
                    <option value="Available">Available</option>
                    <option value="Unavailable">Unavailable</option>
                </select>
            </div>

        </form>
    </div>
    <!-- END EDIT INVENTORY ITEM -->
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
                      foreach ($stock as $stock_item){
                    ?>
                <tr>
                    <td><?php echo $stock_item['stock_id'] ?></td>
                    <td><?php echo $stock_item['stock_name']?></td>
                    <td><?php echo $stock_item['stock_quantity']?></td>
                    <td><?php echo $stock_item['stock_unit']?></td>
                    <td><?php echo $stock_item['stock_minimum']?></td>
                    <td><?php echo $stock_item['category_name']?></td>
                    <td><?php echo $stock_item['stock_status']?></td>
                    <td>
                        <div class="text-left mt-2">
                            <button class="btn btn-primary btn-xs mb-2" name="editbutton">Edit</button>
                            <button class="btn btn-success btn-xs mb-2">Delete</button>
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
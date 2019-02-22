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
    <div>
        <div>
            <span>Add Menu Item</span>
        </div>
        <form method="get">
            <div>
                <div>
                    <span>Item Name: </span>
                    <span>Item Description: </span>
                    <!-- <span>Size: </span> -->
                    <span>Category: </span>
                    <span>Price: </span>
                    <span>Menu Availability: </span>
                </div>
                <div>
                    <input type="text" name="item_name" value="">
                    <input type="text" name="item_desc" value="">
                    <!-- <input type="text" name="category_name" value=""> -->
                    <select name="category">
                        <?php 
                      if(!empty($category)){
                        foreach($category as $category_item){
                      ?>
                        <option value="<?php echo $category_item['category_id']?>"><?php echo $category_item['category_name']?>
                        </option>
                        <?php
                        }
                      }
                      ?>
                    </select>
                    <input type="text" name="price" value="">
                    <input id="avail" type="radio" name="availability" value="available"><label
                        for="avail">Available</label>
                    <input id="unavail" type="radio" name="availability" value="unavailable"><label
                        for="unavail">Unavailable</label>
                </div>
            </div>
            <div>
                <button onclick="">Cancel</button>
                <button type="submit" formaction="<?php echo site_url('admin/menu/add')?>" value="Add">Add</button>
            </div>
        </form>
    </div>
    <div>
        <div>
            <span>Edit Menu Item</span>
        </div>
        <form method="get">
            <div>
                <div>
                    <span>Item Name: </span>
                    <span>Item Description: </span>
                    <!-- <span>Size: </span> -->
                    <span>Category: </span>
                    <span>Price: </span>
                    <span>Menu Availability: </span>
                </div>
                <div>
                    <input type="hidden" name="item_id" value="">
                    <input type="text" name="item_name" value="">
                    <input type="text" name="item_desc" value="">
                    <!-- <input type="text" name="category_name" value=""> -->
                    <select name="category">
                    <?php 
                      if(!empty($category)){
                        foreach($category as $category_item){
                      ?>
                        <option value="<?php echo $category_item['category_id']?>"><?php echo $category_item['category_name']?>
                        </option>
                    <?php
                        }
                      }?>
                    </select>
                    <input type="text" name="price" value="">
                    <input id="" type="radio" name="availability" value=""><label for=""></label>
                </div>
            </div>
            <div>
                <button onclick="">Cancel</button>
                <button type="submit" formaction="<?php echo site_url('admin/menu/add')?>" value="Add">OK</button>
            </div>
        </form>
    </div>
    <div class="container">
        <table id="table" class="display">
            <thead>
                <tr>
                    <!-- <th scope="col">Code</th> -->
                    <th scope="col">Menu Item</th>
                    <th scope="col">Description</th>
                    <!-- <th scope="col">Size</th> -->
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
                    <!-- <td></td> -->
                    <td><?php echo $item['category_name']?></td>
                    <td>&#8369;<?php echo $item['menu_price']?></td>
                    <td><?php echo $item['menu_availability']?></td>
                    <td>
                        <div class="text-left mt-2">
                            <button class="btn btn-primary btn-xs mb-2" name="editmenu">Edit</button>
                            <button class="btn btn-success btn-xs mb-2"
                                formaction="<?php echo site_url('admin/menu/delete/'. $item['menu_id'])?>">Delete</button>
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
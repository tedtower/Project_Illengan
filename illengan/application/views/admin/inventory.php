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
                            <a class="nav-item" href="<?php echo site_url('admin/dashboard');?>"><i
                                    class="fa fa-fw fa-user-circle"></i>Dashboard</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-item" href="<?php echo site_url('admin/menu');?>"><i class=""></i>Menu
                                Items</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-item" href="<?php echo site_url('admin/sales');?>"><i class=""></i>Sales</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-item" href="<?php echo site_url('admin/inventory');?>"><i
                                    class=""></i>Inventory</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-item" href="<?php echo site_url('admin/tables');?>"><i class=""></i>Tables</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-item" href="<?php echo site_url('');?>"><i class=""></i>Reports</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-item" href="<?php echo site_url('admin/accounts');?>"><i
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
                <input name="new_stock_name" type="text" value="<?php echo set_value('stock_name');?>">
                <input name="new_stock_quantity" type="number" value="<?php echo set_value('stock_quantity');?>">
                <input name="new_stock_unit" type="text" value="<?php echo set_value('stock_unit');?>">
                <input name="new_stock_minqty" type="number" value="<?php echo set_value('stock_minqty');?>">
                <select name="new_stock_category">
                    <?php
            if(isset($category)){
                foreach($category as $category_item){
            ?>
                    <option value="<?php echo $category_item['category_id'];?>" <?php echo set_select('stock_category', $category_item['category_id']);?>>
                        <?php echo $category_item['category_name'];?></option>
                    <?php        
                }
            }
            ?>
                </select>
                <select name="new_stock_status">
                    <option value="Available"<?php echo set_select('stock_status', 'Available');?>>Available</option>
                    <option value="Unavailable"<?php echo set_select('stock_status', 'Unavailable');?>>Unavailable</option>
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
                <input name="new_stock_id" type="text" disabled="disabled">
                <input name="new_stock_name" type="text" value="">
                <input name="new_stock_quantity" type="number" value="">
                <input name="new_stock_unit" type="text" value="">
                <input name="new_stock_minqty" type="number" value="">
                <select name="new_stock_category">
                    <?php
            if(isset($category)){
                foreach($category as $category_item){
            ?>
                    <option value="<?php echo $category_item['category_id'];?>">
                        <?php echo $category_item['category_name'];?></option>
                    <?php        
                }
            }
            ?>
                </select>
                <select name="new_stock_status">
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
                        $count=0;
                      foreach ($stock as $stock_item){
                    ?>
                <tr>
                    <td class="stock_id"><?php echo $stock_item['stock_id'] ;?></td>
                    <td class="stock_name"><?php echo $stock_item['stock_name'];?></td>
                    <td class="stock_qty"><?php echo $stock_item['stock_quantity'];?></td>
                    <td class="stock_unit"><?php echo $stock_item['stock_unit'];?></td>
                    <td class="stock_min"><?php echo $stock_item['stock_minimum'];?></td>
                    <td class="category_name"><?php echo $stock_item['category_name'];?></td>
                    <td class="stock_status"><?php echo $stock_item['stock_status'];?></td>
                    <td>
                        <div class="text-left mt-2">
                            <button class="btn btn-primary btn-xs mb-2" data-index="<?php echo $count;?>" class="editbutton">Edit</button>
                            <button class="btn btn-success btn-xs mb-2" data-id="<?php echo $stock_item['stock_id']?>" class="deletebutton">Delete</button>
                        </div>
                    </td>
                </tr>
                <?php  
                        $count++;
                        }
                    }
                    ?>
            </tbody>
        </table>
    </div>
</body>
</html>
<script>
var stock_ids;       
var stock_names;     
var stock_qtys;      
var stock_units;     
var stock_mins;      
var category_names;  
var stock_statuses;  
var editbuttons;     
    $(document).ready(function(){
        $('.editbutton').on('click',function(){
            var index = $(this).attr('data-index');
            
        });
    });
    function showEditModal(){
        $()
    }

    function initialize(){
        stock_ids       = $('.stock_id');
        stock_names     = $('.stock_name');
        stock_qtys      = $('.stock_qty');
        stock_units     = $('.stock_unit');
        stock_mins      = $('.stock_min');
        category_names  = $('.category_name');
        stock_statuses  = $('.stock_status');
        editbuttons     = $('.editbutton');
        deletebuttons   = $('.deletebutton');
    }

    function setEvent(){
        for(var x = 0 ; x < editButtons.length ; x++){
            editbuttons[x].
        }
    }


</script>
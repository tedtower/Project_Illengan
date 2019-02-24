<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
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
<div class="table-responsive" style="text-align:center">
    <table class="table table-bordered">
        <tr>
            <th>Code</th>
            <th>Description</th> <!--menu id-->
            <th>Quantity</th> <!--sqty-->
            <th>Damage date</th> <!--sdate-->
            <th>Date Recorded</th> <!--date_recorded-->
            <th>Remarks</th> <!--remarks-->
            <th>Delete</th>
        </tr>
        <?php
            
            if (isset($spoilagesmenu)){
                foreach ($spoilagesmenu as $row){
              ?>
                    <tr>
                        <td><?php echo $row['sid']; ?></td>
                        <td><?php echo $row['menu_name']; ?></td>
                        <td><?php echo $row['sqty']; ?></td>
                        <td><?php echo $row['sdate']; ?></td>
                        <td><?php echo $row['date_recorded']; ?></td>
                        <td><?php echo $row['remarks']; ?></td>
                        <td><a href="<?php echo site_url('admin/deletespoilages/'.$row['sid']);?>">Delete</a></td>
                    </tr>
                    <?php
                    }
            }else{
                echo "There is no data";
            }
            ?>
    </table>
    </body>
</html>
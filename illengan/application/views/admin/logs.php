<!DOCTYPE html>
<html>
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
        <title>Il-Lengan - Logs</title>
    </head>
    <body>
        <!-- SIDEBAR -->
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
    <!-- END OF SIDEBAR-->
        <div>
            <table>
                <thead>
                    <tr>
                        <th>Code</th>
                        <th>Stock Name</th>
                        <th>Quantity</th>
                        <th>Log Type</th>
                        <th>Date by Type</th>
                        <th>Date Recorded</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if(isset($log)){
                        foreach($log as $log){
                    ?>
                    <tr>
                        <td><?php echo $log['log_id']?></td>
                        <td><?php echo $log['stock_name']?></td>
                        <td><?php echo $log['quantity']?></td>
                        <td><?php echo $log['log_type']?></td>
                        <td><?php echo $log['log_date']?></td>
                        <td><?php echo $log['date_recorded']?></td>
                        <td><?php echo 'action'?></td>
                    </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </body>
</html>
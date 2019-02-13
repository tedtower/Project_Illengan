<!DOCTYPE html>
<<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Tables</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link rel="stylesheet" type="text/css" media="screen" href="main.css" /> -->
    <!-- <script src="main.js"></script> -->
</head>
<body>
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
                                <a class="nav-item"><i class=""></i>Billings</a>
                           </li>

                        <li class="nav-item">
                                <a class="nav-item"><i class=""></i>Inventory</a>
                        </li>

                        <li class="nav-item">
                                <a class="nav-item"><i class=""></i>Tables</a>
                        </li>

                        <li class="nav-item">
                                <a class="nav-item"><i class=""></i>Reports</a>
                        </li>

                        <li class="nav-item">
                                <a class="nav-item"><i class=""></i>Accounts</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
    <div class="container">
        <table id="table" class="display">
            <tr>
                <th>Table Number</th>
                <th>Actions</th>
            </tr>
            <?php
                if(isset($table)){
                    foreach($table as $table){
            ?> 
            <tr>
                <td><?php echo $table['table_no']?></td>
                <td><?php echo 'Action'?></td>
            </tr>
            <?php            
                    }
                } 
            ?>
        </table>
    </div>
    </table>
</body>
</html>
<!DOCTYPE html>
<html>
    <head>

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
        <!-- ADD CATEGORY-->
        <div>
            <div>
            <span>Add Menu Category</span>
            </div>
            <form method="get">
                <div>
                    <span>Category Name: </span><input type="text" name="category_name" value="">
                </div>
                <div>
                    <button onclick="">Cancel</button>
                    <button type="submit" formaction="<?php echo site_url('admin/menucategories/add')?>">Add</button>
                </div>
            </form>
        </div>
        <!-- END ADD CATEGORY-->   
        <div>
            <table>
                <thead>
                    <tr>
                        <th>Category Name</th>
                        <th>Number of Items</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if(isset($category)){
                        foreach($category as $category){
                    ?>
                    <tr>
                        <td><?php echo $category['category_name']?></td>
                        <td><?php echo $category['menu_no']?></td>
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
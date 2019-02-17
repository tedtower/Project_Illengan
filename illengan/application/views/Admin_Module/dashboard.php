<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url('application/css/frameworks/bootstrap.min.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('application/others/fonts/circular-std/style.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('application/css/admin/style.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('application/others/fonts/fontawesome/css/fontawesome-all.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('application/others/charts/chartist-bundle/chartist.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('application/others/charts/morris-bundle/morris.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('application/others/material-design-iconic-font/css/materialdesignicons.min.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('application/others/charts/c3charts/c3.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('application/others/fonts/flag-icon-css/flag-icon.min.css')?>">
    <title>Il-Lengan</title>
</head>

<body>
    <div class="dashboard-main-wrapper">
       <!--Navigation Bar-->
        <div class="dashboard-header">
            <nav class="navbar navbar-expand-lg bg-white fixed-top">
                <a class="navbar-brand" href="dashboard.html">Il-Lengan</a>
                <div class="collapse navbar-collapse " id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto navbar-right-top">
        
                        <li class="nav-item dropdown nav-user">
                            <a class="nav-link nav-user-img" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="assets/images/avatar-1.jpg" alt="" class="user-avatar-md rounded-circle"></a>
                            <div class="dropdown-menu dropdown-menu-right nav-user-dropdown" aria-labelledby="navbarDropdownMenuLink2">
                                <div class="nav-user-info">
                                    <h5 class="mb-0 text-white nav-user-name">John Abraham </h5>
                                    <span class="status"></span><span class="ml-2">Available</span>
                                </div>
                                <a class="dropdown-item" href="#"><i class="fas fa-cog mr-2"></i>Setting</a>
                                <a class="dropdown-item" href="#"><i class="fas fa-power-off mr-2"></i>Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <!-- ============================================================== -->
        <!-- left sidebar -->
        <!-- ============================================================== -->
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
        <!-- ============================================================== -->
        <!-- end left sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- wrapper  -->
        <!-- ============================================================== -->
        <div class="dashboard-wrapper">
            <div class="dashboard-ecommerce"><!--Billings-->
                <div class="container-fluid dashboard-content ">
                    <!-- ============================================================== -->
                    <!-- pageheader  -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- end pageheader  -->
                    <!-- ============================================================== -->
                    <div class="ecommerce-widget">

                        <div class="row">
                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="text-muted">Today's Total Sales</h5>
                                        <div class="metric-value d-inline-block">
                                            <h1 class="mb-1">12</h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="text-muted">Today's Total Revenue</h5>
                                        <div class="metric-value d-inline-block">
                                            <h1 class="mb-1">&#8369;5,754</h1>
                                        </div>
                                    </div>
                
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="text-muted">Total Items</h5>
                                        <div class="metric-value d-inline-block">
                                            <h1 class="mb-1">64</h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="text-muted">Needs Restock</h5>
                                        <div class="metric-value d-inline-block">
                                            <h1 class="mb-1">4</h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!-- ============================================================== -->
                      

                            <!-- ============================================================== -->
                            <div class="col-xl-5 col-lg-12 col-md-6 col-sm-12 col-12">
                                <div class="card">
                                    <h5 class="card-header">Top Menu Items By Sales (2019)</h5>
                                    <div class="card-body p-0">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead class="bg-light">
                                                    <tr class="border-0">
                                                        <th class="border-0">#</th>
                                                        <th class="border-0">Menu Item</th>
                                                        <th class="border-0">Category</th>
                                                        <th class="border-0">Earnings</th>
                                                        <th class="border-0">Sales</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>Baby Back Ribs</td>
                                                        <td>Meals</td>
                                                        <td>&#8369; 15,780</td>
                                                        <td>&#8369; 15,780</td>
                                                    </tr>
                                                    <tr>
                                                        <td>2</td>
                                                        <td>Americano</td>
                                                        <td>Drinks</td>
                                                        <td>&#8369; 9,800</td>
                                                        <td>&#8369; 9,800</td>
                                                    </tr>
                                                    <tr>
                                                        <td>3</td>
                                                        <td>Matcha Frappe</td>
                                                        <td>Drinks</td>
                                                        <td>&#8369; 7,820</td>
                                                        <td>&#8369; 7,820</td>
                                                    </tr>
                                                    <tr>
                                                        <td>4</td>
                                                        <td>Waffles & Bacon</td>
                                                        <td>Meal</td>
                                                        <td>&#8369; 5,960</td>
                                                        <td>&#8369; 5,960</td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
    
                            <!-- ============================================================== -->
                            <!-- ============================================================== -->
                            <!-- top categ menu items by sales  -->
                            <!-- ============================================================== -->
                                             <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <!-- <div class="float-right">
                                                <select class="custom-select">
                                                    <option selected>Today</option>
                                                    <option value="1">Weekly</option>
                                                    <option value="2">Monthly</option>
                                                    <option value="3">Yearly</option>
                                                </select>
                                            </div> -->
                                        <h5 class="mb-0"> Product Sales</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="ct-chart-product ct-golden-section"></div>
                                    </div>
                                </div>
                            </div>
                            <!-- ============================================================== -->
                            <!-- end customer -->
                        
                            
                        </div>
        </div>
        <!-- ============================================================== -->
        <!-- end wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- end main wrapper  -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <!-- jquery 3.3.1 -->
    <script src="application/js/frameworks/jquery-3.3.1.min.js"></script>
    <!-- bootstap bundle js -->
    <script src="application/js/frameworks/bootstrap.bundle.js"></script>
    <!-- main js -->
    <script src="application/js/admin/main-js.js"></script>
    <!-- chart chartist js -->
    <script src="application/others/charts/chartist-bundle/chartist.min.js"></script>
    <!-- chart c3 js -->
    <script src="application/others/charts/c3charts/c3.min.js"></script>
    <script src="application/others/charts/c3charts/d3-5.4.0.min.js"></script>
    <script src="application/others/charts/c3charts/C3chartjs.js"></script>
    <script src="application/js/admin/dashboard.js"></script>
</body>
 
</html>
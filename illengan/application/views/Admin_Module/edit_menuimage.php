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
    <div class="dashboard-wrapper">
            <div class="dashboard-ecommerce">
                <!--Billings-->
                <div class="container-fluid dashboard-content "> 



        <div id="editImageModal" style="width:40%;height:100px;margin:5%;">
            <div>
                <span>Edit Menu Image</span>
            </div>
            <?php  if (isset($image)){
                      foreach ($image as $item){
                    ?>
            <form method="post" action="<?php echo site_url('admin/menu/edit_image')?>" enctype="multipart/form-data">
            <input type="hidden" name="menu_id" id="menu_id" value=""/>
            <div style="width:100%;height:100px;overflow:hidden;border:2px solid gray; ">                        
                <img style="width:100%;position:relative;" src="<?php echo base_url('uploads/'. $item['menu_image']) ?>"/>
            </div>
            <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" style="width:105px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">Menu Image</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="menu_image" id="inputGroupFile01">
                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                        </div>
                    </div>
            </form>
            <?php  }
                    }
                    ?>
        </div>
                </div>
            </div>
    </div>
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
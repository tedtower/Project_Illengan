<html>
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="stylesheet" type="text/css" href="<?= admin_css().'style2.css'?>">
        
        </head>
<body>

            <!-- Sidebar Holder -->
            <nav id="sidebar">
                <div class="sidebar-header">
                    <img  class="logo" src="/assets/media/logo.png">
                </div>
<hr>
                <ul class="list-unstyled">
                    <li>
                            <a href="<?php echo base_url('admin/dashboard') ?>">Dashboard</a>
                        </li>
                <li class="active">
                    <a href="#homeSubmenu" data-toggle="collapse"  class="dropdown-toggle" aria-expanded="false">Inventory</a>
                    <ul class="collapse list-unstyled" id="homeSubmenu">
                         <li>
                            <a href="#logs" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Logs</a>
                            <ul  class="collapse list-unstyled" id="logs">

                                <li>
                                    <a href="<?php echo base_url('admin/log/stocks')?>" ><span style="margin-left: 15%">All</span></a>
                                </li>
                                <li>
                                   <a href="<?php echo base_url('admin/log/stocks')?>" ><span style="margin-left: 15%">Restock</span></a>
                                </li>
                                 <li>
                                   <a href="<?php echo base_url('admin/log/stocks')?>" ><span style="margin-left: 15%">Destock</span></a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="<?php echo base_url('admin/purchaseorders')?>">Purchase Order</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('admin/transactions')?>">Purchases</a>
                        </li>
                        <li>
                            <a href="#">Consumed</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('admin/adminView/viewreturns')?>">Returns</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('admin/stock/spoilages')?>">Spoilages</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#Menu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Menu</a>
                    <ul class="collapse list-unstyled" id="Menu">
                        <li>
                            <a href="<?php echo base_url('admin/menu') ?>">Menu</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('admin/menu/addons')?>">Addons</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('admin/categories')?>">Categories</a>
                        </li>
                        <li>
                            <a href="#Promo" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Promo</a>
                            <ul  class="collapse list-unstyled" id="Promo">

                                <li>
                                    <a href="<?php echo base_url('admin/discounts')?>"><span style="margin-left: 15%">Discount</span></a>
                                </li>
                                <li>
                                   <a href="#" ><span style="margin-left: 15%">Freebie</span></a>
                                </li>
                            </ul>
                        </li>
                         <li>
                            <a href="#Spoilages" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Spoilages</a>
                            <ul  class="collapse list-unstyled" id="Spoilages">

                                <li>
                                    <a href="<?php echo base_url('admin/addons/spoilages')?>"><span style="margin-left: 15%">Addons</span></a>
                                </li>
                                <li>
                                   <a href="<?php echo base_url('admin/menu/spoilages')?>"><span style="margin-left: 15%">Menu</span></a>
                                </li>
                            </ul>
                        </li>
                        
                    </ul>
                </li>
                <li>
                    <a href="<?php echo base_url('admin/sales')?>">Sales</a>
                </li>
                <li>
                    <a href="<?php echo base_url('admin/sources') ?>">Sources</a>
                </li>
                <li>
                    <a href="<?php echo base_url('admin/accounts') ?>">Accounts</a>
                </li>
                <li>
                    <a  href="<?php echo base_url('admin/tables') ?>">Tables</a>
                </li>
                        <li>
                            <a href="#Reports" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Reports</a>
                            <ul  class="collapse list-unstyled" id="Reports">

                                <li>
                                    <a href="#" >Inventory</a>
                                </li>
                                <li>
                                   <a href="#">Sales</a>
                                </li>
                            </ul>
                        </li>
                <li>
                    <a href="<?php echo base_url('admin/log/activity')?>">Activity Logs</a>
                </li>
                </ul>
    
            </nav>

    </body>
</html>

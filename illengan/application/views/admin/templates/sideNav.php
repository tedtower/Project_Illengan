<body>
    <div class="wrapper">
        <div class="sidebar" data-color="brown" data-image="<?php echo base_url().'assets/media/admin/Coffee_1.jpg'?>">
            <!--Left Navigation Bar-->
            <div class="sidebar-wrapper" style="overflow: hidden">
                <div class="logo">
                    <img src="<?php echo base_url().'assets/media/admin/logo_lg.png' ?>"
                        style="alt:il-lengan-logo; img-align: center; width:225px; height;135px;">
                </div>

                <ul class="nav">
                    <li>
                        <a href="<?php echo base_url('admin/dashboard') ?>">
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('admin/inventory')?>">
                            <p>Inventory</p>
                        </a>
                    </li>
                    <!--Sales : Dropdown-->
                    <li>
                        <a href="<?php echo base_url('admin/sales')?>">
                            <p>Sales Records</p>
                        </a>
                        <!--Start-->
                        <ul>
                            <a href="<?php echo base_url('admin/sales')?>">
                                <p>Sales</p>
                            </a>
                            <a href="<?php echo base_url('admin/addSales')?>">
                                <p>Add Sales</p>
                            </a>
                        </ul>
                        <!--End-->
                    </li>
                    <!--Spoilages : Dropdown-->
                    <li>
                        <a href="<?php echo base_url('admin/spoilages')?>">
                            <p>Spoilages</p>
                        </a>
                        <!--Start Dropdown-->
                        <ul>
                            <a href="<?php echo base_url('admin/spoilages')?>">
                                <p>All Spoilages</p>
                            </a>
                            <a href="<?php echo base_url('admin/addons/spoilages')?>">
                                <p>Add Ons Spoilages</p>
                            </a>
                            <a href="<?php echo base_url('admin/menu/spoilages')?>">
                                <p>Menu Spoilages</p>
                            </a>
                            <a href="<?php echo base_url('admin/stock/spoilages')?>">
                                <p>Stock Spoilages</p>
                            </a>
                        </ul>
                        <!--End Dropdown-->
                    </li>
                    <!--Sales : Dropdown-->
                    <li>
                        <a href="<?php echo base_url('admin/transactions')?>">
                            <p>Transactions</p>
                        </a>
                        <!--Start-->
                        <ul>
                            <a href="<?php echo base_url('admin/spoilages')?>">
                                <p>Purchased Orders</p>
                            </a>
                            <a href="<?php echo base_url('admin/spoilages')?>">
                                <p>Transactions</p>
                            </a>
                        </ul>
                        <!--End-->
                    </li>
                    <li>
                        <a href="<?php echo base_url('admin/sources')?>">
                            <p>Sources</p>
                        </a>
                    </li>
                    <!--Menu Items : Dropdown-->
                    <li>
                        <a href="<?php echo base_url('admin/menu')?>">
                            <p>Menu Items</p>
                        </a>
                        <!--Start Dropdown-->
                        <ul>
                            <a href="<?php echo base_url('admin/menuspoilages')?>">
                                <p>All</p>
                            </a>
                            <a href="<?php echo base_url('admin/discounts')?>">
                                <p>Discounts</p>
                            </a>
                            <a href="<?php echo base_url('admin/addOns')?>">
                                <p>Add Ons</p>
                            </a>
                            <a href="<?php echo base_url('admin/categories')?>">
                                <p>Categories</p>
                            </a>
                        </ul>
                        <!--End Dropdown-->
                    </li>
                    <li>
                        <a href="<?php echo base_url('admin/tables')?>">
                            <p>Tables</p>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('admin/accounts')?>">
                            <p>User Accounts</p>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('admin/reports')?>">
                            <p>Reports</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
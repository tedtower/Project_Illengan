<div class="wrapper">
    <div class="sidebar" data-color="brown" data-image="<?php echo base_url() . 'assets/media/admin/Coffee_1.jpg' ?>">
        <!--Left Navigation Bar-->
        <div class="sidebar-wrapper" style="overflow: hidden">
            <div class="logo">
                <img src="<?php echo base_url().'assets/media/admin/logo_lg.png' alt="il-lengan-logo" img-align="center" width="225px" height="135px">?>">
            </div>

            <ul class="nav">
                <li>
                    <a <?php echo base_url().'application/views/admin/adminDashboard.html' ?>">
                        <p>Dashboard</p>
                    </a>
                </li>
                <li>
                    <a <?php echo base_url().'application/views/admin/adminMenuItems.html' ?>">
                        <p>Menu Items</p>
                    </a>
                </li>
                <li>
                    <a href="adminSales.html">
                        <p>Sales</p>
                    </a>
                </li>
                <li>
                    <a href="adminInventory.html">
                        <p>Inventory</p>
                    </a>
                </li>

                <li>
                    <a href="adminTables.html">
                        <p>Tables</p>
                    </a>
                </li>
                <li>
                    <a href="adminReports.html">
                        <p>Reports</p>
                    </a>
                </li>
                <li>
                    <a href="adminAccounts.html">
                        <p>Accounts</p>
                    </a>
                </li>
                <li class="active">
                    <a href="adminTransactions.html">
                        <p>Transactions</p>
                    </a>
                </li>
                <li>
                    <a href="adminSpoilages.html">
                        <p>Spoilages</p>
                    </a>
                </li>
            </ul>
        </div> 
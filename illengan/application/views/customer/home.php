<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Il-Lengan: Customer</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	
  <?php include_once('head.php');?>
</head>
<!--Main Navigation-->
<header>
    <nav class="navbar fixed-top navbar-expand-sm navbar-dark elegant-color scrolling-navbar py-0">
        <img src="<?php echo base_url().'application/css/media/logo.png'?>" class="nav-logo mr-2 my-1" alt="Il-lengan logo" />
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto delius">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="menu-dd" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fal fa-utensils-alt"></i></i> Menu</a>
                    <div class="dropdown-menu dropdown-default elegant-color c-focus" aria-labelledby="menu-dd">
                        <a class="dropdown-item" href="#">Drinks</a>
                        <a class="dropdown-item" href="#">Snacks</a>
                        <a class="dropdown-item" href="#">Meals</a>
                    </div>
                </li>
                <li class="nav-item">
                <a class="nav-link" data-toggle="modal" href="#menu_modal"><i class="fal fa-tasks"></i> Orders</a>
                </li>
            </ul>
            <!-- Search form -->
            <form class="navbar-nav py-0 my-1">
                <div class="active-sbar">
                    <input id="searchmenu" class="form-control" type="search" placeholder="Search here..." aria-label="Search">
                </div>
            </form>
        </div>
    </nav>
    <!-- Progress Bar -->
    <div class="progress-container">
        <div class="progress-bar" id="bar"></div>
    </div>
</header>

<body>
  
<?php
	$cust_name = $this->session->userdata('cust_name');
    $table_no = $this->session-> userdata('table_no');
	echo '<h2>Welcome - '.$cust_name.'</h2><br>';
?>
	<h3><a href="<?php echo base_url();?>index.php/customer/logout">Log out</a>
<?php 
	include_once('menu.php');
	include_once('orders.php');
	include_once('orderslip.php');
	include_once('edit.php');
	include_once('remove.php');
?>
   

   
    
    
    
    
    

    <?php include_once('scripts.php');?>
</body>
</html>
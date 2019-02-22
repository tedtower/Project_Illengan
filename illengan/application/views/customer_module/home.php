<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Menu Card</title>
  <?php include_once('head.php') ?>
</head>

<!--Main Navigation-->
<header>
  <nav class="navbar navbar-expand-sm fixed-top navbar-dark brown darken-2 scrolling-navbar py-0 my-0">
    <img class="img-logo mr-3" src="<?php echo base_url().'logo.png' ?>">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto roboto">
        <li class="nav-item active">
          <a class="nav-link" href="#">Category 1</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Category 2</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Category 3</a>
        </li>
        <li class="nav-item" style="right: 0;">
          <a class="nav-link" data-toggle="modal" href="#vieworders">Cart</a>
        </li>
      </ul>
    </div>
  </nav>
  <div class="progress-container">
      <div class="progress-bar" id="myBar"></div>
  </div>
</header>
<!--Main Navigation-->

<body>
  <!-- Search form -->
  <form class="form-inline mr-auto float-right">
    <input class="form-control" type="text" placeholder="Enter keyword..." aria-label="Search">
    <button class="btn btn-rounded btn-sm my-0 ml-sm-1" style="background-color:#a1887f;" type="submit"><span class="fa fa-search"></span> Search</button>
  </form>

<!-- MENU ITEMS -->
<?php include_once('menu.php'); ?>
<!-- ORDERS -->
<?php include_once('orders.php'); ?>


<div style="height:1500px;"></div>
  <!-- SCRIPTS -->
  <!-- JQuery -->
  <?php include_once('scripts.php') ?>
</body>
</html>
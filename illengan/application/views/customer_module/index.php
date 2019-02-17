<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Menu Card</title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>application/css/frameworks/all.min.css">
  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>application/css/frameworks/bootstrap.min.css">
  <!-- Material Design Bootstrap -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>application/css/frameworks/mdb.min.css">
  <!-- Custom Styles -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>application/css/customer/style.css">
</head>

<!--Main Navigation-->
<header>
  <nav class="navbar navbar-expand-sm fixed-top navbar-dark brown darken-2 scrolling-navbar py-0 my-0">
    <img class="img-logo mr-3" src="<?php echo base_url(); ?>application//images/customer/logo.png">
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
    <button class="btn btn-rounded btn-sm my-0 ml-sm-1" style="background-color:#a1887f;" type="submit"><span class="fa fa-search"></span>
      Search</button>
  </form>
  <div>
    <!--Subcategory w/ Cards-->
    <div class="d-inline-flex px-4 animated flipInX slow subcategory mb-2 delius">
      <h5>Subcategory 1</h5>
    </div>
    <!-- Card group -->
    <div class="d-flex flex-wrap">
      <!-- Card -->
      <div class="card cd-mw">
        <!-- Card image -->
        <a data-toggle="modal" href="#menu_modal_sizable">
          <img class="card-img-top" src="<?php echo base_url(); ?>application//images/customer/card.jpeg" alt="Name of the Product">
        </a>
        <!-- Card content -->
        <div class="card-body p-0 m-0 gabriola">
          <!-- Title -->
          <p class="text-truncate float-left menu-title" id="mt">Menu Item Name</p>
          <p class="float-right menu-price" id="mp"><span class="fs-15">₱</span>100-140</p>
        </div>
      </div>
      <!-- Card -->
      <div class="card cd-mw">
        <!-- Card image -->
        <a data-toggle="modal" href="#menu_modal_unsizable">
          <img class="card-img-top" src="/images/customer/card.jpeg" alt="Name of the Product">
        </a>
        <!-- Card content -->
        <div class="card-body p-0 m-0 gabriola">
          <!-- Title -->
          <p class="text-truncate float-left menu-title" id="mt">Menu Item Name</p>
          <p class="float-right menu-price" id="mp"><span class="fs-15">₱</span>85</p>
        </div>
      </div>
    </div>
    <!-- Card group -->
  </div>


  <!-- Sizable Modal -->
  <div class="modal fade" id="menu_modal_sizable" tabindex="-1" role="dialog" aria-labelledby="menuItemModal"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content" style="padding:0px;">
        <!-- Modal Body -->
        <div class="modal-body">
          <!-- Menu Image -->
          <img class="w-100" src="<?php echo base_url(); ?>application/images/customer/card.jpeg" alt="Menu Item Name">
          <!-- Title And Price -->
          <div class="d-flex justify-content-between gabriola rp-title">
            <p>Menu Item Name</p>
            <p><span class="fs-24">₱</span>100-140</p>
          </div>
          <!-- Description -->
          <p class="p-ti">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
            labore et dolore magna aliqua. Sit amet commodo nulla facilisi nullam.</p>
          <hr>
          <!-- Order Form -->
          <h3 class="gabriola">Order Details</h3>
          <div class="input-group mb-3" id="sizable">
            <div class="d-flex align-items-center w-100">
              <label class="px-1" for="size">Size:</label>
              <select class="browser-default custom-select delius" id="size" name="size">
                <option selected disabled>Select Order Size...</option>
                <option value="S">Small (100 php)</option>
                <option value="M">Medium (120php)</option>
                <option value="L">Large (140 php)</option>
              </select>
            </div>
          </div>
          <div class="md-form input-group mb-3">
            <div class="d-flex flex-row">
              <span class="px-1">Qty :</span>
              <div class="input-group-prepend">
                <button class="btn btn-md btn-brown m-0 px-3 py-2 z-depth-0" type="button" data-quantity="minus"
                  data-field="quantity">
                  <i class="fa fa-minus" aria-hidden="true"></i>
                </button>
                <input type="text" class="form-control" name="quantity" id="quantity" value="1">
                <button class="btn btn-md btn-brown m-0 px-3 py-2 z-depth-0" type="button" data-quantity="plus"
                  data-field="quantity">
                  <i class="fa fa-plus" aria-hidden="true"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-dark-green" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-dark-green">Save To Order List</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Unsizable Modal -->
  <div class="modal fade" id="menu_modal_unsizable" tabindex="-1" role="dialog" aria-labelledby="menuItemModal"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content" style="padding:0px;">
        <!-- Modal Body -->
        <div class="modal-body">
          <!-- Menu Image -->
          <img class="w-100" src="<?php echo base_url(); ?>application/images/customer/card.jpeg" alt="Menu Item Name">
          <!-- Title And Price -->
          <div class="d-flex justify-content-between gabriola rp-title">
            <p>Menu Item Name</p>
            <p><span class="fs-24">₱</span>85</p>
          </div>
          <!-- Description -->
          <p class="p-ti">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
            labore et dolore magna aliqua. Sit amet commodo nulla facilisi nullam.</p>
          <hr>
          <!-- Order Form -->
          <h3 class="gabriola">Order Details</h3>
          <div class="md-form input-group mb-3">
            <div class="d-flex flex-row">
              <span class="px-1">Qty :</span>
              <div class="input-group-prepend">
                <button class="btn btn-md btn-brown m-0 px-3 py-2 z-depth-0" type="button" data-quantity="minus"
                  data-field="quantity">
                  <i class="fa fa-minus" aria-hidden="true"></i>
                </button>
                <input type="text" class="form-control" name="quantity" id="quantity" value="1">
                <button class="btn btn-md btn-brown m-0 px-3 py-2 z-depth-0" type="button" data-quantity="plus"
                  data-field="quantity">
                  <i class="fa fa-plus" aria-hidden="true"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-dark-green" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-dark-green">Save To Order List</button>
        </div>
      </div>
    </div>
  </div>

  <div style="height:1500px;"></div>

  <!-- SCRIPTS -->
  <!-- JQuery -->
  <script type="text/javascript" src="<?php echo base_url(); ?>application/js/frameworks/jquery-3.3.1.min.js"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="<?php echo base_url(); ?>application/js/frameworks/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="<?php echo base_url(); ?>application/js/frameworks/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="<?php echo base_url(); ?>application/js/frameworks/mdb.min.js"></script>
  <!-- Custom JavaScript -->
  <script type="text/javascript" src="<?php echo base_url(); ?>application/js/customer/indec.js"></script>
</body>

</html>
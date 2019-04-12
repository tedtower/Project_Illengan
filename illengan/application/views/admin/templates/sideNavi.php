<style>
body {
  font-family: "Lato", sans-serif;
}

/* Fixed sidenav, full height */
.sidenav {
  height: 100%;
  width: 200px;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  background-color: #654231;
  overflow-x: hidden;
  padding-top: 20px;
  background
}

/* Style the sidenav links and the dropdown button */
.sidenav a, .dropdown-btn {
  padding: 6px 8px 6px 16px;
  text-decoration: none;
  font-size: 20px;
  color: white;
  display: block;
  border: none;
  background: none;
  width: 100%;
  text-align: left;
  cursor: pointer;
  outline: none;
}

/* On mouse-over */
.sidenav a:hover, .dropdown-btn:hover {
  color: #f1f1f1;
}

/* Main content */
.main {
  margin-left: 200px; /* Same as the width of the sidenav */
  font-size: 20px; /* Increased text to enable scrolling */
  padding: 0px 10px;
}

/* Add an active class to the active dropdown button */
.active {
  background-color: #B06C49;
  color: white;
}

/* Dropdown container (hidden by default). Optional: add a lighter background color and some left padding to change the design of the dropdown content */
.dropdown-container {
  display: none;
  background-color: #262626;
  padding-left: 8px;
}

/* Optional: Style the caret down icon */
.fa-caret-down {
  float: right;
  padding-right: 15px;
}

/* Some media queries for responsiveness */
@media screen and (max-height: 450px) {
  .sidenav {padding-top: 10px;}
  .sidenav a {font-size: 18px;}
}
</style>
</head>
<body>


<div class="sidenav">
    <a href="<?= site_url('admin/dashboard') ?>">
        <p>Dashboard</p>
    </a>
    <a href="<?= site_url('admin/inventory')?>">
        <p>Inventory</p>
    </a>
    <button class="dropdown-btn">Sales Records
        <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-container">
        <a href="<?= site_url('admin/sales')?>">
            <p>Sales</p>
        </a>
        <a href="<?= site_url('admin/addSales')?>">
            <p>Add Sales</p>
        </a>
    </div>
    <button class="dropdown-btn">Spoilages
        <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-container">
        <a href="<?= site_url('admin/spoilages')?>">
            <p>All Spoilages</p>
        </a>
        <a href="<?= site_url('admin/addons/spoilages')?>">
            <p>Add Ons Spoilages</p>
        </a>
        <a href="<?= site_url('admin/menu/spoilages')?>">
            <p>Menu Spoilages</p>
        </a>
        <a href="<?= site_url('admin/stock/spoilages')?>">
            <p>Stock Spoilages</p>
        </a>
    </div>
    <button class="dropdown-btn">Transactions
        <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-container">
        <a href="<?= site_url('admin/transactions')?>">
            <p>Purchased Order</p>
        </a>
        <a href="<?= site_url('admin/transactions')?>">
            <p>Transactions</p>
        </a>
    </div>
    <a href="<?= site_url('admin/sources') ?>">
        <p>Sources</p>
    </a>
    <button class="dropdown-btn">Menu Items
        <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-container">
        <a href="<?= site_url('admin/menuspoilages')?>">
            <p>All</p>
        </a>
        <a href="<?= site_url('admin/discounts')?>">
            <p>Discounts</p>
        </a>
        <a href="<?= site_url('admin/addOns')?>">
            <p>Add Ons</p>
        </a>
        <a href="<?= site_url('admin/categories')?>">
            <p>Categories</p>
        </a>
    </div>
    <a href="<?= site_url('admin/tables') ?>">
        <p>Tables</p>
    </a>
    <a href="<?= site_url('admin/accounts') ?>">
        <p>User Accounts</p>
    </a>
    <a href="<?= site_url('admin/reports') ?>">
        <p>Reports</p>
    </a>
    </div>
 
</div>

<script>
/* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
var dropdown = document.getElementsByClassName("dropdown-btn");
var i;

for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
  this.classList.toggle("active");
  var dropdownContent = this.nextElementSibling;
  if (dropdownContent.style.display === "block") {
  dropdownContent.style.display = "none";
  } else {
  dropdownContent.style.display = "block";
  }
  });
}
</script>

</body>
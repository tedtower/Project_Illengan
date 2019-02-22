
<!DOCTYPE html>
<html>
	<head>
		<?php include_once('head.php') ?>
		<title>Menu</title>
	</head>
<body>
		

<!-- SHOW MEALS FROM DATABASE --->
<h4>MEALS</h4>
<?php 
	foreach ($meals as $key => $value) {
        $menu_id = $value['menu_id'];
        $menu_name = $value['menu_name'];
        $menu_description = $value['menu_description'];
        $menu_price = $value['menu_price'];

?> 
<div class="d-flex flex-wrap">
<!-- Card -->
<div class="card cd-mw">
  <!-- Card image -->
    <a data-toggle="modal" href="#view<?php echo $menu_id; ?>">
      <img class="card-img-top" src="media/card.jpeg" alt="Name of the Product">
    </a>
  <!-- Card content -->
  <div class="card-body p-0 m-0 gabriola">
    <!-- Title -->
    <p class="text-truncate float-left menu-title" id="mt"><?php echo $menu_name ?></p>
    <p class="float-right menu-price" id="mp"><?php echo $menu_price ?></p>
  </div>
</div>
<!-- Card -->
</div> <!-- ENDING TAG FOR D-FLEX -->
 
<!-- Card group -->

<!-- Modal -->
<div class="modal fade" id="view<?php echo $menu_id; ?>" tabindex="-1" role="dialog" aria-labelledby="menuItemModal" aria-hidden="true">
<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
  <div class="modal-content" style="padding:0px;">
    <!-- Modal Body -->
    <div class="modal-body">
        <!-- Menu Image -->
        <img class="w-100" src="media/card.jpeg" alt="Menu Item Name">
        <!-- Title And Price -->
        <div class="d-flex justify-content-between gabriola rp-title">
            <span><?php echo $menu_name ?></span>
            <span><?php echo $menu_price ?></span>
        </div>
        <!-- Description -->
        <p class="p-ti"><?php echo $menu_description ?></p>
        <hr>
        <!-- Order Form -->
        <h3>Order Details</h3>
        <div class="input-group mb-3">
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
              <button class="btn btn-md btn-blue-grey m-0 px-3 py-2 z-depth-0" type="button" data-quantity="minus" data-field="quantity">
                  <i class="fa fa-minus" aria-hidden="true"></i>
              </button>
              <input type="text" class="form-control" name="quantity" id="quantity" value="1">
              <button class="btn btn-md btn-blue-grey m-0 px-3 py-2 z-depth-0" type="button" data-quantity="plus" data-field="quantity">
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
<?php } ?>

<!-- SHOW SNACKS FROM DATABASE -->
<h4>SNACKS</h4>
<?php 
	foreach ($snacks as $key => $value) {
        $menu_id = $value['menu_id'];
        $menu_name = $value['menu_name'];
        $menu_description = $value['menu_description'];
        $menu_price = $value['menu_price'];

?> 
<div class="d-flex flex-wrap">
<!-- Card -->
<div class="card cd-mw">
  <!-- Card image -->
    <a data-toggle="modal" href="#view<?php echo $menu_id; ?>">
      <img class="card-img-top" src="media/card.jpeg" alt="Name of the Product">
    </a>
  <!-- Card content -->
  <div class="card-body p-0 m-0 gabriola">
    <!-- Title -->
    <p class="text-truncate float-left menu-title" id="mt"><?php echo $menu_name ?></p>
    <p class="float-right menu-price" id="mp"><?php echo $menu_price ?></p>
  </div>
</div>
<!-- Card -->
</div> <!-- ENDING TAG FOR D-FLEX -->
 
<!-- Card group -->

<!-- Modal -->
<div class="modal fade" id="view<?php echo $menu_id; ?>" tabindex="-1" role="dialog" aria-labelledby="menuItemModal" aria-hidden="true">
<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
  <div class="modal-content" style="padding:0px;">
    <!-- Modal Body -->
    <div class="modal-body">
        <!-- Menu Image -->
        <img class="w-100" src="media/card.jpeg" alt="Menu Item Name">
        <!-- Title And Price -->
        <div class="d-flex justify-content-between gabriola rp-title">
            <span><?php echo $menu_name ?></span>
            <span><?php echo $menu_price ?></span>
        </div>
        <!-- Description -->
        <p class="p-ti"><?php echo $menu_description ?></p>
        <hr>
        <!-- Order Form -->
        <h3>Order Details</h3>
        <div class="input-group mb-3">
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
              <button class="btn btn-md btn-blue-grey m-0 px-3 py-2 z-depth-0" type="button" data-quantity="minus" data-field="quantity">
                  <i class="fa fa-minus" aria-hidden="true"></i>
              </button>
              <input type="text" class="form-control" name="quantity" id="quantity" value="1">
              <button class="btn btn-md btn-blue-grey m-0 px-3 py-2 z-depth-0" type="button" data-quantity="plus" data-field="quantity">
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
<?php } ?>

<!-- SHOW DRINKS FROM DATABASE -->
<h4>DRINKS</h4>
<?php 
	foreach ($drinks as $key => $value) {
        $menu_id = $value['menu_id'];
        $menu_name = $value['menu_name'];
        $menu_description = $value['menu_description'];
        $menu_price = $value['menu_price'];

?> 
<div class="d-flex flex-wrap menu<?php echo $menu_id; ?>">
<!-- Card -->
<div class="card cd-mw">
  <!-- Card image -->
    <a data-toggle="modal" href="#view<?php echo $menu_id; ?>">
      <img class="card-img-top" src="media/card.jpeg" alt="Name of the Product">
    </a>
  <!-- Card content -->
  <div class="card-body p-0 m-0 gabriola">
    <!-- Title -->
    <p class="text-truncate float-left menu-title" id="mt"><?php echo $menu_name ?></p>
    <p class="float-right menu-price" id="mp"><?php echo $menu_price ?></p>
  </div>
</div>
<!-- Card -->
</div> <!-- ENDING TAG FOR D-FLEX -->
 
<!-- Card group -->

<!-- Modal -->
<div class="modal fade" id="view<?php echo $menu_id; ?>" tabindex="-1" role="dialog" aria-labelledby="menuItemModal" aria-hidden="true">
<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
  <div class="modal-content" style="padding:0px;">
    <!-- Modal Body -->
    <div class="modal-body">
        <!-- Menu Image -->
        <img class="w-100" src="media/card.jpeg" alt="Menu Item Name">
        <!-- Title And Price -->
        <div class="d-flex justify-content-between gabriola rp-title">
            <span><?php echo $menu_name ?></span>
            <span><?php echo $menu_price ?></span>
        </div>
        <!-- Description -->
        <p class="p-ti"><?php echo $menu_description ?></p>
        <hr>
        <!-- Order Form -->
        <h3>Order Details</h3>
        <div class="input-group mb-3">
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
              <button class="btn btn-md btn-blue-grey m-0 px-3 py-2 z-depth-0" type="button" data-quantity="minus" data-field="quantity">
                  <i class="fa fa-minus" aria-hidden="true"></i>
              </button>
              <input type="text" class="form-control" name="quantity" id="quantity" value="1">
              <button class="btn btn-md btn-blue-grey m-0 px-3 py-2 z-depth-0" type="button" data-quantity="plus" data-field="quantity">
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
<?php } ?>
    <a href="index.php/main/next_page"><h1>HHAHAHAHAHHA</h1></a>
  <?php include_once('scripts.php') ?>
</body>
</html>

<!---------------------------------------------------->
<!DOCTYPE html>
<html>

<head>
	<?php include_once('head.php') ?>
	<title>Menu</title>
</head>

<body>


	<!-- SHOW MEALS FROM DATABASE --->
	<h4>MEALS</h4>
	<?php foreach ($meals as $row): ?>


	<div class="d-flex flex-wrap">
		<!-- Card -->
		<div class="card cd-mw">
			<!-- Card image -->
			<!-- Card content -->
			<div class="card-body p-0 m-0 gabriola">
				
				<p class="text-truncate float-left menu-title" id="mt">
					<?php echo $row->menu_name; ?>
				</p>
				<p class="float-right menu-price" id="mp">
					<?php echo $row->menu_price; ?>
				</p>
			</div>
	  <?php echo form_open('index.php/customer/add'); ?>
      <?php echo form_hidden('id', $row->menu_id ); ?>
      <?php echo form_hidden('name', $row->menu_name ); ?>
      <?php echo form_hidden('price', $row->menu_price ); ?>
	  
      <?php echo form_submit('action', 'Add to Cart'); ?>
      <?php echo form_close(); ?>
		</div>
		<!-- Card -->
	</div> <!-- ENDING TAG FOR D-FLEX -->

<?php endforeach; ?>


	<a href="index.php/main/next_page">
		<h1>HHAHAHAHAHHA</h1>
	</a>
	<?php include_once('scripts.php') ?>
</body>


</html>
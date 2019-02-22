<div class="d-inline-flex px-4 animated flipInX slow subcategory mb-2 delius">
        <h5>Subcategory 1</h5>
    </div>
<br/>
<div class="row">

<!--------------------------------------------------------------------------------------------------------->
<div class="col-md-4"> <!--Subcategory w/ Cards-->
   

	<!-- MENU ITEMS -->
  <!-- MEALS -->
	<?php foreach ($meals as $row): ?>
    <!-- Card group -->
    <div class="d-flex flex-wrap">
      <!-- Card -->
      <div class="card cd-mw">
        <!-- Card image -->
          <a data-toggle="modal" href="#view<?php echo $row->menu_id; ?>">
			<?php echo img(array(
				'src' => 'img/' . $row->menu_image,
				'class' => 'card-img-top',
				'alt' => '$row->menu_name'
			)); ?>
          </a>
        <!-- Card content -->
        <div class="card-body p-0 m-0 gabriola">
          <!-- Title -->
          <p class="text-truncate float-left menu-title" id="mt"><?php echo $row->menu_name; ?></p>
          <p class="float-right menu-price" id="mp"><span class="fs-15">₱</span><?php echo $row->menu_price; ?></p>
        </div>
      </div>
  </div>
  

  <!-- Sizable Modal -->
  <div class="modal fade" id="view<?php echo $row->menu_id; ?>" tabindex="-1" role="dialog" aria-labelledby="menuItemModal" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content" style="padding:0px;">
        <!-- Modal Body -->
        <form method="post" action="<?php echo base_url() ?>index.php/customer/add">
        <div class="modal-body">
            <!-- Menu Image -->
            <?php echo img(array(
				    'src' => 'img/' . $row->menu_image,
				    'class' => 'card-img-top',
				    'alt' => '$row->menu_name'
		        	)); ?>
            <!-- Title And Price -->
            <div class="d-flex justify-content-between gabriola rp-title">
                <p><?php echo $row->menu_name; ?></p>
                <p><span class="fs-24">₱</span><?php echo $row->menu_price; ?></p>
            </div>
            <!-- Description -->
            <p class="p-ti">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Sit amet commodo nulla facilisi nullam.</p>
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
                  <button class="btn btn-md btn-brown m-0 px-3 py-2 z-depth-0" type="button" data-quantity="minus" data-field="quantity">
                      <i class="fa fa-minus" aria-hidden="true"></i>
                  </button>
                  <input type="text" class="form-control" name="quantity" id="quantity" value="1">
                  <button class="btn btn-md btn-brown m-0 px-3 py-2 z-depth-0" type="button" data-quantity="plus" data-field="quantity">
                      <i class="fa fa-plus" aria-hidden="true"></i>
                  </button>
                </div>
              </div>
            </div>
        </div>
        <div class="modal-footer">
		<button type="button" class="btn btn-outline-dark-green" data-dismiss="modal">Close</button>
      	<?php echo form_hidden('id', $row->menu_id ); ?>
      	<?php echo form_hidden('name', $row->menu_name ); ?>
      	<?php echo form_hidden('price', $row->menu_price ); ?>
		  <?php
				$btn = array(
					'class' => 'btn btn-dark-green',
					'value' => 'Save To Order List',
					'name' => 'action'
					);

					// Submit Button.
					echo form_submit($btn);
					echo form_close();
			?>
			
        </div>
      </div>
    </div>
  </div>
  <?php endforeach; ?>
        </div>

<!--------------------------------------------------------------------------------------------------------->
    <!-- SNACKS ITEMS -->
  <div class="col-md-4">
	<?php foreach ($snacks as $row): ?>
    <!-- Card group -->
    <div class="d-flex flex-wrap">
      <!-- Card -->
      <div class="card cd-mw">
        <!-- Card image -->
          <a data-toggle="modal" href="#view<?php echo $row->menu_id; ?>">
			<?php echo img(array(
				'src' => 'img/' . $row->menu_image,
				'class' => 'card-img-top',
				'alt' => '$row->menu_name'
			)); ?>
          </a>
        <!-- Card content -->
        <div class="card-body p-0 m-0 gabriola">
          <!-- Title -->
          <p class="text-truncate float-left menu-title" id="mt"><?php echo $row->menu_name; ?></p>
          <p class="float-right menu-price" id="mp"><span class="fs-15">₱</span><?php echo $row->menu_price; ?></p>
        </div>
      </div>
  </div>

  <!-- Sizable Modal -->
  <div class="modal fade" id="view<?php echo $row->menu_id; ?>" tabindex="-1" role="dialog" aria-labelledby="menuItemModal" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content" style="padding:0px;">
        <!-- Modal Body -->
        <form method="post" action="<?php echo base_url() ?>index.php/customer/add">
        <div class="modal-body">
            <!-- Menu Image -->
            <?php echo img(array(
				    'src' => 'img/' . $row->menu_image,
				    'class' => 'card-img-top',
				    'alt' => '$row->menu_name'
		        	)); ?>
            <!-- Title And Price -->
            <div class="d-flex justify-content-between gabriola rp-title">
                <p><?php echo $row->menu_name; ?></p>
                <p><span class="fs-24">₱</span><?php echo $row->menu_price; ?></p>
            </div>
            <!-- Description -->
            <p class="p-ti">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Sit amet commodo nulla facilisi nullam.</p>
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
                  <button class="btn btn-md btn-brown m-0 px-3 py-2 z-depth-0" type="button" data-quantity="minus" data-field="quantity">
                      <i class="fa fa-minus" aria-hidden="true"></i>
                  </button>
                  <input type="text" class="form-control" name="quantity" id="quantity" value="1">
                  <button class="btn btn-md btn-brown m-0 px-3 py-2 z-depth-0" type="button" data-quantity="plus" data-field="quantity">
                      <i class="fa fa-plus" aria-hidden="true"></i>
                  </button>
                </div>
              </div>
            </div>
        </div>
        <div class="modal-footer">
		<button type="button" class="btn btn-outline-dark-green" data-dismiss="modal">Close</button>
      	<?php echo form_hidden('id', $row->menu_id ); ?>
      	<?php echo form_hidden('name', $row->menu_name ); ?>
      	<?php echo form_hidden('price', $row->menu_price ); ?>
		  <?php
				$btn = array(
					'class' => 'btn btn-dark-green',
					'value' => 'Save To Order List',
					'name' => 'action'
					);

					// Submit Button.
					echo form_submit($btn);
					echo form_close();
			?>
			
        </div>
      </div>
    </div>
  </div>
  <?php endforeach; ?>
        </div>
  <!--------------------------------------------------------------------------------------------------------->
  <div class="col-md-4">  
  <!-- SNACKS ITEMS -->
	<?php foreach ($drinks as $row): ?>
    <!-- Card group -->
    <div class="d-flex flex-wrap">
      <!-- Card -->
      <div class="card cd-mw">
        <!-- Card image -->
          <a data-toggle="modal" href="#view<?php echo $row->menu_id; ?>">
			<?php echo img(array(
				'src' => 'img/' . $row->menu_image,
				'class' => 'card-img-top',
				'alt' => '$row->menu_name'
			)); ?>
          </a>
        <!-- Card content -->
        <div class="card-body p-0 m-0 gabriola">
          <!-- Title -->
          <p class="text-truncate float-left menu-title" id="mt"><?php echo $row->menu_name; ?></p>
          <p class="float-right menu-price" id="mp"><span class="fs-15">₱</span><?php echo $row->menu_price; ?></p>
        </div>
      </div>
  </div>

  <!-- Sizable Modal -->
  <div class="modal fade" id="view<?php echo $row->menu_id; ?>" tabindex="-1" role="dialog" aria-labelledby="menuItemModal" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content" style="padding:0px;">
        <!-- Modal Body -->
        <form method="post" action="<?php echo base_url() ?>index.php/customer/add">
        <div class="modal-body">
            <!-- Menu Image -->
            <?php echo img(array(
				    'src' => 'img/' . $row->menu_image,
				    'class' => 'card-img-top',
				    'alt' => '$row->menu_name'
		        	)); ?>
            <!-- Title And Price -->
            <div class="d-flex justify-content-between gabriola rp-title">
                <p><?php echo $row->menu_name; ?></p>
                <p><span class="fs-24">₱</span><?php echo $row->menu_price; ?></p>
            </div>
            <!-- Description -->
            <p class="p-ti">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Sit amet commodo nulla facilisi nullam.</p>
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
                  <button class="btn btn-md btn-brown m-0 px-3 py-2 z-depth-0" type="button" data-quantity="minus" data-field="quantity">
                      <i class="fa fa-minus" aria-hidden="true"></i>
                  </button>
                  <input type="text" class="form-control" name="quantity" id="quantity" value="1">
                  <button class="btn btn-md btn-brown m-0 px-3 py-2 z-depth-0" type="button" data-quantity="plus" data-field="quantity">
                      <i class="fa fa-plus" aria-hidden="true"></i>
                  </button>
                </div>
              </div>
            </div>
        </div>
        <div class="modal-footer">
		<button type="button" class="btn btn-outline-dark-green" data-dismiss="modal">Close</button>
      	<?php echo form_hidden('id', $row->menu_id ); ?>
      	<?php echo form_hidden('name', $row->menu_name ); ?>
      	<?php echo form_hidden('price', $row->menu_price ); ?>
		  <?php
				$btn = array(
					'class' => 'btn btn-dark-green',
					'value' => 'Save To Order List',
					'name' => 'action'
					);

					// Submit Button.
					echo form_submit($btn);
					echo form_close();
			?>
			
        </div>
      </div>
    </div>
  </div>
  <?php endforeach; ?>
        </div>

<!--------->
        </div>
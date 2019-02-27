<?php include_once('head.php') ?>
<div class="col-md-1">
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
    <?php endforeach;?>
  </div>
  <div style="height:1500px;"></div>
  <!-- SCRIPTS --
  <!-- JQuery -->
  <?php include_once('scripts.php') ?>
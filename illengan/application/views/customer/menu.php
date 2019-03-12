<!-- Category -->
    <div class="text-center gab py-0 my-0">
        <h1>Menu</h1>
    </div>
    <?php foreach($subcats as $subcategories){ ?>
    <!-- Subcategory -->
    <div class="d-inline-flex px-4 animated flipInX slow subcategory mb-2 delius">
        <h5><?php echo $subcategories->category_name; ?></h5>
    </div>

    <!-- Card group -->
    <div class="d-flex flex-wrap mb-4">
        <?php foreach($menu as $items) {
            if($subcategories->category_name == $items->category_name){ ?> 
                <!-- Card -->
                <div class="card cd-mw">
                <!-- Card image -->
                <a href="javascript:void(0)" class="menu_card" id="<?php echo $items->menu_id; ?>">
                    <img class="card-img-top" src="<?php
                        if(isset($items->menu_image)){
                            echo "".cmedia_url()."menu/".$items->menu_image;
                        } else {
                            echo "".cmedia_url()."menu/no_image.jpg";
                        }
                    ?>">
                </a>
                <!-- Card content -->
                <div class="card-body p-0 m-0 gab">
                    <!-- Title -->
                    <p class="text-truncate float-left menu-title" id="mt"><?php echo $items->menu_name; ?></p>
                    <p class="float-right menu-price" id="mp"><span class="fs-15">₱</span><?php echo $items->size_price; ?></p>
                </div>
        </div>
        <?php }} ?> 
    </div>
    <?php } ?>
    
    <?php include 'modals/menu_modal.php'; ?>
    <?php include 'modals/order_modal.php'; ?>



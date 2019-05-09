<?php include_once('session.php')?>
<!-- Category -->
<div class="text-center gab py-0 my-0">
    <h1 class="mt-2" id="main_category">Menu</h1>
</div>


<?php foreach($subcats as $subcategories){ ?>
<div class="menu_box">
    <!-- Subcategory -->
    <div class="d-inline-flex px-4 animated flipInX slow subcategory mb-2 delius">
        <h5 class="subcategory_label"><?php echo $subcategories->ctName; ?></h5>
    </div>
    <!-- Card group -->
    <div class="d-flex flex-wrap mb-4 menu_group">
        <?php foreach($menu as $items) {
            if($subcategories->ctName == $items->ctName){ ?>
                <!-- Card -->
                <div class="card cd-mw" id="<?php echo $items->mID; ?>">
                    <span class="indicate_promo <?php echo $items->mID; ?>" style="position:absolute;right:0;top:0"><img style="width:60px;" src="<?php echo base_url('/assets/media/customer/banner.png')?>"></span>
                    <!-- Card image -->
                    <a href="javascript:void(0)" onclick="hide_freebies();freebies_discounts()" class="menu_card" id="<?php echo $items->mID; ?>">
                        <img data-mID="<?php echo $items->mID; ?>" class="card-img-top" src="
                        <?php
                            if(isset($items->menu_image)){
                                echo "".cmedia_url()."menu/".$items->mImage;
                            } else {
                                echo "".cmedia_url()."menu/no_image.jpg";
                            }
                        ?>">
                    </a>
                    <!-- Card content -->
                    <div class="card-body p-0 m-0 gab">
                        <!-- Title -->
                        <p class="text-truncate float-left menu-title" id="mt"><?php echo $items->mName; ?></p>
                        <p class="float-right menu-price" id="mp"><span class="fs-15">₱</span><?php echo $items->prPrice; ?></p>
                    </div>
                </div>
        <?php }} ?>
    </div>
</div>

<?php } ?>

<?php include 'modals/menu_modal.php'; ?>
<?php include 'modals/order_modal.php'; ?>

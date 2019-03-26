<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="wrapper">
    <div class="sidebar" data-color="brown" data-image="<?php echo site_url('assets/media/barista/Coffee_1.jpg')?>">
        <!--Left Navigation Bar-->
            <div class="sidebar-wrapper" style="overflow: hidden">
                <div class="logo">
                    <img src="<?php echo site_url('assets/media/barista/logo_lg.png')?>" alt="il-lengan-logo" style="img-align:center; width: 225px;
                        height:135px">
                </div>

                <ul class="nav">
                    <li class="active">
                        <a href="<?php echo site_url('barista/orders')?>">
                            <p>Orders</p>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('barista/billings')?>">
                            <p>Billings</p>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('barista/baristaInventory')?>">
                            <p>Inventory</p>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('barista/baristaNotifcations')?>">
                            <p>Notifcations</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <!--End Side Bar-->
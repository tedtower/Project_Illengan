<!--
<div class="nav nav-tabs"><a href="" class="nav nav-link" role="tab">Orderlist</a> &nbsp;
            <a href="<?php echo site_url('barista/pendingOrders'); ?>" class="nav nav-link active" role="tab">Pending Orders</a> &nbsp;
            <a href="<?php echo site_url('barista/servedOrders'); ?>" class="nav nav-link" role="tab">Served Orders</a>
            <a href="<?php echo site_url('barista/vieworderslip'); ?>" class="nav nav-link" role="tab">Orderslip</a>
</div>-->

<ul class="nav nav-tabs justify-content-center">
  <li class="nav-item">
    <a class="nav-link active" href="<?php echo site_url('barista/orders'); ?>">Orderlist</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="<?php echo site_url('barista/pendingOrders'); ?>">Pending Orders</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="<?php echo site_url('barista/servedOrders'); ?>">Served Orders</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="<?php echo site_url('barista/vieworderslip'); ?>">Orderslip</a>
  </li>
</ul>
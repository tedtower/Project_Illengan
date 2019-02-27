<div class="modal fade" id="vieworders" tabindex="-1" role="dialog" aria-labelledby="menuItemModal" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content" style="padding:0px;">
      <div class="modal-header">
      <h4>Ordered Menu Items</h4>
</div>
        <!-- Modal Body -->
        <div class="modal-body">
        <form method="post" action="<?php echo base_url() ?>index.php/customer/save_order">
        <input type="text" class="form-control" name="customer_name" id="customer_name" placeholder="Customer Name"
        required style="width: 20%;">
        <input type="text" class="form-control" name="table_no" id="table_no" placeholder="Table Number"
        required style="width: 20%; right: 0;">
       <br/>
          <?php $cart_check = $this->cart->contents();
          if(empty($cart_check)) {
            echo 'To order menu items click on "Add to Order" Button';
          } else {
          ?>
      <table id="table" class=" table table-striped orders" border="0" cellpadding="5px" cellspacing="1px">
          <tbody>
          <tr>
          <th>Item Name</th>
          <th>Quantity</th>
          <th>Price</th>
          <th>Subtotal</th>
          <th>Actions</th>
          </tr>
          <?php 
          $total_qty=0;
          foreach ($cart as $carts): ?>
          <tr>
          <td><?php echo $carts['name']; echo form_hidden($carts['id']); ?></td>
          <td><?php echo $carts['qty']?></td>
          <td><?php echo number_format($carts['price'],2) ?></td>
          <td><?php echo number_format($carts['subtotal'], 2) ?></td>
          <?php $total_qty += $carts['qty']?>
          <td>
          <a href="index.php/customer/remove/<?php echo $carts['rowid'] ?>">
          <button class="btn-danger btn">Remove</button></a>
          </td>
          </tr>
          <tr>
          <td><b>Order total:</b></td>
          <td><b><?php echo $total_qty; ?></b></td>
          <td><b>TOTAL</b></td>
          <td><b>
          <?php $total= $this->cart->total();
                    echo number_format($total, 2); ?></b></td>
          <td></td>
          <td></td>
          </tr>
          </tbody>
      </table>
            <?php
            echo form_hidden($total_qty);
            echo form_hidden($total);
            
         
            ?>

          <?php endforeach;} ?>
        </div>
        <div class="modal-footer">
		      <button type="button" class="btn btn-outline-dark-green" data-dismiss="modal">Close</button>
		  <?php
				$btn = array(
					'class' => 'btn btn-dark-green',
					'value' => 'Order',
          'name' => 'action',
          'type' => 'submit'
					);

					// Submit Button.
					echo form_submit($btn);
          echo form_close();
        
			?>
        </div>

      </div>
    </div>
  </div>

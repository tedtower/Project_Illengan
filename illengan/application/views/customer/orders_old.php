<div class="modal fade" id="vieworders" tabindex="-1" role="dialog" aria-labelledby="menuItemModal" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content" style="padding:0px;">
      <div class="modal-header">
      <h4>Ordered Menu Items</h4>
</div>
        <!-- Modal Body -->
        <div class="modal-body">
        <form method="post" action="<?php echo base_url();?>index.php/customer/save_order">
        <?php 
        $cust_name = $this->session->userdata('cust_name');
         $table_no = $this->session-> userdata('table_no');
         ?>
		<strong>Customer Name:</strong><?php echo $cust_name;?>
		<br>
		<strong>Table Number: </strong><?php echo $table_no?>
       <br/>
          <?php $cart_check = $this->cart->contents();
          if(empty($cart_check)) { //check if the customer did not order yet
            echo 'To order menu items click on "Add to Order" Button';
            ?>
            <div class="modal-footer">
            <button type="button" class="btn btn-outline-dark-green" data-dismiss="modal">Close</button>
          </div>
          <?php
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
          $i=1;
          $cart = $this->cart->contents();
		  $total= $this->cart->total();
          foreach ($cart as $item): 
            ?>
          <tr>
			  <?php echo form_hidden($i.'[rowid]', $item['rowid']); echo form_hidden($item['id']);?>
			  <td><?php echo $item['name']; ?></td>
			  <td><?php echo $item['qty']?></td>
			  <td><?php echo number_format($item['price'],2) ?></td>
			  <td><?php $subtotal = $item['qty']* $item['price']; //computation of each menu item
					echo number_format($subtotal, 2) ?>
			  </td>
			  <td>
				<a href="<?php echo base_url('index.php/customer/remove/'.$item['rowid']);?>"
				<button class="btn-danger btn">Remove</button></a></td>
			  </td>
          </tr>
          <?php 
          $total_qty += $item['qty'];
		  $i++;
          endforeach;
          ?>
          <tr>
          <td><b>Order total:</b></td>
          <td><b><input type="text" value="<?php echo $total_qty;?>"name="total_qty" id="total_qty" readonly/></b></td>
          <td><b>TOTAL</b></td>
          <td><b>
          <input type="text" value="<?php echo number_format($total, 2);?>" name="total" id ="total" readonly/></b></td>
          <td></td>
          <td></td>
          </tr>
          </tbody>
          </table>
		  <div class="modal-footer">
		      <button type="button" class="btn btn-outline-dark-green" data-dismiss="modal">Close</button>
				<input class="btn btn-dark-green" type="submit" value="Save">
				<?php 
				echo form_close();
				}
				?>
        </div>
        </div>
      </div>
    </div>
  </div>

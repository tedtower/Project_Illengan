<div class="modal fade" id="vieworders" tabindex="-1" role="dialog" aria-labelledby="menuItemModal" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content" style="padding:0px;">
      <div class="modal-header">
      <h4>Ordered Menu Items</h4>
</div>
        <!-- Modal Body -->
        <div class="modal-body">
        <input type="text" class="form-control" name="customer_name" id="customer_name" placeholder="Customer Name"
        style="width: 20%;">
        <input type="text" class="form-control" name="table_no" id="table_no" placeholder="Table Number"
        style="width: 20%; right: 0;">
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
          <?php foreach ($cart as $carts): ?>
          <tr>
          <td><?php echo $carts['name'] ?></td>
          <td><?php echo $carts['qty'] ?></td>
          <td><?php echo $carts['price'] ?></td>
          <td><?php echo $carts['subtotal'] ?></td>
          <td>
          <a href="index.php/customer/remove/<?php echo $carts['rowid'] ?>"><button class="btn-danger btn">
          Remove</button></a>
          </td>
              </tr>
          <?php endforeach; ?>
          <tr>
          <td></td>
          <td></td>
          <td><b>TOTAL</b></td>
          <td><b><?php echo $this->cart->total(); ?></b></td>
          </tr>
          </tbody>
      </table>
          <?php } ?>
        </div>
        <div class="modal-footer">
		      <button type="button" class="btn btn-outline-dark-green" data-dismiss="modal">Close</button>
        </div>

      </div>
    </div>
  </div>

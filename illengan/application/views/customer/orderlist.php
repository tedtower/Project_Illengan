<div class="modal fade" id="vieworders" tabindex="-1" role="dialog" aria-labelledby="menuItemModal" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content" style="padding:0px;">
      <div class="modal-header">
      <h4>Ordered Menu Items</h4>
</div>
        <!-- Modal Body -->
        <div class="modal-body">
       <?php echo form_open("index.php/customer/ordered")?>
        <table>
        <tbody>
        <tr>
          <th>Item ID</th>
          <th>Item Name</th>
          <th>Quantity</th>
          <th>Price</th>
          <th>Subtotal</th>
        </tr>
        <?php
        $cust_name = $this->session->userdata('cust_name');
        $table_no = $this->session-> userdata('table_no'); 
        
        $cart_check = $this->cart->contents();
		$order_num=1; //stands for how many times the customer ordered -- order_id
        $total_qty=0; //total menu items ordered
		$i=0;
		?>
        <h3>
		<?php 
			echo 'Customer Name:&nbsp'.$cust_name; 
			echo '<br>';
			echo 'Table Number:&nbsp'.$table_no;
			echo '<br>';
			echo 'Order Slip No.:&nbsp'.$order_num++;
		?>
		</h3>
         <?php foreach ($cart_check as $carts):
          ?>
          <tr>
          <td><?php echo $carts['id']?></td>
          <td><?php echo $carts['name']?></td>
          <td><?php echo $carts['qty']?></td>
          <td><?php echo $carts['price']?></td>
          <td><?php echo $carts['subtotal']?></td>
          </tr>
          <tr>
        
        <?php
         $total_qty += $carts['qty']; //computation for total menu items
         endforeach;
         $i++; //unknown function
         echo
         '<tr>
         <th>Total Quantity</th><td>'.$total_qty.'</td></tr><tr>';
		 $total= $this->cart->total();
         if($total != NULL){ //total amount to be payed
          echo '<th>Total Amount Payable</th><td>'. $total.'</td></tr>';
         }else{
           echo '';
         }
        ?>
        </tbody>
        </table>
        <input type="submit" value="Save" >
        <button><?php echo anchor('index.php/customer/view_menu', 'Back')?></button>
          <?php echo form_close();?>
  </div>

<div class="modal fade" id="vieworders" tabindex="-1" role="dialog" aria-labelledby="menuItemModal" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content" style="padding:0px;">
      <div class="modal-header">
      <h4>Ordered Menu Items</h4>
</div>
        <!-- Modal Body -->
        <div class="modal-body">
       <?php 
	   $cust_name = $this->session->userdata('cust_name');
        $table_no = $this->session-> userdata('table_no'); 
		?>
		<form method="post" action="<?php echo base_url();?>index.php/customer/ordered">
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
        $cart_check = $this->cart->contents();
        $total_qty=0; //total menu items ordered
		?>
        <h3>
		<?php
			echo form_hidden('cust_name',$cust_name);
			echo form_hidden('table_no',$table_no);
			echo 'Customer Name:&nbsp'.$cust_name; 
			echo '<br>';
			echo 'Table Number:&nbsp'.$table_no;
			date_default_timezone_set('Asia/Manila'); # add your city to set local time zone
			$now = date('Y-m-d');
			echo '<br>Date:&nbsp'.$now;
			echo form_hidden('date', $now);
		?>
		</h3>
         <?php
			$i=1;
			 foreach ($cart_check as $carts):
          ?>
          <tr>
          <td><?php echo $carts['id'];?></td>
          <td><?php echo $carts['name']?></td>
          <td><?php echo $carts['qty']?></td>
          <td><?php echo $carts['price']?></td>
          <td><?php echo $carts['subtotal']?></td>
          </tr>
          <tr>
        <?php
			$i++;
			 endforeach;
			 $total_qty += $carts['qty']; //computation for total menu items
			 '<tr>
			 <th>Total Quantity</th><td>'.$total_qty.'</td>
			 </tr>
			 <tr>';
			 $total= $this->cart->total();
			 echo form_hidden('total', $total);
			 if($total != NULL){ //total amount to be payed
			  echo '<th>Total Amount Payable</th><td>'. $total.'</td></tr>';
			 }else{
			   echo '';
			 }
        ?>
        </tbody>
        </table>
        <input type="submit" value="Save" >
		 <?php 
		 echo form_close();?>
  </div>
 </div>
 <a href="<?php echo base_url();?>index.php/customer/view_menu"><button>Back</button></a>
 </div>
 </div>

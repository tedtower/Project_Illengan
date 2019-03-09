<h4>Order Slip</h4>
<table border="2">
		<tbody>
		<tr>
			<th>Customer Name</th>
			<th>Amount Payable</th>
			<th>Order Date</th>
			<th>Table Number</th>
		</tr>   
		<?php 
			$i=1;
			foreach($ordered as $data){		
		?>	
		
		<tr>
			<td><?php echo $data['cust_name'];?></td>
			<td><?php echo $data['order_payable'];?></td>
			<td><?php echo $data['order_date'];?></td>
			<td><?php echo $data['table_code'];?></td>
		</tr>
		<?php 
			$i++; 
			}
		?>
		</tbody>
		</table>
		
 <a href="<?php echo base_url();?>index.php/customer/view_menu"><button>Back</button></a>

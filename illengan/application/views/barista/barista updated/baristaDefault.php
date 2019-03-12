<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<?php include_once('head.php') ?>
</head>
<body>
<?php include_once('sideNavigation.php') ?>
<div class="content">

	<table id="mydata" class="table table-striped">

	<thead>
	<th>Order No.</th>
	<th>Table No.</th>
	<th>Customer Name</th>
	<th>Item</th>
	<th>Quantity</th>
	<th>Action</th>
	</thead>
	
	<tbody id="show_data">
	<tfoot>
	<?php foreach($orderlist as $row) { ?>
	
		<tr class="table-row" data-toggle="modal" data-href="#order_details<?php echo $row->order_id; ?>"
		data-menu_id="<?php echo $row->menu_id ?>" data-order_id="<?php echo $row->order_id ?>" 
		data-item_status="<?php echo $row->item_status ?>">
		<td><?php echo $row->order_id ?></td>
		<td><?php echo $row->table_no ?></td>
		<td><?php echo $row->cust_name ?></td>
		<td><?php echo $row->menu_name ?></td>
		<td><?php echo $row->order_qty ?></td>
		<form id="form" action="index.php/Chef/change_status" method="post">
		<td>
		<input type="hidden" name="order_id" value="<?php echo $row->order_id; ?>" />
		<?php echo form_hidden('item_status', $row->item_status ); ?>
		<?php echo form_hidden('menu_id', $row->menu_id ); ?>
		<button class="btn <?php echo $row->item_status ?> "><?php echo $row->item_status ?></button>
		</td>
		</form>
	</tr>
	</tfoot>
	<?php } ?>
	</tbody>
	</table>

</div>
 <?php include_once('scripts.php') ?>
</body>
</html>
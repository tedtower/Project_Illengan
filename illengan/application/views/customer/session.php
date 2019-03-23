<?php 

	$cust_name = $this->session->userdata('cust_name');
    $table_no = $this->session-> userdata('table_no');
?>
<h2>Welcome in Il-lengan Cafe <strong>
	<?php echo $cust_name;?></strong>
</h2> 
<br><strong>Table Code: <?php echo $table_no['table_code'];?></strong>
<h3><a href="<?php echo base_url('customer/logout')?>">Log out</a></h3>

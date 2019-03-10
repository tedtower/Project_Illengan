<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<html>
	<head>
		<title>Illengan</title>
	</head>
	<body>

		<h3>Welcome</h3>
		<?php echo isset($error) ? $error : ''; ?>
         <form method="post" action="<?php echo base_url();?>index.php/customer/process_login">
    		<table cellpadding="2" cellspacing="2">
    			<tr>
    				<td>Customer</td>
    				<td>
    					<input type="text" name="cust_name" required="required">
    				</td>
    			</tr>
    			<tr>
    				<td>Table number</td>
    				<td>
    					<input type="number" name="table_no" required="required">
    				</td>
    			</tr>
    			<tr>
    				<td>&nbsp;</td>
    				<td>
    					<input type="submit" value="Login">
    				</td>
    			</tr>
    		</table>

	</body>
</html>
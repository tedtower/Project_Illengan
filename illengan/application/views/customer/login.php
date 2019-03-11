<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<html>
	<head>
		<title>Illengan</title>
	</head>
	<?php include_once('head.php')?>
	<body>
		<img src="logo.png" style="height:120px;width:120px;">
		<h3>Welcome</h3>
		<?php echo isset($error) ? $error : ''; ?>
         <form method="post" action="<?php echo base_url();?>index.php/customer/process_login">
    		<div class="form-group">
				<div>	
    				<label>Customer</label>
    					<input type="text" name="cust_name" required="required">
    				
    			</div>
    			<div>
    				<label>Table number</label>
    					<input type="text" name="table_no" required="required">
    			</div>
    			<br>
					<div>
    					<input type="submit" class="btn btn-dark-green" value="Login">
					</div>
			</div>
		</form>
	</body>
</html>
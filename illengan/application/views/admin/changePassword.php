<!DOCTYPE html>
<html>
<head>
<title>Login Form</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro|Open+Sans+Condensed:300|Raleway' rel='stylesheet' type='text/css'>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url('application/css/frameworks/bootstrap.min.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('application/others/fonts/circular-std/style.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('application/css/admin/style.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('application/others/fonts/fontawesome/css/fontawesome-all.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('application/others/charts/chartist-bundle/chartist.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('application/others/charts/morris-bundle/morris.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('application/others/material-design-iconic-font/css/materialdesignicons.min.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('application/others/charts/c3charts/c3.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('application/others/fonts/flag-icon-css/flag-icon.min.css')?>">
</head>
<body>

<h2>Change Password</h2>
<br>

<form method="post" action="<?php echo base_url()?>index.php/admin/changeAccountPassword">
	<label for="formGroupExampleInput3">Old Password</label>
		<input type="password" class="form-control"  name="old_password" placeholder="Old Password" >
		<span class="text-danger"><?php echo form_error("old_password"); ?></span>
	</div>

	<div class="form-group">
		<label for="formGroupExampleInput4">New Password</label>
		<input type="password" class="form-control" name="new_password" placeholder="New Password" >
		<span class="text-danger"><?php echo form_error("new_password"); ?></span>
	</div>

	<div class="form-group">
		<label for="formGroupExampleInput3">Confirm Password</label>
		<input type="password" class="form-control"  name="new_password_confirmation" placeholder="Confirm Password" >
		<span class="text-danger"><?php echo form_error("new_password_confirmation"); ?></span>
	</div>
	
	<input type='hidden' name="account_password" value='<?php echo $account_password ?>'/> 
	<input type='hidden' name="account_id" value='<?php echo $account_id ?>'/> 
	
	<div class="form-group">
		<input type="submit" class="btn btn-info" name="submit_password" value="Update">
	</div>
</form>
</body>
</html>
<!--i'M CURRENTLY WORKING ON THIS-->
<!DOCTYPE html>
<html>
<head>
<title>Login Form</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro|Open+Sans+Condensed:300|Raleway' rel='stylesheet' type='text/css'>
</head>
<body>

<h2>Change Password</h2>
<br>
<form method="post" action="<?php echo base_url()?>index.php/admin/changeAccountPassword">
	<label for="formGroupExampleInput3">Old Password</label>
		<input type="password" class="form-control"  name="old_password" placeholder="Old Password" required>
		<span class="text-danger"><?php echo form_error("price"); ?></span>
	</div>

	<div class="form-group">
		<label for="formGroupExampleInput4">New Password</label>
		<input type="password" class="form-control" name="new_password" placeholder="New Password" required>
		<span class="text-danger"><?php echo form_error("date"); ?></span>
	</div>

	<div class="form-group">
		<label for="formGroupExampleInput3">Confirm Password</label>
		<input type="password" class="form-control"  name="new_password_confirmation" placeholder="Confirm Password" required>
		<span class="text-danger"><?php echo form_error("remarks"); ?></span>
	</div>
	<input type='hidden' name='account_id' value='<?php $account_id = $this->input->post('account_id'); ?>'/> 
	
	<div class="form-group">
		<input type="submit" class="btn btn-info" name="submit_password" value="Update">
	</div>
</form>
</body>
</html>
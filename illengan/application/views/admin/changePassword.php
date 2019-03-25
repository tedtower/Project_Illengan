<h2>Change Password</h2>
<br>

<form method="post" action="<?php echo base_url('admin/accounts/changepassword')?>">

	<div class="form-group">
	<label for="formGroupExampleInput3">Old Password</label>
		<input type="password" class="form-control"  name="old_password" placeholder="Old Password" >
		<span class="text-danger"><?php echo form_error("old_password"); ?></span>
	</div>

	<div class="form-group">
		<label for="formGroupExampleInput4">NewPassword</label>
		<input type="password" class="form-control" name="new_password" placeholder="New Password" >
		<span class="text-danger"><?php echo form_error("new_password"); ?></span>
	</div>

	<div class="form-group">
		<label for="formGroupExampleInput3">Confirm Password</label>
		<input type="password" class="form-control"  name="new_password_confirmation" placeholder="Confirm Password" >
		<span class="text-danger"><?php echo form_error("new_password_confirmation"); ?></span>
	</div>
		<input type='hidden' name="account_id" value='<?php  echo $account_id;  ?>'/> 
	
	<div class="form-group">
		<input type="submit" class="btn btn-info" name="submit_password" value="Update">
	</div>
</form>

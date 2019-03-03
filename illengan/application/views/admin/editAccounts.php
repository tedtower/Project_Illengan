<h2>Edit Account</h2>
<br>
<?php echo "Account_id: $account_id" ?>
<form method="post" action="<?php echo base_url()?>index.php/admin/editaccounts">

    <div class="form-group">
        <label for="formGroupExampleInput2">Username</label>
        <input type="text" class="form-control" name="account_username" placeholder="username" >
        <span class="text-danger"><?php echo form_error("account_username"); ?></span>
    </div>

    <div class="form-groups" >
        <label for="formGroupExampleInput4">Account Type</label>
        <select name="account_type">
        <option value="Admin" name="account_type">Admin</option>
        <option value="Barista" name="account_type">Barista</option>
        <option value="Chef" name="account_type">Chef</option>
        </select> 
    </div>
    <input type='hidden' name="account_id" value='<?php  echo $account_id;  ?>'/> 

	<div class="form-group">
		<input type="submit" class="btn btn-info" name="edit_account" value="Update">
	</div>
</form>

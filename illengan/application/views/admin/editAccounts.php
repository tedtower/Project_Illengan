<h2>Edit Account</h2>
<br>
<?php echo "aID: $aID" ?>
<form method="post" action="<?php echo base_url()?>index.php/admin/editaccounts">

    <div class="form-group">
        <label for="formGroupExampleInput2">Username</label>
        <input type="text" class="form-control" name="aUsername" placeholder="username" >
        <span class="text-danger"><?php echo form_error("aUsername"); ?></span>
    </div>

    <div class="form-groups" >
        <label for="formGroupExampleInput4">Account Type</label>
        <select name="aType">
        <option value="Admin" name="aType">Admin</option>
        <option value="Barista" name="aType">Barista</option>
        <option value="Chef" name="aType">Chef</option>
        </select> 
    </div>
    <input type='hidden' name="aID" value='<?php  echo $aID;  ?>'/> 

	<div class="form-group">
		<input type="submit" class="btn btn-info" name="edit_account" value="Update">
	</div>
</form>

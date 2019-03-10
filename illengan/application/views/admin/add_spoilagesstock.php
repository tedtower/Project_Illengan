<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<form method="POST" action="<?php echo base_url()?>index.php/admin/insertspoilagesstock">

   <div class="form-group">
    <label for="formGroupExampleInput2">Description</label>
    <input type="text" class="form-control" name="stock_name" placeholder="description" required>
    <span class="text-danger"><?php echo form_error("quantity"); ?></span>
  </div>
   
  <div class="form-group">
    <label for="formGroupExampleInput2">Quantity</label>
    <input type="text" class="form-control" name="s_qty" placeholder="Quantity" required>
    <span class="text-danger"><?php echo form_error("s_qty"); ?></span>
  </div>

  <div class="form-group">
    <label for="formGroupExampleInput4">Damage Date</label>
    <input type="date" class="form-control" name="s_date" placeholder="Date" required>
    <span class="text-danger"><?php echo form_error("s_date"); ?></span>
  </div>

  <div class="form-group">
    <label for="formGroupExampleInput3">Remarks</label>
    <input type="text" class="form-control"  name="remarks" placeholder="remarks" required>
    <span class="text-danger"><?php echo form_error("remarks"); ?></span>
  </div>
  
  <input type='hidden' name='date_recorded' value='<?php echo date("m-d-y"); ?>'/> 
  <input type='hidden' name='s_type' value='s'/> 
  
  <div class="form-group">
      <input type="submit" class="btn btn-info" name="add" value="Add">
  </div>
</form>


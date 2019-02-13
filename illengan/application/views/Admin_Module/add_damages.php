<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php echo form_open('add_damages'); ?>

<?php if (isset($message)) { ?>
<CENTER><h3 style="color:green;">Data inserted successfully</h3></CENTER><br>
<?php } ?>

<form method="POST" action="<?php echo site_url('add_damages/form_validation')?>">

  <?php  
  <label for="">Category</label>
  <div class="form-group">
    <label for="formGroupExampleInput2">Description</label>
    <input type="text" class="form-control" name="sqty" placeholder="Quantity" required>
    <span class="text-danger"><?php echo form_error("quantity") ?></span>
  </div>
   
  </div>
  <div class="form-group">
    <label for="formGroupExampleInput2">Quantity</label>
    <input type="text" class="form-control" name="sqty" placeholder="Quantity" required>
    <span class="text-danger"><?php echo form_error("quantity") ?></span>
  </div>
  <div class="form-group">
    <label for="formGroupExampleInput3">Price</label>
    <input type="text" class="form-control"  name="price" placeholder="Price" required>
    <span class="text-danger"><?php echo form_error("price") ?></span>
  </div>
  <div class="form-group">
    <label for="formGroupExampleInput4">Damage Date</label>
    <input type="date" class="form-control" name="sdate" placeholder="Date" required>
    <span class="text-danger"><?php echo form_error("date") ?></span>
  </div>
  
  <div class="form-group">
      <input type="submit" class="btn btn-info" name="add" value="Add">
  </div>
</form>
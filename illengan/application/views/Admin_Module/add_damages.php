<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<form method="POST" action="<?php echo site_url('add_damages/form_validation')?>">

  <?php 
    if($this->uri->segment(2)=="added"){
      echo '<p class="text-success">Data added</p>';
    }
    ?>
  <label for="Description">Description</label>
  <select name="stype" id="stype" >
      <option name="stype" value="inventory">Inventory</option>
      <option name="stype" value="menu">Menu</option>
  </select> 
   
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
    <label for="formGroupExampleInput4">Date</label>
    <input type="date" class="form-control" name="sdate" placeholder="Date" required>
    <span class="text-danger"><?php echo form_error("date") ?></span>
  </div>
  <div class="form-group">
    <label for="formGroupExampleInput5">Remarks</label>
    <input type="text" class="form-control" name="remarks" placeholder="Remarks" required>
    <span class="text-danger"><?php echo form_error("remarks") ?></span>
  </div>
  <div class="form-group">
      <input type="submit" class="btn btn-info" name="add" value="Add">
  </div>
</form>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<form method="post" action="<?php echo base_url()?>Add_Damages/form_validation">

  <?php 
    if($this->uri->segment(2)=="added"){
      echo '<p class="text-success">Data added</p>';
    }
    ?>
  <div class="form-group">
    <label for="formGroupExampleInput">Description</label>
    <input type="text" class="form-control"  name="description" placeholder="Description" require>
    <span class="text-danger"><?php echo form_error("description") ?></span>
  </div>
  <div class="form-group">
    <label for="formGroupExampleInput2">Quantity</label>
    <input type="text" class="form-control" name="quantity" placeholder="Quantity" require>
    <span class="text-danger"><?php echo form_error("quantity") ?></span>
  </div>
  <div class="form-group">
    <label for="formGroupExampleInput3">Price</label>
    <input type="text" class="form-control"  name="price" placeholder="Price" require>
  </div>
  <div class="form-group">
    <label for="formGroupExampleInput4">Date</label>
    <input type="date" class="form-control" name="date" placeholder="Date" require>
    <span class="text-danger"><?php echo form_error("date") ?></span>
  </div>
  <div class="form-group">
    <label for="formGroupExampleInput5">Remarks</label>
    <input type="text" class="form-control" name="remarks" placeholder="Remarks" require>
    <span class="text-danger"><?php echo form_error("remarks") ?></span>
  </div>
  <div class="form-group">
      <input type="submit" class="btn btn-info" name="add" value="Add">
  </div>
</form>
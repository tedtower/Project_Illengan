//Under Construction
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<head><script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script></head>
<form method="POST" action="<?php echo base_url()?>index.php/admin/menu/spoilages/add">


<!--Ito lang gagalawin-->
   <div class="form-group">
   <label for="formGroupExampleInput2">Description</label>
	<select id="menuitems"></select>
  </div>
<!---------------------------->
   
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
  
  <input type='hidden' name='s_type' value='m'/> 
  
  <div class="form-group">
      <input type="submit" class="btn btn-info" name="add" value="Add">
  </div>
</form>
//Not yet finished
<script type="text/javascript">
  
    $(document).on('change', '#menuitems', function() {
        Menu();
    });

    function Menu(){
    

      }

 
</script>
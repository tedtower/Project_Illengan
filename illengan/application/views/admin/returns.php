<div class="content">
        <div class="container-fluid">
        <div class="content" style="margin-left:250px;">
					<div class="container-fluid">
						<div class="content">
							<div class="container-fluid">
<h2>Returns</h2>
<div>
  <a href="" class="btn btn-rounded mb-4" data-toggle="modal" data-target="#addReturnForm">
  Add Return</a>
</div>
<!-----Add Return Modal-------------------------------------------------------------------------->
<div class="modal fade" id="addReturnForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
  <form method="post" action="<?php echo base_url('adminadd/addReturns');?>">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">Add Return Stock Item</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-3">
        <div class="md-form mb-5">

<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="inputGroup-sizing-default">Receipt No.</span>
  </div>
  <select name="trans" required>
		<option value="">Receipt No.</option>
            <?php foreach($transactions as $row){ 
                echo '<option value="'.$row['trans_id'].'">'.$row['receipt_no'].'</option>';
            }?>
    </select>
</div>
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="inputGroup-sizing-default">Stock</span>
  </div>
  <select name="stock" required>
  <option value="">Stock Name</option>
            <?php foreach($stock as $row){
                echo '<option value="'.$row['stock_id'].'">'.$row['stock_name'].'</option>';
            }?>
    </select>
</div> 
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="inputGroup-sizing-default">Returned Quantity</span>
  </div>
    <input type="number" name="quantity" placeholder="quantity"/>
      </div>
        </div>
      <div class="modal-footer d-flex justify-content-center">
        
        <button type="submit" class="btn btn-deep-orange">Add</button>
      </div>
    </div>
  </div>
</div>
</form>
</div>
<!-------------------------------------------------------------------------------------------->
<table id="returns" class="table table-striped table-bordered" style="width:90%">
<thead>    
<tr>    
        <th>Transaction Receipt</th>
        <th>Stock Name</th>
        <th>Quantity</th>
        <th>Unit</th>
        <th>Remarks</th>
        <th>Transaction Date<br>(yyyy-mm-dd)</th>
        <th>Returned Date Recorded<br>(yyyy-mm-dd)</th>
        <th>Actions</th>
        <th>Resolved</th>
    </tr>
        </thead>
        <tbody>
    <?php $i =1; 
    foreach($returns as $items){
        $date= $items['date_recorded'];
      // $returnedDate = date('F d, Y', $date);
        $date1 = $items['trans_date'];
       // $transDate = date('F d, Y', $date1);
    ?>
    <tr>
        <td><?php echo $items['receipt_no'];?></td>
        <td><?php echo $items['stock_name']?></td>
        <td><?php echo $items['return_qty'];?></td>
        <td><?php echo $items['stock_unit']?></td>
        <td><?php echo $items['remarks']?></td>
        <td><?php echo $date1;?></td>
        <td><?php echo $date;?></td>
        <td><a href="" class="btn" data-toggle="modal" data-target="#deleteReturn">Resolve</a></td>
        <td><p>Not Yet</p></td>
    </tr>
    <?php $i++;
}?>
</tbody>
</table>
</div>
</div>
</div>
</div>
<script>
    $(document).ready(function() {
    $('#returns').DataTable();
} );
</script>
 <!-- Remove Modal -->
 <div class="modal fade" id="deleteReturn" tabindex="-1" role="dialog" aria-labelledby="deleteReturn" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content" style="padding:0px;">
            <!-- Modal Body -->
            <div class="modal-body text-center py-1">
                <i class="fas fa-times fa-4x animated rotateIn text-danger"></i>
                <p class="delius">Are you sure you want to delete this record <span class="text-danger"></span> from your returns?</p>
            </div>
            <div class="modal-footer justify-content-center py-1">
                <a class="btn btn-danger" data-dismiss="modal">Close</a>
                <a class="btn btn-danger" href="<?php echo base_url('admindelete/deleteReturns/'.$items['return_id']);?>">Remove</a>
            </div>
            </div>
        </div>
    </div>

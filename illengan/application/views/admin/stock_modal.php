<div class="modal fade" id="stock_modal" role="dialog" aria-labelledby="stockModal" aria-hidden="true">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
        <h5 style="position: relative; float:left;left:0;" id="stockAction" class="stockHeader"></h5>
          <h5 style="position: relative; float:left;margin-left:10px;"><?php 
                $timestamp = time(); 
                echo "\n"; 
                echo(date("F d, Y h:i:s A", $timestamp));       
                ?></h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          
        </div>
        <div class="modal-body">
        <h5 class="gab m-0">Stock Item</h5>
          <select class="browser-default custom-select" id="stockSelect" name="stockItem"></select>
          
          <div class="md-form input-group delius" style="margin-top: 10px;">
                        <h5 class="gab m-0">Transaction</h5>
                        <div class="d-flex flex-row mr-5 w-100">
                        <select class="browser-default custom-select" id="transSelect" name="transItem" style="margin: 5px;"></select>
                        </div>
                    </div>
          <div class="md-form input-group delius" style="margin-top: 10px;"><h5 id="orgQty" ></h5></div>
          <div class="md-form input-group delius" style="margin-top: 10px;">
                        <h5 class="gab m-0"><i class="far fa-sort-numeric-up"></i> Quantity</h5>
                        <div class="d-flex flex-row mr-5 w-100">
                            <div class="input-group-prepend">
                                <input type="number" style="width: 40%; margin: 5px;border: 1px solid grey;"class="form-control text-center px-3"
                                    name="stockQuantity" id="quantity" min="1" value="1">
                            </div>
                        </div>
                    </div>
        </div>
       
        <div class="modal-footer">
          <button type="submit" id="submitStock" onclick="updateStock()" class="btn btn-success pull-left">Submit</button>
          <button type="submit" class="btn btn-default btn-default pull-left" data-dismiss="modal">
          <span class="glyphicon glyphicon-remove"></span> Cancel</button>
        </div>
      </div>
    </div>
  </div> 

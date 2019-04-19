<!--End Side Bar-->
<div class="content">
  <div class="container-fluid">
  <br>
  <p style="text-align:right; font-weight: regular; font-size: 16px">
      <!-- Real Time Date & Time -->
      <?php echo date("M j, Y -l"); ?>
  </p>
    <div class="content" style="margin-left:250px;">
      <div class="container-fluid">
        <div class="card-content">
          <a class="btn btn-default btn-sm" data-toggle="modal" data-target="#newReturn" data-original-title style="margin:0">Add Return</a>
          <br>
          <br>
          <!--Table-->
            <table id="returns" class="table dt-responsive nowrap" cellspacing="0" width="100%">
              <thead class="thead-light">     
                  <tr>  
                      <th scope="col"></th>
                      <th scope="col">Return No.</th>
                      <th scope="col">Date Returned</th>
                      <th scope="col">Date Recorded</th>
                      <th scope="col">Qty</th>
                      <th scope="col">Status</th>
                      <th scope="col">Actions</th>
                  </tr>
              </thead>
              <tbody>
                  <tr>
                    <td><img class="accordionBtn" src="/assets/media/admin/down-arrow%20(1).png" style="height:15px;width: 15px"/></td>
                    <td>1</td>
                    <td>April 17, 2019</td>
                    <td>April 17, 2019</td>
                    <td>10</td>
                    <td>pending</td>
                    <td>                    
                      <button class="editBtn btn btn-sm btn-primary" data-toggle="modal" data-target="#editReturn">Edit</button>
                      <button class="deleteBtn btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteReturn">Delete</button>
                    </td>
                  </tr>

                  <tr class="accordion" style="display:none">
                    <td colspan="8">
                      <div style="margin:1%">
                        <div style="overflow:auto">
                          <span class="mr-2" style="float:left">Remarks:</span>
                          <p>No remarks</p>
                        </div>
                        <span>Returned Items</span>
                        <table class="table table-bordered dt-responsive nowrap mt-2">
                          <thead style="background:white">
                            <tr>
                              <th scope="col">Item</th>
                              <th scope="col">Unit</th>
                              <th scope="col">Size</th>
                              <th scope="col">Qty</th>
                              <th scope="col">Price</th>
                              <th scope="col">Subtotal</th>
                              <th scope="col">Remarks</th>
                              <th scope="col">Status</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>Milk</td>
                              <td>Bottle</td>
                              <td>1 L</td>
                              <td>3</td>
                              <td>100</td>
                              <td>300</td>
                              <td></td>
                              <td>pending</td>
                            </tr>
                          </tbody>
                        </table>
                        <span>Total: </span>
                      </div>
                    </td>
                  </tr>

              </tbody>
          </table>
      <!--Start of Modal "Add Returns"-->
        <div class="modal fade bd-example-modal-lg" id="newReturn" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Return</h5>
                        <button type="button" class="close" data-dismiss="modal"aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?php echo base_url()?>admin/returns/add" method="get" accept-charset="utf-8">
                        <div class="modal-body">
                            <!--Date Returned-->
                            <div style="overflow:auto">
                              <div style="width:45%;float:left">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm" style="width:110px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;mleftargin:0">
                                        Date Returned</span>
                                    </div>
                                    <input type="date" name="" id="" class="form-control form-control-sm">
                                </div>
                            <!--Date Recorded-->
                                <div class="input-group mb-3">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm" style="width:110px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                        Date Recorded</span>
                                     </div>
                                    <input type="date" name="" id="" class="form-control form-control-sm">
                                </div>

                                <div class="input-group mb-3">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                      Status</span>
                                  </div>
                                  <select class="form-control" name="promo_type" id="promo_type">
                                      <option selected>Choose</option>
                                      <option>Pending</option>
                                      <option>Partially Resolved</option>
                                      <option>Resolved</option>
                                  </select>
                                </div>
                              </div>

                              <div style="width:50%;float:left;margin-left:5%">
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                      Status</span>
                                  </div>
                                  <textarea class="form-control" ></textarea>
                                </div>
                              </div>
                            </div>

                            <!--Returns-->
                            <a class="btn btn-primary btn-sm" style="color:blue;margin:0">Add Items</a> <!--Button to add row in the table-->
                            <br><br>
                            <table class="table table-sm table-borderless"> <!--Table containing the different input fields in adding trans items -->
                                <thead class="thead-light">
                                    <tr>
                                        <th>Stock Item</th>
                                        <th>Varience</th>
                                        <th>Quantity</th>
                                        <th>Remarks</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <select class="form-control" name="" id="">
                                                <option selected>Choose</option>
                                                <option></option>
                                            </select>
                                        </td>
                                        <td>
                                            <select class="form-control" name="" id="">
                                                <option selected>Choose</option>
                                                <option></option>
                                            </select>
                                        </td>
                                        <td style="width:100px"><input type="number" name="" id="" min="1" class="form-control form-control-sm"></td>
                                        <td style="width:200px"><textarea class="form-control" rows="1"></textarea></td>
                                        <td style="width:30px"><img class="exitBtn" id="exitBtn" src="/assets/media/admin/error.png" style="width:20px;height:20px"></td>
                                    </tr>
                            </table>
    
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger btn-sm"
                                    data-dismiss="modal">Cancel</button>
                                <button class="btn btn-success btn-sm"
                                    type="submit">Insert</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <!--End of Modal "Add Returns"-->

      <!--Start of Modal "Edit Returns"-->
      <div class="modal fade bd-example-modal-lg" id="editReturn" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Return</h5>
                        <button type="button" class="close" data-dismiss="modal"aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?php echo base_url()?>admin/returns/add" method="get" accept-charset="utf-8">
                        <div class="modal-body">
                            <!--Date Returned-->
                            <div style="overflow:auto">
                              <div style="width:45%;float:left">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm" style="width:110px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;mleftargin:0">
                                        Date Returned</span>
                                    </div>
                                    <input type="date" name="" id="" class="form-control form-control-sm">
                                </div>
                            <!--Date Recorded-->
                                <div class="input-group mb-3">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm" style="width:110px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                        Date Recorded</span>
                                     </div>
                                    <input type="date" name="" id="" class="form-control form-control-sm">
                                </div>

                                <div class="input-group mb-3">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                      Status</span>
                                  </div>
                                  <select class="form-control" name="promo_type" id="promo_type">
                                      <option selected>Choose</option>
                                      <option>Pending</option>
                                      <option>Partially Resolved</option>
                                      <option>Resolved</option>
                                  </select>
                                </div>
                              </div>

                              <div style="width:50%;float:left;margin-left:5%">
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                      Status</span>
                                  </div>
                                  <textarea class="form-control" ></textarea>
                                </div>
                              </div>
                            </div>

                            <!--Returns-->
                            <a class="btn btn-primary btn-sm" style="color:blue;margin:0">Add Items</a> <!--Button to add row in the table-->
                            <br><br>
                            <table class="table table-sm table-borderless"> <!--Table containing the different input fields in adding trans items -->
                                <thead class="thead-light">
                                    <tr>
                                        <th>Stock Item</th>
                                        <th>Varience</th>
                                        <th>Quantity</th>
                                        <th>Remarks</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <select class="form-control" name="" id="">
                                                <option selected>Choose</option>
                                                <option></option>
                                            </select>
                                        </td>
                                        <td>
                                            <select class="form-control" name="" id="">
                                                <option selected>Choose</option>
                                                <option></option>
                                            </select>
                                        </td>
                                        <td style="width:100px"><input type="number" name="" id="" min="1" class="form-control form-control-sm"></td>
                                        <td style="width:200px"><textarea class="form-control" rows="1"></textarea></td>
                                        <td style="width:30px"><img class="exitBtn" id="exitBtn" src="/assets/media/admin/error.png" style="width:20px;height:20px"></td>
                                    </tr>
                            </table>
    
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger btn-sm"
                                    data-dismiss="modal">Cancel</button>
                                <button class="btn btn-success btn-sm"
                                    type="submit">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <!--End of Modal "Edit Returns"-->

    <!--Start of Modal "Delete Return"-->
    <div class="modal fade" id="deleteReturn" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Delete Return</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="confirmDelete">
                        <div class="modal-body">
                            <h6 id="deleteTableCode"></h6>
                            <p>Are you sure you want to delete this return?</p>
                            <input type="text" name="" hidden="hidden">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <!--End of Modal "Delete Return"-->
        </div>
      </div>
    </div>
  </div>
</div>
<?php include_once('templates/scripts.php') ?>
<script>
        $(".accordionBtn").on('click', function(){
            if($(this).closest("tr").next(".accordion").css("display") == 'none'){
                $(this).closest("tr").next(".accordion").css("display","table-row");
                $(this).closest("tr").next(".accordion").find("td > div").slideDown("slow");
            }else{
                $(this).closest("tr").next(".accordion").find("td > div").slideUp("slow");
                $(this).closest("tr").next(".accordion").hide("slow");
            }
        });
</script>

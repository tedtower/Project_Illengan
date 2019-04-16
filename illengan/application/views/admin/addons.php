
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
                    <div class="content">
                        <div class="container-fluid">
                            <!--Table-->
                            <div class="card-content">
                                <a class="btn btn-default btn-sm" data-toggle="modal" data-target="#newMenu"
                                    data-original-title style="margin:0;">Add Addons</a>
                                <br>
                                <br>
            <table id="menuTable" class="table table-striped table-bordered dt-responsive nowrap" cellpadding="0" width="100%">
                <thead>
                    <tr>
                        <th>Addon</th>
                        <th>Price</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Milk</td>
                        <td>20</td>
                        <td>Drinks</td>
                        <td>Available</td>
                        <td>
                        <button class="editBtn btn btn-sm btn-primary">Edit</button>
                        <button class="deleteBtn btn btn-sm btn-danger">Delete</button>
                        </td>
                    </tr>
                    
                </tbody>
            </table>
            <!--Start of Modal "Add Menu"-->
            <div class="modal fade bd-example-modal-lg" id="newMenu" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Add Menu Item</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="<?php echo base_url()?>admin/menu/add" method="get"
                                                accept-charset="utf-8">
                                                <div class="modal-body">
                                                    <div class="input-group mb-3"> <!--Menu Image-->
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" style="width:105px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">Image</span>
                                                        </div>
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input" name="menu_image" id="inputGroupFile01">
                                                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                                        </div>
                                                    </div> 
                                                    <!--Menu Name-->
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                            Name</span>
                                                        </div>
                                                        <input type="text" name="menu_name" id="menu_name" class="form-control form-control-sm">
                                                    </div>  
                                                    <!--Description-->
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                            Description</span>
                                                        </div>
                                                        <textarea type="text" name="menu_description" id="menu_description" class="form-control form-control-sm"></textarea>
                                                    </div>                                                                                                                                                       
                                                    <div class="form-row"> <!--Container of receipt no. and transaction date-->
                                                        <!--Receipt no-->
                                                        <div class="input-group mb-3 col">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                            Category</span>
                                                        </div>
                                                        <select class="custom-select" name="category_name" id="category_name">
                                                            <option selected>Choose</option>
                                                            <option></option>
                                                        </select>
                                                    </div>
                                                        <!--Transaction date-->
                                                        <div class="input-group mb-3 col">
                                                            <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                            Status</span>
                                                        </div>
                                                        <select class="custom-select" name="menu_availability" id="menu_availability">
                                                            <option selected>Choose</option>
                                                            <option></option>
                                                        </select>
                                                        </div>
                                                    </div>



                                                    <!--Menu Items-->
                                                    <a class="btn btn-primary btn-sm" style="color:blue">Add Preferences</a> <!--Button to add row in the table-->
                                                    <br><br>
                                                    <table class="table table-sm table-borderless"> <!--Table containing the different input fields in adding trans items -->
                                                        <thead class="thead-light">
                                                            <tr>
                                                                <th>Name</th>
                                                                <th>Temperature</th>
                                                                <th>Price</th>
                                                                <th>Status</th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td><input type="text" name="menu_name" id="menu_name" class="form-control form-control-sm"></td>
                                                                <td>
                                                                    <select class="form-control" name="menu_availability" id="menu_availability">
                                                                        <option selected>Choose</option>
                                                                        <option></option>
                                                                    </select>
                                                                </td>
                                                                <td><input type="number" name="pref_price" id="pref_price" class="form-control form-control-sm"></td>
                                                                <td>
                                                                    <select class="form-control" name="menu_availability" id="menu_availability">
                                                                        <option selected>Choose</option>
                                                                        <option></option>
                                                                    </select>
                                                                </td>
                                                                <td><img class="exitBtn" id="exitBtn" src="/assets/media/admin/error.png" style="width:20px;height:20px"></td>
                                                            </tr>
                                                    </table>
                                                    <!--Menu Items-->
                                                    <a class="btn btn-primary btn-sm" style="color:blue">Add Addons</a> <!--Button to add row in the table-->
                                                    <br><br>
                                                    <table class="table table-sm table-borderless"> <!--Table containing the different input fields in adding trans items -->
                                                        <thead class="thead-light">
                                                            <tr>
                                                                <th style="width:50%">Name</th>
                                                                <th style="width:50%">Price</th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>
                                                                    <select class="form-control" name="menu_availability" id="menu_availability">
                                                                        <option selected>Choose</option>
                                                                        <option></option>
                                                                    </select>
                                                                </td>
                                                                <td><input type="number" name="item_qty" id="item_qty" class="form-control form-control-sm"></td>
                                                                <td><img class="exitBtn" id="exitBtn" src="/assets/media/admin/error.png" style="width:20px;height:20px;right:0"></td>
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
<!--End of Modal "Add Transaction"-->

        </div>
   
    </div>
    </div>
    </div>
    
   

                    </div>
                </div>
            </div>

<?php include_once('templates/scripts.php') ?>

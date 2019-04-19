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
<!--Table-->
<div class="card-content">
    <a class="btn btn-default btn-sm" data-toggle="modal" data-target="#newPromo" data-original-title style="margin:0">Add Promo</a>
    <br>
    <br>
    <table id="menuTable" class="table dt-responsive nowrap" cellspacing="0" width="100%">
        <thead class="thead-light">
            <tr>
                <th></th>
                <th>Promo Name</th>
                <th>Promo Type</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><img class="accordionBtn" src="/assets/media/admin/down-arrow%20(1).png" style="height:15px;width: 15px"/></td>
                <td>Graduation Promo</td>
                <td>Discount/Freebie</td>
                <td>April 17, 2019</td>
                <td>April 20, 2019</td>
                <td>Enabled</td>
                <td>
                    <button class="editBtn btn btn-sm btn-primary" data-toggle="modal" data-target="#editPromo">Edit</button>
                    <button class="deleteBtn btn btn-sm btn-danger" data-toggle="modal" data-target="#deletePromo">Delete</button>
                </td>
            </tr>
            <tr class="accordion" style="display:none">
                <td colspan="7">
                    <div style="margin:1%">
                        <div style="margin:0 3%;overflow:auto">
                            <span>Discount</span>
                            <table class="table table-bordered dt-responsive nowrap">
                                <thead style="background:white">
                                    <tr>
                                        <th>Menu w/ Discount</th>
                                        <th>Percentage</th>
                                        <th>Constraint Menu</th>
                                        <th>Constraint Qty</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Benguet (Jumbo)</td>
                                        <td>20%</td>
                                        <td>Animal Fries</td>
                                        <td>1</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div style="margin:0 3%;overflow:auto">
                            <span>Freebie</span>
                            <table class="table table-bordered dt-responsive nowrap">
                                <thead style="background:white">
                                    <tr>
                                        <th>Menu w/ Freebie</th>
                                        <th>Freebies</th>
                                        <th>Constraint Menu</th>
                                        <th>Constraint Qty</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Americano</td>
                                        <td>Animal Fries/Wicked Oreos</td>
                                        <td>Americano</td>
                                        <td>2</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
    <!--Start of Modal "Add Promo"-->
        <div class="modal fade bd-example-modal-lg" id="newPromo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Promo</h5>
                        <button type="button" class="close" data-dismiss="modal"aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?php echo base_url()?>admin/menu/promo/add" method="get" accept-charset="utf-8">
                        <div class="modal-body">                                                                                                                                                      
                            <div class="form-row"> <!--Container of promo name and promo type-->
                            <!--Promo name-->
                                <div class="input-group mb-3 col">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                        Promo Name</span>
                                    </div>
                                    <input type="text" name="promo_name" id="promo_name" class="form-control form-control-sm">
                                </div>
                                <!--Promo type-->
                                <div class="input-group mb-3 col">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                    Promo Type</span>
                                </div>
                                <select class="form-control" name="promo_type" id="promo_type">
                                    <option selected>Choose</option>
                                    <option>Discount</option>
                                    <option>Freebie</option>
                                    <option>Discount/Freebie</option>
                                </select>
                                </div>
                            </div>
                            
                            <div class="form-row"> <!--Container of start date and end date-->
                            <!--Start Date-->
                                <div class="input-group mb-3 col">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                        Start Date</span>
                                    </div>
                                    <input type="date" name="start_date" id="start_date" class="form-control form-control-sm">
                                </div>
                            <!--End date-->
                                <div class="input-group mb-3 col">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                        End Date</span>
                                    </div>
                                    <input type="date" name="end_date" id="end_date" class="form-control form-control-sm">
                                </div>
                            </div>
                            <!--Discount-->
                            <a class="btn btn-primary btn-sm" style="color:blue;margin:0">Add Discount</a> <!--Button to add row in the table-->
                            <br><br>
                            <table class="table table-sm table-borderless"> <!--Table containing the different input fields in adding trans items -->
                                <thead class="thead-light">
                                    <tr>
                                        <th>Menu Item</th>
                                        <th>Percentage</th>
                                        <th>Contraint Menu</th>
                                        <th>Contraint Qty</th>
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
                                        <td><input type="number" name="" id="" class="form-control form-control-sm"></td>
                                        <td>
                                            <select class="form-control" name="" id="">
                                                <option selected>Choose</option>
                                                <option></option>
                                            </select>
                                        </td>
                                        <td><input type="number" name="" id="" class="form-control form-control-sm"></td>
                                        <td><img class="exitBtn" id="exitBtn" src="/assets/media/admin/error.png" style="width:20px;height:20px"></td>
                                    </tr>
                            </table>
                            <!--Freebie-->
                            <a class="btn btn-primary btn-sm" style="color:blue;margin:0">Add Freebies</a> <!--Button to add row in the table-->
                            <br><br>
                            <table class="table table-sm table-borderless"> <!--Table containing the different input fields in adding trans items -->
                                <thead class="thead-light">
                                    <tr>
                                        <th>Menu Item</th>
                                        <th>Freebies</th>
                                        <th>Contraint Menu</th>
                                        <th>Contraint Qty</th>
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
                                        <td><input type="text" name="" id="" class="form-control form-control-sm"></td>
                                        <td>
                                            <select class="form-control" name="" id="">
                                                <option selected>Choose</option>
                                                <option></option>
                                            </select>
                                        </td>
                                        <td><input type="number" name="" id="" class="form-control form-control-sm"></td>
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
    <!--End of Modal "Add Promo"-->

    <!--Start of Modal "Edit Promo"-->
        <div class="modal fade bd-example-modal-lg" id="editPromo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Promo</h5>
                        <button type="button" class="close" data-dismiss="modal"aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?php echo base_url()?>admin/menu/promo/add" method="get" accept-charset="utf-8">
                        <div class="modal-body">                                                                                                                                                      
                            <div class="form-row"> <!--Container of promo name and promo type-->
                            <!--Promo name-->
                                <div class="input-group mb-3 col">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                        Promo Name</span>
                                    </div>
                                    <input type="text" name="promo_name" id="promo_name" class="form-control form-control-sm">
                                </div>
                                <!--Promo type-->
                                <div class="input-group mb-3 col">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                    Promo Type</span>
                                </div>
                                <select class="form-control" name="promo_type" id="promo_type">
                                    <option selected>Choose</option>
                                    <option>Discount</option>
                                    <option>Freebie</option>
                                    <option>Discount/Freebie</option>
                                </select>
                                </div>
                            </div>
                            
                            <div class="form-row"> <!--Container of start date and end date-->
                            <!--Start Date-->
                                <div class="input-group mb-3 col">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                        Start Date</span>
                                    </div>
                                    <input type="date" name="start_date" id="start_date" class="form-control form-control-sm">
                                </div>
                            <!--End date-->
                                <div class="input-group mb-3 col">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                        End Date</span>
                                    </div>
                                    <input type="date" name="end_date" id="end_date" class="form-control form-control-sm">
                                </div>
                            </div>
                            <!--Discount-->
                            <a class="btn btn-primary btn-sm" style="color:blue;margin:0">Add Discount</a> <!--Button to add row in the table-->
                            <br><br>
                            <table class="table table-sm table-borderless"> <!--Table containing the different input fields in adding trans items -->
                                <thead class="thead-light">
                                    <tr>
                                        <th>Menu Item</th>
                                        <th>Percentage</th>
                                        <th>Contraint Menu</th>
                                        <th>Contraint Qty</th>
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
                                        <td><input type="number" name="" id="" class="form-control form-control-sm"></td>
                                        <td>
                                            <select class="form-control" name="" id="">
                                                <option selected>Choose</option>
                                                <option></option>
                                            </select>
                                        </td>
                                        <td><input type="number" name="" id="" class="form-control form-control-sm"></td>
                                        <td><img class="exitBtn" id="exitBtn" src="/assets/media/admin/error.png" style="width:20px;height:20px"></td>
                                    </tr>
                            </table>
                            <!--Freebie-->
                            <a class="btn btn-primary btn-sm" style="color:blue;margin:0">Add Freebies</a> <!--Button to add row in the table-->
                            <br><br>
                            <table class="table table-sm table-borderless"> <!--Table containing the different input fields in adding trans items -->
                                <thead class="thead-light">
                                    <tr>
                                        <th>Menu Item</th>
                                        <th>Freebies</th>
                                        <th>Contraint Menu</th>
                                        <th>Contraint Qty</th>
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
                                        <td><input type="text" name="" id="" class="form-control form-control-sm"></td>
                                        <td>
                                            <select class="form-control" name="" id="">
                                                <option selected>Choose</option>
                                                <option></option>
                                            </select>
                                        </td>
                                        <td><input type="number" name="" id="" class="form-control form-control-sm"></td>
                                        <td><img class="exitBtn" id="exitBtn" src="/assets/media/admin/error.png" style="width:20px;height:20px;right:0"></td>
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
    <!--End of Modal "Edit Promo"-->

    <!--Start of Modal "Delete Promo"-->
        <div class="modal fade" id="deletePromo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Delete Promo</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="confirmDelete">
                        <div class="modal-body">
                            <h6 id="deleteTableCode"></h6>
                            <p>Are you sure you want to delete this promo?</p>
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
    <!--End of Modal "Delete Promo"-->

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
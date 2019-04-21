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
                                <a class="btn btn-default btn-sm" data-toggle="modal" data-target="#newSource" data-original-title style="margin:0;">Add New Source</a><br>

                                <br>
                                <table id="tablevalues" class="table table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                    <thead class="thead-light">
                                        <th style="width:3%"></th>
                                        <th><b class="pull-left">Name</b></th>
                                        <th><b class="pull-left">Number</b></th>
                                        <th><b class="pull-left">Email</b></th>
                                        <th><b class="pull-left">Address</b></th>
                                        <th><b class="pull-left">Status</b></th>
                                        <th><b class="pull-left">Actions</b></th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><img class="accordionBtn" src="/assets/media/admin/down-arrow%20(1).png" style="height:15px;width: 15px"/></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>
                                                <button class="editBtn btn btn-sm btn-primary" data-toggle="modal" data-target="#editSource" >Edit</button>
                                                <button class="deleteBtn btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteSource">Delete</button>
                                            </td>
                                        </tr>
                                        <tr class="accordion" style="display:none">
                                            <td colspan="8">
                                            <div style="margin:1% 5%">
                                                <span>Merchandise Items</span>
                                                <table class="table table-bordered dt-responsive nowrap mt-2">
                                                    <thead style="background:white">
                                                        <tr>
                                                        <th scope="col">Item Name</th>
                                                        <th scope="col">Unit</th>
                                                        <th scope="col">Price</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                        <td>Nestle Milk 1L</td>
                                                        <td>Bottle</td>
                                                        <td>100</td>
                                                    </tbody>
                                                </table>
                                            </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <!--End Table Content-->
    <!--Start of Add Modal-->
        <div class="modal fade bd-example-modal-lg" id="newSource" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Source</h5>
                        <button type="button" class="close" data-dismiss="modal"aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?php echo base_url()?>admin/source/add" method="get" accept-charset="utf-8">
                        <div class="modal-body">                                                                                                                                                      
                            <div class="form-row">
                            <!--Source name-->
                                <div class="input-group mb-3 col">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                        Source Name</span>
                                    </div>
                                    <input type="text" name="source_name" id="source_name" class="form-control form-control-sm">
                                </div>
                            <!--Contact Number-->
                                <div class="input-group mb-3 col">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                        Contact No.</span>
                                    </div>
                                    <input type="number" name="contact_num" id="contact_num" class="form-control form-control-sm">
                                </div>
                            </div>
                            
                            <div class="form-row">
                            <!--Email-->
                                <div class="input-group mb-3 col">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                        Email</span>
                                    </div>
                                    <input type="text" name="email" id="email" class="form-control form-control-sm">
                                </div>
                            <!--Status-->
                                <div class="input-group mb-3 col">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                        Status</span>
                                    </div>
                                    <select name="status" id="status" class="form-control form-control-sm">
                                        <option>Choose</option>
                                        <option>Active</option>
                                        <option>Inactive</option>
                                    </select>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                    Address</span>
                                </div>
                                <input type="text" name="supAddress" id="supAddress" class="form-control form-control-sm">
                            </div>
                            <!--Merchandise-->
                            <a class="btn btn-primary btn-sm" style="color:blue;margin:0">Add Merchandise Item</a> <!--Button to add row in the table-->
                            <br><br>
                            <table class="table table-sm table-borderless"> <!--Table containing the different input fields in adding trans items -->
                                <thead class="thead-light">
                                    <tr>
                                        <th>Item Name</th>
                                        <th style="width:15%">Unit</th>
                                        <th style="width:15%">Price</th>
                                        <th style="width:35%">>Variance</th>
                                        <th style="width:4%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><input type="text" name="merchName" id="merchName" class="form-control form-control-sm"></td>
                                        <td><input type="text" name="merchUnit" id="merchUnit" class="form-control form-control-sm"></td>
                                        <td><input type="number" name="merchPrice" id="merchPrice" class="form-control form-control-sm"></td>
                                        <td>
                                            <select class="form-control" name="variance" id="variance">
                                                <option selected>Choose</option>
                                                <option></option>
                                            </select>
                                        </td>
                                        <td><img class="exitBtn" id="exitBtn" src="/assets/media/admin/error.png" style="width:20px;height:20px"></td>
                                    </tr>
                            </table>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
                                <button class="btn btn-success btn-sm" type="submit">Insert</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <!--End of Add Modal-->

    <!--Start of Edit Modal-->
        <div class="modal fade bd-example-modal-lg" id="editSource" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update Source</h5>
                        <button type="button" class="close" data-dismiss="modal"aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?php echo base_url()?>admin/source/add" method="get" accept-charset="utf-8">
                        <div class="modal-body">                                                                                                                                                      
                            <div class="form-row">
                            <!--Source name-->
                                <div class="input-group mb-3 col">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                        Source Name</span>
                                    </div>
                                    <input type="text" name="source_name" id="source_name" class="form-control form-control-sm">
                                </div>
                            <!--Contact Number-->
                                <div class="input-group mb-3 col">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                        Contact No.</span>
                                    </div>
                                    <input type="number" name="contact_num" id="contact_num" class="form-control form-control-sm">
                                </div>
                            </div>
                            
                            <div class="form-row">
                            <!--Email-->
                                <div class="input-group mb-3 col">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                        Email</span>
                                    </div>
                                    <input type="text" name="email" id="email" class="form-control form-control-sm">
                                </div>
                            <!--Status-->
                                <div class="input-group mb-3 col">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                        Status</span>
                                    </div>
                                    <select name="status" id="status" class="form-control form-control-sm">
                                        <option>Choose</option>
                                        <option>Active</option>
                                        <option>Inactive</option>
                                    </select>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                    Address</span>
                                </div>
                                <input type="text" name="supAddress" id="supAddress" class="form-control form-control-sm">
                            </div>
                            <!--Merchandise-->
                            <a class="btn btn-primary btn-sm" style="color:blue;margin:0">Add Merchandise Item</a> <!--Button to add row in the table-->
                            <br><br>
                            <table class="table table-sm table-borderless"> <!--Table containing the different input fields in adding trans items -->
                                <thead class="thead-light">
                                    <tr>
                                        <th>Item Name</th>
                                        <th style="width:15%">Unit</th>
                                        <th style="width:15%">Price</th>
                                        <th style="width:35%">>Variance</th>
                                        <th style="width:4%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><input type="text" name="merchName" id="merchName" class="form-control form-control-sm"></td>
                                        <td><input type="text" name="merchUnit" id="merchUnit" class="form-control form-control-sm"></td>
                                        <td><input type="number" name="merchPrice" id="merchPrice" class="form-control form-control-sm"></td>
                                        <td>
                                            <select class="form-control" name="variance" id="variance">
                                                <option selected>Choose</option>
                                                <option></option>
                                            </select>
                                        </td>
                                        <td><img class="exitBtn" id="exitBtn" src="/assets/media/admin/error.png" style="width:20px;height:20px"></td>
                                    </tr>
                            </table>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
                                <button class="btn btn-success btn-sm" type="submit">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--End of Edit Modal-->

 

        <!--Start of Delete Modal-->
        <div class="modal fade" id="deleteSource" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Delete Source</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="confirmDelete">
                        <div class="modal-body">
                            <h6 id="deleteTableCode"></h6>
                            <p>Are you sure you want to delete this source?</p>
                            <input type="text" name="" hidden="hidden">
                            <div>         
                                Remarks:<input type="text" name="deleteRemarks" id="deleteRemarks" class="form-control form-control-sm">               
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <!--End of Delete Modal-->

</div>
</div>
</div>
</div>
</div>
</div>
</div>

        <?php include_once('templates/scripts.php') ?>

<script>
var suppliers = <?= json_encode()?>;
    $(function(){
        setTableData();
    });
    function setTableData(){
        suppliers.supplier.forEach(element => {
            
        });
        appendRow();
        $(".accordionBtn").on('click', function(){
            if($(this).closest("tr").next(".accordion").css("display") == 'none'){
                $(this).closest("tr").next(".accordion").css("display","table-row");
                $(this).closest("tr").next(".accordion").find("td > div").slideDown("slow");
            }else{
                $(this).closest("tr").next(".accordion").find("td > div").slideUp("slow");
                $(this).closest("tr").next(".accordion").hide("slow");
            }
        });
    }
    function appendRow(){
        var row = `
        <tr data-id='${}'>
            <td><img class="accordionBtn" src="/assets/media/admin/down-arrow%20(1).png" style="height:15px;width: 15px"/></td>
            <td>${}</td>
            <td>${}09997090529</td>
            <td>${}email</td>
            <td>${}Active</td>
            <td>
                <button class="editBtn btn btn-sm btn-primary" data-toggle="modal" data-target="#editSource" >Edit</button>
                <button class="deleteBtn btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteSource">Delete</button>
            </td>
        </tr>`;
    }
    function setModalData(){
    }
</script>

    <!-- <script>
        $(document).ready(function() {
            $('.delete_data').click(function() {
                var id = $(this).attr("id");
                if (confirm("Are you sure you want to delete this?")) {
                    window.location = "<?php echo base_url(); ?>admin/sources/delete/" + id;
                } else {
                    return false;
                }
            });

        function showEditModal(event) {
            var row = event.target.parentElement.parentElement.parentElement;
            document.getElementById('new_name').value = row.firstElementChild.innerHTML;
            document.getElementById('new_contact').value = row.firstElementChild.nextElementSibling.innerHTML;
            document.getElementById('new_email').value = row.firstElementChild.nextElementSibling.nextElementSibling
                .innerHTML;
            document.getElementById('new_status').value = row.firstElementChild.nextElementSibling.nextElementSibling
                .nextElementSibling.innerHTML;
            document.getElementById('source_id').value = event.target.getAttribute('data-id');
        }
    </script> -->
</body>

</html>
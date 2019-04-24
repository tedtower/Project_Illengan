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
                            <a id="addMerchandise" class="btn btn-primary btn-sm" style="color:blue;margin:0">Add Merchandise Item</a> <!--Button to add row in the table-->
                            <br><br>
                            <table id="merchandisetable" class="table table-sm table-borderless"> <!--Table containing the different input fields in adding trans items -->
                                <thead class="thead-light">
                                    <tr>
                                        <th>Item Name</th>
                                        <th style="width:15%">Unit</th>
                                        <th style="width:15%">Price</th>
                                        <th style="width:35%">Variance</th>
                                        <th style="width:4%"></th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
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
                                        <th style="width:35%">Variance</th>
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
    var supplier = [];
    var variance = [];
    $(function(){
        $.ajax({
            url: '<?= base_url("admin/supplier/getDetails")?>',
            dataType: 'json',
            success: function(data){
                var spmLastIndex = 0;
                $.each(data.supplier, function(index, item){
                    supplier.push({"supplier" : item});
                    supplier[index].suppliermerch = data.suppliermerch.filter(spm =>  spm.spID ==  item.spID);

                    variance = data.stockvariance;

                });
                showTable();
            },
            error: function(response,setting, errorThrown){
                console.log(errorThrown);
                console.log(response.responseText);
            }
        });

    });
    function showTable(){
        supplier.forEach(function(item){
            var tableRow = `                
                <tr class="table_row" data-supplierID="${item.supplier.spID}">   <!-- table row ng table -->
                    <td><img class="accordionBtn" src="/assets/media/admin/down-arrow%20(1).png" style="height:15px;width: 15px"/></td>
                    <td>${item.supplier.spName}</td>
                    <td>${item.supplier.spContactNum}</td>
                    <td>${item.supplier.spEmail}</td>
                    <td>${item.supplier.spAddress}</td>
                    <td>${item.supplier.spStatus}</td>
                    <td>
                        <button class="editBtn btn btn-sm btn-primary">Edit</button>
                        <button class="deleteBtn btn btn-sm btn-danger">Delete</button>
                    </td>
                </tr>
            `;
            var suppliermerchDiv = `
            <div class="suppliermerch" style="margin:1% 5%">
                ${item.suppliermerch.length === 0 ? "No merchandise products are set for this supplier." : 
                `<span>Merchandise Items</span>
                    <table class="table table-bordered dt-responsive nowrap mt-2">
                        <thead style="background:white">
                            <tr>
                            <th scope="col">Item Name</th>
                            <th scope="col">Unit</th>
                            <th scope="col">Price</th>
                            </tr>
                        </thead>
                    <tbody>
                    ${item.suppliermerch.map(spm => {
                        return `
                        <tr>
                        <td>${spm.merchandise}</td>
                        <td>${spm.spmUnit}</td>
                        <td>${spm.spmPrice}</td>
                        </tr> 
                        `;
                    }).join('')}
                    </tbody>
                </table>
                `}
            </div>
            `;
            var accordion = `
            <tr class="accordion" style="display:none">
                <td colspan="8">
                    <div class="contain">
                    </div>
                </td>
            </tr>
            `;
            $("#tablevalues > tbody").append(tableRow);
            $("#tablevalues > tbody").append(accordion);
            $(".contain").last().append(suppliermerchDiv);
        });
        //Set accordion icon event to show accordion
        $(".accordionBtn").on('click', function() {
            if ($(this).closest("tr").next(".accordion").css("display") == 'none') {
                $(this).closest("tr").next(".accordion").css("display", "table-row");
                $(this).closest("tr").next(".accordion").find("td > div").slideDown("slow");
            } else {
                $(this).closest("tr").next(".accordion").find("td > div").slideUp("slow");
                $(this).closest("tr").next(".accordion").hide("slow");
            }
        });
    }

    $("#addMerchandise").on('click', function(){
        $(this).closest("form").find("#merchandisetable > tbody").append(`
        <tr>
            <td><input type="text" name="merchName" id="merchName" class="form-control form-control-sm"></td>
            <td><input type="text" name="merchUnit" id="merchUnit" class="form-control form-control-sm"></td>
            <td><input type="number" name="merchPrice" id="merchPrice" class="form-control form-control-sm"></td>
            <td>
                <select class="form-control" name="variance" id="variance">
                ${variance.map(variance => {
                    return `<option value = "${variance.vID}">${variance.vName}</option>`
                }).join('')}
                </select>
            </td>
            <td><img class="exitBtn" src="/assets/media/admin/error.png" style="width:20px;height:20px"></td>
        </tr>`);
        $("#newSource").find(".exitBtn").last().on("click", function(){
            $(this).closest("tr").remove();
        });
    });
</script>
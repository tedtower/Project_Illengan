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
    <a class="btn btn-default btn-sm" data-toggle="modal" data-target="#newStock" data-original-title style="margin:0;" id="addBtn">Add Stock Item</a>
    <a class="btn btn-default btn-sm" data-toggle="modal" data-target="#reStock" data-original-title style="margin:0;" id="addBtn">Restock</a>
    <br><br>
    <table id="stockTable" class="table table-striped table-bordered dt-responsive nowrap"
        cellspacing="0" width="100%">
        <thead>
            <tr>
                <th></th>
                <th><b class="pull-left">Item Name</b></th>
                <th><b class="pull-left">Category</b></th>
                <th><b class="pull-left">Quantity</b></th>
                <th><b class="pull-left">Type</b></th>
                <th><b class="pull-left">Status</b></th>
                <th><b class="pull-left">Action</b></th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
<!--Start of Modal "Add Stock Item"-->
     <div class="modal fade bd-example-modal-lg" id="newStock" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Stock Item</h5>
                        <button type="button" class="close" data-dismiss="modal"aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?php echo base_url()?>admin/inventory/add" method="get" accept-charset="utf-8">
                        <div class="modal-body">                                                                                                                                                      
                            <div class="form-row"> <!--Container of promo name and promo type-->
                            <!--Stock name-->
                                <div class="input-group mb-3 col">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                        Stock Name</span>
                                    </div>
                                    <input type="text" name="stockName" id="stockName" class="form-control form-control-sm">
                                </div>
                            <!--Stock type-->
                                <div class="input-group mb-3 col">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                    Promo Type</span>
                                </div>
                                <select class="form-control" name="stockType" id="stockType">
                                    <option selected>Choose</option>
                                    <option>Liquid</option>
                                    <option>Solid</option>
                                </select>
                                </div>
                            </div>
                            
                            <div class="form-row"> <!--Container of start date and end date-->
                            <!--Category-->
                                <div class="input-group mb-3 col">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                        Category</span>
                                    </div>
                                    <select class="form-control" name="stockCategory" id="stockCategory">
                                        <option selected>Choose</option>
                                    </select>
                                </div>
                            <!--Status-->
                                <div class="input-group mb-3 col">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                        Status</span>
                                    </div>
                                    <select class="form-control" name="stockStatus" id="stockStatus">
                                        <option selected>Choose</option>
                                    </select>
                                </div>
                            </div>
                        <!--Add Stock Item-->
                            <a class="btn btn-primary btn-sm" style="color:blue;margin:0">Add Variance</a> <!--Button to add row in the table-->
                            <br><br>
                            <table class="table table-sm table-borderless"> <!--Table containing the different input fields in adding trans items -->
                                <thead class="thead-light">
                                    <tr>
                                        <th>Unit</th>
                                        <th>Size</th>
                                        <th>Minimum</th>
                                        <th>Qty</th>
                                        <th style="width:27%">Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><input type="text" name="varUnit" id="varUnit" class="form-control form-control-sm"></td>
                                        <td><input type="text" name="varSize" id="varSize" class="form-control form-control-sm"></td>
                                        <td><input type="number" name="varMinimun" id="varMinimun" class="form-control form-control-sm"></td>
                                        <td><input type="number" name="varQty" id="varQty" class="form-control form-control-sm"></td>
                                        <td>
                                            <select class="form-control" name="varStatus" id="varStatus">
                                                <option selected>Choose</option>
                                                <option></option>
                                            </select>
                                        </td>
                                        <td><img class="exitBtn" id="exitBtn" src="/assets/media/admin/error.png" style="width:20px;height:20px"></td>
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
<!--End of Modal "Add Stock item"-->

<!--Start of Modal "Edit Stock Item"-->
        <div class="modal fade bd-example-modal-lg" id="editStock" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update Stock Item</h5>
                        <button type="button" class="close" data-dismiss="modal"aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?php echo base_url()?>admin/inventory/add" method="get" accept-charset="utf-8">
                        <div class="modal-body">                                                                                                                                                      
                            <div class="form-row"> <!--Container of promo name and promo type-->
                            <!--Stock name-->
                                <div class="input-group mb-3 col">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                        Stock Name</span>
                                    </div>
                                    <input type="text" name="stockName" id="stockName" class="form-control form-control-sm">
                                </div>
                            <!--Stock type-->
                                <div class="input-group mb-3 col">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                    Promo Type</span>
                                </div>
                                <select class="form-control" name="stockType" id="stockType">
                                    <option selected>Choose</option>
                                    <option>Liquid</option>
                                    <option>Solid</option>
                                </select>
                                </div>
                            </div>
                            
                            <div class="form-row"> <!--Container of start date and end date-->
                            <!--Category-->
                                <div class="input-group mb-3 col">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                        Category</span>
                                    </div>
                                    <select class="form-control" name="stockCategory" id="stockCategory">
                                        <option selected>Choose</option>
                                    </select>
                                </div>
                            <!--Status-->
                                <div class="input-group mb-3 col">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                        Status</span>
                                    </div>
                                    <select class="form-control" name="stockStatus" id="stockStatus">
                                        <option selected>Choose</option>
                                    </select>
                                </div>
                            </div>
                        <!--Add Stock Item-->
                            <a class="btn btn-primary btn-sm" style="color:blue;margin:0">Add Variance</a> <!--Button to add row in the table-->
                            <br><br>
                            <table class="table table-sm table-borderless"> <!--Table containing the different input fields in adding trans items -->
                                <thead class="thead-light">
                                    <tr>
                                        <th>Unit</th>
                                        <th>Size</th>
                                        <th>Minimum</th>
                                        <th>Qty</th>
                                        <th style="width:27%">Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><input type="text" name="varUnit" id="varUnit" class="form-control form-control-sm"></td>
                                        <td><input type="text" name="varSize" id="varSize" class="form-control form-control-sm"></td>
                                        <td><input type="number" name="varMinimun" id="varMinimun" class="form-control form-control-sm"></td>
                                        <td><input type="number" name="varQty" id="varQty" class="form-control form-control-sm"></td>
                                        <td>
                                            <select class="form-control" name="varStatus" id="varStatus">
                                                <option selected>Choose</option>
                                                <option></option>
                                            </select>
                                        </td>
                                        <td><img class="exitBtn" id="exitBtn" src="/assets/media/admin/error.png" style="width:20px;height:20px"></td>
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
<!--End of Modal "Edit Stock Item"-->

<!--Start of Modal "Delete Stock Item"-->
        <div class="modal fade" id="deleteStock" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Delete Stock Item</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="confirmDelete">
                        <div class="modal-body">
                            <h6 id="deleteTableCode"></h6>
                            <p>Are you sure you want to delete this stock item?</p>
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
<!--End of Modal "Delete Stock Item"-->

   
</div>
</div>
</div>
</div>
</div>

<!--   Core JS Files   -->
<script src="<?= framework_url().'mdb/js/jquery-3.3.1.min.js';?>"></script>
<script src="<?= framework_url().'bootstrap-native/bootstrap.bundle.min.js'?>"></script>
<!--  Charts Plugin -->
<script src="assets/js/admin/chartist.min.js"></script>
<!--  Notifications Plugin    -->
<script src="assets/js/admin/bootstrap-notify.js"></script>
<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
<script src="assets/js/admin/light-bootstrap-dashboard.js?v=1.4.0"></script>
<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
<script src="assets/js/admin/demo.js"></script>

<script>
var inventory = <?= json_encode($inventory)?>;
var lastIndex = 0;
var rowsPerPage = inventory.stocks.length;
$(document).ready(function() {
    $("#addBtn").on('click',function(){
        $("#newStock form")[0].reset();
    });
    setTableData();
    $("#formAdd").on('submit', function(event){
        event.preventDefault();
        var name = $(this).find("input[name='stockName']").val();
        var qty = $(this).find("input[name='stockQty']").val();
        var unit = $(this).find("input[name='stockUnit']").val();
        var min = $(this).find("input[name='stockMin']").val();
        var category = $(this).find("select[name='categoryName']").val();
        var status = $(this).find("select[name='stockStatus']").val();
        $.ajax({
            url : "<?= site_url("admin/inventory/add")?>",
            method : "post",
            data : {
                stockName : name,
                stockQty : qty,
                stockUnit : unit,
                stockMin : min,
                categoryName : category,
                stockStatus : status
            },
            dataType: "json",
            beforeSend : function(){
                console.log(name, qty, unit, min, category, status);
            },
            success: function(data){
                console.log(data);
                inventory = data;
                lastIndex = 0;
                setTableData();
            },
            error: function(response, setting, error){
                console.log(response.responseText);
                console.log(error);
            },
            complete: function(){
                $("#newStock").modal("hide");
            }
        });
    });
    $("#formEdit").on('submit', function(event){
        event.preventDefault();
        var ID = $(this).find("input[name='stockID']").val();
        var name = $(this).find("input[name='stockName']").val();
        var qty = $(this).find("input[name='stockQty']").val();
        var unit = $(this).find("input[name='stockUnit']").val();
        var min = $(this).find("input[name='stockMin']").val();
        var category = $(this).find("select[name='categoryName']").val();
        var status = $(this).find("select[name='stockStatus']").val();
        console.log(ID, name, qty, unit, min, category, status);
        $.ajax({
            url : "<?= site_url("admin/inventory/edit")?>",
            method : "post",
            data : {
                stockID : ID,
                stockName : name,
                stockQty : qty,
                stockUnit : unit,
                stockMin : min,
                categoryName : category,
                stockStatus : status
            },
            dataType: "json",
            beforeSend : function(){
                console.log($(this).attr("action"),ID, name, qty, unit, min, category, status);
            },
            success: function(data){
                console.log(data);
                inventory = data;
                lastIndex = 0;
                setTableData();
            },
            error: function(response, setting, error){
                console.log(response.responseText);
                console.log(error);
            },
            complete: function(){
                $("#editStock").modal("hide");
            }
        });
    });
    // $('#example').DataTable({
    //         "dom": ' fBrtip',
    //         "lengthChange": false,
    //         "info": true,
    //         buttons: [{
    //                 "extend": 'excel',
    //                 "text": '<i class="fa fa-file-excel-o"></i> CSV',
    //                 "className": 'btn btn-success btn-xs',
    //                 exportOptions: {
    //                     columns: [0, 1, 2, 3, 4, 5]
    //                 }
    //             },

    //             "extend": 'pdf',
    //             "text": '<i class="fa fa-file-pdf-o"></i> PDF',
    //             "className": 'btn btn-danger btn-xs',
    //             "orientation": 'portrait',
    //             "title": 'Il-Lengan Inventory',
    //             "download": 'open',

    //             "messageBottom":
    //             "\n \n \n \n \n Prepared by:  <?php //echo $object->u_fname  . ' ' . $object->u_lname; ?>",
    //             styles: {
    //                 "messageBottom": {
    //                     bold: true,
    //                     fontSize: 15
    //                 }
    //             },
    //             "exportOptions": {
    //                 columns: [0, 1, 2, 3, 4, 5],

    //             },

    //             "header": true,
    //             customize: function(doc) {
    //                 var now = new Date();
    //                 var jsDate = now.getDate() + '-' + (now.getMonth() + 1) + '-' + now
    //                     .getFullYear();
    //                 var logo = 'data:assets/img/logo.png';
    //                 doc.content.splice(0, 1, {
    //                     text: [{
    //                         text: 'Il-Lengan Cafe.\n',
    //                         bold: true,
    //                         fontSize: 15
    //                     }, {
    //                         text: ' \n',
    //                         bold: true,
    //                         fontSize: 11
    //                     }, {
    //                         text: '',
    //                         bold: true,
    //                         fontSize: 11
    //                     }],
    //                     margin: [0, 0, 0, 20],
    //                     alignment: 'center',
    //                     image: logo
    //                 });
    //                 doc.content[1].table.widths = ['14%', '14%', '20%', '24%', '14%', '14%'];
    //                 doc.pageMargins = [40, 40, 40, 40];
    //                 doc['footer'] = (function(page, pages) {
    //                     return {
    //                         columns: [{
    //                                 alignment: 'left',
    //                                 text: ['Date Downloaded: ', {
    //                                     text: jsDate.toString()
    //                                 }]
    //                             },
    //                             {
    //                                 alignment: 'right',
    //                                 text: ['page ', {
    //                                     text: page.toString()
    //                                 }, ' of ', {
    //                                     text: pages.toString()
    //                                 }]
    //                             }
    //                         ],
    //                         margin: 20
    //                     }
    //                 });
    //             }

    //         }
    //     ]
    // });
});

function setTableData(){
    var count = 0 ;
    //set modal categories
    $("select[name='categoryName']").append(`
    ${inventory.categories.length === 0 ? "" : inventory.categories.map(category => {
        return `<option value="${category.category_id}">${category.category_name}</option>`
    }).join('')}`);

    if($("#stockTable > tbody").children().length === 0){
        for(lastIndex; lastIndex < inventory.stocks.length ; lastIndex++){
            if(count < rowsPerPage){
                appendRow(inventory.stocks[lastIndex]);
                // appendAccordion();
            }
        }
        $(".editBtn").on("click",function(){
            $("#editStock form")[0].reset();
            var stockID = $(this).closest("tr").attr("data-id");
            setEditModal($("#editStock"), inventory.stocks.filter(item => item.stock_id === stockID)[0]);
        });
    }else{
        $("#stockTable > tbody").empty();
    }
}
function appendRow(stock){
    var row = `
    <tr data-id="${stock.stock_id}">
        <td><img class="accordionBtn" src="/assets/media/admin/down-arrow%20(1).png"
                style="height:15px;width:15px" /></td>
        <td>${stock.stName}</td>
        <td>${stock.stqty}</td>
        <td>${stock.stock_minimum}</td>
        <td>${stock.ctName}</td>
        <td>${stock.stStatus}</td>
        <td>
            <button class="editBtn btn btn-primary btn-sm" data-toggle="modal"
                data-target="#editStock">Edit</button>
            <!--Delete button-->
            <button class="deleteBtn btn btn-danger btn-sm" data-toggle="modal"
                data-target="#deleteStock">Delete</button>
        </td>
    </tr>`;
    $("#stockTable > tbody").append(row);
}
function appendAccordion(card){
    var row = `
    <tr>
        <td colspan="7">
            <div style="margin:1% 4%;overflow:auto">
                <div>
                    <div>Beginning Inventory: <span><span></div>
                    <span>Variance</span>
                    <table class="table table-bordered dt-responsive nowrap">
                        <thead style="background:white">
                            <tr>
                                <th>Unit</th>
                                <th>Size</th>
                                <th>Minimum Qty</th>
                                <th>Qty</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div style="overflow:auto">
                    <!--Consumed table-->
                    <div style="width:30%;float:left">
                    <span>Consumed</span>
                    <table class="table table-bordered">
                        <thead style="background:#4CAF50">
                            <tr>
                                <th style="color:white">Qty</th>
                                <th style="color:white">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr style="background:white">
                                <td>3</td>
                                <td>February 2, 2019</td>
                            </tr>
                        </tbody>
                    </table>
                    </div>
                    <!--Spoilages table-->
                    <div style="width:30%;float:left;margin:0 5%">
                    <span>Spoilages</span>
                    <table class="table table-bordered">
                        <thead style="background:#ff6600">
                            <tr>
                                <th style="color:white">Qty</th>
                                <th style="color:white">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr style="background:white">
                                <td>3</td>
                                <td>February 3, 2019</td>
                            </tr>
                        </tbody>
                    </table>
                    </div>
                    <!--Returns table-->
                    <div style="width:30%;float:left">
                    <span>Returns</span>
                    <table class="table table-bordered">
                        <thead style="background:#3366ff">
                            <tr>
                                <th style="color:white">Qty</th>
                                <th style="color:white">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr style="background:white">
                                <td>1</td>
                                <td>February 4, 2019</td>
                            </tr>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </td>
    </tr>
    `;
    
}
function setEditModal(modal, data){
    modal.find("input[name='stockID']").val(data.stock_id);
    modal.find("input[name='stockName']").val(data.stock_name);
    modal.find("input[name='stockQty']").val(data.stock_quantity);
    modal.find("input[name='stockUnit']").val(data.stock_unit);
    modal.find("input[name='stockMin']").val(data.stock_minimum);
    modal.find("select[name='categoryName']").find(`option[value=${data.category_id}]`).attr("selected","selected");
    modal.find("select[name='stockStatus']").find(`option[value='${data.stock_status}']`).attr("selected","selected");
}

</script>
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
                    <a class="btn btn-default btn-sm" data-toggle="modal" data-target="#addSales" data-original-title
                        style="margin:0;" id="addBtn">Add Sales</a>
                    <br><br>
                    <table id="salesTable" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th></th>
                                <th><b class="pull-left">Slip No.</b></th>
                                <th><b class="pull-left">Table No.</b></th>
                                <th><b class="pull-left">Date</b></th>
                                <th><b class="pull-left">Total Sale</b></th>
                                <th><b class="pull-left">Actions</b></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>

                     <!--Start of Modal "Add Sales"-->
                    <div class="modal fade bd-example-modal-lg" id="addSales" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add Sales</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <!--Modal Content-->
                                <form id="formAdd" action="<?= site_url('admin/sales/add')?>" method="post"
                                    accept-charset="utf-8">
                                    <div class="modal-body">
                                        <div class="form-row">
                                            <!--Pay date-->
                                            <div class="input-group mb-3 col">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroup-sizing-sm"
                                                        style="background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                        Order Paid Date</span>
                                                </div>
                                                <input type="date" name="osPayDate" id="osPayDate"
                                                    class="form-control form-control-sm">
                                            </div>

                                            <!--Order date-->
                                            <div class="input-group mb-3 col">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroup-sizing-sm"
                                                        style="background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                        Order Date</span>
                                                </div>
                                                <input type="date" name="osDate" id="osDate"
                                                    class="form-control form-control-sm">
                                            </div>
                                        </div>
                                        <!-- Customer Name -->
                                        <div class="form-row">
                                            <div class="input-group mb-3 col">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroup-sizing-sm"
                                                        style="background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                        Customer Name</span>
                                                </div>
                                                <input type="text" name="custName" id="custName"
                                                    class="form-control form-control-sm">
                                            </div>

                                               <!-- Table Code -->
                                        <div class="input-group mb-3 col">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroup-sizing-sm"
                                                        style="background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                        Table Code</span>
                                                </div>
                                                <input type="text" name="tableCode" id="tableCode"
                                                    class="form-control form-control-sm">
                                            </div>
                                        </div>

                                        <!--Button to add row in the table-->
                                        <a id="addMenuItem" class="btn btn-default btn-sm" data-toggle="modal" data-target="#menuItems"
                                            data-original-title style="margin:0" id="">Add Items</a>
                                        <br><br>
                                        <!--Table containing the different input fields in adding PO items -->
                                        <table class="salesTable table table-sm table-borderless">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>Item Name</th>
                                                    <th width="10%">Qty</th>
                                                    <th width="15%">Price</th>
                                                    <th width="15%">Subtotal</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                            </tbody>
                                        </table>

                                        <!--Total of the trans items-->
                                        <span>Total: &#8369;<span id="total" class="total"> </span></span>
                                        <!--Modal Footer-->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger btn-sm"
                                                data-dismiss="modal">Cancel</button>
                                            <button class="btn btn-success btn-sm" id="submitPOrder" onclick="addSales()" type="button">Add</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- End of Modal "Add Sales" -->
                     <!--Start of Menu Items Modal"-->
                     <div class="modal fade bd-example-modal" id="menuItems" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true" style="background:rgba(0, 0, 0, 0.3)">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Select Menu Items</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form id="menuItemsForm" method="post"
                                    accept-charset="utf-8">
                                    <div class="modal-body">
                                        <div style="margin:1% 3%" id="list">
                                            <!--checkboxes-->
                                            <label style="width:96%"><input type="checkbox" class="mr-2" value="">Sample
                                                data 2</label>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger btn-sm"
                                            data-dismiss="modal">Cancel</button>
                                        <button type="button" class="btn btn-success btn-sm" data-dismiss="modal" onclick="getSelectedMenu()">Ok</button>
                                    </div>
                                </form> 
                            </div>
                        </div>
                    </div>
                    <!--End of Menu Items Modal"-->
                    
                    <!--Start of Modal "Delete Stock Item"-->
                    <div class="modal fade" id="deleteStock" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                                            Remarks:<input type="text" name="deleteRemarks" id="deleteRemarks"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary btn-sm"
                                            data-dismiss="modal">Close</button>
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

<?php include_once('templates/scripts.php') ?>
<script src="<?= admin_js().'addSales.js'?>"></script>
<script>
var orders = [];
var orderlists = [];
var orderslips = [];
var menuItems = [];
var tables = [];
     $(function () {
        $.ajax({
            url: '/admin/jsonSales',
            dataType: 'json',
            success: function (data) {
                var poLastIndex = 0;
                $.each(data.orderlists, function (index, items) {
                    orderlists.push({
                        "orderlists": items
                    });
                    orderlists[index].addons = data.addons.filter(ao => ao.olID == items.olID);
                   
                });
                $.each(data.orderslips, function (index, item) {
                    orderslips.push({
                        "orderslips": item
                    });
                    orderslips[index].orders = orderlists.filter(ol => ol.orderlists.osID == item.osID);
                });
                menuItems = data.menuitems;
                tables = data.tables;
                showTable();
            },
            failure: function () {
                console.log('None');
            },
            error: function (response, setting, errorThrown) {
                console.log(errorThrown);
                console.log(response.responseText);
            }
        });

        $("#addMenuItem").on('click',function(){
            setBrochureContent(menuItems);
        });
    });
    function setBrochureContent(menuitems){
        $("#list").empty();
        $("#list").append(`${menuitems.map(menu => {
            return `<label style="width:96%"><input type="checkbox" name="menuitems[]" class="orderitems mr-2" value="${menu.prID}"> ${menu.prName} - ${parseFloat(menu.prPrice).toFixed(2)}</label>`
        }).join('')}`);
    }
    $('#addBtn').on('click', function() {
        $('.salesTable > tbody').empty();
        $('#addSales form')[0].reset();
        $('#total').empty();
        $("#list").append(`${menuitems.map(menu => {
            return `<label style="width:96%"><input type="checkbox" name="menuitems[]" class="orderitems mr-2" value="${menu.prID}"> ${menu.prName} - ${parseFloat(menu.prPrice).toFixed(2)}</label>`
        }).join('')}`);
    });
    function showTable() {
       orderslips.forEach(function (item) {
            var tableRow = `
                <tr class="table_row" data-id="${item.orderslips.osID}">   <!-- table row ng table -->
                    <td><img class="accordionBtn" src="/assets/media/admin/down-arrow%20(1).png" style="height:15px;width: 15px"/></td>
                    <td>${item.orderslips.osID}</td>
                    <td>${item.orderslips.tableCode}</td>
                    <td>${item.orderslips.osPayDate}</td>
                    <td>&#8369; ${(parseFloat(item.orderslips.osTotal)).toFixed(2)}</td>
                    <td>
                        <button class="editBtn btn btn-sm btn-primary" data-toggle="modal" data-target="#editPO" id="editPOBtn">Edit</button>
                        <button class="deleteBtn btn btn-sm btn-danger" data-toggle="modal" data-target="#delete">Delete</button>
                    </td>
                </tr>
            `;
            var preferencesDiv = `
            <div class="preferences" style="float:left;margin-right:3%" > <!-- Preferences table container-->
                ${item.orders[0].orderlists === 0 ? "No orders" : 
                `
                <table id="orderitem" class=" table table-bordered"> <!-- Preferences table-->
                    <thead class="thead-light">
                        <tr>
                            <th></th>
                            <th scope="col">Item Name</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Price</th>
                            <th scope="col">Subtotal Price</th>
                        </tr>
                    </thead>
                    <tbody>
                    ${item.orders.map(ol => {
                        return `
                        <tr>
                        <td><img class="accordionBtn" src="/assets/media/admin/down-arrow%20(1).png" style="height:15px;width: 15px"/></td>
                            <td>${ol.orderlists.mName} ${ol.orderlists.prName === 'Normal' ? " " : ol.orderlists.prName }</td>
                            <td>${ol.orderlists.olQty}</td>
                            <td>&#8369; ${ol.orderlists.prPrice}</td>
                            <td>&#8369; ${(parseFloat(ol.orderlists.olSubtotal)).toFixed(2)}</td>
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
                <td colspan="10"> <!-- table row ng accordion -->
                    <div style="overflow:auto;display:none"> <!-- container ng accordion -->
                        
                        <div style="width:100%;overflow:auto;padding-left: 5%"> <!-- description, preferences, and addons container -->
                            
                            <div class="poAccordionContent" style="overflow:auto;margin-top:1%"> <!-- Preferences and addons container-->
                                
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            `;
            var addonsDiv = `
            <div class="addons" style="float:left;margin-right:3%" > <!-- Preferences table container-->
                ${item.orders[0].addons.length === 0 ? "No add ons" : 
                `
                <table class="table table-bordered"> <!-- Preferences table-->
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Add On</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Price</th>
                            <th scope="col">Subtotal Price</th>
                        </tr>
                    </thead>
                    <tbody>
                    ${item.orders[0].addons.map(or => {
                        return `
                        <tr>
                            <td>${or.aoName}</td>
                            <td>${or.aoQty}</td>
                            <td>&#8369; ${or.aoPrice}</td>
                            <td>&#8369; ${(parseFloat(or.aoTotal)).toFixed(2)}</td>
                        </tr>
                        `;
                    }).join('')}
                    </tbody>
                </table>
                `}
            </div>
            `;
            var aoAccordion = `
            <tr class="accordion" style="display:none">
                <td colspan="10"> <!-- table row ng accordion -->
                    <div style="overflow:auto;display:none"> <!-- container ng accordion -->
                        
                        <div style="width:100%;overflow:auto;padding-left: 5%"> <!-- description, preferences, and addons container -->
                            
                            <div class="aoAccordionContent" style="overflow:auto;margin-top:1%"> <!-- Preferences and addons container-->
                                
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            `;
            $("#salesTable > tbody").append(tableRow);
            $("#salesTable > tbody").append(accordion);
            $("#orderitem > tbody").append(aoAccordion);
            $(".poAccordionContent").last().append(preferencesDiv);
            $(".aoAccordionContent").last().append(addonsDiv);
        });
        $(".accordionBtn").on('click', function () {
            if ($(this).closest("tr").next(".accordion").css("display") == 'none') {
                $(this).closest("tr").next(".accordion").css("display", "table-row");
                $(this).closest("tr").next(".accordion").find("td > div").slideDown("slow");
            } else {
                $(this).closest("tr").next(".accordion").find("td > div").slideUp("slow");
                $(this).closest("tr").next(".accordion").hide("slow");
            }
        });

        $(".editBtn").on("click", function() {
        $("#editPO form")[0].reset();
        $("#editPO .poItemsTables > tbody").empty();
        var osID = $(this).closest("tr").attr("data-id");
        //setEditModal($("#editPO"), POs.purchorders.filter(item => item.osID === osID)[0], POs.orderlists.filter(poi => poi.osID === osID));
    });
    }


    
</script>
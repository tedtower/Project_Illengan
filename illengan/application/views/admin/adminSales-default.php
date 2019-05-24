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
                    <a class="btn btn-default btn-sm" data-toggle="modal" data-target="#newStock" data-original-title
                        style="margin:0;" id="addBtn">Add Sales</a>
                    <a class="btn btn-default btn-sm" data-toggle="modal" data-target="#restock" data-original-title
                        style="margin:0;" id="addBtn">Restock</a>
                    <br><br>
                    <table id="stockTable" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th></th>
                                <th><b class="pull-left">Slip No.</b></th>
                                <th><b class="pull-left">Table No.</b></th>
                                <th><b class="pull-left">Date</b></th>
                                <th><b class="pull-left">Total Sale</b></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                   


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
<script>
var orderslips = [];
     $(function () {
        $.ajax({
            url: '/admin/jsonSales',
            dataType: 'json',
            success: function (data) {
                var poLastIndex = 0;
                $.each(data.orderslips, function (index, item) {
                    orderslips.push({
                        "orderslips": item
                    });
                   orderslips[index].orderlists = data.orderlists.filter(ol => ol.osID == item
                        .osID);
                });
                // suppliers = data.suppliers;
                // suppMerch = data.supplierMerch;
                // setSupplierChoices(suppliers);
                showTable();
                console.log('YEHEY');
                console.log(orderslips);
            },
            failure: function () {
                console.log('None');
            },
            error: function (response, setting, errorThrown) {
                console.log(errorThrown);
                console.log(response.responseText);
            }
        });

        // $(".addPOItem").on('click',function(){
        //     var supID = parseInt($(this).closest(".modal").find("select[name='spID']").val());
        //     console.log(supID);
        //     setBrochureContent(suppMerch.filter(merch => parseInt(merch.spID) == supID));
        // });
    });
    function showTable() {
       orderslips.forEach(function (item) {
            var tableRow = `
                <tr class="table_row" data-id="${item.orderslips.osID}">   <!-- table row ng table -->
                    <td><img class="accordionBtn" src="/assets/media/admin/down-arrow%20(1).png" style="height:15px;width: 15px"/></td>
                    <td>${item.orderslips.osID}</td>
                    <td>${item.orderslips.tableCode}</td>
                    <td>${item.orderslips.osDate}</td>
                    <td>${(parseFloat(item.orderslips.osTotal)).toFixed(2)}</td>
                    <td>
                        <button class="editBtn btn btn-sm btn-primary" data-toggle="modal" data-target="#editPO" id="editPOBtn">Edit</button>
                        <button class="deleteBtn btn btn-sm btn-danger" data-toggle="modal" data-target="#delete">Delete</button>
                    </td>
                </tr>
            `;
            var preferencesDiv = `
            <div class="preferences" style="float:left;margin-right:3%" > <!-- Preferences table container-->
                ${item.orderlists.length === 0 ? "Not Applicable" : 
                `
                <table class="table table-bordered"> <!-- Preferences table-->
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Item Name</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Price</th>
                            <th scope="col">Subtotal Price</th>
                        </tr>
                    </thead>
                    <tbody>
                    ${item.orderlists.map(ol => {
                        return `
                        <tr>
                            <td>${ol.mName}</td>
                            <td>${ol.olQty}</td>
                            <td>&#8369; ${ol.prPrice}</td>
                            <td>${(parseFloat(ol.olSubtotal)).toFixed(2)}</td>
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
                <td colspan="5"> <!-- table row ng accordion -->
                    <div style="overflow:auto;display:none"> <!-- container ng accordion -->
                        
                        <div style="width:100%;overflow:auto;padding-left: 5%"> <!-- description, preferences, and addons container -->
                            
                            <div class="poAccordionContent" style="overflow:auto;margin-top:1%"> <!-- Preferences and addons container-->
                                
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            `;
            $("#poTable > tbody").append(tableRow);
            $("#poTable > tbody").append(accordion);
            $(".poAccordionContent").last().append(preferencesDiv);
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
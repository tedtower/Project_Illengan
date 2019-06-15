<!DOCTYPE html>
<htmL>

<head>
    <?php include_once('templates/head.php') ?>
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/css/barista/cards.css' ?>" type="text/css">
</head>

<body style="background:#c7ccd1;">
    <?php include_once('templates/navigation.php') ?>
    <button class="btn btn-success btn-sm" onClick="window.location.href = '<?php echo base_url();?>customer/checkin';return false;">
    <img class="addBtn" src="/assets/media/barista/add image.png" style="width:20px;height:20px; float:left;"> Add Order</button>
    <!--End Top Nav-->
    <div class="container-fluid">
        <section class="lists-container">
            <!-- Lists container -->
    </section>
    </div>
    <!-- End of lists container -->
    <!--End Cards-->

        <!--START "Remove Slip" MODAL-->
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteSlipModal" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Delete Slip</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body text-center py-2">
                            <i class="fas fa-times fa-4x animated rotateIn text-danger"></i>
                            <input hidden id="remID">
                            <p class="delius">Are you sure you want to remove this orderslip?</p>
                        </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                            </div>
                    </div>

                </div>
            </div>
        <!--START "Remove Slip" MODAL-->

            <!-- MODAL EDIT TABLE CODE-->
            <div class="modal fade" id="editTable" tabindex="-1" role="dialog" aria-labelledby="editTableModal" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Table Code</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <form id="formEdit" accept-charset="utf-8" > 
                  <div class="modal-body">
                        <h6 id="editTableCode"></h6>
                        <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="inputGroup-sizing-sm" style="width:130px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                            Change Table</span>
                        </div>
                          <select name="tableCode" id="tableCode" class="form-control form-control-sm" required>
                          </select>                    
                        <input name="osID" id="osID" hidden="hidden">
                  </div>
                  <div class="modal-footer">
                  <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
                  <button class="btn btn-success btn-sm" type="submit">Update</button>
                  </div>
                </div>
                </form>
              </div>
            </div>
        <!--END MODAL EDIT TABLE CODE-->

        <!--MODAL TO CANCEL AN ORDER -->
           <div class="modal fade" id="deleteOrder" tabindex="-1" role="dialog" aria-labelledby="deleteOrderModal" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteOrderModal">Cancel Order</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="confirmDelete">
                    <div class="modal-body">
                    <strong>Are you sure to remove this order?</strong>
                    <input type="hidden" name="olID" id="olID" class="form-control">
                    </div>
                    <div class="modal-footer">
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
        <!--END OF MODAL TO CANCEL AN ORDER -->



<?php include_once('templates/scripts.php')?>
<script>
      var orderslips = [];
      var orderlists = [];
      var addons = [];
      $(function() {
        $.ajax({
            url: '<?= base_url("barista/getOrderslip") ?>',
            dataType: 'json',
            success: function(data) {
                $.each(data.orderslips, function(index, item) {
                    orderslips.push({
                        "orderslips": item
                    });
                    orderslips[index].orderlists = data.orderlists.filter(ol => ol.osID == item.osID);
                });
                $.each(data.orderlists, function(index, item) {
                    orderlists.push({
                        "orderlists": item
                    });
                    orderlists[index].addons = data.addons.filter(adds => adds.olID == item.olID);
                });
                console.log(orderslips);
                setPenOrdersData();
                console.log('Success');
            },
            error: function(response, setting, errorThrown) {
                console.log(errorThrown);
                console.log(response.responseText);
            }
        });
    });
      function setPenOrdersData() {
              orderslips.forEach(function(item) {
                    var header = `
                    <!--Long Order Card-->
            <div class="list">
                <div class="card m-0 p-0" style="max-height:100%">
                    <!--Long Card Header-->
                    <div class="card-header p-3">
                        <div style="overflow:auto;font-size:14px">
                            <div style="float:left;text-align:left;width:73%">
                                <div><b>Slip No: </b> ${item.orderslips.osID}</div>
                                <div><b>Customer: </b>${item.orderslips.custName}</div>
                            </div>
                            <div style="float:right;text-align:left;width:27%">
                                <div><b> Table No: </b>${item.orderslips.tableCode} <img class="editBtn" src="/assets/media/barista/edit.png" style="width:15px;height:15px; float:right; cursor:pointer;" 
                                data-toggle="modal" data-target="#editTable" onclick="update()"></div>
                                <div><b>Status: </b>${item.orderslips.payStatus}</div>
                            </div>
                        </div>
                    </div>
                    
                    <!--Long Card Body-->
                    <div class="card-body p-2" style="overflow:auto">
                        <table class="table" id="pendingordersTable" style="width: auto; height: auto;border:0">
                            <thead style="background:white">
                                <tr class="border-bottom">
                                    <th>Qty</th>
                                    <th width="50%">Order</th>
                                    <th>Subtotal</th>
                                    <th width="20%">Status</th>
                                    <th style="width:2%"></th>
                                </tr>
                            </thead>
                    ${item.orderlists.map(ol => {
                                    return `
                                    <tbody style="font-size:13px">
                                <tr>
                                    <td>${ol.olQty}</td>
                                    <td>${ol.mName}</td>
                                    <td><span class="fs-24">₱</span>${ol.olSubtotal}</td>
                                    <td>
                                        <input type="button" style="width:100%;padding:6%;background:gray;color:white;border:0;border-radius:5px;"
                                        class="btn btn-sm" id="item_status" data-id="${ol.olID}" value="${ol.olStatus}"/>
                                    </td>
                                    <td>
                                        <img class="deleteBtn1" src="/assets/media/barista/error.png" style="width:18px;height:18px; float:right; cursor:pointer;" data-toggle="modal" data-target="#deleteOrder" >
                                    </td>
                                </tr>
                                <tr id="addons">
                                </tr>
                                    `;
                                }).join('')}  
                                
                            </tbody>
                        </table>
                    </div>
                    <!--Footer-->
                    <div class="card-footer text-muted">
                        <div style="overflow:auto;">
                            <div style="text-align:left;float:left;width:73%; font-size:15px;"><b>Total: </b><span style="border-bottom:1px solid gray; padding:3px 15px">&#8369;${item.orderslips.osTotal}</span></div>
                            <div style="float:right;width:25%;float:left;">
                                <button class="btn btn-warning btn-sm" style="font-size:13px;margin:0" data-toggle="modal" data-target="#deleteModal">Remove Slip</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                        `;

                $(".updateBtn").last().on('click', function () {
				$("#editTableCode").text(
                   `Edit table code ${$(this).closest("tr").attr("data-tID")}`);
                $("#editTable").find("input[name='osID']").val($(this).closest("tr").attr(
                    "data-osID"));
                });

            $(".deleteBtn1").last().on('click', function () {
                          $("#deleteOrder").find("input[name='olID']").val($(this).closest("tr").attr(
                                    "data-olID"));
                      });
            // orderlists.forEach(function(item){
            //     ${item.addons.map(adds => {
            //         var addOn = `<tr>
            //                      <td></td>
            //                      <td>${adds.aoName}</td>
            //                      <td>${adds.aoQty}</td>
            //                      <td>${(parseFloat(adds.aoTotal)).toFixed(2)}</td>
            //                      </tr>
            //         `;
            //     })}
                
             //});
            
                    $('.lists-container').append(header);
              });
              $("input#item_status").on('click', function () {
                var id = $(this).attr('data-id');
                var stats = $(this).val();
                if( stats == 'served'){
                    this.style.backgroundColor = "gray";
                    this.value= "pending";
                    stats = this.value;
                    console.log(stats, id);
                    updateStatus(stats, id);

                }else if(stats == 'pending'){
                    this.style.backgroundColor = "green";
                    this.value= "served";
                    stats = this.value;
                    console.log(stats, id);
                    updateStatus(stats, id);
                }
                location.reload();
            });
            
        }
        //function for updating orderlist status
        function updateStatus(stats, id){
            $.ajax({
                url: "<?= site_url('barista/updateStatus') ?>",
                method: "post",
                data : { 'olStatus' : stats,
                'osID' : id},
                success: function(data) {
            },
            error: function(response, setting, errorThrown) {
                console.log(response.responseText);
                console.log(errorThrown);
            }
            });
    }
            //function  to get available tables
            $(function() {
            $.ajax({
                        url: '<?= site_url('barista/getTables') ?>',
                        dataType: 'json',
                        success: function (data) {
                            var poLastIndex = 0;
                            table = data;
                            setTableData(table);
                        },
                        failure: function () {
                            console.log('None');
                        },
                        error: function (response, setting, errorThrown) {
                            console.log(errorThrown);
                            console.log(response.responseText);
                        }
                    });

            });
            function setTableData(table){
                    $("#tableCode").empty();
                    $("#tableCode").append(`${table.map(tables => {
                        return `<option name= "tableCode" id ="tableCode" value="${tables.tableCode}">${tables.tableCode}</option>`
                    }).join('')}`);
            }
            //function for updating table of slips
            function update(){
            $("#editBtn").on('submit', function(event) {
            event.preventDefault();
            var osID = $(this).find("input[name='osID']").val();
            var tableCode = $(this).find("select[name='tableCode']").val();
        
            $.ajax({
                url: "<?= site_url("barista/editTableNumber")?>",
                method: "post",
                dataType: "json",
                data: {
                    osID: osID,
                    tableCode: tableCode
                },
                success: function(data) {
                    alert('Table Updated');
                            console.log(data);
                },
                complete: function() {
                    $("#editTable").modal("hide");
                            location.reload();
                },
                error: function(error) {
                    console.log(error);
                }
                
            });
        });
            }

    </script>
</body>
</htmL>
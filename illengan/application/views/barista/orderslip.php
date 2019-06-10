<!DOCTYPE html>
<htmL>

<head>
    <?php include_once('templates/head.php') ?>
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/css/barista/cards.css' ?>" type="text/css">
</head>

<body style="background:#c7ccd1;">
    <?php include_once('templates/navigation.php') ?>
    <!--End Top Nav-->
    <div class="container-fluid">
        <section class="lists-container">
            <!-- Lists container -->
    </div>
    </section>
    <!-- End of lists container -->
    <!--End Cards-->
                <!--START "Remove Slip" MODAL-->
            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteOrderModal" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Delete Addon</h5>
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
<?= include_once('templates/scripts.php')?>
<script>
      var orderslips = [];
      var orderlists = [];
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
                                <div><b> Table No: </b>${item.orderslips.tableCode}</div>
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
                                <input type="hidden" id="menuitem" val="${ol.olID}">
                                    <td>${ol.olQty}</td>
                                    <td>${ol.mName}</td>
                                    <td><span class="fs-24">₱</span>${ol.olPrice}</td>
                                    <td>
                                        <input type="button" style="width:100%;padding:6%;background:blue;color:white;border:0;border-radius:5px"
                                       id="item_status" data-id="${ol.olID}" value="${ol.olStatus}"/>
                                    </td>
                                    <td>
                                        <img class="exitBtn1" src="/assets/media/admin/error.png" style="width:18px;height:18px; float:right;">
                                    </td>
                                </tr>`;
                                }).join('')}  
                                
                            </tbody>
                        </table>
                    </div>
                    <!--Footer-->
                    <div class="card-footer text-muted">
                        <div style="overflow:auto;">
                            <div style="text-align:left;float:left;width:73%; font-size:15px;"><b>Total:</b><span style="border-bottom:1px solid gray; padding:3px 15px">&#8369;${item.orderslips.osTotal}</span></div>
                            <div style="float:right;width:25%;float:left;">
                                <button class="btn btn-warning btn-sm" style="font-size:13px;margin:0" data-toggle="modal" data-target="#deleteModal">Remove Slip</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            `;
            $('.lists-container').append(header);
            });
              $("input#item_status").on('click', function () {
                var stats = $(this).val();
                if( stats == 'served'){
                    $(this).prop('disabled', true);
                }else{
                var id = $(this).attr('data-id');
                this.style.backgroundColor = "green";
                this.value= "served";
                stats = this.value;
                console.log(stats, id);
                updateStatus(stats, id);
                }
            });
            
        }
        function updateStatus(stats, id){
            console.log(stats, id);
            $.ajax({
                url: "<?= site_url('barista/updateStatus') ?>",
                method: "post",
                data : { 
                    'status' : stats,
                    'id' : id
                },
                success: function(data) {
                    location.reload();
            },
            error: function(response, setting, errorThrown) {
                console.log(response.responseText);
                console.log(errorThrown);
            }
            });
    }
   
    </script>
</body>
</htmL>

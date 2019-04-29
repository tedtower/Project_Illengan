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
                    <a class="btn btn-primary btn-sm ml-0 mb-3" data-toggle="modal" href="#addConsumedModal" id="addConsumedBtn">Add Consumed Item/s</a>
                    <table id="poTable" class="table dt-responsive nowrap text-center" cellspacing="0" width="100%">
                        <thead class="thead-light">
                            <tr>
                                <th class="w-10"></th>
                                <th><b>Destock Date</b></th>
                                <th><b>Date Recorded</b></th>
                                <th><b>Item Count</b></th>
                                <th><b>Actions</b></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $x=0; if(count($consumptions) < 1){
                            echo "<tr><td colspan='5'>No result. Try to consume item/s from the inventory.</td></tr>";
                        }else{
                            foreach($consumptions as $c){
                        ?> 
                            <tr class="table_row">
                                <td><img class="accordionBtn" src="/assets/media/admin/down-arrow%20(1).png" style="height:15px;width: 15px"/></td>
                                <td><?= date("F d, Y", strtotime($c['cnDate'])) ?></td>
                                <td><?= date("F d, Y h:i:s A", strtotime($c['cnDateRecorded'])) ?></td>
                                <td><?= $c['countItem'] ?></td>
                                <?php if($x != 1){ $x++ ?>
                                <td>
                                    <a class="editBtn btn btn-sm btn-secondary" data-toggle="modal" href="#editModal">Edit</a>
                                    <a class="deleteBtn btn btn-sm btn-danger" data-toggle="modal" href="#deleteModal">Delete</a>
                                </td>
                                <?php } ?>
                            </tr>
                            <tr class="accordion" style="display:none">
                                <td colspan="5">
                                    <div class="d-flex justify-content-center" style="overflow:auto;display:none">
                                        <div class="mt-1 w-75">
                                            <table class="table table-bordered">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th>Item Name</th>
                                                        <th>Consumed Quantity</th>
                                                        <th>Remaining Quantity</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($conitems as $cni) {
                                                        if($cni['cnID'] == $c['cnID']){ ?>
                                                            <tr>
                                                                <td><?= $cni['stName'].", ".$cni['vUnit']." (".$cni['vSize'].")" ?></td>
                                                                <td><?= $cni['cnQty'] ?></td>
                                                                <td><?= $cni['remainingQty'] ?></td>
                                                            </tr>
                                                    <?php }} ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php }} ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="modal fade bd-example-modal-lg" id="addConsumedModal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Consumed Item/s</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <!--Modal Content-->
                    <form id="formAddConsumption" method="post" accept-charset="utf-8">
                        <div class="modal-body">
                            <div class="input-group input-group-sm mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Consumption Date</span>
                                </div>
                                <input type="date" name="cnDate" class="form-control" required>
                            </div>
                            <a class="btn btn-dark btn-sm ml-0 mb-3" href="javascript:void(0)" id="addConsumedInputBtn"><b>Add Additional Consumed Item</b></a>
                            <div class="d-flex justify-content-center">
                                <table class="destockTable table table-sm table-borderless" style="width:90%">
                                    <thead class="thead-light">
                                        <tr class="text-center">
                                            <th width="65%"><b>Item Name</b></th>
                                            <th width="*"><b>Consumed Quantity</b></th>
                                            <th width="20px"></th>
                                        </tr>
                                    </thead>
                                    <tbody id="destockBodyTable">
                                        <tr>
                                            <td>
                                                <select name="cnVar[]" class="selectVar form-control form-control-sm" required>
                                                    <option value="" selected disabled>Choose Item</option>
                                                    <?php foreach ($variance as $v){ ?>
                                                        <option value="<?= $v['vID'] ?>" data-qty="<?= $v['vQty'] ?>"><?= $v['poItem'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </td>
                                            <td><input type="number" name="cnQty[]" class="inputCnQty form-control form-control-sm text-center" min="1" required></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!--Modal Footer-->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary btn-sm" id="submitConsumed">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade bd-example-modal-lg" id="deleteModal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-body text-center">
                        <p><b>You are going to delete the recently recorded consumption. Please confirm to continue.</b></p>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger" id="deleteConsumed">Delete</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade bd-example-modal-lg" id="editModal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        Edit Modal Here
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<?php include_once('templates/scripts.php') ?>
<script>
    <?php echo "var variances =".json_encode($variance).";\n"; ?>
    $(".accordionBtn").on('click', function () {
        $(this).toggleClass('flip');
        if ($(this).closest("tr").next(".accordion").css("display") == 'none') {
            $(this).closest("tr").next(".accordion").css("display", "table-row");
            $(this).closest("tr").next(".accordion").find("td > div").slideDown("slow");
        } else {
            $(this).closest("tr").next(".accordion").find("td > div").slideUp("slow");
            $(this).closest("tr").next(".accordion").hide("slow");
        }
    });
    $('#addConsumedInputBtn').click(function(){
        var formString = `<tr>
            <input type="hidden" name="">
            <td><select name="cnVar[]" id="temp" class="selectVar form-control form-control-sm" required><option value="" selected disabled>Choose Item</option></select></td>
            <td><input type="number" name="cnQty[]" class="inputCnQty form-control form-control-sm text-center" min="1" required></td>
            <td class="text-center" id="temp1"><a href="javascript:void(0)" class="exitBtn"><img src="/assets/media/admin/error.png" style="width:20px;height:20px"></a></td>
        </tr>`;
        $('#destockBodyTable').append(formString);
        for(var x=0; x<variances.length; x++){
            $('select#temp').append('<option value="'+variances[x].vID+'" data-qty="'+variances[x].vQty+'">'+variances[x].poItem+'<span data-qty=></span></option>');
        }
        $('select#temp').removeAttr('id');
        $(".exitBtn").on('click',function(){
            $(this).closest("tr").remove();
        });
    });
    $('form#formAddConsumption').on('submit',function(event){
        event.preventDefault();
        var destockVariances = [],
            date = $(this).find("input[name='cnDate']").val();
        for (var index = 0; index < $(this).find(".destockTable > tbody").children().length; index++) {
            var curQty = $(this).find("select[name='cnVar[]']").eq(index).find('option:selected').attr('data-qty'),
                desQty = $(this).find("input[name='cnQty[]']").eq(index).val(),
                remQty = parseInt(curQty) - parseInt(desQty);
            destockVariances.push({
                varConsumed: $(this).find("select[name='cnVar[]']").eq(index).val(),
                consumedQty: desQty,
                remainingQty: remQty
            });
        }
        console.log(destockVariances);
        $.ajax({
            url: "<?= site_url("admin/consumption/add")?>",
            method: "post",
            data: {
                consumedDate: date,
                consumptions: JSON.stringify(destockVariances)
            },
            dataType: "json",
            error: function(response, setting, error) {
                console.log(response.responseText);
                console.log(error);
            },
            complete: function() {
                $("#addConsumedModal").modal("hide");
                console.log('Yay');
            }
        });
    });
</script>
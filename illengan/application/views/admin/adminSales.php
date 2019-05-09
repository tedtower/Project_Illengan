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
                                <th><b class="pull-left">Total Qty</b></th>
                                <th><b class="pull-left">Total Sale</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr data-id="">
                                <td><img class="accordionBtn" src="/assets/media/admin/down-arrow%20(1).png"
                                        style="height:15px;width:15px" /></td>
                                <td>1</td>
                                <td>T1</td>
                                <td>April 5, 2019</td>
                                <td>5</td>
                                <td>&#8369; 500</td>
                            </tr>
                            <tr class="accordion" style="display:none">
                                <td colspan="6">
                                    <div style="margin:1% 4%;overflow:auto;display:none">
                                        <span>Variances</span>
                                        <table class="table table-bordered dt-responsive nowrap">
                                            <thead style="background:white">
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Unit</th>
                                                    <th>Size</th>
                                                    <th>Beginning Qty</th>
                                                    <th>Minimum Qty</th>
                                                    <th>Qty</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </td>
                            </tr>
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
    // setTableData();

    
</script>
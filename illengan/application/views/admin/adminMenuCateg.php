<!doctype html>
<html lang="en">

<head>
    <?php include_once('templates/head.php') ?>
</head>

<body>
    <?php include_once('templates/sideNav.php') ?>
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
                                <a class="btn btn-default btn-sm" data-toggle="modal" data-target="#newCategory" data-original-title style="float: left" id="addCategroy">Add Category</a>
                                <br>
                                <br>
                                <table id="categTable" class="table table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                    <thead>
                                        <th><b class="pull-left">Category Name</b></th>
                                        <th><b class="pull-left">Number of Items</b></th>
                                        <th><b class="pull-left">Actions</b></th>
                                    </thead>
                                    <tbody>
                                        <!-- <tr style="display:none">
                                                <td colspan="6">
                                                    <div class="container" style="display:none"> Container ng accordion
                                                        <span>Date Recorded: </span>
                                                        <div>Remarks:<p></p></div>
                                                        <table class="table">
                                                            <tr>
                                                                <thead style="background:white">
                                                                    <th>Name</th>
                                                                    <th>Qty</th>
                                                                    <th>Unit</th>
                                                                    <th>Price</th>
                                                                    <th>Subtotal</th>
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
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr> -->
                                    </tbody>
                                </table>
                                <!--End Table Content-->

                                <!--Start of Modal "Add Transaction"-->
                                <div class="modal fade bd-example-modal-lg" id="newCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form id="formAdd" action="<?= site_url('admin/menu/categories/add') ?>" method="post" accept-charset="utf-8">
                                                <div class="modal-body">
                                                    <div class="form-row">
                                                        <!--Container-->
                                                        <!--Category Name-->
                                                        <div class="input-group mb-3 col">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="inputGroup-sizing-sm" style="width:130px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                    Category Name</span>
                                                            </div>
                                                            <input type="text" name="ctName" id="ctName" class="form-control form-control-sm">
                                                        </div>
                                                        <!--Source Name-->
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                    Type</span>
                                                            </div>
                                                            <select class="sources custom-select" name="ctType" id="ctType">
                                                                <option selected>Choose</option>
                                                            </select>
                                                        </div>
                                                        <!--Remarks-->
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                    Remarks</span>
                                                            </div>
                                                            <textarea type="text" name="remarks" id="remarks" class="form-control form-control-sm"></textarea>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
                                                            <button class="btn btn-success btn-sm" type="submit">Add</button>
                                                        </div>
                                                    </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!--End of Modal "Add Menu Category"-->

                                <!--Modal "Edit Menu Category" -->
                                <div class="modal fade bd-example-modal-lg" id="updateCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form id="formEdit" action="<?= site_url('admin/categories/edit') ?>" method="post" accept-charset="utf-8">
                                                <div class="modal-body">
                                                    <div class="form-row">
                                                        <input type="text" name="" hidden="hidden" />
                                                        <!--Container-->
                                                        <!--Category Name-->
                                                        <div class="input-group mb-3 col">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="inputGroup-sizing-sm" style="width:130px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                    Category Name</span>
                                                            </div>
                                                            <input type="text" name="ctName" id="ctName" class="form-control form-control-sm">
                                                        </div>
                                                        <!--Source Name-->
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                    Source</span>
                                                            </div>
                                                            <select class="sources custom-select" name="ctType" id="ctType">
                                                                <option selected>Choose</option>
                                                            </select>
                                                        </div>
                                                        <!--Remarks-->
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                    Remarks</span>
                                                            </div>
                                                            <textarea type="text" name="remarks" id="remarks" class="form-control form-control-sm"></textarea>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
                                                            <button class="btn btn-success btn-sm" type="submit">Update</button>
                                                        </div>
                                                    </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!--End Modal "Edit Category" -->

                                <!--Start of Delete Modal-->
                                <div class="modal fade" id="deleteCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Delete Category</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form id="confirmDelete">
                                                <div class="modal-body">
                                                    <h6 id="deleteTableCode"></h6>
                                                    <p>Are you sure you want to delete this category?</p>
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
    </div>
    <?php include_once('templates/scripts.php') ?>
</body>
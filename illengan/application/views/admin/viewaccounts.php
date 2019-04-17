<!doctype html>
<html lang="en">
</head>

<body>

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
                                <a class="btn btn-default btn-sm" data-toggle="modal" data-target="#addNewAccounts" data-original-title style="margin: 0;">Add New
                                    Account</a>

                                <br><br>
                                <table id="accounts" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                    <thead>
                                        <th><b class="pull-left">Account No.</b></th>
                                        <th><b class="pull-left">Username</b></th>
                                        <th><b class="pull-left">Type</b></th>
                                        <th><b class="pull-left">Password</b></th>
                                        <th><b class="pull-left">Online</b></th>
                                        <th><b class="pull-left">Actions</b></th>
                                    </thead>
                                    <tbody>
                                        <!--Insert PHP-->
                                        <?php
                                        if (isset($account)) {
                                            foreach ($account as $row) {
                                                ?>
                                                <tr id="<?php echo $row['account_id']; ?>">
                                                    <td data-target="account_id">
                                                        <?php echo $row['account_id']; ?>
                                                    </td>
                                                    <td data-target="account_username">
                                                        <?php echo $row['account_username']; ?>
                                                    </td>
                                                    <td data-target="account_type">
                                                        <?php echo $row['account_type']; ?>
                                                    </td>
                                                    <td data-target="account_password">
                                                        <?php echo $row['account_password']; ?>
                                                    </td>
                                                    <td data-target="is_online">
                                                        <?php echo $row['is_online']; ?>
                                                    </td>
                                                    <td>
                                                        <div>
                                                            <!--Edit button-->
                                                            <a id="edit" class="btn btn-info btn-sm" data-toggle="modal" data-target="#editAccounts" data-original-title style="float: left" name="editAccounts" data-id="<?php echo $row['account_id'] ?>">Edit</a>
                                                            <!--Delete button-->
                                                            <a class="btn btn-danger btn-sm" role="button" href="modal" data-role="#deleteAccounts" data-toggle="modal">Delete</a>
                                                            <!--Change Pass button-->
                                                            <a class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editPassword" data-original-title style="float: left" name="editPassword" data-id="<?php echo $row['account_id'] ?>">Change Password</a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php
                                        }
                                    } else {
                                        echo "There is no data";
                                    }

                                    ?>
                                    </tbody>
                                </table>
                                <!--End Table-->
                                <!--Start of Modal "Add New Account"-->
                                <div class="modal fade" id="addNewAccounts" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Add Account</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form id="formAdd" action="<?= site_url('admin/accounts/add') ?>" method="post" accept-charset="utf-8">
                                                <div class="modal-body">
                                                    <!--Container-->
                                                    <!--Username-->
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                Username</span>
                                                        </div>
                                                        <input type="text" name="account_username" id="account_username" class="form-control form-control-sm">
                                                        <!--Password-->
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                Password</span>
                                                        </div>
                                                        <input type="text" name="password" id="password" class="form-control form-control-sm">
                                                    </div>
                                                    <!--Confirm Password-->
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm" style="width:140px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                Confirm Password</span>
                                                        </div>
                                                        <input type="text" name="confirm_password" id="confirm_password" class="form-control form-control-sm">
                                                    </div>
                                                    <!--Account Type-->
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm" style="width:120px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                Account Type</span>
                                                        </div>
                                                        <select class="custom-select" name="account_type" id="account_type">
                                                            <option value="admin" selected>Admin</option>
                                                            <option value="barista">Barista</option>
                                                            <option value="chef">Chef</option>
                                                        </select>
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
                                <!--End of Modal "Add New Account"-->

                                <!--Start of Modal "Edit New Account"-->
                                <div class="modal fade" id="editAccounts" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Account</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form id="formEdit" action="<?= site_url('admin/accounts/edit') ?>" method="post" accept-charset="utf-8">
                                                <div class="modal-body">
                                                    <!--Container-->
                                                    <!--Username-->
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                Username</span>
                                                        </div>
                                                        <input type="text" name="account_username" id="account_username" class="form-control form-control-sm">
                                                    </div>
                                                    <!--Account Type-->
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm" style="width:110px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                Account Type</span>
                                                        </div>
                                                        <select class="custom-select" name="account_type" id="account_type">
                                                            <option value="admin" selected>Admin</option>
                                                            <option value="barista">Barista</option>
                                                            <option value="chef">Chef</option>
                                                        </select>
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
                                <!--End of Modal "Edit New Account"-->

                                <!--Start of Modal "Change Password"-->
                                <div class="modal fade" id="editPassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Password</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form id="formEdit" action="<?= site_url('admin/accounts/changepassword') ?>" method="post" accept-charset="utf-8">
                                                <div class="modal-body">
                                                    <!--Container-->
                                                    <!--Old Password-->
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm" style="width:140px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                Old Password</span>
                                                        </div>
                                                        <input type="text" name="old_password" id="old_password" class="form-control form-control-sm">
                                                    </div>
                                                    <!--New Password-->
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm" style="width:140px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                New Password</span>
                                                        </div>
                                                        <input type="text" name="old_password" id="new_password" class="form-control form-control-sm">
                                                    </div>
                                                    <!--Confirm Password-->
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm" style="width:140px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                Confirm Password</span>
                                                        </div>
                                                        <input type="text" name="new_password_confirmation" id="new_password_confirmation" class="form-control form-control-sm">
                                                    </div>
                                                        <input type='hidden' name="account_id" value='<?php  echo $account_id;  ?>'/>
                                                    <!--Footer-->
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
                                                        <button class="btn btn-success btn-sm" type="submit_password">Update</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!--End of Modal "Change Password"-->

                                <!--Start "Delete" Modal-->
                                <div class="modal fade" id="deleteAccounts" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Delete Account</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form id="confirmDelete">
                                        <div class="modal-body">
                                            <h6 id="deleteTableCode"></h6>
                                            <p>Are you sure you want to delete this account?</p>
                                            <input type="text" name="tableCode" hidden="hidden">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                                <!--End "Delete" Modal-->

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<?php include_once('templates/scripts.php') ?>
<script>
    $(document).ready(function() {
        $('.delete_data').click(function() {
            var id = $(this).attr("id");
            if (confirm("Are you sure you want to delete this?")) {
                window.location = "<?php echo base_url(); ?>admin/accounts/delete/" + id;
            } else {
                return false;
            }
        });
    });

    var tuples = ((document.getElementById('accounts')).getElementsByTagName('tbody'))[0].getElementsByTagName(
        'tr');
    var tupleNo = tuples.length;
    var editButtons = document.getElementsByName('editAccounts');
    var editModal = document.getElementById('editAccounts');
    for (var x = 0; x < tupleNo; x++) {
        editButtons[x].addEventListener("click", showEditModal);
    }

    function showEditModal(event) {
        var row = event.target.parentElement.parentElement.parentElement;
        document.getElementById('account_id').value = parseInt(row.firstElementChild.innerHTML);
        document.getElementById('account_username').value = (row.firstElementChild.nextElementSibling.innerHTML).trim();
        document.getElementById('account_type').value = capitalizeFirstLetter((row.firstElementChild.nextElementSibling.nextElementSibling.innerHTML).trim());

    }
</script>

</html>
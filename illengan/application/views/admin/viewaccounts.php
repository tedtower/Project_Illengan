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
                                <table id="accountsTable" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                    <thead>
                                        <th><b class="pull-left">Account No.</b></th>
                                        <th><b class="pull-left">Type</b></th>
                                        <th><b class="pull-left">Username</b></th>
                                        <th><b class="pull-left">Password</b></th>
                                        <th><b class="pull-left">Online</b></th>
                                        <th><b class="pull-left">Actions</b></th>

                                    </thead>
                                    <tbody id="show_data">
                                    </tbody>
                                </table>
                                <!-- Start "Add Account" Modal-->
                                <div class="modal fade" id="addNewAccounts" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Add New Account</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form id="formAdd" action="<?= site_url('admin/accounts/add') ?>" method="post" accept-charset="utf-8">
                                                <div class="modal-body">
                                                    <!--End "Add Account" Modal-->
                                                    <!--Username-->
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm" style="width:140px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                Username</span>
                                                        </div>
                                                        <input type="text" name="aUsername" id="aUsername" class="form-control form-control-sm">
                                                        <span class="text-danger"><?php echo form_error("aUsername"); ?></span>
                                                    </div>
                                                    <!--Password-->
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm" style="width:140px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                Password</span>
                                                        </div>
                                                        <input type="text" name="password" id="password" class="form-control form-control-sm">
                                                        <span class="text-danger"><?php echo form_error("password"); ?></span>
                                                    </div>
                                                    <!--Confirm Password-->
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm" style="width:140px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                Confirm Password</span>
                                                        </div>
                                                        <input type="text" name="confirm_password" id="confirm_password" class="form-control form-control-sm">
                                                        <span class="text-danger"><?php echo form_error("confirm_password"); ?></span>
                                                    </div>
                                                    <!--Account Type-->
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm" style="width:140px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                Account Type</span>
                                                        </div>
                                                        <select class="custom-select" name="new_aType" id="new_aType">
                                                            <option value="admin" selected>Admin</option>
                                                            <option value="barista">Barista</option>
                                                            <option value="chef">Chef</option>
                                                        </select>
                                                    </div>
                                                    <!--Footer-->
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
                                                        <button class="btn btn-success btn-sm" type="submit">Add</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- End of Add Account Modal-->

                                <!-- Start "Edit Account" Modal-->
                                <div class="modal fade" id="editAccount" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                    <!--End "Add Account" Modal-->
                                                    <!--Username-->
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm" style="width:140px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                Username</span>
                                                        </div>
                                                        <input type="text" name="new_aUsername" id="new_aUsername" class="form-control form-control-sm">
                                                        <span class="text-danger"><?php echo form_error("new_aUsername"); ?></span>
                                                    </div>
                                                    <!--Account Type-->
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm" style="width:140px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                Account Type</span>
                                                        </div>
                                                        <select class="custom-select" name="accountType" id="accountType">
                                                            <option value="admin" selected>Admin</option>
                                                            <option value="barista">Barista</option>
                                                            <option value="chef">Chef</option>
                                                        </select>
                                                    </div>
                                                    <!--Footer-->
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
                                                        <button class="btn btn-success btn-sm" type="submit">Update</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!--End "Edit Account" Modal-->

                                <!--Start "Change Password" Modal-->
                                <div class="modal fade" id="editPassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form id="formAdd" action="<?= site_url('admin/accounts/changepassword') ?>" method="post" accept-charset="utf-8">
                                                <div class="modal-body">
                                                    <!--Old Password-->
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm" style="width:140px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                Old Password</span>
                                                        </div>
                                                        <input type="text" name="old_password" id="old_password" class="form-control form-control-sm">
                                                        <span class="text-danger"><?php echo form_error("old_password"); ?></span>
                                                    </div>
                                                    <!--New Password-->
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm" style="width:140px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                New Password</span>
                                                        </div>
                                                        <input type="text" name="new_password" id="new_password" class="form-control form-control-sm">
                                                        <span class="text-danger"><?php echo form_error("new_password"); ?></span>
                                                    </div>
                                                    <!--Confirm Password-->
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm" style="width:140px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                Confirm Password</span>
                                                        </div>
                                                        <input type="text" name="new_confirm_password" id="new_confirm_password" class="form-control form-control-sm">
                                                        <span class="text-danger"><?php echo form_error("new_confirm_password"); ?></span>
                                                    </div>
                                                    <!--Footer-->
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
                                                        <button class="btn btn-success btn-sm" type="submit">Update</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!--End "Edit Account Modal-->
                                <!--Start "Delete Account" Modal-->
                                <div class="modal fade" id="deleteAccount" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Delete Account</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form id="confirmDelete">
                                                <div class="modal-body">
                                                    <h6 id="deleteAccountId"></h6>
                                                    <p>Are you sure you want to delete this table?</p>
                                                    <input name="accountId" hidden="hidden">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                </div>
                                            </form>
                                            <!--End of Delete Modal -->
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
    var accounts = [];
    $(function() {
        viewAccountsJs();

        // Delete Account Function====================================

        $("#confirmDelete").on('submit', function(event) {
            event.preventDefault();
            var accountId = $(this).find("input").val();
            console.log(accountId);
            $.ajax({
                url: '<?= site_url('admin/accounts/delete') ?>',
                method: 'POST',
                data: {
                    accountId: accountId
                },
                dataType: 'json',
                success: function(data) {
                    accounts = data;
                    setAccountData();
                    location.reload();
                }
            });
        });
    });

    // Edit Account Info Function====================================
    var tuples = ((document.getElementById('accountsTable')).getElementsByTagName('tbody'))[0]
        .getElementsByTagName('tr');
    var tupleNo = tuples.length;
    var editButtons = document.getElementsByName('editAccount');
    var editModal = document.getElementById('editAccount');
    for (var x = 0; x < tupleNo; x++) {
        editButtons[x].addEventListener("click", showEditModal);
    }

    function showEditModal(event) {
        var row = event.target.parentElement.parentElement.parentElement;
        document.getElementById('aID').value = parseInt(row.firstElementChild.innerHTML);
        document.getElementById('aUsername').value = (row.firstElementChild.nextElementSibling
            .innerHTML).trim();
        document.getElementById('aType').value = capitalizeFirstLetter((row.firstElementChild
            .nextElementSibling.nextElementSibling.innerHTML).trim());
    }



    // Edit Account Password===========================================
    $('#show_data').on('click', '.item_edit', function() {
        var aID = $(this).data('aID');

        $('#editPassword').modal('show');
    });


    $('#btn_update').on('click', function() {
        var aID = $('#aID').val();
        var old_password = $('#old_password').val();
        var new_password = $('#new_password').val();
        var new_password_confirmation = $('#new_password_confirmation').val();
        $.ajax({
            type: "POST",
            url: "http://illengan.com/admin/accounts/changepassword",
            dataType: "JSON",
            data: {
                aID: aID,
                old_password: old_password,
                new_password: new_password,
                new_password_confirmation: new_password_confirmation
            },
            success: function(data) {
                $('[name="aID"]').val("");
                $('[name="old_password"]').val("");
                $('[name="new_password"]').val("");
                $('[name="new_password_confirmation"]').val("");
                $('#editPasswordModal').modal('hide');
                alert("Table Code was successfully updated!");
                location.reload();
            }
        });
        return false;
    });


    //Display data to table====================================================
    function viewAccountsJs() {
        $.ajax({
            url: "<?= site_url('admin/accounts/viewAccountsJs') ?>",
            method: "post",
            dataType: "json",
            success: function(data) {
                accounts = data;
                setAccountData(accounts);
            },
            error: function(response, setting, errorThrown) {
                console.log(response.responseText);
                console.log(errorThrown);
            }
        });
    }

    function setAccountData() {
        if ($("#accountsTable> tbody").children().length > 0) {
            $("#accountsTable> tbody").empty();
        }
        accounts.forEach(table => {
            $("#accountsTable> tbody").append(`
            <tr data-id="${table.aID}">
                <td>${table.aID}</td>
                <td>${table.aType}</td>
                <td>${table.aUsername}</td>
                <td>${table.aPassword}</td>
                <td>${table.aIsOnline}</td>
                <td>
                        <!--Action Buttons-->
                        <div class="onoffswitch">

                            <!--Edit button-->
                            <button class="updateBtn btn btn-default btn-sm" data-toggle="modal"
                                data-target="#editAccount">Edit</button>
                            <!--Delete button-->
                            <button class="item_delete btn btn-danger btn-sm" data-toggle="modal" 
                            data-target="#deleteAccount">Delete</button>
                            <!--Change Pass button-->
                            <a class="updatePassBtn btn btn-info btn-sm" data-toggle="modal" data-target="#editPassword"
                            data-original-title style="float: left" >Change Password</a>
                                                  
                        </div>
                    </td>
                </tr>`);
            $(".updateBtn").last().on('click', function() {
                $("#editAccount").find("input[name='accountId']").val($(this).closest("tr").attr(
                    "data-id"));
            });
            $(".updatePassBtn").last().on('click', function() {
                $("#editPassword").find("input[name='accountId']").val($(this).closest("tr").attr(
                    "data-id"));
            });
            $(".item_delete").last().on('click', function() {
                $("#deleteAccountId").text(
                    `Delete account code ${$(this).closest("tr").attr("data-id")}`);
                $("#deleteAccount").find("input[name='accountId']").val($(this).closest("tr").attr(
                    "data-id"));
            });
        });
    }
</script>

</html>
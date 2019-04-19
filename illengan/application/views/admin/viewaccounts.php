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
                                <a class="btn btn-default btn-sm" data-toggle="modal" data-target="#addNewAccounts"
                                    data-original-title style="float: left">Add New
                                    Account</a>
                                
                                <br><br>
                                <table id="accounts" class="table table-striped table-bordered dt-responsive nowrap"
                                    cellspacing="0" width="100%">
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
                                            if (isset($account)){
                                                foreach ($account as $row){
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
                                                    <a id="edit" class="btn btn-info btn-sm" data-toggle="modal" data-target="#editAccounts"
                                                        data-original-title style="float: left" name="editAccounts"
                                                        data-id="<?php echo $row['account_id'] ?>">Edit</a>
                                                    <!--Delete button-->
                                                    <a class="btn btn-danger btn-sm" role="button" href=# data-role="delete"
                                                        data-toggle="modal">Delete</a>
                                                    <!--Change Pass button-->
                                                    <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#editPassword"
                                                        data-original-title style="float: left" name="editPassword"
                                                        data-id="<?php echo $row['account_id'] ?>">Change Password</a>
                                                    </div>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                            }else{
                                echo "There is no data";
                            }
                    
                            ?>
                                    </tbody>
                                </table>

                                 <!-- Edit Modal-->
                                 <div class="modal fade" id="editAccounts" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Accounts</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="<?php echo base_url()?>admin/accounts/edit" method="post"
                                                accept-charset="utf-8">
                                                <div class="modal-body">
                                                    <!--Accounts Name-->
                                                    <input type="hidden" name="account_id" id="account_id" value="" />
                                                    <div class="row">
                                                        <div class="col-md-12 form-group">
                                                            <div class="form-group label-floating">
                                                                <label for="name">Username</label>
                                                                <input class="form-control" type="text" name="account_username"
                                                                    id="account_username" required pattern="[a-zA-Z][a-zA-Z\s]*"
                                                                    required
                                                                    title="Accounts name should only countain letters"
                                                                    required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-groups" >
                                                    <label for="formGroupExampleInput4">Account Type</label>
                                                    <select name="account_type" value="">
                                                    <option value="Admin">Admin</option>
                                                    <option value="Barista">Barista</option>
                                                    <option value="Chef">Chef</option>
                                                    <option value="Customer">Customer</option>
                                                    </select> 
                                                    </div>
                                                   

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
                                <!--End Modal Edit Account-->
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

        $(document).ready(function () {
            $('.delete_data').click(function () {
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
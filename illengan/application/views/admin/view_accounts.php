<!doctype html>
<html lang="en">

<head>
<head>
  <title>Ajax Update</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/admin/bootstrap.min.css'?>">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
                    <a class="btn btn-default btn-sm" data-toggle="modal" data-target="#addNewAccounts"
                        data-original-title style="float: left">Add New
                        Account</a>
                    <!--Search
        <div id ="example_filter" class="dataTables_filter">
            <label>
                "Search:"
                <div class="form-group form-group-sm is-empty">
                   <input type="search" class="form-control" placeholder aria-controls="example">
                   <span class="material-input"></span> 
                </div>
            </label>
        </div>-->
                    <br><br>
                    <table id="example" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
                        width="100%">
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
                                <td  data-target="account_id">
                                    <?php echo $row['account_id']; ?>
                                </td>
                                <td  data-target="account_username">
                                    <?php echo $row['account_username']; ?>
                                </td>
                                <td  data-target="account_type">
                                    <?php echo $row['account_type']; ?>
                                </td>
                                <td  data-target="account_password">
                                    <?php echo $row['account_password']; ?>
                                </td>
                                <td  data-target="is_online">
                                    <?php echo $row['is_online']; ?>
                                </td>
                                <td>
    
                                    <div class="onoffswitch">
                                        <!--Edit button-->
                                        <a class="btn btn-info" role="button"
                                            href=# data-id="<?php echo $row['account_id'] ?>" data-role="update"
                                            >Edit</a>
                                        <!--Delete button-->
                                        <a class="btn btn-danger" role="button"
                                            href=# data-id="<?php echo $row['account_id'] ?>"
                                            data-role= "delete" data-toggle="modal">Delete</a>
                                        <!--Change Pass button-->
                                        <a class="btn btn-warning" role="button"
                                            href=# data-id="<?php echo $row['account_id'] ?>"
                                            data-role="edit" data-toggle="modal">Edit</a>
                            
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
                  
                     <!-- Modal content-->
                          <!-- Modal content-->
                          <div class="modal fade" id="editSource" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Modal Header</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>First Name</label>
                                <input type="text" id="firstName" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Last Name</label>
                                <input type="text" id="lastName" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" id="email" class="form-control">
                            </div>
                                <input type="hidden" id="userId" class="form-control">


                        </div>
                        <div class="modal-footer">
                            <a href="#" id="save" class="btn btn-primary pull-right">Update</a>
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        </div>
                        </div>

                    </div>
                    </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</body>

</html>


<!doctype html>
<html lang="en">

<head>
    <?php include_once('templates/head.php') ?>
</head>

    <body>
        <?php include_once('templates/sideNav.php') ?>
        <!--End Side Bar-->
        <div class="main-panel">
        <div class="content">
            <div class="container-fluid">
                <!--Table-->
                <div class="card-content">
                    <a class="btn btn-default btn-sm" data-toggle="modal" data-target="#addNewAccounts" data-original-title style="float: left">Add New
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
                    <table id="example" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
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
                            <tr>
                                <td>
                                <?php echo $row['account_id']; ?>
                                </td>
                                <td>
                                <?php echo $row['account_username']; ?>
                                </td>
                                <td>
                                <?php echo $row['account_type']; ?>
                                </td>
                                <td>
                                <?php echo $row['account_password']; ?>
                                </td>
                                <td>
                                <?php echo $row['is_online']; ?>
                                </td>
                                <td>
                                <div class="onoffswitch">
                                        <!--Edit button-->
                                        <a class="btn btn-info" role="button" href="<?php echo site_url('admin/vieweditAccounts/'.$row['account_id']);?>">Edit</a>
                                        <!--Delete button-->
                                        <a class="btn btn-danger" role="button" href="<?php echo site_url('admin/deleteAccount/'.$row['account_id']);?>">Delete</a>
                                        <!--Change Pass button-->
                                        <a class="btn btn-warning" role="button" href="<?php echo site_url('admin/viewchangepassword/'.$row['account_id']); ?>">Change Password</a>
                                        
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
                    <!--Modals-->
                    <!--Modal for Edit-->
                    <form action="" method="post" accept-charset="utf-8">
                        <div class="modal-body" style="padding: 5px;">
                            <!--Add Menu Item Modal-->
                            <!--Account ID-->
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <div class="form-group label-floating">
                                        <input class="form-control" type="hidden" name="" value="" required>
                                    </div>
                                </div>
                            </div>
                            <!--Account Username-->
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <div class="form-group label-floating">
                                        <label for="email">Username</label>
                                        <input class="form-control" type="text" name="name" value="" required pattern="[a-zA-Z][a-zA-Z\s]*" required title="Username should only countain letters">
                                    </div>
                                </div>
                            </div>
                            <!--Account Type-->
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <div class="form-group label-floating">
                                        <div class="dropdown">
                                            <button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">
                                                <span class="caret"></span></button>
                                            <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Admin</a></li>
                                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Barista</a></li>
                                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Chef</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--Delete Confirmation Box-->
                            <div class="modal fade" id="deactivate" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="contactLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="panel panel-primary">
                                        <div class="panel-heading">
                                            <!--Delete Button-->
                                            <button type="button" class="close" data-dismiss="modal" onclick="document.getElementById('').click()" aria-hidden="true">×</button>
                                            <h4 class="panel-title" id="contactLabel">
                                                <span class="glyphicon glyphicon-warning-sign"></span>
                                                Delete
                                            </h4>
                                        </div>
                                        <form action="adminAccount/delete" method="post" accept-charset="utf-8">
                                            <div class="modal-body" style="padding: 5px;">
                                                <div class="row" style="text-align: center">
                                                    <br>
                                                    <h4> Are you sure you want to delete this user account?</h4>
                                                    <br>
                                                </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="panel-footer" style="margin-bottom:-14px;" align="right">
                                    <input type="submit" class="btn btn-danger" value="Close" />
                                    <input type="reset" class="btn btn-success" value="Update Account" />
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html> 
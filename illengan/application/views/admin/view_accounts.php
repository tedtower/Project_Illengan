<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width= device-width, initial-scale= 1 shrink-to-fit= no">
    <link rel="icon" type="image/ico" href="images/favicon.ico">
    <link rel="stylesheet" type="text/css" href="../../css/admin/styles.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url('application/css/frameworks/bootstrap.min.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('application/others/fonts/circular-std/style.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('application/css/admin/style.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('application/others/fonts/fontawesome/css/fontawesome-all.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('application/others/fonts/material-design-iconic-font/css/materialdesignicons.min.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('application/others/fonts/flag-icon-css/flag-icon.min.css')?>">
    <title>Il-Lengan</title>
</head>
<body>

<a class="btn btn-primary" href="<?php echo base_url()?>index.php/admin/viewaddaccounts" role="button">Add Accounts</a>

<div class="table-responsive" style="text-align:center">
    <table class="table table-bordered">
        <tr>
            <th>Account ID</th>
            <th>Username</th> 
            <th>Account Type</th> 
            <th>Actions</th> 
            
        </tr>
        <?php
            
            if (isset($account)){
                foreach ($account as $row){
              ?>
                    <tr>
                        <td><?php echo $row['account_id']; ?></td>
                        <td><?php echo $row['account_username']; ?></td>
                        <td><?php echo $row['account_type']; ?></td>
                        <td>
                        <a href="<?php echo site_url('admin/viewChangePassword/'.$row['account_id']); ?>">Change Password</a>
                        <a href="<?php echo site_url('admin/editAccount/'.$row['account_id']);?>">Edit</a>
                        <a href="<?php echo site_url('admin/deleteAccount/'.$row['account_id']);?>">Delete</a>
                        </td>
                    </tr>
                    <?php
                    }
            }else{
                echo "There is no data";
            }
            ?>
    </table>
    </body>
</html>
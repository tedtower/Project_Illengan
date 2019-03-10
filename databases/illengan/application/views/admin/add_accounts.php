<!DOCTYPE html>
<html>
<head>
<title>Login Form</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro|Open+Sans+Condensed:300|Raleway' rel='stylesheet' type='text/css'>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url('application/css/frameworks/bootstrap.min.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('application/others/fonts/circular-std/style.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('application/css/admin/style.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('application/others/fonts/fontawesome/css/fontawesome-all.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('application/others/charts/chartist-bundle/chartist.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('application/others/charts/morris-bundle/morris.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('application/others/material-design-iconic-font/css/materialdesignicons.min.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('application/others/charts/c3charts/c3.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('application/others/fonts/flag-icon-css/flag-icon.min.css')?>">
</head>
<body>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<form method="POST" action="<?php echo base_url()?>index.php/admin/addaccounts">

   <div class="form-group">
    <label for="formGroupExampleInput2">Username</label>
    <input type="text" class="form-control" name="account_username" placeholder="username" >
    <span class="text-danger"><?php echo form_error("account_username"); ?></span>
  </div>
   
  <div class="form-group">
    <label for="formGroupExampleInput2">Password</label>
    <input type="password" class="form-control" name="password" placeholder="password" >
    <span class="text-danger"><?php echo form_error("password"); ?></span>
  </div>

  <div class="form-group">
    <label for="formGroupExampleInput3">Confirm Password</label>
    <input type="password" class="form-control"  name="confirm_password" placeholder="confirm_password" >
    <span class="text-danger"><?php echo form_error("confirm_password"); ?></span>
  </div>

  <div class="form-groups" >
  <label for="formGroupExampleInput4">Account Type</label>
    <select name="account_type">
    <option value="Admin" name="account_type">Admin</option>
    <option value="Barista" name="account_type">Barista</option>
    <option value="Chef" name="account_type">Chef</option>
    </select> 
  </div>

  
  <div class="form-group">
      <input type="submit" class="btn btn-info" name="add" value="Add">
  </div>
</form>
</body>
</html>

<html>
<head>
    <title> Il-Lengan </title>
    <link rel="icon" type="image/png" href="images/favicon.ico">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/admin/style.css')?>">   
</head>
    <body>
        <div class="form-box">
            <span><?php 
            if(isset($err)){
                echo $err;
            }?></span>
            <img src="assets/media/admin/Coffee_1.jpg" class="logo">
            <form method="post" action="<?php echo site_url("verifylogin")?>">
                    <p>Username</p>
                        <input type="text" name="username" placeholder="Enter Username">
                    <p>Password</p>
                        <input type="password" name="password" placeholder="Enter Password">
                    <br><br>
                        <input type="submit" name="submit" value="Log In">   
            </form>
        </div>
    </body>
</html>
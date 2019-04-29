<html>
<head>
    <title> Il-Lengan </title>
    <link rel="icon" type="image/png" href="./assets/media/favicon.ico">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/login/style.css')?>">   
</head>
    <body>
        <div class="form-box">
            <span><?php 
            if(isset($err)){
                echo $err;
            }?></span>
            <img src="<?php echo base_url('/assets/media/logo.png')?>" class="logo">
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
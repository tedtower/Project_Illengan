<!DOCTYPE html>
<<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Tables</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link rel="stylesheet" type="text/css" media="screen" href="main.css" /> -->
    <!-- <script src="main.js"></script> -->
</head>
<body>
    <table>
        <tr>
            <th>Table Number</th>
            <th>Actions</th>
        </tr>
        <?php
            if(isset($table)){
                foreach($table as $table){
        ?> 
        <tr>
            <td><?php echo $table['table_no']?></td>
        </tr>
        <?php            
                }
            } 
        ?>
    </table>
</body>
</html>
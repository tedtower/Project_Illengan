<div>
    <form method="get" action="<?php echo site_url('admin/tables/add')?>">
        <span>Table Number: </span> <input name="table_code" type="text" value="">
        <input type="submit" value="Submit">
    </form>
</div>
<div class="container">
    <table id="table" class="display">
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
            <td>
                <a href="<?php echo site_url('admin/tables/delete/'. $table['table_no'])?>">Delete</a>
            </td>
        </tr>
        <?php            
                    }
                } 
            ?>
    </table>
</div>
</table>
</body>

</html>
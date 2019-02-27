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
                <a href="<?php echo site_url('admin/viewChangePassword/'.$row['account_id']);?>">Change Password</a>
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
<!-- End of Left Sidebar -->
<div class="table-responsive" style="text-align:center">
    <table class="table table-bordered">
        <tr>
            <th>Code</th>
            <th>Description</th>
            <!--menu id-->
            <th>Quantity</th>
            <!--sqty-->
            <th>Damage date</th>
            <!--sdate-->
            <th>Date Recorded</th>
            <!--date_recorded-->
            <th>Remarks</th>
            <!--remarks-->
            <th>Delete</th>
        </tr>
        <?php
            
            if (isset($spoilagesmenu)){
                foreach ($spoilagesmenu as $row){
              ?>
        <tr>
            <td><?php echo $row['sid']; ?></td>
            <td><?php echo $row['menu_name']; ?></td>
            <td><?php echo $row['sqty']; ?></td>
            <td><?php echo $row['sdate']; ?></td>
            <td><?php echo $row['date_recorded']; ?></td>
            <td><?php echo $row['remarks']; ?></td>
            <td><a href="<?php echo site_url('admin/deletespoilages/'.$row['sid']);?>">Delete</a></td>
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
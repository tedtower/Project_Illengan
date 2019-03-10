<!-- END OF SIDEBAR-->
<div>
    <table>
        <thead>
            <tr>
                <th>Code</th>
                <th>Stock Name</th>
                <th>Quantity</th>
                <th>Log Type</th>
                <th>Date by Type</th>
                <th>Date Recorded</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
                    if(isset($log)){
                        foreach($log as $log){
                    ?>
            <tr>
                <td><?php echo $log['log_id']?></td>
                <td><?php echo $log['stock_name']?></td>
                <td><?php echo $log['quantity']?></td>
                <td><?php echo $log['log_type']?></td>
                <td><?php echo $log['log_date']?></td>
                <td><?php echo $log['date_recorded']?></td>
                <td><?php echo 'action'?></td>
            </tr>
            <?php
                        }
                    }
                    ?>
        </tbody>
    </table>
</div>
</body>

</html>
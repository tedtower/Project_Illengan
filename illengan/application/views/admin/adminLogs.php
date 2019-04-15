<!doctype html>
<html lang="en">

<head>
    <?php include_once('templates/head.php') ?>
</head>

<body>
    <?php include_once('templates/sideNav.php') ?>
    <!--End Side Bar-->
    <div class="content">
        <div class="container-fluid">
            <br>
            <p style="text-align:right; font-weight: regular; font-size: 16px">
                <!-- Real Time Date & Time -->
                <?php echo date("M j, Y -l"); ?>
            </p>
            <div class="content" style="margin-left:250px;">
                <div class="container-fluid">
                    <div class="content">
                        <div class="container-fluid">
                            <!--Table-->
                            <div class="card-content">
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
                                <br>
                                <br>
                                <table id="logsTable" class="table table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                    <thead>
                                        <th style="width:10px"></th>
                                        <th><b class="pull-left">Log ID</b></th>
                                        <th><b class="pull-left">Stock ID</b></th>
                                        <th><b class="pull-left">Transaction ID</b></th>
                                        <th><b class="pull-left">Log Qty</b></th>
                                        <th><b class="pull-left">Log Type</b></th>
                                        <th><b class="pull-left">Log Date</b></th>
                                        <th><b class="pull-left">Date Recorded</b></th>
                                        <th><b class="pull-left">Remarks</b></th>
                                    </thead>
                                    <tbody>
                                        <?php if(isset($logs)){
                                    ?>
                                        <tr>
                                            <td><?php echo $logs['log_id']?></td>
                                            <td><?php echo $logs['stock_id']?></td>
                                            <td><?php echo $logs['trans_id']?></td>
                                            <td><?php echo $logs['log_qty']?></td>
                                            <td><?php echo $logs['log_type']?></td>
                                            <td><?php echo $logs['log_date']?></td>
                                            <td><?php echo $logs['date_recorded']?></td>
                                            <td><?php echo $logs['remarks']?></td>
                                        </tr>
                                        <?php

                                        }else{
                                            echo 'no data';
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                <!--End Table Content-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include_once('templates/scripts.php') ?>
</body>

</html>
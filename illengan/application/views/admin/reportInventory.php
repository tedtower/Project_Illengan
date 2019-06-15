<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport'>
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Il-Lengan | Inventory Report</title>
    <link rel="icon" type="image/ico" href="<?= logo_url().'logo_sm.ico'?>">
    <link rel="stylesheet" type="text/css" href="<?= framework_url().'bootstrap-native/bootstrap.min.css'?>">
    <link rel="stylesheet" type="text/css" href="<?= admin_css().'light-bootstrap-dashboard.css'?>">
    <link rel="stylesheet" type="text/css" href="<?= admin_css().'sidenav.css'?>">
    <link rel="stylesheet" type="text/css" href="<?= admin_css().'print.css'?>">
    <link rel="stylesheet" type="text/css" href="<?= font_url().'fontawesome/font-awesome.css'?>">

</head>
<body style="background:white">
<div id="printReport">
    <div class="page">
        <div class="subpage">
            <table class="table table-bordered">
                <thead class="head">
                    <tr>
                        <th><b>Transaction</b></th>
                        <th><b>Receipt No.</b></th>
                        <th><b>Date</b></th>
                        <th><b>Quantity</b></th>
                        <th><b>Remaining Qty</b></th>
                        <th><b>Remarks</b></th>
                    </tr>
                </thead>
                <?php  
                    if(isset($report)){
                        foreach($report as $report){
                ?> 
                <tbody>
                    <tr>
                        <td><?php echo $report['slType']?></td>
                        <td><?php echo $report['tID']?></td>
                        <td><?php echo $report['slDateTime']?></td>
                        <td><?php echo $report['slQty']?></td>
                        <td><?php echo $report['slQty']?></td>
                        <td><?php echo $report['slRemarks']?></td>
                    </tr>
                </tbody>
                <?php }
                    }else{
                        echo 'error';
                } ?>  
            </table>
            <button  class="btn btn-info btn-sm noprint" id="print" onclick="printContent('printReport');" style="width:90px;margin:10px 0;background:#0ba1c6;color:white;font-size:15px" >Print</button>
        </div>
    </div>
</div>

<?php include_once('templates/scripts.php') ?>
<script src="<?= admin_js().'print.js'?>"></script>
<script>
      function printContent(el){
      var restorepage = $('body').html();
      var printcontent = $('#' + el).clone();
      var enteredtext = $('#text').val();
      $('body').empty().html(printcontent);
      window.print();
      $('body').html(restorepage);
      $('#text').html(enteredtext);
      }
  </script>
</body>
</html>


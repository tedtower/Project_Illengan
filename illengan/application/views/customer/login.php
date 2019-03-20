<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<html>
	<head>
		<title>Illengan</title>
		<?php include_once('template/head.php');?>
	</head>
	<body>
		<?php echo isset($error) ? $error : ''; ?>
         <form method="post" action="<?php echo site_url();?>customer/process_login">
    <div class="modal fade" id="tableModal" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content text-center">
			<center>
			 <img src="<?php echo base_url().'assets/media/logo.png'?>" style="height:130px;width:130px">
			 </center>
                <div class="modal-header">
                <h2 class="modal-title w-100 gab">Welcome in Il-lengan Cafe!</h1>
                
                </div>
                <div class="modal-body">
					<div class="md-form input-group m-0">
                        <small>Please log in to order:</small>
                    </div>
				<label>Table Code:</label>
				<select class="form-control" name="table_no" required>
				 <option value="">Please Select</option>
            <?php 
            foreach($number as $row)
            { 
			  echo '<option value="'.$row->table_code.'">'.$row->table_code.'</option>';
            }
            ?>
			
            </select>
					<div class="md-form input-group m-0">
                        <input type="text" name="cust_name" id="cust_name" class="form-control text-center" placeholder="Customer's Name (optional)" aria-label="Cutomer Name"/>
                    </div>
                </div>
                <div class="text-center">
                   <input type="submit" class="btn btn-dark-green" value="Login">
                </div>
            </div>
        </div>
    </div>
		</form>
	</body>
</html>
<?php include_once('template/foot.php');?>
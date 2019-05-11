 <!-- Order Modal -->
 <div class="modal fade" id="order_modal" tabindex="-1" role="dialog" aria-labelledby="orderListModal" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <!-- Modal Body -->
                <div class="modal-body">
                    <button type="button" class="close d-flex justify-content-end" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class="rp-title">&times;</span>
                    </button>
	<form method="post" action="<?php echo base_url('customer/completeOrder');?>">
	<?php 
		$cust_name = $this->session->userdata('cust_name');
        $table_no = $this->session-> userdata('table_no');
        $orders = $this->session-> userdata('orders');
        $date = date('F d, Y');
        $now = date('Y-m-d');
            echo form_hidden('date', $now);
            echo form_hidden('table_no', $table_no);
            echo form_hidden('cust_name', $cust_name);
		echo '<strong>Customer Name:</h3>'.$cust_name.'
        <br><strong>Table Code: </strong>'.$table_no['tableCode'].'<br><b>Date:&nbsp;</b>'.$date.'<br>';
          if(empty($orders)) { //check if the customer did not order yet
            echo 'To order menu items click on "Save to Orderlist" Button';
		  }else{
            ?>
                    <div class="text-center">
                        <h1 class="gab">Orderlist</h1>
                        <table class="table table-sm table-hover w-responsive mx-auto delius">
                            <thead>
                                <tr>
                                <th scope="col">Item No.</th>
                                <th scope="col">Menu Name</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Total Price</th>
                                <th scope="col">Remarks</th>
                                <th scope="col">Add Ons</th>
                                <th scope="col">Actions</th>
                                </tr>
                            </thead>
							<?php 
                             $rowid = 0;
                             $total_qty=0;
                             $total=0;
                             foreach ($orders as $key => $item) {
                                $id = $item['id'];
                                $addon = json_encode($item['addons']);
                                echo form_hidden($rowid);
							?>
                            <tbody>
                                <tr>
								<?php 
                                    echo form_hidden($item['id']);
                                    
                                ?>
                                <td><?php //echo json_encode($item);?></td>
                                <th scope="row"><?php echo $item['name'];?></th>
                                <td><?php echo $item['qty'];?></td>
                                <td><?php echo $item['subtotal'];?></td>
                                <td><?php echo $item['remarks'];?></td>
                                <td><?php
                                    echo $addon;
                                ?></td>
                                <td>
                                    <button type="button" class="btn btn-mdb-color btn-sm m-0 p-2" data-toggle="modal" data-target="#editModal">Edit</button>
                                    <?php include 'edit.php'; ?>    
                                    
                                    <button type="button" class="btn btn-danger btn-sm m-0 p-2" data-toggle="modal" data-target="#deleteModal">Remove</button>
                                    <?php include 'remove.php'; ?>
                                </td> 
                                </tr>
							<?php
                                 $total_qty += $item['qty'];
                                 $total += $item['subtotal'];
                                 $rowid++;
                                
                    }
							?>
								<tr>
									<td colspan="3"><h3 class="gab">Total Quantity: <?php echo $total_qty; ?></h3></td>
									<td colspan="3"><h3 class="gab">Total Price: <?php echo $total; ?> php</h3></td>
                                    <input type="hidden" name="total" value="<?php echo $total; ?>"/>
								</tr>
                            </tbody>
                        </table>
                        <?php ?>
                    </div>
                    <div>
                        <div class="text-center">
                            <button type="button" data-toggle="modal" class="btn btn-green btn-md delius" href="#proceed_modal">Order Now</button>
                            <?php include 'orderslip.php'; ?>
                        </div>
                        <div>
                            <a href="<?php echo base_url('customer/clearOrder');?>"><button type= "button" class="btn btn-danger btn-md delius">Clear</button></a>
                        </div>
                    </div>
                </div>
				</form>
				<?php }; ?>
            </div>
        </div>
    </div>	
    		

<!-- Order Modal -->
<div class="modal fade" id="order_modal" tabindex="-1" role="dialog" aria-labelledby="orderListModal" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <!-- Modal Body -->
            <div class="modal-body">
                <button type="button" class="close d-flex justify-content-end" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="rp-title">&times;</span>
                </button>
	            <form method="post" action="<?= base_url('customer/completeOrder');?>">
                    <?php 
                    $cust_name = $this->session->userdata('cust_name');
                    $table_no = $this->session->userdata('table_no');
                    $orders = $this->session->userdata('orders');
                    $date = date('F d, Y');
                    $now = date('Y-m-d');
                    echo form_hidden('date', $now);
                    echo form_hidden('table_no', $table_no);
                    echo form_hidden('cust_name', $cust_name);
                    if(empty($cust_name)){
                        echo '<div class="mb-3"><strong>Table Code: </strong>'.$table_no['table_code'].'<br><b>Date:&nbsp;</b>'.$date.'<br></div>';
                    }else{
                        echo '<div class="mb-3"><strong>Customer Name:</strong>'.$cust_name.'<br><strong>Table Code: </strong>'.$table_no['table_code'].'<br><b>Date:&nbsp;</b>'.$date.'<br></div>';
                    }
                    if(empty($orders)) { //check if the customer did not order yet
                        echo '<h5>You have no saved orders. To order menu items click on <span style="color:#b96e43">"Save to Orderlist"</span> button.</h5>';
                    }else{ ?>
                    <div class="text-center">
                        <h1 class="gab">Orderlist</h1>
                            <table class="table table-sm table-hover w-responsive mx-auto delius">
                                <thead>
                                    <tr>
                                        <th scope="col">Menu Name</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Total Price</th>
                                        <th scope="col">Remarks</th>
                                        <th scope="col">Add Ons</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="orderlists">
                                    
                                </tbody>
                            </table>
                    </div>
                    <div>
                        <div class="text-center">
                            <button type="button" data-toggle="modal" class="btn btn-green btn-md delius" href="#proceed_modal">Order Now</button>
                            <?php include 'orderslip.php'; ?>
                        </div>
                        <div>
                            <button type="button" class="btn btn-danger btn-md delius" data-toggle="modal" data-target="#deleteAllModal">Clear</button>
                            <?php include 'remove_all.php'; ?>
                        </div>
                    </div>
                </div>
				</form>
				<?php }; ?>
            </div>
        </div>
    </div>	
    <?php include 'edit.php'; ?>    
    <?php include 'remove.php'; ?>